<?php
session_start();
if(isset($_SESSION['loggedin_user'])) {
   header("Location: index.php");
  exit;
}else if(isset($_POST['uname']) && $_POST['uname']!=''){
  require_once ('base/common/dbconf.php');
  $email = $_POST['uname'];
  $sql = "SELECT * FROM users WHERE email='$email' AND is_active=1";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    function my_simple_crypt( $string, $action = 'e' ) {
  $secret_key = 'D69e4K13w9KFFly6J4wHcCG3MNa';
  $secret_iv = 'S9TW2ET56nem';
  $output = false;
  $encrypt_method = "AES-256-CBC";
  $key = hash( 'sha256', $secret_key );
  $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
   if( $action == 'e' ) {
      $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
  }
  return $output;
}
$activation_lnk = my_simple_crypt( $email, 'e' );
  $actual_link = "http://$_SERVER[HTTP_HOST]/"."resetpassword.php?id=" . $activation_lnk;
  $to = $email;
  $subject = "Reset Password";
  $txt = "<table border='0' style='background:#fff;' width='100%'>";
  $txt .= "<tr><td><h2 style='color:#565656;font-size:30px;text-align:center;padding:0;'>Reset Your Password</h2></td></tr>";
  $txt .= "<tr><td style='padding:10px;color:#607d8b;font-size:14px;text-align:center;'>Click on below link to reset your account's password.</td></tr>";
  $txt .= "<tr><td style='padding:10px;text-align:center'><a href='".$actual_link."' style='padding:10px;background:#05901c;color:#fff;font-size:18px;text-decoration:none;border-radius:30px;'>Reset Password<a></td></tr>";
  $txt .="</table>";
  $headers = "From: Harsha<harsha@harshayoga.com>";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  mail($to,$subject,$txt,$headers);
  $_SESSION['forgotcheck'] = $email;
   echo 'success';
    }else{
      echo 'nouser';
    }
}else{
	header("Location: index.php");
	exit;
}
?>
