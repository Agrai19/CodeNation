<html>
<head>
  <title>Attendance</title>
  <link rel="stylesheet" href="css/attendance.css">
</head>
<body>

<?php
  // Include config.php
  include 'functions2.php';
  require_once 'config.php';
  


  // Define variables and set to empty values
  $meeting_id = $person_name = $attendance = '';
  $meeting_id_error = $person_name_error = $attendance_error = '';

  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate meeting ID
    if (empty($_POST['meeting_id'])) {
      $meeting_id_error = 'Meeting ID is required.';
    } else {
      $meeting_id = test2_input($_POST['meeting_id']);
      if (!is_numeric($meeting_id)) {
        $meeting_id_error = 'Meeting ID must be a number.';
      }
    }

    // Validate person name
    if (empty($_POST['person_name'])) {
      $person_name_error = 'Person name is required.';
    } else {
      $person_name = test2_input($_POST['person_name']);
      if (!preg_match('/^[a-zA-Z\s]+$/', $person_name)) {
        $person_name_error = 'Only letters and white space allowed.';
      }
    }

    // Validate attendance
    if (empty($_POST['attendance'])) {
      $attendance_error = 'Attendance is required.';
    } else {
      $attendance = test2_input($_POST['attendance']);
      if (!in_array($attendance, ['present', 'absent'])) {
        $attendance_error = 'Invalid attendance value.';
      }
    }

    // Check if there are no errors
    if (empty($meeting_id_error) && empty($person_name_error) && empty($attendance_error)) {

      // Insert the attendance into the database
      $query = "INSERT INTO attendance (meeting_id, person_name, attendance)
                VALUES ('$meeting_id', '$person_name', '$attendance')";
      mysqli_query($conn, $query);

      // Redirect to the homepage
      header('Location: homepage.php');
      exit;
    }
  }

  // Function to sanitize input values
  function test2_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

<!-- HTML code for the form -->
<form action="attendance.php" method="post">
  <label for="meeting_id">Meeting ID:</label>
  <input type="text" name="meeting_id" id="meeting_id" value="<?php echo $meeting_id; ?>">
  <span class="error"><?php echo $meeting_id_error; ?></span>
  <br>
  <label for="person_name">Person Name:</label>
  <input type="text" name="person_name" id="person_name" value="<?php echo $person_name; ?>">
  <span class="error"><?php echo $person_name_error; ?></span>
  <br>
  <label for="attendance">Attendance:</label>
  <select name="attendance" id="attendance">
    <option value="">--Select--</option>
    <option value="present"<?php echo $attendance === 'present' ? ' selected' : ''; ?>>Present</option>
    <option value="absent"<?php echo $attendance === 'absent' ? ' selected' : ''; ?>>Absent</option>
  </select>
  <span class="error"><?php echo $attendance_error; ?></span>
  <br>

  <input type="submit" value="Add Attendance">
</form>

<!-- Link to go back to the homepage -->
<br>
<a href="homepage.php">Back to Homepage</a>

<?php
// Include config.php
require_once 'config.php';

// Define variables and set to empty values
$meeting_id = $person_name = $attendance = '';
$meeting_id_error = $person_name_error = $attendance_error = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Validate meeting ID
  if (empty($_POST['meeting_id'])) {
    $meeting_id_error = 'Meeting ID is required.';
  } else {
    $meeting_id = test_input($_POST['meeting_id']);
    if (!is_numeric($meeting_id)) {
      $meeting_id_error = 'Meeting ID must be a number.';
    }
  }

  // Validate person name
  if (empty($_POST['person_name'])) {
    $person_name_error = 'Person name is required.';
  } else {
    $person_name = test_input($_POST['person_name']);
    if (!preg_match('/^[a-zA-Z\s]+$/', $person_name)) {
      $person_name_error = 'Only letters and white space allowed.';
    }
  }

  // Validate attendance
  if (empty($_POST['attendance'])) {
    $attendance_error = 'Attendance is required.';
  } else {
    $attendance = test_input($_POST['attendance']);
  }

  // Check if there are no errors
  if (empty($meeting_id_error) && empty($person_name_error) && empty($attendance_error)) {

    // Insert the attendance into the database
    $query = "INSERT INTO attendance (meeting_id, person_name, attendance)
              VALUES ('$meeting_id', '$person_name', '$attendance')";
    mysqli_query($conn, $query);

    // Redirect to the homepage
    header('Location: homepage.php');
    exit;
  }
}

// Function to sanitize input values
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Close the database connection
mysqli_close($conn);
?>
