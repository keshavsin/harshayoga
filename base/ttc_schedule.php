<?php
include 'common/session_check.php';
$currentPage = "ttc_schedule";
include 'common/header.php';
?>
<section class="innerpage">
  <h1 class="user_head">Welcome <?php echo $_SESSION["username"];?></h1>
  <div class="table_wrapper bookingdetails">
    <div class="container-fluid">
    <div class="row">
      <div class="col-xs-6"><h2 class="headertable">TTC Schedule</h2></div>
      <div class="col-xs-6 text-right"><a href="#classmodal" class="btn btn-info" data-toggle="modal">Add New</a></div>
    </div>
  </div>
    <div class="container-fluid" id="booking_container">
        <div class="error_msg" id="class_emsg">Error while updating, Refresh page and try again !!</div>
        <div class="success_msg" id="class_smsg">Successfully Updated</div>
        <?php
            require_once 'common/dbconf.php';
            $sql = "select * from ttc_schedule";
            $data = $db->query($sql);
            $str = '';
      			$i=1;
            if ($data->num_rows>0) {
              $str.= '<div class="table-responsive"><table class="table"><tbody>';
              $str.= '<thead><th>ID</th><th>TTC Name</th><th>Month</th><th>Year</th><th>Location</th><th>Start Date</th><th>End Date</th><th>Fees</th><th>Status </th><th>&nbsp;</th></thead><tbody>';
              while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
                $str.= '<tr>';
			        	$str.= '<td>'.$row["id"].'</td>';
                $str.= '<td>'.$row["ttc_name"].'</td>';
                $str.= '<td>'.$row["month"].'</td>';
                $str.= '<td>'.$row["year"].' </td>';
                $str.= '<td>'.$row["location"].'</td>';
                $str.= '<td>'.$row["start_date"].'</td>';
        				$str.= '<td>'.$row["end_date"].' </td>';
                $str.= '<td>'.$row["price"].'</td>';
              
                if ($row["is_active"] == 1) {
                  $str.= '<td class="bg-success" id="act_'.$row["id"].'">Active</td>';
                } else {
                  $str.= '<td class="bg-warning" id="act_'.$row["id"].'">Not Active</td>';
                }
                $str.= '<td><a href="#classmodaledit'.$i.'" class="btn btn-default edit_btn" data-toggle="modal" title="edit">Edit</a> &nbsp;';
				?>
<div id="classmodaledit<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify TTC Schedule</h4>
      </div>
      <?php
      if (isset($_POST['update'])) {
          require_once 'common/dbconf.php';
          $post_ttc_name   = $_POST['ttc_name'];
          $post_month      = $_POST['month'];
          $post_year       = $_POST['year'];
          $post_location   = $_POST['location'];
          $post_start_date = $_POST['start_date'];
          $post_end_date   = $_POST['end_date'];
          $post_price      = $_POST['amount'];
          $post_updateid   = $_POST['updateid'];
          
          if ($post_ttc_name == '' or $post_month == '' or $post_year == '' or $post_location == '' or $post_start_date == '' or $post_price == '') {
              echo "<script>alert('Any of the fields is empty')</script>";
              exit();
          } else {
              $insert_query = "update ttc_schedule set ttc_name = '$post_ttc_name',month = '$post_month',year = '$post_year',location = '$post_location', start_date = '$post_start_date',end_date = '$post_end_date', price = '$post_price' WHERE id='$post_updateid'";
              
              if (mysqli_query($db, $insert_query)) {
                  echo "<script>alert('Updated Successfuly')</script>";
                  echo "<script>window.open('ttc_schedule.php','_self')</script>";
              } else {
                  echo "<script>alert('Updated Failed')</script>";
                  echo "<script>window.open('ttc_schedule.php','_self')</script>";
              }
          }
      }
      ?>
  		<form action="ttc_schedule.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
         <input type="text" class="form-control form-shadow" value="<?php echo $row["ttc_name"] ?>" placeholder="TTC Name" id="ttc_name" name="ttc_name">
        </div>
        <div class="form-group">
          <input type="text" class="form-control form-shadow" value="<?php echo $row["month"] ?>" placeholder="Month" id="month" name="month">
        </div>
        <div class="form-group">
          <input type="text" class="form-control form-shadow" value="<?php echo $row["year"] ?>" placeholder="Year" id="year" name="year">
        </div>
        <div class="form-group">
          <input type="text" class="form-control form-shadow" value="<?php echo $row["location"] ?>" placeholder="Location" id="location" name="location">
        </div>
        <div class="form-group">
          <input type="date" class="form-control form-shadow" value="<?php echo $row["start_date"] ?>" placeholder="DD/MM/YYYY" id="start_date" name="start_date">
        </div>
        <div class="form-group">
          <input type="date" class="form-control form-shadow" value="<?php echo $row["end_date"] ?>" placeholder="DD/MM/YYYY" id="end_date" name="end_date">
        </div>
        <div class="form-group">
          <input type="hidden" value="<?php echo $row["id"] ?>" id="updateid" name="updateid">
          <input type="text" class="form-control form-shadow" value="<?php echo $row["price"] ?>" placeholder="Fees" id="amount" name="amount">
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-info" value="Update" name="update" />
      </div>
	   </form>
    </div>
  </div>
</div>
<?php
    if($row["is_active"] == 1){
      $str.= '<a href="javascript:void(0);" class="btn btn-danger deactive_btn" title="Deactivate" id="btn_'.$row["id"].'" data-id="'.$row["id"].'" data-act="'.$row["is_active"].'">D</a>';
    } else {
      $str.= '<a href="javascript:void(0);" class="btn btn-success deactive_btn" title="Activate" id="btn_'.$row["id"].'" data-id="'.$row["id"].'" data-act="'.$row["is_active"].'">A</a>';
    }
    $str.= '</td>';
    $i++;
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

<div id="classmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add TTC Schedule</h4>
      </div>
      <?php
      if (isset($_POST['submit'])) {
          require_once 'common/dbconf.php';
          $post_ttc_name   = $_POST['ttc_name'];
          $post_month      = $_POST['month'];
          $post_year       = $_POST['year'];
          $post_location   = $_POST['location'];
          $post_start_date = $_POST['start_date'];
          $post_end_date   = $_POST['end_date'];
          $post_price      = $_POST['amount'];
          
          if ($post_ttc_name == '' or $post_month == '' or $post_year == '' or $post_location == '' or $post_start_date == '' or $post_price == '') {
              echo "<script>alert('One of the field is empty')</script>";
              exit();
          } else {
              $insert_query = "insert into ttc_schedule(ttc_name,month,year,location,start_date,end_date,price) values ('$post_ttc_name','$post_month','$post_year','$post_location',
                  '$post_start_date','$post_end_date','$post_price')";
              
              if (mysqli_query($db, $insert_query)) {
                  echo "<script>alert('Inserted Successfuly')</script>";
                  echo "<script>window.open('ttc_schedule.php','_self')</script>";
                  
              } else {
                  echo "<script>alert('Inserted Failed')</script>";
                  echo "<script>window.open('ttc_schedule.php','_self')</script>";
              }
          }
      }
      ?>
  		<form action="ttc_schedule.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
              <input type="text" class="form-control form-shadow" value="<?php echo $row["ttc_name"] ?>" placeholder="TTC Name" id="ttc_name" name="ttc_name">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" value="<?php echo $row["month"] ?>" placeholder="Month" id="month" name="month">
            </div>
		      	<div class="form-group">
              <input type="text" class="form-control form-shadow" value="<?php echo $row["year"] ?>" placeholder="Year" id="year" name="year">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" value="<?php echo $row["location"] ?>" placeholder="Location" id="location" name="location">
            </div>
    				<div class="form-group">
              <input type="date" class="form-control form-shadow" value="<?php echo $row["start_date"] ?>" placeholder="DD/MM/YYYY" id="start_date" name="start_date">
            </div>
            <div class="form-group">
              <input type="date" class="form-control form-shadow" value="<?php echo $row["end_date"] ?>" placeholder="DD/MM/YYYY" id="end_date" name="end_date">
            </div>
            <div class="form-group">
	        		 <input type="hidden" value="<?php echo $row["id"] ?>" id="updateid" name="updateid">
               <input type="text" class="form-control form-shadow" value="<?php echo $row["price"] ?>" placeholder="Fees" id="amount" name="amount">
            </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-info" value="Submit" name="submit" />
      </div>
	   </form>
    </div>

  </div>
</div>
<script>
$(function(){
    $(document).on('click', '.deactive_btn', function(){
        $('body').addClass('loading');
        var cid = $(this).data('id');
        var act = $(this).data('act');
        $.post("update_ttc_sch_status.php", {'cid':cid, 'act':act}, function(data){
          $('body').removeClass('loading');
            if(data.trim() == 'success'){
                if(act == 1){
                  $('#btn_'+cid).removeClass('btn-danger').addClass('btn-success').attr('title', 'Activate').text('A').data('id', 0);
                  $('#act_'+cid).removeClass('bg-success').addClass('bg-warning').text('Not Active');
                }else if(act == 0){
                  $('#btn_'+cid).removeClass('btn-success').addClass('btn-danger').attr('title', 'Deactivate').text('D').data('id', 1);
                  $('#act_'+cid).removeClass('bg-warning').addClass('bg-success').text('Active');
                }
              $('#class_smsg').slideDown();
              setTimeout(function(){
                $('#class_smsg').slideUp();
              }, 1000);
            }else{
              $('#class_emsg').slideDown();
              setTimeout(function(){
                $('#class_emsg').slideUp();
              }, 1000);
            }
        });
    });
});
</script>
</body>
</html>
