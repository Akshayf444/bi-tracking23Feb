<div class="document-title">
    <div class="container">
        <h1 class="center">Candidates</h1>
    </div><!-- /.container -->
</div>
<div class="container-fluid">
    <div class="col-sm-offset-1 col-sm-10">
<div class="col-sm-12">
    <div class="tab">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><a href="<?php echo site_url('Job/job_list'); ?>" aria-controls="Name" >Job</a></li>
            <li role="presentation" class="active"><a href="<?php echo site_url('Job/candidates'); ?>" aria-controls="Candidates" >Candidates</a></li>

        </ul>
    </div>
</div>

    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Location</th>
            <th>Current/Last Role</th>
            <th>Education</th>
            <th>Date</th>
        </tr>

        <?php foreach ($user as $u): ?>
            <tr>                
                <td> <?php echo $u->NAME; ?></td>
                <td> <?php echo $u->location; ?></td>
                <td> <?php echo $u->role; ?></td>
                <td> <?php echo $u->qualification . " " . $u->specialization; ?></td>
                <td> <?php echo $u->apply_date; ?></td>

                <?php
            endforeach;
//print_r($this->session->all_userdata());
            ?>
    </table>
</div>

</div>
   
