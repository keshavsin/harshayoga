<?php
include 'sessioncheck.php';
$currentPage = "change password";
include 'common/header.php';
?>
  <section id="about_harsha">
      <div class="login_wrapper">
      <div class="container-fluid">
        <div class="row">
        <div class="col-sm-12 contact_text">
          <div class="form-group">
          <h2 class="heading1 colr_h fp">Change Password</h2>
        </div>
          <div class="container-fluid">
            <form name="sign_inform" action="" method="post">
              <div class="error_msg"></div>
              <div class="success_msg"></div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="password" class="form-control form-shadow" placeholder="Old Password" id="old_passwrd">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="password" class="form-control form-shadow" placeholder="New Password" id="new_passwrd">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="password" class="form-control form-shadow" placeholder="Confirm Password" id="cn_passwrd">
                </div>
              </div>
                <div class='col-xs-12'>
                <div class="form-group">
                 <a class="btn btn-submit gradiant_bg btn-block" id="submit_btn">Submit</a>
                </div>
                </div>
                </div>
              </form>
                </div>
                </div>
                 </div>
            </div>
            </div>
    </section>
<?php include 'common/footer.php';?>
<script>
$(function(){
	$('#submit_btn').on('click', function(e) {
			e.preventDefault();
			var slf = $(this);
			if(!slf.hasClass('loading')){
				var old = $('#old_passwrd').val();
		   		var nw = $('#new_passwrd').val();
          var cn = $('#cn_passwrd').val();
				if($.trim(old) == '') {
                    $('.error_msg').html("Old password required").slideDown();
                }else if($.trim(nw) == '') {
                            $('.error_msg').html("New password required").slideDown();
                        }else if($.trim(cn) == '') {
                                    $('.error_msg').html("Confirm password required").slideDown();
                                }else if(nw !== cn) {
                                            $('.error_msg').html("New and Confirm password do not match").slideDown();
                                        }else{
					slf.addClass('loading');
					$.ajax({
					  url: 'changepasswrdcheck.php',
					  data: {'old': old, 'nw': nw},
					  type: 'POST',
					  success: function(response){
						if(response == 'error'){
							$('.error_msg').html("Invalid User").slideDown();
							slf.removeClass('loading');
						}else if(response == 'success'){
              $('.success_msg').html("Password successfully changed").slideDown();
              $('.form-control').val('');
              slf.removeClass('loading');
						}else if(response == 'notactive'){
              $('.error_msg').html("Incorrect old password").slideDown();
              slf.removeClass('loading');
            }
            else{
              $('.error_msg').html("Something Went Wrong ! please try again").slideDown();
              slf.removeClass('loading');
						}
					  }
					});
				}
			}
	});
	$('input').on('focus', function(){
		$('.error_msg, .success_msg').slideUp();
	});
});
</script>
</body>
</html>
