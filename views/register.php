<?php

?>

<div class="container mt-4" style="min-height:90vh">
    <div class="py-3 text-center">
        <!-- <img class="d-block mx-auto mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
        <h2>Welcome to Learning Management System</h2>
        <h4 class="mt-3 text-primary">Registration</h4>
        <!-- <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> -->
    </div>

    <div class="row justify-content-center">
        <div class="col-md-7 border shadow-sm">
            <h4 class="my-2 text-center">Enter User Details</h4>
            <form id="registrationForm" action="/register" method="post" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label for="username">Username<span class="text-muted">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input name="username" id="name" type="text" class="form-control" placeholder="Enter Username" required value=<?php echo $data['username']; ?>>
                        <div id="nameError" class="invalid-feedback">
                            
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email<span class="text-muted">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input name="email" id="email" type="text" class="form-control" placeholder="Enter Email" required value=<?php echo $data['email']; ?>>
                        <div id="emailError" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password">Password <span class="text-muted">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input name="password" id="password" type="password" class="form-control" placeholder="Enter Password" required>
                        <div id="passwordError" class="invalid-feedback">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="cpassword">Confirm Password <span class="text-muted">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input name="cpassword" id="cpassword" type="password" class="form-control" placeholder="Repeat Password" required>
                        <div id="cpasswordError" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <?php echo $message?>
                <hr class="mb-2">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                <p class="text-center">Have an account? <a href="login">Login</a> </p>

            </form>
        </div>
    </div>
</div>

<script src="/scripts/register.js"></script>