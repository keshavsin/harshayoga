<?php
include 'common/session_check.php';
$currentPage = "dahsboard";
include 'common/header.php';
?>
<section class="innerpage">
<h1 class="user_head">Welcome <?php echo $_SESSION["username"]; ?></h1>
    <div class="table_wrapper">
      <h2 class="headertable">Latest Bookings</h2>
      <div class="container-fluid" id="booking_container">
          <div class="text-center text-info">Loading bookings...</div>
      </div>
    </div>
</section>

<?php
include 'common/footer.php';
?>
<script>
$(window).load(function() {
  $.ajax({
    url:"getbooking.php",
    type:"POST",
    data:"actionfunction=showData&page=1",
    cache: false,
    success: function(response) {
      $('#booking_container').html(response);
    }
  });
});
</script>
</body>
</html>