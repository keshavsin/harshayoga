<?php
session_start();
if(isset($_SESSION['username'])) {
   header("Location: dashboard.php");
  exit;
}else if(isset($_POST['uname']) && $_POST['uname']!=''){
  require_once ('common/dbconf.php');
  $name=$_POST['uname'];
  $pass= $_POST['pass'];
  $sql = "SELECT * FROM admin WHERE email='$name' AND password = MD5('$pass')";
  $result = mysqli_query($db,$sql);
  $count = mysqli_num_rows($result);
  if($count > 0){
     while( $row = $result->fetch_array(MYSQLI_ASSOC)){
       $name = $row['name'];
     }
      $_SESSION["username"] = $name;
      echo 'dashboard.php';
    }else{
      echo 'error';
    }
}else{
	header("Location: index.php");
	exit;
}
?>
