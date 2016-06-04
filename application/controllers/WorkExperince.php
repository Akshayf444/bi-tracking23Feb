<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class WorkExperince extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('WorkExperince_model');
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

    public function work_exp() {
        $this->load->model('Master_model');
        if ($this->is_logged_in() == TRUE) {
            $user_id = $this->session->userdata("user_id");
            if ($this->input->post()) {

                $this->form_validation->set_rules('employer_name', 'employer_name', 'trim|required');
                $this->form_validation->set_rules('employer_type', 'employer_type', 'trim|required');
                $this->form_validation->set_rules('from', 'from', 'trim|required');
                $this->form_validation->set_rules('to', 'to', 'trim|required');
                $this->form_validation->set_rules('designation', 'designation', 'trim|required');
                $this->form_validation->set_rules('job_profile', 'job_profile', 'trim|required');
                $check['show'] = $this->WorkExperince_model->work_by_id($user_id);
                if ($this->form_validation->run() === True) {
                    if (!empty($check)) {
                        $data = $this->WorkExperince_model->add($user_id);
                        redirect('WorkExperince/work_exp', 'refresh');
                    }
//                    else {
//                        $data = $this->WorkExperince_model->update($user_id);
//                        redirect('WorkExperince/work_exp', 'refresh');
//                    }
                }
            }
            $check['show'] = $this->WorkExperince_model->work_by_id($user_id);
           // var_dump($check);
            $data = array('title' => 'Basic Profile', 'content' => 'User/work_experince', 'view_data' => $check);
            $this->load->view('template1', $data);
        } else {
            redirect('User/login', 'refresh');
        }
    }

}
