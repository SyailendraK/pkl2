<?php
defined('BASEPATH') or exit('No direct script access allowed');
// session_start();
class Dashboard extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
    }

    public function index(){
        $data['judul'] = "Dashboard";
        if($this->session->userdata("id") == null){
            redirect('Auth');
        }elseif($this->auth->getUser($this->session->userdata("id")) == 2){
            redirect('MDashboard');
        }

        if(isset($_SESSION['id'])){
            $this->load->view("Template/header", $data);
            // var_dump($data['list']);die;
            $this->load->view("Dashboard/index");

            $this->load->view("Template/footer");
        }else{
            echo "gagal";
        }
    }
}