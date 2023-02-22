<?php
// Include config.php
require_once 'config.php';

// Check if the meeting ID is provided in the URL
if (!isset($_GET['id'])) {
  echo '<p>Error: Meeting ID is missing.</p>';
  exit;
}

// Get the meeting ID from the URL and sanitize it
$id = mysqli_real_escape_string($conn, $_GET['id']);

// Check if the confirmation form has been submitted
if (isset($_POST['confirm'])) {
  // Delete the meeting from the database
  $query = "DELETE FROM meetings WHERE id='$id'";
  if (mysqli_query($conn, $query)) {
    // Meeting deleted successfully
    header('Location: homepage.php');
    exit;
  } else {
    // Error deleting meeting
    echo '<p>Error deleting meeting: ' . mysqli_error($conn) . '</p>';
  }
}

// Close the database connection
mysqli_close($conn);
?>

<!-- HTML code for the confirmation form -->
<form action="" method="post">
  <p>Are you sure you want to delete this meeting?</p>
  <input type="submit" name="confirm" value="Yes">
  <button onclick="window.history.back()">No</button>
</form>
