<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        $this->loadFinalView(array('slider','Home'));
        //$this->load->view('welcome_message');
    }

}
