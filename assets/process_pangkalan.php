<?php
// session_start();
class Rencana extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rencana_model', 'rencana');
        index();
    }
    public function index(){
        $data = $this->rencana->getAlamatPangkalan($this->input->post('id'));
        // var_dump($data);die;
        echo '<label for="alamat">Alamat pangkalan :</label>
        <textarea name="alamat" id="alamat" name="alamat"
            class="form-control">'.$data['alamat_pangkalan'].'</textarea>';
    }

}