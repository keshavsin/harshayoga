<?php
session_start();
$currentPage = "contact";
if (isset($_SESSION['loggedin_name']) == null) {
    header("Location: login.php");
} else {
    $name  = $_SESSION['loggedin_name'];
    $email = $_SESSION['loggedin_user'];
    $phnno = $_SESSION['loggedin_phone'];
}
include 'common/header.php';

$pprice    = '';
$classtype = '';
$duration  = '';
$pid       = $_GET["pid"];
$sql       = "SELECT * FROM product where id = '$pid'";
$result    = $db->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pprice    = $row['price'];
        $classtype = $row['class_type'];
        $duration  = $row['duration'];
    }
}
?>
<?php

// Merchant key here as provided by Payu
//$MERCHANT_KEY = "RDLubGvv";            //Production Key
$MERCHANT_KEY = "kX3tO4CH";
// Merchant Salt as provided by Payu
//$SALT = "heQ4BlwVU2";            //Production Salt
$SALT         = "kCaaU3xSq1";


// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://test.payu.in";
//$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';
$posted = array();

if (!empty($_POST)) {
    //print_r($_POST);
    foreach ($_POST as $key => $value) {
        $posted[$key] = $value;
    }
}
$formError = 0;

if (empty($posted['txnid'])) {
    // Generate random transaction id
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
    $txnid = $posted['txnid'];
}
$hash         = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {
    
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
    $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';
    foreach ($hashVarsSeq as $hash_var) {
        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
        $hash_string .= '|';
    }
    $hash_string .= $SALT;
    $hash   = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
    
} elseif (!empty($posted['hash'])) {
    $hash   = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}
?> 

<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if (hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
  <section id="about_harsha">
    <div class="about_innr">
      <div class="container-fluid">
        <div class="row">
        <div class="col-sm-12 contact_text">
          <h2 class="heading1 colr_h">STUDENT DETAILS</h2>
          <h3 class="heading2"></h3>
          <div class="col-sm-12">
            <div class="dur colr_h">Duration  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     :   <?php echo $duration; ?></div>
            <div class="ctype">Class Type   &nbsp;&nbsp;       : <?php echo $classtype; ?></div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <form action="<?php echo $action; ?>" method="post" name="payuForm">
          <div class="row">
            <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
            <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
            <input type="hidden" name="amount" value="<?php echo $txnid ?>" />
            <div class="col-sm-4">
              <div class="form-group">
                <input type="text" class="form-control form-shadow" placeholder="Amount" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <input type="text" class="form-control form-shadow" placeholder="Name" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>">
              </div>
              </div>
            <div class="col-sm-4">
              <div class="form-group">
                <input type="text" class="form-control form-shadow" placeholder="Email">
              </div>
            </div>
            <div class='col-sm-4'>
              <div class="form-group">
                <input type="text" class="form-control form-shadow" placeholder="Mobile" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>">
              </div>
            </div>
            <div class='col-sm-4'>
              <div class="form-group">
                <input type="text" class="form-control form-shadow" placeholder="success.php" name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" >
              </div>
            </div>
            <div class='col-sm-4'>
              <div class="form-group">
                <input type="text" class="form-control form-shadow" placeholder="failure.php" name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>">
              </div>
            </div>
            <div class='col-sm-4'>
              <div class="form-group">
                <textarea name="productinfo" class="form-control form-shadow" placeholder="Product Info" rows="6"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea>
              </div>
            </div>
            <tr>
              <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
            </tr>
            <input type="hidden" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
            <input type="hidden" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
            <input type="hidden" name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" />
            <input type="hidden" name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" />
            <input type="hidden" name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" />
            <input type="hidden" name="udf6" value="<?php echo (empty($posted['udf6'])) ? '' : $posted['udf6']; ?>" />
            <input type="hidden" name="udf7" value="<?php echo (empty($posted['udf7'])) ? '' : $posted['udf7']; ?>" />
            <input type="hidden" name="udf8" value="<?php echo (empty($posted['udf8'])) ? '' : $posted['udf8']; ?>" />
            <input type="hidden" name="udf9" value="<?php echo (empty($posted['udf9'])) ? '' : $posted['udf9']; ?>" />
            <input type="hidden" name="udf10" value="<?php echo (empty($posted['udf10'])) ? '' : $posted['udf10']; ?>" />
          </div>
          <div class="row">
            <div class='col-xs-12'>
              <div class="form-group">
                <?php if(!$hash) { ?><input type="submit" class="btn btn-submit gradiant_bg " value="Proceed to Checkout" />
              <?php } ?>
              </div>
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
    $(window).load(function(){
    $('#mapwrapper').html('<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.703246469128!2d77.51461150531227!3d12.926784751951791!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3ef88c7aa01f%3A0xe15d3a9feb704c50!2sHarsha+Yoga+Pathashala!5e0!3m2!1sen!2sin!4v1488509044416" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>');
    });
  </script>
  </body>
</html>