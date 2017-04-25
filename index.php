<?php

//require && instantiate
require 'core/init.php';
$validate = new Validate();
$user = new User();
$db = new DB();
if($user->isLoggedIn()) {
    Redirect::to('home.php');
}
if( Input::get('login') ) {
  $validation = $validate->check($_POST, array(
        'username'     => array('required' => true),
        'password'  => array('required' => true),
    ));
    if($validation->passed()) {

        $remember = (Input::get('remember') === 'on') ? true : false;
        //Log user in
        $login = $user->login(strtolower(Input::get('username')), strtolower(Input::get('password')), $remember);
        
        if( $login ) {
            $respond['status'] =  'success';
            $respond['msg'] = trim(strtolower(Input::get('username')));
            echo json_encode( $respond );
            exit;
        } else {
            $respond['status'] = "warning";
            $respond['msg'] = 'Invalid Credentials Provided';
            echo json_encode( $respond );
            exit;
        }
    } else {
        foreach($validation->errors() as $error) {
          $respond['msg'] .=  $error.'<br />';
        }
        echo json_encode( $respond );
        exit;
    }
}
?>
<?php
if(Input::get('create')) {
    $respond = array( 'type' => 'warning');
    $respond['msg'] = '';
    $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'email' => array(
                'required'  => true,
                'min'       => 3,
                'max'       => 30,
                'unique'    => 'users'
            ),
            'username'  => array(
                'required'  => true,
                'min'       => 2,
                'max'       => 20,
                'unique'    => 'users'                
            ),  
            'fullname' => array(
                'required'  => true,
                'min'       => 3,
                'max'       => 20
            ),
            'password'          => array(
                'required'  => true,
                'min'       => 6
            ),

            'password_confirm'  => array(
                'required'  => true,
                'matches'   => 'password'
            )
        ));
    if( $validation->passed() ){
        $user = new User();
        $salt = Hash::salt(32);
        try {
            $user->create(array(
                'fullname' => ucwords(Input::get('fullname')),
                'email'     => Input::get('email'),
                'username'  => Input::get('username'),
                'password' => Hash::make(strtolower(Input::get('password')), $salt),
                'salt' => $salt,
                'lastlogin' => date('Y-m-d H:i:s'),
                'ip'    => getenv('REMOTE_ADDR'),
                'joined' => date('Y-m-d H:i:s')
                ));
            //Message success
            $respond['type'] = 'success';
            $respond['msg'] = 'You have successfully register, click on the login tab to login';
            echo json_encode( $respond );
            exit();

        } catch(Exception $e) {
            die($e->getMessage());
            $respond['msg'] = 'Ooops, something went wrong while creating your account!';
            echo json_encode( $respond );
            exit;
        }
    }else {
        
        foreach($validation->errors() as $error){
            $respond['msg'] .= $error. '<br>';
        }
         echo json_encode( $respond );
         exit;
    }
}
?>
<?php
if(Input::get('retrieve_password')){
    $respond = array( 'status' => 'warning');
    $emailfinder = $user->emailfinder(Input::get('retrieveemail'));
    if( $emailfinder ){
        //All works fine, now send message
        //get the user username //VERY ROUGH HERE BUT WOULD DO IT LATER BY HIS GRACE 
        $e = Input::get('retrieveemail');
        $idfind = $db->query("SELECT id FROM users WHERE email = '$e'");
        $id = $idfind->first();
        $new_password = "pass".date('ms');
        $salt = Hash::salt(32);
        try {          
            
            $user->update( $id->id, array(
            'password' => Hash::make( $new_password, $salt),
            'salt' => $salt
            ));
            $respond['status'] = 'success';
            $respond['msg'] = 'Please use this as temporary password <strong>"'.$new_password .'"</strong><br />we adbice that you keep it safe for you will be using it to login';
            echo json_encode( $respond);
            exit;
        } catch (Exception $e) {
            $respond['msg'] = $e->getMessage();
            echo json_encode($respond);
            exit();
            //echo "Error (File )".$e->getFile().", line ".
                //    $e->getLine(). ") : ".$e->getMessage();
        }

    } //end of email finder
    $respond['msg'] = 'Email is not valid or active.';
    echo json_encode($respond);
    exit();
}
?>
<!DOCTYPE html>
<html lamg="en">
<head>
    <meta charset="utf-8" />
    <title>Success Point | Welcome Page</title>
    <meta name="keywords" content="Success Point is a one stop online forum for latest news on secondary, tetiary instuition, scholarship, gist featurings utme, post utme news,scholarship and online tutor" />
    <meta name="description" content="Success point is the best online tutor for having about 1000+ pastquestions and likely questions on UTME, Post UTME, scholarship questions and many more opportunities" />
    <meta name="robots" content="index, follow" />
    <meta name="Author" content="PhilTech">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrapValidator.css">
<style type="text/css">
</style>
</head>
<body>
<?php include_once 'includes/template/analyticstracking.php';?>
    <div class="container-fluid head-wrap">
        <?php include_once 'includes/template/header.php';?>
        <?php include_once 'includes/template/links.php';?>
    </div><!--Header Wrap Close -->

    <div class="container-fluid content-wrap">
        <div class="container">
            <div class="col-md-12 ">
                <div class="row">
                    <div class="content col-md-6 ">
                        <div class="content-box" id="systemintroduction">
                            <article>
                                <h4>Brief description of the system</h4><hr />
                               <p class="text-justify margin-bottom-15"><strong>Success Point</strong> is designed to richly meet the needs of
                               anyone hoping to write a CBT exam, be it UTME, Post UTME, Polytechnic, College and Scholarship exams e.t.c
                               Success Point has over 500+ questions and still counting on each categories: mathematics; physics; geography; general knowledge questions; current affairs;
                               and so on and so forth... All you need to do is to login and attempt the questions based on the
                               category of questions, number of questions, and number of time you feel you can answer the questions.
                               And at the end you get to see your total score and view explanations on the one you missed.
                               </p>
                            </article>                                
                        </div><!-- system introduction -->
                        <div class="col-md-12 base-effect"></div>
                    </div> <!--content-->

                    <div class="content col-md-6">
                        <div class="content-box" id="loginbox">
                            <ul class="nav nav-tabs nav-tabs-ar">
                                <li class="active"><a href="#login" data-toggle="tab"><i class="fa fa-flag">&nbsp;</i>Login</a></li>
                                <li><a href="#register" data-toggle="tab"><i class="glyphicon glyphicon-check">&nbsp;</i> Register</a></li>
                                <li><a href="#retrieve_password" data-toggle="tab"><i class="fa fa-lock">&nbsp;</i> Retrieve My Password</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                            <div class="tab-pane active" id="login">
                               <form id="login_form" class="form-signing" role="form" onsubmit="return false;">
                                    <h2 class="form-signin-heading" style="text-align:center;">Welcome</h2>
                                    <div id="loginstatus"></div>
                                    <div class="form-group">
                                        <div class="philtech-input-icon-container">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="" autofocus="autofocus">
                                        </div>                                                          
                                    </div>   
                                    <div class="form-group">
                                        <div class="philtech-input-icon-container">
                                            <i class="fa fa-lock"></i>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label for="remember">
                                              <input name="remember" type="checkbox"> Remember me
                                            </label>
                                        </div>                            
                                    </div> 
                                    <div class="col-md-12">
                                        <input type="hidden" name="login" value="login">
                                        <button type="submit" class="btn btn-md btn-danger btn-block">Log In</button>
                                    </div>                          
                                </form>
                            </div> <!--End of login tab--> 
                            <!-- Start Register tab-->
                            <div class="tab-pane" id="register">
                                <form role="form" id="register_form" method="post">
                                    <h2 class="form-signin-heading text-center">1 Minute Registration</h2>
                                    <div id="registerstatus"></div>
                                    <div class="row">
                                        <div class="col-md-6">                    
                                        <div class="form-group">
                                            <label for="fullname" class="control-label">Full-Name *</label>
                                            <div class="philtech-input-icon-container">
                                                <i class="fa fa-user"></i>
                                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Full name" autofocus="autofocus">
                                            </div>                                                          
                                        </div> 
                                        </div>
                                        <div class="col-md-6">                    
                                            <div class="form-group">
                                                <label for="username" class="control-label">Username *</label>
                                                <div class="philtech-input-icon-container">
                                                    <i class="fa fa-user"></i>
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                                </div>                                                          
                                            </div>                         
                                        </div>    
                                    </div><!-- row -->
                                    <div class="col-md-12">                   
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email *</label>
                                            <div class="philtech-input-icon-container">
                                                <i class="fa fa-envelope-o"></i>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="A valid Email Address">
                                            </div>
                                        </div>            
                                    </div> <!-- email -->          
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password" class="control-label">Password *</label>
                                            <div class="philtech-input-icon-container">
                                                <i class="fa fa-lock"></i>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirm" class="control-label">Password Confirm*</label>
                                            <div class="philtech-input-icon-container">
                                                <i class="fa fa-lock"></i>
                                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Re-type your password">
                                            </div>
                                        </div>                                
                                        </div>
                                    </div> <!-- row -->
                                    <br />
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" name="create" value="create" />
                                            <label for="button"></label>
                                            <input type="submit" value="Create My Account" class="btn btn-md btn-danger btn-block">
                                        </div>
                                    </div>                 
                                </form>      
                            </div> <!-- End Register tab-->   
                            <div class="tab-pane" id="retrieve_password">
                               <form id="retrieve_form" class="form-signing" role="form" onsubmit="return false;">
                                    <h2 class="form-signin-heading mid">Retrieve Your Password</h2>
                                    <div id="retrievestatus"></div>
                                    <div class="form-group">
                                        <div class="philtech-input-icon-container">
                                            <i class="fa fa-lock"></i>
                                            <input type="email" class="form-control" id="retrieveemail" name="retrieveemail" placeholder="Enter your registered email here" autofocus="autofocus">
                                        </div>                                                          
                                    </div> 
                                    <div class="col-md-12">
                                        <input type="hidden" name="retrieve_password" value="retrieve_password">
                                        <button type="submit" class="btn btn-md btn-danger btn-block">Get Password</button>
                                    </div>                          
                                </form>
                            </div><!-- End of retrieve-->  
                            </div>
                        </div><!-- introduction -->
                        <div class="col-md-12 base-effect"></div>
                    </div>
                </div><!-- row -->
            </div> <!-- col-md-12 -->
        </div> <!-- container -->
    </div><!-- container-fluid -->
    <div id="back-top">
      <a href="#header"><i class="fa fa-chevron-up"></i></a>
    </div>
    <?php include_once 'includes/template/footer.php';?>
    
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</script>
</body>
</html>