<?php echo form_open('User/user_qualification') ?>
<h2 align="center">Other Details</h2>
<div class="row"><?php echo validation_errors(); ?></div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group"><h5>language Known</h5></div>
        <div class="form-group">
            <table class="table lan">
                <tr>
                    <td>language</td>
                    <td>Proficiency Level</td>
                    <td>Read</td>
                    <td>Write</td>
                    <td>Speak</td>
                </tr>
                <tr class="add">
                    <td><input type="text" name="language"/></td>
                    <td>
                        <select>
                            <option value="">select</option>
                            <option value="beginner">Beginner</option>
                            <option value="expert">Expert</option>
                            <option value="proficient">proficient</option>
                        </select>
                    </td>
                    <td><input type="checkbox" name="read"/></td>
                    <td><input type="checkbox" name="write"/></td>
                    <td><input type="checkbox" name="speak"/></td>
                </tr>
            </table>
            <button class="btn addbtn">ADD MORE</button>
        </div>
    </div>

</div>
</form>
<script>
    $(document).ready(function(){
        $('.addbtn').click(function(){
            $('.lan').append('<tr class="add1"><td><input type="text" name="language"/></td><td><select><option value="">select</option><option value="beginner">Beginner</option><option value="expert">Expert</option><option value="proficient">proficient</option></select></td><td><input type="checkbox" name="read"/></td><td><input type="checkbox" name="write"/></td><td><input type="checkbox" name="speak"/></td></tr>');
        })
    })
</script>
