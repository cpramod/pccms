<div class="row">
    <div class="col">
        <h4 class="heading-primary">Reviews</h4>
        <ul class="comments">
            <?php

            foreach ($reviews as $review) {
                ?>
                <li>
                    <div class="comment">
                        <div class="img-thumbnail d-block">
                            <img class="avatar" alt=""
                                 src="<?php echo $review->avatar ? $review->avatar : img('avatars/avatar.png'); ?>">
                        </div>
                        <div class="comment-block">
                            <div class="comment-arrow"></div>
                            <span class="comment-by">
															<strong><?php echo $review->name; ?></strong>
															<span class="float-right">
																<div title="Rated <?php echo $review->star; ?> out of 5"
                                                                     class="star-rating">
																	<?php for ($i = 0; $i < 5; $i++) {
                                                                        if ($i < $review->star):
                                                                            ?>
                                                                            <i class="fas fa-star"></i>
                                                                        <?php else: ?>
                                                                            <i class="far fa-star"></i>
                                                                        <?php endif; ?>

                                                                        <?php
                                                                    }
                                                                    ?>
																</div>
															</span>
														</span>
                            <p><?php echo $review->description; ?></p>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <hr class="tall">
        <h4 class="heading-primary">Add a review</h4>
        <div class="row">
            <div class="col">

                <?php if($this->session->flashdata('success')): ?>
                    <p style="color:red;"><?php echo $this->session->flashdata('success'); ?></p>
                <?php endif;?>

                <form action="<?php echo current_url(); ?>" id="submitReview" method="post">
                    <?php if ($this->session->userdata('user_id')): ?>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label>Your name *</label>
                                <input type="text"
                                       value="<?php echo set_value('name', $user_details['first_name'] . ' ' . $user_details['last_name']); ?>"
                                       readonly="readonly" data-msg-required="Please enter your name." maxlength="100"
                                       class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Your email address *</label>
                                <input type="email" value="<?php echo set_value('email', $user_details['email']); ?>"
                                       readonly="readonly" data-msg-required="Please enter your email address."
                                       data-msg-email="Please enter a valid email address." maxlength="100"
                                       class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <input type="hidden" name="avatar" value="<?php echo $user_details['avatar']; ?>">
                    <?php else: ?>

                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label>Your name *</label>
                                <input type="text" value="<?php echo set_value('name') ?>"
                                       data-msg-required="Please enter your name." maxlength="100" class="form-control"
                                       name="name" id="name">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Your email address *</label>
                                <input type="email" value="<?php echo set_value('email'); ?>"
                                       data-msg-required="Please enter your email address."
                                       data-msg-email="Please enter a valid email address." maxlength="100"
                                       class="form-control" name="email" id="email">
                            </div>
                        </div>

                    <?php endif; ?>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="">Rating</label>
                            <input class="rating hidden" data-max="5" value="" data-min="1" id="rating" name="rating"
                                   data-icon-lib="" data-active-icon="fas fa-star" data-inactive-icon="far fa-star"
                                   type="number"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Review *</label>
                            <textarea maxlength="5000" data-msg-required="Please enter your message." rows="10"
                                      class="form-control" name="description" id="message">
                                                <?php echo set_value('description'); ?>
                                            </textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <input type="submit" value="Submit Review" class="btn btn-primary"
                                   data-loading-text="Loading...">
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>