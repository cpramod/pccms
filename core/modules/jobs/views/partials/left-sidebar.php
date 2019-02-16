<div class="col-md-3 side">
    <form action="<?php echo base_url('jobs/index'); ?>" method="GET">
        <h3>Search Filter</h3>
        <div class="sidebar">
            
            <div class="content">
                <div class="form-group">
                    <label for="search-keyword">Search Keywords</label>
                    <input type="text" name="keyword" value="" placeholder="Search Here" class="form-control">
                </div>
            </div>
            <div class="content">
                <div class="form-group">
                    <label for="category">Categories</label>
                    <?php 
                    
                    echo form_dropdown('category', toAssociative($specialisms), isset($category)?$category:'');
                     ?>
                </div>
            </div>
            <div class="content">
                <div class="form-group">
                    <label for="type">Type</label>
                    <?php 
                    $sl='';
                    if(isset($_GET['type'])){
                        $setype = $this->input->get(type);
                    }
                    foreach($types as $type){
                        if($type['slug'] == $setype){
                            $sl='checked';
                        }else{
                            $sl='';
                        }

                        ?>
                        <span><input type="radio" name="type" value="<?php echo $type['slug']; ?>" <?php echo $sl; ?>> <?php echo $type['title']; ?></span>
                    <?php } ?>
                    
                </div>
            </div>
        
        </div>
        <input type="submit" value="Search" class="button">
        
        
    </form>

</div>
