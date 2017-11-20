<?php 
session_start();
$currentPage = "contact";
include 'common/header.php';
?>
  <section id="about_harsha">
      <div class="about_innr">
      <div class="container-fluid">
        <div class="row">
        <div class="col-sm-12 contact_text">
          <h2 class="heading1 colr_h">Contact Me</h2>
          <h3 class="heading2">Feel free to send a message</h3>
          <div class="container-fluid">
          <div class="error_msg"></div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <input type="text" class="form-control form-shadow" placeholder="Name" id="username" >
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <input type="text" class="form-control form-shadow" placeholder="Email" id="emailid" >
                </div>
              </div>
              <div class='col-sm-4'>
                <div class="form-group">
                  <input type="tel" class="form-control form-shadow" placeholder="Mobile" id="mobile" >
                </div>
              </div>
              </div>
              <div class="row">
                <div class='col-xs-12'>
                <div class="form-group">
                  <textarea  class="form-control form-shadow" placeholder="Message" rows="6" id="message" > </textarea>
                </div>
                </div>
                </div>
               <div class="row">
                <div class='col-xs-12'>
                <div class="form-group">
                  <a class="btn btn-submit gradiant_bg" id="submit_btn">Send Message </a>
                </div>
                </div>
                </div> 
                </div>
                </div>
                </div>
                 </div>
                 <div class="map_wrapper" id="mapwrapper">
                
            </div>
            </div>
    </section>
<?php include 'common/footer.php';?>


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
				var uname = $('#username').val();
        var email = $('#emailid').val();
        var phone = $('#mobile').val();
        var msg = $('#message').val();
        //var city = $('#city').val();
				if(!validateEmail(email)) {
                    $('.error_msg').html("Invalid Email Id").slideDown();
				}else if(!validateMobile(phone)) {
              $('.error_msg').html("Invalid Mobile number").slideDown();
				}else if($.trim(msg) == '') {
                    $('.error_msg').html("message can't be blank").slideDown();
        }else if($.trim(uname) == '') {
                    $('.error_msg').html("name can't be blank").slideDown();
        }else{
					slf.addClass('loading');
					$.ajax({
					  url: 'contactcheck.php',
            data: {'uname': uname, 'email': email, 'phone':phone, 'msg':msg},
					  type: 'POST',
					  success: function(response){
						if(response.trim() == 'error'){
							$('.error_msg').html("Invalid User").slideDown();
							slf.removeClass('loading');
						}else if(response.trim() == 'success'){
              window.location.href = 'contactsuccess.php';
						}else if(response.trim() == 'exist'){
              $('.error_msg').html("User already exist").slideDown();
              slf.removeClass('loading');
            } else{
              $('.error_msg').html(response.trim()).slideDown();
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

<script>
    $(window).load(function(){
     $('#mapwrapper').html('<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.703246469128!2d77.51461150531227!3d12.926784751951791!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3ef88c7aa01f%3A0xe15d3a9feb704c50!2sHarsha+Yoga+Pathashala!5e0!3m2!1sen!2sin!4v1488509044416" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>');
    });
    </script>
    </body>
</html>