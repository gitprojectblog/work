var offScroll = true,
    counter = 10;
$(document).ready(function(){
  $('#scroll_top').click(function(){
    $('html, body').animate({scrollTop: 0}, 400);
  });
  $(window).scroll(function(){
    var scJsScrollTop = $(window).scrollTop(), // a
        scJsWindowHei = $(window).height(),   // b
        scJsDocOutHei = $(document).outerHeight(); // sum a + b

    // console.log(scJsScrollTop);
    // console.log(scJsWindowHei);
    // console.log(scJsDocOutHei);
    // console.log(offScroll);
    // console.log(counter);

    if (offScroll) {
      if (scJsScrollTop + scJsWindowHei + 400 > scJsDocOutHei) {
        offScroll = false;
        $.ajax ({
          url: "../php/scroll_get_content.php",
          type: "POST",
          data: ({
            path: window.location.pathname,
            counter: counter
          }),
          dataType: "html", // || html
          beforeSend: funcBefore,
          success: funcSuccess
        });
      }
    }

  });
});

function funcBefore() {

}
function funcSuccess(data) {
  $('#content_left').append(data);
  counter += 10;
  offScroll = true;
}
