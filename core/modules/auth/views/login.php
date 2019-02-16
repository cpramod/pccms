<!-- Begin Left Content -->
                <div class="col-xl-8 col-lg-6 col-md-5 no-padding">
                    <div class="elisyam-bg background-01">
                        <div class="elisyam-overlay overlay-01"></div>
                        <div class="authentication-col-content mx-auto">
                            <h1 class="gradient-text-01">
                                Welcome To Elisyam!
                            </h1>
                            <span class="description">
                                Etiam consequat urna at magna bibendum, in tempor arcu fermentum vitae mi massa egestas. 
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Left Content -->
                <!-- Begin Right Content -->
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto no-padding">
                    <!-- Begin Form -->
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="db-default.html">
                                <img src="assets/img/logo.png" alt="logo">
                            </a>
                        </div>
                        <h3>Sign In To Elisyam</h3>
                        <form>
                            <div class="group material-input">
							    <input type="text" required>
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
                        </form>
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
                            <a href="db-default.html" class="btn btn-lg btn-gradient-01">
                                Sign in
                            </a>
                        </div>
                        <div class="register">
                            Don't have an account? 
                            <br>
                            <a href="pages-register.html">Create an account</a>
                        </div>
                    </div>
                    <!-- End Form -->                        
                </div>
                <!-- End Right Content -->

                


<div class="container">
    <div class="row">
        <div class="col">
            <hr class="tall mb-4">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="featured-boxes">
                <div class="row">
                    <div class="col-md-6 offset-md-4">
                        <div class="featured-box featured-box-primary text-left mt-5">
                            <div class="box-content">
                                <h4 class="heading-primary text-uppercase mb-3">I'm a Returning Customer</h4>

                                <div id="infoMessage" style="text-align:center;"><?php echo $message; ?></div>

                                <!--begin::Form-->
                                <?php echo form_open("auth/login/?referrer=admin/dashboard", array('id' => 'sign_in', 'class' => 'm-login__form m-form')); ?>

                                <div class="form-group m-form__group">
                                    <?php echo form_input($identity); ?>

                                </div>
                                <div class="form-group m-form__group">
                                    <?php echo form_input($password); ?>
                                </div>
                                <?php echo form_close(); ?>

                                <!--end::Form-->

                                <!--begin::Action-->
                                <div class="m-login__action">
                                    <a href="#" class="m-link">
                                        <span>Forgot Password ?</span>
                                    </a>
                                    <a href="#">
                                        <button id="m_login_signin_submit" type="submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
                                    </a>
                                </div>

                                <hr>

                                <!--begin::Divider-->
                                <div class="m-login__form-divider">
                                    <div class="m-divider">
                                        <span></span>
                                        <span>OR</span>
                                        <span></span>
                                    </div>
                                </div>

                                <!--end::Divider-->
                                <br>

                                <!--begin::Options-->
                                <div class="m-login__options">
                                    <a href="<?php echo site_url('sociallogin/facebookLogin'); ?>" class="btn btn-primary m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
									<span>
										<i class="fab fa-facebook-f"></i>
										<span>Facebook</span>
									</span>
                                    </a>
                                    <a href="#" class="btn btn-info m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
									<span>
										<i class="fab fa-twitter"></i>
										<span>Twitter</span>
									</span>
                                    </a>
                                    <a href="<?php echo site_url('sociallogin/googleLogin'); ?>" class="btn btn-danger m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
									<span>
										<i class="fab fa-google"></i>
										<span>Google</span>
									</span>
                                    </a>
                                </div>

                                <!--end::Options-->


                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>