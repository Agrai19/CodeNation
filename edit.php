

<head>
  <title>Edit Meeting</title>
  <link rel="stylesheet" href="css/edit.css">
</head>

<?php
  // Include config.php
  require_once 'config.php';

  // Check if the form has been submitted
  if (isset($_POST['submit'])) {
    // Get the form data
    $id = $_POST['id'];
    $meeting_name = $_POST['meeting_name'];
    $meeting_date = $_POST['meeting_date'];
    $meeting_location = $_POST['meeting_location'];
    $meeting_description = $_POST['meeting_description'];

    // Update the meeting in the database
    $query = "UPDATE meetings SET meeting_name='$meeting_name', meeting_date='$meeting_date', meeting_location='$meeting_location', meeting_description='$meeting_description' WHERE id=$id";
    mysqli_query($conn, $query);

    // Redirect to the homepage
    header('Location: homepage.php');
    exit;
  } else {
    // Get the meeting ID from the URL
    $id = $_GET['id'];

    // Query the database to retrieve the meeting
    $query = "SELECT * FROM meetings WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $meeting = mysqli_fetch_assoc($result);
  }
?>

<!-- HTML code for the form -->
<form action="edit.php" method="post" onsubmit="return confirm('Are you sure you want to edit this meeting?')">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <label for="meeting_name">Meeting Name:</label>
  <input type="text" name="meeting_name" id="meeting_name" value="<?php echo $meeting['meeting_name']; ?>">
  <br>
  <label for="meeting_date">Meeting Date:</label>
  <input type="date" name="meeting_date" id="meeting_date" value="<?php echo $meeting['meeting_date']; ?>">
  <br>
  <label for="meeting_location">Meeting Location:</label>
  <input type="text" name="meeting_location" id="meeting_location" value="<?php echo $meeting['meeting_location']; ?>">
  <br>
  <label for="meeting_description">Meeting Description:</label>
  <textarea name="meeting_description" id="meeting_description"><?php echo $meeting['meeting_description']; ?></textarea>
  <br>
  <input type="submit" name="submit" value="Edit Meeting">
</form>

