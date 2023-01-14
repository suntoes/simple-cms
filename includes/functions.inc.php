<?php
function getPost($conn, $page_num, $keyword) {
  $per_page = 10;
  if(isset($page_num)) {
    $page_num = $page_num;
  } else {
    $page_num = 1;
  }

  $page_start = ($page_num - 1) * $per_page;

  $query = $conn->query("SELECT * FROM posts WHERE published = 1 AND ( title LIKE '%$keyword%' OR description LIKE '%$keyword%' OR author LIKE '%$keyword%' ) ORDER BY date_created DESC LIMIT $page_start, $per_page");
  $result = array();
  while($data = $query->fetch_assoc()) {
    $data['thumbnail'] = getThumbPost($conn, $data['id']);
    $result[] = $data;
  };

  echo json_encode($result);
  exit();
}

function getThumbPost($conn, $post_id) {
  $thumb;

  $sql = "SELECT location FROM posts_image WHERE post_id = ? ORDER BY id ASC";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    $thumb = null;
  }

  mysqli_stmt_bind_param($stmt, "i", $post_id);
  mysqli_stmt_execute($stmt);

  $sqlData = mysqli_stmt_get_result($stmt);

  $thumb = mysqli_fetch_assoc($sqlData);

  mysqli_stmt_close($stmt);
  //header("location: ../edit.php?id=" . $id);
  if($thumb) {
    $thumb = $thumb["location"];
  }

  return $thumb;
}

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
  $result;
  if (
    empty($name) 
    || empty($email) 
    || empty($username)
    || empty($pwd)
    || empty($pwdRepeat)
  ) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function invalidUid($username) {
  $result;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function invalidEmail($email) {
  $result;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
  $result;
  if ($pwd !== $pwdRepeat) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function uidExists($conn, $username, $email) {
  $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=Sql+stmt+failed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  // ss is var count "string, string"
  mysqli_stmt_execute($stmt);
  
  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd) {
  $sql = "INSERT INTO users (name, email, username, password, privilege) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=Sql+stmt+failed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  $defaultPrivilege = "contributor";

  mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $username, $hashedPwd, $defaultPrivilege);
  // ss is var count "string, string"
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../login.php");
  exit();
}

function emptyInputLogin($username, $pwd) {
  $result;
  if (
    empty($username) 
    || empty($pwd) 
  ) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function loginUser($conn, $username, $pwd) {
  $uidExists = uidExists($conn, $username, $username);

  if ($uidExists === false) {
    header("location: ../login.php?error=Wrong+login+information");
    exit();
  }

  $pwdHashed = $uidExists["password"];
  $checkPwd = password_verify($pwd, $pwdHashed);
  
  if ($checkPwd === false) {
    header("location: ../login.php?error=Wrong+login+information");
    exit();
  } else if ($checkPwd === true) {
    session_start();
    $_SESSION["user_id"] = $uidExists["id"];
    $_SESSION["user_name"] = $uidExists["name"];
    $_SESSION["user_uid"] = $uidExists["username"];
    header("location: ../dashboard");
    exit();
  } 
}
