<nav class="navbar navbar-default col-md-12" role="navigation">
  <div class="container col-md-offset-1 col-md-10">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="tutorial.php"><span class="glyphicon glyphicon-pencil">&nbsp;</span>2015 English Tutorial</a></li>
        <li><a href="projects"><span class="glyphicon glyphicon-education">&nbsp;</span>Bsc Projects</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="blog.php"><span class="fa fa-bullhorn">&nbsp;</span>Blog</a></li>
        <li><a href="contact.php">Contact Us</a></li>

        <?php
          if( $user->isLoggedIn() && $user->hasPermission("moderator")){ ?>
            <li><a href="add.php"><span class="glyphicon glyphicon-plus">&nbsp;</span>Add Page</a></li>
        <?php
        }
        ?>
        <?php 
          if($user->isLoggedIn()) { ?>
            <li><a href="logout.php">Logout</a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>