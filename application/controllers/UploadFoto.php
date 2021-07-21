<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class UploadFoto extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('etaxi_model');
			
        }
        public function index()
        {
			$foto = '';
			if(isset($_GET['foto'])){
				$foto = $_GET['foto'];
			}
			
			$post = $this->input->post();
			if(isset($post['cari'])){
				$res = $this->etaxi_model->cari_kip($post['kip']);
				if($res){
					$res = $this->etaxi_model->update_path($res, $post['foto']);
				}else{
					echo 'Kip Tidak Ditemukan di DMS. Hub IT.';
				}
			}
			
			$this->load->view('header');
        	$this->load->view('/etaxi/uploadfoto', array('error' => ' ', 'foto' => $foto ));
			$this->load->view('footer');
		}
        public function upload_file(){
			
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc';
			$config['max_size']             = 3000;
			$config['max_width']            = 3000;
			$config['max_height']           = 3000;
			$this->load->library('upload', $config);
				
			//print_r($config);die;
			if ( ! $this->upload->do_upload('userfile')){
					
				$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
				$error = array('error' => $this->upload->display_errors());
				
				$this->load->view('header');
				$this->load->view('/etaxi/uploadfoto', $error);
				$this->load->view('footer');
			
			} else {
				
				
				
				$data = array('upload_data' => $this->upload->data());
				
				if($data){
					//return redirect('/Upload/'.$data['upload_data']['raw_name']);
					return redirect('/UploadFoto?foto='.$data['upload_data']['raw_name'].'');
					die();
				}
				
				$this->load->view('header');
				$this->load->view('/etaxi/success', $data);
				$this->load->view('footer');
			}
        }
}