<?php
defined('BASEPATH') or exit('No direct script access allowed');
// session_start();
class MDefault extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
        $this->load->model('MDefault_model', 'def');
    }

    public function index(){
        $data['judul'] = "Default";
        if($this->session->userdata("id") == null){
            redirect('Auth');
        }elseif($this->auth->getUser($this->session->userdata("id")) == 1){
            redirect('Dashboard');
        }
        $data['default'] = $this->def->getDefault();
        $this->load->view("Template/header_m", $data);
        $this->load->view("MDefault/index", $data);
        $this->load->view("Template/footer_m");
    }

    public function updateDefault(){
        $this->form_validation->set_rules('harga', 'Username', 'trim|required');
        $this->form_validation->set_rules('harga_faktur', 'Password lama', 'trim|required');
        $this->form_validation->set_rules('pph', 'Password baru', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Konfirmasi password baru', 'trim|required');
        $this->form_validation->set_rules('barang', 'Konfirmasi password baru', 'trim|required');

        if ($this->form_validation->run()) {

            $ary = array(
                'id' => "df-Bgh6Fv56D",
                'harga' => $this->input->post('harga'),
                'harga_faktur' => $this->input->post('harga_faktur'),
                'pph' => $this->input->post('pph'),
                'keterangan' => $this->input->post('keterangan'),
                'barang' => $this->input->post('barang')
            );

            if($this->def->updateDefault($ary)){
                $this->session->set_flashdata('notif', '<small id="idNotif"
                class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil memperbarui data</small>');
                redirect('MDefault');
            }else{
                $this->session->set_flashdata('notif', '<small id="idNotif"
                class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data</small>');
                redirect('MDefault');
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data, data harus lengkap dan sesuai</small>');
            redirect('MDefault');
        }
    }
}