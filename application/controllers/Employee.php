<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('User_model');
        $this->load->helper('file');
        $this->load->helper('download');
    }

    public function Home() {
        $data = array('title' => 'Login', 'content' => 'employee/home', 'view_data' => 'Blank');
        $this->load->view('frontTemplate4', $data);
    }

    public function register() {
        $this->load->model('User_model');
        $this->load->model('address_model');
        $this->load->model('Master_model');
        $this->load->model('Sms_model');
        if ($this->input->post()) {
            $check = $this->User_model->find_by_email($this->input->post('email'), $this->input->post('mobile'));
            $check2 = $this->employee_model->find_email_emp($this->input->post('email'), $this->input->post('mobile'));
            if (empty($check) && empty($check2)) {
                $password = $this->input->post('password');
                $field_array = array(
                    'email' => $this->input->post('email'),
                    'password' => md5($password),
                    'mobile' => $this->input->post('mobile'),
                    'type' => 'Employee'
                );

                /////Create New User Adding Entry In Authentication Table
                $id = $this->User_model->create($field_array);
                //echo $id;
                $data = array(
                    'name' => $this->input->post('name'),
                    'contact_person' => $this->input->post('Contactperson'),
                    'email' => $this->input->post('email'),
                    'mobile' => $this->input->post('mobile'),
                    'auth_id' => $id,
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $mobile = $this->input->post('mobile');
                $ver_code = $this->input->post('ver_code');
                /////////Insert Basic Profile
                $result = $this->employee_model->Add_detail($id, $data);
                $this->load->model('Sms_model');

                if (!empty($result)) {
                    $this->db->where(array('mobile' => $mobile));
                    $this->db->update('mobile_register', array('mobile' => $mobile, 'ver_code' => $ver_code, 'is_verified' => 1));
                    $this->session->set_userdata("user_id", $id);
                    $this->session->set_userdata("user_email", $this->input->post('email'));
                    $this->session->set_userdata("user_mobile", $this->input->post('mobile'));
                    $this->session->set_userdata("user_type", 'Employee');
                    $redirect_url = $this->session->userdata('redirect_url');
                    if (isset($redirect_url) && $redirect_url != '') {
                        header("Location:" . $redirect_url);
                    } else {
                        redirect('Job/job_list', 'refresh');
                    }
                }
                $dropdown['Error'] = '<p class="alert alert-success">Thank You . Registered Successfully</p>';

            } else {
                $this->session->unset_userdata("linkedinemail");
                $this->session->unset_userdata("linkedinname");
                $dropdown['Error'] = '<p class="alert alert-danger">Already Registered</p>';
            }
        }
        $dropdown['dropdowns'] = $this->Master_model->getQualification();
        $dropdown['institute'] = $this->Master_model->getInstitute();
        $dropdown['location'] = $this->Master_model->getLocation();
        $data = array('title' => 'Login', 'content' => 'employee/registration', 'view_data' => $dropdown);
        $this->load->view('frontTemplate4', $data);
    }

    public function login() {

        if ($this->input->post()) {
            $new = $_POST['email'];
            $pass = md5($_POST['password']);
            $check = $this->employee_model->log($new, $pass);
            if (!empty($check) && $check['type'] == 'Employee') {
                $this->session->set_userdata("user_id", $check['auth_id']);
                $this->session->set_userdata("user_email", $check['email']);
                $this->session->set_userdata("user_mobile", $check['mobile']);
                $this->session->set_userdata("user_type", $check['type']);
                $check1['User'] = $this->employee_model->find_by_id($check['auth_id']);
                //$this->load->view('Employe/view');
                redirect('Job/job_list', 'refresh');
            } else {
                $data1['user'] = "Incorrect Login";
                // $this->load->view('employee/error');
            }
        }
        $data1['user2'] = "";
        $data = array('title' => 'Login', 'content' => 'employee/login', 'view_data' => $data1);
        $this->load->view('frontTemplate4', $data);
//         
    }

    public function logout() {
        $this->session->unset_userdata("user_id");
        $this->session->unset_userdata("user_email");
        $this->session->unset_userdata("user_mobile");
        $this->session->unset_userdata("user_type");
        redirect('Employee/home', 'refresh');
    }

    public function is_logged_in() {
        //$is_logged_in = $this->session->userdata('user_id');
        if (isset($this->user_id) && $this->user_id != '') {
            return TRUE;
        } else {
            return FALSE;
        }
    }
public function search_specific(){
    $this->load->model('Master_model');
       $this->load->model('Master_model');
            $data['location'] = $this->Master_model->getLocation();
            $data['experience'] = $this->Master_model->getWorkExperience();
            $data['industry'] = $this->Master_model->getIndustry();
            $data['functional_area'] = $this->Master_model->getFunctionArea();
        $userdata = array('title' => 'Search Job', 'content' => 'employee/job_search', 'view_data' => $data);
        $this->load->view('frontTemplate4', $userdata);
}
    public function add_details() {
        if ($this->is_logged_in() == TRUE) {
            $user_id = $this->session->userdata("user_id");
            $this->load->model('Master_model');

            if ($this->input->post()) {
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('type', 'type', 'required');
                $this->form_validation->set_rules('industry_type', 'industry_type', 'required');
                $this->form_validation->set_rules('address1', 'address1', 'required');
                $this->form_validation->set_rules('state', 'state', 'required');
                $this->form_validation->set_rules('city', 'city', 'required');
                $this->form_validation->set_rules('pincode', 'pincode', 'required');
                $this->form_validation->set_rules('designation', 'designation', 'required');

                if ($this->form_validation->run() === True) {
                    $this->employee_model->add_details($user_id);
                    $this->load->model('address_model');
                    $this->address_model->add_address($user_id);
                }
//                $this->load->view('empolyee/success');
            }
            $details = $this->employee_model->find_id($user_id);
            $userData['user'] = $details;
            $userData['industry'] = isset($details['industry_type']) ? $this->Master_model->getIndustry($details['industry_type']) : $this->Master_model->getIndustry();
            $userData['user_id'] = $user_id;
            $data = array('title' => 'Basic Employee Profile', 'content' => 'employee/add_details', 'view_data' => $userData);
            $this->load->view('frontTemplate5', $data);
        } else {
            redirect('employee/login', 'refresh');
        }
    }

    public function add_pincode() {
        if (isset($_GET['pincode'])) {
            $pin = $_GET['pincode'];
            $state = file_get_contents("http://chemistconnect.co/ccwebservice.asmx/GetPincodeData?pincode={$pin}");

            echo $state;
        }
    }

    public function profile() {

        $user_id = $this->session->userdata("user_id");
        //$userData['user2'] = $this->session->userdata("mobile");
        $userData['user'] = $this->employee_model->profile($user_id);
        $data = array('title' => 'Basic Employee Profile', 'content' => 'employee/view', 'view_data' => $userData);
        $this->load->view('template1', $data);
    }

    public function Applied() {
        if ($this->is_logged_in() == TRUE) {
            $this->load->model('Master_model');
            $user_id = $this->session->userdata("user_id");
            if ($this->input->post()) {
                
            }

            $data = array('title' => 'Job Search', 'content' => 'employee/applied', 'view_data' => 'blank');
            $this->load->view('template1', $data);
        } else {
            redirect('Employee/login', 'refresh');
        }
    }

    public function User_view() {
        if ($this->is_logged_in() == TRUE) {
            $this->load->model('Master_model');
            $this->load->model('User_model');
            $this->load->model('Job_model');
            $id = $_GET['id'];
            $view['user'] = $this->Job_model->user_applied($id);
            $view['user2'] = $this->User_model->view2($id);
            $view['user3'] = $this->User_model->qualification_view($id);
            $view['user4'] = $this->User_model->user_resume($id);
            $view['user5'] = "Detail not found";
//            var_dump($view);
//          $view['string'] = read_file('../../Resume/'.$view['user4']);
            $user_id = $this->session->userdata("user_id");
            $data_new = array(
                'visitor_id' => $user_id,
                'jobseeker_id' => $id,
                'visited_at' => date('Y-m-d H:i:s'),
            );
            $check = $this->employee_model->vefication_check($id, $user_id);
            if (empty($check)) {
                $insert = $this->employee_model->email_verification($data_new);
            } else {
                
            }
            $data = array('title' => 'User View', 'content' => 'employee/user_view', 'view_data' => $view);
            $this->load->view('template1', $data);
        } else {
            redirect('Employee/login', 'refresh');
        }
    }

    public function download() {
        if ($this->is_logged_in() == TRUE) {
            $this->load->model('Master_model');
            $this->load->model('User_model');
            $this->load->model('Job_model');
            $id = $_GET['id'];
            $data = file_get_contents(base_url() . "assets/Resume/$id"); // Read the file's contents
            $name = $id;
            echo $name;
            force_download($name, $data);
            $this->load->view('donload complete');
        } else {
            redirect('Employee/login', 'refresh');
        }
    }

    public function resumesearch() {
        if ($this->is_logged_in() == TRUE) {
            $this->load->model('Master_model');
            $this->load->model('User_model');
            $this->load->model('Job_model');

            $data['dropdowns'] = $this->Master_model->getLocation();
            $data = array('title' => 'User View', 'content' => 'employee/SearchResume', 'view_data' => $data);
            $this->load->view('template1', $data);
        } else {
            redirect('Employee/login', 'refresh');
        }
    }

    public function resumesearchview() {
        if ($this->is_logged_in() == TRUE) {
            $this->load->model('Master_model');
            $this->load->model('Job_model');
            $user_id = $this->session->userdata("user_id");
            if ($this->input->post()) {
                $this->form_validation->set_rules('location', 'location', 'required');
                $this->form_validation->set_rules('skill', 'skill', 'required');
                $check['view'] = $this->Job_model->resume_search_view($this->input->post('location'), $this->input->post('skill'));
            }

            $data = array('title' => 'Job Search', 'content' => 'employee/Resume_Search_View', 'view_data' => $check);
            $this->load->view('template1', $data);
        } else {
            redirect('Employee/login', 'refresh');
        }
    }

    public function changepassword() {
        if ($this->is_logged_in() == TRUE) {
            $this->load->model('Master_model');
            $this->load->model('User_model');
            $user_id = $this->session->userdata("user_id");
            if ($this->input->post()) {
                $this->form_validation->set_rules('old_password', 'password', 'trim|required');
                $this->form_validation->set_rules('password', 'password', 'trim|required');
                $check = $this->User_model->find_by_id($user_id);
                if ($this->form_validation->run() === True) {

                    $data = array(
                        'password' => md5($this->input->post('password')),
                    );

                    if ($check['password'] == md5($this->input->post('old_password'))) {
                        $add = $this->User_model->changepassword($data, $user_id);
                        redirect('Employee/changepassword', 'refresh');
                    } else {
                        $er['error'] = "Wrong Previous Password";
                    }
                }
            }
            $er['errrrr'] = "";
            $data = array('title' => 'Job Search', 'content' => 'Employee/changepassword', 'view_data' => $er);
            $this->load->view('frontTemplate5', $data);
        } else {
            redirect('User/login', 'refresh');
        }
    }
    
    public function dashboard(){
        
    }

}
