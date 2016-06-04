<div class="row">
    <div class="col-lg-12 ">
        <h3 class="page-header">Edit Job</h3>
        <div class="panel">
            <?php echo validation_errors(); ?>           
            <?php echo form_open("Job/edit/{$user['job_id']}"); ?>
            <div class="panel-body">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Job Title/Designation *</label>
                         <input type='hidden' name='id' value="<?php echo $user['job_id'] ?>"/>
                        <input type="text" name="title" value="<?php echo $user['title']?>" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">No of vacancies</label>
                        <input type="text" name="no_of_vacancy" value="<?php echo  $user['no_of_vacancy']?>" class="form-control"/>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">keywords *</label>
                        <input type="text" name="keyword" value="<?php echo  $user['keyword'];?>" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Work Experience *</label><br>
                        <select class="form-control half-formcontrol"  name="exp_min"><?php echo $experience ?></select><select class="form-control half-formcontrol" name="exp_max"><?php echo $experience1 ?></select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">CTC </label><br>
                        <input type="text" value="<?php echo $user['ctc_min']?>" class="form-control half-formcontrol" placeholder="Enter Salary"  name="ctc_min">
                        <select class="form-control half-formcontrol"  name="ctc_type">
                            
                             <option value="0"<?php
                        if (isset($user['ctc_type']) && $user['ctc_type'] == 0) {
                            echo "selected";
                        }
                        ?> name="'ctc_type'">Per Month</option>
                                        <option value="0"<?php
                        if (isset($user['ctc_type']) && $user['ctc_type'] == 1) {
                            echo "selected";
                        }
                        ?> name="ctc_type">Per Year</option>

                        </select>
                    </div>
                     <div class="form-group">
                        <label class="control-label">Hide Salary From Jobseeker*</label>
                        <input type="checkbox" value="1" <?php
                        if (isset($user['hide_ctc']) && $user['hide_ctc'] == 1) {
                            echo "checked";
                        }
                        ?> name="hide_ctc" >
                               
                               
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">Location </label>
                        <select class="form-control" name="location">
                            <?php echo  $location; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Industry </label>
                        <select class="form-control" name="industry"><?php echo $industry ;?></select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Function Area *</label>
                        <select class="form-control" name="functional_area"><?php echo  $functional_area ?></select>
                      
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="control-label">Job Description *</label>
                        <textarea name="description" class="form-control"/><?php echo  $user['description']?></textarea>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Save" >
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector: 'textarea'});</script>




