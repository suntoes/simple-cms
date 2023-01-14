<?php
  include_once "header.php";
?>
<?php
  if(isset($_SESSION["user_id"])) {
    header("location: ./");
  }
?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1 mb-3">
            <h3 class="mb-3">Login</h3>
                <div class="bg-white shadow rounded">
                    <div class="row">
                        <div class="col-md-7 pe-0">
                            <div class="form-left h-100 py-5 px-5">
                                <form action="includes/login.inc.php" method="post" class="row g-4">
                                    <div class="col-12">
                                        <label>Username<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" name="name" class="form-control" placeholder="Enter Username">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" name="pwd" class="form-control" placeholder="Enter Password">
                                            </div>
                                        </div>

                                    <div>
                                        <small id="form-feedback" class="text-danger">
                                            <script type="module">
                                                import {getUrlVars} from './js/functions.js'
                                                $("#form-feedback").text(getUrlVars()?.error)
                                            </script>
                                        </small>
                                       <a href="signup.php" class="float-end text-primary">Create an account?</a>
                                    </div>
                            

                                    <div class="col-12">
                                        <button type="submit" name="submit" class="btn btn-primary px-4 float-end mt-4">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 ps-0 d-none d-md-block">
                            <div class="form-right h-100 bg-primary text-white text-center pt-5">
                            <h2 id="greetings" class="fs-1">
                                <script>
                                    let greetings
                                    const hourNow = new Date().getHours()
                                    switch(true) {
                                        case hourNow > 18:
                                            greetings = "Good Evening!"; break;
                                        case hourNow > 12:
                                            greetings = "Good Afternoon!"; break                                    ;
                                        default:
                                            greetings = "Good Morning!"; break;
                                    }
                                    $('#greetings').text(greetings)
                                </script>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
  include_once "footer.php";
?>
