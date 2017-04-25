$(document).ready( function() {
  //chosen - improves select
  $('.chosen-select').chosen({
      no_results_text: "Oops, nothing found!",
      allow_single_deselect: true
  });

  //Subject selected
  $('select[name=subject], select[name=minutes], select[name=questions]').on('change', function() {
    showLabel();
  });
  // fire on page load
  $('#subject').change();
  $('#minutes').change();
  $('#questions').change();

});
var subject = ''; var minute = question = 60;
function showLabel() {
    // Subject
    var subject_selected = $('#subject :selected');
    subject = subject_selected.attr('value');
    // Minutes
    var minute_selected = $('#minutes :selected');
    minute = minute_selected.attr('value');
    //question
    var question_selected = $('#questions :selected');
    question = question_selected.attr('value');
    //alert('Selected Subject: ' + subject + 'Selected Minute: ' + minute + 'Question: ' + question);
}
$(document).ready(function () {
  $('#default').on('click', function() {
    //validate
    var s = $('#subject :selected').attr('value');
    if( s == '') {
      $('#status').html('<p class="alert alert-warning"> You Must Select A subject</p>').slideDown().delay(3000).slideUp();
      return false;
    }
    $('#button_div').fadeOut('fast');
    $('.timing').css('display','block');
    $('.timing').countdown({
        until: +2, 
        expiryUrl: 'exam.php?qtype='+s,
        description: 'Hello! you will be re-directed to your exam question in less than 3 seconds'
    }); 
  });// default buton
});
$(document).ready(function () {
  $('#choice').on('click', function() {
    //validate
    var s = $('#subject :selected').attr('value');
    var m = $('#minutes :selected').attr('value');
    var q = $('#questions :selected').attr('value');
    if( s == '') {
      $('#status').html('<p class="alert alert-warning"> You Must Select A subject</p>').slideDown().delay(3000).slideUp();
      return false;
    } else if ( m == '') {
      $('#status').html('<p class="alert alert-warning"> Please Select the Minute for this question</p>').slideDown().delay(3000).slideUp();
      return false;
    } else if ( q == '') {
      $('#status').html('<p class="alert alert-warning"> Please select the number of question</p>').slideDown().delay(3000).slideUp();
      return false;
    }else {
      $('#button_div').fadeOut('slow');
      $('.timing').css('display','block');
      $('.timing').countdown({
        until: +2, 
        expiryUrl: 'exam.php?qtype='+s+'&m='+m+'&q='+q,
        description: 'Hello there you will be directed to your exam question in less than'
      }); 
    }
  });//End of choice
});