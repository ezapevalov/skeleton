var temp_preview_url = "";

$(document).ready(function() {
    $(".form-group").focusin( function ( event ) {
        $(this).removeClass('has-error');
    });

    $("#preview_button").click(function( event ) {
        event.preventDefault();

        formIsValid();

        $.get('/index/check_email_availability?email='+$("#user_email").val(), function(result) {
            if ( result == 'taken' ) {
                $("#validation_error_modal .modal-body p").hide();
                $("#validation_error_modal .modal-body p#taken_email").show();
                $("#validation_error_modal .modal-body #taken_email_value").text($("#user_email").val());
                $("#validation_error_modal").modal('show');
                return false;
            } else {
                if ( temp_preview_url.length > 0 ) {
                    $("#preview_image_block img").attr('src', temp_preview_url);
                } else {
                    $("#preview_image_block img").attr('src', "/uploads/no-image.png");
                }

                $("#preview_name").text($("#user_name").val());
                $("#preview_date").text(getFormattedDate);
                $("#preview_comment").text($("#user_comment").val());

                $("form, #activate_preview_block, #lure").hide();
                $("#preview, #deactivate_preview_block").fadeIn('slow');
            }
        });
    });

    $("#back_from_preview_button").click(function() {
        $("#preview, #deactivate_preview_block").hide();
        $("form, #activate_preview_block, #lure").fadeIn('slow');
    });

    $("input[type=file]").html5Uploader( {
        onServerReadyStateChange:function(e, file) {
            if( e.target.readyState == 4 ) {
                if ( e.target.status == 200 || e.target.status == 0 ) {
                    var r = $.parseJSON(e.target.responseText);

                    if ( r.done == 'no' ) {
                        if ( r.error == 'wrong_extension' )  {
                            $("#wrong_image_modal .modal-body p").hide();
                            $("#wrong_image_modal .modal-body p#wrong_extension").show();
                            $("#wrong_image_modal").modal('show');
                        }
                    } else {
                        $("#upload_hidden_button").hide();
                        $("#uploaded_image").attr('src', r.image_url).fadeIn('slow');
                        temp_preview_url = r.image_url;
                    }
                }
            }
        },
        name: "img",
        postUrl: "/index/upload_image/"
    });

    $("#submit_button").click(function () {
        if ( formIsValid() ) {
            $.get('/index/check_email_availability?email='+$("#user_email").val(), function(result) {
                if ( result == 'taken' ) {
                    $("#validation_error_modal .modal-body p").hide();
                    $("#validation_error_modal .modal-body p#taken_email").show();
                    $("#validation_error_modal .modal-body #taken_email_value").text($("#user_email").val());
                    $("#validation_error_modal").modal('show');
                    return false;
                } else {
                    var data = {
                        name : $('#user_name').val(),
                        email : $('#user_email').val(),
                        comment : $('#user_comment').val(),
                        image : temp_preview_url
                    };

                    $.post('/index/add_comment', data, function(result) {
                        console.log(result);
                        if ( result == 'done' ) {
                            $("#lure, form, #preview, #form_buttons").hide().remove();
                            $("#congratulations").fadeIn('slow');
                        }
                    })
                }
            });
        }
    });

    $(window).bind('beforeunload', function() {
        if ( temp_preview_url.length > 0 ) {
            var url = '/index/remove_temp_preview?image_url=' + temp_preview_url;

            $.get(url);
        }
    });
});

function formIsValid() {
    var errors = 0;

    $(".required").each(function() {
        if ( $(this).val().length == 0 ) {
            errors += 1;
            $(this).parent().addClass('has-error');
        }
    });

    if ( errors > 0 ) {
        $("#validation_error_modal .modal-body p").hide();
        $("#validation_error_modal .modal-body p#empty_fields").show();
        $("#validation_error_modal").modal('show');
        return false;
    }

    if ( !validateEmail($("#user_email").val()) ) {
        $("#validation_error_modal .modal-body p").hide();
        $("#validation_error_modal .modal-body p#wrong_email").show();
        $("#validation_error_modal .modal-body #wrong_email_value").text($("#user_email").val());
        $("#validation_error_modal").modal('show');
        return false;
    }

    return true;
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function getFormattedDate() {
    var date = new Date();
    var date_formatted = $.datepicker.formatDate('dd.mm.yy', date) + ' ' + addZero(date.getHours()) + ":" + addZero(date.getMinutes());

    return date_formatted;
}

function addZero(i) {
    if ( i < 10 ) {
        i = "0" + i;
    }
    return i;
}

