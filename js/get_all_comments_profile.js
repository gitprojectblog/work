$(document).ready(function(){
  $('.hover_comment a').mouseenter(function(){
    var comment_before = $(this).parent('.hover_comment');
    var news_id = $(this).parent('.hover_comment').find('.about_post').val();
    var about_post = $(this).parent('.hover_comment').parent('.comment_block_info').parent('.comment_block').find('.comment_about_post');
    console.log(news_id);
    function funcBefore() {
      about_post.html('<h6>Загружается<h6>');
      about_post.css('display', 'block');
      comment_before.addClass('comment_hover_before');
    }
    function funcSuccess(data) {
      $(about_post).html(data);
    }
    if (about_post.html() == '') {
      $.ajax ({
        url: "../php/get_all_comments_profile.php",
        type: "POST",
        data: ({
          news_id: news_id
        }),
        dataType: "html", // || html
        beforeSend: funcBefore,
        success: funcSuccess
      });
    } else {
      about_post.css('display', 'block');
      comment_before.addClass('comment_hover_before');
    }
    $(this).mouseleave(function(){
      about_post.css('display', 'none');
      comment_before.removeClass('comment_hover_before');
    });
  });
});
