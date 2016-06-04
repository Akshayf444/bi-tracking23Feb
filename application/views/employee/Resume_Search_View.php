<h3 class="page-header">Resume Search Result's</h3>
<?php foreach ($view as $u): ?>
    <div class="row">
        <div class="col-lg-11 panel panel-default">
<!--            <div class="col-lg-10">
                <b>Title </b> &nbsp;  <?php echo $u->title; ?>
            </div>-->
            <div class="col-lg-10">
                <a href="<?php echo site_url('Employee/User_view/?id=' . $u->auth_id) ?>"><b> Name</b> &nbsp;  <?php echo $u->name; ?></a>
            </div>
            <div class="col-lg-10">
                <b> Email</b> &nbsp;  <?php echo $u->email; ?>
            </div>
            <div class="col-lg-10">
                <b> Mobile</b> &nbsp;  <?php echo $u->mobile; ?>
            </div>
        </div>
        
    </div>

<?php
endforeach;
//print_r($this->session->all_userdata());
?>