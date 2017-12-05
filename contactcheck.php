<?php
    $name   = $_POST['uname'];
    $email    = $_POST['email'];
    $phone   = $_POST['phone'];
    $message = $_POST['msg'];
    $to             = "harsha@harshayoga.com";  //"keshavsin@gmail.com";
    $subject        = "Contact Form";
    $txt            = "<table border='0' style='background:#fff;' width='100%'>";
    $txt .= "<tr><td>Hi Harsha,</td></tr>";
    $txt .= "<tr><td style='padding:12px 0px 10px 0px;'>Following person is trying to get in touch with you regarding Harsha Yoga Pathashala  (from harshayoga website). </td></tr>";
    $txt .= "<tr><td style='padding:5px 10px 0px 0px;color:#607d8b;'><b>Name: </b>" . $name . "</td></tr>";
    $txt .= "<tr><td style='padding:5px 10px 0px 0px;color:#607d8b;'><b>Email ID: </b> " . $email . "</td></tr>";
    $txt .= "<tr><td style='padding:5px 10px 0px 0px;color:#607d8b;'><b>Phone: </b>" . $phone . "</td></tr>";
    $txt .= "<tr><td style='padding:5px 10px 0px 0px;color:#607d8b;'><b>Message: </b><br/><br/>" . $message . "</td></tr>";
    $txt .= "</table>";
    $headers = "From: ".$name."<".$email.">\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    mail($to, $subject, $txt, $headers);
    echo 'success';
?>