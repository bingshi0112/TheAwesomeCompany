$(document).ready(function(){
  var counter_6 = 0; counter_7 = 0; counter_8 = 0; counter_9 = 0; counter_10 = 0;
  var star = 0;
  $('#r6.glyphicon').click(function(){
    if(counter_6 % 2 == 0){
      $("span#r6").css("color", "orange");
      counter_6++;
      star = 1;
    }
    else if(counter_7 % 2 == 0) {
      $("span#r6").css("color", "#ccc");
      counter_6--;
      star--;
    }
  });
  $('#r7.glyphicon').click(function(){
      if(counter_7 % 2 == 0){
        $("span#r6").css("color", "orange");
        $("span#r7").css("color", "orange");
        counter_7++;
        counter_6 = 1;
        star = 2;
      }
      else if(counter_8 % 2 == 0) {
        $("span#r7").css("color", "#ccc");
        counter_7--;
        star--;
      }
  });
  $('#r8.glyphicon').click(function(){
      if(counter_8%2 == 0){
        $("span#r6").css("color", "orange");
        $("span#r7").css("color", "orange");
        $("span#r8").css("color", "orange");
        counter_8++;
        counter_6 = 1; counter_7 = 1;
        star = 3;
      }
      else if(counter_9 % 2 == 0) {
        $("span#r8").css("color", "#ccc");
        counter_8--;
        star--;
      }
  });
  $('#r9.glyphicon').click(function(){
      if(counter_9%2 == 0){
        $("span#r6").css("color", "orange");
        $("span#r7").css("color", "orange");
        $("span#r8").css("color", "orange");
        $("span#r9").css("color", "orange");
        counter_9++;
        counter_6 = 1; counter_7 = 1; counter_8 = 1;
        star = 4;
      }
      else if(counter_10 % 2 == 0) {
        $("span#r9").css("color", "#ccc");
        counter_9--;
        star--;
      }
  });
  $('#r10.glyphicon').click(function(){
      if(counter_10%2 == 0){
        $("span#r6").css("color", "orange");
        $("span#r7").css("color", "orange");
        $("span#r8").css("color", "orange");
        $("span#r9").css("color", "orange");
        $("span#r10").css("color", "orange");
        counter_10++;
        counter_6 = 1; counter_7 = 1; counter_8 = 1; counter_9 = 1;
        star = 5
      }
      else {
        $("span#r10").css("color", "#ccc");
        counter_10--;
        star--;
      }
  });

  $('#btnRate.btn').click(function(){
    var rate;
    var message;
    switch (star) {
      case 1:
        message = '1 star';
        rate = 1;
        break;
      case 2:
        message = '2 stars';
        rate = 2;
        break;
      case 3:
        message = '3 stars';
        rate = 3;
        break;
      case 4:
        message = '4 stars';
        rate = 4;
        break;
      case 5:
        message = '5 stars';
        rate = 5;
        break;
      default:
        message = '0 star';
        rate = 0;
    }
    $('.rateSlideDown').empty();
    $('.rateSlideDown').hide();
    $('.rateSlideDown').append("you rated me " + message);
    $('.rateSlideDown').slideDown();

$.ajax({
      type: "POST",
      cache: false,
      url:'product_userRatingAndReview.php',
      data: {rate: rate}
    });

    });
});
