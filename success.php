<?php
$currentPage = "confirmBooking";
include 'sessioncheck.php';
if (isset($_SESSION['loggedin_name']) == null) {
    header("Location: login.php");
} else {
    $name  = $_SESSION['loggedin_name'];
    $email = $_SESSION['loggedin_user'];
    $phnno = $_SESSION['loggedin_phone'];
}

include 'common/header.php';
$status      = $_POST["status"];
$firstname   = $_POST["firstname"];
$amount      = $_POST["amount"];
$txnid       = $_POST["txnid"];
$posted_hash = $_POST["hash"];
$key         = $_POST["key"];
$productinfo = $_POST["productinfo"];
$email       = $_POST["email"];

//$salt = "heQ4BlwVU2";                //Production Salt
$salt = "e5iIg1jwi8";

If (isset($_POST["additionalCharges"])) {
    $additionalCharges = $_POST["additionalCharges"];
    $retHashSeq        = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
} else {
    $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
}
$hash = hash("sha512", $retHashSeq);
?>
<html>
<head>
</head>
<body>
<section id="about_harsha">
  <div class="about_innr">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 contact_text">

<?php if ($hash != $posted_hash) { ?>
    <h2 class="heading1 colr_h">Thank You. Your booking status is <?php echo $status;?> !!</h2>
    <br>
    <h3 class="heading2">Tour Transaction with ID is Invalid : <?php echo $txnid; ?> Please re-submit</h3>
  </div>
</div>
<?php
} else {
  $sql       = "SELECT * FROM product where id = '$productinfo'";
  $result    = $db->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $productType = $row['type'];
          $pprice = $row['price'];
          $currency = $row['currency'];
          if ($productType == 'class') {
            $productDetail1    = $row['title'];
            $productDetail2 = $row['class_type'];
            $productDetail3  = $row['description'];
          } else if ($productType == 'ttc') {
            $productDetail1    = $row['title'];
            $productDetail2 = 'Teacher Training Course';
            $productDetail3 = $row['duration'];
            $productDetail4  = $row['description'];
          } else {
            $productDetail1    = $row['title'];
            $productDetail2 = $row['location'];
            $productDetail3  = $row['city'];
            $productDetail4  = $row['country'];
            $productDetail5  = $row['description'];
          }
      }
  }
?>
          <h2 class="heading1 colr_h">Thank You. Your booking is confirmed !!</h2>
          <br>
          <h3 class="heading2">Transaction ID : <?php echo $txnid; ?></h3>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
        <div style="width:45%;float:left">
        <table class="table" align="right" style="border-collapse:collapse; overflow:auto;">
        <thead>
          <tr>
            <th  style="padding:8px;text-align:center;background-color:#ec595c;color:white;font-size:15px">Product Details</th>
          </tr>
        </thead>
        <tbody>		
        <tr>
          <td>
            <table style="border-collapse:collapse">
              <tbody>
                  <tr>
                    <td><strong>Class Type</strong></td>
                    <td><b>:&nbsp </b></td>
                    <td><?php echo $productDetail1; ?></td>
                   </tr>
                  <tr>
                    <td><strong>Duration</strong></td>
                    <td><b>: &nbsp </b></td>
                    <td><?php echo $productDetail2; ?><br></td>
                  </tr>
                  <tr>
                    <td><strong>Description</strong></td><td><b>: &nbsp </b></td>
                    <td><?php echo $productDetail2; ?></td>
                  </tr>	
              </tbody>
            </table>
          </td>
        </tr>
        </tbody>
        </table>
        </div>
        <div style="width:10%;"></div>
        <div style="width:45%;float:right">
          <table class="table" align="center" style="border-collapse:collapse">
          <thead>
              <tr>
                <th style="padding:8px;text-align:center;background-color:#ec595c;color:white;font-size:15px">User Details</th>
              </tr>
          </thead>
          <tbody>
              <tr>
              <td>
                <table style="border-collapse:collapse">
                  <tbody>
                      <tr>
                        <td><strong>Name</strong></td>
                        <td><b>:&nbsp </b></td>
                        <td><?php echo $name; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Email</strong></td>
                        <td><b>: &nbsp </b></td>
                        <td><?php echo $email; ?><br></td>
                      </tr>
                      <tr>
                        <td><strong>Moblie</strong></td>
                        <td><b>: &nbsp </b></td>
                        <td><?php echo $phnno; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Amount</strong></td>
                        <td><b>: &nbsp </b></td>
                        <td><?php echo "$currency $pprice"; ?></td>
                      </tr>			
                    </tbody>
                </table>
              </td>
            </tr>
          </tbody>
          </table>
        </div>	
      </div>
<?php } ?>

    </div>
  </div>
</section>

<?php include 'common/footer.php';?>