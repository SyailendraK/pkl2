<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'admin');
    }

    public function index()
    {
        // var_dump($config['base_url']);die;
        if($this->session->userdata("id") != null){
            $lv = $this->admin->getUser($this->session->userdata("id"));
            if($lv == 1){
                redirect('Dashboard');
            }elseif($lv == 2){
                redirect('MDashboard');
            }
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('login/index');
        } else {
            $this->login();
        }
    }

    public function login(){
        $data['username'] = htmlspecialchars($this->input->post('username'));
            $data['password'] = $this->input->post('pass');

            $cek = $this->admin->verify($data);
            if ($cek == null) {
                $this->session->set_flashdata('auth', '<small
                class="badge badge-danger py-2 my-2 d-flex justify-content-center mx-auto text-center" style="color: white; border-radius: 10px;">Username / password salah</small>');
                redirect('Auth');
            } else {
                $this->session->set_userdata('id', $cek[0]['id']);
                if($this->session->userdata('print') == null){
                    $this->session->set_userdata('print',[]);
                }
                $this->session->set_flashdata('auth', '<small
                class="badge badge-success py-2 my-2 d-flex justify-content-center mx-auto text-center" style="color: white; border-radius: 10px;">Berhasil login</small>');
                if($cek[0]['level'] == 1){
                    redirect('Dashboard');
                }else{
                    redirect('MDashboard');
                }
            }
    }

    public function logout()
    {
        $_SESSION = null;
        session_destroy();
        redirect('Auth');
    }

}
