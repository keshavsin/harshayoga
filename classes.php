<?php
//include 'sessioncheck.php';
session_start();
$currentPage = "classes";
include 'common/header.php';
?>

<section id="class_deatils">
<div class="class_innr">
    <div class="container-fluid">
      <h2 class="heading3 text-center">REGULAR BATCHES</h2>
      <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-15">
            <div class="batch_card colr1">
                <div class="time_txt">6:30</div>
                <div class="time_format">AM</div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-15">
            <div class="batch_card colr2">
                <div class="time_txt">8:30</div>
                <div class="time_format">AM</div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-15">
            <div class="batch_card colr3">
                <div class="time_txt">10:00</div>
                <div class="time_format">AM</div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-15">
            <div class="batch_card colr4">
                <div class="time_txt">5:30</div>
                <div class="time_format">PM</div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-15">
            <div class="batch_card colr5">
                <div class="time_txt">7:15</div>
                <div class="time_format">PM</div>
            </div>
        </div>
      </div>
    </div>
<div class="container-fluid classes_wrapper">
<h2 class="heading3 text-center">Weekday Classes</h2>
  <div class="row mrgn_b30">
<?php
$modal_box = '';
$sql       = "SELECT * FROM product where type = 'class' AND class_type = 'weekday' AND is_active=1";
$result    = $db->query($sql);
if ($result->num_rows > 0) {
    $indx = 1;
    while ($row = $result->fetch_assoc()) {
        $pid = $row["id"];
        echo '<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="batch_card colr' . $indx . '">
					<div class="mn_txt">' . $row['duration'] . ' Months</div>
					<div class="amt_wrap">' . $row['price'] . '/-</div>
					<a href="buy_now.php?pid=' . $pid . '" class="btn btn-block buy">Buy Now</a>
					<a href="#class_detail' . $indx . '" data-toggle="modal" class="btn btn-block viewdetails">View Details</a>
				</div>
			 </div>';
        
			$modal_box .= '<div id="class_detail' . $indx . '" class="modal fade" role="dialog">';
			$modal_box .= '<div class="modal-dialog modal-lg">
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">' . $row["duration"] . ' Months weekday class</h4>
							</div>';
			$modal_box .= '<div class="modal-body class-info">' . $row["description"] . '</div>';
			$modal_box .= '<div class="modal-footer text-center">
								<a type="button" class="btn btn-primary btn-lg" href="buy_now.php?pid=' . $pid . '">Buy Now</a>
							</div>';
			$modal_box .= '</div></div></div>';
		
        if ($indx == 6) {
            $indx = 1;
        } else {
            $indx++;
        }
    }
} else {
    echo '<div class="col-xs-12"><div class="alert alert-warning text-center">No Weekday class available</div></div>';
}
?>
  </div>

<h2 class="heading3 text-center">Weekend Classes</h2>
  <div class="row">
<?php
$sql1    = "SELECT * FROM product where type = 'class' AND class_type = 'weekend' AND is_active=1";
$result1 = $db->query($sql1);
if ($result1->num_rows > 0) {
    $indx1 = 5;
    
    while ($row1 = $result1->fetch_assoc()) {
        $pid1 = $row1["id"];
        echo '<div class="col-xs-12 col-sm-6 col-md-3"><div class="batch_card colr' . $indx1 . '">
          <div class="mn_txt">' . $row1['duration'] . ' Months</div>
          <div class="amt_wrap">' . $row1['price'] . '/-</div>
          <a href="buy_now.php?pid=' . $pid . '" class="btn btn-block buy">Buy Now</a>
          <a href="#class_detail' . $indx1 . '" data-toggle="modal" class="btn btn-block viewdetails">View Details</a>
          </div>
          </div>';
        $modal_box .= '<div id="class_detail' . $indx1 . '" class="modal fade" role="dialog">';
        $modal_box .= '<div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">' . $row1["duration"] . ' Months weekend class</h4><
        /div>';
        $modal_box .= '<div class="modal-body class-info">' . $row1["description"] . '</div>';
        $modal_box .= '<div class="modal-footer text-center">
          <a type="button" class="btn btn-primary btn-lg" href="buy_now.php?pid=' . $pid . '">Buy Now</a>
        </div>
        </div>
        </div>
        </div>';
        if ($indx1 == 6) {
            $indx1 = 1;
        } else {
            $indx1++;
        }
    }
} else {
    echo '<div class="col-xs-12"><div class="alert alert-warning text-center">No Weekend class available</div></div>';
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
