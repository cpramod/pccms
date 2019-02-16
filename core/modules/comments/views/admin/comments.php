<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4>
                <?php echo $template['title']; ?>
            </h4>
            <ul>
                <li>
            
                <?php 
                if (count($comments) > 0) {
                    ?>
                    <table class="basic-table">
                <tr>
                    <th>#</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>In Response To</th>
                    <th>Submitted On</th>
                    <th>Action</th>
                </tr>
                    <?php
                    $i = 0;
                    foreach ($comments as $comment) : //print_r($category); ?>
                    <tr>
                        <td><?php echo $comment['id']; ?></td>
                        <td><?php echo $comment['author']; ?></td>
                        <td><?php echo $comment['comment']; ?></td>
                        <td><?php echo $comment['post']; ?></td>
                        <td><?php echo Date('Y-m-d', strtotime($comment['date'])) . ' at ' . Date('H:i', strtotime($comment['date'])); ?></td>
                        <td>
                            <?php if($comment['status'] == 1): ?>
                                <a href="javascript:" class="button gray"><i class="im im-icon-Yes"></i> Approved</a>
                            <?php else: ?>
                                <a href="<?php echo site_url('admin/comments/approve/'.$comment['comment_id']); ?>" class="button gray"><i class="im im-icon-Yes"></i> Approve</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php $i++;
                endforeach; ?>
                </table>
                <?php 
                echo $pagination;
            } else {
                ?>
                <li>
                    <div class="list-box-listing">
                        <h3>No Record Found!</h3>
                    </div>
                </li>
                <?php

            } ?>
                
                </li>
            </ul>
        </div>
    </div>
</div>
