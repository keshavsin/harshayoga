<?php
session_start();
if(isset($_SESSION['loggedin_user'])) {
   header("Location: index.php");
  exit;
}else if(isset($_POST['uname']) && $_POST['uname']!=''){
  require_once ('base/common/dbconf.php');
  $email = $_POST['uname'];
  $nw = $_POST['nw'];
  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    $sql_update = "UPDATE users SET password=MD5('$nw') WHERE email = '$email'";
    if ($db->query($sql_update) === TRUE) {
      echo 'success';
    }else{
      echo 'error';
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
