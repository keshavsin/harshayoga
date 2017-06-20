<?php
session_start();
if (isset($_SESSION['loggedin_user'])) {
  header("Location: dashboard.php");
  exit;
} else {
  $currentPage = "reset password";
  include 'common/header.php';
  if (isset($_GET['id'])) {
    $encrypted_txt = $_GET['id'];
    function my_simple_crypt($string, $action = 'e') {
      $secret_key     = 'D69e4K13w9KFFly6J4wHcCG3MNa';
      $secret_iv      = 'S9TW2ET56nem';
      $output         = false;
      $encrypt_method = "AES-256-CBC";
      $key            = hash('sha256', $secret_key);
      $iv             = substr(hash('sha256', $secret_iv), 0, 16);
      if ($action == 'd') {
          $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
      }
      return $output;
    }
    $email  = my_simple_crypt($encrypted_txt, 'd');
    $sql    = "SELECT * FROM users WHERE email='$email' AND is_active=1";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
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
            <form name="resetform" action="" method="post">
              <div class="error_msg"></div>
              <div class="success_msg"></div>
              <div class="row" id="form_wrapper">
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
              <div class="text-info" style="display:none;" id="resetsuccess">
              Click on below link to login to your account.<br/><br/>
              <a href="login.php" class="btn btn-default">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
    } else {
      echo '<script>location.href = "index.php";</script>';
    }
  } else {
    echo '<script>location.href = "index.php";</script>';
  }
  include 'common/footer.php';
}
?>
<script>
$(function(){
	$('#submit_btn').on('click', function(e) {
			e.preventDefault();
			var slf = $(this);
			if(!slf.hasClass('loading')){
		   		var nw = $('#new_passwrd').val();
          var cn = $('#cn_passwrd').val();
              if($.trim(nw) == '') {
                            $('.error_msg').html("New password required").slideDown();
                        }else if($.trim(cn) == '') {
                                    $('.error_msg').html("Confirm password required").slideDown();
                                }else if(nw !== cn) {
                                            $('.error_msg').html("New and Confirm password do not match").slideDown();
                                        }else{
					slf.addClass('loading');
					$.ajax({
					  url: 'resetpasswordcheck.php',
					  data: {'uname': '<?php echo $email;?>', 'nw': nw},
					  type: 'POST',
					  success: function(response){
						if(response == 'error'){
							$('.error_msg').html("Invalid User").slideDown();
							slf.removeClass('loading');
						}else if(response == 'success'){
              $('.success_msg').html("Password successfully changed").slideDown();
              $('.form-control').val('');
              $('#form_wrapper').hide();
              $('#resetsuccess').show();
              slf.removeClass('loading');
						} else{
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