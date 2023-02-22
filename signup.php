<!DOCTYPE html>
<html>
<head>
  <title>Homepage</title>
  <link rel="stylesheet" href="css/sign.css">
</head>
<body>
<?php
  include_once 'config.php';

  if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
      echo "Please fill in all fields.";
    } else {
      


      $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

// Store the password in plaintext in the database for testing purposes
$query = "INSERT INTO admin2 (username, email, password, plaintext_password)
          VALUES ('$username', '$email', '$password', '$plaintext_password')";


     
      $result = mysqli_query($conn, $query);

      if ($result) {
        header('Location: login.php');
      } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
  </head>
  <body>
    <h1>Sign Up</h1>
    <form action="" method="post">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required><br><br>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required><br><br>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required><br><br>
      <input type="submit" name="submit" value="Sign Up">
    </form>
  </body>
</html>
</body>
</html>