$(function () {

    // $(document).on('click','.t-show-popup',function () {
    //
    //     alert("b")
    //     var id=$(this).data('tweet');
    //     $.ajax('http://localhost/twitter/core/ajax/popuptweet.php', {
    //             type: 'post',
    //             data:{
    //                 tweetId:id
    //             },
    //             success: function (data) {
    //                 $('.popupTweet').html(data);
    //                 $('.tweet-show-popup-box-cut').click(function () {
    //                    $('.tweet-show-popup-wrap').hide();
    //                 });
    //             }
    //         }
    //     );
    // });
    //
    // $(document).on('click','.imagePopup',function (e) {
    //     alert("n")
    //    e.stopPropagation();
    //     var id=$(this).data('id');
    //     $.ajax('http://localhost/twitter/core/ajax/imagepopup.php', {
    //             type: 'post',
    //             data:{
    //                 tweetId:id
    //             },
    //             success: function (data) {
    //                 $('.popupTweet').html(data);
    //                 $('.close-imagePopup').click(function () {
    //                     $('.img-popup').hide();
    //                 });
    //             }
    //         }
    //     );
    // });

    $(document).on('click','.deleteTweet',function () {
        $('.popupTweet').show();
        var id=$(this).data('tweetid');

        console.log(id);


        var parent=$(this).parentsUntil('.t-show-wrap').parent();

        $.ajax('http://localhost/twitter/core/ajax/delete.php', {
                type: 'post',
                data:{
                    tweetId:id
                },
                success: function (data) {
                    $('.popupTweet').html(data);
                    $('.close-retweet-popup').click(function () {
                        $('.popupTweet').hide();
                    });
                    $('.cancel-it').click(function () {
                        $('.popupTweet').hide();
                    });
                    $('.delete-it').click(function () {
                        $.ajax('http://localhost/twitter/core/ajax/deleteTweet.php', {
                                type: 'post',
                                data:{
                                    tweetId1:id
                                },
                                success: function () {
                                    parent.remove();
                                    $('.popupTweet').hide();


                                   // $('#tweets_show').remove();
                                   //  $.ajax('http://localhost/twitter/core/ajax/showTweet.php', {
                                   //          type: 'post',
                                   //          success: function (data) {
                                   //              $('#tweets_show').html(data);
                                   //          }
                                   //      }
                                   //  );

                                    location.reload();

                                }
                            }
                        );

                    });

                }
            }
        );
    });

});