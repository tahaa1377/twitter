
$(function () {


// var regex=/(@|#)[a-zA-Z0-9]+$/ig;
    var regex=/[@|#](\w+)$/ig;

    $(document).on('keyup','.status',function () {

        if ($(this).val().length <= 250){


            $('#count').text(250 - $(this).val().length);

            var content=$.trim($(this).val());
            var text =content.match(regex);

            // if (text != null){
            //
            //     $.ajax('http://localhost/twitter/core/ajax/hashTag.php', {
            //             type: 'post',
            //             data:{
            //                 hashtag: text[0]
            //             },
            //             success: function (data) {
            //                 $('.hash-box ul').html(data);
            //                 $('.hash-box li').on('click',function () {
            //                     var a=$('.status').val();
            //                     $('.status').val(a+' ');
            //                     $('.hash-box li').hide();
            //                     $('.status').focus();
            //                 });
            //             }
            //         }
            //     );
            //
            // }else {
            //     $('.hash-box li').hide();
            // }


        }else {
            $(this).attr("disabled", "disabled");

        }


    });




    $('.search').on('keyup',function () {

        var search =$(this).val();
        if (search.length <1){
            $('#ajax_search_result').empty();
        }else {
            $.ajax('http://localhost/twitter/core/ajax/search.php', {

                    // dataType: 'json',
                    type: 'post',
                    data: {
                        searching: search
                    },
                    success: function (data) {
                        $('#ajax_search_result').html(data);
                    }
                }
            );
        }
    });


    $.ajax('http://localhost/twitter/core/ajax/showTweet.php', {
            type: 'post',
            success: function (data) {
                $('#tweets_show').html(data);
            }
        }
    );



});


