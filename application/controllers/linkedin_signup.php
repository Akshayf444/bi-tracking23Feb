<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Linkedin_signup extends CI_Controller {

    public $backurl;
    public $appKey;
    public $appSecret;
    public $apiUrl = 'http://pharmatalent.in/index.php/Api/';

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->backurl = site_url('Linkedin_signup/data');
        $this->appKey = '75c8ppycrlgu4x';
        $this->appSecret = '6wojf1dYyvobjY4X';
    }

    function index() {
        echo '<form id="linkedin_connect_form" action="' . site_url('Linkedin_signup/initiate') . '" method="post">';
        echo '<input type="submit" value="Login with LinkedIn" />';
        echo '</form>';
    }

    function initiate() {

        // setup before redirecting to Linkedin for authentication.
        $linkedin_config = array(
            'appKey' => $this->appKey,
            'appSecret' => $this->appSecret,
            'callbackUrl' => $this->backurl
        );

        $this->load->library('linkedin', $linkedin_config);
        $this->linkedin->setResponseFormat(LINKEDIN::_RESPONSE_JSON);
        $token = $this->linkedin->retrieveTokenRequest();

        $this->session->set_flashdata('oauth_request_token_secret', $token['linkedin']['oauth_token_secret']);
        $this->session->set_flashdata('oauth_request_token', $token['linkedin']['oauth_token']);

        $link = "https://api.linkedin.com/uas/oauth/authorize?oauth_token=" . $token['linkedin']['oauth_token'];
        redirect($link);
    }

    function cancel() {

        // See https://developer.linkedin.com/documents/authentication
        // You need to set the 'OAuth Cancel Redirect URL' parameter to <your URL>/linkedin_signup/cancel

        echo 'Linkedin user cancelled login';
    }

    function logout() {
        session_unset();
        $_SESSION = array();
        echo "Logout successful";
    }

    function data() {
        $this->load->model('User_model');
        $linkedin_config = array(
            'appKey' => $this->appKey,
            'appSecret' => $this->appSecret,
            'callbackUrl' => $this->backurl
        );

        $this->load->library('linkedin', $linkedin_config);
        $this->linkedin->setResponseFormat(LINKEDIN::_RESPONSE_JSON);

        $oauth_token = $this->session->flashdata('oauth_request_token');
        $oauth_token_secret = $this->session->flashdata('oauth_request_token_secret');

        $oauth_verifier = $this->input->get('oauth_verifier');
        $response = $this->linkedin->retrieveTokenAccess($oauth_token, $oauth_token_secret, $oauth_verifier);

        // ok if we are good then proceed to retrieve the data from Linkedin
        if ($response['success'] === TRUE) {
            //var_dump($response);
            // From this part onward it is up to you on how you want to store/manipulate the data 
            $oauth_expires_in = $response['linkedin']['oauth_expires_in'];
            $oauth_authorization_expires_in = $response['linkedin']['oauth_authorization_expires_in'];

            $response = $this->linkedin->setTokenAccess($response['linkedin']);
            $profile = $this->linkedin->profile('~:(id,first-name,last-name,picture-url,email-address)');
            $profile_connections = $this->linkedin->profile('~/connections:(id,first-name,last-name,picture-url,industry,email-address)');
            //$education = $this->linkedin->profile('~/educations:(id,school-name,field-of-study,start-date,end-date,degree,activities,notes)');
            //$skills = $this->linkedin->profile('~/skills:(id,skill:(name))');
            $user = json_decode($profile['linkedin']);
            //var_dump($user);
            //var_dump($education);
            //var_dump($skills);

            $user_array = array('linkedin_id' => $user->id, 'second_name' => $user->lastName, 'profile_picture' => $user->pictureUrl, 'first_name' => $user->firstName, 'email_address' => $user->emailAddress);
            if (!empty($user)) {
                $check = $this->User_model->find_by_email2($user->emailAddress);
                //var_dump($check);
                if (empty($check)) {
                    /// New Registration
                    $this->session->set_userdata('linkedinemail', $user->emailAddress);
                    $this->session->set_userdata('linkedinname', $user->firstName . " " . $user->lastName);

                    redirect('User/linkedInRegister', 'refresh');
                } elseif (!empty($check)) {
                    if (strtolower($check['type']) == 'user') {
                        $this->session->set_userdata("user_id", $check['auth_id']);
                        $this->session->set_userdata("user_email", $check['email']);
                        $this->session->set_userdata("user_mobile", $check['mobile']);
                        $this->session->set_userdata("user_type", $check['type']);
                        $check1['User'] = $this->User_model->find_by_id($check['auth_id']);
                        //$this->load->view('User/success');
                        redirect('User/home', 'refresh');
                    }
                }
            }
        } else {
            // bad token request, display diagnostic information
            echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br />" . print_r($response, TRUE);
        }
    }

    function linkedInRegistration() {
        $this->load->model('User_model');
        if ($this->input->post()) {
            $check = $this->User_model->find_by_email($this->input->post('email'), $this->input->post('mobile'));
            if (empty($check)) {
                $field_array = array(
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                    'type' => 'User'
                );

                /////Create New User Adding Entry In Authentication Table
                $id = $this->User_model->create($field_array);
                //echo $id;
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'auth_id' => $id,
                    'updated_at' => date('Y-m-d H:i:s'),
                );

                /////////Insert Basic Profile
                $this->User_model->Add_detail($id, $data);
            } else {
                $dropdown['Error'] = 'Already Registered';
            }
        }
    }

}
