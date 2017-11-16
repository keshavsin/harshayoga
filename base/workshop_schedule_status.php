<?php
include 'common/session_check.php';
if (isset($_POST['cid']) && $_POST['cid'] != '') {
    require_once('common/dbconf.php');
    $cid    = $_POST['cid'];
    $act    = $_POST['act'];
    $sql    = "SELECT * FROM workshop_schedule WHERE id='$cid'";
    $result = mysqli_query($db, $sql);
    $count  = mysqli_num_rows($result);
    if ($count > 0) {
        $isactive   = $act == 1 ? 0 : 1;
        $sql_update = "UPDATE workshop_schedule SET is_active=$isactive WHERE id = '$cid'";
        if ($db->query($sql_update) === TRUE) {
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