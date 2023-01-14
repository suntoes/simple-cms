<?php

function getPost($conn, $id) {
  $sql = "SELECT * FROM posts WHERE id = ?;";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../?error=SQL+failed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);
  $result = mysqli_fetch_assoc($resultData);

  mysqli_stmt_close($stmt);

  return $result;
}

function createPost($conn, $title, $description, $author, $content, $user_id, $published, $image_log) {
  $sql = "INSERT INTO posts (title, description, author, content, user_id, published) VALUES ( ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../?error=SQL+failed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssii", $title, $description, $author, $content, $user_id, $published);
  mysqli_stmt_execute($stmt);

  $last_inserted_id = mysqli_insert_id($conn);
  $img_arr = explode("+", $image_log); 
  foreach($img_arr as $key) {
    insertPostImage($conn, $last_inserted_id, $key);
  };

  mysqli_stmt_close($stmt);


  header("location: ../../dashboard");
  exit();
}

function updatePost($conn, $id, $title, $description, $author, $content, $published, $image_log) {
  $sql = "UPDATE posts set title = ?, description = ?, author = ?, content = ?, published = ? WHERE id = ?";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../?error=SQL+failed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssii", $title, $description, $author, $content, $published, $id);
  mysqli_stmt_execute($stmt);

  $img_arr = explode("+", $image_log); 
  foreach($img_arr as $key) {
    insertPostImage($conn, $id, $key);
  };

  mysqli_stmt_close($stmt);

  header("location: ../../dashboard");
  exit();
}

function insertPostImage($conn, $post_id, $location) {
  if($location) {
    $sql = "INSERT INTO posts_image (post_id, location) values (?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
    }

    mysqli_stmt_bind_param($stmt, "is", $post_id, trim($location));
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }
}

function deletePostImage($conn, $post_id) {
  $sql = "DELETE FROM posts_image WHERE post_id = ?";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
  }

  mysqli_stmt_bind_param($stmt, "i", $post_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}
