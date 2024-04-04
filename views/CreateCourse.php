<div class="container mt-3" style="min-height:83vh">
    <div class="row justify-content-center">
        <div class="col-md-6 pb-2 rounded-lg my-4 py-4 border shadow-sm">
            <h2 class="mb-4 text-center">
                <?php if ($data) : ?>
                    Edit Course
                <?php else : ?>
                    Create Course
                <?php endif; ?>
            </h2>
            <!-- <p class="text-center">Fill the Course Title, description about the course and select one thumbnail image to display on the course card</p> -->
            <form id="courseform" action="CreateCourse" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="courseTitle" class="text-bold">Course Title:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                        </div>
                        <input type="text" name="courseTitle" class="form-control" id="courseTitle" name="courseTitle" required value=<?php echo $data['title'] ?>>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="courseDescription">Course Description:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        </div>
                        <textarea class="form-control" name="courseDes" id="courseDescription" name="courseDescription" rows="5" required><?php echo $data["details"] ?></textarea>

                    </div>
                </div>

                <hr class="mb-4">
                <?php if ($data) : ?>
                    <button id="edit" class="btn btn-primary btn-lg btn-block" type="submit">
                        Edit Course
                    </button>
                <?php else : ?>
                    <button id="create" class="btn btn-primary btn-lg btn-block" type="submit">
                        Create Course
                    </button>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<script src="scripts/createcourse.js"></script>