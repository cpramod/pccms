<div class="row">
    <div class="col-lg-12">
        <h3>Post Job</h3>
        <form method="post" action="<?php echo current_url(); ?>" id="payment">
            <div class="row">
                <div class="col-md-12">
                    <div class="step-container">
                        <div class="step-wizard">
                            <div class="progress">
                                <div class="progressbar" style="width: 100%;"></div>
                            </div>
                            <ul class="nav">
                                <li>
                                    <a href="" class="show">
                                        <span class="step"><i class="fa fa-suitcase"></i></span>
                                        <span class="title">Job Details</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="show">
                                        <span class="step"><i class="fa fa-credit-card-alt"></i></span>
                                        <span class="title">Package</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="active show">
                                        <span class="step"><i class="fa fa-check-circle"></i></span>
                                        <span class="title">Payments & Confirmation</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row / Start -->
            <div class="row">

                <div class="col-md-12">
                    <h3>Payment Gateway</h3>
                    <ul class="payments">
                        <!-- <li><label class="payment"><input type="radio" name="payment" value="esewa"> <span><img src="<?php // echo img('esewa.png', true); ?>" width=""></span></label> </li> -->
                        <!-- <li><label class="payment"><input type="radio" name="payment" value="khalti"> <span><img src="<?php // echo img('khalti.jpg', true); ?>" width=""></span></label> </li> -->
                        <!--<li><label class="payment"><input type="radio" name="payment" value="ipay"> <span><img src="<?php // echo img('ipay.png', true); ?>" width=""></span></label> </li> -->
                        <li><label class="payment"><input type="radio" name="payment" value="bank" checked> <span><strong>Bank Transfer</strong><br>(RBB Ac No: 333001991810)</span></label> </li>
                    </ul>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" class="id">
            </div>
            <!-- Row / End -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-control">
                        <a href="<?php echo site_url('jobs/post/'.$id.'/2'); ?>" class="button previous">Previous</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-control">
                        <input type="submit" name="submit" value="Make Payment" class="button next pull-right">
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>
