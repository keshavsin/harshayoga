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
              $str.= '<thead><th>Id</th><th>Product ID</th><th>Name</th><th>Email</th><th>Amount paid</th><th>Booking Date</th><th>Status</th><th>&nbsp;</th></thead><tbody>';
              while( $row = $data->fetch_array(MYSQLI_ASSOC)){
                $str.= '<tr>';
                $str.= '<td>'.$row["id"].'</td>';
				$str.= '<td>'.$row["product_id"].'</td>';
             
                $str.= '<td>'.$row["name"].' </td>';
                $str.= '<td>'.$row["email"].'</td>';
                $str.= '<td>'.$row["amount_paid"].'</td>';
				$str.= '<td>'.$row["booking_date"].' </td>';
                $str.= '<td>'.$row["status"].'</td>';
              
               

               
                $str.= '</td>';
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

<div id="classmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add/Modify Class</h4>
      </div>
	   <?php
		if(isset($_POST['submit']))
		{ 
			$post_type = $_POST['class_type'];
			$post_duration = date('duration');
			$post_amount = $_POST['amount'];
			$post_currency = $_POST['currency'];
			
			if($post_type=='' or $post_duration=='' or $post_amount=='' or $post_currency=='')
			{
	
			echo "<script>alert('Any of the fields is empty')</script>";
			exit();
			}

		else {
	
	
			$insert_query = "insert into product (class_type,duration,amount,currency) values ('$post_type','$post_duration','$post_amount','$post_currency')";
	
		if(mysql_query($insert_query)){
	
			echo "<script>alert('post published successfuly')</script>";
				echo "<script>window.open('view_posts.php','_self')</script>";
	
			}


}

		}

		?>
      <div class="modal-body">
          <form>
            
            <div class="form-group">
              <select type="text" class="form-control form-shadow" id="type" name="class_type">
                <option value="">Type</option>
                <option value="weekday">Weekday</option>
                <option value="weekend">Weekend</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" placeholder="Duration in months" id="duration" name="duration">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" placeholder="Amount" id="amount" name="amount">
            </div>
            <div class="form-group">
              <select type="text" class="form-control form-shadow" id="currency" name="currency">
                <option value="">Currency</option>
                <option value="">INR</option>
              </select>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal" name="save">Submit</button>
      </div>
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
