<!-- /.document-title -->
<div class="container-fluid">
    <div class="col-sm-offset-1 col-sm-10">
        <div class="col-sm-12">
            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="<?php echo site_url('Job/job_list'); ?>" aria-controls="Name" role="tab" data-toggle="tab">Job</a></li>
                    <li role="presentation"><a href="<?php echo site_url('Job/candidates'); ?>" aria-controls="Candidates" >Candidates</a></li>
                    <a href="<?php echo site_url('Job/add') ?>"class=" btn-sm btn-success pull-right"><b>Post Job</b></a>

                </ul>
            </div>
        </div>

        <table class="table table-striped">
            <tr>

                <th style="width: 40%">Name</th>
                <th style="width: 40%">Location</th>
                <th style="width: 10%">Created</th>
                <th style="width: 5%">Candidates</th>
                <th style="width: 5%">Status</th>
            </tr>

            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><a onclick="request('<?php echo site_url('Job/viewJobDetails/' . $user->job_id) ?>')"  style="font-weight: 800;cursor: pointer"><?php echo $user->title ?></a></td>
                    <td><?php echo $user->location ?></td>
                    <td><?php  echo date('d-m-Y',strtotime($user->created_at)); ?></td>
                    <td><a href="<?php echo site_url('Job/candidates') . '?job=' . $user->job_id; ?>"><?php echo $user->applied_count ?></a> </td>
                    <td><select name=""><option>Open</option><option>Paused</option><option>Closed</option></select></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<div id="ajaxcontainer">

</div>
<script>
    $(document).ready(function () {
        var isIE = navigator.userAgent.indexOf(' MSIE ') > -1;
        if (isIE) {
            $('#BookAppointment').removeClass('fade');
        }
        $("#fullCalModal").modal();
    });

    function request(url) {
        var url = url;
        $.ajax({
            //Send request
            type: 'GET',
            data: {},
            url: url,
            success: function (data) {
                $("#loader").hide();
                $("#ajaxcontainer").html(data);

                $("#fullCalModal").modal();
            }
        });
    }
</script>
