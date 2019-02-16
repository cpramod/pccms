<div class="row">
    <!-- Listings -->
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">

            <!-- Booking Requests Filters  -->
            <div class="booking-requests-filter">

            </div>

            <h4>
                <?php echo $question['title']; ?>
            </h4>
            <ul>

                <?php 
            if (count($answers) > 0) { ?>
                <?php foreach ($answers as $answer) {
                    //print_r($answer);

                    $user = $this->ion_auth_model->user ($answer ['user_id'])->row ();
                    
                    ?>
                <li class="pending-booking">
                    <div class="list-box-listing bookings">
                        <div class="list-box-listing-img"><img src="<?php echo $user->avatar?$user->avatar:'http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=120';?>"
                                alt=""></div>
                        <div class="list-box-listing-content">
                            <div class="inner">
                                <h3>
                                    <?php echo $answer['answer_text']; ?>
                                </h3>


                                <div class="inner-booking-list">

                                    <h5>Name:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted">
                                            <?php echo $user->first_name.' '.$user->last_name; ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="inner-booking-list">
                                    <h5>Email:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted">
                                            <?php echo $user->email; ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="inner-booking-list">
                                    <h5>Answered at:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted">
                                            <?php echo $answer['answer_time']; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buttons-to-right">
                        <a onclick="return confirm('Are you sure?');" href="<?php echo site_url('admin/forum/deleteAnswer/' . $answer['id']); ?>"
                            class="button gray reject"><i class="sl sl-icon-close"></i> Reject</a>
                        <!-- <a href="#" class="button gray approve"><i class="sl sl-icon-check"></i> Approve</a> -->
                    </div>
                    <ul>
                        <?php 
                                        foreach ($comments as $comment) : 
                                            if($comment['answer_id'] == $answer['id']){
                                                $commented_user= $this->ion_auth_model->user($comment['user_id'])->row();

                                            ?>
                        <li class="pending-booking">
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img">
                                    <img src="<?php echo $commented_user->avatar?$commented_user->avatar:'http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=120';?>"
                                        alt="">
                                </div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $comment['comment_text']; ?>
                                        </h3>

                                        <div class="inner-booking-list">
                                            <h5>Comment By:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">
                                                    <?php echo $commented_user->first_name.' '.$commented_user->last_name; ?>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="inner-booking-list">
                                            <h5>Email:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">
                                                    <?php echo $commented_user->email; ?>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="inner-booking-list">
                                            <h5>Comment Date:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">
                                                    <?php echo $comment['comment_time']; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a onclick="return confirm('Are you sure?');" href="<?php echo site_url('admin/forum/deleteComment/'.$comment['id']); ?>"
                                    class="button gray reject"><i class="sl sl-icon-close"></i> Reject</a>
                                <!-- <a href="#" class="button gray approve"><i class="sl sl-icon-check"></i> Approve</a> -->
                            </div>
                        </li>
                        <?php }
                                             endforeach; ?>
                    </ul>

                    <hr>
                    <!-- <div class="buttons-to-right">
                        <a href="#" class="button gray reject"><i class="sl sl-icon-close"></i> Reject</a>
                        <a href="#" class="button gray approve"><i class="sl sl-icon-check"></i> Approve</a>
                    </div> -->
                </li>
                <?php 
            } ?>

                <?php 
        }else{
            ?>
            
            <?php
        } ?>



            </ul>
        </div>
    </div>
</div>
