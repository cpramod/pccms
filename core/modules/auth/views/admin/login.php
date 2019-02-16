
    <!-- Begin Form -->
    <div class="authentication-form-2 mx-auto">
        <div class="tab-content" id="animate-tab-content">
            <!-- Begin Sign In -->
            <div role="tabpanel" class="tab-pane show active" id="singin" aria-labelledby="singin-tab">
                <h3>Sign In To ButwalJobs</h3>
                <?php echo form_open("admin/auth/login/", array('id' => 'sign_in', 'class' => 'm-login__form m-form')); ?>
                    <div class="group material-input">
                        <?php echo form_input($identity); ?>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Email</label>
                    </div>
                    <div class="group material-input">
                        <?php echo form_input($password); ?>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Password</label>
                    </div>
                
                <div class="row">
                    <div class="col text-left">
                        <div class="styled-checkbox">
                            <input type="checkbox" name="checkbox" id="remeber">
                            <label for="remeber">Remember me</label>
                        </div>
                    </div>
                    <div class="col text-right">
                        <a href="pages-forgot-password.html">Forgot Password ?</a>
                    </div>
                </div>
                <div class="sign-btn text-center">
                    <button type="submit" class="btn btn-lg btn-gradient-01">
                        Sign In
                    </button>
                </div>
                </form>
            </div>
            <!-- End Sign In -->
            <!-- Begin Sign Up -->
            <div role="tabpanel" class="tab-pane" id="signup" aria-labelledby="signup-tab">
                <h3>Create An Account</h3>
                <?php echo form_open("auth/login/?referrer=admin/dashboard", array('id' => 'sign_in', 'class' => 'm-login__form m-form')); ?>
                    <div class="group material-input">
                        <?php echo form_input($identity); ?>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Email</label>
                    </div>
                    <div class="group material-input">
                        <input type="password" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Password</label>
                    </div>
                    <div class="group material-input">
                        <input type="password" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Confirm Password</label>
                    </div>
                <?php echo form_close(); ?>
                <div class="row">
                    <div class="col text-left">
                        <div class="styled-checkbox">
                            <input type="checkbox" name="checkbox" id="agree">
                            <label for="agree">I Accept <a href="#">Terms and Conditions</a></label>
                        </div>
                    </div>
                </div>
                <div class="sign-btn text-center">
                    <a href="db-default.html" class="btn btn-lg btn-gradient-01">
                        Sign Up
                    </a>
                </div>
            </div>
            <!-- End Sign Up -->
        </div>
    </div>
    <!-- End Form -->                        


