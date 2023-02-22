<!DOCTYPE html>
<html>
<head>
  <title>Homepage</title>
  <link rel="stylesheet" href="css/add.css">
</head>
<body>

<?php
  // Include config.php
  require_once 'config.php';

  // Define variables and set to empty values
  $meeting_name = $meeting_date = $meeting_location = $meeting_description = '';
  $meeting_name_error = $meeting_date_error = $meeting_location_error = $meeting_description_error = '';

  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate meeting name
    if (empty($_POST['meeting_name'])) {
      $meeting_name_error = 'Meeting name is required.';
    } else {
      $meeting_name = test_input($_POST['meeting_name']);
      if (!preg_match('/^[a-zA-Z0-9\s]+$/', $meeting_name)) {
        $meeting_name_error = 'Only letters, numbers and white space allowed.';
      }
    }

    // Validate meeting date
    if (empty($_POST['meeting_date'])) {
      $meeting_date_error = 'Meeting date is required.';
    } else {
      $meeting_date = test_input($_POST['meeting_date']);
    }

    // Validate meeting location
    if (empty($_POST['meeting_location'])) {
      $meeting_location_error = 'Meeting location is required.';
    } else {
      $meeting_location = test_input($_POST['meeting_location']);
      if (!preg_match('/^[a-zA-Z0-9\s]+$/', $meeting_location)) {
        $meeting_location_error = 'Only letters, numbers and white space allowed.';
      }
    }

    // Validate meeting description
    if (empty($_POST['meeting_description'])) {
      $meeting_description_error = 'Meeting description is required.';
    } else {
      $meeting_description = test_input($_POST['meeting_description']);
    }

    // Check if there are no errors
    if (empty($meeting_name_error) && empty($meeting_date_error) && empty($meeting_location_error) && empty($meeting_description_error)) {

      // Insert the meeting into the database
      $query = "INSERT INTO meetings (meeting_name, meeting_date, meeting_location, meeting_description)
                VALUES ('$meeting_name', '$meeting_date', '$meeting_location', '$meeting_description')";
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
?>

<!-- HTML code for the form -->
<form action="add.php" method="post">
  <label for="meeting_name">Meeting Name:</label>
  <input type="text" name="meeting_name" id="meeting_name" value="<?php echo $meeting_name; ?>">
  <span class="error"><?php echo $meeting_name_error; ?></span>
  <br>
  <label for="meeting_date">Meeting Date:</label>
  <input type="date" name="meeting_date" id="meeting_date" value="<?php echo $meeting_date; ?>">
  <span class="error"><?php echo $meeting_date_error; ?></span>
  <br>
  <label for="meeting_location">Meeting Location:</label>
  <input type="text" name="meeting_location" id="meeting_location" value="<?php echo $meeting_location; ?>">
  <span class="error"><?php echo $meeting_location_error; ?></span>
  <br>
  <label for="meeting_description">Meeting Description:</label>
<textarea name="meeting_description"><?php echo $meeting_description; ?></textarea>
<span class="error"><?php echo $meeting_description_error; ?></span>

<br>



  <input type="submit" value="Add Meeting">
</form>
<!-- Link to go back to the homepage -->
<br>
<a href="homepage.php">Back to Homepage</a>
<?php
// Close the database connection
mysqli_close($conn);
?>
</body>
</html>