<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        if($this->session->userdata('username')=="") {
            redirect('login_user/loginpage');
        }
        $this->load->helper('text');
    }

    public function index() {
        $this->load->view('admin/layout/header');
        $data['username'] = $this->session->userdata('username');
        $this->load->view('admin/admin_index', $data);
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        session_destroy();
        redirect('login_user/loginpage');
    }
}