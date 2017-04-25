<?php
require_once 'core/init.php';
$db = new DB();
$user = new User;
$app = new Application();
if(!$user->exists()) {
    Redirect::to(404);
}else {
    $data = $user->data();
}
if($timeup = Input::get('timeup')) {
  $timeup = 'You could not finish the exam before time elapse';
}

Session::delete('exam');
?>
<?php
$val = false;
if(isset($_POST['hidden'])){ 
  unset($_POST['hidden']);
  $keys = array_keys($_POST);
  $order = join(",",$keys);
  //$query="select * from questions id IN($order) ORDER BY FIELD(id,$order)";
  // echo $query;exit;
  $val = true;
  $sql = "SELECT * FROM questions WHERE id IN($order) ORDER BY FIELD(id,$order)";
  //echo $sql;
  $query = $db->query($sql);

  $right_answer = $wrong_answer = $unanswered = 0;
  foreach ($query->results() as $result) {
    if($result->ans == $_POST[$result->id]) {
      $right_answer++;
    }else if($_POST[$result->id] == 5) {
      $unanswered++;
    }else {
      $wrong_answer++;
    }
  }//foreach
  //star rating logic
  $star = '';
  $total_question = $query->count();
  /*if( $right_answer >= (50/100 * $total_question)){

  }
  */
  $i = 1;
  if( $right_answer >= (70/100 * $total_question)){
    while( $i <= 5){
      $star .= '&#9733; ';
      $i++;
    }
    $star.= 'EXCELLENT';
  }else if( $right_answer >= (60/100 * $total_question)) {
    while( $i <= 4 ){
      $star .= '&#9733; ';
      $i++;
    }
    $star.= 'VERY GOOD';
  }else if( $right_answer >= (50/100 * $total_question) ){
    while( $i <= 3 ){
      $star .= '&#9733; ';
      $i++;
    }
    $star.= 'GOOD';
  }else if( $right_answer >= (40/100 * $total_question) ){
    while( $i <= 2){
        $star .= '&#9733; ';
        $i++;
      }
    $star.= 'FAIR';
  }else {
    $star = '&#9733';
    $star.= 'POOR';
  }
  //Insert into te DB
/*  try {
    $app->create('results', array(
      'username' => escape(ucwords($data->username)),
      'subject'  => 'English',
      'score'   => $right_answer,
      'date'    => date('Y-m-d')
    ));
    //Create a Modal Here
  } catch (Exception $e) {
    die($e->getMessage());
  }
*/
  $score_table = '';
  $score_table = '<table class="table mid table-hover">
                    <thead>
                      <tr>
                        <td>Subject</td>
                        <td>Right Answer</td>
                        <td>Wrong Answer</td>
                        <td>Un-answered</td>
                        <td>Rate</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>' .strtoupper($result->subject). '</td>
                        <td>' .$right_answer. '</td>
                        <td>' .$wrong_answer. '</td>
                        <td>' .$unanswered. '</td>
                        <td>' .$star. '</td>
                      </tr>
                    </tbody>
                  </table>';
  }
?>
<!DOCTYPE html>
<html lamg="en">
<head>
    <meta charset="utf-8" />
    <title>Success Point | Result Page</title>
    <meta name="keywords" content="Free online question and nswer giving ecplanation to each questions" />
    <meta name="description" content="Success point is the best online tutor for having about 1000+ pastquestions and likely questions on UTME, Post UTME, with explanations" />
    <meta name="Author" content="PhilTech">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="result">
<?php include_once 'includes/template/analyticstracking.php';?>
    <div class="container-fluid head-wrap">
        <?php include_once 'includes/template/header.php';?>
        <?php include_once 'includes/template/links.php';?>
    </div><!--Header Wrap Close -->
    <div class="container-fluid content-wrap">
        <div class="container">
            <div class="col-md-offset-1 col-md-10 content">
                <div class="content-box col-md-12">
                    <div class="well well-lg mid">
                        <h4>Hello <strong><?php echo ucwords(escape($data->username)) ?></strong></h4>
                        <h4><?php echo $timeup;?></h4>
                        <p><strong>Give it a try <a href="home.php">again!</a></strong></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                      <?php 
                        if( !Input::get('timeup')){
                          echo $score_table;
                        }
                      ?>
                    </div>
                </div>
                <div class="col-md-12 base-effect"></div>
            </div>
        </div>
    </div>
    <?php 
    if( $val ){ 

    ?>

      <div class="container-fluid content-wrap">
        <div class="container">
          <div class="col-md-offset-1 col-md-10 content">
            <div class="content-box">
              <?php
                  $x = 1;
                  foreach ($query->results() as $result) { ?>
                      <div id="question<?php echo $x;?>" class="panel panel-warning cont">
                          <div class="panel panel-heading questions">Question ( <?php echo $x .' of '. $query->count()?>)
                          <div class="pull-right">
                          <?php if($result->ans == $_POST[$result->id]) { ?>
                              <span class="glyphicon glyphicon-ok"></span>
                          <?php }else {
                            $answer = '' ;
                            switch ($result->ans) {
                              case 1:
                                $answer = 'A';
                                break;
                              case 2:
                                $answer = 'B';
                                break;
                              case 3:
                                $answer = 'C';
                                break;
                              case 4:
                                $answer = 'D';
                                break;
                            }
                          ?>
                              <span class="glyphicon glyphicon-remove"> Right Option: <?php echo $answer;?></span>
                          <?php }
                          ?>
                          </div>
                          </div>
                          <div class="panel panel-body"> <?php echo $result->question?></div>
                          <div class="panel panel-footer">
                            <div class="form-group">
                              <label for="optiona" class="control-label"> a </label>
                              <!-- <?php
                                  if( $_POST[$result->id] == $result->ans ) { ?> 
                                    &lang; <input type="radio" id="<?php echo $result->id?>" name="<?php echo $result->id?>" checked value="1"> &rang;<?php echo $result->opt1;?> 
                              <?php }else { ?> -->
                                    &lang; <input type="radio" id="<?php echo $result->id?>" name="<?php echo $result->id?>" value="1"> &rang;<?php echo $result->opt1;?>
                              <!-- <?php  }
                              ?> -->
                            </div>
                            <div class="form-group">
                              <label for="optiona" class="control-label"> b </label>
                              <!-- <?php
                                  if( $_POST[$result->id] == $result->ans ) { ?> 
                                    &lang; <input type="radio" id="<?php echo $result->id?>" name="<?php echo $result->id?>" checked value="1"> &rang;<?php echo $result->opt1;?> 
                              <?php }else { ?> -->
                                    &lang; <input type="radio" id="<?php echo $result->id?>" name="<?php echo $result->id?>" value="2"> &rang;<?php echo $result->opt2;?>
                              <!-- <?php  }
                              ?> -->
                            </div>
                            <div class="form-group">
                              <label for="optiona" class="control-label"> c </label>
                              <!-- <?php
                                  if( $_POST[$result->id] == $result->ans ) { ?> 
                                    &lang; <input type="radio" id="<?php echo $result->id?>" name="<?php echo $result->id?>" checked value="1"> &rang;<?php echo $result->opt1;?> 
                              <?php }else { ?> -->
                                    &lang; <input type="radio" id="<?php echo $result->id?>" name="<?php echo $result->id?>" value="3"> &rang;<?php echo $result->opt3;?>
                              <!-- <?php  }
                              ?> -->
                            </div>
                            <div class="form-group">
                              <label for="optiona" class="control-label"> d </label>
                              <!-- <?php
                                  if( $_POST[$result->id] == $result->ans ) { ?> 
                                    &lang; <input type="radio" id="<?php echo $result->id?>" name="<?php echo $result->id?>" checked value="1"> &rang;<?php echo $result->opt1;?> 
                              <?php }else { ?> -->
                                    &lang; <input type="radio" id="<?php echo $result->id?>" name="<?php echo $result->id?>" value="4"> &rang;<?php echo $result->opt4;?>
                              <!-- <?php  }
                              ?> -->
                            </div>
                          </div>
                          <?php
                            if(!empty($result->explanation)) { ?>
                                <div>
                                  <p class="alert alert-info"><?php echo $result->explanation;?></p>
                                </div>
                          <?php } ?>
                      </div>
                <?php 
                  $x++;
                }
              ?>
            </div> <!-- content-box -->
          </div> <!-- col-md-offset-1 col-md-10 content -->
        </div> <!-- container -->
      </div><!-- container-fluid content-wrap -->
    <?php } //end of Input::get(1)
    ?>
    <div id="back-top">
      <a href="#header"><i class="fa fa-chevron-up"></i></a>
    </div>    
   
   <?php include_once 'includes/template/footer.php';?>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>