<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function sendmail($email, $token)
{
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'osmblogbyraj@gmail.com';
        $mail->Password = 'mlypjffqygmkbhcq';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('osmblogbyraj@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Email verification from OSM BLOG';
        $mail->Body = "<html></body><div><div><h2>Dear $email</h2></div></br></br>
   <div style='padding-top:8px;'>Please click The following link For verifying and activation of your account</div>
<div style='padding-top:10px;'><a href='http://localhost/newblog/varification.php?token=$token'>Click Here</a></div>
<div style='padding-top:4px;'>Powered by <a href='index.php'>OSMBlog.com</a></div></div>
</body></html>";
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>