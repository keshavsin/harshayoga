<?php
include 'sessioncheck.php';
$currentPage = "reviewBooking";
if (isset($_SESSION['loggedin_name']) == null) {
    header("Location: login.php");
} else {
    $name  = $_SESSION['loggedin_name'];
    $email = $_SESSION['loggedin_user'];
    $phnno = $_SESSION['loggedin_phone'];
    $userid = $_SESSION['loggedin_userid'];
}
include 'common/header.php';

$pprice    = '';
$currency    = '';
$productDetail1 = '';
$productDetail2  = '';
$productDetail3  = '';
$productType  = '';

$MERCHANT_KEY = "RDLubGvv";            //Production Key
//$MERCHANT_KEY = "rjQUPktU";

$SALT = "heQ4BlwVU2";            //Production Salt
//$SALT         = "e5iIg1jwi8";


// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in";
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';
$surl='http://www.harshayoga.com/success.php';
$furl='http://www.harshayoga.com/buy_now.php';

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
$pid       = $_GET["pid"];
$hash         = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productInfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

if (empty($posted['hash'])) {
  $sql       = "SELECT * FROM product where id = '$pid'";
  $result    = $db->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $productType = $row['type'];
          $pprice = $row['price'];
          $currency = $row['currency'];
          if ($productType == ' Regular Classes') {
            $productDetail_class1    = $row['duration'].' '.$row['duration_unit'];
            $productDetail_class2 = $row['type'];
			 $productDetail_class3 = $row['class_type'];
            $productDetail_class4  = $row['description'];
			
          } else if ($productType == 'Teacher Training Course') {
            $productDetail_ttc1    = $row['duration'].' '.$row['duration_unit'];
            $productDetail_ttc2 = $row['type'];
            $productDetail_ttc3  = $row['title'];
			
          } else {
            $productDetail_other1    = $row['type'];
            $productDetail_other2 = $row['location'];
            $productDetail_other3  = $row['start_date'];
            $productDetail_other4  = $row['end_date'];
			$productDetail_other5  = $row['duration'].' '.$row['duration_unit'];
			  $productDetail_other6  = $row['title'];
       
          }
      }
  }
} 

if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(empty($posted['key'])
      || empty($posted['txnid'])
      || empty($posted['amount'])
      || empty($posted['firstname'])
      || empty($posted['email'])
      || empty($posted['phone'])
      || empty($posted['productInfo'])
      || empty($posted['surl'])
      || empty($posted['furl'])
		  || empty($posted['service_provider'])
      || empty($posted['termsNCondition'])) {

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

    // db insert stmt to record transaction
    if( isset($_POST['txnid'])) {
      $txnId=$_POST['txnid'];
      $amount = $_POST['amount'];
      $phone = $_POST['phone'];
      $tncAgreed=(isset($_POST['termsNCondition']))? (($_POST['termsNCondition']=='on')?1:0):0;

      $sql_insert = "INSERT INTO booking (product_id, txn_id, amount_paid, currency, name, email, mobile, booking_date, tnc_agreed, user_id) VALUES ($pid, '$txnId', $amount, '$currency', '$name','$email', $phone, NOW(), $tncAgreed, '$userid')";

      if ($db->query($sql_insert) === TRUE) {
        echo "Transaction record is tracked on DB";
      } else {
        echo "error: Transaction rescord can not be tracked on DB";
      }
    }
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
        <div class="error_msg" style="display:block;text-align:center;">
          <?php if($formError) { ?>
          Please select the terms and condition checkbox to proceed
          <?php } ?>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 contact_text">
          <h2 class="heading1 colr_h">Please review your booking !!</h2>
          <h3 class="heading2"></h3>
        </div>
      </div>
	  
        <div class="container-fluid">
          <div class="row">
       
		 <div class="col-sm-8">
          <table class="table" align="right" style="border-collapse:collapse; overflow:auto;">
          <thead>
            <tr>
              <th  style="padding:8px;text-align:center;background-color:#ec595c;color:white;font-size:15px">Product Details</th>
            </tr>
          </thead>
              <tbody>		
              <tr>
                <td>
				<?php  if ($productType == ' Regular Classes') {
					echo '<table style="border-collapse:collapse">';
                    echo '<tbody>';
					  echo '<tr>';
                         echo ' <td><strong>Product </strong></td>';
                          echo '<td><b>:&nbsp </b></td>';
                           echo '<td>'.$productDetail_class3.'<br></td>';
                         echo '</tr>';
                        echo '<tr>';
                         echo ' <td><strong>Class Type </strong></td>';
                          echo '<td><b>:&nbsp </b></td>';
                           echo '<td>'.$productDetail_class2.'<br></td>';
                         echo '</tr>';
                        echo '<tr>';
                          echo '<td><strong>Duration </strong></td>';
                          echo '<td><b>: &nbsp </b></td>';
                          echo '<td>'.$productDetail_class1.'<br></td>';
                        echo '</tr>';						
                   echo '</tbody>';
                 echo '</table>';
				}else if ($productType == 'Teacher Training Course') {
					echo '<table style="border-collapse:collapse">';
                    echo '<tbody>';
                        echo '<tr>';
                         echo ' <td><strong>Product</strong></td>';
                          echo '<td><b>:&nbsp </b></td>';
                           echo '<td>'.$productDetail_ttc2.'<br></td>';
                         echo '</tr>';
                        echo '<tr>';
                          echo '<td><strong>Name</strong></td>';
                          echo '<td><b>: &nbsp </b></td>';
                          echo '<td>'.$productDetail_ttc3.'<br></td>';
                        echo '</tr>';
						echo '<tr>';
                         echo ' <td><strong>Duration</strong></td>';
                          echo '<td><b>:&nbsp </b></td>';
                           echo '<td>'.$productDetail_ttc1.'<br></td>';
                         echo '</tr>';
										 
                   echo '</tbody>';
                 echo '</table>';
				}else{
					echo '<table style="border-collapse:collapse">';
                    echo '<tbody>';
                        echo '<tr>';
                         echo ' <td><strong>Product</strong></td>';
                          echo '<td><b>:&nbsp </b></td>';
                           echo '<td>'.$productDetail_other1.'<br></td>';
                         echo '</tr>';
						 	 	echo '<tr>';
                         echo ' <td><strong>Name</strong></td>';
                          echo '<td><b>:&nbsp </b></td>';
                           echo '<td>'.$productDetail_other6.'<br></td>';
                         echo '</tr>';
						 echo '<tr>';
                         echo ' <td><strong>Duration</strong></td>';
                          echo '<td><b>:&nbsp </b></td>';
                           echo '<td>'.$productDetail_other5.'<br></td>';
                         echo '</tr>';
                        echo '<tr>';
                          echo '<td><strong>Location</strong></td>';
                          echo '<td><b>: &nbsp </b></td>';
                          echo '<td>'.$productDetail_other2.'<br></td>';
                        echo '</tr>';
						
					
						 
												
                   echo '</tbody>';
                 echo '</table>';
				}	?>
                  
                </td>
              </tr>
          </tbody>
          </table>
              </form>
          </div>
         
          <form action="<?php echo $action; ?>" method="post" name="payuForm">
       <div class="col-sm-4">
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
                            <td><b><?php echo "$currency $pprice"; ?></b></td>
                          </tr>	
 						   </tbody>
					</table>
					<br/><br/>
					<table>
					<tbody>
                          <tr>
                            <div class="error_msg"></div>
                            <td colspan="3"><input type="checkbox" id ="termsNCondition" name="termsNCondition"/>I agree to the <a href="terms-and-conditions.php" target="blank">Terms &amp; Conditions</a></td>
                          </tr>
                        </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>	
        </div>
    </div>
    <div class='col-xs-12'>	
      <div class="row" style="float:right;"> 
        <div class='col-xs-12'>			
          <div class="form-group">
              <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
              <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
              <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
              <input type="hidden" name="surl" value="<?php echo $surl ?>" />
              <input type="hidden" name="furl" value="<?php echo $furl ?>" />
              <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
              <input type="hidden" name="amount" value="<?php echo $pprice ?>"/>
              <input type="hidden" name="firstname" value="<?php echo $name ?>"/>
              <input type="hidden" name="email" value="<?php echo $email; ?>" />
              <input type="hidden" name="phone" value="<?php echo $phnno ?>"/>
              <input type="hidden" name="productInfo" value="<?php echo $pid ?>"/>
              <input type="hidden" name="userid" value="<?php echo $userid ?>"/>
             <?php if(!$hash) { ?><input type="submit" id="reset" class="btn btn-submit gradiant_bg " value="Pay Now" />
            <?php } ?>
          </div>
        </div>
      </div>
      </form>
   </div>
  </div>
</section>
  <?php include 'common/footer.php';?>
  <script>
    $(window).load(function(){
    //$('#mapwrapper').html('<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.703246469128!2d77.51461150531227!3d12.926784751951791!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3ef88c7aa01f%3A0xe15d3a9feb704c50!2sHarsha+Yoga+Pathashala!5e0!3m2!1sen!2sin!4v1488509044416" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>');
    });
  </script>
  <script>
 $('#reset').click(function () {
    if (!$('#termsNCondition').is(':checked')) {
        alert('Please Agree Terms & Conditions');
        return false;
    }
});
 
  </script>
  </body>
</html>