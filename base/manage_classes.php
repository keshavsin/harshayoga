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
                  $sql = "select * from product where type='class'";
                  $data = $db->query($sql);
                  $str = '';
                  if($data->num_rows>0){
                    $str.= '<div class="table-responsive"><table class="table"><tbody>';
                    $str.= '<thead><th>Id</th><th>Ref. No.</th><th>Type</th><th>Duration</th><th>Amount</th><th>Currency</th><th>Type</th><th>&nbsp;</th></thead><tbody>';
                    while( $row = $data->fetch_array(MYSQLI_ASSOC)){
                      $str.= '<tr>';
                      $str.= '<td>'.$row["id"].'</td>';
                      $str.= '<td>'.$row["reference_no"].'</td>';
                      $str.= '<td>'.$row["class_type"].'</td>';
                      $str.= '<td>'.$row["duration"].' months</td>';
                      $str.= '<td>'.$row["price"].'/-</td>';
                      $str.= '<td>'.$row["currency"].'</td>';
                      if($row["is_active"] == 1){
                        $str.= '<td class="bg-success" id="act_'.$row["id"].'">Active</td>';
                      }else{
                        $str.= '<td class="bg-warning" id="act_'.$row["id"].'">Not Active</td>';
                      }

                      $str.= '<td><a href="#classmodal" class="btn btn-default edit_btn" data-toggle="modal" title="edit">E</a> &nbsp;';
                      if($row["is_active"] == 1){
                      $str.= '<a href="javascript:void(0);" class="btn btn-danger deactive_btn" title="Deactivate" id="btn_'.$row["id"].'" data-id="'.$row["id"].'" data-act="'.$row["is_active"].'">D</a>';
                      }else{
                        $str.= '<a href="javascript:void(0);" class="btn btn-success deactive_btn" title="Activate" id="btn_'.$row["id"].'" data-id="'.$row["id"].'" data-act="'.$row["is_active"].'">A</a>';
}
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
      <div class="modal-body">
          <form>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" placeholder="Reference No." id="refno">
            </div>
            <div class="form-group">
              <select type="text" class="form-control form-shadow" id="type">
                <option value="">Type</option>
                <option value="weekday">Weekday</option>
                <option value="weekend">Weekend</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" placeholder="Duration in months" id="duration">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-shadow" placeholder="Amount" id="amount">
            </div>
            <div class="form-group">
              <select type="text" class="form-control form-shadow" id="currency">
                <option value="">Currency</option>
                <option value="weekday">INR</option>
              </select>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Submit</button>
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
