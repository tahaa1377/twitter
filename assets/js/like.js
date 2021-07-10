$(function () {


    $(document).on('click','.like-btn',function () {

        var user_id=$(this).data('userid');
        var tweet_id=$(this).data('tweetid');
        var content=$(this);
        var counter=content.find('.counter').text();

        $.ajax('http://localhost/twitter/core/ajax/like.php', {

                type: 'post',
                data:{
                    userId:user_id,
                    tweetId:tweet_id
                },
                success: function () {
                    content.addClass('unlike-btn');
                    content.removeClass('like-btn');
                    content.find('.fa-heart-o').addClass('fa-heart');
                    content.find('.fa-heart').removeClass('fa-heart-o');

                    counter++;
                    // alert(counter)
                    content.find(".counter").text(counter);
                }
            }
        );
    });



    $(document).on('click','.unlike-btn',function () {

        var user_id=$(this).data('userid');
        var tweet_id=$(this).data('tweetid');
        var content=$(this);
        var counter=content.find('.counter').text();

        $.ajax('http://localhost/twitter/core/ajax/unlike.php', {

                type: 'post',
                data:{
                    userId:user_id,
                    tweetId:tweet_id
                },
                success: function (data) {
                    content.addClass('like-btn');
                    content.removeClass('unlike-btn');
                    content.find('.fa-heart').addClass('fa-heart-o');
                    content.find('.fa-heart-o').removeClass('fa-heart');

                    counter--;
                    if (counter<0){
                        counter=0;
                    }
                    // alert(counter)
                    content.find(".counter").text(counter);
                }
            }
        );
    });



    $(document).on('click','.likeList',function () {

        var id=$(this).data('tweetid');



        $.ajax('http://localhost/twitter/core/ajax/likeList.php', {
                type: 'post',
                data:{
                    tweetId:id
                },
                success: function (data) {

                    $('.popupTweet').show();
                    $('.popupTweet').html(data);
                    $('.close-retweet-popup').click(function () {
                        $('.popupTweet').hide();
                    });
                    $('.cancel-it').click(function () {
                        $('.popupTweet').hide();
                    });

                }
            }
        );
    });



});
