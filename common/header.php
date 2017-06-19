<?php
include 'base/common/dbconf.php';

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale = 1, user-scalable = 0" />
<title>Harsha Yoga</title>
<link rel="apple-touch-icon" sizes="57x57" href="assets/app_icons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="assets/app_icons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="assets/app_icons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/app_icons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="assets/app_icons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/app_icons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="assets/app_icons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/app_icons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="assets/app_icons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="assets/app_icons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/app_icons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="assets/app_icons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/app_icons/favicon-16x16.png">
<link rel="manifest" href="assets/app_icons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400|Ubuntu:300,400,700" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<style>
.loading{overflow:hidden;}
.main_loader{position:fixed;z-index:100000;background:#fff url(assets/images/loading.gif) no-repeat center center;top:0;left:0;right:0;bottom:0;display:none;}
.loading .main_loader{display:block;}
</style>
<!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
<![endif]-->
</head>
<body class="loading">
<div class="main_loader"></div>
<main>
  <header class="main_header">
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="social_header clearfix">
        <div class="tel_wrap">Call Us: <a href="tel:+919483852050">+91-9483852050</a></div>
        <div class="social_lnkwrap"><a href="https://www.facebook.com/pages/Harsha-yoga/1401642140138021?ref=hl" class="social_lnk fb" target="_blank"></a><a href="https://www.youtube.com/channel/UCEpNMWkPBJR8EEtwiOVf1QA/videos" class="social_lnk yu" target="_blank"></a><a href="http://instagram.com/harsha_yoga" class="social_lnk in" target="_blank"></a></div>
      </div>
      <nav id="myNavbar" class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#hamburger_menu">
            <span class="sr-only">Toggle navigation</span> <span
              class="icon-bar"></span> <span class="icon-bar"></span> <span
              class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="assets/images/harsha-yoga-logo.jpg" alt="harsha yoga logo"></a>
        </div>
        <div class="collapse navbar-collapse" id="hamburger_menu">
          <ul class="nav navbar-nav navbar-right">
          <?php if ($currentPage == 'about') {
                echo '<li class="dropdown active">';
          } else {
              echo '<li class="dropdown">';
          }
          ?>
           <a href="javascript:vooid(0);" data-toggle="dropdown" class="dropdown-toggle">About Us</a>
              <ul class="dropdown-menu">
                <li><a href="harsha-nagraj.php">Harsha Nagraj</a></li>
            		<li><a href="yashaswini.php">Yashaswini</a></li>
                <li><a href="ashtanga-yoga.php">Ashtanga Yoga</a></li>
                <li><a href="iyengar.php">Iyengar Yoga</a></li>
                <li><a href="hathayoga.php">Hatha Yoga</a></li>
              </ul>
            </li>
          <?php if ($currentPage == 'classes') {
                echo '<li class="active">';
          } else {
              echo '<li>';
          }
          ?>
                <a href="classes.php">Book</a>
            </li>
          <?php if ($currentPage == 'train_the_trainer') {
                echo '<li class="active">';
          } else {
              echo '<li>';
          }
          ?>
                <a href="train_the_trainer.php">TTC</a>
            </li>
          <?php if ($currentPage == 'retreat') {
                echo '<li class="active">';
          } else {
              echo '<li>';
          }
          ?>
                <a href="retreat.php">Retreat</a>
          </li>
            <?php if($currentPage == 'blog'){
                echo '<li class="active">';
          }else{
              echo '<li>';
          }
          ?>
                <a href="blog.php">BLOG</a>
            </li>
            <?php if($currentPage == 'contact'){
                echo '<li class="active">';
          }else{
              echo '<li>';
          }
          ?>
                <a href="contact-us.php">CONTACT</a>
            </li>
            <?php if(isset($_SESSION['loggedin_user'])){
				
              $email = $_SESSION['loggedin_user'];
              $sql_user = "SELECT * FROM users where email = '$email'";
              $result_user = $db->query($sql_user);
              if ($result_user->num_rows > 0) {
                while($row_user = $result_user->fetch_assoc()) {
                  $name = $row_user['name'];
                  $mobile = $row_user['mobile'];
                  $image = $row_user['image'];
                  $city = $row_user['city'];
                  $country = $row_user['country'];
                }
              }
              ?>
              <li class="dropdown" id="btn_menu">
				<button class="btn dropdown-toggle" type="button" id="user_menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="assets/images/users/<?php echo $image;?>" /><span class="caret"></span></button>
				<ul class="dropdown-menu dropdown-menu-right user_headermenu" aria-labelledby="user_menu">
          <li>
          <li class="menu_footer"><a href="dashboard.php" class="btn_menulnk">Dashboard</a></li>
					<li class="menu_footer"><a href="bookings.php"class="btn_menulnk">My Bookings</a></li>
          <li class="menu_footer"><a href="changepassword.php" class="btn_menulnk">Change Password</a></li>
          <li class="menu_footer"><a href="logout.php"class="btn_menulnk">Logout</a></li>
				</ul>
              </li>
            <?php } else { ?>
            <li>
                <a href="login.php" class="apply_btn">Login</a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
    </div>
  </header>
