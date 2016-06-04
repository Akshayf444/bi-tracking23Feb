<?php echo form_open('User/changepassword') ?>
<div class="container-fluid">
    <div class="row"><?php echo validation_errors(); ?></div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3"  >
            <h2>Change Password</h2>
            <div class="form-group" >
                <input type="text" class="form-control" name="old_password" placeholder="Enter Old Password"/>
            </div>
            <div class="form-group" >
                <input type="text" class="form-control" name="password" placeholder="Enter New Password"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Change Password"/>
            </div>
        </div>
    </div>
</div>
</form>