<?php echo form_open('WorkExperince/work_exp') ?>
<h2 align="center">Upload Resume</h2>
<div class="row"><?php echo form_open_multipart('Api/resume'); ?></div>
<div class="row">
    <div class="col-lg-3"></div>
            <div class="col-lg-6 panel panel-default">
                <?php //echo $error;?> <!-- Error Message will show up here -->
                <div class="form-group " style="text-align: center">
<!--                <h3>Enter Your Projects Detail</h3>-->
            </div>
                <div class="form-group " style="text-align: center">
                <input type='file' class="form-control btn" name='userfile' size='20' />
                </div>
                <div class="form-group " style="text-align: center">
                <input type='submit' class="btn btn-success" name='submit' value='upload' /> 
                </div>
            </div>
        </div>
<div class="col-lg-3"></div>

</form>