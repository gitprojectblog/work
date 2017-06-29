$(document).ready(function(){
  $('#load_all_posts').click(function(){
    var json_posts = $('#json_posts').val();
    function funcBefore() {

    }
    function funcSuccess(data) {
      $('#posts_all').html(data);
    }
    $.ajax ({
      url: "../php/get_all_posts_profile.php",
      type: "POST",
      data: ({
        json: json_posts
      }),
      dataType: "html", // || html
      beforeSend: funcBefore,
      success: funcSuccess
    });
  });
});
