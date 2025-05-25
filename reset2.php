<?php
if (isset($_POST["email"]) && isset($_POST["signature"]) && isset($_POST["timestamp"])) {
  $email = urldecode($_POST["email"]); 
  $provided_sig = urldecode($_POST["signature"]);
  $timestamp = urldecode($_POST["timestamp"]);
  $secret_key = 'cfd87hgfc0uewcfd32ojnbt569uhbaplr';
  $data = "$email|$timestamp";
  $expected_sig = hash_hmac('sha256', $data, $secret_key);
  if (!(hash_equals($expected_sig, $provided_sig))){
	  header("Location: reset1.php");
	  exit();
	} 
}
else{
  header("Location: reset1.php");
  exit();	
}   

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reset Password</title>
	<style type="text/css">

		div{
			text-align: center;
			margin-left: auto;
			margin-right: auto;  
			width: 98%; 
			max-width: 450px; 
			background-color: #e6ffb3;
			padding-top: 50px;
			padding-bottom: 45px;
		}

		p{
			text-align: left;
			margin-top: 6px;
			margin-bottom: 0px;
			padding-left: 2px;
			padding-right: 2px;			
			padding-bottom: 0px;
			padding-top: 0px;
			font-size: 12px;
			width: 90%;
			margin-right: auto;
			margin-left: auto;
		}

		.error{
			color:red;
		}

		.hint{
			color: #0544b5;
			display: none;
		}

		input.user{
			width: 90%;
		 	height: 42px;
		 	border-radius: 5px;
		 	border: 1px solid black;
		 	padding-left: 5px;
		 	font-size: 16px;		 	
		}

		input#submit{
			margin-top: 50px;
			margin-bottom: 30px;
			border-radius: 23px;
			height: 46px; 
			width: 90%; 
			background-color: #0544b5; 
			color: white;
			font-size: 14px;
			letter-spacing: 0.04em; 
		}

		input#submit:hover{
			color: #ffff4d;
		}

		input#submit:active{
			opacity: 0.6;
		} 

		input.user:focus{
		border: 2px solid #0544b5;
		outline: 5px solid #66ccff;		
		}

	</style>
		
</head>
<body>
	<div>
		<form id="form" action="reset_password.php" method="post" novalidate>
			<input type="password" name="password" id="password" class="user" placeholder="New password" required maxlength="20" minlength="8">			
			<p id="error_password" class="error"></p>
			<p id="hint_password" class="hint">Password should include Number, Upper Case (A-Z), and Lower Case (a-z) letter</p>
			<input type="password" name="confirm_password" id="confirm_password" class="user" minlength="8" maxlength="20" placeholder="Confirm new password" style="margin-top: 40px;" required>
			<p id="error_confirm_password" class="error"></p>
			<input type="hidden" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<input type="hidden" name="signature" value="<?php echo htmlspecialchars($provided_sig) ?>">
			<input type="hidden" name="timestamp" value="<?php echo htmlspecialchars($timestamp) ?>">
			<input type="submit" name="submit" value="Reset" id="submit">
		</form>
		<a href="index.php" style="margin-top: 0px; display: inline-block; font-size: 18px; font-weight: bold;">Return to Login</a>
	</div>
	<script type="text/javascript">
		const form = document.getElementById("form");
		const password = document.getElementById("password");
		const confirm_password = document.getElementById("confirm_password");
		const error_password = document.getElementById("error_password");
		const error_confirm_password = document.getElementById("error_confirm_password");
		const hint_password = document.getElementById("hint_password");

		form.addEventListener("submit", (event) => {
			if (!(password.validity.valid)) {
    			showError(password);
    			event.preventDefault();
			}
			if (!(confirm_password.validity.valid)) {
    			showError(confirm_password);
    			event.preventDefault();
			}
			if(password.value!==confirm_password.value && !(confirm_password.validity.valueMissing) && password.validity.valid){
				event.preventDefault();
				error_confirm_password.innerHTML = "&#9888; Password and Confirm Password do NOT match.";
			}				
		});

		password.addEventListener("focusout", (event) => {
			hint_password.style.display = "none";
			if(password.value !== ""){
	  			if(!(/[0-9]/.test(password.value))){
	  				error_password.innerHTML = "&#9888; Password should include at least 1 numeric character";
	  				return;
	  			}

		  		if(!(/[a-z]/.test(password.value))){
		  			error_password.innerHTML = "&#9888; Password should include at least 1 lower case character";	
		  			return;
		  		}
		  			
		  		if(!(/[A-Z]/.test(password.value))){
		  			error_password.innerHTML = "&#9888; Password should include at least 1 upper case character";	  			
		  			return;
		  		}		
		  			
	  			if (password.validity.tooLong) {
	  				error_password.innerHTML = `&#9888; Max. allowed character is ${password.maxLength}. You entered ${password.value.length} characters`;
					return;
	  			}
	  			if (password.validity.tooShort) {
	  				error_password.innerHTML = `&#9888; Min. allowed character is ${password.minLength}. You entered ${password.value.length} characters`;
	  			}
	  		}	    
		});

		confirm_password.addEventListener("focusout", (event) => {  			
  			if(password.value!==confirm_password.value && !(confirm_password.validity.valueMissing) && password.validity.valid){
				error_confirm_password.innerHTML = "&#9888; Password and Confirm Password do NOT match.";
  			}    
		});

		password.addEventListener("input", (event) => {
  			if ((error_password.innerText).includes("This") && !(password.validity.valueMissing)) {
  				error_password.innerHTML = "";
  			}
  			if ((error_password.innerText).includes("Max") && !(password.validity.tooLong)) {
  				error_password.innerHTML = "";
  			}	
  			if ((error_password.innerText).includes("Min") && !(password.validity.tooShort)) {
  				error_password.innerHTML = "";
  			}	
  			if ((error_password.innerText).includes("numeric") && (/[0-9]/.test(password.value))) {
  				error_password.innerHTML = "";
  			}	
  			if ((error_password.innerText).includes("lower") && (/[a-z]/.test(password.value))) {
  				error_password.innerHTML = "";
  			}	
  			if ((error_password.innerText).includes("upper") && (/[A-Z]/.test(password.value))) {
  				error_password.innerHTML = "";
  			}
  			if (password.value === "") {
  				error_password.innerHTML = "";
  			}	   
		});

		confirm_password.addEventListener("input", (event) => {
  			if ((error_confirm_password.innerText).includes("This") && (!(confirm_password.validity.valueMissing))) {
  				error_confirm_password.innerHTML = "";
  			}
  			if ((error_confirm_password.innerText).includes("NOT") && (password.value == confirm_password.value)) {
  				error_confirm_password.innerHTML = "";
  			}
  			if (confirm_password.value === "") {
  				error_confirm_password.innerHTML = "";
  			}	

		});

		password.addEventListener("focus", (event) => {
  			if (password.value == "" && error_password.innerHTML == "") {
  				hint_password.style.display = "block";
  			}
		});

		function showError(element) {
  			if (element.validity.valueMissing){
  				hint_password.style.display = "none";
  				const error = element.nextElementSibling;
  				error.innerHTML = "&#9888; This field is required";
  			} 
  		}

	</script>	
</body>
</html>