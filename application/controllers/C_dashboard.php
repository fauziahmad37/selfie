<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	ini_set('max_execution_time', 600); 
	ini_set('memory_limit','2048M');

	include_once('Admin.php');
		class C_dashboard extends admin{

			public function index(){
				$this->load->model('M_dashboard');
				$data['jumlah_armada'] = $this->M_dashboard->count_armada();
				$data['jumlah_spj'] = $this->M_dashboard->count_spj();
				$data['total_setoran_wajib'] = $this->M_dashboard->total_setoran_wajib();
				$data['total_pendapatan'] = $this->M_dashboard->total_pendapatan();
				$data['revenue_pool'] = $this->M_dashboard->revenue_pool();
				$this->load->view('dashboard/index',$data);
			}
	}
?>