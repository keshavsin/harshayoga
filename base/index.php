<?php
 session_start();
 if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}
$currentPage = "login";
include 'common/header.php';
?>
      <section class="login_wrapper">
      <div class="container-fluid">
        <div class="row">
        <div class="col-sm-12 contact_text">
          <h2 class="heading1 colr_h">Harsha Yoga</h2>
          <h3 class="heading2">Admin Login</h3>
          <div class="container-fluid">
            <form class="row">
              <div class="error_msg"></div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="text" class="form-control form-shadow" placeholder="Username" id="username">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="password" class="form-control form-shadow" placeholder="Password" id="password">
                </div>
              </div>
                <div class='col-xs-12'>
                <div class="form-group">
                 <a type="submit" class="btn btn-submit gradiant_bg btn-block" id="submit_btn">Submit</a>
                </div>
                </div>
              </form>
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
    if (!slf.hasClass('loading')) {
      var username = $('#username').val();
        var password = $('#password').val();
      if ($.trim(username) == '') {
        $('.error_msg').html("Username can't be blank").slideDown();
      } else if($.trim(password) == '') {
        $('.error_msg').html("Password can't be blank").slideDown();
      } else {
        slf.addClass('loading');
        $.ajax({
          url: 'logincheck.php',
          data: {'uname': username, 'pass': password},
          type: 'POST',
          success: function(response) {
            console.log(response);
            if (response == 'error') {
              $('.error_msg').html("Invalid User").slideDown();
              slf.removeClass('loading');
            } else if(response == 'success') {
              window.location.href = 'dashboard.php';
            } else {
              $('.error_msg').html("Something Went wrong ! please try again").slideDown();
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
