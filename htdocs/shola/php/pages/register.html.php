<!DOCTYPE HTML>
<html>
<head>
	<title>Registration</title>
</head>
<body>

	<h1>New User Registration</h1>
	<form action="../authenticate/register.php" method="POST">
		<div>
			First name <br>
			<input type="text" placeholder="Enter your fisrt name " name="firstname"
			<?php if(isset($_GET['fn'])) echo 'value='.$_GET["fn"]; ?>><br>
			Last name <br>
			<input type="text" Placeholder="Enter your last name" name="lastname"
			<?php if(isset($_GET['ln'])) echo 'value='.$_GET["ln"]; ?>><br>
			User name <br>
			<input type="text" name="username" placeholder="Enter user name"
			<?php if(isset($_GET['un'])) echo 'value='.$_GET["un"]; ?>><br>
			<?php
				if(isset($_GET['e']) && isset($_GET['id']) && $_GET['id'] == 2)
					echo "<p>User Name Exists</p>";
			?>
			Password <br>
			<input type="password" name="psw" placeholder="Enter a password"><br>
			Confirm Password<br>
			<input type="password" name="psw2" placeholder="Please confirm the password"><br>
			<?php
				if(isset($_GET['e']) && isset($_GET['id']) && $_GET['id'] == 1)
					echo "<p>Passwords Don't match</p>";
			?>
			Email <br>
			<input type="text" placeholder="Enter your Email" name="email"
			<?php if(isset($_GET['em'])) echo 'value='.$_GET["em"]; ?>><br>
			<?php
				if(isset($_GET['e']) && isset($_GET['id']) && $_GET['id'] == 3)
					echo "<p>Email Exists</p>";
			?>
			Phone number <br>

			<input type="text" placeholder="Enter your phone number" name="phonenumber"
			<?php if(isset($_GET['ph'])) echo 'value='.$_GET["ph"]; ?>><br>
			<?php
				if(isset($_GET['e']) && isset($_GET['id']) && $_GET['id'] == 4)
					echo "<p>Phone Exists</p>";
			?>
			<!-- Sex <br>
			<input type="radio" name="gender" value="male" required> Male<br>
			<input type="radio" name="gender" value="female" required>Female<br> -->
			Country<br>
			<select name="Country">
				<option  value="Ethiopia">Ethiopia</option>
				<option  value="America"> America</option>
			</select><br>
			City/Town <br>
			<input type="text" placeholder="Enter your city/town" name="city"
			<?php if(isset($_GET['ci'])) echo 'value='.$_GET["ci"]; ?>><br>
			<input type="checkbox" name="termsandpolcies" value="termsandpolcies">I Accept Terms and Plocies<br>
			<input type="submit" name="SIGN_UP" value="SIGN UP">
		</div>
	</form>
</body>
<html>