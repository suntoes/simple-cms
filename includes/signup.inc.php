<?php
if (isset($_POST["submit"])) {
  echo "It works!";

  $name = $_POST["name"];
  $email = $_POST["email"];
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';
  
  if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=Empty+Input");
    exit();
  }

  if (invalidUid($username) !== false) {
    header("location: ../signup.php?error=Invalid+username");
    exit();
  }

  if (invalidEmail($email) !== false) {
    header("location: ../signup.php?error=Invalid+email");
    exit();
  }

  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=Pwd+dont+match");
    exit();
  }

  if (uidExists($conn, $username, $email) !== false) {
   header("location: ../signup.php?error=Uid+taken");
    exit();
  }

  createUser($conn, $name, $email, $username, $pwd);

} else {
  header("location: ../signup.php");
  exit();
}
