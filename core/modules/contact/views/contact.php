<div class="contact-wrapper col-md-offset-1 col-md-11">

    <div class="row">
        <div class="col-lg-8 message">
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger mt-4" id="contactError">
                    <strong>Error!</strong> There was an error sending your message.
                    <span class="text-1 mt-2 d-block" id="mailErrorMessage"></span>
                </div>
            <?php endif;?>

            <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success mt-4" id="contactSuccess">
                <strong>Success!</strong> Your message has been sent to us.
            </div>
            <?php endif; ?>



            <h2 class="mb-3 mt-2">Send Messages</h2>

            <form id="contactForm" action="<?php echo current_url(); ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label>Your name *</label>
                        <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Your email address *</label>
                        <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <label>Subject</label>
                        <input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <label>Message *</label>
                        <textarea maxlength="5000" placeholder="Please enter your message." rows="5" class="form-control" name="message"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <input type="submit" value="Send Message" class="btn btn-primary btn-lg" data-loading-text="Loading...">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 info">

            <h4 class="heading-primary mt-4">Contact Information</h4>
            <ul class="list list-icons list-icons-style-3 mt-4">
                <li><i class="sl sl-icon-location"></i> Pradhan Path, Devinagar, Butwal, Rupandehi, Nepal</li>
                <li><i class="sl sl-icon-call-out"></i>  (+977) 9811483788 </li>
                <li><i class="sl sl-icon-envelope-open"></i> <a href="mailto:info@butwaljobs.com">info@butwaljobs.com</a></li>
            </ul>
            <ul class="social-media">
                <li><a href="https://www.facebook.com/butwalsansar" target="_blank" class="facebook"><i class="icon-facebook"></i></a></li>
                <li><a href="https://twitter.com/butwaljob" class="twitter" target="_blank"><i class="icon-twitter"></i></a></li>
                

            </ul>

        </div>

    </div>

</div>