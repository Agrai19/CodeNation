<!DOCTYPE html>
<html>
<head>
  <title>Homepage</title>
  <link rel="stylesheet" href="css/home.css">
</head>
<body>

<?php
  // Include config.php
  require_once 'config.php';

  // Check if a meeting has been deleted
  if (isset($_GET['delete'])) {
    // Get the meeting ID from the URL
    $id = $_GET['delete'];

    // Delete the meeting from the database
    $query = "DELETE FROM meetings WHERE id=$id";
    mysqli_query($conn, $query);

    // Redirect to the homepage
    header('Location: homepage.php');
    exit;
  }

  // Query the database to retrieve the meetings
  $query = "SELECT * FROM meetings ORDER BY meeting_date DESC";
  $result = mysqli_query($conn, $query);

  // Check if any meetings were found
  if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '  <tr>';
    echo '    <th>ID</th>';
    echo '    <th>Date</th>';
    echo '    <th>Name</th>';
    echo '    <th>Location</th>';
    echo '    <th>Description</th>';
    echo '    <th>Actions</th>';
    echo '  </tr>';

    // Loop through the results and display the meetings
    while ($row = mysqli_fetch_assoc($result)) {
      echo '  <tr>';
      echo '    <td>' . $row['id'] . '</td>';
      echo '    <td>' . $row['meeting_date'] . '</td>';
      echo '    <td>' . $row['meeting_name'] . '</td>';
      echo '    <td>' . $row['meeting_location'] . '</td>';
      echo '    <td>' . $row['meeting_description'] . '</td>';
      echo '    <td>';
      echo '      <a href="edit.php?id=' . $row['id'] . '">Edit</a>';
      echo '      <a href="homepage.php?delete=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this meeting?\')">Delete</a>';
      echo '      <a href="detail.php?id=' . $row['id'] . '">Details</a>'; // add link for details page
      echo '    </td>';
      echo '  </tr>';
    }

    echo '</table>';
  } else {
    // No meetings found
    echo '<p>No meetings found.</p>';
  }

  // Close the database connection
  mysqli_close($conn);
?>

<!-- Button to add a meeting -->
<a href="add.php">Add Meeting</a>
<a href="attendance.php">Add Attendance</a>

<p style="text-align: center; margin-top: 40px;"><a href="logout.php" style="color:black ; text-decoration: none;">Logout</a></p>

</body>
</html>
