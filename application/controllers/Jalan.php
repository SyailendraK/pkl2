<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jalan extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jalan_model', 'jalan');
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
            redirect("Jalan/index/0");
        }
        $data['judul'] = "Jalan";
        $key = $this->session->userdata("search");


        $this->load->library('pagination');
		$config['base_url'] = base_url().'Jalan/index/';
		if($key == ""){
            $config['total_rows'] = $this->jalan->getJumlahData();
        }else{
            $config['total_rows'] = $this->jalan->getJumlahDataSearch($key);
        }
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $config['full_tag_open'] = '<div class="custom-pagination d-flex justify-content-center mx-auto">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);	

        if($key == ""){
            $data['jalan'] = $this->jalan->getJalanPage($config['per_page'],$from);
        }else{
            $data['jalan'] = $this->jalan->getJalanPageSearch($config['per_page'],$from,$key);
        }
        $data['keterangan'] = $this->jalan->getKeterangan();
        $data['nomor_polisi'] = $this->jalan->getNomorPolisi();
        $data['kepada'] = $this->jalan->getPangkalan();
        $data['page'] = $from;

        if($this->head->getListPrint() != null){
            $data['list'] = $this->head->getListPrint();
        }
        $this->session->set_userdata('search','');
        $this->load->view("Template/header", $data);
        $this->load->view("Jalan/index", $data);
        $this->load->view("Template/footer");

    }
    
    public function submit($page){
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
        $this->form_validation->set_rules('no_jalan', 'Nomor jalan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data['tanggal'] = $this->input->post('tanggal');
            $data['kepada'] = $this->input->post('kepada');
            $data['jumlah'] = $this->input->post('jumlah');
            $data['nama'] = $this->input->post('nama');
            $data['harga'] = $this->input->post('harga');
            $data['id'] = "jl-".random_string("alnum",10);
            $data["pt"] = $this->input->post('agen');
            $data["keterangan"] = $this->input->post('keterangan');
            $data["nomor_jalan"] = $this->input->post('no_jalan');
            $data["nomor_polisi"] = $this->input->post('nomor_polisi');

            $cek = $this->jalan->submit($data);
            if ($cek == true) {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menambahkan data</small>');
                redirect('Jalan/index/'.$page);
            } else {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data</small>');
            redirect('Jalan/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data, data harus lengkap dan sesuai</small>');
            redirect('Jalan/index/'.$page);
        }
    }

    public function hapus($id, $page){
        if($this->jalan->deleteJalan($id)){
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menghapus data</small>');
            redirect('Jalan/index/'.$page);
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menghapus data</small>');
            redirect('Jalan/index/'.$page);
        }
    }

    public function update($page){
        $this->form_validation->set_rules('utanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('ujumlah', 'Jumlah', 'trim|required');
        $this->form_validation->set_rules('uno_jalan', 'Nomor jalan', 'trim|required');
        $this->form_validation->set_rules('uketerangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('unama', 'Nama', 'trim|required');

        if ($this->form_validation->run() == true) {
            // $data['tanggal'] = $this->input->post('utanggal');
            // $data['kepada'] = $this->input->post('ukepada');
            // $data['jumlah'] = $this->input->post('ujumlah');
            // $data['nama'] = $this->input->post('unama');
            // $data['harga'] = $this->input->post('uharga');
            // $data['id'] = $this->input->post('idU');
            // $data["pt"] = $this->input->post('uagen');
            // $data["keterangan"] = $this->input->post('uketerangan');
            // $data["nomor_jalan"] = $this->input->post('uno_jalan');
            // $data["nomor_polisi"] = $this->input->post('unomor_polisi');

            $ary = [
                'id' => $this->input->post('idU'),
                'kepada' => $this->input->post('ukepada'),
                'jumlah' => $this->input->post('ujumlah'),
                'nama_barang' => $this->input->post('unama'),
                'keterangan' => $this->input->post('uketerangan'),
                'tanggal' => $this->input->post('utanggal'),
                'date_created' => time(),
                'pt' => $this->input->post('uagen'),
                'nomor_jalan' => $this->input->post('uno_jalan'),
                'id_nomor_polisi' => $this->input->post('unomor_polisi')
            ];

            if($this->jalan->updateJalan($ary)){
                $this->session->set_flashdata('notif', '<small id="idNotif"
                class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil memperbarui data</small>');
                redirect('Jalan/index/'.$page);
            }else{
                $this->session->set_flashdata('notif', '<small id="idNotif"
                class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data</small>');
                redirect('Jalan/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data, data harus lengkap dan sesuai</small>');
            redirect('Jalan/index/'.$page);
        }
    }

    // function process_pengemudi(){
    //     $data = $this->jalan->getPengemudi($this->input->post('id'));
    //     echo '<label for="kepada">Pengemudi :</label>
    //     <input type="text" class="form-control" id="pengemudi" placeholder="*Pengemudi"
    //         name="pengemudi" value="'.$data[0]['nama_pengirim'].'">';
    // }

    public function addListPrint($id,$page){
        $ary = $this->session->userdata("print");
        $temp = ["$id" => $id];
        if($ary == null){
            $ary = ["$id" => $id];
        }else{
            $ary = array_merge($ary,$temp);
        }
        $this->session->set_userdata("print",$ary);
        redirect('Jalan/index/'.$page);
    }

    public function hapusPrint($id,$page){
        unset($_SESSION['print'][$id]);
        redirect('Jalan/index/'.$page);
    }

    public function getUpdateJalan(){
        $id = $this->input->post('id');
        $data = $this->jalan->getJalanByID($id)[0];
        $polisi = $this->jalan->getNomorPolisi();
        $pangkalan = $this->jalan->getPangkalan();
        echo '<input type="hidden" id="idU" name="idU" value="'.$id.'">
        <div class="form-group">
            <label for="tanggal">Tanggal :</label>
            <input type="date" class="form-control" data-date="" data-date-format="MM DD YYYY"
                value="'. $data['tanggal'].'" name="utanggal" required>
        </div>
        <div class="form-group">

            <label for="agen">Agen :</label>
            <select class="custom-select" id="uagen" name="uagen">';
            if($data['pt'] == "NOAH"){
                echo
                '<option value="GAP">GAP</option>
                <option value="NOAH" selected>NOAH</option>';
            }else{
                echo
                '<option value="GAP" selected>GAP</option>
                <option value="NOAH" >NOAH</option>';
            }

            echo '</select>
        </div>
        <div class="form-group">
            <label for="kepada">No jalan :</label>
            <input type="text" class="form-control" id="uno_jalan" placeholder="*Nomor jalan"
                name="uno_jalan" required value="'.$data['nomor_jalan'].'">
        </div>
        <div class="form-group">
            <label for="pangkalan">Kepada :</label>
            <select class="custom-select" id="ukepada" name="ukepada">';
                foreach($pangkalan as $p => $val){
                    if($data['kepada2'] == $val['id']){
                echo '<option value="'. $val['id'] .'" selected>'.
                    $val['nama_pangkalan']." (".$val['agen'].")" .'</option>';
                    }else{
                        echo '<option value="'. $val['id'] .'">'.
                        $val['nama_pangkalan']." (".$val['agen'].")" .'</option>';
                    }
                }
            echo '</select>
        </div>
        <div class="form-group">
            <label for="pangkalan">Nomor polisi :</label>
            <select class="custom-select" id="unomor_polisi" name="unomor_polisi">';
                foreach($polisi as $p => $val){
                    if($data['id_nomor_polisi'] == $val['id']){
                echo '<option value="'. $val['id'] .'" selected>'.
                    $val['nomor_polisi'].' ('.$val['nama_pengirim'].')' .'</option>';
                    }else{
                        echo '<option value="'. $val['id'] .'">'.
                    $val['nomor_polisi'].' ('.$val['nama_pengirim'].')' .'</option>';
                    }
                }
            echo '</select>
        </div>
        <div class="form-group">
            <label for="banyak">Jumlah barang :</label>
            <input type="number" class="form-control" id="ubanyak" placeholder="*Banyaknya barang"
                name="ujumlah" required value="'.$data['jumlah'].'">
        </div>
        <div class="form-group">
            <label for="nama">Nama barang :</label>
            <input type="text" class="form-control" id="unama" placeholder="*Nama barang"
                value="'. $data['nama_barang'] .'" name="unama" required>
        </div>
        <div class="form-group">
            <label for="harga">keterangan :</label>
            <input type="text" class="form-control" id="uketerangan"
                placeholder="*Keterangan barang" name="uketerangan"
                value="'. $data['keterangan'] .'" required>
        </div>
    ';
    }

}