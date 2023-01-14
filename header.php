<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Simple CMS</title>
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900&amp;display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<style>
  /* stylelint-disable selector-list-comma-newline-after */
  
  .blog-header {
  border-bottom: 1px solid #e5e5e5;
  }
  
  .blog-header-logo {
  font-family: "Playfair Display", Georgia, "Times New Roman", serif/*rtl:Amiri, Georgia, "Times New Roman", serif*/;
  font-size: 2.25rem;
  text-decoration: underline;
  }
  
  .blog-header-logo:hover {
  text-decoration: none;
  }
  
  h1, h2, h3, h4, h5, h6 {
  font-family: "Playfair Display", Georgia, "Times New Roman", serif/*rtl:Amiri, Georgia, "Times New Roman", serif*/;
  }
  
  .display-4 {
  font-size: 2.5rem;
  }
  @media (min-width: 768px) {
  .display-4 {
  font-size: 3rem;
  }
  }
  
  .flex-auto {
  flex: 0 0 auto;
  }
  
  .h-250 { height: 250px; }
  @media (min-width: 768px) {
  .h-md-250 { height: 250px; }
  }
  
  /* Pagination */
  .blog-pagination {
  margin-bottom: 4rem;
  }
  
  /*
*     * Blog posts
*         */
  .blog-post {
  margin-bottom: 4rem;
  }
  .blog-post-title {
  font-size: 2.5rem;
  }
  .blog-post-meta {
  margin-bottom: 1.25rem;
  color: #727272;
  }
  
  /*
*     * Footer
*         */
  .blog-footer {
  padding: 2.5rem 0;
  color: #727272;
  text-align: center;
  background-color: #f9f9f9;
  border-top: .05rem solid #e5e5e5;
  }
  .blog-footer p:last-child {
  margin-bottom: 0;
  }
</style> 
</head>

<body>
<div id="wrapper" class="min-vh-100 d-flex flex-column justify-content-between" align-items-center>
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5 px-1">
  <div class="container-fluid">
    <a class="navbar-brand blog-header-logo text-dark" href="./">Simple CMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">Home</a>
        </li>
<?php
    if (isset($_SESSION["user_name"])) {
        echo "<li class='nav-item'><a class='nav-link' href='/dashboard'>Dashboard</a></li>";
        echo "<li class='nav-item'><a class='nav-link' href='/includes/logout.inc.php'>Logout</a></li>";
    } else {
        echo "<li class='nav-item'><a class='nav-link' href='/includes/login.inc.php'>Login</a></li>";
        echo "<li class='nav-item'><a class='nav-link' href='/includes/signup.inc.php'>Signup</a></li>";
    }
?>
      </ul>
      <form class="d-flex" role="search">
        <input id="search-keyword" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button id="search-submit" class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
<script>
$("#search-submit").on("click", (e) => {
  e.preventDefault();
  const keyword = $("#search-keyword").val()
  document.location.href = keyword ? `/?keyword=${keyword}` : "/";
})
</script>
</nav>
