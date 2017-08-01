<?php
include 'common/session_check.php';
$currentPage = "classes";
include 'common/header.php';
?>
<section class="innerpage">
  <h1 class="user_head">Welcome <?php echo $_SESSION["username"];?></h1>
  <div class="table_wrapper bookingdetails">
    <div class="container-fluid">
    <div class="row">
      <div class="col-xs-6"><h2 class="headertable">Class Details</h2></div>
      <div class="col-xs-6 text-right"><a href="#classmodal" class="btn btn-info" data-toggle="modal">Add New</a></div>
    </div>
  </div>
    <div class="container-fluid" id="booking_container">
        <div class="error_msg" id="class_emsg">Unable to update</div>
        <div class="success_msg" id="class_smsg">Successfully updated</div>
          <?php
          require_once 'common/dbconf.php';

          $sql = "select * from product where class_type='Weekend' OR class_type='Weekday' ";
          $data = $db->query($sql);
          $str = '';
          $i = 1;
          if ($data->num_rows > 0) {
              $str.= '<div class="table-responsive"><table class="table"><tbody>';
              $str.= '<thead><th>Id</th><th>Class Type</th><th>Type</th><th>Duration</th><th>Amount</th><th>Currency</th><th>Status</th><th>&nbsp;</th></thead><tbody>';
              while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
                  $str.= '<tr>';
                  $str.= '<td>' . $row["id"] . '</td>';
                  $str.= '<td>' . $row["class_type"] . '</td>';
                  $str.= '<td>' . $row["type"] . '</td>';
                  $str.= '<td>' . $row["duration"] . ' (' . $row['duration_unit'] . ')</td>';
                  $str.= '<td>' . $row["price"] . '/-</td>';
                  $str.= '<td>' . $row["currency"] . '</td>';
                  if ($row["is_active"] == 1) {
                      $str.= '<td class="bg-success" id="act_' . $row["id"] . '">Active</td>';
                  } else {
                      $str.= '<td class="bg-warning" id="act_' . $row["id"] . '">Not Active</td>';
                  }
                  $str.= '<td><a href="#classmodaledit' . $i . '" class="btn btn-default edit_btn" data-toggle="modal" title="edit">E</a> &nbsp;';
          ?>				
				<div id="classmodaledit<?php echo $i; ?>" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Class</h4>
      </div>
      <?php
      if (isset($_POST['update'])) {
          require_once 'common/dbconf.php';
          $post_type = $_POST['class_type'];
          $post_type1 = $_POST['type'];
          $post_duration = $_POST['duration'];
          $post_duration_unit = $_POST['duration_unit'];
          $post_amount = $_POST['amount'];
          $post_currency = $_POST['currency'];
          $post_description = $_POST['description'];
          $post_updateid = $_POST['updateid'];
          if ($post_type == '' or $post_type1 == '' or $post_duration == '' or $post_duration_unit == '' or $post_amount == '' or $post_currency == '' or $post_description == '') {
              echo "<script>alert('One of the field is empty, Please provide the details')</script>";
              exit();
          } else {
              $insert_query = "update product set class_type = '$post_type',type = '$post_type1',duration = '$post_duration',duration_unit = '$post_duration_unit', price = '$post_amount',currency = '$post_currency', description= '$post_description' WHERE id='$post_updateid'";
              if (mysqli_query($db, $insert_query)) {
                  echo "<script>alert('Updated Successfuly')</script>";
                  echo "<script>window.open('manage_classes.php','_self')</script>";
              } else {
                  echo "<script>alert('Updated Failed')</script>";
                  echo "<script>window.open('manage_classes.php','_self')</script>";
              }
          }
      }
      ?>
      <form action="manage_classes.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <select class="form-control form-shadow" name="class_type">
              <option value="">Class Type</option>
                <?php
                if ($row['class_type'] == "Weekend") {
                    echo '<option value="Weekday" selected="selected">Weekday</option>';
                    echo ' <option value="Weekend">Weekend</option>';
                } else {
                    echo '<option value="Weekday">Weekday</option>';
                    echo ' <option value="Weekend" selected="selected">Weekend</option>';
                } ?>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control form-shadow" name="type">
              <option value="">Type</option>
                <?php 
                if ($row['type'] == "Regular Classes") { 
                 echo '<option value="Regular Classes" selected="selected">Regular Classes</option>';
                } ?>
             </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-shadow"  value="<?php echo $row["duration"] ?>" placeholder="Duration" id="duration" name="duration">
          </div>
          <div class="form-group">
            <select class="form-control form-shadow" name="duration_unit">
              <option value="">Duration Units</option>
                <?php
                if ($row['duration_unit'] == "Months") {
                    echo '<option value="Months" selected="selected">Months</option>';
                    echo ' <option value="Hours">Hours</option>';
                    echo ' <option value="Days & Nights">Days & Nights</option>';
                } elseif ($row['duration_unit'] == "Hours") {
                    echo '<option value="Hours">Hours</option>';
                    echo ' <option value="Months" selected="selected">Months</option>';
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
            <textarea class=" form-control form-shadow " cols="85" rows="10" placeholder="Description" id="description" name="description"><?php echo $row["description"] ?></textarea>
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
        $str .= '<a href="javascript:void(0);" class="btn btn-danger deactive_btn" title="Deactivate" id="btn_' . $row["id"] . '" data-id="' . $row["id"] . '" data-act="' . $row["is_active"] . '">D</a>';
    } else {
        $str .= '<a href="javascript:void(0);" class="btn btn-success deactive_btn" title="Activate" id="btn_' . $row["id"] . '" data-id="' . $row["id"] . '" data-act="' . $row["is_active"] . '">A</a>';
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
        <h4 class="modal-title">Add/Modify Class</h4>
      </div>
      <?php
      if (isset($_POST['submit'])) {
          require_once 'common/dbconf.php';
          $post_type          = $_POST['class_type'];
          $post_type1         = $_POST['type'];
          $post_duration      = $_POST['duration'];
          $post_duration_unit = $_POST['duration_unit'];
          $post_amount        = $_POST['amount'];
          $post_currency      = $_POST['currency'];
          $post_description   = $_POST['description'];
          
          if ($post_type == '' or $post_type1 == '' or $post_duration == '' or $post_duration_unit == '' or $post_amount == '' or $post_currency == '' or $post_description == '') {
              echo "<script>alert('Any of the fields is empty')</script>";
              exit();
          } else {
              $insert_query = "insert into product(class_type,type,duration,duration_unit,price,currency,description) values ('$post_type','$post_type1','$post_duration','$post_duration_unit','$post_amount','$post_currency','$post_description')";
              if (mysqli_query($db, $insert_query)) {
                  echo "<script>alert('Inserted Successfuly')</script>";
                  echo "<script>window.open('manage_classes.php','_self')</script>";
              } else {
                  echo "<script>alert('Insert Failed')</script>";
                  echo "<script>window.open('manage_classes.php','_self')</script>";
              }
          }
      }
      ?>
		  <form action="manage_classes.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
            <div class="form-group">
              <select class="form-control form-shadow" name="class_type">
                <option value="">Class Type</option>
                <option value="Weekday">Weekday</option>
                <option value="Weekend">Weekend</option>
              </select>
            </div>
      			<div class="form-group">
              <select class="form-control form-shadow" name="type">
                <option value="">Type</option>
                <option value="Regular Classes">Regular Classes</option>
             
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" placeholder="Duration in months" id="duration" name="duration">
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
              <textarea class=" form-control form-shadow " cols="85" rows="10"  placeholder="Description" id="description" name="description"><?php echo $row["description"] ?></textarea>
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
            if(data == 'success'){
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
