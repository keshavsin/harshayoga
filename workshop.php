<?php
session_start();
$currentPage = "workshops";
include 'common/header.php';
?>
<section id="class_deatils">
<div class="class_innr">
  <div class="container-fluid">
    <h2 class="heading3 text-center">WORKSHOPS</h2>
  </div>
<div class="container-fluid classes_wrapper">
  <div class="row mrgn_b30">
  <?php
  $modal_box = '';
  $sql       = "SELECT * FROM product where type = 'Workshops' and is_active=1";
  $result    = $db->query($sql);
  if ($result->num_rows > 0) {
      $indx = 1;
      while ($row = $result->fetch_assoc()) {
          $pid = $row["id"];
          echo '<div class="col-xs-12 col-sm-6 col-md-3"><div class="batch_card colr' . $indx . '">
                <div class="mn_txt">' . $row['title'] . '</div>
                <div class="dur">' . $row['duration'] . ' (' . $row['duration_unit'] . ')</div>
                <div class="amt_wrap">' . $row['price'] . '/-</div>
                  <a href="#" class="btn btn-block buy">Coming Soon</a>
                  <a href="#class_detail' . $indx . '" data-toggle="modal" data-keyboard="true" class="btn btn-block viewdetails">View Details</a>
                </div>
                </div>';
          
          $modal_box .= '<div id="class_detail' . $indx . '" class="modal fade" role="dialog" tabindex="-1">';
          
          $modal_box .= '<div class="modal-body class-info">' . $row["description"] . '</div>';
          
          $modal_box .= '<div class="modal-footer text-center">
          <a type="button" class="btn btn-primary btn-lg" href="buy_now.php?pid=' . $pid . '">Buy Now</a>
          </div>
          </div>
          </div>
          </div>';
          if ($indx == 6) {
              $indx = 1;
          } else {
              $indx++;
          }
      }
  } else {
      echo '<div class="col-xs-12">
              <div class="alert alert-warning text-center">No Workshops available</div>
          </div>';
  }
  ?>
  </div>
</section>
<?php echo $modal_box; ?>


<section id="class_deatils">
<div class="class_innr">
    <div class="container-fluid">
      <h2 class="heading3 text-center">WORKSHOP SCHEDULES</h2>
    </div>
<div class="container-fluid classes_wrapper">
<div class="row mrgn_b30">
 <div class="table-responsive"> 
  <?php
  $sql1    = "SELECT * FROM workshop_schedule where is_active=1";
  $result1 = $db->query($sql1);
  if ($result1->num_rows > 0) {
      
      echo '<table class="table table-bordered">
      <thead>
        <tr>
          <th>Workshop</th>
          <th>Teacher</th>
          <th>Hours</th>
          <th>Location</th>
          <th>Year</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Boarding & Lodging</th>
          <th>Fees(INR)</th>
        </tr>
      </thead>
      <tbody>';
      
      while ($row1 = $result1->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row1['workshop'] . '</td>';
          echo '<td>' . $row1['teacher'] . '</td>';
          echo '<td>' . $row1['hours'] . '</td>';
          echo '<td>' . $row1['location'] . '</td>';
          echo '<td>' . $row1['year'] . '</td>';
          echo '<td>' . $row1['start_date'] . '</td>';
          echo '<td>' . $row1['end_date'] . '</td>';
          echo '<td>' . $row1['boarding'] . '</td>';
          echo '<td>' . $row1['price'] . '</td>';
          echo '</tr>';
      }
      echo '</tbody>
    </table>';
  } else {
      echo '<div class = "text-center">NO DATA AVAILABLE</div>';
  }
  ?>
  </div>
</div>
</div>
</div>
</section>
<?php include 'common/footer.php';?>
</body>
</html>
