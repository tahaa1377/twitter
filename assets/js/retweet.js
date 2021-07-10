$(function () {

    //$('.retweet').click(function () {


    $(document).on('click','.retweet',function () {

       $user_id = $(this).data('user');
       $tweet_id = $(this).data('tweet');
       $countController = $(this).find('.retweet_counter');
       $count = $countController.text();
       $countent = $(this);

        $.ajax('http://localhost/twitter/core/ajax/retweet.php', {
                type: 'post',
                data:{
                    tweetId:$tweet_id
                },
                success: function (data) {
                    $('.popupTweet').html(data);
                    $('.close-retweet-popup').click(function () {

                        $('.retweet-popup').hide();
                    });
                }
            }
        );

    });

    $(document).on('click','.retweet-it',function () {

        var msg=$('.retweetMsg').val();

        $.ajax('http://localhost/twitter/core/ajax/retweet.php', {

                type: 'post',
                data:{
                       tweetId:$tweet_id,
                       userId:$user_id,
                        mesg:msg
                },
                success: function () {
                    $('.retweet-popup').hide();
                    $count++;
                    $countController.text($count);
                   // $countent.removeClass('retweet').addClass('retweeted');

                    location.reload();

                }
            }
        );

    });
});