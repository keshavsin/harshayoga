<?php
session_start();
if(!isset($_SESSION['loggedin_user'])) {
   header("Location: index.php");
  exit;
}else if(isset($_POST['nw']) && $_POST['nw']!=''){
  require_once ('base/common/dbconf.php');
  $email = $_SESSION['loggedin_user'];
  $old =$_POST['old'];
  $nw = $_POST['nw'];
  $sql = "SELECT * FROM users WHERE email='$email' AND password = MD5('$old')";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    $sql_update = "UPDATE users SET password=MD5('$nw') WHERE email = '$email'";
    if ($db->query($sql_update) === TRUE) {
      echo 'success';
    }else{
      echo 'notdone';
    }
  }
  else{
      echo 'error';
    }
}else{
	header("Location: index.php");
	exit;
}
?>
