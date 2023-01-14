<?php

if(isset($_POST["submit-publish"]) || isset($_POST["submit-draft"])) {
  
  session_start();

  $user_id = $_SESSION["user_id"];
  $title = $_POST["title"];
  $description = $_POST["description"];
  $author = $_POST["author"];
  $content = $_POST["content"];
  $image_log = $_POST["image-log"];
  $id = $_GET["id"];
  $published;

  require_once "../../includes/dbh.inc.php";
  require_once "functions.inc.php";

  if(isset($_POST["submit-publish"])) {
    $published = 1;
  } else $published = 0;

  if($id !== "new") {
    updatePost($conn, $id, $title, $description, $author, $content, $published, $image_log);
  } else {
    createPost($conn, $title, $description, $author, $content, $user_id, $published, $image_log);
  }

} else if (isset($_GET["id"])) {

  $id = $_GET["id"];
  require_once "../../includes/dbh.inc.php";
  require_once "functions.inc.php";

  $post = getPost($conn, $id);

  session_start();
  
  if($post["published"]) {
    echo json_encode($post);
  } else if(isset($_SESSION["user_id"]) && !$post["published"]) {
    if($_SESSION["user_id"] === $post["user_id"]) {
      echo json_encode($post);
    }
  } else {
    header("location: ../");
  }
}
