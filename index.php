<!DOCTYPE html>
<html>
<head>
  <title>My Website</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="container">
    <h1>Welcome to UPSI Meeting</h1><br>
    <h1> Minutes Website</h1>
    <p>Please sign in to continue.</p>
    <div class="form">
      <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" name="submit" value="Login">
      </form>
      <a href="signup.php">Sign Up</a>
    </div>
   
  </div>
</body>
</html>
