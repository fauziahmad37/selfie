<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Etaxi extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('etaxi_model');
		$this->load->model('etaxi_dashboard_model');		
	}
	
	public function Dashboard_operation(){
		
		$spj_pd_bambu = $this->etaxi_dashboard_model->dashboard_spj_aktif_pondok_bambu();
		$spj_pekapuran = $this->etaxi_dashboard_model->dashboard_spj_aktif_pekapuran();
		$spj_cipayung = $this->etaxi_dashboard_model->dashboard_spj_aktif_cipayung();
		$spj_jagakarsa = $this->etaxi_dashboard_model->dashboard_spj_aktif_jagakarsa();
		
		$cetakSpj_pd_bambu = $this->etaxi_dashboard_model->dashboard_cetak_spj_today_pondok_bambu();
		$cetakSpj_pekapuran = $this->etaxi_dashboard_model->dashboard_cetak_spj_today_pekapuran();
		$cetakSpj_cipayung = $this->etaxi_dashboard_model->dashboard_cetak_spj_today_cipayung();
		$cetakSpj_jagakarsa = $this->etaxi_dashboard_model->dashboard_cetak_spj_today_jagakarsa();
		
		$sos_pd_bambu = $this->etaxi_dashboard_model->sos_pd_bambu();
		$sos_pekapuran = $this->etaxi_dashboard_model->sos_pekapuran();
		$sos_jagakarsa = $this->etaxi_dashboard_model->sos_jagakarsa();
		$sos_cipayung = $this->etaxi_dashboard_model->sos_cipayung();
		
		$tp_pd_bambu = $this->etaxi_dashboard_model->tp_pd_bambu();
		$tp_pekapuran = $this->etaxi_dashboard_model->tp_pekapuran();
		$tp_jagakarsa = $this->etaxi_dashboard_model->tp_jagakarsa();
		$tp_cipayung = $this->etaxi_dashboard_model->tp_cipayung();
		
		$spj_5days_pd_bambu = $this->etaxi_dashboard_model->dashboard_spj_aktif_5_days_pondok_bambu();
		$spj_5days_pekapuran = $this->etaxi_dashboard_model->dashboard_spj_aktif_5_days_pekapuran();
		$spj_5days_cipayung = $this->etaxi_dashboard_model->dashboard_spj_aktif_5_days_cipayung();
		$spj_5days_jagakarsa = $this->etaxi_dashboard_model->dashboard_spj_aktif_5_days_jagakarsa();
		
		$this->load->view('header');
        $this->load->view('etaxi/dashboard_operation', Array('spj_pd_bambu' => $spj_pd_bambu, 'spj_pekapuran'=>$spj_pekapuran, 
			'spj_cipayung'=>$spj_cipayung, 'spj_jagakarsa'=>$spj_jagakarsa, 'sos_pd_bambu'=>$sos_pd_bambu, 'sos_pekapuran'=>$sos_pekapuran,
			'sos_jagakarsa'=>$sos_jagakarsa, 'sos_cipayung'=>$sos_cipayung,'cetakSpj_pd_bambu'=>$cetakSpj_pd_bambu,'cetakSpj_pekapuran'=>$cetakSpj_pekapuran,
			'cetakSpj_cipayung'=>$cetakSpj_cipayung,'cetakSpj_jagakarsa'=>$cetakSpj_jagakarsa,'tp_pd_bambu'=>$tp_pd_bambu,'tp_pekapuran'=>$tp_pekapuran,
			'tp_jagakarsa'=>$tp_jagakarsa,'tp_cipayung'=>$tp_cipayung,'spj_5days_pd_bambu'=>$spj_5days_pd_bambu,'spj_5days_pekapuran'=>$spj_5days_pekapuran,
			'spj_5days_cipayung'=>$spj_5days_cipayung,'spj_5days_jagakarsa'=>$spj_5days_jagakarsa));
        $this->load->view('footer');
	}
	
// =============================================================================================================================
// ============================================= DETAIL OPERASI ETAXI ==========================================================
// =============================================================================================================================

	public function Detail_operation(){
		
		$sos_pd_bambu = $this->etaxi_dashboard_model->detail_sos_pd_bambu();
		$sos_pekapuran = $this->etaxi_dashboard_model->detail_sos_pekapuran();
		$sos_jagakarsa = $this->etaxi_dashboard_model->detail_sos_jagakarsa();
		$sos_cipayung = $this->etaxi_dashboard_model->detail_sos_cipayung();
		
		$tp_pd_bambu = $this->etaxi_dashboard_model->detail_tp_pd_bambu();
		$tp_pekapuran = $this->etaxi_dashboard_model->detail_tp_pekapuran();
		$tp_jagakarsa = $this->etaxi_dashboard_model->detail_tp_jagakarsa();
		$tp_cipayung = $this->etaxi_dashboard_model->detail_tp_cipayung();
		
		$spj_5days_pd_bambu = $this->etaxi_dashboard_model->detail_spj_aktif_5_days_pondok_bambu();
		$spj_5days_pekapuran = $this->etaxi_dashboard_model->detail_spj_aktif_5_days_pekapuran();
		$spj_5days_cipayung = $this->etaxi_dashboard_model->detail_spj_aktif_5_days_cipayung();
		$spj_5days_jagakarsa = $this->etaxi_dashboard_model->detail_spj_aktif_5_days_jagakarsa();
		
		$this->load->view('header');
		$this->load->view('etaxi/detail_operation', Array('sos_pd_bambu'=>$sos_pd_bambu, 'sos_pekapuran'=>$sos_pekapuran,
			'sos_jagakarsa'=>$sos_jagakarsa, 'sos_cipayung'=>$sos_cipayung,'cetakSpj_pd_bambu'=>$cetakSpj_pd_bambu,'cetakSpj_pekapuran'=>$cetakSpj_pekapuran,
			'cetakSpj_cipayung'=>$cetakSpj_cipayung,'cetakSpj_jagakarsa'=>$cetakSpj_jagakarsa,'tp_pd_bambu'=>$tp_pd_bambu,'tp_pekapuran'=>$tp_pekapuran,
			'tp_jagakarsa'=>$tp_jagakarsa,'tp_cipayung'=>$tp_cipayung,'spj_5days_pd_bambu'=>$spj_5days_pd_bambu,'spj_5days_pekapuran'=>$spj_5days_pekapuran,
			'spj_5days_cipayung'=>$spj_5days_cipayung,'spj_5days_jagakarsa'=>$spj_5days_jagakarsa));
		$this->load->view('footer');
	}
	
	
	
	

    public function depok()
	{
		$dataSpjTodaySimtax = $this->etaxi_model->getSpjTodaySimtax();
		$dataSpjTodayEtaxi = $this->etaxi_model->getSpjTodayEtaxi();
		$dataSetoranTodaySimtax = $this->etaxi_model->getSetoranTodaySimtax();
		$dataSetoranTodayEtaxi = $this->etaxi_model->getSetoranTodayEtaxi();
		
		// $dataSpjThisMonthSimtax = $this->etaxi_model->getSpjThisMonthSimtax();
		// $dataSpjThisMonthEtaxi = $this->etaxi_model->getSpjThisMonthEtaxi();
		// $dataSetoranThisMonthSimtax = $this->etaxi_model->getSetoranThisMonthSimtax();
		// $dataSetoranThisMonthEtaxi = $this->etaxi_model->getSetoranThisMonthEtaxi();
         
		$data_spj_simtax = $this->etaxi_model->get_detail_spj_today_simtax_depok();
		$data_spj_etaxi = $this->etaxi_model->get_detail_spj_today_etaxi_depok();
		$data_detail_spj_etaxi = $this->etaxi_model->getDetailSetoranTodayEtaxi_depok();
		$data_detail_spj_simtax = $this->etaxi_model->getDetailSetoranTodaySimtax_depok();
         
        $this->load->view('header');
        $this->load->view('etaxi_depok', Array('dataSpjTodaySimtax' => $dataSpjTodaySimtax, 'dataSpjTodayEtaxi' => $dataSpjTodayEtaxi, 
		'data_spj_simtax' => $data_spj_simtax, 'data_spj_etaxi' => $data_spj_etaxi,
		'dataSetoranTodaySimtax' => $dataSetoranTodaySimtax,'dataSetoranTodayEtaxi' => $dataSetoranTodayEtaxi,
										 'dataSpjThisMonthSimtax' => $dataSpjThisMonthSimtax, 'dataSpjThisMonthEtaxi' => $dataSpjThisMonthEtaxi, 'dataSetoranThisMonthSimtax' => $dataSetoranThisMonthSimtax,'dataSetoranThisMonthEtaxi' => $dataSetoranThisMonthEtaxi,
										 'data_detail_spj_etaxi' => $data_detail_spj_etaxi, 'data_detail_spj_simtax' => $data_detail_spj_simtax));
        $this->load->view('footer');
                
    }
	
	function listActivity($name = '')
	{
        
       if(!$this->cac_user_model->is_administrator()){
			return show_404();
		}
		
		$post = $this->input->post();
		if(isset($post['username']))
		{
			if(isset($post['update'])) {
				$this->cac_user_model->update($post);
			}
			else if(isset($post['reset_pass'])){
				$this->cac_user_model->reset_pass($post['username']);
			}
			else {
				$this->cac_user_model->save($post);
			}
		}
		
		$user = array();
		if($name !== '')
			$user = $this->cac_user_model->detail($name);
			
		$data = $this->dashboard_model->dataActivity();
		$this->load->model('dashboard_model');
		$dataPool = $this->dashboard_model->get_pools();
		$arrPool = array();
		$arrPool[0] = 'All';
		foreach((Array) $dataPool AS $key => $val){
			$arrPool[$val['id']] = $val['name'];
		}
		
		$this->load->view('header');
		$this->load->view('list_activity', Array('data' => $data, 'user' => $user, 'arrPool' => $arrPool));
		$this->load->view('footer');
                
    }
    
// ================================================== ETAXI PONDOK BAMBU ==================================================

	public function index_pondok_bambu(){
		$dataSpjTodaySimtax = $this->etaxi_model->getSpjTodaySimtax_pondok_bambu();
		$dataSpjTodayEtaxi = $this->etaxi_model->getSpjTodayEtaxi_pondok_bambu();
		$dataSetoranTodaySimtax = $this->etaxi_model->getSetoranTodaySimtax_pondok_bambu();
		$dataSetoranTodayEtaxi = $this->etaxi_model->getSetoranTodayEtaxi_pondok_bambu();
		
		// $dataSpjThisMonthSimtax = $this->etaxi_model->getSpjThisMonthSimtax_pondok_bambu();
		// $dataSpjThisMonthEtaxi = $this->etaxi_model->getSpjThisMonthEtaxi_pondok_bambu();
		// $dataSetoranThisMonthSimtax = $this->etaxi_model->getSetoranThisMonthSimtax_pondok_bambu();
		// $dataSetoranThisMonthEtaxi = $this->etaxi_model->getSetoranThisMonthEtaxi_pondok_bambu();
		
		$data_spj_simtax = $this->etaxi_model->get_detail_spj_today_simtax_pondok_bambu();
		$data_spj_etaxi = $this->etaxi_model->get_detail_spj_today_etaxi_pondok_bambu();
		$data_detail_spj_etaxi = $this->etaxi_model->getDetailSetoranTodayEtaxi_pondok_bambu();
		$data_detail_spj_simtax = $this->etaxi_model->getDetailSetoranTodaySimtax_pondok_bambu();
		
		foreach($data_spj_simtax as $aV){
		$aTmp1[] = $aV['no_pintu'];
		}

		foreach($data_spj_etaxi as $aV){
		$aTmp2[] = $aV['no_pintu'];
		}

		$dif_spj = array_diff($aTmp1,$aTmp2);
		
		$this->load->view('header');
        $this->load->view('etaxi_pondok_bambu', Array('dataSpjTodaySimtax' => $dataSpjTodaySimtax, 'dataSpjTodayEtaxi' => $dataSpjTodayEtaxi, 'dataSetoranTodaySimtax' => 				$dataSetoranTodaySimtax,'dataSetoranTodayEtaxi' => $dataSetoranTodayEtaxi,'dataSpjThisMonthSimtax' => $dataSpjThisMonthSimtax, 'dataSpjThisMonthEtaxi' => $dataSpjThisMonthEtaxi, 'dataSetoranThisMonthSimtax' => $dataSetoranThisMonthSimtax,'dataSetoranThisMonthEtaxi' => $dataSetoranThisMonthEtaxi, 
		'data_spj_simtax' => $data_spj_simtax, 'data_spj_etaxi' => $data_spj_etaxi, 
		'data_detail_spj_etaxi' => $data_detail_spj_etaxi, 'data_detail_spj_simtax'=>$data_detail_spj_simtax, 'dif_spj' => $dif_spj));
        $this->load->view('footer');
		
	}
    
// =============================================================================================================================
// ============================================= DETAIL OPERASI ETAXI ==========================================================
// =============================================================================================================================
       
 /*	function upload_foto(){
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('userfile')){
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('etaxi/upload_foto', $error);
		} else {
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success', $data);
		}
		
		$this->load->view('header');
        $this->load->view('etaxi/upload_foto', Array());
        $this->load->view('footer');
	}
	
	
	 
		
        public function upload_file()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|pdf|doc';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('userfile'))
                {
                        
                    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('etaxi/upload', $error);
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    $this->load->view('etaxi/success', $data);
                }
        }
		
		*/
		
		function photo_kosong(){
			$post = $this->input->post();
			if(isset($post['cari'])){
				$res = $this->etaxi_model->cari_kip($post['kip']);
				if($res == ''){
					print_r($res);die;
					?>
					<script type="text/javascript">
						alert("Kip Tidak di Temukan.");
						window.location = "<?php echo site_url('/Etaxi/photo_kosong');?>";
					</script>
					<?php
				}else{
					//print_r($res);die;
					$res2 = $this->etaxi_model->insert_photo($res);
				}
			}
			
			$this->load->view('header');
			$this->load->view('etaxi/photo_kosong', Array());
			$this->load->view('footer');
		}
		
		function update_status_driver(){
			$post = $this->input->post();
			if(isset($post['cari'])){
				$res = $this->etaxi_model->cari_kip($post['kip']);
				if($res == ''){
					?>
					<script type="text/javascript">
						alert("Kip Tidak di Temukan.");
						window.location = "<?php echo site_url('/Etaxi/update_status_driver');?>";
					</script>
					<?php
				}else{
					$res2 = $this->etaxi_model->update_status_driver($post);
				}
			}
			
			$this->load->view('header');
			$this->load->view('etaxi/update_status_driver', Array());
			$this->load->view('footer');
		}
		
		function change_pool_driver(){
			$post = $this->input->post();
			if(isset($post['cari'])){
				$res = $this->etaxi_model->cari_kip($post['kip']);
				if($res == ''){
					?>
					<script type="text/javascript">
						alert("Kip Tidak di Temukan.");
						window.location = "<?php echo site_url('/Etaxi/change_pool_driver');?>";
					</script>
					<?php
				}else{
					$res2 = $this->etaxi_model->change_pool_driver($post);
				}
			}
			$arrPool = $this->etaxi_model->data_pool();
			$this->load->view('header');
			$this->load->view('etaxi/change_pool_driver', Array('arrPool' => $arrPool));
			$this->load->view('footer');
		}
		
		function driver_management(){
			$post = $this->input->post();
			if(isset($post['cari'])){
				$res = $this->etaxi_model->cari_kip($post['kip']);
				if($res == ''){
					?>
					<script type="text/javascript">
						alert("Kip Tidak di Temukan.");
						window.location = "<?php echo site_url('/Etaxi/driver_management');?>";
					</script>
					<?php
				}else{
					$res2 = $this->etaxi_model->driver_management($post);
				}
			}
			
			$this->load->view('header');
			$this->load->view('etaxi/driver_management', Array());
			$this->load->view('footer');
		}
	
}
