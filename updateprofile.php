<?php
include 'sessioncheck.php';
if (isset($_POST['name']) && $_POST['name'] != '') {
    require_once('base/common/dbconf.php');
    $email   = $_SESSION['loggedin_user'];
    $name    = $_POST['name'];
    $phone   = $_POST['phone'];
    $country = $_POST['country'];
    $city    = $_POST['city'];
    $sql     = "SELECT * FROM users WHERE email='$email'";
    $result  = $db->query($sql);
    if ($result->num_rows > 0) {
        $sql_insert = "UPDATE users SET name= '$name', mobile = $phone, city = '$city', country = '$country', updated_date= NOW() where email = '$email'";
        if ($db->query($sql_insert) === TRUE) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>