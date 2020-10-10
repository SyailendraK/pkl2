<?php
defined('BASEPATH') or exit('No direct script access allowed');
// session_start();
class Nota extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Nota_model', 'nota');
        $this->load->model('Header_model', 'head');
        $this->load->model('Auth_model', 'auth');

        $this->load->helper('string');
    }
    public function index(){
        // $_SESSION['print'] = null;
        if($this->session->userdata("id") == null){
            redirect('Auth');
        }elseif($this->auth->getUser($this->session->userdata("id")) == 2){
            redirect('MDashboard');
        }

        if($this->uri->segment(3) == null){
            redirect("Nota/index/0");
        }

        $data['judul'] = "Nota";
        $key = $this->session->userdata("search");
        

        $this->load->library('pagination');
        $config['base_url'] = base_url().'Nota/index/';
        if($key == ""){
            $config['total_rows'] = $this->nota->getJumlahData();
        }else{
            $config['total_rows'] = $this->nota->getJumlahDataSearch($key);
        }
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $config['full_tag_open'] = '<div class="custom-pagination d-flex justify-content-center mx-auto">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);	
        // $this->session->set_userdata("search",null);

        // var_dump($this->session->userdata("search"));die;
        if($key == ""){
            $data['nota'] = $this->nota->getNotaPage($config['per_page'],$from);
        }else{
            $data['nota'] = $this->nota->getNotaPageSearch($config['per_page'],$from,$key);
        }
        $data['harga'] = $this->nota->getHarga();
        $data['kepada'] = $this->nota->getPangkalan();
        $data['page'] = $from;

        if($this->head->getListPrint() != null){
            $data['list'] = $this->head->getListPrint();
        }
        $this->session->set_userdata('search','');
        $this->load->view("Template/header", $data);
        $this->load->view("Nota/index", $data);
        $this->load->view("Template/footer");

    }
    
    public function submit($page){
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required');
        $this->form_validation->set_rules('nomor', 'Nomor', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data['tanggal'] = $this->input->post('tanggal');
            $data['kepada'] = $this->input->post('kepada');
            $data['jumlah'] = $this->input->post('jumlah');
            $data['nama'] = $this->input->post('nama');
            $data['harga'] = $this->input->post('harga');
            $data['id'] = "nt-".random_string("alnum",10);
            $data['pt'] = $this->input->post('agen');
            $data['nomor_nota'] = $this->input->post('nomor');

            $cek = $this->nota->submit($data);
            if ($cek == true) {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menambahkan data</small>');
                redirect('Nota/index/'.$page);
            } else {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data</small>');
                redirect('Nota/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data, data harus lengkap dan sesuai</small>');
            redirect('Nota/index/'.$page);
        }
    }

    public function getUpdateNota(){
        $id = $this->input->post('id');
        $data = $this->nota->getNotaById($id)[0];
        $harga = $this->nota->getHarga();
        $pangkalan = $this->nota->getPangkalan();
        echo '<input type="hidden" id="idU" name="idU" value="'.$id.'"><div class="form-group">
        <label for="tanggal">Tanggal :</label>
        <input type="date" class="form-control" data-date="" data-date-format="MM DD YYYY"
            value="'.$data['tanggal'].'" name="tanggalU" required>
    </div>
    <div class="form-group">
        <label for="agen">Agen :</label>
        <select class="custom-select" id="agenU" name="agenU">';
        if($data['pt'] == "GAP"){
        echo '<option value="GAP" selected>GAP</option>
            <option value="NOAH">NOAH</option>';
        }else{
            echo '<option value="GAP">GAP</option>
            <option value="NOAH" selected>NOAH</option>';
        }

        echo '</select>
    </div>
    <div class="form-group">
        <label for="banyak">Nomor nota :</label>
        <input type="number" class="form-control" id="nomorU" placeholder="*Nomor nota"
            name="nomorU" value="'.$data['nomor_nota'].'" required>
    </div>
    <div class="form-group">
        <label for="pangkalan">Kepada :</label>
        <select class="custom-select" id="kepadaU" name="kepadaU">';
            foreach($pangkalan as $p => $val){
            if($val['id'] != $data['kepada']){
            echo '<option value="'. $val['id'] .'">'.$val['nama_pangkalan'].'</option>';
            }else{
                echo '<option value="'. $val['id'] .'" selected>'.$val['nama_pangkalan'].'</option>';
            }
            }
        echo '</select>
    </div>
    <div class="form-group">
        <label for="banyak">Jumlah barang :</label>
        <input type="number" class="form-control" id="banyakU" placeholder="*Banyaknya barang"
            name="jumlahU" value="'.$data['jumlah'].'" required>
    </div>
    <div class="form-group">
        <label for="nama">Nama barang :</label>
        <input type="text" class="form-control" id="namaU" placeholder="*Nama barang"
            value="LPG 3 KG" name="namaU" required>
    </div>
    <div class="form-group">
        <label for="harga">Harga :</label>
        <input type="number" class="form-control" id="hargaU" placeholder="*Harga barang"
            name="hargaU" required value="'.$harga['harga'].'" readonly>
    </div>';
    }

    public function update($page){

        $this->form_validation->set_rules('tanggalU', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('jumlahU', 'Jumlah', 'trim|required');
        $this->form_validation->set_rules('namaU', 'Nama', 'trim|required');
        $this->form_validation->set_rules('hargaU', 'Harga', 'trim|required');
        $this->form_validation->set_rules('nomorU', 'Nomor', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data = [
                'id' => $this->input->post('idU'),
                'kepada' => $this->input->post('kepadaU'),
                'jumlah' => $this->input->post('jumlahU'),
                'nama_barang' => $this->input->post('namaU'),
                'harga' => $this->input->post('hargaU'),
                'tanggal' => $this->input->post('tanggalU'),
                'date_created' => time(),
                'pt' => $this->input->post('agenU'),
                'nomor_nota' => $this->input->post('nomorU')
            ];
        
            if($this->nota->update($data)){
                $this->session->set_flashdata('notif', '<small id="idNotif"
                class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil memperbarui data</small>');
                redirect('Nota/index/'.$page);
            }else{
                $this->session->set_flashdata('notif', '<small id="idNotif"
                class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data</small>');
                redirect('Nota/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
                class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data, data harus lengkap dan sesuai</small>');
                redirect('Nota/index/'.$page);
        }
    }

    public function hapus($id, $page){
        if($this->nota->deleteNota($id)){
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menghapus data</small>');
            redirect('Nota/index/'.$page);
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menghapus data</small>');
            redirect('Nota/index/'.$page);
        }
    }

    public function addListPrint($id, $page){
        $ary = $this->session->userdata("print");
        $temp = ["$id" => $id];
        if($ary == null){
            $ary = ["$id" => $id];
        }else{
            $ary = array_merge($ary,$temp);
        }
        $this->session->set_userdata("print",$ary);
        redirect('Nota/index/'.$page);
    }

    public function hapusPrint($id,$page){
        unset($_SESSION['print'][$id]);
        redirect("Nota/index/".$page);
    }

}