<?php
session_start();
if(isset($_SESSION['loggedin_user'])) {
   header("Location: dashboard.php");
  exit;
}else{
$currentPage = "activate account";
include 'common/header.php';
if(isset($_GET['id'])){
    $encrypted_txt = $_GET['id'];
    function my_simple_crypt( $string, $action = 'e' ) {
    $secret_key = 'D69e4K13w9KFFly5J3wHcCG3MNa';
    $secret_iv = 'S8TW2ET26nem';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
    return $output;
    }
    $email = my_simple_crypt( $encrypted_txt, 'd' );
    $sql = "SELECT * FROM users WHERE email='$email' AND is_active=0";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      $sql_update = "UPDATE users SET is_active=1, updated_date=NOW() WHERE email = '$email'";
      if ($db->query($sql_update) === TRUE) {
        echo '<section id="about_harsha"><div class="message_wrapper"><div class="container-fluid"><div class="row"><div class="col-sm-12 contact_text">';
        echo'<h2 class="heading1 colr_h">Congratulations !!</h2><h3 class="heading2">Your account has been successfully activated.</h3>';
        echo"<p>Now you can access your path to healthy life. To log into your account, please click on below link.</p>";
        echo"<p class='text-center'><a href='login.php' class='btn btn-default btn_signup'>Login</a></p>";
        echo"</div></div></div></div></section>";
      }else{
        echo '<section id="about_harsha"><div class="message_wrapper"><div class="container-fluid"><div class="row"><div class="col-sm-12 contact_text">';
        echo'<h2 class="heading1 colr_h">Activation Not Successfull</h2>';
        echo"<div class='alert alert-warning'>We are unable to activate your account please click on below link to send us your query and we'll help you to gain access to your account</div>";
        echo"<p class='text-center'><a href='contact-us.php?ref=activation' class='btn btn-default btn_signup'>Contact Us</a></p>";
        echo"</div></div></div></div></section>";
      }
    }else{
      echo '<section id="about_harsha"><div class="message_wrapper"><div class="container-fluid"><div class="row"><div class="col-sm-12 contact_text">';
      echo'<h2 class="heading1 colr_h">Something went wrong!</h2>';
      echo"<div class='alert alert-danger'>It seems the link is expired. If your account is not active you can click on below link to send us your query</div>";
      echo"<p class='text-center'><a href='contact-us.php?ref=linkexpired' class='btn btn-default btn_signup'>Contact Us</a></p>";
      echo"</div></div></div></div></section>";
    }
}else {
  echo '<script>location.href = "index.php";</script>';
}
include 'common/footer.php';
}
?>
</body>
</html>

