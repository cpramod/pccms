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
                                <?php echo form_open("auth/login/?referrer=".$referrer, array('id' => 'sign_in','class'=>'m-login__form m-form')); ?>

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