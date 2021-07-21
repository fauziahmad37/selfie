<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	ini_set('max_execution_time', 600); 
	ini_set('memory_limit','2048M');

	include_once('Admin.php');
	class C_operasi_eagle extends Admin {

		function __construct() {
			parent::__construct();
			$this->load->model('M_operasi_eagle');
		}

		public function data_operasi(){
			  $post = $this->input->post();

		  if(isset($post['cek'])){
                $tgl_spj = $post['tgl_spj'];    
                $idpool = $post['id_pool'];      
             }	
            // print_r($tgl_spj);die;

            $connDb = 'dice_eagle';
          	$data = $this->M_operasi_eagle->getDataOperasi($connDb);
          	$data2 = $this->M_operasi_eagle->getDataawal($connDb,$idpool,$tgl_spj);
			$this->load->view('header');
			$this->load->view('data_eagle/V_operasi_eagle',Array('data'=>$data,'data2'=>$data2));
			$this->load->view('footer');
		}

		public function cek_data(){
			$tgl_spj = $post = $this->input->post('tgl_spj');
			$idpool = $post = $this->input->post('id_pool');

				if ($idpool == '29') {
                    $idpool = '5';
                }else if ($idpool == '28'){
                    $idpool = '4';
                }
		
            $connDb = 'dice_eagle';
          	$data = $this->M_operasi_eagle->getData($connDb,$idpool,$tgl_spj);
          	$data2 = $this->M_operasi_eagle->getDataTidakOperasi($connDb,$idpool,$tgl_spj);

			$this->load->view('header');
			$this->load->view('data_eagle/V_operasi_eagle',Array('data'=>$data,'data2'=>$data2));
			$this->load->view('footer');
		}
	}
?>