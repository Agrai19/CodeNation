<?php
  // Include config.php
  require_once 'config.php';

  // Check if the user ID is set in the URL
  if (isset($_GET['id'])) {
    // Get the user ID from the URL
    $id = $_GET['id'];

    // Query the database to retrieve the user information
    $query = "SELECT * FROM users1 WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // Check if the user attendance form has been submitted
    if (isset($_POST['submit'])) {
      // Get the selected date and meeting ID from the form
      $selected_date = $_POST['selected_date'];
      $meeting_id = $_POST['meeting_id'];

      // Insert the user attendance record into the database
      $query = "INSERT INTO attendance (user_id, meeting_id, selected_date) VALUES ($id, $meeting_id, '$selected_date')";
      mysqli_query($conn, $query);

      // Show a success message
      echo '<p>Attendance recorded successfully.</p>';
    }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Person Details</title>
  <style>
    /* Add your CSS styles here */
  </style>
</head>
<body>
  <h1><?php echo $user['name']; ?></h1>

  <h2>Profile Details</h2>
  <p><strong>Education Background:</strong> <?php echo $user['education']; ?></p>
  <p><strong>Job Scope:</strong> <?php echo $user['job_scope']; ?></p>

  <h2>Attendance</h2>
  <form method="post">
    <label for="meeting_id">Select a meeting:</label>
    <select id="meeting_id" name="meeting_id">
      <?php
        // Query the database to retrieve the meetings
        $query = "SELECT * FROM meetings";
        $result = mysqli_query($conn, $query);

        // Loop through the results and display the meetings in a dropdown list
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<option value="' . $row['id'] . '">' . $row['meeting_name'] . '</option>';
        }
      ?>
    </select>

    <br><br>

    <label for="selected_date">Select the date:</label>
    <input type="date" id="selected_date" name="selected_date" required>

    <br><br>

    <input type="submit" name="submit" value="Record Attendance">
  </form>
</body>
</html>

<?php
  // Close the database connection
  mysqli_close($conn);
} else {
  // No user ID found in the URL
  echo '<p>No user found.</p>';
}
?>