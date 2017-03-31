<?php
include 'common/session_check.php';
$currentPage = "retreat";
include 'common/header.php';
?>
      <section class="innerpage">
        <h1 class="user_head">Welcome <?php echo $_SESSION["username"];?></h1>
      </section>
      </section>
<?php include 'common/footer.php';?>
</body>
</html>
