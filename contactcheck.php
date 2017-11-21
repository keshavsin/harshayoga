<?php
    $name   = $_POST['uname'];
    $email    = $_POST['email'];
    $phone   = $_POST['phone'];
    $message = $_POST['msg'];
    $to             = $email;
    $cc             = "keshavsin@gmail.com";
    $subject        = "Contact Form";
    $txt            = "<table border='0' style='background:#fff;' width='100%'>";
    $txt .= "<tr><td><h2 style='color:#565656;font-size:30px;text-align:center;padding:0;'>Hi Harsha,</h2></td></tr>";
    $txt .= "<tr><td style='padding:10px;color:#607d8b;font-size:14px;text-align:center;'>Following person is trying to get in touch with you regarding Harsha Yoga Pathashala</td></tr>";
    $txt .= "<tr><td style='padding:10px;color:#607d8b;font-size:14px;text-align:center;'><b>Name: </b>" . $name . "</td></tr>";
    $txt .= "<tr><td style='padding:10px;color:#607d8b;font-size:14px;text-align:center;'><b>Email ID: </b> " . $email . "</td></tr>";
    $txt .= "<tr><td style='padding:10px;color:#607d8b;font-size:14px;text-align:center;'><b>Phone: </b>" . $phone . "</td></tr>";
    $txt .= "<tr><td style='padding:10px;color:#607d8b;font-size:14px;text-align:center;'><b>Message: </b><br/><br/>" . $message . "</td></tr>";
   
    $txt .= "</table>";
    $headers = "From: Harsha Yoga<harsha@harshayoga.com>\r\n";
    $headers .= "Cc: keshavsin@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    mail($to, $subject, $txt, $headers);
    
    echo 'success';
?>