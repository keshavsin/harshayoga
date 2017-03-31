<?php
$currentPage = "forgot";
include 'common/header.php';
?>
  <section id="about_harsha">
      <div class="login_wrapper">
      <div class="container-fluid">
        <div class="row">
        <div class="col-sm-12 contact_text">
          <h2 class="heading1 colr_h fp">Forgot Password</h2>
         <div class="fp_txt text-center">Enter your email address and we'll send you a password reset email</div>
          <div class="container-fluid">
            <div class="error_msg"></div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="text" class="form-control form-shadow" placeholder="Username / Email" id="email">
                </div>
              </div>
                <div class='col-xs-12'>
                <div class="form-group">
                 <a role="btn" class="btn btn-submit gradiant_bg btn-block" id="submit_btn">Submit</a>
                </div>
                </div>
                </div>
               <div class="noaccount_h"><span>Do not have an account?</span></div>
               <div class="row">
                   <div class='col-xs-12'>
                <div class="form-group">
                 <a href="register.php"class="btn btn-default btn-block btn_signup">Create Account</a>
                </div>
                   </div>
                </div>
                </div>
                </div>
                 </div>
            </div>
            </div>
     </section>
<?php include 'common/footer.php';?>
<script>
$(function(){
  function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
		$('#submit_btn').on('click', function(e) {
			e.preventDefault();
			var slf = $(this);
			if(!slf.hasClass('loading')){
				var username = $('#email').val();
				if (!validateEmail(username)) {
                  $('.error_msg').html("Invalid Email Id").slideDown();
				}else{
					slf.addClass('loading');
					$.ajax({
					  url: 'forgotcheck.php',
					  data: {'uname': username},
					  type: 'POST',
					  success: function(response){
						if(response == 'error'){
							$('.error_msg').html("Invalid User").slideDown();
							slf.removeClass('loading');
						}else if(response == 'success'){
            window.location.href = 'forgotsuccess.php';
          }else if(response == 'nouser'){
              $('.error_msg').html("Either user is not active or not found.").slideDown();
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
		$('.error_msg').slideUp();
	});
});
</script>
</body>
</html>
