<div class="document-title">
    <div class="container">
        <h1 class="center">Change Password</h1>
    </div><!-- /.container -->
</div><!-- /.document-title -->
<div class="container">
    <div class="row">
        <div class="col-sm-12"><?php echo validation_errors(); ?></div>
    </div>
    <?php echo form_open('Employee/changepassword') ?>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3"  >
            <div class="form-group" >
                <input type="text" class="form-control" name="old_password" placeholder="Enter Old Password"/>
            </div>
            <div class="form-group" >
                <input type="text" class="form-control" name="password" placeholder="Enter New Password"/>
            </div>
            <div align="center" class="form-group">
                <input type="submit" class="btn btn-success" value="change password"/>
            </div>
        </div>
    </div>
</form>
</div>