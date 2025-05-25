<?php

        $con =mysqli_connect('localhost', 'root', 'Nahla_11' , 'fq');
        if (mysqli_connect_errno()) {
          echo '{"res": "Database connection error. Please <a href=\'register.php\'>try again.</a>"}';
          exit();
        }       

        $email = $_GET["email"];
        $db_email = mysqli_real_escape_string($con, $email);

        $query = "SELECT id FROM users WHERE email = '$db_email'";

        $result = mysqli_query($con, $query);
        if($result === false) {
          echo '{"res": "Query failed. Please <a href=\'register.php\'>try again.</a>"}';
          exit();
        }

        $row_count = mysqli_num_rows($result); 
        if($row_count >=1){
          echo '{"res": "email already exists. Please <a href=\'register.php\'>try again.</a>"}';
        }  
        else {
          echo '{"res": "email does not exist"}';
     	  }
        mysqli_free_result($result);
        mysqli_close($con);


?>