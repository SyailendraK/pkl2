<?php
defined('BASEPATH') or exit('No direct script access allowed');
// session_start();
class MPangkalan extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MPangkalan_model', 'pangkalan');
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
            redirect("MPangkalan/index/0");
        }
        $key = $this->session->userdata("search");
        $data['judul'] = "Pangkalan";

        $this->load->library('pagination');
		$config['base_url'] = base_url().'MPangkalan/index/';
		if($key == ""){
            $config['total_rows'] = $this->pangkalan->getJumlahData();
        }else{
            $config['total_rows'] = $this->pangkalan->getJumlahDataPangkalan($key);
        }
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $currentPage = $from;
        $config['full_tag_open'] = '<div class="custom-pagination d-flex justify-content-center mx-auto">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);	
        $data['page'] = $from;
        
        if($key == ""){
            $data['pangkalan'] = $this->pangkalan->getPangkalanPage($config['per_page'],$from);
        }else{
            $data['pangkalan'] = $this->pangkalan->getAkunByPangkalan($key,$config['per_page'],$from);
        }
        $this->session->set_userdata('search','');

        $this->load->view("Template/header_m", $data);
        $this->load->view("MPangkalan/index", $data);
        $this->load->view("Template/footer_m");
    }

    public function tambahPangkalan($page){
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

        if ($this->form_validation->run()) {
            $data = array(
                'id' => "pk-".random_string("alnum",10),
                'agen' => $this->input->post('pt'),
                'nama_pangkalan' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat')
            );

            if ($this->pangkalan->tambahPangkalan($data)) {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menambahkan data</small>');
                redirect('MPangkalan/index/'.$page);
            } else {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data</small>');
                redirect('MPangkalan/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data, data harus lengkap dan sesuai</small>');
            redirect('MPangkalan/index/'.$page);
        }

    }

    public function hapusPangkalan($id, $page){
        if($this->pangkalan->hapusPangkalan($id)){
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menghapus data</small>');
            redirect('MPangkalan/index/'.$page);
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menghapus data</small>');
            redirect('MPangkalan/index/'.$page);
        }
    }

    public function updatePangkalan($page){
        $this->form_validation->set_rules('namaU', 'Nama', 'trim|required');
        $this->form_validation->set_rules('alamatU', 'Alamat', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data = array(
                'id' => $this->input->post('idU'),
                'agen' => $this->input->post('ptU'),
                'nama_pangkalan' => $this->input->post('namaU'),
                'alamat' => $this->input->post('alamatU')
            );

            if ($this->pangkalan->updatePangkalan($data)) {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil mengubah data</small>');
                redirect('MPangkalan/index/'.$page);
            } else {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal mengubah data</small>');
                redirect('MPangkalan/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal mengubah data, data harus lengkap dan sesuai</small>');
            redirect('MPangkalan/index/'.$page);
        }
    }

    public function processPangkalan(){
        $data = $this->pangkalan->getPangkalanById($this->input->post('id'))[0];
        $id = $data['id'];
        // var_dump($data);
        $ac1 = '';
        $ac2 = '';
        if($data['agen'] == 'GAP'){
            $ac1 = 'selected';
        }else{
            $ac2 = 'selected';
        }
        

        echo '<input type="hidden" value="'.$id.'" name="idU"><div class="form-group">
        <label for="username">Pt :</label>
        <select id="ptU" name="ptU" class="custom-select" required>
            <option value="GAP" '.$ac1.'>GAP</option>
            <option value="NOAH" '.$ac2.'>NOAH</option>
        </select>
    </div>
    <div class="form-group">
        <label for="pass">Nama pangkalan :</label>
        <input type="text" class="form-control" id="namaU" placeholder="*Nama pangkalan"
            name="namaU" value="'.$data['nama_pangkalan'].'" required>
    </div>
    <div class="form-group">
        <label for="pass2">Alamat :</label>
        <input type="text" class="form-control" id="alamatU" placeholder="*Alamat pangkalan"
            name="alamatU" value="'.$data['alamat'].'" required>
    </div>';
    }

    public function search(){
        $key = $this->input->get('search');
        $this->session->set_userdata('search', $this->input->get('search'));
        redirect('MPangkalan/index/0');
        // $data['judul'] = "Pangkalan";
        // $this->load->library('pagination');
		// $config['base_url'] = base_url().'MPangkalan/index/';
        // $config['total_rows'] = $this->pangkalan->getJumlahDataPangkalan($key);
        // $config['per_page'] = 10;
        // $from = $this->uri->segment(3);
        // $config['full_tag_open'] = '<div class="custom-pagination d-flex justify-content-center mx-auto">';
        // $config['full_tag_close'] = '</div>';
        // $this->pagination->initialize($config);	
        // $data['page'] = $from;
        // $data['pangkalan'] = $this->pangkalan->getAkunByPangkalan($key,$config['per_page'],$from);

        // $this->load->view("Template/header_m", $data);
        // $this->load->view("MPangkalan/index", $data);
        // $this->load->view("Template/footer_m");
    }
}