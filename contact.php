<?php 
require_once 'core/init.php';
$user = new User();
?>
<?php
if(Input::get('name')) {
    $respond = array( 'type' => 'warning');
    
    //All works fine, now send message
    $date = date('Y');
    $message = Input::get('message');
    $to_email = 'philo4u2c@gmail.com';
    $from_email = Input::get('email');
    $subject = "Contact Reason ".ucwords(Input::get('subject'));
    $headers = "From: Input::get('email')\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $body = '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Email</title>
    </head>
    <body yahoo bgcolor="#f6f8f1" style="margin:0;padding:0;min-width:100%!important">
        <table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table class="content" align="center" style="width:100%; max-width:600px;" cellpadding="0" cellspacing="0" border="1">
                        <tr>
                            <table align="center" border="1" cellpadding="0" cellspacing="0" width="600">
                             <tr>
                              <td align="center" bgcolor="#70bbd9" style="padding-top: 40px;padding-right:0;padding-bottom:30px;padding-left: 0;">
                               <div style="font-size:30px; font-weight:bolder">Success&nbsp;</div><div style="font-size:24px; padding-left:50px; padding-top:0"><em>Point</em></div>
                               
                              </td>
                             </tr>
                             <tr>
                              <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                 <table border="1" cellpadding="0" cellspacing="0" width="100%">
                                  <tr>
                                   <td>
                                    '.$subject.'
                                   </td>
                                  </tr>
                                  <tr>
                                   <td style="padding-top:20px; padding-right:0; padding-bottom:30px;padding-left:0">
                                    '.$message.'
                                   </td>
                                  </tr>
                                 <!-- <tr>
                                   <td>
                                    Row 3
                                   </td>
                                  </tr>
                                  -->
                                 </table>
                                </td>
                             </tr>
                             <tr>
                              <td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
                                 <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                 <tr>
                                  <td width="75%">
                                     &reg; Success Point '.$date.'<br/>
                                     <a target="_blank" href="http://www.successpoint.com.ng/unsubscribe.php?e'.$from_email.'">Unsubscribe to this newsletter instantly</a>
                                  </td>
                                  <td align="right">
                                     <table border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                       <td>
                                        <a target="_blank" href="http://www.twitter.com/realphilo">
                                         <img src="images/twitter.png" alt="Twitter" width="40" height="40" style="display: block;" border="0" />
                                        </a>
                                       </td>
                                       <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                       <td>
                                        <a target="_blank" href="http://www.facebook.com/philtechgroup">
                                         <img src="images/facebook.png" alt="Facebook" width="40" height="40" style="display: block;" border="0" />
                                        </a>
                                       </td>
                                      </tr>
                                     </table>
                                    </td>
                                 </tr>
                                </table>
                              </td>
                             </tr>
                            </table> <!-- center table -->
                        </tr>
                    </table><!--content table -->
                </td>
            </tr>
        </table>
    </body>
</html>';
  if(!@mail( $to_email, $subject , $body, $headers)) {
    $respond['msg'] = 'Sorry Message Could Not Been Sent Now.';
    echo json_encode( $respond );
    exit;
  }else {
    $respond['type'] = 'success';
    $respond['msg'] = 'Message Sent Successfully. Thanks the Admin will get back at you if need arise.';
    echo json_encode( $respond );
    exit;
  }
}
?>
<!DOCTYPE html>
<head>
  <title>Success Point | Contact Us</title>
  <meta name="keywords" content="Success point contact page, we appreciate your suggestion opinion, and advice." />
  <meta name="description" content="Success point is the best online tutor for having about 1000+ pastquestions and likely questions on UTME, Post UTME, scholarship questions and many more opportunities" />
    <meta name="Author" content="PhilTech">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/favicon.png">
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="philtech-bg-image-2" id="contact">
<?php include_once 'includes/template/analyticstracking.php';?>
  <div class="container-fluid head-wrap">
      <?php require_once 'includes/template/header.php';?>
      <?php require_once 'includes/template/links.php';?>       
    </div><!--Header Wrap Close -->

  <div class="container">
    <div class="col-md-12">     
      <form class="form-horizontal philtech-contact-form-1" role="form" id="contactform">
        <div class="form-group">
          <div class="col-md-8">
            <h3>We would love to hear from you!</h3>
          </div>
        </div>  
        <div id="contactstatus"></div>
        <div class="row">
               <div class="col-md-6">               
                <div class="form-group">
                        <label for="name" class="control-label">Name *</label>
                        <div class="philtech-input-icon-container">
                          <i class="fa fa-user"></i>
                          <input type="text" class="form-control" id="name" name="name" placeholder="" autofocus="autofocus">
                        </div>                                                
                      </div>              
                  </div>  
              <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="control-label">Email *</label>
                    <div class="philtech-input-icon-container">
                      <i class="fa fa-envelope-o"></i>
                      <input type="email" class="form-control" id="email" name="email" placeholder="">
                    </div>
                  </div>
              </div>
        </div>      
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="website" class="control-label">Website (optional)</label>
                    <div class="philtech-input-icon-container">
                      <i class="fa fa-globe"></i>
                      <input type="text" class="form-control" id="website" name="website" placeholder="">
                    </div>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="subject" class="control-label">Subject *</label>
                    <div class="philtech-input-icon-container">
                      <i class="fa fa-info-circle"></i>
                      <input type="text" class="form-control" id="subject" name="subject" placeholder="">
                    </div>
                </div>
              </div>    
            </div>            
                        
            <div class="col-md-12">
              <div class="form-group">
                  <label for="message" class="control-label">Message *</label>
                  <div class="philtech-input-icon-container">
                    <i class="fa fa-pencil-square-o"></i>
                    <textarea rows="8" cols="50" class="form-control" id="message" name="message" placeholder=""></textarea>
                  </div>
                </div>
            </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="captcha Operation"></label>
                        <div class="form-group">
                        <label class="col-md-4 control-label" id="captchaOperation"></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="captcha" />
                            </div>
                        </div>  
                    </div>                    
                    <div class="col-md-6"> 
                        <label for="burron" class="coltrol-label"></label>
                        <div class="form-group">
                            <input type="submit" value="Send message" class="btn btn-success col-md-12 pull-right">
                        </div>
                    </div>              
                </div>            
          </form>         
    </div>
  </div>
  <div id="back-top">
    <a href="#header"><i class="fa fa-chevron-up"></i></a>
  </div>
  <?php include_once 'includes/template/footer.php';?>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="js/contact.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</script>
</body>
</html>