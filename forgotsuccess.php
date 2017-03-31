<?php
session_start();
if(isset($_SESSION['loggedin_user'])) {
   header("Location: dashboard.php");
  exit;
}else{
$currentPage = "registration success";
include 'common/header.php';
if(isset($_SESSION['forgotcheck'])){
    $cookie = $_SESSION['forgotcheck'];
    echo '<section id="about_harsha"><div class="message_wrapper"><div class="container-fluid"><div class="row"><div class="col-sm-12 contact_text">';
    echo'<h2 class="heading1 colr_h">Hurray !!!</h2><h3 class="heading2">User account found</h3>';
    echo"<p class='mrgnbtm20'>We have found a user with email id : <i class='text-primary'>".$cookie."</i> and we have sent an email containing reset password link. Click the link in the email message to reset you password.</p>";
    echo"<p>If you do not recieve any email. Feel free to reach us by clicking on below link.</p>";
    echo"<div class='text-center'><a href='contact-us.php' class='btn btn-default'>Contact Us</a></div>";
    echo"</div></div></div></div></section>";
    session_destroy();
}else {
  echo '<script>location.href = "index.php";</script>';
}
include 'common/footer.php';
}?>
</body>
</html>
