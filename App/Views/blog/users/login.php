<!-- Login Page -->
<div id="login-page" class="page box">
    <!-- Centered Content -->
    <div class="centered-content">
        <h1 class="heading">Log in to your account</h1>
        <!-- Form -->
        <form action="<?php echo url('login/submit'); ?>" class="form">
            <div class="form-group">
                <label for="email" class="col-xs-1">Email</label>
                <div class="col-sm-12 col-xs-12">
                    <input type="email" name="email" id="email" placeholder="Email Address" class="input placeholder form-control" />
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-xs-1">Password</label>
                <div class="col-sm-12 col-xs-12">
                    <input type="password" name="password" id="password" placeholder="Password" class="input form-control" />
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="form-results"></div>
            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12 col-xs-12">
                    <button class="button bold submit-btn btn-block form-control">Login</button>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group text-center">
                Don't have account yet ? <a href="<?php echo url('/register'); ?>">Signup now</a>
            </div>
        </form>
        <!--/ Form -->
    </div>
    <!--/ Centered Content -->
</div>
<!--/ Login Page -->