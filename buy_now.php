<?php
include 'sessioncheck.php';
$currentPage = "reivewBooking";
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
$surl='http://localhost/harshayoga/success.php';
$furl='http://localhost/harshayoga/failure.php';

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

if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(empty($posted['key'])
      || empty($posted['txnid'])
      || empty($posted['amount'])
      || empty($posted['firstname'])
      || empty($posted['email'])
      || empty($posted['phone'])
      || empty($posted['productinfo'])
      || empty($posted['surl'])
      || empty($posted['furl'])
		  || empty($posted['service_provider'])) {

    $formError = 1;
  } else {
   	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
    foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }
    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif (!empty($posted['hash'])) {
  $hash = $posted['hash'];
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
          <h2 class="heading1 colr_h">Please review your booking !!</h2>
          <h3 class="heading2"></h3>
          <!--<div class="col-sm-12">
            <div class="dur colr_h">Duration  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     :   <?php echo $duration; ?></div>
            <div class="ctype">Class Type   &nbsp;&nbsp;       : <?php echo $classtype; ?></div>
          </div> -->
        </div>
      </div>
      <div class="container-fluid">
        <form action="<?php echo $action; ?>" method="post" name="payuForm">        
          <div class="row">
          <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
          <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
          <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
          <input type="hidden" name="surl" value="<?php echo $surl ?>" />
          <input type="hidden" name="furl" value="<?php echo $furl ?>" />
          <input type="hidden" name="email" value="<?php echo $email; ?>" />
          <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
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
										<td><?php echo $classtype; ?></td>
										<td><label value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>"></label></td>
									</tr>
									<tr>
										<td><strong>Duraion</strong></td>
										<td><b>: &nbsp </b></td>
										<td><?php echo $duration; ?><br></td>
									</tr>
									<tr>
										<td><strong>Description</strong></td><td><b>: &nbsp </b></td>
										<td>coming soon</td>
									</tr>	
										<!--<tr>
										<td><input type="textarea"/></td>
										</tr>-->
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
										<td>kumar</td>
										<td><label value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>"></label></td>
									</tr>
									<tr>
										<td><strong>Email</strong></td>
										<td><b>: &nbsp </b></td>
										<td>keshavsin@gmail.com<br></td>
									</tr>
									<tr>
										<td><strong>Moblie</strong></td><td><b>: &nbsp </b></td>
										<td>9865321456</td>
									</tr>
									<tr>
										<td><strong>Amount</strong></td><td><b>: &nbsp </b></td>
										<td>5000</td>
									</tr>			
									
								</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</div>	
			  <div class="yj6qo"></div><div class="adL">
			  </div></div>
          </div>
		  <div class='col-xs-12'>	
			<p style="float:left;"><input type="checkbox"/> <td><p>I am agree to the Terms and conditions<p>	</div>		
          <div class="row" style="float:right;">
            <div class='col-xs-12'>			
              <div class="form-group">
               <?php if(!$hash) { ?><input type="submit" class="btn btn-submit gradiant_bg " value="Pay Now" />
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