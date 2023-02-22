
<!DOCTYPE html>
<html>
<head>
  <title>Homepage</title>
  <link rel="stylesheet" href="css/detail.css">
</head>
<body>

<?php
require_once 'config.php';
require_once 'functions3.php';
$id = $_GET['id'];

// Retrieve meeting data from meetings table
$query = "SELECT * FROM meetings WHERE id=$id";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  $meeting = $result->fetch_assoc();
} else {
  die("Meeting not found");
}

// Retrieve attendance data from attendance table
$query = "SELECT person_name FROM attendance WHERE meeting_id=$id";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  $attendees = [];
  while ($row = $result->fetch_assoc()) {
    $attendees[] = $row['person_name'];
  }
} else {
  $attendees = ['No attendees'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $meeting_introduction = isset($_POST['introduction']) ? $_POST['introduction'] : '';
  $meeting_content = isset($_POST['content']) ? $_POST['content'] : '';
  $meeting_conclusion = isset($_POST['conclusion']) ? $_POST['conclusion'] : '';

  $data = [
    'meeting_introduction' => $meeting_introduction,
    'meeting_content' => $meeting_content,
    'meeting_conclusion' => $meeting_conclusion,
  ];

  $url = "http://localhost/GP/update.php?id=$id";
  $options = [
    'http' => [
      'method' => 'POST',
      'header' => 'Content-type: application/x-www-form-urlencoded',
      'content' => http_build_query($data),
    ],
  ];
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  if ($result) {
    echo "Meeting minutes updated successfully";
    $meeting = json_decode($result, true);
  } else {
    echo "Error updating meeting minutes";
  }
}
?>

<h2><?php echo isset($meeting['meeting_name']) ? $meeting['meeting_name'] : ''; ?></h2>
<p>Meeting ID: <?php echo isset($meeting['id']) ? $meeting['id'] : ''; ?></p>

<h3>Attendees</h3>
<ul>
  <?php foreach ($attendees as $attendee): ?>
    <li><?php echo $attendee; ?></li>
  <?php endforeach; ?>
</ul>

<form method="post">
  <h3>Introduction</h3>
  <textarea name="introduction" rows="5" cols="50"><?php echo isset($meeting['meeting_introduction']) ? $meeting['meeting_introduction'] : ''; ?></textarea><br>

  <h3>Content</h3>
  <textarea name="content" rows="10" cols="50"><?php echo isset($meeting['meeting_content']) ? $meeting['meeting_content'] : ''; ?></textarea><br>

  <h3>Conclusion</h3>
  <textarea name="conclusion" rows="5" cols="50"><?php echo isset($meeting['meeting_conclusion']) ? $meeting['meeting_conclusion'] : ''; ?></textarea><br>

  <input type="submit" value="Save">
</form>

<a href="homepage.php">Back to meetings</a>
</body>
</html>