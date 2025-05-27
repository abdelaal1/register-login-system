<?php

if (isset($_POST["name"])&&isset($_POST["email"])&&isset($_POST["encrypted_password"])&&isset($_POST["signature"])&&isset($_POST["timestamp"])) {
  $email = urldecode($_POST["email"]); 
  $provided_sig = urldecode($_POST["signature"]);
  $timestamp = urldecode($_POST["timestamp"]);
  $secret_key = 'cfd87hgfc0uewcfd32ojnbt569uhbaplr';
  $data = "$email|$timestamp";
  $expected_sig = hash_hmac('sha256', $data, $secret_key); 

  if (hash_equals($expected_sig, $provided_sig) && time() - $timestamp <= 3600) {
    $name = urldecode($_POST["name"]);
    $encrypted_password = urldecode($_POST["encrypted_password"]);

    $con =mysqli_connect('localhost', 'root', 'Nahla_11' , 'fq');
    if (mysqli_connect_errno()) {
        echo "Database connection error. Please <a href='register.php'>try again.</a>";
        exit();
    }

    $db_name = mysqli_real_escape_string($con, $name);
    $db_email = mysqli_real_escape_string($con, $email);
    $db_password = mysqli_real_escape_string($con, $encrypted_password);

  	$query = "INSERT INTO users(name, email, password)";
    $query.= " VALUES('$db_name','$db_email','$db_password')";

  	$result = mysqli_query($con, $query);
  	if(!$result) {
      echo "Query failed. Please <a href='register.php'>try again.</a>";
      exit();
    }

    mysqli_close($con);

  	echo "<h4><span style='color: green; font-size: 85%'>&#10004; </span>Registration completed successfully.</h4>Click <a href = 'index.php'>here</a> to login.";
  }
  else{
    echo "Invalid or expired verification token. Please <a href='register.php'>try again</a>";
  }
}
else{
    header("Location: index.php");
    exit();
}  
?>