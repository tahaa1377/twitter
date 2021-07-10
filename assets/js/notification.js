$(function () {



    function nnotification(){
        $.ajax('http://localhost/twitter/core/ajax/notification.php', {
                type: 'post',
                dataType:'JSON',

                success: function (data) {

                    if (data.notif>0){

                        $('#notification').show();
                        $('#notification').addClass('span-i');
                        $('#notification').html(data.notif);
                    }



                }
            }
        );
    }

    setInterval(nnotification,10000);


    $(document).on('click','#tahaaaaa',function () {

        $('#notification').hide();
        $.ajax('http://localhost/twitter/core/ajax/list_notifications.php', {
                type: 'post',
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