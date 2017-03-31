<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale = 1, user-scalable = 0" />
<title>Harsha Yoga</title>
<link rel="apple-touch-icon" sizes="57x57" href="app_icons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="app_icons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="app_icons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="app_icons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="app_icons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="app_icons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="app_icons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="app_icons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="app_icons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="app_icons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="app_icons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="app_icons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="app_icons/favicon-16x16.png">
<link rel="manifest" href="app_icons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400|Ubuntu:300,400,700" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<style>
.loading{overflow:hidden;}
.main_loader{position:fixed;z-index:100000;background:#fff url(images/loading.gif) no-repeat center center;top:0;left:0;right:0;bottom:0;display:none;}
.loading .main_loader{display:block;}
</style>
<!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
<![endif]-->
</head>
<?php if($currentPage == 'login'){
echo '<body class="loading loginpage">';
}else{
  echo '<body class="loading">';
}
?>
<div class="main_loader"></div>
<main>
<?php if($currentPage != 'login'){ ?>
  <header class="main_header">
    <div class="navbar-fixed-top" role="navigation">
      <nav id="myNavbar" class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#hamburger_menu">
            <span class="sr-only">Toggle navigation</span> <span
              class="icon-bar"></span> <span class="icon-bar"></span> <span
              class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="dashboard.php"><img src="images/harsha-yoga-logo.jpg" alt="harsha yoga logo"></a>
        </div>
        <div class="collapse navbar-collapse" id="hamburger_menu">
          <ul class="nav navbar-nav navbar-right">
            <?php if($currentPage == 'classes'){
                echo '<li class="active">';
          }else{
              echo '<li>';
          }
          ?>
                <a href="manage_classes.php">Manage Classes</a>
            </li>
            <?php if($currentPage == 'bookings'){
                echo '<li class="active">';
          }else{
              echo '<li>';
          }
          ?>
                <a href="manage_bookings.php">Manage Bookings</a>
            </li>
            <?php if($currentPage == 'retreat'){
                echo '<li class="active">';
          }else{
              echo '<li>';
          }
          ?>
                <a href="manage_retreat.php">Manage Retreats</a>
            </li>
            <li>
                <a href="logout.php" class="apply_btn">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    </div>
  </header>
  <?php } ?>
