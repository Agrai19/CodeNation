<?php
require_once 'config.php';
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $meeting_introduction = $_POST['meeting_introduction'];
  $meeting_content = $_POST['meeting_content'];
  $meeting_conclusion = $_POST['meeting_conclusion'];

  $sql = "UPDATE meetings SET meeting_introduction='$meeting_introduction', meeting_content='$meeting_content', meeting_conclusion='$meeting_conclusion' WHERE id=$id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: detail.php?id=$id");
    exit();
  } else {
    echo "Error updating meeting minutes: " . mysqli_error($conn);
  }
}
?>
