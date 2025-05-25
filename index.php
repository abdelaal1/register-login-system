<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login</title>
	<style type="text/css">

		div#outer{
			width: 98%; 
			max-width: 450px; 
			background-color: #e6ffb3;
			padding-top: 50px;
			padding-bottom: 50px;
			text-align: center;
			margin-left: auto;
			margin-right: auto;
		}

		div#inner{
			width: 90%; 
			background-color: #e6ffb3;
			margin-top: 30px;
			margin-left: auto;
			margin-right: auto;
		}

		p{
			width: 90%;
			margin-left: auto;
			margin-right: auto;
			color: red;
			text-align: left;
			margin-top: 20px;
			margin-bottom: 0px;
			display: none;
		}

		input.user{
			width: 90%;
		 	height: 42px;
		 	border-radius: 3px;
		 	border: 1px solid black;
		 	padding-left: 5px;
		 	font-size: 14px;
		}

		input[name="email"]{
			margin-top: 0px;
		}

		input[name="password"]{
			margin-top: 20px;
		}


		input#log_in{
			margin-top: 40px;
			border-radius: 23px;
			height: 46px; 
			width: 90%; 
			background-color: #0544b5; 
			color: white;
			font-size: 16px;
		}

		input#sign_up{
			margin-top: 30px; 
			border-radius: 23px; 
			height:46px; 
			width:90%; 
			background-color: white;
			color: #0544b5; 
			border: 1px solid #0544b5;
			font-size: 16px;
		}

		input#log_in:hover{
			color: #ffff4d;
		}

		input#sign_up:hover{
			color: black;
		}

		input#log_in:active{
			opacity: 0.6;
		}

		input#sign_up:active{
			background-color: #66ccff;
		} 

		input.user:focus{
		border: 2px solid #0544b5;
		outline: 5px solid #66ccff;		
		}

		

	</style>
		
</head>
<body>
	<div id="outer">
		<form id="form" novalidate>
			<input id="email" type="email" name="email" class="user" placeholder="Email" required maxlength="40">
			<input type="password" id="password" name="password" class="user" placeholder="Password" required maxlength="20" minlength="8">
			<p id="error"></p>
			<a href="reset1.php" style="float: left; padding-left: 5%; margin-top: 20px;">Forget password</a>
			<input type="submit" name="submit" value="log in" id="log_in">
			<div id="inner">
			<hr style="display: inline-block; width: 43%; vertical-align: middle;">
			<span style="display: inline-block; width: 5%;">or</span>
			<hr style="display: inline-block; width: 43%; vertical-align: middle;">
			</div>			
			<input type="button" name="sign_up" value="Sign up" id="sign_up" onclick="location.href = 'register.php'">	
		</form>
	</div>
	<script type="text/javascript">
		const form = document.getElementById("form");
		const email = document.getElementById("email");
		const password = document.getElementById("password");
		const error = document.getElementById("error");
		var elements = [];
		form.addEventListener("submit", (event) => {
			event.preventDefault();
			if (email.validity.valueMissing){
				elements.push(email);    			
			}
			if (password.validity.valueMissing){
				elements.push(password);							
			}
			if (elements.length == 1){
				error.style.display = "block"; 
	  			error.innerHTML = "&#9888; Please enter " + elements[0].name;
	  			elements = [];	  			
	  			return;
	  		}
	  		if (elements.length == 2){
	  			error.style.display = "block"; 
	  			error.innerHTML = "&#9888; Please enter email and password";
	  			elements = [];	  			
	  			return; 
	  		}
	  		if (!(email.validity.valid) || !(password.validity.valid)) {
	  			error.style.display = "block";	  			
	  			error.innerHTML = "&#9888; Incorrect login information. Please try again.";	  			
	  			return;
	  		}
	  		if(!(/[0-9]/.test(password.value)) || !(/[a-z]/.test(password.value)) || !(/[A-Z]/.test(password.value))){
		  		error.style.display = "block";	  			
		  		error.innerHTML = "&#9888; Incorrect login information. Please try again.";	  			
		  		return;
	  		}
	  		var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
					var res_text=  xhttp.responseText;
					var res_obj = JSON.parse(res_text);
					var res = res_obj.res;
					if (res == "valid credentials") {
						window.location.href = "admin_dashboard.php";
					}
					else{
						error.style.display = "block";	  			
		  				error.innerHTML = "&#9888;" + res;	  			
		  				return;
					}
				}
			};
			var url = "check_login_information.php?email="+ encodeURIComponent(email.value) + "&password=" + encodeURIComponent(password.value);
			xhttp.open("get", url, false);
			xhttp.send();
		});

	</script>	
</body>
</html>