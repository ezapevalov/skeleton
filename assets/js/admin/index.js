$(document).ready(function() {
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
