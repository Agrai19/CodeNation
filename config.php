<?php
  // Define database connection constants
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'test_db');

  // Connect to the database
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  // Check the connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>
