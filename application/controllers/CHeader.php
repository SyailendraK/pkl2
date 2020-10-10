<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CHeader extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Nota_model', 'nota');
        $this->load->model('Header_model', 'head');
        $this->load->helper('string');
    }

    public function hapusPrint($data,$page){
        $id = explode("~",$data);
        // var_dump($id);die;
        unset($_SESSION['print'][$id[0]]);
        // header("Refresh:");
        redirect($id[1].'/index/'.$page);
    }

    public function hapusSemuaPrint($data,$page){
        $_SESSION['print'] = [];
        redirect($data.'/index/'.$page);
    }

    public function search($type){
        $this->session->set_userdata('search', $this->input->get('search'));
        redirect($type.'/index/0');
    }

    public function profile(){
        $data['judul'] = "Profile";
        $data['profile'] = $this->head->profile($this->session->get_userdata('id')['id']);

        $this->load->view("Template/header", $data);
        $this->load->view("Profile/index", $data);
        $this->load->view("Template/footer");
    }

    public function updateProfile(){
        $id = $this->session->get_userdata('id')['id'];

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('passLama', 'Password lama', 'trim|required');
        $this->form_validation->set_rules('pass', 'Password baru', 'trim|required');
        $this->form_validation->set_rules('pass2', 'Konfirmasi password baru', 'trim|required|matches[pass]');

        $cek = $this->head->validate($id,$this->input->post('passLama'),$this->input->post('username'));

        if ($this->form_validation->run() && $cek) {

            $ary = [
                'id' => $id,
                'username' => $this->input->post('username'),
                'password' => $this->input->post('pass'),
                'level' => 1
            ];

            if($this->head->updateProfile($ary)){
                $this->session->set_flashdata('notif', '<small id="idNotif"
                class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil memperbarui data</small>');
                redirect('CHeader/profile');
            }else{
                $this->session->set_flashdata('notif', '<small id="idNotif"
                class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data</small>');
                redirect('CHeader/profile');
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data, data harus lengkap, sesuai, password lama harus benar, dan konfirmasi password harus sama dengan password baru</small>');
            redirect('CHeader/profile');
        }

    }

}