$(document).ready(function() {
    var order_by_toggle = $(".order_by_toggle");

    $(order_by_toggle).click(function() {
        var order_by = $(this).attr('order_by');
        var order_type = 'ASC';
        var icon = $(this).find("i");

        if ( $(icon).hasClass("glyphicon-arrow-up") ) {
            order_type = 'DESC';
        }

        window.location = '/admin?order_by=' + order_by + '&order_type=' + order_type;
    });

    $(".comment-status-checkbox").each(function() {
        $(this).bootstrapSwitch().on('switchChange.bootstrapSwitch', function(event, state) {
            var comment_id = $(this).attr('comment_id');
            var status = state ? 1 : 0;
            var url = '/admin/toggle_comment?id=' + comment_id + "&status=" + status;

            $.get(url, function(result) {
                console.log(result)
            })
        });
    })
});
