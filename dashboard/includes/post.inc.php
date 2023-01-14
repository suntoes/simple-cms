<?php

if(isset($_POST["submit-delete"])) {

  session_start();
  
  $post_id = $_GET["id"];
  $user_id = $_SESSION["user_id"];

  require_once "../../includes/dbh.inc.php";
  require_once "functions.inc.php";

  deletePost($conn, $post_id, $user_id);
} else {
  
  session_start();

  $user_id = $_SESSION["user_id"];

  require_once "../../includes/dbh.inc.php";
  require_once "functions.inc.php";
;
  getPost($conn, $user_id);
}
