<?php echo validation_errors(); ?>
<!-- container -->
<div class="document-title">
    <div class="container">
        <h1 class="center">Account Registration</h1>
    </div><!-- /.container -->
</div><!-- /.document-title -->
<?php
if (isset($Error)) {
    echo $Error;
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="<?php echo site_url('User/register');?>" aria-controls="personal" role="tab" data-toggle="tab">
                        <strong>Personal Account</strong>
                        <span>I'm looking for a job</span>
                    </a>
                </li>

                <li role="presentation">
                    <a href="<?php echo site_url('Employee/register');?>" aria-controls="company" role="tab" data-toggle="tab">
                        <strong>Company Account</strong>
                        <span>We are hiring employees</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <?php echo form_open('User/register') ?>
                <div role="tabpanel" class="tab-pane active" id="personal">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="page-header">Basic Details</h2>
                            <div class="form-group">
                                <label >Full Name</label>
                                <input type="text" required="required" class="form-control" />
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label >E-mail</label>
                                <input type="text" required="required" class="form-control" name="email"/>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label >Password</label>
                                <input type="text" required="required" class="form-control" name="password"/>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label >Mobile</label>
                                <input type="text" required="required" class="form-control" name="mobile"/>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label >Current Location</label>
                                <select class="form-control" name="current_location">
                                    <?php echo $location; ?>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-sm-6">
                            <h2 class="page-header">Work Experience</h2>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label >In Years</label>
                                    <input type="text" class="form-control" name="experince_year"/>
                                </div><!-- /.form-group -->

                                <div class="form-group col-sm-6">
                                    <label>In Month</label>
                                    <input type="text" class="form-control" name="experince_month"/>
                                </div><!-- /.form-group -->
                            </div><!-- /.row -->

                        </div><!-- /.col-* -->
                        <div class="col-sm-6">
                            <h2 class="page-header">Education Details</h2>
                            <div class="form-group">
                                <label >Qualification</label>
                                <?php echo $dropdowns[0]; ?>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label >Specialization</label>
                                <?php echo $dropdowns[1]; ?>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label >Institute</label>
                                <select class="form-control" name="institute[]">
                                    <?php echo $institute; ?>
                                </select>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label >Year</label>
                                <input type="text" class="form-control" name="year[]"/>
                            </div><!-- /.form-group -->
                        </div>
                    </div><!-- /.row -->

                    <div class="center">
                        <div class="checkbox checkbox-info">
                            <label><input type="checkbox"> By signing up, you agree with the <a href="#">terms and conditions</a></label>
                        </div><!-- /.checkbox -->

                        <button type="submit" class="btn btn-secondary">Create an Account</button>
                    </div><!-- /.center -->
                </div><!-- /.tab-pane -->
                </form>
            </div><!-- /.tab-content -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
</div><!-- /.container -->