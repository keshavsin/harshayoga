<?php
include 'common/session_check.php';
$currentPage = "retreat";
include 'common/header.php';
?>
<section class="innerpage">
  <h1 class="user_head">Welcome <?php echo $_SESSION["username"];?></h1>
  <div class="table_wrapper bookingdetails">
    <div class="container-fluid">
    <div class="row">
      <div class="col-xs-6"><h2 class="headertable">Retreat Details</h2></div>
      <div class="col-xs-6 text-right"><a href="#classmodal" class="btn btn-info" data-toggle="modal">Add New</a></div>
    </div>
  </div>
    <div class="container-fluid" id="booking_container">
        <div class="error_msg" id="class_emsg">Error while updating, Refresh page and try again !!</div>
        <div class="success_msg" id="class_smsg">Successfully updated</div>
          <?php
          require_once 'common/dbconf.php';
          $sql  = "select * from product where type='Retreat' order by title";
          $data = $db->query($sql);
          $str  = '';
          $i    = 1;
          if ($data->num_rows > 0) {
              $str .= '<div class="table-responsive"><table class="table"><tbody>';
              $str .= '<thead><th>Id</th><th>Type</th><th>Name</th><th>Duration</th><th>Amount</th><th>Currency</th><th>Start Date</th><th>End Date</th><th>Status</th><th>&nbsp;</th></thead><tbody>';
              while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
                  $str .= '<tr>';
                  $str .= '<td>' . $row["id"] . '</td>';
                  $str .= '<td>' . $row["type"] . '</td>';
                  $str .= '<td>' . $row["title"] . '</td>';
                  $str .= '<td>' . $row["duration"] . ' (' . $row['duration_unit'] . ')</td>';
                  $str .= '<td>' . $row["price"] . '/-</td>';
                  $str .= '<td>' . $row["currency"] . '</td>';
                  $str .= '<td>' . $row["start_date"] . '</td>';
                  $str .= '<td>' . $row["end_date"] . ' </td>';
                  if ($row["is_active"] == 1) {
                      $str .= '<td class="bg-success" id="act_' . $row["id"] . '">Active</td>';
                  } else {
                      $str .= '<td class="bg-warning" id="act_' . $row["id"] . '">Not Active</td>';
                  }
                  $str .= '<td><a href="#classmodaledit' . $i . '" class="btn btn-default edit_btn" data-toggle="modal" title="edit">E</a> &nbsp;';
          ?>
				
				<div id="classmodaledit<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Retreat</h4>
      </div>
      <?php
      if (isset($_POST['update'])) {
          require_once 'common/dbconf.php';
          $post_type          = $_POST['type'];
          $post_title         = $_POST['title'];
          $post_duration      = $_POST['duration'];
          $post_duration_unit = $_POST['duration_unit'];
          $post_amount        = $_POST['amount'];
          $post_currency      = $_POST['currency'];
          $post_start_date    = $_POST['start_date'];
          $post_end_date      = $_POST['end_date'];
          $post_description   = $_POST['description'];
          $post_updateid      = $_POST['updateid'];
          
          if ($post_type == '' or $post_title == '' or $post_duration == '' or $post_duration_unit == '' or $post_amount == '' or $post_currency == '' or $post_start_date == '' or $post_end_date == '' or $post_description == '') {
              echo "<script>alert('One of the field is empty')</script>";
              exit();
          } else {
              $insert_query = "update product set type = '$post_type',title = '$post_title',duration = '$post_duration',duration_unit = '$post_duration_unit',
                  price='$post_amount',currency = '$post_currency',start_date = '$post_start_date',end_date = '$post_end_date', description = '$post_description' WHERE id='$post_updateid'";
              echo "<script>alert('" . $insert_query . "')</script>";
              if (mysqli_query($db, $insert_query)) {
                  echo "<script>alert('Updated Successfuly')</script>";
                  echo "<script>window.open('manage_retreat.php','_self')</script>";
              } else {
                  echo "<script>alert('Update Failed')</script>";
                  echo "<script>window.open('manage_retreat.php','_self')</script>";
              }
          }
      }
      ?>
      <form action="manage_retreat.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          
            <div class="form-group">
              <select class="form-control form-shadow" name="type" readOnly>
                <option value="Retreat" selected="selected">Retreat</option>
              </select>
            </div>
			      <div class="form-group">
              <input type="text" class="form-control form-shadow" value="<?php echo $row["title"] ?>" placeholder="Title" id="title" name="title">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" value="<?php echo $row["duration"] ?>" placeholder="Duration" id="duration" name="duration">
            </div>
			      <div class="form-group">
              <select class="form-control form-shadow" id="duration_unit" name="duration_unit">
                <option value="">Duration Units</option>
                  <?php 
                  if ($row['duration_unit'] == "Months") { 
                    echo '<option value="Months" selected="selected">Months</option>';
                    echo ' <option value="Hours">Hours</option>';
                    echo ' <option value="Days & Nights">Days & Nights</option>';
                  } elseif ($row['duration_unit'] == "Hours"){
                    echo '<option value="Hours" selected="selected">Hours</option>';
                    echo ' <option value="Months">Months</option>';
                    echo ' <option value="Days & Nights">Days & Nights</option>';
                  } else {
                    echo ' <option value="Days & Nights" selected="selected">Days & Nights</option>';
                    echo '<option value="Hours">Hours</option>';
                    echo ' <option value="Months" >Months</option>';
                  } ?>
              </select>
            </div>
            <div class="form-group">
              <input type="hidden" value="<?php echo $row["id"] ?>" id="updateid" name="updateid">
              <input type="text" class="form-control form-shadow" value="<?php echo $row["price"] ?>" placeholder="Amount" id="amount" name="amount">
            </div>
            <div class="form-group">
              <select type="text" class="form-control form-shadow" id="currency" name="currency">
                <option value="">Currency</option>
                  <?php 
                  if ($row['currency'] == "INR") { 
                   echo ' <option value="INR" selected="selected">INR</option>';
                  } ?>
              </select>
            </div>
    				<div class="form-group">
              <input type="date" class="form-control form-shadow" value="<?php echo $row["start_date"] ?>" placeholder="DD/MM/YYYY" id="start_date" name="start_date">
            </div>
            <div class="form-group">
              <input type="date" class="form-control form-shadow" value="<?php echo $row["end_date"] ?>" placeholder="DD/MM/YYYY" id="end_date" name="end_date">
            </div>
    			  <div class="form-group">
              <textarea class=" form-control form-shadow " cols="85" rows="10"  placeholder="Description" id="description" name="description"><?php echo $row["description"] ?></textarea>
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
    if ($row["is_active"] == 1) {
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
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Retreat</h4>
      </div>
      <?php
      if (isset($_POST['submit'])) {
          require_once 'common/dbconf.php';
          $post_type          = $_POST['type'];
          $post_title         = $_POST['title'];
          $post_duration      = $_POST['duration'];
          $post_duration_unit = $_POST['duration_unit'];
          $post_amount        = $_POST['amount'];
          $post_currency      = $_POST['currency'];
          
          $post_start_date  = $_POST['start_date'];
          $post_end_date    = $_POST['end_date'];
          $post_description = $_POST['description'];
          
          if ($post_type == '' or $post_duration == '' or $post_amount == '' or $post_currency == '' or $post_start_date == '' or $post_end_date == '' or $post_description == '') {
              echo "<script>alert('One of the field is empty')</script>";
              exit();
          } else {
              $insert_query = "insert into product(type,title,duration,duration_unit,price,currency,start_date,end_date,description) values ('$post_type','$post_title','$post_duration','$post_duration_unit','$post_amount','$post_currency','$post_start_date','$post_end_date','$post_description')";
              if (mysqli_query($db, $insert_query)) {
                  echo "<script>alert('Added new Retreat')</script>";
                  echo "<script>window.open('manage_retreat.php','_self')</script>";
              } else {
                  echo "<script>alert('Addition of new entry failed')</script>";
                  echo "<script>window.open('manage_retreat.php','_self')</script>";
              }
          }
      }
      ?>
  		<form action="manage_retreat.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
            <div class="form-group">
              <select class="form-control form-shadow" name="type" readOnly>
                <option value="Retreat" selected="selected">Retreat</option>
              </select>
            </div>
    			  <div class="form-group">
              <input type="text" class="form-control form-shadow" placeholder="Title" id="title" name="title">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" placeholder="Duration" id="duration" name="duration">
            </div>
		  		 <div class="form-group">
              <select class="form-control form-shadow" name="duration_unit">
                <option value="">Duration Unit</option>
                <option value="Months">Months</option>
                <option value="Hours">Hours</option>
			      	  <option value="Days & Nights">Days & Nights</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" placeholder="Amount" id="amount" name="amount">
            </div>
            <div class="form-group">
              <select type="text" class="form-control form-shadow" id="currency" name="currency">
                <option value="">Currency</option>
                <option value="INR">INR</option>
              </select>
            </div>
      			<div class="form-group">
              <input type="date" class="form-control form-shadow" value="<?php echo $row["start_date"] ?>" placeholder="DD/MM/YYYY" id="start_date" name="start_date">
            </div>
            <div class="form-group">
              <input type="date" class="form-control form-shadow" value="<?php echo $row["end_date"] ?>" placeholder="DD/MM/YYYY" id="end_date" name="end_date">
            </div>
			     <div class="form-group">
              <textarea class=" form-control form-shadow " cols="85" rows="10"  placeholder="Description" id="description" name="description"></textarea>
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
        $.post("change_classstatus.php", {'cid':cid, 'act':act}, function(data){
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
