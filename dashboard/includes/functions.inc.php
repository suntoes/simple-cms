<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function deletePost($conn, $id, $user_id) {
  $sql = "DELETE FROM posts WHERE id = ? AND user_id = ?;";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../?error=SQL+failed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $id, $user_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../../dashboard");
  exit();
}

function getPost($conn, $user_id) {
  $sql = "SELECT * FROM posts WHERE user_id = ? ORDER BY date_created DESC;";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../?error=SQL+failed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);

  $sqlData = mysqli_stmt_get_result($stmt);
  $result = array();
  while($row = mysqli_fetch_assoc($sqlData)) {
    $result[] = $row;
  }

  echo json_encode($result);

  mysqli_stmt_close($stmt);
  //header("location: ../edit.php?id=" . $id);
  exit();

  return $result;
}
