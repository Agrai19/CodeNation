
<?php
//This is for detail.php
  require_once 'config.php';
  require_once 'functions3.php';

  function get_meeting_details($id) {
    global $conn;
    $meeting = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM meetings WHERE id=$id"));
    return $meeting;
  }

  function update_meeting($id, $introduction, $content, $conclusion) {
    global $conn;
    $sql = "UPDATE meetings SET introduction='$introduction', content='$content', conclusion='$conclusion' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
  }
?>
