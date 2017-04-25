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
    <title>Success Point | Home Page</title>
    <meta name="keywords" content="Online free questions and answers, giving the user the priviledge to set the number of question to asnwer at their defined minutes" />
    <meta name="description" content="Free Online Questions and answers for UTME, Post UTME, scholarship, and many other programmes, featuring countdown time." />
    <meta name="Author" content="PhilTech">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel='stylesheet' type="text/css" href='css/chosen.css'>
    <link rel="stylesheet" type="text/css" href="css/jquery.countdown.css"> 
<style type="text/css">

</style>
</head>
<body id="home">
<?php include_once 'includes/template/analyticstracking.php';?>
    <div class="container-fluid head-wrap">
      <?php require_once 'includes/template/header.php';?>
      <?php require_once 'includes/template/links.php';?>       
    </div><!--Header Wrap Close -->

    
    <div class="container-fluid content-wrap">
        <div class="container">
            <div class="col-md-offset-1 col-md-10 content">
                <div class="content-box">
                    
                    <div class="well well-lg mid">
                        <h4>Hi welcome <?php echo ucwords(escape($data->username))?> we are happy to see you.</h4>
                    </div>
                    <div class="well well-sm">
                        <article>
                          <h3 class="mid"><strong>Instruction</strong></h3><br>
                          <p class="mid">The system is consciously built to meet your desire.
                              For now there are two(2) basic categories of you attempting the questions in this system
                          </p>
                          <p>
                          <ol>
                            <li>Default Setting</li>
                            <li>Personallized Settings</li>
                          </ol>
                          <ol>
                            <li><h4><strong>Default Setting</strong></h4>
                              The allocated time for this is 60 minutes, and you will also be attempting 60 questions
                              which would be randomized out of over 400 questions in the subject you choose.<br />
                              <strong>NOTE:</strong><code> You will be re-directed to the questions page after you
                              have clicked on the default settings button after 3 seconds, so be ready!</code>
                            </li>
                            <li><h4><strong>Personalized Setting</strong></h4>
                              The developer of the system feel you want want to go an extra-mile doing more questions
                              or less questions than the default setting, that is why you can personalized the number
                              of questions, the time you wish to answer the questions on the subject you choose.
                              <strong>NOTE:</strong><code> You will be re-directed to the questions page after you
                              have clicked on the Save Settings button after 3 seconds, so be ready!</code>
                              
                            </li>
                          </ol>                         

                          </p>
                        </article>
                    </div>
                    <div class="row alert alert-danger" role="alert">
                      <div id="status"></div>
                      <form role="form">
                        <div class="col-xs-6 col-md-4">
                          <div class="control-group">
                              <label class="control-label" for="selectError2">Choose Exam Type</label>
                              <div class="controls">
                                  <select name="subject" id="subject" data-placeholder="Choose Subject Based on Exam Category" class="chosen-select" tabindex="5">
                                    <option value=""></option>
                                    <optgroup label="UTME">
                                      <option value="utme_english">English Language</option>
                                      <option value="utme_biology">Biology</option>
                                      <option value="utme_physics">Physics</option>
                                      <option value="utme_maths" disabled>Mathemathics</option>
                                      <option value="utme_geography" disabled>Geograpghy</option>
                                      <option value="utme_chemistry" disabled="">Chemistry</option>
                                      <option value="utme_yoruba" disabled>Yoruba Language</option>
                                    </optgroup>
                                    <optgroup label="POST-UTME" disabled="">
                                      <option value="post_maths">Mathemathics</option>
                                      <option value="post_english">English Languge</option>
                                      <option value="post_geography">Geograpghy</option>
                                      <option value="post_physics">Physics</option>
                                      <option value="post_chemistry">Chemistry</option>
                                      <option value="post_yoruba">Yoruba Language</option>
                                    </optgroup>                          
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                          <div class="control-group"></div>
                            <label class="control-label" for="labelError2">Duration of time</label>
                            <div class="controls">
                              <select name="minutes" id="minutes" data-placeholder="Time to answer your question" class="chosen-select" tabindex="6">
                                <option value=""></option>
                                <option value="10">10 minutes</option>
                                <option value="20" >20 minutes</option>
                                <option value="30" >30 minutes</option>
                                <option value="40" >40 minutes</option>
                                <option value="50" >50 minutes</option>
                                <option value="60">60 minutes</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                          <div class="control-group">
                              <label class="control-label" for="selectError2">No of Question you wish</label>
                              <div class="controls">
                                  <select name="questions" id="questions" data-placeholder="No of questions" class="chosen-select" tabindex="5">
                                      <option value=""></option>
                                      <option value="10">10 questions</option>
                                      <option value="20" >20 questions</option>
                                      <option value="30" >30 questions</option>
                                      <option value="40" >40 questions</option>
                                      <option value="50" >50 questions</option>
                                      <option value="60">60 questions</option>
                                  </select>
                              </div>
                          </div>
                        </div>
                      </form>
                    </div>         
                    <br />
                    <div class="timing" style="display:none"></div>
                    <div class="well well-sm mid" id="button_div">
                        <button id="choice" type="button" class="btn btn-sm btn-primary">Save Settings &amp; Start Exam</button>
                        <button id="default" type="button" class="btn btn-sm btn-default">Skip Settings &amp; Start Exam</button>
                    </div>
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
<script src="js/chosen.jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.plugin.min.js" type="text/javascript"></script>
<script src="js/jquery.countdown.min_2.js" type="text/javascript"></script>
<script type="text/javascript" src="js/home.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>