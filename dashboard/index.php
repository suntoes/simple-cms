<?php
  include_once "../header.php";
?>

<div class="container">
<h1 class="display-4 fst-italic">
  Hi,
  <?php
    if(isset($_SESSION["user_name"])) {
      echo $_SESSION["user_name"];
    } else {
      header("location: ../");
    }
  ?>
</h1>
<div class="d-flex w-100 align-items-center justify-content-between">
<p class="lead mb-4">Here are your posts:</p>
</div>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-published-tab" data-bs-toggle="tab" data-bs-target="#nav-published" type="button" role="tab" aria-controls="nav-published" aria-selected="true">Published</button>
    <button class="nav-link" id="nav-draft-tab" data-bs-toggle="tab" data-bs-target="#nav-draft" type="button" role="tab" aria-controls="nav-draft" aria-selected="false">Draft</button>
    <a href="/page/edit.php?id=new" class="ms-auto">
    <button type="button" class="btn btn-success rounded-pill my-1 me-2 me-md-3">Create</button>
    </a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-published" role="tabpanel" aria-labelledby="nav-published-tab"> 
<table class="table align-middle mb-0 bg-white">
  <tbody id="published-post-list">
  </tbody>
</table>



  </div>
  <div class="tab-pane fade" id="nav-draft" role="tabpanel" aria-labelledby="nav-draft-tab">

    <table class="table align-middle mb-0 bg-white">
      <tbody id="draft-post-list">
      </body>
    </table>
  </div>


</div>
</div>

<script src="js/dashboard.js"></script>

<?php
  include_once "../footer.php";
?>
