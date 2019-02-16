<div class="col-lg-3">
    <aside class="sidebar">

        <!--                <form>-->
        <!--                    <div class="input-group input-group-4">-->
        <!--                        <input class="form-control" placeholder="Search..." name="s" id="s" type="text">-->
        <!--                        <span class="input-group-append">-->
        <!--											<button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-search"></i></button>-->
        <!--										</span>-->
        <!--                    </div>-->
        <!--                </form>-->
        <!---->
        <!--                <hr>-->

        <h4 class="heading-primary">Categories</h4>
        <ul class="nav nav-list flex-column mb-5">
            <?php if ($this->template->categories_list): ?>
                <?php foreach ($this->template->categories_list as $category): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo category_url($category['slug']); ?>"> <?php echo $category['name']; ?> (<?php echo $category['posts_count']; ?>)</a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <h4 class="heading-primary">Archives</h4>
        <ul class="nav nav-list flex-column mb-5">
            <?php if ($this->template->archives_list): ?>
                <?php foreach ($this->template->archives_list as $archive_item): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo archive_url($archive_item['url']); ?>"> <?php echo $archive_item['date_posted']; ?> (<?php echo $archive_item['posts_count']; ?>)</a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>


        <hr>

        <h4 class="heading-primary">About Us</h4>
        <p>Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Nulla nunc dui, tristique in semper vel. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. </p>

    </aside>
</div>