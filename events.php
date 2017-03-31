<?php
$currentPage = "events";
include 'common/header.php';
$event_id = '';
if(isset($_GET["id"])){
  $event_id = $_GET["id"];
}else{
echo '<script>location.href = "index.php";</script>';
}
$sql = "SELECT * FROM product where id = $event_id AND type = 'retreat'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<section id="about_harsha"><div class="about_innr"><div class="container-fluid"><div class="row"><div class="col-xs-12 about_text"><h2 class="heading1 colr_h">
    <h2 class="heading1 colr_h">'.$row['title'].'</h2><h3 class="heading2">Welcome to the path of realistic evolution.</h3><div class="pd_bttm">
      <div id="retreat_pages"><div id="myCarousel" class="carousel slide main_slider" data-ride="carousel"><div class="carousel-inner " role="listbox">';
      $sql1 = "SELECT * FROM product_images where product_id = $event_id";
      $result1 = $db->query($sql1);
      if ($result1->num_rows > 0) {
        $slide_cn = 1;
        while($row1 = $result1->fetch_assoc()) {
          if($slide_cn == 1){
            echo '<div class="item active"><img src="assets/images/'.$row1["image_path"].'" alt="'.$row["title"].' image slide"></div>';
          }else{
            echo '<div class="item"><img src="assets/images/'.$row1["image_path"].'" alt="'.$row["title"].' image slide"></div>';
          }
          $slide_cn++;
        }
      }else{
        echo '<div class="item active"><img src="assets/images/slide_default.jpg" alt="'.$row["title"].' image slide"></div>';
      }
      echo '</div><a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="sr-only">Next</span></a></div></div>';
      echo '<div class="container-fluid"><div class="row"><div class="col-sm-5 col-sm-push-7">';
      echo '<table class="table"><tbody><tr class="active"><th>Date</th>';
      if($row['start_date'] != ''){
        echo "<td>".$row['start_date']."</td></tr>";
      }else{
      echo '  <td>To be notified</td></tr>';
    }
      echo '<tr class="info"><th>Location</th><td>'.$row['location'].'</td></tr><tr class="success">';
      if($row['start_date'] != ''){
      echo'<td colspan="2"><a href="#" class="btn btn-primary">Book Now</a></td></tr>';
    }else{
      echo'<th>Book</th><td>-</td></tr>';
    }
      echo'</tbody></table></div>';
      echo '<div class="col-sm-7 col-sm-pull-5">'.$row["description"].'</div>';
      echo '</div></div></div></div></div></div></div></section>';
      include 'common/footer.php';
      echo '</body></html>';
  }
} else {
  echo '<script>location.href = "index.php";</script>';
}
?>
