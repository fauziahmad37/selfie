<?php

include_once('Admin.php');

class Penjualan extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('penjualan_model');
	}

	function index(){
		
		$post = array();
		
		$date = date('Y-m-1');
		$dateakhir = date('Y-m-t');
		$id_status_invoice = "On Process','Rejected','Active";
		$pool_id = 7;
		
		$post = $this->input->post();
		
		if(isset($post['update']))
		{
			$data_edit = $this->penjualan_model->update($post);
			if($data_edit){
				?>
				<script type="text/javascript">
					alert("Data Berhasil disimpan...");
					window.location = "<?php echo site_url('/Penjualan/');?>";
				</script>
				<?php
				die();
			}
		}
		
		if(isset($post['search']))
		{
			$date 				= date('Y-m-d', strtotime($post['bulan']));
			$dateakhir 			= date('Y-m-d', strtotime($post['bulanakhir']));
			$id_status_invoice 	= $post['id_status_invoice'];
			$pool_id 			= $post['pool_id']; 
		}
		
		$arrPool = $this->penjualan_model->data_pool();
		$data = $this->penjualan_model->data($date, $dateakhir, $id_status_invoice, $pool_id);
		
		$this->load->view('/header');
		$this->load->view('/penjualan/index_penjualan', Array('data' => $data, 'arrPool' => $arrPool, 'date' => $date, 
			'dateakhir' => $dateakhir, 'id_status_invoice' => $id_status_invoice));
		$this->load->view('/footer');
	}
	
	function edit($id = ''){
		if($id === '')
			return redirect('/Penjualan');
		
		
		
		$data_edit = $this->penjualan_model->data_edit($id);
		$arrPool = $this->penjualan_model->data_pool();
		
		$this->load->view('/header');
		$this->load->view('/penjualan/edit_penjualan', Array('data_edit' => $data_edit, 'arrPool' => $arrPool));
		$this->load->view('/footer');
	}

}
?>