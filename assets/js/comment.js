// location.reload() => refresh page

$(function () {

    $(document).on('click','#postComment',function () {

        var commentField=$('#commentField').val();
        var id=$('#commentField').data('idt');

        if (commentField.length!==0) {
            $.ajax('http://localhost/twitter/core/ajax/comment_ajax.php', {
                    type: 'post',
                    data: {
                        comment: commentField,
                        tweet_id1: id
                    },
                    success: function (data) {
                        $('#commentField').val("");
                        $('#comments').html(data);
                    }
                }
            );
        }
    });

    $(document).on('click','.deleteCmment',function () {
        var comment_id=$(this).data('commentid');
        var content=$(this).parentsUntil('.tweet-show-popup-comment-head').parent();
        $.ajax('http://localhost/twitter/core/ajax/delete.php', {
                type: 'post',
                data: {
                    commentId: comment_id
                },
                success: function () {
                    content.remove();

                }
            }
        );
    });

});