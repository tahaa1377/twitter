$(function () {
$(document).on('click','.follow-btn',function () {

// })
//     $('.follow-btn').click(function () {
       var id=$(this).data('follow');
       $button = $(this);

       if ($button.hasClass('following-btn')){

           $.ajax('http://localhost/twitter/core/ajax/follow.php', {
                  dataType: 'json',
                   type: 'post',
                   data: {
                       unfollow: id
                   },
                   success: function (data) {

                      $button.removeClass('following-btn');
                      $button.removeClass('unfollow-btn');
                      $button.html('<i class="fa fa-user-plus"></i>Follow');
                      $('.count-following').text(data.following);
                      $('.count-followers').text(data.follower);
                   }
               }
           );

       } else {
           $.ajax('http://localhost/twitter/core/ajax/follow.php', {
                   dataType: 'json',
                   type: 'post',
                   data: {
                       follow: id
                   },
                   success: function (data) {

                       $button.removeClass('follow-btn');
                       $button.addClass('following-btn');
                       $button.text('Following');
                       $('.count-following').text(data.following);
                       $('.count-followers').text(data.follower);
                   }
               }
           );
       }


    });

$('.follow-btn').hover(function () {

    if ($(this).hasClass('following-btn')){

        $(this).text('Unfollow');
        $(this).addClass('unfollow-btn');
    }


},function () {

    if ($(this).hasClass('following-btn')){
        $(this).removeClass('unfollow-btn');
        $(this).text('Following');
    }
});

});