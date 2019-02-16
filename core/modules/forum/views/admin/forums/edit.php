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
                            <h5>Title <i class="tip" data-tip-content="Name of the forum"></i></h5>
                            <input class="search-field" type="text" name="title" value="<?php echo set_value('title', $title); ?>" />
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="row with-forms">
                        <!-- Type -->
                        <div class="col-md-6">
                            <h5>URL title <i class="tip" data-tip-content="This is the 'slug' shown in the URL of your post. If you enter this, there must be NO spaces between words, instead, used dashes. You can leave this blank and we'll build one for you based on the title of your post. 
IE: new-url-title"></i></h5>
                            <input type="text" placeholder="Slug should have no space between the words" name="slug"
                                value="<?php echo set_value('slug', $slug); ?>">
                        </div>
                        <div class="col-md-6 checkboxes">
                            <h5>Category</h5>
                            <select name="category" class="chosen-select-no-single" id="">
                                <option value="">Select Category</option>
                                <?php 

                                foreach ($categories as $category) {
                                    ?>
                                    <option value="<?php echo $category->id; ?>" <?php echo $category_id==$category->id?'selected':''; ?>><?php echo $category->title; ?></option>
                                <?php 
                            }
                            ?>
                            </select>
                        </div>


                    </div>
                    <!-- Row / End -->
                    <!-- Description -->
                    <div class="form">
                        <h5>Description</h5>
                        <textarea data-provide="markdown" class="wysiwyg" name="description" cols="40" rows="3" id="summary"
                            spellcheck="true">
                        <?php echo set_value('description',$description); ?>
                        </textarea>
                    </div>

                    <div class="form">
                        <h5>Priority</h5>
                        <input type="text" name="sort_order" value="<?php echo set_value('sort_order',$sort_order); ?>">
                    </div>



                </div>
                <!-- Section / End -->
                <button type="submit" class="button preview">Submit <i class="fa fa-arrow-circle-right"></i></button>
            </form>
        </div>
    </div>
</div>
