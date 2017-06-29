$(document).ready(function(){
  function funcBefore() {

  }
  function funcSuccess(data) {
    // console.log(data);
    var dataInfo = data.split('/');
    $('#rait-counter').html(dataInfo[0]);
    // $('#rait-counter').html(data);
    if (dataInfo[1] == 1) {
      $('#rait-plus').css('opacity', '.8');
      $('#rait-minus').css('opacity', '.2');
    } else if (dataInfo[1] == -1) {
      $('#rait-plus').css('opacity', '.2');
      $('#rait-minus').css('opacity', '.8');
    } else if (dataInfo[1] == 0) {
      $('#rait-plus').css('opacity', '.2');
      $('#rait-minus').css('opacity', '.2');
    } else {

    }
  }
  $('#rait-plus').click(function(){
    var idNews = $('#rait_news_id').val(),
        idUser = $('#rait_user_id').val();
        if(idUser) {
          $.ajax ({
            url: "../php/raiting.php",
            type: "POST",
            data: ({
              id_news: idNews,
              id_user: idUser,
              rait: 1
            }),
            dataType: "html", // || html
            beforeSend: funcBefore,
            success: funcSuccess
          });
        } else {
          getIn();
        }
  });
  $('#rait-minus').click(function(){
    var idNews = $('#rait_news_id').val(),
        idUser = $('#rait_user_id').val();
        if(idUser) {
          $.ajax ({
            url: "../php/raiting.php",
            type: "POST",
            data: ({
              id_news: idNews,
              id_user: idUser,
              rait: -1
            }),
            dataType: "html", // || html
            beforeSend: funcBefore,
            success: funcSuccess
          });
        } else {
          getIn();
        }
  });
});
