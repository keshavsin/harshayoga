<?php
include 'sessioncheck.php';
$currentPage = "bookings";
include 'common/header.php';
?>
<section class="innerpage">
<div id="about_harsha">
  <div class="about_innr">
    <div id="loggedin_wrap">
      <h2 class="user_head text-center">Booking Details</h2>
      <div class="container-fluid" id="booking_container">
          <?php
              $sql = "select b.id bid, b.name name, b.product_id pid, b.amount_paid amount, b.txn_id txn_id, p.title title, b.mobile mobile, b.booking_date bdate, b.status status from booking b inner join product p on b.product_id=p.id where email= '$email'";
              $data = $db->query($sql);
              $str = '';
              if($data->num_rows>0){
                $str.= '<div class="table-responsive" style="font-size:13px;"><table class="table"><tbody><tr><th>Id</th><th>Name</th><th>Product Id</th><th>Amount</th><th>Transaction ID</th><th>P Title</th><th>Mobile</th><th>Date</th><th>Status</th></tr>';
                while( $row = $data->fetch_array(MYSQLI_ASSOC)){
                  $str.= '<tr><td>'.$row["bid"].'</td>';
                  $str.= '<td>'.$row["name"].'</td>';
                  $str.= '<td>'.$row["pid"].'</td>';
                  $str.= '<td>'.$row["amount"].'</td>';
                  $str.= '<td>'.$row["txn_id"].'</td>';
                  $str.= '<td>'.$row["title"].'</td>';
                  $str.= '<td>'.$row["mobile"].'</td>';
                  $str.= '<td>'.$row["bdate"].'</td>';
                  $str.= '<td>'.$row["status"].'</td></tr>';
              }
              $str.= '</tbody></table></div>';
            }else{
              $str.= "<div class='row'><div class='col-xs-12'><div class='alert alert-warning'>No booking found</div></div><div class='col-xs-12'><div class='bg-info mrgn_b30 pd20 text-center'>You can check our class section and choose a plan which is best fit according to your needs...<br/><br/><div class='text-center'><a href='classes.php' class='btn btn-info'>Know More</a></div></div></div></div>";
            }
            echo $str;
          ?>
      </div>
    </div>
  </div>
</div>
</section>
<?php include 'common/footer.php';?>
</body>
</html>
