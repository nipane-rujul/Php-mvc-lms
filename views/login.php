<div class="container d-flex flex-column justify-content-center align-items-center" >
        <h2 class="text-center text-dark my-4">Welcome to Learning Management System</h2>
        <div class="card bg-light h-75 w-75 ">
            <article class="card-body mx-auto d-flex flex-column w-50 justify-content-center">
                <h4 class="card-title mt-3 text-center">Log in to Account</h4>

                <form id="loginform" class="" action="" method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="username" id="username" class="form-control" placeholder="Enter Username" type="text" required value="<?php echo $data['username']; ?>">
                        <div id="usernameError" class="invalid-feedback"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="password" id="password" class="form-control" placeholder="Enter password" type="password" required>
                        <div id="passwordError" class="invalid-feedback"></div>
                    </div>
                    <div style="color: red;"><?php echo $message?></div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <p class="text-center">Don't have an account?<a href="register">Register</a> </p>
                </form>
            </article>
        </div>
    </div>
    
<script src="/scripts/login.js">
</script>

