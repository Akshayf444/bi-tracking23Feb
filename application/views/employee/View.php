<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Profile Snapshot</h3>
        <a href="add_details"  class="pull-right"> <button class="btn btn-primary">Edit</button></a></div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p><b>  Name </b>  &nbsp;<?php
            if ($user['name'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['name'];
            }
            ?></p>

        <p><b> Type </b>  &nbsp;
            <?php
            if ($user['type'] == 1) {
                echo 'Consultancy';
            } else {
                echo 'Company';
            }
            ?>
        </p>

        <p> <b> Industry Type </b> &nbsp; <?php
            if ($user['industry'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['industry'];
            }
            ?></p>

        <p><b> Contact Person </b>  &nbsp; <?php
            if ($user['contact_person'] == '') {
                echo ' Not Mention';
            } else {

                echo $user['contact_person'];
            }
            ?></p>
        <p><b> Contact Number </b>  &nbsp;<?php
            if ($this->session->userdata('user_mobile') == '') {
                echo ' Not Mention';
            } else {
                echo ($this->session->userdata('user_mobile'));
            }
            ?></p>


        <p><b> Designation </b>  &nbsp;<?php
            if ($user['designation'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['designation'];
            }
            ?></p>

        <p><b> Address </b> &nbsp;<?php
            if ($user['address1'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['address1'];
            }
            ?></p>

        <p><b> Pincode </b> &nbsp;<?php
            if ($user['pincode'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['pincode'];
            }
            ?></p>

        <p> <b> State </b> &nbsp;<?php
            if ($user['state'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['state'];
            }
            ?></p>

        <p><b> City </b>  &nbsp;<?php
            if ($user['city'] == '') {
                echo ' Not Mention';
            } else {
                echo $user['city'];
            }
            ?></p>


    </div>
</div>









