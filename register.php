<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Register</h1>
	<form method="POST" action="register.php">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required>

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required>

		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required>

		<label for="confirm_password">Confirm Password:</label>
		<input type="password" id="confirm_password" name="confirm_password" required>

		<input type="submit" value="Register">
	</form>

	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];

			if ($password != $confirm_password) {
				echo '<p class="error">Passwords do not match.</p>';
			} else {
				// Do something with the user's input, like save it to a database
				echo '<p class="success">Registration successful!</p>';
			}
		}
	?>
</body>
</html>
