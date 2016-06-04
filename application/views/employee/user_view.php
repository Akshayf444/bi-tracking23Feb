<h3 class="page-header"> Applied User View</h3>

<div class="row"><?php // echo form_open_multipart('Upload/resume');           ?></div>
<?php
//foreach ($user as $u) : 
if(!empty($user))
{
?>
<div class="row">
    <h3 align="center"><u>Basic Detail</u></h3>

    <dl></dl>
    <div class="col-lg-6">

        <dl >
            <dt><?php echo $user['name']; ?></dt>
            <dt  >
            <label style="    opacity: 0.5">Resume Headline :</label><?php echo $user['resume_headline']; ?>
            </dt>   
            <dt>
            <label style="    opacity: 0.5">Current Designation :</label><span><?php echo $user['designation']; ?></span>
            </dt>   
            <dt>
            <label style="    opacity: 0.5">Current Location :</label><span><?php echo $user['loc']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Prefered Location :</label><span><?php echo $user['location']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Function Area :</label><span><?php echo $user['fun_area']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Role :</label><span><?php echo $user['role']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Industry :</label><span><?php echo $user['industry']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Date Of Birth :</label><span><?php echo date('M-d-Y', strtotime($user['dob'])); ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Gender :</label><span><?php echo $user['gender']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Key Skill :</label><span><?php echo $user['key_skill']; ?></span>
            </dt>

        </dl>
    </div>
    <div class="col-lg-6">
        <dl>
            <dt>
            <label style="    opacity: 0.5">Total Experince :</label><span><?php echo $user['exp_year'] . "year"; ?> <?php echo $user['experince_month'] . "month"; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Highest Qualification :</label><span><?php echo $user['qualification']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Mobile Number :</label><span><?php echo $user['mobile']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Email :</label><span><?php echo $user['email']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Permanent Address :</label><span><?php echo $user['address1']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">City :</label><span><?php echo $user['city']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Pincode :</label><span><?php echo $user['pincode']; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Maritial Status :</label><span><?php echo $user['marital_status']; ?></span>
            </dt>
        </dl>
    </div>
</div>


<?php
}
else{
//endforeach 
?>
<h1><?php echo $user5;?></h1>
<?php } ?>
<hr class="page-header">
<h3 align="center"><u>Project Detail</u></h3>

<?php
if(!empty($user2))
{
foreach ($user2 as $u) :
?>
<div class="row">
    <div class="col-lg-12">
        <div>

        </div>

    </div>
</div>

<div class="row">

    <div class="col-lg-6">
        <dl>
            <dt>
            <label style="    opacity: 0.5">Project Title :</label><span><?php echo $u->projects_title; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Client :</label><span><?php echo $u->client; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Employement Type :</label><span><?php echo $u->type; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Projects Location :</label><span><?php echo $u->location; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Role :</label><span><?php echo $u->role; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Skill Used :</label><span><?php echo $u->skill; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Role Discription :</label><span><?php echo $u->role_description; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Project Detail :</label><span><?php echo $u->detail; ?></span>
            </dt>
        </dl>
    </div>
    <div class="col-lg-6">
        <dl>
            <dt>
            <label style="    opacity: 0.5">Duration :</label><span><?php echo date('M-Y', strtotime($u->from)); ?> - <?php echo date('M-Y', strtotime($u->to)); ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Sight :</label><span><?php echo $u->site; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Team Size :</label><span><?php echo $u->team_size; ?></span>
            </dt>

        </dl>
    </div>

</div>
<hr style="border:1px solid;    opacity: 0.2;">
<?php endforeach;
}
else{
?>
<h1><?php echo $user5;?></h1>
<?php } ?>
<hr class="page-header">
<h3 align="center"><u>Education Detail</u></h3>

<?php
if(!empty($user3))
{
foreach ($user3 as $u) :
?>
<div class="row">
    <div class="col-lg-12">


    </div>
</div>
<div class="row">

    <div class="col-lg-6">
        <dl>
            <dt>
            <label style="    opacity: 0.5">Qualification :</label><span><?php echo $u->qualification; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Specialization :</label><span><?php echo $u->specialization; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Institute :</label><span><?php echo $u->institute; ?></span>
            </dt>
            <dt>
            <label style="    opacity: 0.5">Year :</label><span><?php echo $u->year; ?></span>
            </dt>

        </dl>
    </div>


</div>
<hr style="border:1px solid;    opacity: 0.2;">

<?php
endforeach;

}
else{
?>
<h1><?php echo $user5;?></h1>
<?php } ?>
<hr class="page-header">
<?php if(!empty($user4['resume'])){?>
<div class="row">
    <h3 align="center"><u>Resume</u></h3>
</div>
<div align="center" class="row">

    <a href="<?php echo (base_url().'assets/Resume/'. $user4['resume']) ?>"><button class="btn btn-success">Download Resume</button></a>
</div>
<?php
}
else
{
?>
<h1><?php echo $user5;?></h1>
<?php }?>