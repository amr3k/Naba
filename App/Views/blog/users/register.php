<!-- Register Page -->
<div id="register-page" class="page box">
    <!-- Centered Content -->
    <div class="centered-content">
        <h1 class="heading">Create New Account</h1>
        <!-- Form -->
        <form action="<?php echo url('/register/submit'); ?>" class="form">
            <div id="form-results"></div>
            <div class="form-group">
                <label for="first_name" class="col-sm-3 col-xs-12">Name</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="text" name="name" id="first_name" placeholder="First Name" class="input placeholder" />
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-3 col-xs-12">Email</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="email" name="email" id="email" placeholder="Email Address" class="input placeholder" />
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 col-xs-12">Password</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="password" name="pass" id="password" placeholder="Password" class="input" />
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_password" class="col-sm-3 col-xs-12">Confirm Password</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="password" name="re-pass" id="confirm_password" placeholder="Confirm Password" class="input" />
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-3 col-xs-12">Profile Photo</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="file" name="img" id="image" class="input" />
                </div>
            </div>

            <div class="form-group">
                <div class=" col-sm-offset-3 col-sm-9">
                    <button class="button bold submit-btn">Sign Up</button>
                </div>
            </div>
        </form>
        <!--/ Form -->
    </div>
    <!--/ Centered Content -->
</div>
<!--/ Register Page -->