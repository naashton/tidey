<?php
session_start();
/*********************
* Tidey 2016
* header.php provides the uesr with a navigation bar to visit various parts of Tidey.
* The file also provies the styling, both bootstrap and custom CSS, on every page because
* header.php is included on every page.
*********************/
?>
<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <title>Tidey</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <!-- Custome CSS -->
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<div class="container">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="home.php">
          <img src="./images/logo_small.png" width="30" height="30" alt="">
        </a>
      </div>
      <ul class="nav navbar-nav">
          <li><a href="home.php">Home</a></li>
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Beaches<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="beaufort.php">Beaufort</a></li>
                <li><a href="wrightsville.php">Wrightsville Beach</a></li>
              </ul>
            </li>
          <?php if(isset($_SESSION['firstName'])) { ?>
            <li><a href="images.php">View Images</a></li>
            <li><a href="upload_image.php">Upload Images</a></li>
            <li><a href="logged_out.php">Logout</a></li>
          <!--If admin is logged in, display link to admin.php in navbar-->
          <?php if ($_SESSION['email']=='admin@tidey.com') { ?>
            <li><a href="admin.php">Admin Page</a></li>
          <?php } ?>
          <?php }
          else { ?>
            <li><a href="register_user.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
          <?php } ?>
      </ul>
    </div>
  </nav>
</div>
