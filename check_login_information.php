<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "GET"){

        $con =mysqli_connect('localhost', 'root', 'Nahla_11' , 'fq');
        if (mysqli_connect_errno()) {
          echo '{"res": Database connection error. Please try again"}';
          exit();
        }       

        $email = $_GET["email"];
        $password = $_GET["password"];
        $db_email = mysqli_real_escape_string($con, $email);

        $query = "SELECT password,id FROM users WHERE email = '$db_email'";

        $result = mysqli_query($con, $query);
        if($result === false) {
          echo '{"res": "Query failed. Please try again"}';
          exit();
        }

        $row_count = mysqli_num_rows($result); 
        if($row_count ==1){
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          $encrypted_password = $row["password"];
          $id = $row["id"];
          if (password_verify($password, $encrypted_password)) {
            $_SESSION['id'] = $id;
            echo '{"res": "valid credentials"}';
          }
          else {
            echo '{"res": "Incorrect login information. Please try again"}';
          }
        }  
        else {
          echo '{"res": "Incorrect login information. Please try again"}';
        }
        mysqli_free_result($result);
        mysqli_close($con);
}


?>