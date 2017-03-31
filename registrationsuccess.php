<?php
session_start();
if(isset($_SESSION['loggedin_user'])) {
   header("Location: dashboard.php");
  exit;
}else{
$currentPage = "registration success";
include 'common/header.php';
if(isset($_SESSION['regsitercheck'])){
    $cookie = $_SESSION['regsitercheck'];
    echo '<section id="about_harsha"><div class="message_wrapper"><div class="container-fluid"><div class="row"><div class="col-sm-12 contact_text">';
    echo'<h2 class="heading1 colr_h">Almost there...</h2><h3 class="heading2">You have successfully created your account.</h3>';
    echo"<p>Now you have to verify and activate your account. A message with verification link has been sent to <i class='text-primary'>".$cookie."</i>. Click the link in the email message and you'll be one step closer to having a healthy life.</p>";
    echo"</div></div></div></div></section>";
    session_destroy();
}else {
  echo '<script>location.href = "index.php";</script>';
}
include 'common/footer.php';
}?>
</body>
</html>
