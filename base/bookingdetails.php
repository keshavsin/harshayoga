<?php
include 'common/session_check.php';
$currentPage = "bookingdetails";
include 'common/header.php';
$bookingid = $_GET['id'];
?>
<section class="innerpage">
  <h1 class="user_head">Welcome <?php echo $_SESSION["username"];?></h1>
  <div class="table_wrapper bookingdetails">
    <h2 class="headertable">Booking Details</h2>
    <div class="container-fluid" id="booking_container">
      <?php
        require_once 'common/dbconf.php';
        $sql = "select * from booking where id= '$bookingid'";
        $data = $db->query($sql);
        $str = '';

        if ($data->num_rows > 0) {
            $str.= '<div class="table-responsive"><table class="table"><tbody>';
            while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
                $str.= '<tr><th>Id</th><td>' . $row["id"] . '</td></tr>';
                $str.= '<tr><th>Product Id</th><td>' . $row["product_id"] . '</td></tr>';
                $str.= '<tr><th>Name</th><td>' . $row["name"] . '</td></tr>';
                $str.= '<tr><th>Email</th><td>' . $row["email"] . '</td></tr>';
                $str.= '<tr><th>Mobile</th><td>' . $row["mobile"] . '</td></tr>';
                $str.= '<tr><th>Booking Date</th><td>' . $row["booking_date"] . '</td></tr>';
                $str.= '<tr><th>Class Id</th><td>' . $row["class_id"] . '</td></tr>';
                $str.= '<tr><th>Amount</th><td>' . $row["amount_paid"] . '</td></tr>';
            }
            $str.= '</tbody></table></div>';
        } else {
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
