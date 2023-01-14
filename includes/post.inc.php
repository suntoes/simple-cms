<?php

if(isset($_POST["page_num"])) {

  $page_num = $_POST["page_num"];
  $keyword;

  if(isset($_POST["keyword"])) {
    $keyword = trim($_POST["keyword"]);
  } else {
    $keyword = "";
  }

  require_once "dbh.inc.php";
  require_once "functions.inc.php";

  getPost($conn, $page_num, $keyword);
}
