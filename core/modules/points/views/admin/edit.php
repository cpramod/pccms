<div class="row">
    <div class="col-lg-12">

        <div id="add-listing">
            <form action="<?php echo current_url(); ?>" method="post">
                <!-- Section -->
                <div class="add-listing-section">

                    <!-- Headline -->
                    <div class="add-listing-headline">
                        <h3><i class="sl sl-icon-doc"></i> Informations</h3>
                    </div>

                    <!-- Title -->
                    <div class="row with-forms">
                        <div class="col-md-12">
                            <h5>Activity</h5>
                            <select name="activity_id" class="chosen-select-no-single" id="" disabled>
                                <?php foreach($points as $point){ ?>
                                    <option value="<?php echo $point->id; ?>" <?php echo $point->id==$activity_id?'selected':''; ?>><?php echo $point->activity_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="row with-forms">
                        <!-- Type -->
                        <div class="col-md-6">
                            <h5>Base Point </h5>
                            <input type="text" name="base_point" value="<?php echo set_value('base_point', $base_point); ?>">
                        </div>

                        <div class="col-md-6">
                            <h5>Multiplier</h5>
                            <input type="text" name="multiplier" value="<?php echo set_value('multiplier', $multiplier); ?>">
                        </div>

                    </div>
                    <!-- Row / End -->
                    <!-- Description -->
                    <div class="form">
                        <h5>Description</h5>
                        <textarea data-provide="markdown" class="wysiwyg" name="description" cols="40" rows="3" id="summary"
                            spellcheck="true"><?php echo set_value('description', $description); ?></textarea>
                    </div>

                </div>
                <!-- Section / End -->
                <button type="submit" class="button preview">Submit <i class="fa fa-arrow-circle-right"></i></button>
            </form>
        </div>
    </div>
</div>
