<?php
  include_once "../header.php";
?>

<?php
  if(!isset($_GET["id"])) {
    header("location: ../");
  }
?>

<div class="container">
  <div id="post-container" class="pb-5">
    <h2 id="post-title">Loading...</h2>
  </div>
</div>

<script type="module" src="js/main.js"></script>

<?php
  include_once "../footer.php";
?>
