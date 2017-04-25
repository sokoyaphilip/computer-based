$(document).ready(function() {
    doFunction();
   // hide #back-top first
    $("#back-top").hide();
    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
    });
}); //document
function doFunction(){
    //bootstrap WYSIHTML5 - text editor
    text = '<p><strong>SITE STILL UNDER DEVELOPMENT</strong><br /></p>';
    text += '<ul><li><a target"_blank" href="http://www.philtechgroup.net" title="With The Power 0 and 1">Designed and Developed By PhilTech Group</a></li></ul>'
    $('.c').html(text)
}
$(function() {

    //Automatic highlight the current nav
    $("#home a:contains('Home')").parent().addClass('active');
    $("#blog a:contains('Blog')").parent().addClass('active');
    $("#contact a:contains('Contact')").parent().addClass('active');
    $("#exam a:contains('Exam')").parent().addClass('active');
    $("#tutorial a:contains('Tutorial')").parent().addClass('active');
    $("#add_page a:contains('Add')").parent().addClass('active');

    //drowdown function
    $('ul.nav li.dropdown').hover( function() {
        $('ul.drop', this).fadeIn();
    }, function() {
        $('ul.drop', this).fadeOut(100);
    });
}); 