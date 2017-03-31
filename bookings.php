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
                    $sql = "select * from booking where email= '$email'";
                    $data = $db->query($sql);
                    $str = '';
                    if($data->num_rows>0){
                      $str.= '<div class="table-responsive"><table class="table"><tbody>';
                      while( $row = $data->fetch_array(MYSQLI_ASSOC)){
                        $str.= '<tr><th>Id</th><td>'.$row["id"].'</td></tr>';
                        $str.= '<tr><th>Name</th><td>'.$row["name"].'</td></tr>';
                        $str.= '<tr><th>Type</th><td>'.$row["booking_type"].'</td></tr>';
                        $str.= '<tr><th>Retreat Id</th><td>'.$row["retreat_id"].'</td></tr>';
                        $str.= '<tr><th>Class Id</th><td>'.$row["class_id"].'</td></tr>';
                        $str.= '<tr><th>Amount</th><td>'.$row["amount_paid"].'</td></tr>';
                        $str.= '<tr><th>Currency</th><td>'.$row["currency"].'</td></tr>';
                        $str.= '<tr><th>Email</th><td>'.$row["email"].'</td></tr>';
                        $str.= '<tr><th>Mobile</th><td>'.$row["mobile"].'</td></tr>';
                        $str.= '<tr><th>Date</th><td>'.$row["booking_date"].'</td></tr>';
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
