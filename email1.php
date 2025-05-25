<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
  	$name = $_POST['name'];
  	$email = $_POST['email'];
  	$password = $_POST['password'];
  	$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
  	$timestamp = time();
    $secret_key = 'cfd87hgfc0uewcfd32ojnbt569uhbaplr'; 
    $base_url = 'http://localhost/get_to_post1.php';    
    $data = "$email|$timestamp";
    $signature = hash_hmac('sha256', $data, $secret_key);
    $link = "$base_url#email=".urlencode($email)."&signature=".urlencode($signature)."&timestamp=$timestamp"."&name=".urlencode($name)."&encrypted_password=".urlencode($encrypted_password);
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->isSMTP();                                      // Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                 // Set the SMTP server
	    $mail->SMTPAuth   = true;                             // Enable SMTP authentication
	    $mail->Username   = 'ghoneim0061@gmail.com';           // SMTP username
	    $mail->Password   = 'ayqa txso anfl bicy';            // SMTP password or App Password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption
	    $mail->Port       = 587;                              // TCP port to connect to

	    //Recipients
	    $mail->setFrom('ghoneim0061@gmail.com', 'Follow-Queue');
	    $mail->addAddress($email, $name);

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Complete registeration';
	    $mail->Body    = "Please click<a href='{$link}'> here</a> to complete registeration";
	    $mail->AltBody = "Please click the link to complete registeration \n\r $link";

	    $mail->send();
	    echo 'Please click the verification link we have sent to your email to complete your registeration. If it does not show up in a few minutes, check your spam folder. The verification token expires after one hour.';
	} 
	catch (Exception $e) {
	    echo "There was a problem sending you a verification link. Please <a href='register.php'>try again.</a>";
	}

}




?>