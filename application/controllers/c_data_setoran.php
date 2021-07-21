<?php
	class C_data_setoran extends CI_Controller{

		public function cari(){
		$this->laod->view('form_cari');
	}

	public function hasil(){
		$data_setoran['cari'] = $this->m_data_setoran->cari_data_setoran();
		$this->load->view('result',$data_setoran);
	}
}
	
	