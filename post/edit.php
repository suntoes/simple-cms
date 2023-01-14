<?php
  include_once "../header.php";
?>
<?php
  if(!isset($_SESSION["user_name"]) || !isset($_GET["id"])) {
    header("location: ../");
  }
?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1 mb-3">
            <h3 id="form-header" class="mb-3">New Post</h3>
                <div class="bg-white shadow rounded">
                    <div class="row">
                        <div>
                            <div class="form-left h-100 py-5 px-5">
<form action="includes/post.inc.php?id=<?php if(isset($_GET["id"])) {echo $_GET["id"];} else echo "new";?>" method="post" class="row g-4">
                                    <div class="col-12">
                                        <label>Title<span class="text-danger">*</span></label>
                                        <input id="form-title" type="text" name="title" class="form-control" placeholder="Enter Title">
                                    </div>

                                    <div class="col-12">
                                        <label>Description<span class="text-danger">*</span></label>
                                        <textarea id="form-description" type="text" name="description" class="form-control" placeholder="Enter Description"></textarea>
                                    </div>

                                    <div class="col-12">
                                        <label>Author<span class="text-danger">*</span></label>
                                        <input id="form-author" type="text" name="author" class="form-control" placeholder="Enter Author">
                                    </div>

                                    <div class="col-12">
                                        <label>Content<span class="text-danger">*</span></label>
                                        <textarea id="form-content" name="content" class="form-control" placeholder="Enter Content"></textarea>
                                    </div>

                                    <div>
                                        <small id="form-feedback" class="text-danger">
                                            <script type="module">
                                                import {getUrlVars} from '../js/functions.js'
                                                $("#form-feedback").text(getUrlVars()?.error)
                                            </script>
                                        </small>
                                    </div>
                            
                                    <input id="form-image-log" name="image-log" type="hidden">

                                    <div class="col-12">
                                        <button id="form-submit-publish" type="button" name="submit-publish" class="btn btn-primary px-4 float-end mt-4">Publish</button>
                                        <button id="form-submit-draft" type="button" name="submit-draft" class="btn btn-ghost px-4 float-end mt-4">Save as draft</button>
                                    </div>

                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js" integrity="sha512-eV68QXP3t5Jbsf18jfqT8xclEJSGvSK5uClUuqayUbF5IRK8e2/VSXIFHzEoBnNcvLBkHngnnd3CY7AFpUhF7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                    <script type="module" src="js/tinymce.js"></script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php
  include_once "../footer.php";
?>
