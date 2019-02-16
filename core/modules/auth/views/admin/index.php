<div class="row flex-row">
    <div class="col-xl-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4><?php echo $template['title']; ?></h4>
                <div class="pull-right"><?php echo anchor('auth/create_user', lang('index_create_user_link')) ?> / <?php echo anchor('auth/create_group', lang('index_create_group_link')) ?></div>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                       <table cellpadding=0 cellspacing=10 class="table mb-0">
                            <thead>   
                                <tr>
                                    <th><?php echo lang('index_fname_th'); ?></th>
                                    <th><?php echo lang('index_lname_th'); ?></th>
                                    <th><?php echo lang('index_email_th'); ?></th>
                                    <th><?php echo lang('index_groups_th'); ?></th>
                                    <th><?php echo lang('index_status_th'); ?></th>
                                    <th><?php echo lang('index_action_th'); ?></th>
                                </tr>
                           </thead>
                          <?php foreach ($users as $user) : ?>
                               <tr>
                                   <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                   <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                   <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                   <td>
                                      <?php foreach ($user->groups as $group) : ?>
                                           <?php echo anchor("auth/edit_group/" . $group->id, htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')); ?><br />
                                      <?php endforeach ?>
                                   </td>
                                   <td><span class="badge-text badge-text-small info"><?php echo ($user->active) ? anchor("auth/deactivate/" . $user->id, lang('index_active_link')) : anchor("auth/activate/" . $user->id, lang('index_inactive_link')); ?></span></td>
                                   <td><?php echo anchor("auth/edit_user/" . $user->id, 'Edit'); ?></td>
                               </tr>
                          <?php endforeach; ?>
                       </table>
                   </div>
            </div>
        </div>
    </div>
</div>






