<?php
defined('BASEPATH') or exit('No direct script access allowed');
// session_start();
class Pesanan extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pesanan_model', 'pesanan');
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
            redirect("Pesanan/index/0");
        }
        $data['judul'] = "Pesanan";
        $key = $this->session->userdata("search");

        $this->load->library('pagination');
		$config['base_url'] = base_url().'Pesanan/index/';
		if($key == ""){
            $config['total_rows'] = $this->pesanan->getJumlahData();
        }else{
            $config['total_rows'] = $this->pesanan->getJumlahDataSearch($key);
        }
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $config['full_tag_open'] = '<div class="custom-pagination d-flex justify-content-center mx-auto">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);	

        if($key == ""){
            $data['pesanan'] = $this->pesanan->getPesananPage($config['per_page'],$from);
        }else{
            $data['pesanan'] = $this->pesanan->getPesananPageSearch($config['per_page'],$from,$key);
        }
        $data['page'] = $from;
        // var_dump($data['harga_faktur']);die;

        if($this->head->getListPrint() != null){
            $data['list'] = $this->head->getListPrint();
        }

        $this->session->set_userdata('search','');
        $this->load->view("Template/header", $data);
        $this->load->view("Pesanan/index", $data);
        $this->load->view("Template/footer");
    }
    
    public function submit($page){
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('nomor_pesanan', 'Nomor pesanan', 'trim|required');
        $this->form_validation->set_rules('trip', 'Trip', 'trim|required');
        $this->form_validation->set_rules('nomor_do', 'Nomor do', 'trim|required');
        $this->form_validation->set_rules('nomor_sa', 'Nomor sa', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data['tanggal'] = $this->input->post('tanggal');
            $data['trip'] = $this->input->post('trip');
            $data['nomor_do'] = $this->input->post('nomor_do');
            $data['nomor_sa'] = $this->input->post('nomor_sa');
            $data['nomor_pesanan'] = $this->input->post('nomor_pesanan');
            $data['pt'] = $this->input->post('agen');
            $data['id'] = "ps-".random_string("alnum",10);

            $cek = $this->pesanan->submit($data);
            if ($cek == true) {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menambahkan data</small>');
                redirect('Pesanan/index/'.$page);
            } else {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data</small>');
                redirect('Pesanan/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data, data harus lengkap dan sesuai</small>');
            redirect('Pesanan/index/'.$page);
        }
    }

    public function hapus($id,$page){
        if($this->pesanan->deletePesanan($id)){
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menghapus data</small>');
            redirect('Pesanan/index/'.$page);
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menghapus data</small>');
            redirect('Pesanan/index/'.$page);
        }
    }

    public function update($page){
        $this->form_validation->set_rules('utanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('unomor_pesanan', 'Nomor pesanan', 'trim|required');
        $this->form_validation->set_rules('utrip', 'Trip', 'trim|required');
        $this->form_validation->set_rules('unomor_do', 'Nomor do', 'trim|required');
        $this->form_validation->set_rules('unomor_sa', 'Nomor sa', 'trim|required');

        if ($this->form_validation->run() == true) {
            $ary = [
                'id' => $this->input->post('uid'),
                'nomor_pesanan' => $this->input->post('unomor_pesanan'),
                'trip' => $this->input->post('utrip'),
                'nomor_do' => $this->input->post('unomor_do'),
                'nomor_sa' => $this->input->post('unomor_sa'),
                'tanggal' => $this->input->post('utanggal'),
                'pt' => $this->input->post('uagen'),
                'date_created' => time()
            ];

            $cek = $this->pesanan->update($ary);
            if ($cek == true) {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil memperbarui data</small>');
                redirect('Pesanan/index/'.$page);
            } else {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data</small>');
                redirect('Pesanan/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data, data harus lengkap dan sesuai</small>');
            redirect('Pesanan/index/'.$page);
        }
    }

    public function addListPrint($id,$page){
        $ary = $this->session->userdata("print");
        $temp = ["$id" => $id];
        if($ary == null){
            $ary = ["$id" => $id];
        }else{
            $ary = array_merge($ary,$temp);
        }
        // array_push($ary,$id);        
        $this->session->set_userdata("print",$ary);
        redirect('Pesanan/index/'.$page);
        // $_SESSION['print'] = null;
        // var_dump($this->session->userdata("print"));die;
    }

    public function hapusPrint($id,$page){
        unset($_SESSION['print'][$id]);
        redirect('Pesanan/index/'.$page);
    }

    public function getUpdatePesanan(){
        $id = $this->input->post('id');
        $data = $this->pesanan->getPesananByID($id)[0];
        echo '<input type="hidden" id="uid" name="uid" value="'.$id.'"><div class="form-group" >
        <label for="tanggal">Tanggal :</label>
        <input type="date" class="form-control" data-date="" data-date-format="MM DD YYYY"
            value="'.$data['tanggal'].'" name="utanggal" required>
    </div>
    <div class="form-group">
        <label for="agen">Agen :</label>
        <select class="custom-select" id="uagen" name="uagen">';
        if($data['pt'] == "GAP"){
            echo '<option value="GAP" selected>GAP</option>
            <option value="NOAH">NOAH</option>';
        }else{
            echo '<option value="GAP" >GAP</option>
            <option value="NOAH" selected>NOAH</option>';
        }
        echo '</select>
    </div>
    <div class="form-group">
        <label for="pesanan">Nomor pesanan :</label>
        <input type="number" class="form-control" id="upesanan" placeholder="*Nomor pesanan"
            name="unomor_pesanan" value="'.$data['nomor_pesanan'].'" required>
    </div>
    <div class="form-group">
        <label for="trip">Trip :</label>
        <input type="number" class="form-control" id="utrip" placeholder="*Jumlah trip"
            name="utrip" min="0" value="'.$data['trip'].'" required>
    </div>
    <div class="form-group">
        <label for="do">Nomor DO :</label>
        <input type="number" class="form-control" id="udo" placeholder="*Nomor DO"
            name="unomor_do" min="0" value="'.$data['nomor_do'].'" required>
    </div>
    <div class="form-group">
        <label for="sa">Nomor SA :</label>
        <input type="number" class="form-control" id="usa" placeholder="*Nomor SA"
            name="unomor_sa" value="'.$data['nomor_sa'].'" min="0" required>
    </div>';
    }
}