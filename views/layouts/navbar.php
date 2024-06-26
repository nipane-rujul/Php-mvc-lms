<?php
use src\core\Application;
$username = Application::$app->getName();
?>

<header class="p-2 bg-dark border-bottom">
<div class="container">
  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0  text-decoration-none  navbar-brand text-light">
      LMS
    </a>

    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 text-light">
      <li><a href="/" class="nav-link px-2 link-light">Home</a></li>
      <li><a href="/about" class="nav-link px-2 link-light">About</a></li>
     
    </ul>

    <div class="dropdown text-end">
      <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo $username ?>
      </a>
      <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
        
      
        <li><a class="dropdown-item" href="CreateCourse">Create New Course</a></li>
       
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="/logout">Logout</a></li>
      </ul>
    </div>
  </div>
</div>
</header>