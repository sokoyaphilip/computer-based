<?php
require_once 'core/init.php';
$db = new DB();
$user = new User();
$app = new Application();
?>
<?php
if( !$pid = Input::get('pid') && $p = Input::get('p')){
  Redirect::to('blog.php');
}
//get the info
$id = filter_var( Input::get('pid'), FILTER_SANITIZE_NUMBER_INT);
if( $app->find('blog', $id) ){
  $post = $app->data();
}else {
    Redirect::to('blog.php');
}
?>
<!DOCTYPE html>
<html lamg="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo $post->title;?></title>
    <meta name="keywords" content="Online Educational forum for secondary schools, Tetriary instuition, with update on news, entainment, scholarship, post utme and more" />
    <meta name="description" content="Get updated from the world at your finger tips" />
    <meta name="Author" content="PhilTech (Sokoya Adeniji Philip)">
    <meta name="robots" content="blog post, follow" />
    <meta property="fb:app_id" content="951926561498646" />
    <meta property="fb:admins" content="1786309652"/>
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="blog-post">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=951926561498646&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php include_once 'includes/template/analyticstracking.php';?>

    <div class="container-fluid head-wrap">
      <?php require_once 'includes/template/header.php';?>
      <?php require_once 'includes/template/links.php';?>       
    </div><!--Header Wrap Close -->
    
    <div class="container-fluid content-wrap">
        <div class="container">
            <div class="col-md-offset-1 col-md-10 content">
                <div class="content-box">
                  <div class="google-ads">
                      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- exam-page-ad -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-4824537889134670"
                             data-ad-slot="1340046546"
                             data-ad-format="auto"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                    <div class="mid margin-bottom-30">
                        
                      <?php 
                        if(!empty($post->newscoverphoto)) { ?>
                          <img src="images/uploads/<?php echo $post->newscoverphoto;?>" class="imageborder img-responsive" width="706" height="336" alt="<?php echo $post->title;?>" title="<?php echo strtolower($post->title);?>">
                      <?php } else { ?>
                          <img src="images/uploads/news.jpg" class="imageborder img-responsive" width="706" height="336" alt="<?php echo $post->title;?>" title="<?php echo strtolower($post->title);?>">
                      <?php 
                        }
                      ?>
                      
                    </div>
                    <div class="margin-bottom-15">
                      <h3><strong><?php echo ucwords($post->title); ?></strong></h3>
                      <small><strong>Posted on: </strong><?php echo strftime("%B %d, %Y", strtotime($post->postdate));?></small> By: <strong><?php echo $post->author?></strong><br />
                    </div>
                    
                    <section class="well well-lg">
                        <p><?php echo $post->content; ?></p>
                    </section>
                    <section class="fb-comment">
                      <?php $currentlink = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>
                      <div class="fb-comments" data-href="<?php echo $currentlink;?>" data-width="900" data-numposts="10" data-colorscheme="light"></div><br />
                      <div class="fb-like" data-href="<?php echo $currentlink;?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                    </section>
                    <section class="disqus">
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
                </div><!-- content -->
                <div class="col-md-12 base-effect"></div>
            </div><!-- col-md-offset-1 col-md-10 content -->
          </div><!-- container -->
        </div><!-- container-fluid content-wrap -->
        <div class="container-fluid content-wrap">
          <div class="container">
              <div class="col-md-offset-1 col-md-10 content">
                <div class="content-box col-md-12 header">
                  <h4 class="section-title">RECOMMENDED STORIES YOU MAY ALSO LIKE</h4>
                  <table border="0">
                    
                  <?php
                    //sql statement
                    $top_output = ''; $x = 0;
                    $tops = $db->query("SELECT * FROM blog ORDER BY postdate DESC limit 6");
                    $x = 0;                    
                    foreach ( $tops->results() as $top ) { 
                      $escape = escape(strtolower(preg_replace('#[^a-z0-9)(.,:!?.]#i', '-', $top->title)));
                      $link = 'blog-post.php?pid='.$top->id.'&amp;p='.$escape;  
                    ?>
                    <div class="row">

                    <?php 
                      if( $x % 2 == 0 ) { ?>
                        <tr>
                          <td>
                              <div class="col-md-12">
                                <div class="media">
                                    <a class="pull-left" href="<?php echo $link?>"><img class="media-object imageborder hidden-xs" src="images/uploads/<?php echo $top->newscoverphoto;?>" width="70" height="70" alt="<?php echo $top->title;?>"></a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="<?php echo $link;?>"><?php echo $top->title; ?></a></h4>
                                      <p>
                                        <?php
                                          if( str_word_count( $top->content) > 20 ) {
                                            $string = substr( $top->content, 0, 100 );
                                            $pos = strrpos( $string , ' ');
                                            if( $pos !== FALSE || $pos > 50 ){
                                              $string = substr( $string, 0, $pos );
                                              echo $string . ' ...';
                                            }
                                          }else {
                                            echo $top->content;
                                          }
                                        ?>
                                      </p>
                                    </div>
                                </div>
                              </div><!-- col-md-6 -->    
                          </td>
                    <?php } else { ?> 
                      <td>
                        <div class="col-md-12">
                          <div class="media">
                              <a class="pull-left" href="<?php echo $link?>"><img class="media-object imageborder hidden-xs" src="images/uploads/<?php echo $top->newscoverphoto;?>" width="70" height="70" alt="<?php echo $top->title;?>"></a>
                              <div class="media-body">
                                <h4 class="media-heading"><a href="<?php echo $link;?>"><?php echo $top->title; ?></a></h4>
                                <p>
                                  <?php
                                    if( str_word_count( $top->content) > 20 ) {
                                      $string = substr( $top->content, 0, 100 );
                                      $pos = strrpos( $string , ' ');
                                      if( $pos !== FALSE || $pos > 50 ){
                                        $string = substr( $string, 0, $pos );
                                        echo $string . ' ...';
                                      }
                                    }else {
                                      echo $top->content;
                                    }
                                  ?>
                                </p>
                              </div>
                          </div>
                        </div><!-- col-md-6 -->    
                      </td>

                    <?php } ?>
                    </div><!-- row -->
                  <?php 
                  $x++;
                  }                    
                  ?>
                  </tr>
                  </table>
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
<script type="text/javascript" src="js/fbpopup.js"></script>
<script type="text/javascript" src="js/app.js"></script>
    <!-- Facebook POPUP LikeBox With Timer Code Start -->
    <div id="fbpopupdata">
    <h1>Show Us Love On Facebook <a style="font-size:12px; color: white; float:right; margin-right: 15px; text-align: inherit; text-decoration: none;" href="www.successpoint.com.ng/contact.php" rel="nofollow">Get Widget By Contacting Me</a></h1>
    <div class="fbpopupdatadata"><center><iframe src="http://facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F/philtechgroup&amp;width=400&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23fff&amp;stream=false&amp;header=false&amp;height=250" scrolling="no" frameborder="0" style="border:none; overflow:show; width:400px; height:250px;" allowtransparency="true"></iframe></center></div><div id="fbpopupdatafooter">Please Wait <span>30</span> Seconds<br/><a href="wwww.philtechgroup.net" target="_blank" id="fbpopupdataclose" onclick="return false;">Close X</a></div></div>
    <!-- Facebook POPUP LikeBox With Timer Code End –>

</body>
</html>