<?php
include 'sessioncheck.php';
session_start();
$currentPage = "dahsboard";
include 'common/header.php';
?>
      <section class="innerpage">
        <div id="about_harsha">
          <div class="about_innr">
            <div class="container-fluid" id="loggedin_wrap">
            <h1 class="user_head text-center">Welcome <span id="name_txt"><?php echo $name;?></span></h1>
          </div>
          <div class="avatar_wrap">
              <img src="assets/images/users/<?php echo $image;?>">
              <a href="#edit_image" class="edit" data-toggle="modal"></a>
          </div>
          <div class="table-responsive">
              <table class="table table-striped">
                  <tbody>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $email;?></td>
                    </tr>
                    <tr>
                        <th id="mobile_txt">Mobile</th>
                        <td><?php echo $mobile;?></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td id="city_txt"><?php echo $city;?></td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td id="country_txt"><?php echo $country;?></td>
                    </tr>
                  </tbody>
              </table>
          </div>
          <div class="edit_btnwrap text-center">
              <a href="#profile_modal" data-toggle="modal" class="btn btn-primary" id="edit_pf">Edit Profile</a>
          </div>
        </div>
      </div>
      </div>
     </section>
     <div id="profile_modal" class="modal fade" role="dialog">
       <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <form name="profileupdateform" action="" method="post">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" id="close_update">&times;</button>
             <h4 class="modal-title">Edit Profile</h4>
           </div>
           <div class="modal-body class-info">
              <div class="container-fluid">
                <div class="success_msg" id="pf_success"></div>
                    <div class="error_msg" id="profile_error"></div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="email" class="form-control form-shadow" placeholder="Email" id="email" value="<?php echo $email;?>" readonly="">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="text" class="form-control form-shadow" placeholder="Name" id="name" value="<?php echo $name;?>">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="tel" class="form-control form-shadow" placeholder="Mobile" id="mobile" value="<?php echo $mobile;?>">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="text" class="form-control form-shadow" placeholder="City" id="city" value="<?php echo $city;?>">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="text" class="form-control form-shadow" placeholder="Country" id="country" value="<?php echo $country;?>">
                    </div>
                  </div>
                    </div>
              </div>
           </div>
           <div class="modal-footer text-center"><a type="button" class="btn btn-primary" href="javascript:void(0);" id="update_pf">Submit</a></div>
         </form>
        </div>
      </div>
    </div>
    <div id="edit_image" class="modal fade" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form name="image_update" action="" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Image</h4>
          </div>
          <div class="modal-body class-info">
             <div class="container-fluid">
                   <div class="error_msg"></div>
                   <div id='preview'>
</div>
<form id="imageform" method="post" enctype="multipart/form-data" action='profileimage.php'>
Upload image:
<div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="photoimg" id="photoimg" />

</div>
</form>
             </div>
          </div>
          <div class="modal-footer text-center"><a type="button" class="btn btn-primary" href="#">Submit</a></div>
        </form>
       </div>
     </div>
   </div>

  <?php include 'common/footer.php'; ?>
  <script>
   $(function(){
  <?php
  if($name == '' || $name == NULL){
  ?>
      $('#profile_error').text('Please complete you profile').show();
      $('#edit_pf').click();
    <?php } ?>
    function validateMobile(mobile){
        var phonedef = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/;
        return phonedef.test(mobile);
    }
    		$('#update_pf').on('click', function(e) {
    			e.preventDefault();
    			var slf = $(this);
          var name, phone, country,city = '';
    			if(!slf.hasClass('loading')){
    		   		name = $('#name').val();
              phone = $('#mobile').val();
              country = $('#country').val();
              city = $('#city').val();
              if($.trim(name) == '') {
                        $('.error_msg').html("Password can't be blank").slideDown();
            }else if(!validateMobile(phone)) {
                  $('.error_msg').html("Invalid Mobile number").slideDown();
    				}else{
    					slf.addClass('loading');
    					$.ajax({
    					  url: 'updateprofile.php',
    					  data: {'name': name, 'phone':phone, 'country':country, 'city':city},
    					  type: 'POST',
    					  success: function(response){
    						if(response == 'error'){
    							$('.error_msg').html("Unable to update! please try again").slideDown();
    							slf.removeClass('loading');
    						}else if(response == 'success'){
                  $('#name_txt').text(name);
                  $('#mobile_txt').text(phone);
                  $('#country_txt').text(country);
                  $('#city_txt').text(city);
                   $('#pf_success').html("Successfully updated!").slideDown(function(){
                     setTimeout(function(){$('#pf_success').slideUp();$("#close_update").click();}, 500);
                   });
    						}
    					  }
    					});
    				}
    			}
    	});
    	$('input').on('focus', function(){
    		$('.error_msg, .succes_msg').slideUp();
    	});
    });
  </script>
</body>
</html>
