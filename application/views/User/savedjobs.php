<h2 class="page-header">Saved Jobs</h2>
<div class="row" style="margin-top: 30px;">
    <?php foreach ($history as $application): ?> 
        <div class="col-lg-6 panel panel-default" style="padding: 15px">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?php echo site_url('User/view_search2/?id=' . $application->job_id) ?>"> <?php echo $application->title; ?></a> (<?php echo $application->exp_min ?>-<?php echo $application->exp_max ?> yrs.)

                    <br>
                    <span><?php echo $application->name; ?></span>
                </div>
                <div class="col-sm-6 pull-right">

                    Saved On: <?php echo date('M-d-Y', strtotime($application->created)) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h5><?php echo $application->location ?></h5>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>