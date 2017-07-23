<?php
if(isset($_SESSION['loggedin_user'])) {
	header("Location: dashboard.php");
	exit;
} else {
	$currentPage = "login";
	include 'common/header.php';
}
?>
<section id="about_harsha">
	<div class="login_wrapper">
	<div class="container-fluid">
	<div class="row">
	<div class="col-sm-12 contact_text">
		<h2 class="heading1 colr_h">Log In</h2>
		<h3 class="heading2">To Gain Access</h3>
		<div class="container-fluid">
			<form name="sign_inform" action="" method="post">
				<div class="error_msg"></div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<input type="email" class="form-control form-shadow" placeholder="Email" id="username">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group nomrgn">
							<input type="password" class="form-control form-shadow" placeholder="Password" id="password">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group text-right">
							<a href="forgot-password.php" class="fp_lnk">Forgot password ?</a>
						</div>
					</div>
					<div class='col-xs-12'>
						<div class="form-group">
							<a class="btn btn-submit gradiant_bg btn-block" id="submit_btn">Submit</a>
						</div>
					</div>
				</div>
			</form>
			<div class="noaccount_h"><span>Do not have an account?</span></div>
			<div class="row">
				<div class='col-xs-12'>
					<div class="form-group">
						<a href="register.php" class="btn btn-default btn-block btn_signup">Create Account</a>
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
		if(!slf.hasClass('loading')) {
			var username = $('#username').val();
			var password = $('#password').val();
			if (!validateEmail(username)) {
			  $('.error_msg').html("Invalid Email Id").slideDown();
			} else if($.trim(password) == '') {
				$('.error_msg').html("Password can't be blank").slideDown();
			} else {
				slf.addClass('loading');
				$.ajax({
				  url: 'logincheck.php',
				  data: {'uname': username, 'pass': password },
				  type: 'POST',
				  success: function(response) {
					if (response.trim() == 'error') {
						$('.error_msg').html("Invalid User").slideDown();
						slf.removeClass('loading');
					} else if (response.trim() == 'success') {
						window.location.href = 'dashboard.php';
					} else if (response.trim() == 'notactive') {
					  $('.error_msg').html("Sorry! Your account is not active").slideDown();
					  slf.removeClass('loading');
					} else {
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
