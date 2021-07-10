$(function () {

    $(document).on('click','.addTweetBtn',function () {
        $('.status').removeClass().addClass('status-removed');
        $('.hash-box').removeClass().addClass('hash-removed');
        $('#count').attr('id','count-removed');

            $.ajax('http://localhost/twitter/core/ajax/tweetpopup.php', {
                    type: 'post',
                    success: function (data) {
                        $('.popupTweet').html(data);
                        $('.closeTweetPopup').click(function () {
                            $('.popup-tweet-wrap').hide();
                            $('.status-removed').removeClass().addClass('status');
                            $('.hash-removed').removeClass().addClass('hash-box');
                            $('#count-removed').attr('id','count');

                        });

                    }
                }
            );
    });

$(document).on('submit','#myForm',function () {

    var form=new FormData($(this)[0]);
    form.append('file',$('#file')[0].files[0]);


    $.ajax('http://localhost/twitter/core/ajax/addTweet.php', {
            data:form,
            type: 'post',
            dataType:'JSON',
            success: function (data) {
                $('<div class="error-banner"><div class="error-banner-inner"><p id="errorMsg">'+data+'</p></div></div>').insertBefore('.header-wrapper');
                $('.error-banner').hide().slideDown(1000).delay(5000).slideUp(1000);
                $('.popup-tweet-wrap').hide();
            },
            cache:false,
            contentType:false,
            processData:false
        }
    );
});

});