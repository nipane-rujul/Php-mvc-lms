<div class="container mt-3" style="min-height:83vh">
    <div class="row justify-content-center">
        <div class="col-md-6 pb-2 rounded-lg my-4 py-4 border shadow-sm">
            <h2 class="mb-4 text-center">Create Course</h2>
            <!-- <p class="text-center">Fill the Course Title, description about the course and select one thumbnail image to display on the course card</p> -->
            <form action="CreateCourse" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="courseTitle" class="text-bold">Course Title:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                        </div>
                        <input type="text" name="courseTitle" class="form-control" id="courseTitle" name="courseTitle" required>
                        <!-- <div id="usernameError" class="invalid-feedback" style="width: 100%;">
                        </div> -->
                    </div>
                </div>

                <div class="mb-3">
                    <label for="courseDescription">Course Description:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <!-- <span class="input-group-text"><i class="fa fa-lock"></i></span> -->
                        </div>
                        <textarea class="form-control" name="courseDes" id="courseDescription" name="courseDescription" rows="5" required></textarea>
                        <!-- <div id="passwordError" class="invalid-feedback">
                        </div> -->
                    </div>
                </div>
                
              
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Create Course</button>
            </form>
        </div>
    </div>
</div>
