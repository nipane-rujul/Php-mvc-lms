<section class="jumbotron text-center mb-0 py-5">
    <div class="container">
      <h1 class="jumbotron-heading">Welcome to the Learning Platform</h1>
      <p class="lead text-muted">We have the most wide ranges of free courses. You can access the free videos.</p>
      <?php

use src\core\Application;

 if (Application::$app->isAdmin()) : ?>
        <p>
          <a href="/CreateCourse" class="btn btn-primary my-2">Create Course</a>
        </p>
    </div>
  <?php endif; ?>
  </section>

  <div class="album py-3">
    <h3 class="text-center mb-3 text-primary" id="course-head">Select a Course</h3>
    <div class="container">
      <div class="row align-items-center">
        <!-- Courses goes here -->
      </div>
    </div>
  </div>