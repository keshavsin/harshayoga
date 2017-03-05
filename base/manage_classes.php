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
              <?php
                  require_once 'common/dbconf.php';
                  $sql = "select * from classes";
                  $data = $db->query($sql);
                  $str = '';
                  if($data->num_rows>0){
                    $str.= '<div class="table-responsive"><table class="table"><tbody>';
                    $str.= '<thead><th>Id</th><th>Ref. No.</th><th>Type</th><th>Duration</th><th>Amount</th><th>Currency</th><th>Type</th><th>&nbsp;</th></thead><tbody>';
                    while( $row = $data->fetch_array(MYSQLI_ASSOC)){
                      $str.= '<tr>';
                      $str.= '<td>'.$row["id"].'</td>';
                      $str.= '<td>'.$row["reference_no"].'</td>';
                      $str.= '<td>'.$row["type"].'</td>';
                      $str.= '<td>'.$row["duration"].' months</td>';
                      $str.= '<td>'.$row["amount"].'/-</td>';
                      $str.= '<td>'.$row["currency"].'</td>';
                      if($row["is_active"] == 1){
                        $str.= '<td class="bg-success">Active</td>';
                      }else{
                        $str.= '<td class="bg-warning">Not Active</td>';
                      }

                      $str.= '<td><a href="#classmodal" class="btn btn-default edit_btn" data-toggle="modal" title="edit">E</a> &nbsp; <a href="#classmodal" class="btn btn-danger" title="delete">D</a></td>';
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
                <option value="weekend">Weekwnd</option>
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
</body>
</html>
