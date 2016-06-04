<h2 class="page-header">Application History</h2>
<div class="row" style="margin-top: 30px;">



    <?php foreach ($history as $application): ?>
        <div class="col-lg-6">
            <table>

                <tr class=" panel panel-default"> 
                    <th style="    padding: 9px;">Job Details</th>
                    <th style="text-align: center;    padding: 9px;">Applied On</th>
                </tr>
                <tr class=" panel panel-default">
                    <td style="width: 407px;padding: 9px;">

                        <a href="<?php echo site_url('User/view_search2/?id=' . $application->job_id) ?>"> <?php echo $application->title; ?></a> (<?php echo $application->exp_min ?>-<?php echo $application->exp_max ?> yrs.)

                        <br>
                        <span><?php echo $application->name; ?></span>

                        <h5><?php echo $application->location ?></h5>


                    </td>
                    <td >
                        <?php echo date('M-d-Y', strtotime($application->created)) ?>
                    </td>
                </tr>

            </table>
        </div>
    <?php endforeach; ?>


</div>