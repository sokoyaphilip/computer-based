<?php
require_once '../../core/init.php';

$db = new DB();
$user = new User;
$data = $user->data();
?>
<!DOCTYPE html>
<html lamg="en">
<head>
    <meta charset="utf-8" />
    <title>Online Based Examination System</title>
    <meta name="keywords" content="" />
    <meta name="description" content="An Online Based Examination System" />
    <meta name="Author" content="PhilTech">
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- bootstrap wysihtml5 - text editor -->
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include_once 'includes/template/analyticstracking.php';?>
    <div class="container-fluid head-wrap">
        <div class="container">
            <div class="col-md-offset-1 col-md-10 head">
                <div class="col-md-5 head-title">
                    <h1>OBES</h1>
                    <p>An Online Based Examination System</p>
                </div>
            </div>
        </div>
        <?php include_once '../template/links.php';?>
    </div><!--Header Wrap Close -->
    
     <div class="container-fluid content-wrap">
        <div class="container">
            <div class="col-md-offset-1 col-md-10 content">
                <div class="content-box">
                   <div class="col-md-12">
                        <div class="center-block error-404">
                            <section class="text-center">
                                <h1>Error 500</h1>
                                <h2>Internal Server Error</h2>
                                <p class="lead lead-lg">Something has gone wrong we are trying to fix it.</p>
                            </section>
                            <section>
                                <form role="form" id="center-form">
                                    <div class="form-group">
                                        <input class="form-control input-lg" type="text" placeholder="Search here">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-lg btn-success">Search</button>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div><!-- col-md-12 -->
                </div>
                <div class="col-md-12 base-effect"></div>
            </div>
        </div>
    </div>
    <div id="back-top">
      <a href="#header"><i class="fa fa-chevron-up"></i></a>
    </div>
    <div class="container-fluid footer-wrap">
        <div class="container">
            <div class="col-md-offset-1 col-md-10 footer">
                <span class="c"></span>
            </div>
        </div>
    </div>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>