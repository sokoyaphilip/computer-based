<?php
require_once 'core/init.php';
$db = new DB();
$user = new User();
$app = new Application();
?>
<!DOCTYPE html>
<html lamg="en">
<head>
    <meta charset="utf-8" />
    <title>Success Point | 2015 UTME English Past Question</title>
    <meta name="keywords" content="2015 UTME (The last Days At Forcados High School Full Tutorial )" />
    <meta name="description" content="Get the best out of 2015 UTME, by studing the most likely questions asked." />
    <meta name="Author" content="PhilTech (Sokoya Adeniji Philip)">
    <meta name="robots" content="tutorial, follow" />
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/datatables.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-editable.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="tutorial">
    <div class="container-fluid head-wrap">
      <?php require_once 'includes/template/header.php';?>
      <?php require_once 'includes/template/links.php';?>       
    </div><!--Header Wrap Close -->

    
    <div class="container-fluid content-wrap">
        <div class="container">
            <div class="col-md-offset-1 col-md-10 content">
                <div class="content-box header">
                    <section id="summary col-md-12">
                        <h3 class="well well-md mid">General Summary of 'The Last Days At Forcados High School'</h3>
                       <p class="text-justify margin-bottom-15">The last days at Forcados high school is the 
                       recommended text by JAMB for the 2015 examination, under this summary section we have compiled
                       the characters in this book and the roles they played. Please note we implore you to login and practice
                       some of the likely questions.</p>
                       
                       <?php include_once 'includes/template/summary_table.php'; ?>                 
                    </section>
                </div>
            </div>
                <section>
                    <div class="col-md-12 mid">
                        <a href="http://www.qservers.net/process/aff.php?aff=155"><img src="https://www.qservers.net/affiliates/images/728x90.gif" width="728" height="90" border="0"></a>
                    </div>
                </section>
            <div class="col-md-offset-1 col-md-10 content">
                <div class="content-box header">
                    <section id="qna">
                        <h3 class=" well mid">Questions And Answer For The CBT JAMB (FROM LAST DAYS AT FORCADO HIGH SCHOOL)</h3>
                        <h4><strong>Note:</strong><code>Do not use BECAUSE to start a sentence, login to attempt more of the likely questions</code></h4>
                        <div class="container-fluid">
                            <?php include_once 'includes/template/qna.php';?>
                            <section id="disqus comment">
                                <div id="disqus_thread"></div>
                                  <script type="text/javascript">
                                      /* * * CONFIGURATION VARIABLES * * */
                                      var disqus_shortname = 'successpoint';
                                      
                                      /* * * DON'T EDIT BELOW THIS LINE * * */
                                      (function() {
                                          var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                          dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                          (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                      })();
                                  </script>
                                  <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
                            </section>
                        </div> <!-- container-fluid -->
                    </section>
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
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/datatables.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">
$(document).ready( function () {
  $('#character').DataTable();
});
</script>
</body>
</html>