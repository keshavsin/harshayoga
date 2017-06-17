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
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <input type="text" class="form-control form-shadow" placeholder="Name">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <input type="text" class="form-control form-shadow" placeholder="Email">
                </div>
              </div>
              <div class='col-sm-4'>
                <div class="form-group">
                  <input type="text" class="form-control form-shadow" placeholder="Mobile">
                </div>
              </div>
              </div>
              <div class="row">
                <div class='col-xs-12'>
                <div class="form-group">
                  <textarea class="form-control form-shadow" placeholder="Message" rows="6"></textarea>
                </div>
                </div>
                </div>
               <div class="row">
                <div class='col-xs-12'>
                <div class="form-group">
                  <input type="submit" class="btn btn-submit gradiant_bg" value="Send Message">
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
    $(window).load(function(){
     $('#mapwrapper').html('<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.703246469128!2d77.51461150531227!3d12.926784751951791!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3ef88c7aa01f%3A0xe15d3a9feb704c50!2sHarsha+Yoga+Pathashala!5e0!3m2!1sen!2sin!4v1488509044416" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>');
    });
    </script>
    </body>
</html>