<?php
session_start();
 if(!isset($_SESSION['loggedin_user'])) {
    header("Location: login.php");
    exit;
}
?>
