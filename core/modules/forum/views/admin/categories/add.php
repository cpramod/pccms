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
                            <h5>Category Title <i class="tip" data-tip-content="Name of the category"></i></h5>
                            <input class="search-field" type="text" name="title" value="<?php echo set_value('title'); ?>" />
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="row with-forms">
                        <!-- Type -->
                        <div class="col-md-6">
                            <h5>URL title <i class="tip" data-tip-content="This is the 'slug' shown in the URL of your post. If you enter this, there must be NO spaces between words, instead, used dashes. You can leave this blank and we'll build one for you based on the title of your post. 
IE: new-url-title"></i></h5>
                            <input type="text" placeholder="Slug should have no space between the words" name="url_friendly_name"
                                value="<?php echo set_value('url_friendly_name'); ?>">
                        </div>
                        <div class="col-md-6 checkboxes">
                            <h5>Moderate</h5>
                            <input type="checkbox" name="moderate" value="1" id="moderate">
                            <label for="moderate">Moderate</label>
                        </div>


                    </div>
                    <!-- Row / End -->
                    <!-- Description -->
                    <div class="form">
                        <h5>Description</h5>
                        <textarea data-provide="markdown" class="wysiwyg" name="description" cols="40" rows="3" id="summary"
                            spellcheck="true"></textarea>
                    </div>

                    <div class="form">
                        <h5>Priority</h5>
                        <input type="text" name="sort_order" value="">
                    </div>



                </div>
                <!-- Section / End -->
                <button type="submit" class="button preview">Submit <i class="fa fa-arrow-circle-right"></i></button>
            </form>
        </div>
    </div>
</div>
