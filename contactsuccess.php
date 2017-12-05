<?php
//include 'sessioncheck.php';
session_start();
$currentPage = "contactSuccess";
include 'common/header.php';
?>


<?php
$currentPage = "Contact Form Success";
include 'common/header.php';
echo '<section id="about_harsha"><div class="message_wrapper"><div class="container-fluid"><div class="row"><div class="col-sm-12 contact_text">';
echo'<h2 class="heading1 colr_h">Thanks for contacting Harsha Yoga</h2><h3 class="heading2"> <br/>We have received your message and we will do the needful action based on  your message</h3>';
echo"<p style='text-align:center'>Please do keep writing to us or contact us for suggestions. Thank You !! </p>";
echo"</div></div></div></div></section>";
include 'common/footer.php';
?>
</body>
</html>
