<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'C:\Users\Andre\Downloads\startbootstrap-agency-master\vendor\autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if($_POST['send'])
{
    //This page should not be accessed directly. Need to submit form
    echo "error; you need to submit form";
}
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$img = $_FILES['img']['tmp_name'];

//validate image

//validate
if(empty($name) || empty($email) || empty($phone) || empty($img) ){
    echo ("Fields missing");
    exit;
}


try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.office365.com';                   //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'andrewgreaves14@hotmail.com';          //SMTP username
    $mail->Password   = 'jidFev-xidweh-7fidno';                 //SMTP password
    $mail->SMTPSecure = "tls";                                  //Enable implicit TLS encryption
    $mail->Port       = 587;    
    
    //Recipients
    $mail->setFrom('andrewgreaves14@hotmail.com', 'Drew');
    $mail->addAddress('andrewgreaves14@gmail.com');

    //Content
    $mail->Subject = 'New trainer';
    $mail->Body = "{$name} \n {$email} \n {$phone} \n";

    //Attachments
    $mail->addAttachment($img,"trainer photo");         //Add attachment

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>