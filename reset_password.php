<?php

if (isset($_POST["email"]) && isset($_POST["signature"]) && isset($_POST["timestamp"]) && isset($_POST["password"])) {
  $email = htmlspecialchars_decode($_POST["email"]);
  $provided_sig = htmlspecialchars_decode($_POST["signature"]);
  $timestamp = htmlspecialchars_decode($_POST["timestamp"]);
  $secret_key = 'cfd87hgfc0uewcfd32ojnbt569uhbaplr';
  $data = "$email|$timestamp";
  $expected_sig = hash_hmac('sha256', $data, $secret_key); 

  if (hash_equals($expected_sig, $provided_sig) && time() - $timestamp <= 3600){
    $password = htmlspecialchars_decode($_POST["password"]);
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

    $con =mysqli_connect('localhost', 'root', 'Nahla_11' , 'fq');
    if (mysqli_connect_errno()) {
        echo "Database connection error. Please <a href='reset1.php'>try again.</a>";
        exit();
    }

    $db_email = mysqli_real_escape_string($con, $email);
    $db_password = mysqli_real_escape_string($con, $encrypted_password);

    $query = "UPDATE users SET password = '$db_password' WHERE email = '$db_email'";

    $result = mysqli_query($con, $query);
    if($result === false) {
      echo "Query failed. Please <a href='reset1.php'>try again.</a>";
      exit();
    }

    mysqli_close($con);

    echo "<h4><span style='color: green; font-size: 85%'>&#10004; </span>Your password has successfully been reset.</h4>Click <a href = 'index.php'>here</a> to login.";
  }
  else if (hash_equals($expected_sig, $provided_sig) && time() - $timestamp > 3600){
    echo "The verification token has been expired. <a href = 'reset1.php'>Try again</a>";
  }
  else{
    header("Location: reset1.php");
    exit();
  }
} 
else{
  header("Location: reset1.php");
  exit(); 
}    
 
?>