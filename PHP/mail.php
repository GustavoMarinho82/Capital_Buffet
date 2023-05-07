<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require 'phpmailer/src/Exception.php';
 require 'phpmailer/src/PHPMailer.php';
 require 'phpmailer/src/SMTP.php';

function gmail($subject, $message){
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = "urgensoyer@gmail.com";
  $mail->Password = 'tejwsspuyundgkrf';
  $mail->SMTPSecure = 'ssl';

  $mail->Port=465;

  $mail->setFrom('urgensoyer@gmail.com');

  $mail->addAddress ("dagvjr@gmail.com");
  $mail->isHTML(true);

  $mail->Subject = $subject;
  $mail->Body = $message;

  $mail->send();

 }