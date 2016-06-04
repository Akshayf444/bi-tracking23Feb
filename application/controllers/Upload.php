<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('WorkExperince_model');
    }

    public function resume() {
        if ($this->is_logged_in() == TRUE) {
            if ($this->input->post()) {
                $user_id = $this->session->userdata('user_id');
                $config['upload_path'] = 'C:\wamp\www\jobportal\application\Resume'; //path where to save in the systme
                $config['allowed_types'] = 'doc|docx|pdf'; //file types to accept while uplaoding
                $config['max_size'] = '10240';  //size limit

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('resume')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('User/resume', $error);
                } else {
                    $data = array('upload_data' => $this->upload->data());

                    $this->load->view('User/resume', $data);
                    $this->Upload_modal->add($user_id);
                }
            }

            $data = array('title' => 'Resume Upload', 'content' => 'User/resume', 'view_data' => 'blank');
            $this->load->view('template1', $data);
        } else {
            redirect('User/login', 'refresh');
        }
    }

    public function is_logged_in() {
        $is_logged_in = $this->session->userdata('user_id');
        if (isset($is_logged_in) && $is_logged_in != '') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function logout() {

        $this->session->unset_userdata("user_id");
        $this->session->unset_userdata("user_email");
        $this->session->unset_userdata("user_mobile");
        $this->session->unset_userdata("user_type");
//        $this->session->session_destroy();
        redirect('User/login', 'refresh');
    }

}
