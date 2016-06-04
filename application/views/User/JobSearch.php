<h2 class="page-header">Job Search</h2>
<div class="row"><?php// echo validation_errors(); ?></div>
<div class="row" style="margin-top: 15px;">
    <?php echo form_open('User/SearchJob2') ?>
        <div class="col-lg-12">

            <div class="col-sm-3">
                <input type="text" class="form-control" style="width: 243px;height: 36px" name="skill" placeholder="Enter Skill"/>
            </div>
            <div class="col-sm-3">
                <select name="location" style="width: 243px;height: 36px;" class="form-control">
                    <?php echo $dropdowns; ?>
                </select>
            </div>
            <div class="col-sm-3">
                <input type="type" style="width: 243px;height: 36px;" name="experince" class="form-control" placeholder="Enter Experince"/>
            </div>
            <div class="col-sm-3">
                <input type="submit" class="btn btn-success" value="search"/>
            </div>

        </div>
    </form>
</div>

<div class="row" style="margin-top: 25px;">
<?php
if(isset($job)){
foreach ($job as $j){
    
    ?>
<div class="row">
    <div class="col-lg-1"></div>
    
    
        <div class="col-lg-10 panel panel-default">
            <h5 ><a href="../User/view_search/?id=<?php echo $j->job_id ?>"><?php echo $j->title ?></a></h5>
            <h6><?php echo $j->name ?></h6>
            <div class="row">
                <dl>
                    <dt class="col-sm-1">
                    <h6><?php echo $j->exp_min ?>-<?php echo $j->exp_max ?>Yrs</h6>
                    </dt>
                    <dt class="col-sm-2">
                    <h6><?php echo $j->loc  ?></h6>
                    </dt>
                    <dt class="col-sm-2">
                    <h6>Key Skills :</h6>
                    </dt>
                    <dt class="col-sm-2">
                    <h6><?php echo $j->keyword ?></h6>
                    </dt>
                </dl>
            </div>

            <div class="row">
                <dl>
                    <dt class="col-sm-1">
                    <h6>RS</h6>
                    </dt>
                    <dt class="col-sm-2">
                    <h6><?php echo $j->ctc_min ?> P.A</h6>
                    </dt>
                </dl>
            </div>
        </div>
    
</div>
<?php 
}
} ?>
</div>