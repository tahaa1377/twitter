$(function () {

    $(document).on('click','#messagePopup',function () {
        var getMessage=1;
        $.ajax('http://localhost/twitter/core/ajax/message.php', {

                type: 'post',
                data: {
                    showMessage: getMessage
                },
                success: function (data) {

                    $('.popupTweet').html(data);

               }
            }
        );
    });







    $(document).on('click','.people-message',function () {
       $id=$(this).data('id');
        var ip=1;
        $.ajax('http://localhost/twitter/core/ajax/message.php', {
                type: 'post',
                data: {
                    chatId: $id,
                    ip:ip
                },
                success: function (data) {

                    $('.popupTweet').html(data);
                    getmessages();
                }
            }
        );
        $timer=setInterval(getmessages,5000);
        getmessages();
    });






    $(document).on('click','.back-messages',function () {
        var getMessage=1;
        $.ajax('http://localhost/twitter/core/ajax/message.php', {
                type: 'post',
                data: {
                    showMessage: getMessage
                },
                success: function (data) {
                    $('.popupTweet').html(data);
                    clearInterval($timer);

                }
            }
        );
    });

    $(document).on('click','.close-msgPopup',function () {
        clearInterval($timer);
    });




    getmessages=function () {

        ip1=1;
        $.ajax('http://localhost/twitter/core/ajax/message.php', {
                type: 'post',
                data: {
                    ip1:ip1,
                    chatId: $id
                },
                success: function (data) {
                    $('.main-msg-inner').html(data);
                if (autoscroll){
                    scrolldwon();
                } 
                // $('#chat').on('scroll',function () {
                    $(document).on('scroll','#chat',function () {

                    if ($(this).scrollTop()<this.scrollHeight-$(this).height()) {
                        autoscroll=false;
                    }else {
                        autoscroll=true;
                    }
                }) ;
                
                }
            }
        );
    };




autoscroll=true;
scrolldwon=function(){
  $('#chat').scrollTop($('#chat')[0].scrollHeight);
};







    $(document).on('keyup','.search-user',function () {
    var vall=$(this).val();

        $.ajax('http://localhost/twitter/core/ajax/message.php', {
                type: 'post',
                data: {
                  vall:vall
                },
                success: function (d) {
//$('.message-recent').hide();
$('.message-recent').html(d);
                }
            }
        );
    });





    // $(document).on('click','#send',function () {
    //
    //
    //     var CHATID=$(this).data('id');
    //     var CHATIDtaraf=$(this).data('taraf');
    //     var maessage=$('#msg').val();
    //
    //     $.ajax('http://localhost/twitter/core/ajax/message.php', {
    //             type: 'post',
    //             data: {
    //                 chatId1: CHATID,
    //                 chatId2: CHATIDtaraf,
    //                 kmassege: maessage
    //             },
    //             success: function () {
    //
    //                 getmessages();
    //                 $('#msg').val("");
    //             }
    //         }
    //     );
    // });

    $(document).on('click','#messageForm',function () {

        var form=new FormData($(this)[0]);
        form.append('msg-upload',$('#msg-upload1')[0].files[0]);

        $.ajax('http://localhost/twitter/core/ajax/msgForm.php', {
                data:form,
                type: 'post',
                success: function () {


                    getmessages();
                    $('#msg').val("");
                },
                cache:false,
                contentType:false,
                processData:false
            }
        );
    });
    // $(document).on('click','#msg-upload1',function (e) {
    //     e.stopPropagation();
    //
    // });

});