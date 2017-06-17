<?php
session_start();
if(isset($_SESSION['username'])) {
   header("Location: dashboard.php");
  exit;
	//echo '<script>window.location.href = "dashboard.php";</script>';
	//exit();
} else if (isset($_POST['uname']) && $_POST['uname']!='') {
	require_once ('base/common/dbconf.php');
	$name=$_POST['uname'];
	$pass= $_POST['pass'];
	//echo md5($pass);
	//echo "here";
	//6f96e3a3abd841ea565a422f6756c9cf
	//da4edf2857529c2ad3cf9c2e0502cb20  sumit
	$sql = "SELECT * FROM users WHERE email='$name' AND password = MD5('$pass')";
	//$sql = "SELECT * FROM users WHERE email='$name' AND password = '$pass'";
	$result = $db->query($sql);
	if ($result->num_rows > 0) {
		while( $row = $result->fetch_array(MYSQLI_ASSOC)) {
			$email = $row['email'];
			$active = $row['is_active'];
			$userid = $row['id'];
			$name = $row['name'];
			$phnno = $row['mobile'];
			if ($active == 1) {
				$_SESSION['loggedin_user'] = $email;
				$_SESSION['loggedin_userid'] = $userid;
				$_SESSION['loggedin_name'] = $name;
				$_SESSION['loggedin_phone'] = $phnno;
				echo 'success';
			} else {
				echo 'notactive';
			}
		}
	} else {
		echo 'error';
	}
} else {
	header("Location: index.php");
	exit;
}
?>
