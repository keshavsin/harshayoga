<?php
include 'common/session_check.php';
$currentPage = "testimonial";
include 'common/header.php';
?>
<section class="innerpage">
  <h1 class="user_head">Welcome <?php echo $_SESSION["username"];?></h1>
  <div class="table_wrapper bookingdetails">
    <div class="container-fluid">
    <div class="row">
      <div class="col-xs-6"><h2 class="headertable">Testimonial</h2></div>
      <div class="col-xs-6 text-right"><a href="#classmodal" class="btn btn-info" data-toggle="modal">Add New</a></div>
    </div>
  </div>
    <div class="container-fluid" id="booking_container">
        <div class="error_msg" id="class_emsg">Unable to Update</div>
        <div class="success_msg" id="class_smsg">Successfully Updated</div>
        <?php
        require_once 'common/dbconf.php';
        $sql  = "select * from testimonials where is_active='1'";
        $data = $db->query($sql);
        $str  = '';
        $i    = 1;
        if ($data->num_rows > 0) {
            $str .= '<div class="table-responsive"><table class="table"><tbody>';
            $str .= '<thead><th>Id</th><th>Username</th><th>Photo</th><th>Remarks</th><th>Status</th><th>&nbsp;</th></thead><tbody>';
            while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
                $str .= '<tr>';
                $str .= '<td>' . $row["id"] . '</td>';
                $str .= '<td>' . $row["username"] . '</td>';
                $str .= '<td>' . $row["photo"] . '</td>';
                $str .= '<td>' . $row["remarks"] . '</td>';
                
                if ($row["is_active"] == 1) {
                    $str .= '<td class="bg-success" id="act_' . $row["id"] . '">Active</td>';
                } else {
                    $str .= '<td class="bg-warning" id="act_' . $row["id"] . '">Not Active</td>';
                }
                $str .= '<td><a href="#classmodaledit' . $i . '" class="btn btn-default edit_btn" data-toggle="modal" title="edit">Edit</a> &nbsp;';
        ?>
<div id="classmodaledit<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Testimonial</h4>
      </div>
      <?php
      if (isset($_POST['update'])) {
          require_once 'common/dbconf.php';
          $post_username = $_POST['username'];
          $post_photo    = $_FILES['photo']['name'];
          $image_tmp     = $_FILES['photo']['tmp_name'];
          $post_remarks  = $_POST['remarks'];
          $post_updateid = $_POST['updateid'];
          
          if ($post_username == '' or $post_photo == '' or $post_remarks == '') {
              echo "<script>alert('All fields are required')</script>";
              echo "<script>window.open('testimonial.php','_self')</script>";
          } else {
            move_uploaded_file($image_tmp, "../assets/images/testimonial/$post_photo");
              $insert_query = "update testimonials set username = '$post_username',photo = '$post_photo',remarks = '$post_remarks' WHERE id = '$post_updateid'";
              if (mysqli_query($db, $insert_query)) {
                  echo "<script>alert('Updated Successfuly')</script>";
                  echo "<script>window.open('testimonial.php','_self')</script>";
              } else {
                  echo "<script>alert('Updated Failed')</script>";
                  echo "<script>window.open('testimonial.php','_self')</script>";
              }
          }
      }
      ?>
      <form action="testimonial.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control form-shadow" value="<?php echo $row["username"] ?>" placeholder="Name" id="username" name="username">
          </div>
			 <div class="form-group">
          <input type="file" class="form-control form-shadow" value="<?php echo $row["photo"] ?>" placeholder="Photo" id="photo" name="photo">
        </div>
       <div class="form-group">
          <input type="hidden" value="<?php echo $row["id"] ?>" id="updateid" name="updateid">
          <textarea rows="4" cols="50" class="form-control form-shadow" placeholder="Enter Reviews Here" id="remarks" name="remarks"><?php echo $row["remarks"] ?></textarea>
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
/*    if ($row["is_active"] == 1) {
        $str .= '<a href="javascript:void(0);" class="btn btn-danger deactive_btn" title="Deactivate" id="btn_' . $row["id"] . '" data-id="' . $row["id"] . '" data-act="' . $row["is_active"] . '">D</a>';
    } else {
        $str .= '<a href="javascript:void(0);" class="btn btn-success deactive_btn" title="Activate" id="btn_' . $row["id"] . '" data-id="' . $row["id"] . '" data-act="' . $row["is_active"] . '">A</a>';
    }*/
    $str .= '</td>';
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
  <div class="modal-dialog modal-md">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Testimonial</h4>
      </div>
      <?php
      if (isset($_POST['submit'])) {
          require_once 'common/dbconf.php';
          $post_username = $_POST['username'];
          
          $post_photo   = $_FILES['photo']['name'];
          $image_tmp    = $_FILES['photo']['tmp_name'];
          $post_remarks = $_POST['remarks'];
          
          if ($post_username == '' or $post_photo == '' or $post_remarks == '') {
              echo "<script>alert('Any of the fields is empty')</script>";
              echo "<script>window.open('testimonial.php','_self')</script>";
          } else {
              move_uploaded_file($image_tmp, "../assets/images/testimonial/$post_photo");
              $insert_query = "insert into testimonials(username,photo,remarks, is_active,created_date) values ('$post_username','$post_photo','$post_remarks','1',NOW())";
              
              if (mysqli_query($db, $insert_query)) {
                  echo "<script>alert('Inserted Successfuly')</script>";
                  echo "<script>window.open('testimonial.php','_self')</script>";
              } else {
                  echo "<script>alert('Inserted Failed')</script>";
                  echo "<script>window.open('testimonial.php','_self')</script>";
              }
          }
      }
      ?>
      <form action="testimonial.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control form-shadow" value="<?php echo $row["username"] ?>" placeholder="Name" id="username" name="username">
          </div>
          <div class="form-group">
            <input type="file" class="form-control form-shadow" value="<?php echo $row["photo"] ?>" placeholder="Photo" id="photo" name="photo">
          </div>
          <div class="form-group">
            <input type="hidden" value="<?php echo $row["id"] ?>" id="updateid" name="updateid">
            <textarea rows="4" cols="50" class="form-control form-shadow" value="<?php echo $row["remarks"] ?>" placeholder="Remarks" id="remarks" name="remarks"></textarea>
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
