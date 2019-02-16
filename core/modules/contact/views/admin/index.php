<div class="row">
    <!-- Listings -->
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">

            <!-- Booking Requests Filters  -->
            <div class="booking-requests-filter">

            </div>

            <!-- Reply to review popup -->
            <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                <form class="reply-form" method="post" action="<?php echo site_url('admin/contact/reply'); ?>">
                <div class="small-dialog-header">
                    <h3>Reply Message</h3>
                </div>
                <div class="message-reply margin-top-0">
                    <input type="hidden" name="contact_id" value="" class="contact_id">
                    <textarea cols="40" rows="3" name="message" placeholder="Your Reply Message "></textarea>
                    <button class="button" type="submit" >Reply</button>
                </div>
                </form>
            </div>

            <h4>Contact Enquries</h4>
            <ul>

            <?php if (count($contacts) > 0) { ?>
                <?php foreach($contacts as $contact){
                    $replied = false;
                    if(($contact->type == 'R') && ($contact->parent == $contact->id)){
                        $replied = true;
                    } 
                    if($contact->type != 'Q'){
                        continue;
                    }
                    ?>
                    <li class="pending-booking">
                    <div class="list-box-listing bookings">
                        <div class="list-box-listing-img"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=120"
                                alt=""></div>
                        <div class="list-box-listing-content">
                            <div class="inner">
                                <h3><?php echo $contact->subject; ?>
                                <span class="booking-status"><?php echo $contact->type == 'Q'?'Enquiry':'Reply'; ?></span>
                                <?php if($replied == true ){
                                    ?>
                                    <span class="booking-status unpaid">Replied</span>

                                <?php } ?></h3>

                                <div class="inner-booking-list">
                                    <h5>Name:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted"><?php echo $contact->name; ?></li>
                                    </ul>
                                </div>

                                <div class="inner-booking-list">
                                    <h5>Email:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted"><?php echo $contact->email; ?></li>
                                    </ul>
                                </div>

                                <div class="inner-booking-list">
                                    <h5>Date:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted"><?php echo $contact->date; ?></li>
                                    </ul>
                                </div>

                                <div class="inner-booking-list">
                                    <h5>Ip Address:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted"><?php echo $contact->ip; ?></li>
                                    </ul>
                                </div>

                                <div class="inner-booking-list">
                                    <h5>Message:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted"><?php echo $contact->message; ?></li>
                                    </ul>
                                </div>

                                <a href="#small-dialog" onclick="replyMessage('<?php echo $contact->id; ?>');" class="rate-review reply-message popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i>
                                    Send Message</a>

                            </div>
                        </div>
                    </div>
                                    <ul>
                                        <?php foreach($contact->reply as $reply): ?>
                                        <li class="pending-booking">
                                            <div class="list-box-listing bookings">
                                                <div class="list-box-listing-img"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=120"
                                                        alt=""></div>
                                                <div class="list-box-listing-content">
                                                    <div class="inner">
                                                        <h3><?php echo $reply->subject; ?>
                                                        <span class="booking-status unpaid"><?php echo $reply->type == 'Q' ? 'Enquiry' : 'Reply'; ?></span>
                                                        </h3>

                                                        <div class="inner-booking-list">
                                                            <h5>Name:</h5>
                                                            <ul class="booking-list">
                                                                <li class="highlighted"><?php echo $reply->name; ?></li>
                                                            </ul>
                                                        </div>

                                                        <div class="inner-booking-list">
                                                            <h5>Email:</h5>
                                                            <ul class="booking-list">
                                                                <li class="highlighted"><?php echo $reply->email; ?></li>
                                                            </ul>
                                                        </div>

                                                        <div class="inner-booking-list">
                                                            <h5>Date:</h5>
                                                            <ul class="booking-list">
                                                                <li class="highlighted"><?php echo $reply->date; ?></li>
                                                            </ul>
                                                        </div>

                                                        <div class="inner-booking-list">
                                                            <h5>Ip Address:</h5>
                                                            <ul class="booking-list">
                                                                <li class="highlighted"><?php echo $reply->ip; ?></li>
                                                            </ul>
                                                        </div>

                                                        <div class="inner-booking-list">
                                                            <h5>Message:</h5>
                                                            <ul class="booking-list">
                                                                <li class="highlighted"><?php echo $reply->message; ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="buttons-to-right">
                                                <a href="#" class="button gray reject"><i class="sl sl-icon-close"></i> Reject</a>
                                                <a href="#" class="button gray approve"><i class="sl sl-icon-check"></i> Approve</a>
                                            </div> -->
                                        </li>
                                                <?php endforeach; ?>
                                    </ul>

                                    <hr>
                    <!-- <div class="buttons-to-right">
                        <a href="#" class="button gray reject"><i class="sl sl-icon-close"></i> Reject</a>
                        <a href="#" class="button gray approve"><i class="sl sl-icon-check"></i> Approve</a>
                    </div> -->
                </li>
                <?php } ?>
                 
            <?php echo $pagination; } ?>
                


            </ul>
        </div>
    </div>
</div>
