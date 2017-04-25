<?php
require_once 'core/init.php';
$db = new DB();

$user = new User;
if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}else {
    $data = $user->data();
}
?>
<!DOCTYPE html>
<html lamg="en">
<head>
    <meta charset="utf-8" />
    <title>Succes Point | Admin</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="Author" content="PhilTech">
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- bootstrap wysihtml5 - text editor -->
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="add_page">
    <div class="container-fluid head-wrap">
      <?php require_once 'includes/template/header.php';?>
      <?php require_once 'includes/template/links.php';?>       
    </div><!--Header Wrap Close -->
    
     <div class="container-fluid content-wrap">
        <div class="container">
            <div class="col-md-offset-1 col-md-10 content">
                <div class="content-box">                       
                    <div class="pull-right">Welcome Admin</div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#post" role="tab" data-toggle="tab">Add New Post</a></li>
                        <li><a href="#question" role="tab" data-toggle="tab">Question</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="post">
                            <form role="form" id="news_form" class="form-horizontal well" enctype="mulitpart/form-data" onsubmit="return false;">
                            <div id="newsstatus"></div>
                                <div class="form-group">
                                    <label for="title" class="control-label">Blog Title</label>
                                    <input type="text" id="newstitle" name="newstitle" class="form-control" class="col-md-12" placeholder="News Title Here" autofocus="autofocus" required>
                                </div>
                                <div class="form-group">
                                    <label for="newscontent">Blog Content</label>
                                    <textarea class="form-control wysiwyg col-mid-12" rows="10" name="newscontent" placeholder="Place News Content Here" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="newscoverphoto">Upload A Cover Photo</label>
                                        <input type="file" name="newscoverphoto" id="newscoverphoto" />
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <label for="button"></label>
                                        <button id="news_button" type="submit" class="btn btn-default col-md-8 pull-right">Upload News</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                         <!--End of questions tab -->
                        <div class="tab-pane" id="question">
                            <form role="form" id="add-question-form" class="form-horizontal well" enctype="mulitpart/form-data" onsubmit="return false;">
                            <div id="questionstatus"></div>
                                <div class="form-group">
                                    <label for="upload" class="col-md-offset-2 col-md-2 control-label">Upload</label>                                    
                                    <div class="col-md-6">
                                        <input type="file" id="question" name="question" required>                                        
                                        <p class="help-block">Please upload only in CSV/Excel format</p>
                                        <a href="#" data-toggle="modal" data-target="#myModal">Preview Example</a>
                                    </div>
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Example of CSV Format</h4>
                                          </div>
                                          <div class="modal-body">
                                            <p>CSV files can be created using Microsoft Excel and data should be inputed using this format only... S/N, Matric Number, Password, Full Name</p>
                                            <img src="../images/csv_screenshot.jpg" width="100%">
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="col-md-offset-4 col-md-6 status alert alert-warning alert-dismissible" id="status" role="alert"></span>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-6">
                                      <button type="submit" id="add_questions" name="add_questions" class="btn btn-primary button-loading" data-loading-text="Loading...">Add Questions Using Csv/excel Format</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- Tabcontent -->
                </div>
                <div class="col-md-12 base-effect"></div>
            </div>
        </div>
    </div>
    <div id="back-top">
      <a href="#header"><i class="fa fa-chevron-up"></i></a>
    </div>
    <?php include_once 'includes/template/footer.php';?>
    
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script src="js/bootstrap/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".wysiwyg").wysihtml5();
  $('#add_questions').click( function () {

  var m_data = new FormData();
  m_data.append( 'question', $('input[name=question]')[0].files[0]);
  m_data.append( 'add_questions', $('button[name=add_questions]'));

    //instead of $.post() we are using $.ajax()
    //that's because $.ajax() has more options and flexibly.
    $.ajax({
      url: 'includes/import.php',
      data: m_data,
      cache: false,
      processData: false,
      contentType: false,
      type: 'POST',
      dataType: 'json',
      success: function(response){
         //load json data from server and output message 
         $('#add-question-form').trigger("reset");
        alert = '<p class="alert alert-'+response.type+'">'+response.msg+'</p>';
        $("#questionstatus").html(alert).slideDown().delay(2000).slideUp();
      }
    });

   }); //End of adding question

  $('#news_button').click(function() {
    $(this).attr('disabled','disabled');
    if($('#newscontent').val() == '' || $('#newstitle').val() == '') {
        alert = '<p class="alert alert-danger">News Title and Content Can not Be Empty</p>';
        $('#newsstatus').html(alert).slideDown().delay(3000).slideUp();
        $('#news_button').removeAttr('disabled');
        return false;
    }
    var newsdata = new FormData();
    newsdata.append( 'title', $('input[name=newstitle]').val());
    newsdata.append( 'content', $('textarea[name=newscontent]').val());
    newsdata.append( 'file', $('input[name=newscoverphoto]')[0].files[0]);

    $.ajax({
        url: 'includes/news.php',
        data: newsdata,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'json',
        success: function(response){
            //load json data from server and output message 
            if( response.type == 'success'){
                alert = '<p class="alert alert-'+response.type+'">'+response.msg+'</p>';
                $("#newsstatus").html(alert).slideDown().delay(2000).slideUp();
                $('#news_form').trigger("reset");
            }
            alert = '<p class="alert alert-'+response.type+'">'+response.msg+'</p>';
            $("#newsstatus").html(alert).slideDown().delay(300).slideUp();

        }
    });//Ajax
  });
});
</script>
</body>
</html>