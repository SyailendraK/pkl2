<?php
defined('BASEPATH') or exit('No direct script access allowed');
// session_start();
class MAkun extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MAkun_model', 'tambah');
        $this->load->model('Auth_model', 'auth');
        $this->load->helper('string');
    }
    public function index(){
        // $_SESSION['print'] = null;
        if($this->session->userdata("id") == null){
            redirect('Auth');
        }elseif($this->auth->getUser($this->session->userdata("id")) == 1){
            redirect('Dashboard');
        }
        if($this->uri->segment(3) == null){
            redirect("MAkun/index/0");
        }
        $key = $this->session->userdata("search");
        $data['judul'] = "Akun";

        $this->load->library('pagination');
		$config['base_url'] = base_url().'MAkun/index/';
		if($key == ""){
            $config['total_rows'] = $this->tambah->getJumlahData();
        }else{
            $config['total_rows'] = $this->tambah->getJumlahDataUsername($key);
        }
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $config['full_tag_open'] = '<div class="custom-pagination d-flex justify-content-center mx-auto">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);	
        $data['page'] = $from;
        if($key == ""){
            $data['tambah'] = $this->tambah->getAkunPage($config['per_page'],$from);
        }else{
            $data['tambah'] = $this->tambah->getAkunByUsername($key,$config['per_page'],$from);
        }
        $this->session->set_userdata('search','');

        $this->load->view("Template/header_m", $data);
        $this->load->view("MAkun/index", $data);
        $this->load->view("Template/footer_m");
    }

    public function tambahAkun($page){
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[admin.username]');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required');
        $this->form_validation->set_rules('pass2', 'Konfirmasi password', 'trim|required|matches[pass]');

        if ($this->form_validation->run() == true) {
            $data = array(
                'id' => "ia-".random_string("alnum",10),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('pass'),
                'level' => $this->input->post('level')
            );

            if ($this->tambah->tambahAkun($data)) {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menambahkan data</small>');
                redirect('MAkun/index/'.$page);
            } else {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data</small>');
                redirect('MAkun/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data, data harus lengkap, sesuai, username tidak boleh sama, konfirmasi password harus sesuai</small>');
            redirect('MAkun/index/'.$page);
        }

    }

    public function hapusAkun($id,$page){
        if($this->tambah->hapusAkun($id)){
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menghapus data</small>');
            redirect('MAkun/index/'.$page);
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menghapus data</small>');
            redirect('MAkun/index/'.$page);
        }

    }

    public function updateAkun($page){
        $pass;
        if($this->input->post('passU') == ''){
            $pass = $this->input->post('passHidden');
        }else{
            $pass = $this->input->post('passU');
        }

        $this->form_validation->set_rules('usernameU', 'Username', 'trim|required'); //cek apakah sudah ada
        $this->form_validation->set_rules('passU', 'Password', 'trim|required');
        $this->form_validation->set_rules('pass2U', 'Konfirmasi password', 'trim|required|matches[passU]');

        $unik = $this->tambah->unique($this->input->post('usernameU'),$this->input->post('idU'));

        if ($this->form_validation->run() && $unik) {
            $data = array(
                'id' => $this->input->post('idU'),
                'username' => $this->input->post('usernameU'),
                'password' => $pass,
                'level' => $this->input->post('levelU')
            );

            if ($this->tambah->updateAkun($data)) {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil mengubah data</small>');
                redirect('MAkun/index/'.$page);
            } else {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal mengubah data</small>');
                redirect('MAkun/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal mengubah data, data harus lengkap, sesuai, username tidak boleh sama, konfirmasi password harus sesuai</small>');
            redirect('MAkun/index/'.$page);
        }
    }

    public function processTambah(){
        $data = $this->tambah->getAkunById($this->input->post('id'))[0];
        $id = $data['id'];
        $pass = $data['password'];

        $ac1 = '';
        $ac2 = '';
        if($data['level'] == 1){
            $ac1 = 'selected';
        }else{
            $ac2 = 'selected';
        }
        

        echo '<input type="hidden" value="'.$id.'" name="idU"><input type="hidden" value="'.$pass.'" name="passHidden"><div class="form-group">
        <label for="username">Username :</label>
        <input type="text" class="form-control" id="usernameU" placeholder="*Dikirim Username"
            name="usernameU" required value="'.$data['username'].'">
    </div>
    <div class="form-group">
        <label for="pass">Password :</label>
        <input type="password" class="form-control" id="passU" placeholder="*Password"
            name="passU" required>
    </div>
    <div class="form-group">
        <label for="pass2">Verifikasi Password :</label>
        <input type="password" class="form-control" id="pass2U"
            placeholder="*Masukan ulang password" name="pass2U" required>
    </div>';
    if($id != "ia-Z4gDs8HJb6" && $id != "ia-F4rW1c67x5"){
    echo '<div class="form-group">
        <label for="level">Level :</label>
        <select class="custom-select" id="levelU" name="levelU" required>
            <option value="1" '.$ac1.'>Administrasi</option>
            <option value="2"'.$ac2.'>Manager</option>
        </select>
    </div>';
    }
    }

    public function search(){
        $key = $this->input->get('search');
        $this->session->set_userdata('search', $this->input->get('search'));
        redirect('MAkun/index/0');
        // $key = $this->input->get('search');
        // $data['judul'] = "Akun";
        // $this->load->library('pagination');
		// $config['base_url'] = base_url().'MAkun/index/';
        // $config['total_rows'] = $this->tambah->getJumlahDataUsername($key);
        // $config['per_page'] = 10;
        // $from = $this->uri->segment(3);
        // $config['full_tag_open'] = '<div class="custom-pagination d-flex justify-content-center mx-auto">';
        // $config['full_tag_close'] = '</div>';
        // $this->pagination->initialize($config);	
        // $data['page'] = $from;
        // $data['tambah'] = $this->tambah->getAkunByUsername($key,$config['per_page'],$from);

        // $this->load->view("Template/header_m", $data);
        // $this->load->view("MAkun/index", $data);
        // $this->load->view("Template/footer_m");
    }
}