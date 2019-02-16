<aside class="sidebar">
    <h4 class="heading-primary">
        Forum Search
    </h4>
    <form action="<?php echo site_url('forums/search'); ?>" method="get">
        <div class="form-group">
            <input type="text" name="q" class="form-control" value="">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary mb-4">Search</button>
        </div>
    </form>
<?php

if (!$this->session->userdata('user_id')) {
    /*
     * user not logged in
     */

    ?>


        <h4 class="heading-primary">
            Login
        </h4>
        <form class="m-login__form" action="<?php echo site_url('auth/login'); ?>?referrer=<?php echo $this->uri->uri_string(); ?>" id="contactForm" method="post">

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="identity" value="" class="form-control" required="required">
            </div>


            <div class="form-group">
                <label for="email">Password:</label>
                <input type="password" name="password" value="" class="form-control" required="required">
            </div>
            <div class="form-group">
                <?php echo form_checkbox('remember', '1', FALSE, 'id="rememberme" class=""'); ?> Remember me
            </div>


            <div class="form-group">

                <input type="submit" name="submit" value="Sign In" id="m_login_signin_submit" class="btn btn-primary mb-4">
                <div class="alert alert-success d-none" id="contactSuccess"></div>
                <div class="alert alert-danger d-none" id="contactError"></div>
            </div>
        </form>

        <a href="<?php echo site_url('profile/register'); ?>" class="btn ask_question">Register An Account</a>



    <?php


} else {
    /**
     * user logged in
     */

    ?>


        <?php if(isset($ask_question) && $ask_question==1): ?>
            <a href="javascript:" class="btn ask_question" data-toggle="modal" data-target="#ask_question">Ask a Question</a>
        <?php endif; ?>
        <h4 class="heading-primary">
            Profile
        </h4>
        <div class="sidebar_content">
            <div class="row">
                <div class="col profile_avatar">
                    <?php
                    if ($user_details['avatar']) {
                        ?>
                        <img src="<?php echo $user_details['avatar'] ?>" width="80" alt="">
                        <?php
                    } else {
                        ?>
                        <img src="<?php echo img('avatars/avatar.png'); ?>" alt="">
                        <?php
                    }


                    ?>
                </div>
                <div class="col profile_info">
                    <p>Hi, <?php echo $user_details['first_name']; ?>!</p>
                    <ul>
                        <li><a href="<?php echo site_url('profile'); ?>"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="<?php echo site_url('auth/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <ul class="profile_list">
                        <li><a href="#"> <i class="fa fa-certificate"></i> Earned Points ( <?php echo $points; ?> )</a></li>
<!--                        <li><a href="#"><i class="fa fa-certificate"></i>Reputation</a></li>-->
                    </ul>
                </div>
            </div>
        </div>


    <?php


}

?>

</aside>
