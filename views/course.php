<?php 
use src\core\Application;

?>

<div class="container-fluid mt-2" style="min-height:84vh">
    <div class="alert alert-success alert-dismissible fade show m-2" role="alert" id="myAlert" style="display: none; position: fixed; top: 50px; left: 500px;">
        <span id="alertMessage"></span>
        <button type="button" class="btn-close" aria-label="Close" onclick="closeAlert()"></button>
    </div>
    <div class="d-flex align-items-center justify-content-between ">
        <nav aria-label="breadcrumb" style="background-color: white;">
            <ol class="breadcrumb" style="background-color: white;">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a id="course" href="#">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page" id="sec"></li>
            </ol>
        </nav>
        <?php if (Application::$app->isAdmin()) : ?>
            <div class="" role="group" aria-label="Basic example">
                <button class="btn btn-outline-danger me-2 cursor-pointer" id="delete-course-btn">
                    <i class="fas fa-trash"></i> Delete Course
                </button>
                <button class="btn btn-outline-secondary cursor-pointer" id="edit-course-btn">
                    <i class="fas fa-edit"></i> Edit Course
                </button>
            </div>
            <?php endif;?>
    </div>
    <div class="d-grid gap-1" style="grid-template-columns: 1fr 3fr;">
        <div class="border shadow-sm rounded-3">
            <div class="flex-shrink-0 p-3">
                <a href="" class="d-flex align-items-center mb-2 link-body-emphasis text-decoration-none pb-2" style="border-bottom: 4px solid gray;">
                    <span class="fs-5 fw-semibold">Course Contents</span>
                </a>
                <ul class="list-unstyled ps-0" id="sectionContainer">

                </ul>
                <?php if (Application::$app->isAdmin()) : ?>
                    <button class="btn btn-outline-primary rounded mt-3 mb-2 float-end" data-bs-toggle="modal" data-bs-target="#addSectionModal">Add New Section</button>
            <?php endif;?>
            </div>
        </div>
        <div class="rounded-3 border shadow-sm">
           
            <div class="px-4 py-2 d-flex flex-row align-items-center">
                <h6 class="mt-2 font-weight-bold text-primary" id="video-title"></h6>

            </div>
            <div class="row justify-content-center">

                <div class="col-xl-12 col-lg-7">
                    <div class="">
                        <div class="p-2 d-flex justify-content-center">
                            <video controls autoplay id="video-item" class="video-item border rounded" style="width: 80%;">

                            </video>
                        </div>
                    </div>
                </div>

                <div class="col-xl-11 col-lg-7 d-flex justify-content-between p-2 m-2" role="group" aria-label="Basic example">
                    <button type="button" id="prev-video-btn" class="btn btn-outline-primary">Prev</button>
                    <button type="button" id="next-video-btn" class="btn btn-outline-primary">next</button>
                </div>
            </div>
        </div>
    </div>
</div>



    <li class="mb-3 visually-hidden" id="admin-section" data-section-id="" style="border-bottom: 2px solid grey;">
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="" aria-expanded="true">
            </button>
            <?php if (Application::$app->isAdmin()) : ?>
            <button class="btn btn-outline-danger btn-sm rounded delete-section-btn" data-section-id="">
                Delete
            </button>
            <?php endif; ?>
        </div>
        <div class="collapse show px-5" id="">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small video-list">

            </ul>
            <?php if (Application::$app->isAdmin()) : ?>
            <button class="btn-outline-primary btn-sm add-video-btn mb-2">Add Video</button>
            <?php endif; ?>
        </div>
    </li>

    <div class="video-item mb-2 d-flex align-items-center justify-content-between visually-hidden mt-2" id="admin-video">
        <div>
            <a href="#" data-video-url="" class="video-link" data-section-id="" data-video-id="" data-video-title="">

            </a>
        </div>
        <div>
            <?php if (Application::$app->isAdmin()) : ?>
            <a class="link cursor-pointer delete-btn float-end btn-sm" id="delete-video" data-section-id="" data-video-id="">
                <i class="fas fa-trash"></i>
            </a>
            <?php endif; ?>
        </div>
    </div>

    <?php include "layouts/_addVideoModal.php" ?>
    <?php include "layouts/_addSectionModal.php" ?>

    <script src="scripts/course.js"></script>
