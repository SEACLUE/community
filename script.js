$(function(){
  var close_count = 0;
  var classVal;
  var classVals;
  var name;
  var classes;
  var classVal1;
  var classVals1;
  var name1;
  var classes1;
  $('.contents').click(function(){
    if (close_count == 0) {
      close_count = close_count + 1;
      classVal = $(this).attr('class')
      classVals = classVal.split(' ');
      name = (classVals[0]);
      classes = "." + name + "-page"
      $(classes).slideDown(5000);
      $('header').slideUp(1000);
      $('.introduction').hide();
      $(this).css('border-radius', '90px');
      $('.content-cover').css('position', 'fixed');
      return false;
    } else if (close_count == 1); {
      classVal1 = $(this).attr('class');
      classVals1 = classVal1.split(' ');
      name1 = (classVals1[0]);
      classes1 = "." + name1 + "-page"
      if (classes == classes1) {
        $(classes1).fadeOut(0.0001);
        $(classes1).css('display', '');
        $('header').slideDown(1000);
        $('.introduction').show();
        $(this).css('border-radius', '');
        $('.content-cover').css('position', '');
        close_count = 0;
        return false;
      }else{
        $(classes).fadeOut(0.0001);
        $(classes).css('display', '');
        $('.' + name).css('border-radius', '');
        $(classes1).slideDown(3000);
        $('header').slideUp(1000); 
        $('.introduction').hide();
        $('.' + name1).css('border-radius', '90px');
        $('.content-cover').css('position', 'fixed');
        name = name1;
        classes = classes1;
        return false;
      }
    };
  });
});