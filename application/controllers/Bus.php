<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Bus extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('bus_model');
		$this->load->model('cac_user_model');		
	}
	
	public function index()
	{
		$date = date('Y-m-d');
		$post = $this->input->post();
		$data = array();
		if(isset($post['save'])){
			$data = $this->bus_model->checklist_bus_header_save($post);
			if($data){
				return redirect('/Bus/input_checklist/'.$data);
			}else{
				?>
				<script type="text/javascript">
					alert("Gagal Menyimpan.");
					window.location = "<?php echo site_url('/Bus/');?>"; 
				</script>
				<?php
			}
		}
		
	
		$this->load->view('header');
		$this->load->view('bus/checklist_bus', Array('date' => $date, 'data' => $data));
		$this->load->view('footer');	
	}
	
	public function input_checklist($id = ''){	
		
		$post = $this->input->post();
		if(isset($post['save'])){
			$id_header = $post['id'];
			$i = 1;
			while(isset($_POST['pertanyaan'.$i]) && isset($_POST['jawaban'.$i])){
				$pertanyaan = $_POST['pertanyaan'.$i];
				$jawaban = $_POST['jawaban'.$i];
				$keterangan = $_POST['keterangan'.$i];
				
				$res = $this->bus_model->save_detail($id_header, $pertanyaan, $jawaban, $keterangan);
				$i++;
			}
			
			$save = $this->bus_model->save_km_bbm($post);
			
			if($save){
				return redirect('/Bus/checklist_header/');
			}			
		}
		
		if($id!==''){
			$header = $this->bus_model->get_header($id);
		} else {
			$header = $this->bus_model->get_header($post['id']);
		}
		
		if(isset($post['update'])){
			$id_header = $post['id'];
			$in_dt = $post['in_dt'];
			$a = 1;
			
			while(isset($post['pertanyaan'.$a]) && isset($post['jawaban'.$a])){
				$pertanyaan = $post['pertanyaan'.$a];
				$jawaban = $post['jawaban'.$a];
				$keterangan = $post['keterangan'.$a];
				
				$res2 = $this->bus_model->update_detail($id_header, $pertanyaan, $jawaban, $keterangan);
				$a++;
			}
			if($res2){
				$this->bus_model->update_header($id_header, $in_dt);
				$save = $this->bus_model->save_km_bbm($post);
				return redirect('/Bus/checklist_header/');
			}
		}
		
		$proses = null;
		if(isset($_GET['proses'])){
			$proses = $_GET['proses'];
		}
		
		$this->load->view('header');
		$this->load->view('bus/input_checklist', Array('header' => $header, 'proses' => $proses));
		$this->load->view('footer');
	}
	
	public function checklist_header(){
		$id_workshop = $this->user['id_workshop'];
		$date = date('Y-m-1');
		$dateakhir = date('Y-m-t');
		$id_status_invoice = "draft','active','closed";
		
		$post = $this->input->post();
		if(isset($post['search']))
		{
			$id_workshop = $post['id_workshop'];
			$date = date('Y-m-d', strtotime($post['bulan']));
			$dateakhir = date('Y-m-d', strtotime($post['bulanakhir']));
			$id_status_invoice =$post['id_status_invoice'];
		}

		$status = $post['id_status_invoice'];
		$data = $this->bus_model->checklist_header($date, $dateakhir,$id_status_invoice);
		$dataUser = $this->cac_user_model->data();
		
		$this->load->view('/header');
		$this->load->view('/bus/checklist_header', Array('data' => $data, 'date' => $date, 'dateakhir' => $dateakhir,'id_status_invoice' => $id_status_invoice,
			'arrWorkshop' => $arrWorkshop, 'id_workshop' => $id_workshop, 'dataUser' => $dataUser, 'status' => $status));		
		$this->load->view('/footer');		
	}
	
	// public function input_checklist_in($id=''){
		// $post = $this->input->post();
		// $header = $this->bus_model->get_header($post['id']);
		// print_r($header);die;
		
		// $this->load->view('header');
		// $this->load->view('bus/input_checklist', Array('header' => $header));
		// $this->load->view('footer');
	// }
	
	public function input_checklist_detail($id=''){
		$data = $this->bus_model->input_checklist_detail($id);
		
		$this->load->view('/header');
		$this->load->view('/bus/input_checklist_detail', Array('data' => $data));		
		$this->load->view('/footer');		
	}
	
	

}
