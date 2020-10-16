<?php
defined('BASEPATH') or exit('No direct script access allowed');
// session_start();
class Rencana extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rencana_model', 'rencana');
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
            redirect("Rencana/index/0");
        }

        $key = $this->session->userdata("search");

        $this->session->set_userdata('no',1);
        $ary = $this->session->userdata("print");
        // var_dump($this->uri->segment(1));die;
        $data['judul'] = "Rencana";
        $data['pangkalan'] = $this->rencana->getPangkalan();
        $data['nomor_polisi'] = $this->rencana->getNomorPolisi();

        $this->load->library('pagination');
		$config['base_url'] = base_url().'Rencana/index/';
		if($key == ""){
            $config['total_rows'] = $this->rencana->getJumlahData();
        }else{
            $config['total_rows'] = $this->rencana->getJumlahDataSearch($key);
        }
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $config['full_tag_open'] = '<div class="custom-pagination d-flex justify-content-center mx-auto">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

        if($key == ""){
            $data['rencana'] = $this->rencana->getRencanaPage($config['per_page'],$from);
        }else{
            $data['rencana'] = $this->rencana->getRencanaPageSearch($config['per_page'],$from,$key);
        }
        // var_dump($data['rencana'][0]);die;
        $data['page'] = $from;

        if($this->head->getListPrint() != null){
            $data['list'] = $this->head->getListPrint();
            // $data['id'] = $this->nota->getListPrint()[0]['id'];
        }
        $this->session->set_userdata('search','');

        $this->load->view("Template/header", $data);
        $this->load->view("Rencana/index", $data);
        $this->load->view("Template/footer");

    }

    public function processPangkalan(){
        $data = $this->rencana->getAlamatPangkalan($this->input->post('id'));
        // var_dump($data);die;
        if($data != null){
        echo '<label for="alamat">Alamat pangkalan :</label>
        <textarea name="alamat" id="alamat" name="alamat"
            class="form-control">'.$data[0]['alamat'].'</textarea>';
        }else{
            echo '<label for="alamat">Alamat pangkalan :</label>
        <textarea name="alamat" id="alamat" name="alamat"
            class="form-control">*alamat pangkalan tidak di temukan</textarea>';
        }
    }
    
    public function submit($page){
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('lo', 'Loading order', 'trim|required');
        for($i=1;$i<=$this->session->userdata('no');$i++){
            $this->form_validation->set_rules('jumlah-'.$i, 'Jumlah-'.$i, 'trim|required');
            $this->form_validation->set_rules('faktur-'.$i, 'Faktur-'.$i, 'trim|required');
        }
        
        if ($this->form_validation->run() == true) {
            $temp;
            $data['tanggal'] = $this->input->post('tanggal');
            $data['agen'] = $this->input->post('agen');
            $data['lo'] = $this->input->post('lo');
            $data['id_nomor_polisi'] = $this->input->post('nomor_polisi');
            for($i=1;$i<=$this->session->userdata('no');$i++){
                $temp[$i]['id_pangkalan'] = $this->input->post('pangkalan-'.$i);
                $temp[$i]['jumlah'] = $this->input->post('jumlah-'.$i);
                $temp[$i]['nomor_faktur'] = $this->input->post('faktur-'.$i);
            }
            // var_dump($temp);die;
            $data['id_pangkalan'] = $temp;
            $data['id'] = "rc-".random_string("alnum",10);


            $cek = $this->rencana->submit($data);
            if ($cek == true) {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menambahkan data</small>');
                redirect('Rencana/index/'.$page);
            } else {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data</small>');
            redirect('Rencana/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menambahkan data, data harus lengkap dan sesuai</small>');
            redirect('Rencana/index/'.$page);
        }
    }

    public function hapus($id,$page){
        if($this->rencana->deleteRencana($id)){
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil menghapus data</small>');
            redirect('Rencana/index/'.$page);
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal menghapus data</small>');
            redirect('Rencana/index/'.$page);
        }
    }

    public function update($page){
        $this->form_validation->set_rules('utanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('ulo', 'Loading order', 'trim|required');
        for($i=1;$i<=$this->session->userdata('uno');$i++){
            $this->form_validation->set_rules('ujumlah-'.$i, 'Jumlah-'.$i, 'trim|required');
            $this->form_validation->set_rules('ufaktur-'.$i, 'Faktur-'.$i, 'trim|required');
        }
        
        if ($this->form_validation->run() == true) {
            $temp;
            $data['tanggal'] = $this->input->post('utanggal');
            $data['agen'] = $this->input->post('uagen');
            $data['lo'] = $this->input->post('ulo');
            $data['id_nomor_polisi'] = $this->input->post('unomor_polisi');
            for($i=1;$i<=$this->session->userdata('uno');$i++){
                $temp[$i]['id_pangkalan'] = $this->input->post('upangkalan-'.$i);
                $temp[$i]['jumlah'] = $this->input->post('ujumlah-'.$i);
                $temp[$i]['nomor_faktur'] = $this->input->post('ufaktur-'.$i);
            }
            // var_dump($temp);die;
            $data['id_pangkalan'] = $temp;
            $data['id'] = "rc-".random_string("alnum",10);


            $cek = $this->rencana->submit($data);
            if ($cek == true) {
                $idR = $this->input->post("idR");
                if($this->rencana->deleteRencana($idR)){
                    $this->session->set_flashdata('notif', '<small id="idNotif"
                    class="badge badge-success d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Berhasil memperbarui data</small>');
                    redirect('Rencana/index/'.$page);
                }else{
                    $this->rencana->deleteRencana($data['id']);
                    $this->session->set_flashdata('notif', '<small id="idNotif"
                    class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data</small>');
                    redirect('Rencana/index/'.$page);
                }
            } else {
                $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data</small>');
            redirect('Rencana/index/'.$page);
            }
        }else{
            $this->session->set_flashdata('notif', '<small id="idNotif"
            class="badge badge-danger d-flex justify-content-center mx-auto text-center" stylye="color: white; border-radius: 10px;" onclick="javascript:clearFlash()">Gagal memperbarui data, data harus lengkap dan sesuai</small>');
            redirect('Rencana/index/'.$page);
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
        redirect('Rencana/index/'.$page);
        // $_SESSION['print'] = null;
        // var_dump($this->session->userdata("print"));die;
    }

    public function hapusPrint($id,$page){
        unset($_SESSION['print'][$id]);
        redirect('Rencana/index/'.$page);
    }

    public function process_pangkalan(){
        $data = $this->rencana->getAlamatPangkalan($this->input->post('id'));
        // var_dump($data);die;
        echo '<label for="alamat">Alamat pangkalan :</label>
        <textarea name="alamat" id="alamat" name="alamat"
            class="form-control">'.$data[0]['alamat'].'</textarea>';
    }

    public function process_add(){
        $no = $this->input->post('no');
        $this->session->set_userdata('no',$no);
        $data = $this->rencana->getPangkalan();
        for($i=1;$i<=$no;$i++){
        echo '<div class="form-group" id="deleteFormGroup-'.$i.'">
                                    <label for="pangkalan">Data pangkalan '.$i.' : </label><a class="badge badge-danger" style="color: white;float: right;" onclick="javascript:pengurangX('.$i.');setTimeout(deleteForm('.$i.'),200)">X</a>
        <select class="custom-select" id="pangkalan-'.$i.'" name="pangkalan-'.$i.'" onclick="javascript:setSession('.$i.')" required>';
        // var_dump($data);die;
            foreach($data as $p => $val){
            echo '<option value="'. $val['id'] .'"> '.$val['nama_pangkalan'].'</option>';
            }
        echo '</select>
        <div class="row pt-2">
            <div class="col-md-6">
                <input type="number" class="form-control" id="banyak-'.$i.'"
                    placeholder="*Banyaknya barang" name="jumlah-'.$i.'" onkeyup="javascript:setTimeout(cekJumlah('.$i.'), 500); pengurang('.$i.');javascript:setSession('.$i.')" value="0" min="0" required>
            </div>
            <dib class="col-md-6">
                <input type="number" class="form-control" id="faktur-'.$i.'"
                    placeholder="*Nomor faktur" name="faktur-'.$i.'" min="0" required onkeyup="javascript:setSession('.$i.')">
            </dib>
        </div>
    </div>';
        }
    }

    public function updateRencana(){
        $no = 1;
        $total = 0;
        $id = $this->input->post('id');
        $rencana = $this->rencana->getupdate($id);
        $selected = $this->rencana->getSelected($rencana['id_print_pangkalan']);
        if($this->session->userdata('uno') == null){
            $this->session->set_userdata('uno',sizeof($selected));
        }

        $this->num = sizeof($selected);
        $pangkalan = $this->rencana->getPangkalan();
        $nomor_polisi = $this->rencana->getNomorPolisi();
        echo '<div class="modal-body"><input type="hidden" id="idR" name="idR" value="'.$id.'"><input type="hidden" id="signNo" value="'.sizeof($selected).'"><div class="form-group">
        <label for="tanggal">Tanggal :</label>
        <input type="date" class="form-control" data-date="" data-date-format="MM DD YYYY"
            value="'.$rencana['tanggal'].'" name="utanggal" required>
    </div>
    <div class="form-group">
        <label for="agen">Agen :</label>
        <select class="custom-select" id="uagen" name="uagen" required>';
        if($rencana['pt'] == 'NOAH'){
            echo '<option value="NOAH" selected>NOAH</option>
            <option value="GAP">GAP</option>';
        }else{
            echo '<option value="NOAH" >NOAH</option>
            <option value="GAP" selected>GAP</option>';
        }
        echo '</select>
    </div>
    <div class="form-group">
        <label for="lo">Loading order :</label>
        <input type="number" class="form-control" id="ulo" placeholder="*Nomor LO" name="ulo"
            required value="'.$rencana['loading_order'].'">
    </div>
    <div class="form-group">
        <label for="pangkalan">Nomor polisi :</label>
        <select class="custom-select" id="unomor_polisi" name="unomor_polisi">
            ';foreach($nomor_polisi as $p => $val){
                if($rencana['id_no_polisi'] == $val['id']){
            echo '<option value="'. $val['id'] .'" selected>'.
                $val['nomor_polisi'].'('.$val['nama_pengirim'].')'.'</option>';
                }else{
                    echo '<option value="'. $val['id'] .'">'.
                $val['nomor_polisi'].'('.$val['nama_pengirim'].')'.'</option>';
                }
            }
        echo '</select>
    </div>

    <div id="utambah">';
        foreach($selected as $r => $v){
        echo '<div class="form-group" id="udeleteFormGroup-'.$no.'">
            <label for="pangkalan">Data pangkalan '.$no.' :</label><a class="badge badge-danger" style="color: white;float: right;" onclick="javascript:upengurangX('.$no.');setTimeout(udeleteForm('.$no.'),200)">X</a>
            <select class="custom-select" id="upangkalan-'.$no.'" name="upangkalan-'.$no.'"
            onclick="javascript:usetSession(1)" required>';
            foreach($pangkalan as $p => $val){
                if($val['id'] == $v['id_pangkalan']){
                echo '<option value="'. $val['id'].'" selected>'.$val['nama_pangkalan'] .'</option>';
                }else{
                    echo '<option value="'. $val['id'].'">'.$val['nama_pangkalan'] .'</option>';
                }
            }
            echo '</select>
            <div class="row pt-2">
                <div class="col-md-6" id="setVal">
                    <input type="number" class="form-control" id="ubanyak-'.$no.'"
                        placeholder="*Banyaknya barang" name="ujumlah-'.$no.'"
                        onkeyup="javascript:setTimeout(ucekJumlah('.$no.'), 500); upengurang('.$no.');usetSession('.$no.')"
                        value="'.$v['jumlah'].'" min="0" required>
                </div>
                <dib class="col-md-6">
                    <input type="number" class="form-control" id="ufaktur-'.$no.'"
                        placeholder="*Nomor faktur" name="ufaktur-'.$no.'" min="0" required
                        onkeyup="javascript:usetSession('.$no.')" value="'.$v['nomor_faktur'].'">
                </dib>
            </div>'.$r.'
        </div>
    ';
    $no++;
    $total += intval($v['jumlah']);
        }
    echo '</div><div class="form-group">
        <a class="btn btn-success" style="width: 100%;border-radius: 15px;color: white;"
            id="utbh" onclick="javascript:uview_input_post_add();addResult('.sizeof($selected).')">Tambah data</a>
    </div></div>
    <div class="modal-footer">
        <p class="mr-5" id="ujumBarang">Jumlah barang : <span id="ujumlah">'.$total.'</span></p>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </div>';
    }

    public function uprocess_add(){
        $no = $this->input->post('uno');
        $this->session->set_userdata('uno',$no);
        $data = $this->rencana->getPangkalan();
        for($i=1;$i<=$no;$i++){
        echo '<div class="form-group" id="udeleteFormGroup-'.$i.'">
                                    <label for="pangkalan">Data pangkalan '.$i.' : </label><a class="badge badge-danger" style="color: white;float: right;" onclick="javascript:upengurangX('.$i.');setTimeout(udeleteForm('.$i.'),200)">X</a>
        <select class="custom-select" id="upangkalan-'.$i.'" name="upangkalan-'.$i.'" onclick="javascript:usetSession('.$i.')" required>';
        // var_dump($data);die;
            foreach($data as $p => $val){
            echo '<option value="'. $val['id'] .'"> '.$val['nama_pangkalan'].'</option>';
            }
        echo '</select>
        <div class="row pt-2">
            <div class="col-md-6">
                <input type="number" class="form-control" id="ubanyak-'.$i.'"
                    placeholder="*Banyaknya barang" name="ujumlah-'.$i.'" onkeyup="javascript:setTimeout(ucekJumlah('.$i.'), 500); upengurang('.$i.');javascript:usetSession('.$i.')" value="0" min="0" required>
            </div>
            <dib class="col-md-6">
                <input type="number" class="form-control" id="ufaktur-'.$i.'"
                    placeholder="*Nomor faktur" name="ufaktur-'.$i.'" min="0" required onkeyup="javascript:usetSession('.$i.')">
            </dib>
        </div>
    </div>';
        }
    }

}
