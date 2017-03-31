<?php
session_start();
if(isset($_SESSION['loggedin_user'])) {
   header("Location: dashboard.php");
  exit;
}else if(isset($_POST['uname']) && $_POST['uname']!=''){
  require_once ('base/common/dbconf.php');
  $name=$_POST['uname'];
  $pass= $_POST['pass'];
  $sql = "SELECT * FROM users WHERE email='$name' AND password = MD5('$pass')";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
     while( $row = $result->fetch_array(MYSQLI_ASSOC)){
       $email = $row['email'];
       $active = $row['is_active'];
     if($active == 1){
      $_SESSION['loggedin_user'] = $email;
      echo 'success';
    }else{
      echo 'notactive';
    }
  }
    }else{
      echo 'error';
    }
}else{
	header("Location: index.php");
	exit;
}
?>
