<table class="skill" width="100%">
    <form method="post" action="<?php echo site_url('profile/resume/skills/add'); ?>">
        <tr>
            <th>Skill Heading</th>
            <th>Rate in percentage</th>
            <th></th>
        </tr>
        <tr>
            <td><input type="text" name="title" value="" class="form-control"></td>
            <td><input type="text" name="rate" value="" class="form-control"></td>
            <td>
                <input type="submit" name="submit" value="Save" class="button"> 
                <a href="javascript:" class="remove"><i class="fa fa-remove"></i></a>
            </td>
        </tr>

    </form>
    
</table>