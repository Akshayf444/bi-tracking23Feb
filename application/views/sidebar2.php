<ul class="nav nav-pills nav-stacked" style="border-right: 1px solid #cccccc;">
    <li style="line-height: 12px;"><a href="<?php echo site_url('User/home'); ?>">Home</a></li>
    <li style="line-height: 12px;"><a href="<?php echo site_url('User/view'); ?>">Profile</a>
        <ul class="sub-menu2 ">
            <li><a href="<?php echo site_url('User/view'); ?>">Personal Details</a></li>
            <li><a href="<?php echo site_url('User/view'); ?>">Work Exp</a></li>
            <li><a href="<?php echo site_url('User/view'); ?>">Skills</a></li>
            <li><a href="<?php echo site_url('User/view'); ?>">Certification</a></li>
            <li><a href="<?php echo site_url('User/view'); ?>">Resume</a></li>

        </ul>    
    </li>
    <li style="line-height: 12px;"><a href="#">Inbox</a>
        <ul class="sub-menu2 "><li><a href="<?php echo site_url('User/Comingsoon'); ?>">Job Alerts</a></li>
            <li><a href="<?php echo site_url('User/Comingsoon'); ?>">Recruiters Mail</a></li>
        </ul>
    </li>
    <li style="line-height: 12px;"><a href="#">Jobs &amp; Application</a>
        <ul class="sub-menu2 ">
            <li><a href="<?php echo site_url('User/Comingsoon'); ?>">Matched Jobs</a></li>
            <li><a href="<?php echo site_url('User/Comingsoon'); ?>">Other Suggested Jobs</a></li>
            <li><a href="<?php echo site_url('User/Comingsoon'); ?>">Who Viewed My Profile</a></li>
            <li><a href="<?php echo site_url('User/Comingsoon'); ?>">Applied Jobs</a></li>
        </ul>
    </li>
    <li style="line-height: 12px;"><a href="<?php echo site_url(); ?>">Other</a>
        <ul class="sub-menu2 ">
            <li><a href="<?php echo site_url('User/Comingsoon'); ?>">My Job Alerts</a></li>
            <li><a href="<?php echo site_url('User/Comingsoon'); ?>">Desired Job Details</a></li>
            <li><a href="<?php echo site_url('User/Comingsoon'); ?>">Account Setting</a></li>
        </ul>
    </li>

    <li style="line-height: 12px;"><a href="<?php echo site_url('User/logout'); ?>">Logout</a></li>                                </ul>