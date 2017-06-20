<?php
//include 'sessioncheck.php';
session_start();
$currentPage = "retreat";
include 'common/header.php';
?>

<section id="class_deatils">
<div class="class_innr">
    <div class="container-fluid">
      <h2 class="heading3 text-center">LIST OF RETREAT PROGRAMS</h2>
    </div>
<div class="container-fluid classes_wrapper">
<!-- <h2 class="heading3 text-center">SELECT FROM THE LIST OF RETREAT PROGRAMS</h2> -->
<div class="row mrgn_b30">
<?php
$modal_box = '';
$sql       = "SELECT * FROM product where type = 'retreat' and is_active=1";
$result    = $db->query($sql);
if ($result->num_rows > 0) {
    $indx = 1;
    while ($row = $result->fetch_assoc()) {
        $pid = $row["id"];
        echo '<div class="col-xs-12 col-sm-6 col-md-3"><div class="batch_card colr' . $indx . '"><div class="mn_txt">' . $row['title'] . '</div><div class="amt_wrap">' . $row['price'] . '/-</div><a href="#" class="btn btn-block buy">Coming Soon</a><a href="#class_detail' . $indx . '" data-toggle="modal" class="btn btn-block viewdetails">View Details</a></div></div>';
        $modal_box .= '<div id="class_detail' . $indx . '" class="modal fade" role="dialog">';
        $modal_box .= '<div class="modal-body class-info">' . $row["description"] . '</div>';
        $modal_box .= '<div class="modal-footer text-center"><a type="button" class="btn btn-primary btn-lg" href="buy_now.php?pid=' . $pid . '">Buy Now</a></div></div></div></div>';
        if ($indx == 6) {
            $indx = 1;
        } else {
            $indx++;
        }
    }
} else {
    echo '<div class="col-xs-12"><div class="alert alert-warning text-center">No Retreat programs available</div></div>';
}
?>
</div>

</div>
</div>
</section>
<?php echo $modal_box; ?>
<?php include 'common/footer.php';?>
</body>
</html>
