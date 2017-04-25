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
    <title>Success Point | 404 page</title>
    <meta name="keywords" content="Success Point is a one stop online forum for latest news on secondary, tetiary instuition, scholarship, gist featurings utme, post utme news,scholarship and online tutor" />
    <meta name="description" content="An online educational resource website" />
    <meta name="robots" content="index, nofollow" />
    <meta name="Author" content="PhilTech">
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- bootstrap wysihtml5 - text editor -->
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
<?php include_once '../template/analyticstracking.php';?>
    <div class="container-fluid head-wrap">
        <?php include_once '../template/header.php';?>
        <?php include_once '../template/links.php';?>
    </div><!--Header Wrap Close -->
    
     <div class="container-fluid content-wrap">
        <div class="container">
            <div class="col-md-offset-1 col-md-10 content">
                <div class="content-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mid error-404">
                                <section class="text-center">
                                    <h1>Error 404</h1>
                                    <h2>Page not found</h2>
                                    <p class="lead lead-lg">The requested URL was not found on this server. That is all we know.</p>
                                    <p><a href="javascript:window.history.back()" class="btn btn-block btn-lg btn-success">Go Back <span class="fa fa-up"></span></a href="javascript:window.history.back()"></p>
                                </section>
                            </div>
                        </div>
                    </div> <!-- row -->
                </div>
                <div class="col-md-12 base-effect"></div>
            </div>
        </div>
    </div>
    <div id="back-top">
      <a href="#header"><i class="fa fa-chevron-up"></i></a>
    </div>
    <?php include_once '../template/footer.php';?>
    
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>