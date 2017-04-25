<?php
require_once 'core/init.php';
$db = new DB();
$user = new User();
?>
<?php
//Pagination
$self = escape($_SERVER['PHP_SELF']);
$sql = $db->query('SELECT * FROM blog ORDER BY postdate DESC');
$count = $sql->count();
//Number of result per row 
$page_row = 4;
//page number of the last page
$last = ceil( $count/$page_row);
//make sure that i cant be less than 1
if( $last < 1 ) { $last = 1 ;}
//page number variable
$pagenum = 1;
//get pagenum from the url vars if its is present, else it is 1
if($x = Input::get('pn')) {
    $pagenum = $x;
}
//this make sure that the page number to be below or more than 1
if( $pagenum < 1 ) { $pagenum = 1; }
else if($pagenum > $last) {$pagenum  = $last;}
//this sets the range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($pagenum - 1) * $page_row . ',' .$page_row;
//make the quey
$blog = $db->query("SELECT * FROM blog ORDER BY postdate DESC $limit");
$paginationCtrls = '';
if($last != 1 ) {
    //first we check if its one page one, cos i dont need a link to that same page else it goes to the nest link
    if( $pagenum > 1) {
        $previous = $pagenum - 1;
        $paginationCtrls .= '<li><a href="'.$self.'?pn=' .$previous. '">Previous &laquo;</a></li>';
        //Render clickable links that should appear at the left
        for( $i = $pagenum - 4; $i < $pagenum; $i++) {
            if($i > 0 ) {
                $paginationCtrls .= '<li><a href="'.$self.'?pn=' .$i. '"> '.$i.' </a></li>';
            }
        }
    }
    //Render the present page number without a link
    $paginationCtrls .= '<li class="active"><a href="'.$self.'?pn='.$pagenum.'">' .$pagenum. '</a></li>';
    //render the clickable links on the right hand side
    for($i = $pagenum + 1; $i <= $last; $i++) {
        $paginationCtrls .= '<li><a href="'.$self.'?pn='.$i.'">'.$i.'</a></li>'; 
        if($i >= $pagenum+4) {break;}
    }
    //This does the same as above previous, but showing the next cliable links
    if ($pagenum != $last) {
        $next = $pagenum + 1 ;
        $paginationCtrls .= '<li><a href="'.$self.'?pn='.$next.'">Next &raquo;</a></li>';
    }
}
function limit_text($text, $limit ){
  if( str_word_count( $text, 0 ) > $limit ){
    $words = str_word_count( $text, 2);
    $pos = array_keys( $words );
    $text = substr( $text, 0 , $pos[$limit]) . '...';
  }
  return $text;
}
?>
<!DOCTYPE html>
<html lamg="en">
<head>
    <meta charset="utf-8" />
    <title>Success Point | Blog</title>
    <meta name="keywords" content="Welcome to the latest news evolving round the world of education: UTME,POST UTME,SCHOLARSHIP, and many other programmes" />
    <meta name="description" content="Get the latest gist happening in Nigeria Universities, be informed of the updated stories on examination That is the least success point gives" />
    <meta name="Author" content="PhilTech">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen"> 
</head>
<body id="blog">
<?php include_once 'includes/template/analyticstracking.php';?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <div class="container-fluid head-wrap">
      <?php require_once 'includes/template/header.php';?>
      <?php require_once 'includes/template/links.php';?>       
    </div><!--Header Wrap Close -->

    <div class="container-fluid content-wrap">
        <div class="container">
            <div class="col-md-9 col-md-push-3 content">
                <div class="content-box">
                    
                   <article>
                     <?php
                        foreach ($blog->results() as $new) { ?>
                            <article>
                                <div class="panel panel-border">
                                    <div class="panel-body" id="<?php echo $new->id?>">
                                        <?php $link = escape(strtolower(preg_replace('#[^a-z0-9)(.,:!?.]#i', '-', $new->title))) ;?>
                                        <h3 class="post-title"><a style="text-decoration:none" href="blog-post.php?pid=<?php echo $new->id?>&amp;p=<?php echo $link?>" class="transicion"><?php echo ucfirst($new->title);?></a></h3>
                                        <div class="row">
                                          <div class="col-lg-6">
                                              <?php 
                                                if(!empty($new->newscoverphoto)) { ?>
                                                  <img src="images/uploads/<?php echo $new->newscoverphoto?>" class="img-post img-responsive" alt="<?php echo $new->title;?>">
                                              <?php } else { ?>
                                                  <img src="images/uploads/news.jpg" class="img-post img-responsive" alt="<?php echo $new->title;?>">
                                              <?php 
                                                }
                                              ?>
                                          </div>
                                          <div class="col-lg-6 post-content text-justify">
                                              <p><?php
                                                    if( str_word_count( $new->content) > 20 ) {
                                                      $string = substr( $new->content, 0, 300 );
                                                      $pos = strrpos( $string , ' ');
                                                      if( $pos !== FALSE || $pos > 100 ){
                                                        $string = substr( $string, 0, $pos );
                                                        echo $string . ' ...';
                                                      }
                                                    }else {
                                                      echo $new->content;
                                                    }
                                                ?>
                                              </p>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="panel-footer post-info-b">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-8 col-sm-7">
                                                <i class="fa fa-clock-o"></i> <?php echo strftime("%b %d, %Y",strtotime($new->postdate));?> <i class="fa fa-user"> </i><?php echo $new->author;?>
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-sm-5">
                                              <a href="blog-post.php?pid=<?php echo $new->id?>&amp;p=<?php echo $link?>#disqus_thread" class="pull-right"><strong>Read more &raquo;</strong></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                    <?php } //end of foreach?>           
                   </article>
                    <section>
                      <ul class="pagination">
                          <?php echo $paginationCtrls?>
                      </ul>
                    </section>
                </div>
                <div class="col-md-12 base-effect"></div>
            </div>

            <div class="col-md-3 col-md-pull-9 content">
                <div class="fb-like-box" data-href="https://www.facebook.com/philtechgroup" data-width="270" data-colorscheme="dark" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
                <div class="clearfix"></div>
              <section id="affiliatebanner" class="hidden-sm margin-bottom-15">
                <div class="content-box header col-md-12 col-sm-12 col-xs-18">
                    <a href="http://www.qservers.net/process/aff.php?aff=155"><img src="https://www.qservers.net/affiliates/images/250x250.gif" class="img-responsive" width="250" height="250" border="0"></a> 
                </div> <!-- content-box -->
              <div class="col-md-12 base-effect"></div>
              </section>  

              <section class="hidden-sm margin-bottom-15">
                <div class="content-box header col-md-12 col-sm-12 col-xs-18">
                    <h5 class="section-title">RECOMMENDED STORIES YOU MAY ALSO LIKE</h5>
                      
                    <?php
                      //sql statement
                      $top_output = ''; $x = 0;
                      $tops = $db->query("SELECT * FROM blog ORDER BY postdate DESC limit 4,9");
                      $x = 0;                    
                      foreach ( $tops->results() as $top ) { 
                        $escape = escape(strtolower(preg_replace('#[^a-z0-9)(.,:!?.]#i', '-', $top->title)));
                        $link = 'blog-post.php?pid='.$top->id.'&amp;p='.$escape;  
                      ?>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="media">                                
                              <div class="media-body">
                                <a class="pull-left" href="<?php echo $link?>"><img class="media-object imageborder hidden-xs" src="images/uploads/<?php echo $top->newscoverphoto;?>" width="70" height="70" alt="<?php echo $top->title;?>"></a>
                                <h5 class="media-heading">&nbsp;<a href="<?php echo $link;?>"><?php echo $top->title; ?></a></h5>
                                <br />
                              </div>
                              <div class="clearfix"></div>
                          </div>
                        </div><!-- col-md-6 -->  
                      </div><!-- row -->
                    <?php 
                    }                    
                    ?>
                  
                </div> <!-- content-box -->
              </section><!-- recent post -->

              <section class="google-ads">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- blog-left-widget-ad -->
                  <ins class="adsbygoogle"
                       style="display:inline-block;width:300px;height:600px"
                       data-ad-client="ca-pub-4824537889134670"
                       data-ad-slot="6189048543"></ins>
                  <script>
                  (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
              </section>         
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div id="back-top">
      <a href="#header"><i class="fa fa-chevron-up"></i></a>
    </div>
    
    <?php include_once 'includes/template/footer.php';?>

<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</script>
<script type="text/javascript">
  /* * * CONFIGURATION VARIABLES * * */
  var disqus_shortname = 'successpoint';
  
  /* * * DON'T EDIT BELOW THIS LINE * * */
  (function () {
      var s = document.createElement('script'); s.async = true;
      s.type = 'text/javascript';
      s.src = '//' + disqus_shortname + '.disqus.com/count.js';
      (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
  }());
</script>

</body>
</html>