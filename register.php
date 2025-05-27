<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>register</title>
	<style type="text/css">

		div{
			text-align: center; 
			width: 98%; 
			margin-left: auto;
			margin-right: auto; 
			max-width: 450px; 
			background-color: #e6ffb3;
			padding-top: 25px;
			padding-bottom: 45px;
		}

		input::placeholder {
		  font-size: 14px;
		  opacity: 0.7; 
		}

		.user{
			width: 90%;
		 	height: 44px;
		 	margin-top: 30px;
		 	border-radius: 5px;
		 	border: 1px solid black;
		 	padding-left: 5px;
		 	font-size: 16px;
		 	padding-top: 0px;
		 	padding-bottom: 0px;
		 	border: solid #b3b3b3 2px; 		 	
		}

		#register{
			margin-top: 40px;
			border-radius: 23px;
			height: 46px; 
			width: 90%; 
			background-color: #0544b5; 
			color: white;
			font-size: 16px;
		}

		#register:hover{
			color: #ffff4d;
		}

		#register:active{
			opacity: 0.6;
		} 

		.user:focus{
			border: 2px solid #0544b5;
			outline: 5px solid #66ccff;		
		}

		p{
			text-align: left;
			padding-left: 2px;
			padding-right: 2px;			
			font-size: 14px;
			width: 90%;
			margin-right: auto;
			margin-left: auto;
			margin-top: 8px;
			margin-bottom: 0px;		
			padding-bottom: 0px;
			padding-top: 0px;
		}

		p.error{
			color:red;
		}

		input.error{
			border: 2px solid red;
			outline: 5px solid #ffb3b3;
			width: 90%;
		 	height: 42px;
		 	margin-top: 30px;
		 	border-radius: 5px;
		 	padding-left: 5px;
		 	font-size: 16px;
		}

		.hint{
			margin-top: 8px;
			font-style: italic;
			color: darkviolet;			
			display: none;
		}

		#name{
			anchor-name: --anchor;
		}

		#password{
			anchor-name: --anchor1;
		}

		#confirm_password{
			anchor-name: --anchor2;
		}

		#counter{
			position: absolute;
			margin: 0px;
			position-anchor: --anchor;
			right: anchor(right);
			top: anchor(top);
			padding-right: 5px;
			padding-top: 3px;
			font-size: 14px;
			font-weight: bold;
			color: #990099;
		}

		#show_hide{
			position: absolute;
			margin: 0px;
			position-anchor: --anchor1;
			right: calc(anchor(right) + 35px);
			top: calc(anchor(top) + 13px);
			font-size: 14px;
			font-weight: bold;
			color: #990099;
			text-decoration: none;
		}

		#show_hide1{
			position: absolute;
			margin: 0px;
			position-anchor: --anchor2;
			right: calc(anchor(right) + 35px);
			top: calc(anchor(top) + 13px);
			font-size: 14px;
			font-weight: bold;
			color: #990099;
			text-decoration: none;
		}

		@supports not (position-anchor: --anchor1) {
			#show_hide, #show_hide1{
				display: none;
			}
			#counter{
				display: none;
			}
		}	

	</style>
		
</head>
<body>
	<div>
		<a href="index.php" style="display: inline-block; font-size: 18px; font-weight: bold;">Login</a>
		<form id="form" method="post" action="email1.php" enctype="application/x-www-form-urlencoded" novalidate>
			<input type="text" name="name" id="name" class="user" placeholder="Name (max: 40 characters)" required maxlength="40" style="margin-top: 30px;">			
			<p id="error_name" class="error"></p>
			<p id="hint_name" class="hint" dir="rtl" style="text-align: right;">مثال: دكتور على جاد / بنك مصر- فرع سموحة </p>
			<input type="email" name="email" id="email" class="user" placeholder="Email" required maxlength="40">
			<p id="error_email" class="error"></p>
			<input type="password" name="password" id="password" class="user" placeholder="Password" required maxlength="20" minlength="8"><p id="error_password" class="error"></p>
			<p id="hint_password" class="hint">Password should include <b style="color: orangered;">Number</b>, <b style="color: orangered;">Upper Case</b> (A-Z), and <b style="color: orangered;">Lower Case</b> (a-z) letter</p>
			<input type="password" name="confirm_password" id="confirm_password" class="user" minlength="8" maxlength="20" placeholder="Confirm Password" required>
			<p id="error_confirm_password" class="error"></p>
			<input type="submit" name="submit" value="Create Account" id="register">
		</form>
		<span id="counter"></span>
		<button id="show_hide" style="border: none; background-color:white; border-radius: 9px;">Show</button>
		<button id="show_hide1" style="border: none; background-color:white;">Show</button>
	</div>
	<script type="text/javascript">
		const outer = document.getElementById("outer");
		const form = document.getElementById("form");
		const name = document.getElementById("name");
		const email = document.getElementById("email");
		const password = document.getElementById("password");
		const confirm_password = document.getElementById("confirm_password");
		const error_name = document.getElementById("error_name");
		const error_email = document.getElementById("error_email");
		const error_password = document.getElementById("error_password");
		const error_confirm_password = document.getElementById("error_confirm_password");
		const hint_name = document.getElementById("hint_name");
		const hint_password = document.getElementById("hint_password");
		const counter = document.getElementById("counter");
		const show_hide = document.getElementById("show_hide");
		const show_hide1 = document.getElementById("show_hide1");
		const register = document.getElementById("register");

		form.addEventListener("submit", (event) => {
			hint_name.style.display = "none";
			hint_password.style.display = "none";
			if (!(name.validity.valid)) {
    			showError(name);
    			event.preventDefault();
			}
			if (!(email.validity.valid)) {
    			showError(email);
    			event.preventDefault();
			}
			else{
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
						var res_text=  xhttp.responseText;
						var res_obj = JSON.parse(res_text);
						var res = res_obj.res;
						if (res != "email does not exist") {
							event.preventDefault();
							document.write(res);
							return;
						}
				    }
				};
				var url = "check_email_existence.php?email="+ email.value;
				xhttp.open("get", url, false);
				xhttp.send();
			}
			if ((!(password.validity.valid)) || (!(/[0-9]/.test(password.value))) || (!(/[a-z]/.test(password.value))) || (!(/[A-Z]/.test(password.value)))) {
    			showError(password);
    			event.preventDefault();
			}			
			if (!(confirm_password.validity.valid)) {
    			showError(confirm_password);
    			event.preventDefault();
			}
			if(password.value!==confirm_password.value && !(confirm_password.validity.valueMissing) && password.validity.valid){
				event.preventDefault();
				confirm_password.style.backgroundImage= "url('error.png')";	
  				confirm_password.style.backgroundRepeat= "no-repeat";
			 	confirm_password.style.backgroundPosition= "center right";
			 	confirm_password.className = "error";
				error_confirm_password.innerHTML = "&#9888; Password and Confirm Password do NOT match.";
			}
		});

		name.addEventListener("focusout", (event) => {
			if (event.relatedTarget !== null && (event.relatedTarget.id !== "register")){
				hint_name.style.display = "none";
			}
			if (event.relatedTarget !== null && (event.relatedTarget.id == "show_hide" || event.relatedTarget.id == "show_hide1")) {
		  		name.focus();
		  		return;
		  	}
  			if (name.validity.tooLong) {
  				error_name.innerHTML = `&#9888; Max. allowed character is ${name.maxLength}. You entered ${name.value.length} characters`;
  				name.style.backgroundImage= "url('error.png')";	
  				name.style.backgroundRepeat= "no-repeat";
			 	name.style.backgroundPosition= "center right";
			 	name.className = "error";
  			}   
		});

		email.addEventListener("focusout", (event) => {
  			if (email.validity.typeMismatch) {
  				error_email.innerHTML = "&#9888; Please enter a valid email adress.";
  				email.style.backgroundImage= "url('error.png')";	
  				email.style.backgroundRepeat= "no-repeat";
			 	email.style.backgroundPosition= "center right";
			 	email.className = "error";
  				return;
  			}
  			if (email.validity.tooLong) {
  				error_name.innerHTML = `&#9888; Max. allowed character is ${email.maxLength}. You entered ${email.value.length} characters`;
  				email.style.backgroundImage= "url('error.png')";	
  				email.style.backgroundRepeat= "no-repeat";
			 	email.style.backgroundPosition= "center right";
			 	email.className = "error";	
  			}   
		});

		password.addEventListener("focusout", (event) => {
				hint_password.style.display = "none";
				if (event.relatedTarget !== null && (event.relatedTarget.id == "show_hide" || event.relatedTarget.id == "show_hide1")) {
		  			password.focus();
		  			return;
		  		}
				if(password.value !== ""){
		  			if(!(/[0-9]/.test(password.value))){
		  				error_password.innerHTML = "&#9888; Password should include at least 1 numeric character";
		  				password.style.backgroundImage= "url('error.png')";	
		  				password.style.backgroundRepeat= "no-repeat";
					 	password.style.backgroundPosition= "center right";
					 	password.className = "error";
		  				return;
		  			}

			  		if(!(/[a-z]/.test(password.value))){
			  			error_password.innerHTML = "&#9888; Password should include at least 1 lower case character";
			  			password.style.backgroundImage= "url('error.png')";	
		  				password.style.backgroundRepeat= "no-repeat";
					 	password.style.backgroundPosition= "center right";
					 	password.className = "error";	
			  			return;
			  		}
			  			
			  		if(!(/[A-Z]/.test(password.value))){
			  			error_password.innerHTML = "&#9888; Password should include at least 1 upper case character";
			  			password.style.backgroundImage= "url('error.png')";	
		  				password.style.backgroundRepeat= "no-repeat";
					 	password.style.backgroundPosition= "center right";
					 	password.className = "error";	
			  			return;
			  		}		
			  			
		  			if (password.validity.tooLong) {
		  				error_password.innerHTML = `&#9888; Max. allowed character is ${password.maxLength}. You entered ${password.value.length} characters`;
		  				password.style.backgroundImage= "url('error.png')";	
		  				password.style.backgroundRepeat= "no-repeat";
					 	password.style.backgroundPosition= "center right";
					 	password.className = "error";	
						return;
		  			}
		  			if (password.validity.tooShort) {
		  				error_password.innerHTML = `&#9888; Min. allowed character is ${password.minLength}. You entered ${password.value.length} characters`;
		  				password.style.backgroundImage= "url('error.png')";	
		  				password.style.backgroundRepeat= "no-repeat";
					 	password.style.backgroundPosition= "center right";
					 	password.className = "error";
		  			}		  			
		  		}	    
		});

		confirm_password.addEventListener("focusout", (event) => {
			if (event.relatedTarget !== null && (event.relatedTarget.id == "show_hide1" || event.relatedTarget.id == "show_hide")) {
		  		confirm_password.focus();
		  		return;
		  	}
		});	

		name.addEventListener("input", (event) => {
			counter.innerText = 40 - name.value.length;
  			if (name.validity.valid) {
  				name.style.backgroundImage = "none";
  				name.className = "user";
  			}
  			if ((error_name.innerText).includes("This") && !(name.validity.valueMissing)) {
  				error_name.innerHTML = "";
  			}
  			if ((error_name.innerText).includes("Max") && !(name.validity.tooLong)) {
  				error_name.innerHTML = "";
  			}
  			if ((error_name.innerText).includes("Valid") && !(name.validity.patternMismatch)) {
  				error_name.innerHTML = "";
  			}
  			if (name.value === "") {
  				error_name.innerHTML = "";
  				name.style.backgroundImage = "none";
  				name.className = "user"; 
  			}	

		});

		email.addEventListener("input", (event) => {
  			if (email.validity.valid) {
  				email.style.backgroundImage = "none";
  				email.className = "user";
  			}
  			if ((error_email.innerText).includes("This") && !(email.validity.valueMissing)) {
  				error_email.innerHTML = "";
  			}
  			if ((error_email.innerText).includes("Please") && !(email.validity.typeMismatch)) {
  				error_email.innerHTML = "";
  			}
  			if ((error_email.innerText).includes("Max") && !(email.validity.tooLong)) {
  				error_email.innerHTML = "";
  			}
  			if (email.value === "") {
  				error_email.innerHTML = "";
  				email.style.backgroundImage = "none";
  				email.className = "user"; 
  			}	
		});

		password.addEventListener("input", (event) => {
  			if (password.validity.valid && /[0-9]/.test(password.value) && /[a-z]/.test(password.value) && /[A-Z]/.test(password.value)) {
  				password.style.backgroundImage = "none";
  				password.className = "user";
  			}
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
  				password.style.backgroundImage = "none";
  				password.className = "user"; 
  			}	   
		});

		confirm_password.addEventListener("input", (event) => {
  			if (password.value == confirm_password.value && confirm_password.validity.valid) {
  				confirm_password.style.backgroundImage = "none";
  				confirm_password.className = "user";
  			}
  			if ((error_confirm_password.innerText).includes("This") && (!(confirm_password.validity.valueMissing))) {
  				error_confirm_password.innerHTML = "";
  			}
  			if ((error_confirm_password.innerText).includes("NOT") && (password.value == confirm_password.value)) {
  				error_confirm_password.innerHTML = "";
  			}
  			if (confirm_password.value === "") {
  				error_confirm_password.innerHTML = "";
  				confirm_password.style.backgroundImage = "none";
  				confirm_password.className = "user"; 
  			}	

		});

		name.addEventListener("focus", (event) => {
			if (name.value == ""){
				counter.innerText = 40;
			}
  			if (error_name.innerHTML == "") {
  				hint_name.style.display = "block";
  			} 
		});

		password.addEventListener("focus", (event) => {
			if (error_password.innerHTML == "") {
  				hint_password.style.display = "block";
  			}
		});

		show_hide.addEventListener("click", (event) => {
			if (show_hide.innerText == "Show"){
		  		password.type = "text";
		  		show_hide.innerText = "Hide";
	  		}
		  	else{
		  		password.type = "password";
		  		show_hide.innerText = "Show";
		  	}
	  		setTimeout(function() {bring_to_start(password)},0);
		});

		show_hide1.addEventListener("click", (event) => {
			if (show_hide1.innerText == "Show"){
		  		confirm_password.type = "text";
		  		show_hide1.innerText = "Hide";
	  		}
			else{
				confirm_password.type = "password";
				show_hide1.innerText = "Show";
			}
	  		setTimeout(function() {bring_to_start(confirm_password)},0);
		});

		function showError(element) {
  			if (element.validity.valueMissing){
  				const error = element.nextElementSibling;
  				element.style.backgroundImage= "url('error.png')";	
  				element.style.backgroundRepeat= "no-repeat";
			 	element.style.backgroundPosition= "center right";
			 	element.className = "error";
  				error.innerHTML = "&#9888; This field is required";
  			} 
  		}

  		function bring_to_start(element){
  			var length = element.value.length;
  			element.setSelectionRange(length, length);
  		}


	</script>	
</body>
</html>