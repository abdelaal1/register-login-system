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
			width: 90%; 
			max-width: 450px; 
			background-color: #e6ffb3;
			padding-top: 50px;
			padding-bottom: 45px;
		}

		p{
			width: 90%;
			margin-left: auto;
			margin-right: auto;
			color: red;
			text-align: left;
			margin-top: 20px;
			margin-bottom: 0px;
			font-size: 14px;
			display: none;
		}

		input.user{
			width: 90%;
		 	height: 42px;
		 	border-radius: 5px;
		 	border: solid #b3b3b3 2px;
		 	padding-left: 5px;
		 	font-size: 14px;		 	
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
		<form id="form" action="email2.php" method="post" novalidate>
			<input type="email" name="email" id="email" class="user" placeholder="Enter your email" maxlength="40" required>
			<p id="error">&#9888; Incorrect email. Please try again.</p>
			<input type="submit" name="submit" value="Submit" id="submit">
		</form>
		<a href="index.php" style="margin-top: 0px; display: inline-block; font-size: 18px; font-weight: bold;">Return to Login</a>
	</div>
	<script type="text/javascript">
		const email = document.getElementById("email");
		const error = document.getElementById("error");
		const submit = document.getElementById("submit");


		submit.addEventListener("click", (event) => {
  			if (!(email.validity.valid)) {
  				if (email.validity.valueMissing) {
  					error.style.display = "block";
  					error.innerHTML = "&#9888; Please enter your email."
  					event.preventDefault();
  				}
  				else{
  					error.style.display = "block";
  					error.innerHTML = "&#9888; invalid email."
  					event.preventDefault();
  				}
  			}
  			else{
  				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
						var res_text=  xhttp.responseText;
						var res_obj = JSON.parse(res_text);
						var res = res_obj.res;
						if (res == "email does not exist") {
							error.style.display = "block";
  							error.innerHTML = "&#9888; Email is not Registered."
  							event.preventDefault();
						}
				    }
				};
				var url = "check_email_existence.php?email="+ encodeURIComponent(email.value);
				xhttp.open("get", url, false);
				xhttp.send();
  			}
		});
	</script>	
</body>
</html>