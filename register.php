<?php
session_start();
session_destroy();
if(isset($_SESSION['loggedin_user'])) {
   header("Location: dashboard.php");
  exit;
}else{
$currentPage = "registration";
include 'common/header.php';
}
?>
  <section id="about_harsha">
      <div class="login_wrapper">
      <div class="container-fluid">
        <div class="row">
        <div class="col-sm-12 contact_text">
          <h2 class="heading1 colr_h">Sign Up</h2>
          <h3 class="heading2">Fill out the form below</h3>
          <div class="container-fluid">
            <div class="error_msg"></div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="email" class="form-control form-shadow" placeholder="Email" id="username">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="password" class="form-control form-shadow" placeholder="Password" id="password">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="tel" class="form-control form-shadow" placeholder="Mobile" id="mobile">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="text" class="form-control form-shadow" placeholder="Country" id="country">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="text" class="form-control form-shadow" placeholder="City" id="city">
                </div>
              </div>
                <div class='col-xs-12'>
                <div class="form-group">
                 <a class="btn btn-submit gradiant_bg btn-block" id="submit_btn">Submit</a>
                </div>
                </div>
                </div>
               <div class="noaccount_h"><span>Already have an account?</span></div>
               <div class="row">
                   <div class='col-xs-12'>
                <div class="form-group">
                 <a href="login.php" class="btn btn-default btn-block btn_signup">Sign In</a>
                </div>
                   </div>
                </div>
                </div>
                </div>
                 </div>
            </div>
            </div>
    </section>
<?php include 'common/footer.php'; 
?>
<script>
$(function(){
  function validateEmail(email) {
  var emaildef = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return emaildef.test(email);
}
function validateMobile(mobile){
    var phonedef = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/;
    return phonedef.test(mobile);
}
		$('#submit_btn').on('click', function(e) {
			e.preventDefault();
			var slf = $(this);
			if(!slf.hasClass('loading')){
				var username = $('#username').val();
        var password = $('#password').val();
        var phone = $('#mobile').val();
        var country = $('#country').val();
        var city = $('#city').val();
				if(!validateEmail(username)) {
                    $('.error_msg').html("Invalid Email Id").slideDown();
				}else if($.trim(password) == '') {
                    $('.error_msg').html("Password can't be blank").slideDown();
        }else if(!validateMobile(phone)) {
              $('.error_msg').html("Invalid Mobile number").slideDown();
				}else{
					slf.addClass('loading');
					$.ajax({
					  url: 'registrationcheck.php',
					  data: {'uname': username, 'pass': password, 'phone':phone, 'country':country, 'city':city},
					  type: 'POST',
					  success: function(response){
						if(response == 'error'){
							$('.error_msg').html("Invalid User").slideDown();
							slf.removeClass('loading');
						}else if(response == 'success'){
              window.location.href = 'registrationsuccess.php';
						}else if(response == 'exist'){
              $('.error_msg').html("User already exist").slideDown();
              slf.removeClass('loading');
            } else{
              $('.error_msg').html(response).slideDown();
              slf.removeClass('loading');
						}
					  }
					});
				}
			}
	});
	$('input').on('focus', function(){
		$('.error_msg').slideUp();
	});
});
</script>
</body>
</html>
