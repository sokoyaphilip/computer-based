
    jQuery(document).ready(function() {
      function fbpopupdatafunc()  {
      var sec = 30
      var timer = setInterval(function() {
        $("#fbpopupdatafooter span").text(sec--);
          if (sec == 0) {
            $("#fbpopupdata").fadeOut("slow");
            clearInterval(timer);
          }
        },1000);
      var fbpopupdatawindow = jQuery(window).height();
      var fbpopupdatadiv = jQuery("#fbpopupdata").height();
      var fbpopupdatatop = jQuery(window).scrollTop()+50;
      jQuery("#fbpopupdata").css({"top":fbpopupdatatop});}
      jQuery(window).fadeIn(fbpopupdatafunc).resize(fbpopupdatafunc)
      //alert(jQuery.cookie('sreqshown'));
      //var fbpopupdataww = jQuery(window).width();
      //var fbpopupdatawww = jQuery("#fbpopupdata").width();
      //var fbpopupdataleft = (fbpopupdataww-fbpopupdatawww)/2;
      var fbpopupdataleft = 500;
      //var fbpopupdatawindow = jQuery(window).height();
      //var fbpopupdatadiv = jQuery("#fbpopupdata").height();
      //var fbpopupdatatop = (jQuery(window).scrollTop()+fbpopupdatawindow-fbpopupdatadiv) / 2;
      jQuery("#fbpopupdata").animate({opacity: "1", left: "0" , left:  fbpopupdataleft}, 0).show();
      jQuery("#fbpopupdataclose").click(function() {
      jQuery("#fbpopupdata").animate({opacity: "0", left: "-5000000"}, 1000).show();});});
