<?php
defined('BASEPATH') or exit('No direct script access allowed');
// session_start();
class MDashboard extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Auth_model', 'admin');
        $this->load->model('Auth_model', 'auth');

    }

    public function index(){
        $data['judul'] = "Manager Dashboard";
        if($this->session->userdata("id") == null){
            redirect('Auth');
        }elseif($this->auth->getUser($this->session->userdata("id")) == 1){
            redirect('Dashboard');
        }

        if(isset($_SESSION['id'])){
            $this->load->view("Template/header_m", $data);
            // var_dump($data['list']);die;
            $this->load->view("Manager/index");

            $this->load->view("Template/footer_m");
        }else{
            echo "gagal";
        }
    }
}