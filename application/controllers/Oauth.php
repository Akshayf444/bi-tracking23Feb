<?php

class Oauth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('oauthclient'));

        $this->oauthclient->setOauthDataStore("user_oauth");
        $this->oauthclient->setService("linkedin");
        $this->oauthclient->setConsumerKey("75c8ppycrlgu4x");
        $this->oauthclient->setConsumerSecret("6wojf1dYyvobjY4X");
        $this->oauthclient->setResponseUrl(site_url('Oauth/response'));
    }

    function index() {
        redirect('/Oauth/connect/');
    }

    function connect() {
        $this->oauthclient->connect();
    }

    function response() {
        $userId = $this->oauthclient->response();
        print "<p>User ID " . $userId . " is logged in.</p>";

        print "<a href=\"/Oauth/profile/" . $userId . "\">View user profile.</a>";
    }

    function profile($userId = 1) {
        $this->oauthclient->setUserId($userId);
        $xmlProfile = $this->oauthclient->getProfile();
        print "<h1>User profile</h1>";
        print "<pre>";
        print_r($xmlProfile);
        print "</pre>";
    }

    function cancel() {
        redirect('User/logout');
    }

}
