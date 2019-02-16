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
                                <h4 class="heading-primary text-uppercase mb-3">User Registration</h4>

                                <?php if($message){ echo $message; } ?>

                                <?php echo form_open("auth/register", array('id' => 'sign_in','class'=>'m-login__form m-form')); ?>
                                <div class="form-group m-form__group">
                                    <label for="first_name">First Name</label>
                                    <?php echo form_input($first_name);?>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="last_name">Last Name</label>
                                    <?php echo form_input($last_name);?>
                                </div>
                                
                                <div class="form-group m-form__group">
                                    <label for="email">Email</label>
                                    <?php echo form_input($email);?>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="password">Password</label>
                                    <?php echo form_input($password);?>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <?php echo form_input($password_confirm);?>
                                </div>

                                <div class="m-login__action">
                                    <button type="submit" id="m_login_signup_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign Up</button>
                                </div>
                                <?php echo form_close(); ?>


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

