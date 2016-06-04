<?php

$Sidebar = array(
    'My Talent' => array(
        'Profile' => 'Employee/add_details',
    ),
    'Jobs & Responses' => array(
        'Post A Hot Vacancy' => 'Job/add',
        'Jobs And Responses' => 'Job/job_list',
       
    ),
    'Search' => array(
        'Resume Writing Servies' => 'User/Comingsoon',
        'Linked In Profile Writing' => 'User/Comingsoon',
        'Value Packs' => 'User/Comingsoon',
        'Cover Letter Samples' => 'User/Comingsoon',
    ),
    
    'Account Settings' => array(
        'Change Password' => 'Employee/changepassword',
        'Logout' => 'Employee/logout')
);
if (!empty($Sidebar)) {
    foreach ($Sidebar as $menu => $submenu) {
        if (isset($submenu) && is_string($submenu)) {
            echo '<li><a href="' . site_url($submenu) . '">' . $menu . '</a>';
        } else {
            echo '<li><a href="#">' . $menu . '</a>';
        }


        if (isset($submenu) && is_array($submenu) && !empty($submenu)) {
            echo '<ul class="sub-menu">';
            foreach ($submenu as $name => $link) {
                echo '<li><a href="' . site_url($link) . '">' . $name . '</a></li>';
            }
            echo '</ul>';
        }


        echo '</li>';
    }
}