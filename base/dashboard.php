<?php
include 'common/session_check.php';
$currentPage = "dashboard";
include 'common/header.php';
?>
<section class="innerpage">
  <h1 class="user_head">Welcome <?php echo $_SESSION["username"];?></h1>
  <div class="table_wrapper bookingdetails">
    <div class="container-fluid">
    <div class="row">
      <div class="col-xs-6"><h2 class="headertable">Booking Details</h2></div>
   </div>
  </div>
    <div class="container-fluid" id="booking_container">
        <div class="error_msg" id="class_emsg">Unable to update</div>
        <div class="success_msg" id="class_smsg">Successfully updated</div>
        <?php
            require_once 'common/dbconf.php';
            $sql = "select * from booking";
            $data = $db->query($sql);
            $str = '';
            if($data->num_rows>0){
              $str.= '<div class="table-responsive"><table class="table"><tbody>';
              $str.= '<thead><th>Id</th><th>Product ID</th><th>Name</th><th>Email</th><th>Amount</th><th>Booking Date</th><th>Status</th><th>&nbsp;</th></thead><tbody>';
              while( $row = $data->fetch_array(MYSQLI_ASSOC)) {
                $str.= '<tr>';
                $str.= '<td>'.$row["id"].'</td>';
				        $str.= '<td>'.$row["product_id"].'</td>';
                $str.= '<td>'.$row["name"].' </td>';
                $str.= '<td>'.$row["email"].'</td>';
                $str.= '<td>'.$row["amount_paid"].'</td>';
        				$str.= '<td>'.$row["booking_date"].' </td>';
                if ($row["status"] === 'success') {
                    $str.= '<td style="background:lightgreen">'.$row["status"].'</td>';
                } else {
                    $str.= '<td style="background:cyan">'.$row["status"].'</td>';
                }
                $str.= '<td><a class="btn btn-default edit_btn" href="bookingdetails.php?id=' . $row["id"] . '">View Details</a></td>';
                $str.= '</tr>';
              }
            $str.= '</tbody></table></div>';
          }else{
            $str.= "<div class='row'><div class='col-xs-12'><div class='alert alert-warning'>No data available</div></div></div>";
          }
          echo $str;
        ?>
    </div>
  </div>
</section>
<?php include 'common/footer.php';?>

</body>
</html>
