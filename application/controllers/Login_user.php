<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->model('model_user'); // load model_user
    }

    public function index() {
        $this->load->view('login_view');
    }
    
    public function loginpage() {
        $this->load->view('login_view');
    }
    public function register() {
        $this->load->view('register_view');
    }

    // fungsi pengecekan register
    public function cekregister() {

        // Atur validasi
        $this->form_validation->set_rules('user', 'Username', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');

        // Atur tag css untuk hasil validasi
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

        
        if ($this->form_validation->run() == FALSE)
        {
        $this->load->view('register_view');
        }
        else
        {
            $user= $this->input->post('user');
            $pass = md5($this->input->post('pass'));
            $level= $this->input->post('level');
            $this->model_user->prosesregister($user,$pass, $level);
            redirect('login_user/loginpage');
        }
    }
    public function cek_login() {
        $data = array('username' => $this->input->post('username', TRUE),
                        'password' => md5($this->input->post('password', TRUE))
            );
        $hasil = $this->model_user->cek_user($data);
        if ($hasil->num_rows() == 1) {
            foreach ($hasil->result() as $sess) {
                $sess_data['logged_in'] = 'Sudah Loggin';
                $sess_data['uid'] = $sess->uid;
                $sess_data['username'] = $sess->username;
                $sess_data['level'] = $sess->level;
                $this->session->set_userdata($sess_data);
            }
            if ($this->session->userdata('level')=='admin') {
                redirect('admin/dashboard');
            }
            elseif ($this->session->userdata('level')=='anggota') {
                redirect('member/dashboard');
            }        
        }
        else {
            $this->session->set_flashdata('message', 'anda Gagal Login...!!!');
            redirect('login_user/loginpage');
        }
    }
}