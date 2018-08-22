function myFunction() {
	var username = document.getElementById("username_text").value;
	var password = document.getElementById("password_text").value;
	var checkbox = document.getElementById("checkbox").checked;
	var number=1;
	if(checkbox == true){
		var ch=1;
	}
	else{
		var ch=0;
	}
	// Returns successful data submission message when the entered information is stored in database.
	var dataString = 'username=' + username + '&password=' + password + '&checkbox=' + ch + '&function_num=' + number;
	if (username == '' || password == '') {
		if(username==''){
			document.getElementById("username_error").innerHTML="Enter User name";
		}
		else if(username!=''){
			document.getElementById("username_error").innerHTML="";
		}
		if(password==''){
			document.getElementById("password_error").innerHTML="Enter Password";
		}
		else if(password!=''){
			document.getElementById("password_error").innerHTML="";
		}
	}
	else {
		$.ajax({
			type: "POST",
			url: "login_page.php",
			data: dataString,
			cache: false,
			success: function(html) {
				var result = html;
				if(result.indexOf("Success")>=0){
					var disp=1;
				}
				else{
					var disp=0;
				}
				if(disp==1){
					window.location.href = "dashboard1.php";
				}
			}
		});
	}
	return false;
}

function signup_check() {

	var username = document.getElementById("username").value;
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var email = document.getElementById("email").value;
	var phone_number = document.getElementById("phone_number").value;
	var department = document.getElementById("department").value;
	var password = document.getElementById("password").value;
	var confirm_password = document.getElementById("confirm_password").value;

	var checkbox = document.getElementById("checkbox").checked;

	if(username==''){
			document.getElementById("username_error").innerHTML="Enter User name";
		}
		else if(username!=''){
		document.getElementById("username_error").innerHTML="";
		}
		if(firstname==''){
			document.getElementById("firstname_error").innerHTML="Enter First name";
		}
		else if(firstname!=''){
		document.getElementById("firstname_error").innerHTML="";
		}
		if(lastname==''){
			document.getElementById("lastname_error").innerHTML="Enter Last name";
		}
		else if(lastname!=''){
		document.getElementById("lastname_error").innerHTML="";
		}
		if(email==''){
			document.getElementById("email_error").innerHTML="Enter Email";
		}
		else if(email!=''){
		document.getElementById("email_error").innerHTML="";
		}
		if(phone_number==''){
			document.getElementById("phone_number_error").innerHTML="Enter Phone number";
		}
		else if(phone_number!=''){
		document.getElementById("phone_number_error").innerHTML="";
		}
		if(password==''){
			document.getElementById("password_error").innerHTML="Enter Password";
		}
		else if(password!=''){
		document.getElementById("password_error").innerHTML="";
		}
		if(confirm_password==''){
			document.getElementById("confirm_password_error").innerHTML="Re-enter Password";
		}
		else if(confirm_password!=''){
		document.getElementById("confirm_password_error").innerHTML="";
		}

	var number=1;
	if(checkbox == true){
		var ch=1;}
		else{
			var ch=0;
		}
	// Returns successful data submission message when the entered information is stored in database.
	var dataString = 'username=' + username + '&firstname=' + firstname + '&lastname=' + lastname + '&email=' + email + '&phone_number=' + phone_number+ '&department=' + department + '&password=' + password + '&checkbox=' + ch + '&function_num=' + number;
	if((username!='')&&(firstname!='')&&(lastname!='')&&(password==confirm_password)&&(email!='')&&(phone_number!='')&&(password!='')&&(confirm_password!='')) {
		$.ajax({
			type: "POST",
			url: "signup_page.php",
			data: dataString,
			cache: false,
			success: function(html) {
				var result = html;
				if(result.indexOf("Success")>=0){
					var disp=1;
				}
				else{
					var disp=0;
				}
				if(disp==1){
					window.location.href = "dashboard1.php";
				}
			}
		});
	}
	else{
		alert("Passwords must be equal");
	}
}

function bt(){
	var username = document.getElementById("username_text").value;
	var number=2;
	if(username == ''){
		document.getElementById("username_error").innerHTML="Enter User name";
		
	}
	else{
		var dataString = 'username=' + username + '&function_num=' + number;
		
		$.ajax({
		type: "POST",
		url: "login_page.php",
		data: dataString,
		cache: false,
		success: function(html) {
			var result = html;
			if(result.indexOf("Success")>=0){
				check();
			}
			else
				alert("error");
		}
		});	
	}
}

function check() {
	mail_to_user();
	var modal = document.getElementById('myModal');
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function closealert() {
 	var modal = document.getElementById('myModal');
    modal.style.display = "none";
}

function mail_to_user(){
	var number=1;
	var dataString = 'function_num=' + number;
	$.ajax({
		type: "POST",
		url: "password_recovery.php",
		data: dataString,
		cache: false,
		success: function(html) {
			alert('reached');
			var result = html;
			alert(result);
		}
	});	
}
function validate_otp(){
	var confirm_password = document.getElementById("confirm_password_text1").value;
	var password = document.getElementById("password_text1").value;
	var otp = document.getElementById("username_text1").value;
	if(otp==""){
		document.getElementById("otp_error").innerHTML="Enter OTP";}
		else{
		document.getElementById("otp_error").innerHTML="";
		}
	if(password==''){
		document.getElementById("password_text1_error").innerHTML="Enter Password";
	}
	else{
		document.getElementById("password_text1_error").innerHTML="";
	}
	if(confirm_password==''){
		document.getElementById("confirm_password_text1_error").innerHTML="Re-enter password";
	}
	else{
		document.getElementById("confirm_password_text1_error").innerHTML="";
	}
	if (password!=confirm_password) {
		alert("passwords should be same!!");
	}
	else {
		var number=2;
		var dataString = 'function_num=' + number + '&password=' + password + '&otp=' + otp;
		$.ajax({
			type: "POST",
			url: "password_recovery.php",
			data: dataString,
			cache: false,
			success: function(html) {
				var result = html;
				if(result.indexOf("Success")>=0){
					window.location.href = "dashboard1.php";
				}
				else{
					alert("error");
				}
			}
		});
	}
}
function check11() {
	alert("fkkdfm");
}

// **************** For dashboard  ***************************  


function get_details(){
   alert('helozz');
}