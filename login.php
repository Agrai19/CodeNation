<?php
  // Include config.php
  require_once 'config.php';

  // Check if the form has been submitted
  if (isset($_POST['submit'])) {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to check if the user exists
    $query = "SELECT * FROM admin2 WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Check if a match was found
    if (mysqli_num_rows($result) == 1) {
      // Login success, redirect to homepage
      header('Location: homepage.php');
      exit;
    } else {
      // Login failed, show error message
      $error_message = 'Invalid username or password';
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
</head>
<body style="background-color: #f2f2f2; font-family: Arial, sans-serif;">

	<h2 style="text-align: center;">Login Form</h2>

	<div style="margin: 0 auto; width: 400px; background-color: #fff; padding: 20px; border: 1px solid #ddd; box-shadow: 2px 2px 5px #888;">
		<form action="login.php" method="post">
			<label for="username" style="font-weight: bold; display: block; margin-bottom: 10px;<?php if (isset($_POST['submit'])) {echo 'display:none;';} ?>">Username:</label>
			<input type="text" name="username" id="username" style="width: 100%; padding: 10px; font-size: 16px; margin-bottom: 20px; border: 1px solid #ccc;<?php if (isset($_POST['submit'])) {echo 'display:none;';} ?>">

			<label for="password" style="font-weight: bold; display: block; margin-bottom: 10px;<?php if (isset($_POST['submit'])) {echo 'display:none;';} ?>">Password:</label>
			<input type="password" name="password" id="password" style="width: 100%; padding: 10px; font-size: 16px; margin-bottom: 20px; border: 1px solid #ccc;<?php if (isset($_POST['submit'])) {echo 'display:none;';} ?>">

			<input type="submit" name="submit" value="Login" style="background-color: #4CAF50; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer;<?php if (isset($_POST['submit'])) {echo 'display:none;';} ?>">

			<p style="color: red; margin-top: 20px;">
				<?php
					if (isset($error_message)) {
					    echo $error_message;
					}
				?>
			</p>
		</form>

		<p style="text-align: center; margin-top: 20px;">Don't have an account? <a href="signup.php" style="color: #4CAF50; text-decoration: none;">Sign Up</a></p>
    <p style="text-align: center; margin-top: 40px;">Go back to Login Page? <a href="index.php" style="color: #4CAF50; text-decoration: none;">Here</a></p>
  </div>

</body>
</html>

