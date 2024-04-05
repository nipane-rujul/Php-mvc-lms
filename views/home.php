<?php

use src\core\Application;
?>



<main class="my-5">
  <div class="container">
    <!--Section: Content-->
    <section>
      <!-- Jumbotron -->
      <div id="intro" class="p-5 text-center bg-light shadow-5 rounded mb-5">
        <h1 class="mb-3 h2">Welcome to the Learning Platform</h1>
        <p class="mb-3">Best & free guide of responsive web design</p>
        <?php if (Application::$app->isAdmin()) : ?>
        <a class="btn btn-primary m-2" href="/CreateCourse" role="button" rel="nofollow" data-mdb-ripple-init target="_blank">Create Course</a>
        <?php endif;?>
      </div>
      <!-- Jumbotron -->
    </section>
    <!--Section: Content-->

    <!--Section: Content-->
    <section class="text-center">
      <h4 class="mb-5"><strong>Courses</strong></h4>

      <div class="row">

      </div>
    </section>
    <!--Section: Content-->

    <!-- Pagination -->
    <!-- <nav class="my-4" aria-label="...">
                <ul class="pagination pagination-circle justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav> -->
  </div>
</main>
<!--Main layout-->
<div class="col-lg-4 col-md-6 mb-4 visually-hidden" data-course-id="" id="admin-card">
  <div class=" card">
    <div class="card-body">
      <h5 class="card-title"></h5>
      <p class="card-text">

      </p>
      <div class="flex justify-content-between">
        <a href="Courseadmin.php?id="><button type="button" class="btn btn-sm btn-outline-success"><i class="fas fa-book"></i> View Course</button></a>
        <?php if (Application::$app->isAdmin()) : ?>
        <button type="button" class="btn btn-sm btn-outline-primary btn-edit"><i class="fas fa-edit"></i> Edit</button>
        <button type="button" class="btn btn-sm btn-outline-danger btn-delete"><i class="fas fa-trash text-danger"></i> Delete</button>
          <?php endif;?>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


<script src="scripts/courses.js"></script>