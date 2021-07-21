<?php

class Admin extends CI_Controller {
	const ADMINISTRATOR = 1;
	const KAPOOL = 4;
	const MARKETING = 5;
	const QA = 7;
	const CC = 10;
	const CASHIER = 16;
	const DM = 18;
	const CHECKER = 21;
	const OPERASIONAL = 22;
	const SOP = 500;
	const AKUNTING = 501;
	const ITMS = 800;
		
	const DATE_USE_MOCE = '2017-6-20';
	const DATE_USE_COMMENT_KS = '2017-10-1';
	const DATE_NEW_KOMISI_TIARA = '2017-11-1';
		
	function __construct() {
		parent::__construct();
		
		$this->load->model('cac_user_model');
		
		$this->module = strtolower($this->router->fetch_class());
		$this->user = $this->cac_user_model->is_login();
		if ($this->user === FALSE && $this->module !== 'login') {
			return redirect('/Login');
			exit();
		}
		
		if ($this->module !== 'login') {
			$this->load->vars('user', $this->user);
		}
		
		if ($this->module === 'revenue' || $this->module === 'operation' || $this->module === 'inventory'
			) {
			if($this->user['id_privilege'] === '5' && $this->module !== 'shelter' && $this->module !== 'ritase'){
				return redirect('/Shelter');
			} else if($this->user['id_privilege'] === '6'){
				return redirect('/Detail/index?id='.$this->user['pool'].'&date='.date('Y-m-d', strtotime("-1 days")));	
			} else if($this->user['id_privilege'] > 2 && $this->user['area'] > 0){
				return redirect('/Detail/area?id='.$this->user['area'].'&date='.date('Y-m-d', strtotime("-1 days")));
			} else if($this->user['id_privilege'] === '7' && $this->module !== 'inventory'){
				return redirect('/Inventory');
			}
		}
		
		if($this->user['id_privilege'] === '5'){ //MARKETING
			if($this->module === 'revenue' || $this->module === 'operation' || $this->module === 'driver' || $this->module === 'detail'
				|| $this->module === 'rds'
			)
				return redirect('/Shelter');
		}
		if($this->user['id_privilege'] === '6'){ //OPERASI
			if($this->module === 'revenue' || $this->module === 'operation')
				return redirect('/');
		}
		
		if($this->user['id_privilege'] === '7'){ //Checker
			if($this->module !== 'rds' && $this->module !== 'login' && $this->module !== 'users' && $this->module !== 'checker')
				return redirect('/Checker/inputRitDrop');
		}
		
		if($this->user['id_privilege'] === '8'){ //ITMS
			if($this->module !== 'rds' && $this->module !== 'operation' && $this->module !== 'detail' && $this->module !== 'map' 
				&& $this->module !== 'uber' && $this->module !== 'inventory' 
				&& $this->module !== 'uberdata' && $this->module !== 'login' && $this->module !== 'users'
				&& $this->module !== 'checker')
				return redirect('/Rds');
		}
		
		if($this->user['id_privilege'] === '9'){ //Shelter Team
			if($this->module !== 'shelter' && $this->module !== 'map' && $this->module !== 'login' && $this->module !== 'users')
				return redirect('/Shelter');
		}
		/*
		if($this->user['id_privilege'] === '10'){ //CC Team
			if($this->module !== 'callcenter' && $this->module !== 'map' && $this->module !== 'order' && $this->module !== 'login' && $this->module !== 'users')
				return redirect('/Callcenter');
		}
		*/
		if($this->user['id_privilege'] === '11'){ //Workshop Team
			if($this->module !== 'inventory' && $this->module !== 'login' && $this->module !== 'users')
				return redirect('/Inventory');
		}
		
		if($this->user['id_privilege'] === '13'){ //Airport Team
			if($this->module !== 'airport' && $this->module !== 'map' && $this->module !== 'login' && $this->module !== 'users')
				return redirect('/Airport');
		}
		
		if($this->user['id_privilege'] === '14'){ //Warroom
			if($this->module !== 'rds' && $this->module !== 'map' && $this->module !== 'login' && $this->module !== 'users'
			&& $this->module !== 'checker')
				return redirect('/Rds');
		}

		if($this->user['id_privilege'] === '15'){ //TnD
			if($this->module !== 'uber' && $this->module !== 'login' && $this->module !== 'users')
				return redirect('/Uber');
		}

		if($this->user['id_privilege'] === '16'){ //TnD
			if($this->module !== 'uber' && $this->module !== 'login' && $this->module !== 'users')
				return redirect('/C_penghitaman/index');
		}
		
		
				
		$this->_log();
	}
	
	function __destruct() {
		$this->db->close();
	}
	
	private function _log() {
		if ($this->cac_user_model->is_login() === FALSE) return;
		
		$this->load->library('user_agent');
		
		$log = array(
			'ip' => (string) $this->input->ip_address(),
			'user_agent' => (string) $this->agent->agent_string(),
			'browser' => (string) $this->agent->browser(),
			'reff_page' => (string) $this->agent->referrer(),
			'curr_page' => (string) $_SERVER["REQUEST_URI"],
			'username' => (string) $this->user['username'],
			'dt' => (string) date('Y-m-d H:i:s')
			);
		
		$this->db->insert('cac_backend_log', $log);
	}

	protected function save_log($act, $status = 'Success', $result = '') {
		if ($this->cac_user_model->is_login() !== TRUE) return;
		
		$this->load->library('user_agent');
		
		$log = array(
			'ip' => (string) $this->input->ip_address(),
			'user' => (string) array_get($this->user, 'name'),
			'dt' => date('Y-m-d H:i:s'),
			'module' => (string) $this->router->fetch_class(),
			'action' => (string) $act,
			'status' => (string) $status,
			'result' => (string) $result,
			'post' => (string) json_encode($this->input->post())
			);
		
		$this->db->insert('cac_backend_save_log', $log);
	}	
	
        protected $arrPoolDb = array( //RDS ID POOL -> DASHBOARD ID POOL
		'33' => 'simtax_depok');
        
	protected $arrPool = array( //RDS ID POOL -> DASHBOARD ID POOL
		'1' => '0', '2' => '25', '3' => '26', '4' => '27', '5' => '28', '6' => '29', '7' => '30', '8' => '31', '9' => '32', '10' => '23',
		'11' => '10', '12' => '1', '13' => '22', '14' => '17', '15' => '21', '16' => '4', '17' => '16', '18' => '19', '19' => '7', '20' => '5', 
		'21' => '2', '22' => '18', '23' => '15', '24' => '20', '25' => '3', '26' => '6', '27' => '0', '28' => '9', '29' => '8', '30' => '24', '31' => '0', 
		'32' => '34', '33' => '35', '34' => '40', '35' => '42', '36' => '50', '37' => '45', '38' => '49', '39' => '43', '40' => '0', '41' => '52', 
		'42' => '36', '43' => '0', '44' => '38', '45' => '41', '46' => '47', '47' => '39', '48' => '44', '49' => '53');
		
	protected $arrPoolMoceReguler = array( //Moce Reguler ID POOL -> DASHBOARD ID POOL
		'2' => '17', '3' => '15',  '4' => '16',  '5' => '21',  '6' => '22',  '7' => '23',  '9' => '1',  '10' => '2',  '11' => '19',  '12' => '20', 
		'19' => '3',  '20' => '4',  '32' => '24',  '33' => '8',  '34' => '18',  '35' => '7',  '36' => '10',  '37' => '6',  '38' => '5',  '50' => '9');	

	protected $arrPoolRental = array( //Rental ID POOL -> DASHBOARD ID POOL
		'82518066' => '54', '86320448' => '55', '102841766' => '56', '121697290' => '57', 
		'175798644' => '58', '203071733' => '59', '251976689' => '60'
		);
	
	protected function translate_xone($id){
		foreach((Array) $this->arrPool AS $key => $val){
			if($val == $id) return $key;
		}
		return 0;
	}
	
	protected function get_total_spj_telat($arr, $id){
		foreach((Array) $arr AS $key => $val){
			if($val['id_pool'] === $id)
				return $val['ct'];
		}
		return 0;
	}
	
	protected function get_total_spj_telat_sudah_setor($arr, $id){
		foreach((Array) $arr AS $key => $val){
			if($val['id_pool'] === $id)
				return $val['sudah_setor'];
		}
		return 0;
	}
	
	protected function get_total_setoran_spj_telat($arr, $id){
		foreach((Array) $arr AS $key => $val){
			if($val['id_pool'] === $id)
				return $val['total_setoran'];
		}
		return 0;
	}
	
	public function update_operation_now(){
		$start = $_GET['start'];
		$end = date('Y-m-d');
		
		if($this->backup_operation($start, $end)){
			redirect(site_url('/Operation/index/'.$start));
			die();
		}
	}
	
	protected function backup_operation_this_week(){
		$start = date('Y-m-d',strtotime("-7 days"));
		$end = date('Y-m-d');
		
		return $this->backup_operation($start, $end);
	}
	
	protected function backup_operation_now($date){
		return $this->backup_operation($date, $date);
	}
	
	protected function ping($host, $port = 3306, $timeout = 10) { 
	  $tB = microtime(true); 
	  $fP = @fSockOpen($host, $port, $errno, $errstr, $timeout); 
	  if (!$fP) { return "down"; } 
	  $tA = microtime(true); 
	  return round((($tA - $tB) * 1000), 0)." ms"; 
	}
	
	private function backup_operation($start, $end){
		//CHECK PING
		if($this->ping('10.0.3.200') === 'down')
			return array('down' => 'Jagakarsa');
		if($this->ping('10.0.2.200') === 'down')
			return array("down" => 'Ciganjur');
		if($this->ping('10.0.5.200') === 'down')
			return array("down" => 'Joglo');
		if($this->ping('10.0.4.200') === 'down')
			return array("down" => 'Star');
		if($this->ping('10.0.14.200') === 'down')
			return array("down" => 'Bekasi D');
		if($this->ping('10.0.10.200') === 'down')
			return array("down" => 'Bekasi B');
		if($this->ping('10.0.9.200') === 'down')
			return array("down" => 'Bekasi A');
		if($this->ping('10.0.7.200') === 'down')
			return array("down" => 'Cipondoh B');
		if($this->ping('10.0.16.200') === 'down')
			return array("down" => 'Depok');
		if($this->ping('10.0.13.200') === 'down')
			return array("down" => 'Tangsel');
		if($this->ping('10.0.6.200') === 'down')
			return array("down" => 'Cipondoh A');
		if($this->ping('10.0.11.200') === 'down')
			return array("down" => 'Bekasi C');
		if($this->ping('10.0.8.200') === 'down')
			return array("down" => 'Cipondoh C');
		if($this->ping('10.0.17.200') === 'down')
			return array("down" => 'Mustika Sari');
		if($this->ping('10.0.19.200') === 'down')
			return array("down" => 'Cipayung');
		if($this->ping('10.0.18.200') === 'down')
			return array("down" => 'D Joglo');
		if($this->ping('10.0.26.200') === 'down')
			return array("down" => 'Pekapuran');
		if($this->ping('10.0.27.200') === 'down')
			return array("down" => 'Pondok Bambu');
		if($this->ping('10.0.29.200') === 'down')
			return array("down" => 'Cipendawa');
		
		$this->load->model('simtax_bintaro_model');
		$this->load->model('simtax_ciganjur_model');
		$this->load->model('simtax_jagakarsa_model');
		$this->load->model('simtax_joglo_baru_model');	
		$this->load->model('simtax_star_model');
		$this->load->model('simtax_joglo_model');
		$this->load->model('simtax_cipondoh_a_model');		
		$this->load->model('simtax_cipondoh_b_model');
		$this->load->model('simtax_cipondoh_c_model');
		$this->load->model('simtax_tangsel_model');
			
		$this->load->model('simtax_bekasi_a_model');
		$this->load->model('simtax_bekasi_b_model');
		$this->load->model('simtax_bekasi_c_model');
		$this->load->model('simtax_bekasi_d_model');
		$this->load->model('simtax_cipendawa_model');
		$this->load->model('simtax_pondok_bambu_model');		
		$this->load->model('simtax_cipayung_model');
		$this->load->model('simtax_depok_model');
		$this->load->model('simtax_mustikasari_model');
		$this->load->model('simtax_pekapuran_model');
		
		//$this->load->model('simtax_padang_model');
		//$this->load->model('simtax_semarang_model');
	
		$this->load->model('dice_eagle_model');
			
		$this->load->model('dice_tiara_model');
	
		$data = array();
			
		$bekasi_a = $this->simtax_bekasi_a_model->datas($start, $end); //1	 
		$bekasi_b = $this->simtax_bekasi_b_model->datas($start, $end); //2
		$bekasi_c = $this->simtax_bekasi_c_model->datas($start, $end); //3
		$bekasi_d = $this->simtax_bekasi_d_model->datas($start, $end); //4
	  	$cipendawa = $this->simtax_cipendawa_model->datas($start, $end); //5
		$pondok_bambu = $this->simtax_pondok_bambu_model->datas($start, $end); //6
		$cipayung = $this->simtax_cipayung_model->datas($start, $end); //7
		$depok = $this->simtax_depok_model->datas($start, $end); //8
		$mustikasari = $this->simtax_mustikasari_model->datas($start, $end); //9
		$pekapuran = $this->simtax_pekapuran_model->datas($start, $end); //10
		
		//$padang = $this->simtax_padang_model->datas($start, $end); //11
		//$semarang = $this->simtax_semarang_model->datas($start, $end); //12
		
		$bintaro = $this->simtax_bintaro_model->datas($start, $end); //15
		$ciganjur = $this->simtax_ciganjur_model->datas($start, $end); //16
		$jagakarsa = $this->simtax_jagakarsa_model->datas($start, $end); //17
		$joglo_baru = $this->simtax_joglo_baru_model->datas($start, $end); //18
		$star = $this->simtax_star_model->datas($start, $end); //19
		$joglo = $this->simtax_joglo_model->datas($start, $end); //20
		$cipondoh_a = $this->simtax_cipondoh_a_model->datas($start, $end); //21
		$cipondoh_b = $this->simtax_cipondoh_b_model->datas($start, $end); //22
	   	$cipondoh_c = $this->simtax_cipondoh_c_model->datas($start, $end); //23
 		$tangsel = $this->simtax_tangsel_model->datas($start, $end); //24
		
		$arrData = array();
		array_push($arrData, $bekasi_a);
		array_push($arrData, $bekasi_b);
		array_push($arrData, $bekasi_c);				
		array_push($arrData, $bekasi_d);	
 		array_push($arrData, $cipendawa);
		array_push($arrData, $pondok_bambu);
		array_push($arrData, $cipayung);
		array_push($arrData, $depok);
		array_push($arrData, $mustikasari);
		array_push($arrData, $pekapuran);
		
		$arrData2 = array(); //AREA 2
		array_push($arrData2, $bintaro);
		array_push($arrData2, $ciganjur);
		array_push($arrData2, $jagakarsa);
		array_push($arrData2, $joglo_baru);
		array_push($arrData2, $star);
		array_push($arrData2, $joglo);	
		array_push($arrData2, $cipondoh_a);	
		array_push($arrData2, $cipondoh_b);				
 		array_push($arrData2, $cipondoh_c);
		array_push($arrData2, $tangsel);

		/*$arrDataLuar = array(); //AREA LUAR KOTA
		array_push($arrDataLuar, $padang);
		array_push($arrDataLuar, $semarang);*/

		
		$i = 1; //AREA 1
		foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['id_pool'] = $i;
				$arr['tgl_spj'] = $val['spj_date'];
				$arr['ops_reguler'] = $val['reguler'];
				$arr['ops_kalong'] = $val['kalong'];
				$arr['ops_tp'] = $val['tp'];
				$arr['ops_broken'] = $val['broken'];
				$arr['ops_other'] = $val['other'];
				$arr['ops_so'] = $val['sos'];
				$arr['ops_operasi'] = $val['reguler'] + $val['kalong'];
				$arr['ops_non_operasi'] = $val['tp'] + $val['broken'] + $val['other'] + $val['sos'];
				$arr['ops_total'] = $arr['ops_operasi'] + $arr['ops_non_operasi'];
				array_push($data, $arr);
			}
			$i++;
		}
		
		$i = 15; //AREA 2
		foreach((Array) $arrData2 AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['id_pool'] = $i;
				$arr['tgl_spj'] = $val['spj_date'];
				$arr['ops_reguler'] = $val['reguler'];
				$arr['ops_kalong'] = $val['kalong'];
				$arr['ops_tp'] = $val['tp'];
				$arr['ops_broken'] = $val['broken'];
				$arr['ops_other'] = $val['other'];
				$arr['ops_so'] = $val['sos'];
				$arr['ops_operasi'] = $val['reguler'] + $val['kalong'];
				$arr['ops_non_operasi'] = $val['tp'] + $val['broken'] + $val['other'] + $val['sos'];
				$arr['ops_total'] = $arr['ops_operasi'] + $arr['ops_non_operasi'];
				array_push($data, $arr);
			}
			$i++;
		}
		
		/*$i = 11; //AREA LUAR KOTA
		foreach((Array) $arrDataLuar AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['id_pool'] = $i;
				$arr['tgl_spj'] = $val['spj_date'];
				$arr['ops_reguler'] = $val['reguler'];
				$arr['ops_kalong'] = $val['kalong'];
				$arr['ops_tp'] = $val['tp'];
				$arr['ops_broken'] = $val['broken'];
				$arr['ops_other'] = $val['other'];
				$arr['ops_so'] = $val['sos'];
				$arr['ops_operasi'] = $val['reguler'] + $val['kalong'];
				$arr['ops_non_operasi'] = $val['tp'] + $val['broken'] + $val['other'] + $val['sos'];
				$arr['ops_total'] = $arr['ops_operasi'] + $arr['ops_non_operasi'];
				array_push($data, $arr);
			}
			$i++;
		}*/
		
		//EAGLE
		$arrData3 = $this->dice_eagle_model->datas($start, $end);
		$arr = array();
		foreach((Array) $arrData3['operasi'] AS $key => $val){
			$save = array();
			$save['tgl_spj'] = $val['tgl_spj'];
			$save['id_pool'] = 24 + $val['id_pool_mobil']; //MASTER POOL FOR EAGLE POOL ID RAWA BOKOR = 25
			$save['ops_reguler'] = $val['reguler'];
			$save['ops_kalong'] = $val['kalong'];									
			$save['ops_operasi'] = $save['ops_reguler'] + $save['ops_kalong'];
			$save['ops_non_operasi'] = 0;
			$ct_eagle_aktif = 0;
			foreach((Array) $arrData3['status_all'] AS $key2 => $val2){
				if($val['id_pool_mobil'] === $val2['id_pool']){
					if($val2['status'] === 'active'){
						$ct_eagle_aktif += $val2['ct'];
					} else if($val2['status'] === 'inactive - surat - surat'){
						$save['ops_surat'] = $val2['ct'];
						$save['ops_non_operasi'] += $val2['ct'];						
					} else if($val2['status'] === 'inactive - body repair'){
						$save['ops_broken'] = $val2['ct'];
						$save['ops_non_operasi'] += $val2['ct'];
					} else if($val2['status'] === 'inactive - tidak layak operasi'){
						$save['ops_tl'] = $val2['ct'];
						$save['ops_non_operasi'] += $val2['ct'];
					} else if($val2['status'] === 'inactive - argo/rds'){
						$save['ops_argo_rds'] = $val2['ct'];
						$save['ops_non_operasi'] += $val2['ct'];
					} else if($val2['status'] === 'inactive - lain lain'){
						$save['ops_other'] = $val2['ct'];
						$save['ops_non_operasi'] += $val2['ct'];					
					}
				}
			}
			$save['ops_tp'] = $ct_eagle_aktif - $save['ops_operasi'];
			$save['ops_non_operasi'] += $save['ops_tp'];			
			$save['ops_total'] = $save['ops_operasi'] + $save['ops_non_operasi'];	
			array_push($data, $save);		
		}
		
		//TIARA
		$arrData4 = $this->dice_tiara_model->datas($start, $end);
		$arr = array();
		foreach((Array) $arrData4['operasi'] AS $key => $val){
			$save = array();
			$save['tgl_spj'] = $val['tgl_spj'];
			$save['id_pool'] = 32 + $val['id_pool_mobil']; //MASTER POOL FOR TIARA POOL ID MEGAPOOL = 33
			$save['ops_reguler'] = $val['reguler'];
			$save['ops_kalong'] = $val['kalong'];									
			$save['ops_operasi'] = $save['ops_reguler'] + $save['ops_kalong'];
			$save['ops_non_operasi'] = 0;
			$ct_tiara_aktif = 0;
			foreach((Array) $arrData4['status_all'] AS $key2 => $val2){
				if($val['id_pool_mobil'] === $val2['id_pool']){
					if($val2['status'] === 'active'){
						$ct_tiara_aktif += $val2['ct'];
					} else if($val2['status'] === 'inactive - body repair'){
						$save['ops_broken'] = $val2['ct'];
						$save['ops_non_operasi'] += $val2['ct'];
					} else if($val2['status'] === 'inactive - tidak layak operasi'){
						$save['ops_tl'] = $val2['ct'];
						$save['ops_non_operasi'] += $val2['ct'];
					} else if($val2['status'] === 'inactive - lain lain'){
						$save['ops_other'] = $val2['ct'];
						$save['ops_non_operasi'] += $val2['ct'];					
					}
				}
			}
			$save['ops_tp'] = $ct_tiara_aktif - $save['ops_operasi'];
			$save['ops_non_operasi'] += $save['ops_tp'];			
			$save['ops_total'] = $save['ops_operasi'] + $save['ops_non_operasi'];	
			array_push($data, $save);		
		}
		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup($data);
		
		return $data;
	}
	
	public function update_revenue_now(){
		$start = $_GET['start'];
		$end = date('Y-m-d',strtotime("-1 days"));
		
		if($this->backup_revenue($start, $end)){
			redirect(site_url('/Revenue/index/'.$start));
			die();
		}
	}
	
	protected function backup_revenue_this_week(){
		$start = date('Y-m-d',strtotime("-9 days"));
		$end = date('Y-m-d',strtotime("-1 days"));
		
		$this->backup_revenue($start, $end);
	}
	
	protected function backup_revenue_now($date){
		return $this->backup_revenue($date, $date);
	}
	
	protected function backup_revenue($start, $end){
		$data = array();
		$this->load->model('dashboard_model');
		
		$this->load->model('simtax_bekasi_a_model');
		$this->load->model('simtax_bekasi_b_model');
		$this->load->model('simtax_bekasi_c_model');
		$this->load->model('simtax_bekasi_d_model');
		$this->load->model('simtax_cipendawa_model');
		$this->load->model('simtax_pondok_bambu_model');		
		$this->load->model('simtax_cipayung_model');
		$this->load->model('simtax_depok_model');
		$this->load->model('simtax_mustikasari_model');
		$this->load->model('simtax_pekapuran_model');
// 		$this->load->model('simtax_padang_model');
// 		$this->load->model('simtax_semarang_model');
		
		$this->load->model('simtax_bintaro_model');
		$this->load->model('simtax_ciganjur_model');
		$this->load->model('simtax_jagakarsa_model');
		$this->load->model('simtax_joglo_baru_model');	
		$this->load->model('simtax_star_model');
		$this->load->model('simtax_joglo_model');
		$this->load->model('simtax_cipondoh_a_model');		
		$this->load->model('simtax_cipondoh_b_model');
		$this->load->model('simtax_cipondoh_c_model');
		$this->load->model('simtax_tangsel_model');
		
		$this->load->model('dice_eagle_model');
				
		$this->load->model('dice_tiara_model');
		
		$bekasi_a = $this->simtax_bekasi_a_model->revenue_set($start, $end); //1	 
		$bekasi_b = $this->simtax_bekasi_b_model->revenue_set($start, $end); //2
		$bekasi_c = $this->simtax_bekasi_c_model->revenue_set($start, $end); //3
		$bekasi_d = $this->simtax_bekasi_d_model->revenue_set($start, $end); //4
	  	$cipendawa = $this->simtax_cipendawa_model->revenue_set($start, $end); //5
		$pondok_bambu = $this->simtax_pondok_bambu_model->revenue_set($start, $end); //6
		$cipayung = $this->simtax_cipayung_model->revenue_set($start, $end); //7
		$depok = $this->simtax_depok_model->revenue_set($start, $end); //8
		$mustikasari = $this->simtax_mustikasari_model->revenue_set($start, $end); //9
		$pekapuran = $this->simtax_pekapuran_model->revenue_set($start, $end); //10
		
		//$padang = $this->simtax_padang_model->revenue_set($start, $end); //11
		//$semarang = $this->simtax_semarang_model->revenue_set($start, $end); //12
		
		$bintaro = $this->simtax_bintaro_model->revenue_set($start, $end); //15
		$ciganjur = $this->simtax_ciganjur_model->revenue_set($start, $end); //16
		$jagakarsa = $this->simtax_jagakarsa_model->revenue_set($start, $end); //17
		$joglo_baru = $this->simtax_joglo_baru_model->revenue_set($start, $end); //18
		$star = $this->simtax_star_model->revenue_set($start, $end); //19
		$joglo = $this->simtax_joglo_model->revenue_set($start, $end); //20
		$cipondoh_a = $this->simtax_cipondoh_a_model->revenue_set($start, $end); //21
		$cipondoh_b = $this->simtax_cipondoh_b_model->revenue_set($start, $end); //22
	   	$cipondoh_c = $this->simtax_cipondoh_c_model->revenue_set($start, $end); //23
 		$tangsel = $this->simtax_tangsel_model->revenue_set($start, $end); //24
		
		$arrData = array();
		array_push($arrData, $bekasi_a);
		array_push($arrData, $bekasi_b);
		array_push($arrData, $bekasi_c);				
		array_push($arrData, $bekasi_d);	
 		array_push($arrData, $cipendawa);
		array_push($arrData, $pondok_bambu);
		array_push($arrData, $cipayung);
		array_push($arrData, $depok);
		array_push($arrData, $mustikasari);
		array_push($arrData, $pekapuran);
		
		$arrData2 = array(); //AREA 2
		array_push($arrData2, $bintaro);
		array_push($arrData2, $ciganjur);
		array_push($arrData2, $jagakarsa);
		array_push($arrData2, $joglo_baru);
		array_push($arrData2, $star);
		array_push($arrData2, $joglo);	
		array_push($arrData2, $cipondoh_a);	
		array_push($arrData2, $cipondoh_b);				
 		array_push($arrData2, $cipondoh_c);
		array_push($arrData2, $tangsel);
		
		$i = 1; //AREA 1
		foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['id_pool'] = $i;
				$arr['tgl_spj'] = $val['spj_date'];
				$arr['total_spj'] = $val['total_spj'];
				$arr['total_rev'] = $val['total_rev_spj'];
				$arr['tagihan_operasi'] = $val['tagihan_spj'];
				$arr['ks_operasi'] = $val['ks_spj'];
				$arr['ks_non_operasi'] = $val['tagihan_non_spj'];
				$arr['angsuran_ks'] = $val['angsuran_ks'];		
				$arr['bayar_hutang'] = $val['bayar_hutang'];		
				$arr['total_arpof'] = number_format(($arr['total_rev'] / $arr['total_spj']),2 ,'.', '');	
				array_push($data, $arr);
			}
			$i++;
		}
		
		$i = 15; //AREA 2
		foreach((Array) $arrData2 AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['id_pool'] = $i;
				$arr['tgl_spj'] = $val['spj_date'];
				$arr['total_spj'] = $val['total_spj'];
				$arr['total_rev'] = $val['total_rev_spj'];
				$arr['tagihan_operasi'] = $val['tagihan_spj'];
				$arr['ks_operasi'] = $val['ks_spj'];
				$arr['ks_non_operasi'] = $val['tagihan_non_spj'];
				$arr['angsuran_ks'] = $val['angsuran_ks'];	
				$arr['bayar_hutang'] = $val['bayar_hutang'];			
				$arr['total_arpof'] = number_format(($arr['total_rev'] / $arr['total_spj']),2 ,'.', '');		
				array_push($data, $arr);
			}
			$i++;
		}
		
		//EAGLE
		$arrData3 = $this->dice_eagle_model->revenues($start, $end);
		$arr = array();
		foreach((Array) $arrData3 AS $skey => $val){
			$arr = array();
			$arr['id_pool'] = 24 + $val['id_pool_mobil']; //MASTER POOL FOR EAGLE POOL ID RAWA BOKOR = 25
			$arr['tgl_spj'] = $val['tgl_spj'];
			$arr['total_spj'] = $val['total_spj'];
			$arr['total_rev'] = $val['total_rev'];
			$arr['total_gross'] = $val['total_gross'];
			$arr['total_komisi'] = $val['total_komisi'];
			$arr['total_bbm'] = $val['total_bbm'];
			$arr['total_lain'] = $val['total_lain'];
			$arr['total_denda'] = $val['total_denda'];
			$arr['hutang_baru'] = $val['hutang_baru'];
			$arr['bayar_hutang'] = $val['bayar_hutang'];						
			$arr['total_arpof'] = number_format((($arr['total_rev'] + $arr['total_denda'] + $arr['bayar_hutang'] + ($arr['total_lain'] > 0 ? $arr['total_lain'] : 0)) / $arr['total_spj']),2, '.', '');		
			array_push($data, $arr);
		}
		
		//TIARA
		$arrData4 = $this->dice_tiara_model->revenues($start, $end);
		$arr = array();
		foreach((Array) $arrData4 AS $skey => $val){
			$arr = array();
			$arr['id_pool'] = 32 + $val['id_pool_mobil']; //MASTER POOL FOR TIARA POOL ID MEGAPOOL = 33
			$arr['tgl_spj'] = $val['tgl_spj'];
			$arr['total_spj'] = $val['total_spj'];
			$arr['total_rev'] = $val['total_rev'];
			$arr['total_gross'] = $val['total_gross'];
			$arr['total_komisi'] = $val['total_komisi'];
			$arr['total_bbm'] = $val['total_bbm'];
			$arr['total_lain'] = $val['total_lain'];
			$arr['total_denda'] = $val['total_denda'];
			$arr['hutang_baru'] = $val['hutang_baru'];
			$arr['bayar_hutang'] = $val['bayar_hutang'];	
			$arr['nominal_insentif_kehadiran'] = $val['nominal_insentif_kehadiran'];					
			$arr['total_arpof'] = number_format((($arr['total_rev'] + $arr['total_denda'] + $arr['bayar_hutang'] + ($arr['total_lain'] > 0 ? $arr['total_lain'] : 0)) / $arr['total_spj']),2, '.', '');		
			array_push($data, $arr);
		}
		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_rev($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_rev($data);
		
		return $data;
	}
	
	protected function backup_driver_today($date){
		return $this->backup_driver($date, $date);
	}
	
	private function backup_driver($start, $end){
		$data = array();
		
		$this->load->model('simtax_bekasi_a_model');
		$this->load->model('simtax_bekasi_b_model');
		$this->load->model('simtax_bekasi_c_model');
		$this->load->model('simtax_bekasi_d_model');
		$this->load->model('simtax_cipendawa_model');
		$this->load->model('simtax_pondok_bambu_model');		
		$this->load->model('simtax_cipayung_model');
		$this->load->model('simtax_depok_model');
		$this->load->model('simtax_mustikasari_model');
		$this->load->model('simtax_pekapuran_model');
		
		$this->load->model('simtax_bintaro_model');
		$this->load->model('simtax_ciganjur_model');
		$this->load->model('simtax_jagakarsa_model');
		$this->load->model('simtax_joglo_baru_model');	
		$this->load->model('simtax_star_model');
		$this->load->model('simtax_joglo_model');
		$this->load->model('simtax_cipondoh_a_model');		
		$this->load->model('simtax_cipondoh_b_model');
		$this->load->model('simtax_cipondoh_c_model');
		$this->load->model('simtax_tangsel_model');
		
		$this->load->model('dice_eagle_model');
				
		$this->load->model('dice_tiara_model');
		
		$bekasi_a = $this->simtax_bekasi_a_model->drivers($start, $end); //1	 
		$bekasi_b = $this->simtax_bekasi_b_model->drivers($start, $end); //2
		$bekasi_c = $this->simtax_bekasi_c_model->drivers($start, $end); //3
		$bekasi_d = $this->simtax_bekasi_d_model->drivers($start, $end); //4
	  	$cipendawa = $this->simtax_cipendawa_model->drivers($start, $end); //5
		$pondok_bambu = $this->simtax_pondok_bambu_model->drivers($start, $end); //6
		$cipayung = $this->simtax_cipayung_model->drivers($start, $end); //7
		$depok = $this->simtax_depok_model->drivers($start, $end); //8
		$mustikasari = $this->simtax_mustikasari_model->drivers($start, $end); //9
		$pekapuran = $this->simtax_pekapuran_model->drivers($start, $end); //10
		
		$bintaro = $this->simtax_bintaro_model->drivers($start, $end); //15
		$ciganjur = $this->simtax_ciganjur_model->drivers($start, $end); //16
		$jagakarsa = $this->simtax_jagakarsa_model->drivers($start, $end); //17
		$joglo_baru = $this->simtax_joglo_baru_model->drivers($start, $end); //18
		$star = $this->simtax_star_model->drivers($start, $end); //19
		$joglo = $this->simtax_joglo_model->drivers($start, $end); //20
		$cipondoh_a = $this->simtax_cipondoh_a_model->drivers($start, $end); //21
		$cipondoh_b = $this->simtax_cipondoh_b_model->drivers($start, $end); //22
	   	$cipondoh_c = $this->simtax_cipondoh_c_model->drivers($start, $end); //23
 		$tangsel = $this->simtax_tangsel_model->drivers($start, $end); //24
		
		$arrData = array();
		array_push($arrData, $bekasi_a);
		array_push($arrData, $bekasi_b);
		array_push($arrData, $bekasi_c);				
		array_push($arrData, $bekasi_d);	
 		array_push($arrData, $cipendawa);
		array_push($arrData, $pondok_bambu);
		array_push($arrData, $cipayung);
		array_push($arrData, $depok);
		array_push($arrData, $mustikasari);
		array_push($arrData, $pekapuran);
		
		$arrData2 = array(); //AREA 2
		array_push($arrData2, $bintaro);
		array_push($arrData2, $ciganjur);
		array_push($arrData2, $jagakarsa);
		array_push($arrData2, $joglo_baru);
		array_push($arrData2, $star);
		array_push($arrData2, $joglo);	
		array_push($arrData2, $cipondoh_a);	
		array_push($arrData2, $cipondoh_b);				
 		array_push($arrData2, $cipondoh_c);
		array_push($arrData2, $tangsel);
		
		$i = 1; //AREA 1
		foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['id_pool'] = $i;
				$arr['tgl'] = $val['tgl_snapshot'];
				$arr['bravo_aktif'] = $val['bravo_aktif'];
				$arr['bravo_inaktif'] = $val['bravo_inaktif'];
				$arr['charli_aktif'] = $val['charli_aktif'];
				$arr['charli_inaktif'] = $val['charli_inaktif'];
				
				$arr['d1'] = $val['d1'];
				$arr['d2'] = $val['d2'];
				$arr['d3'] = $val['d3'];
				$arr['d4'] = $val['d4'];
				$arr['d5'] = $val['d5'];
				$arr['d6'] = $val['d6'];
				$arr['d7'] = $val['d7'];
				$arr['d8'] = $val['d8'];
				$arr['d9'] = $val['d9'];
				$arr['d10'] = $val['d10'];
				$arr['d11'] = $val['d11'];
				$arr['d12'] = $val['d12'];
				$arr['d13'] = $val['d13'];
				$arr['d14'] = $val['d14'];
				$arr['d15'] = $val['d15'];
				$arr['d16'] = $val['d16'];
				$arr['d17'] = $val['d17'];
				$arr['d18'] = $val['d18'];
				$arr['d19'] = $val['d19'];
				$arr['d20'] = $val['d20'];
				$arr['d21'] = $val['d21'];
				$arr['d22'] = $val['d22'];
				$arr['d23'] = $val['d23'];
				$arr['d24'] = $val['d24'];
				$arr['d25'] = $val['d25'];
				$arr['d26'] = $val['d26'];
				$arr['d27'] = $val['d27'];
				$arr['d28'] = $val['d28'];
				$arr['d29'] = $val['d29'];
				$arr['d30'] = $val['d30'];
				$arr['d31'] = $val['d31'];
				array_push($data, $arr);			
			}
			$i++;
		}
		
		$i = 15; //AREA 2	
		foreach((Array) $arrData2 AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['id_pool'] = $i;
				$arr['tgl'] = $val['tgl_snapshot'];
				$arr['bravo_aktif'] = $val['bravo_aktif'];
				$arr['bravo_inaktif'] = $val['bravo_inaktif'];
				$arr['charli_aktif'] = $val['charli_aktif'];
				$arr['charli_inaktif'] = $val['charli_inaktif'];
				
				$arr['d1'] = $val['d1'];
				$arr['d2'] = $val['d2'];
				$arr['d3'] = $val['d3'];
				$arr['d4'] = $val['d4'];
				$arr['d5'] = $val['d5'];
				$arr['d6'] = $val['d6'];
				$arr['d7'] = $val['d7'];
				$arr['d8'] = $val['d8'];
				$arr['d9'] = $val['d9'];
				$arr['d10'] = $val['d10'];
				$arr['d11'] = $val['d11'];
				$arr['d12'] = $val['d12'];
				$arr['d13'] = $val['d13'];
				$arr['d14'] = $val['d14'];
				$arr['d15'] = $val['d15'];
				$arr['d16'] = $val['d16'];
				$arr['d17'] = $val['d17'];
				$arr['d18'] = $val['d18'];
				$arr['d19'] = $val['d19'];
				$arr['d20'] = $val['d20'];
				$arr['d21'] = $val['d21'];
				$arr['d22'] = $val['d22'];
				$arr['d23'] = $val['d23'];
				$arr['d24'] = $val['d24'];
				$arr['d25'] = $val['d25'];
				$arr['d26'] = $val['d26'];
				$arr['d27'] = $val['d27'];
				$arr['d28'] = $val['d28'];
				$arr['d29'] = $val['d29'];
				$arr['d30'] = $val['d30'];
				$arr['d31'] = $val['d31'];
				array_push($data, $arr);
			}
			$i++;
		}
		
		//EAGLE
		$arrData3 = $this->dice_eagle_model->drivers($start, $end);
		$arr = array();
		foreach((Array) $arrData3 AS $skey => $val){
			$arr = array();
			$arr['id_pool'] = 24 + $val['id_pool']; //MASTER POOL FOR EAGLE POOL ID RAWA BOKOR = 25
			$arr['tgl'] = $val['tgl_snapshot'];
			$arr['driver_aktif'] = $val['active'];
			$arr['driver_inaktif'] = $val['inactive'];
			$arr['driver_blacklist'] = $val['blacklist'];
			$arr['driver_retire'] = $val['retire'];	
			
			$arr['d1'] = $val['d1'];
			$arr['d2'] = $val['d2'];
			$arr['d3'] = $val['d3'];
			$arr['d4'] = $val['d4'];
			$arr['d5'] = $val['d5'];
			$arr['d6'] = $val['d6'];
			$arr['d7'] = $val['d7'];
			$arr['d8'] = $val['d8'];
			$arr['d9'] = $val['d9'];
			$arr['d10'] = $val['d10'];
			$arr['d11'] = $val['d11'];
			$arr['d12'] = $val['d12'];
			$arr['d13'] = $val['d13'];
			$arr['d14'] = $val['d14'];
			$arr['d15'] = $val['d15'];
			$arr['d16'] = $val['d16'];
			$arr['d17'] = $val['d17'];
			$arr['d18'] = $val['d18'];
			$arr['d19'] = $val['d19'];
			$arr['d20'] = $val['d20'];
			$arr['d21'] = $val['d21'];
			$arr['d22'] = $val['d22'];
			$arr['d23'] = $val['d23'];
			$arr['d24'] = $val['d24'];
			$arr['d25'] = $val['d25'];
			$arr['d26'] = $val['d26'];
			$arr['d27'] = $val['d27'];
			$arr['d28'] = $val['d28'];
			$arr['d29'] = $val['d29'];
			$arr['d30'] = $val['d30'];
			$arr['d31'] = $val['d31'];		
			array_push($data, $arr);
		}
		
		//TIARA
		$arrData4 = $this->dice_tiara_model->drivers($start, $end);
		$arr = array();
		foreach((Array) $arrData4 AS $skey => $val){
			$arr = array();
			$arr['id_pool'] = 32 + $val['id_pool']; //MASTER POOL FOR TIARA POOL ID MEGAPOOL = 33
			$arr['tgl'] = $val['tgl_snapshot'];
			$arr['driver_aktif'] = $val['active'];
			$arr['driver_inaktif'] = $val['inactive'];
			$arr['driver_blacklist'] = $val['blacklist'];
			$arr['driver_retire'] = $val['retire'];
			
			$arr['d1'] = $val['d1'];
			$arr['d2'] = $val['d2'];
			$arr['d3'] = $val['d3'];
			$arr['d4'] = $val['d4'];
			$arr['d5'] = $val['d5'];
			$arr['d6'] = $val['d6'];
			$arr['d7'] = $val['d7'];
			$arr['d8'] = $val['d8'];
			$arr['d9'] = $val['d9'];
			$arr['d10'] = $val['d10'];
			$arr['d11'] = $val['d11'];
			$arr['d12'] = $val['d12'];
			$arr['d13'] = $val['d13'];
			$arr['d14'] = $val['d14'];
			$arr['d15'] = $val['d15'];
			$arr['d16'] = $val['d16'];
			$arr['d17'] = $val['d17'];
			$arr['d18'] = $val['d18'];
			$arr['d19'] = $val['d19'];
			$arr['d20'] = $val['d20'];
			$arr['d21'] = $val['d21'];
			$arr['d22'] = $val['d22'];
			$arr['d23'] = $val['d23'];
			$arr['d24'] = $val['d24'];
			$arr['d25'] = $val['d25'];
			$arr['d26'] = $val['d26'];
			$arr['d27'] = $val['d27'];
			$arr['d28'] = $val['d28'];
			$arr['d29'] = $val['d29'];
			$arr['d30'] = $val['d30'];
			$arr['d31'] = $val['d31'];				
			array_push($data, $arr);
		}
		
		$this->load->model('dashboard_model');		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_driver($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_driver($data);
		
		return $data;		
	}
	
	//RITASE SHELTER
	protected function backup_ritase_shelter_this_week(){
		$start = date('Y-m-d',strtotime("-9 days"));
		$end = date('Y-m-d',strtotime("-1 days"));
		
		$this->backup_ritase_shelter($start, $end);
	}
	
	private function backup_ritase_shelter($start, $end){
		$data = array();
		
		$this->load->model('xone_model');
		$this->load->model('dashboard_model');
		
		$arrShelter = $this->dashboard_model->get_shelters();
		$this->xone_model->load_database();	
		foreach((Array) $arrShelter AS $key => $val){
			$arrData = $this->xone_model->shelter_ritase($start, $end, $val['lat'], $val['lng'], $val['radius']);	
			foreach((Array) $arrData AS $key2 => $val2){		
				$a = array();
				$a['tgl'] = $val2['tgl'];
				$a['id'] = $val['id'];
				$a['ritase'] = $val2['ritase'];
				$a['argo'] = $val2['argo'];
				array_push($data, $a);
			}
		}
		$this->xone_model->close_database();			
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_ritase_shelter($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_ritase_shelter($data);	
	}
	
	//SETORAN UBER
	protected function backup_uber_driver_setoran($id, $date){
		$start = $date;
		$end = $date;
		$data = array();
		
		$this->load->model('simtax_bekasi_a_model');
		$this->load->model('simtax_bekasi_b_model');
		$this->load->model('simtax_bekasi_c_model');
		$this->load->model('simtax_bekasi_d_model');
		$this->load->model('simtax_cipendawa_model');
		$this->load->model('simtax_pondok_bambu_model');		
		$this->load->model('simtax_cipayung_model');
		$this->load->model('simtax_depok_model');
		$this->load->model('simtax_mustikasari_model');
		$this->load->model('simtax_pekapuran_model');
		
		$this->load->model('simtax_bintaro_model');
		$this->load->model('simtax_ciganjur_model');
		$this->load->model('simtax_jagakarsa_model');
		$this->load->model('simtax_joglo_baru_model');	
		$this->load->model('simtax_star_model');
		$this->load->model('simtax_joglo_model');
		$this->load->model('simtax_cipondoh_a_model');		
		$this->load->model('simtax_cipondoh_b_model');
		$this->load->model('simtax_cipondoh_c_model');
		$this->load->model('simtax_tangsel_model');
		
		$this->load->model('dashboard_model');		
		
		$this->load->model('xone_model');	
		$this->xone_model->load_database();
		switch($id){
			case 1:
				$model = $this->simtax_bekasi_a_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 2:
				$model = $this->simtax_bekasi_b_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 3:
				$model = $this->simtax_bekasi_c_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 4:
				$model = $this->simtax_bekasi_d_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 5:
				$model = $this->simtax_cipendawa_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;			
			case 6:
				$model = $this->simtax_pondok_bambu_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 7:
				$model = $this->simtax_cipayung_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 8:
				$model = $this->simtax_depok_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 9:
				$model = $this->simtax_mustikasari_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 10:
				$model = $this->simtax_pekapuran_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;			
			case 15:
				$model = $this->simtax_bintaro_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;			
			case 16:
				$model = $this->simtax_ciganjur_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 17:
				$model = $this->simtax_jagakarsa_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 18:
				$model = $this->simtax_joglo_baru_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 19:
				$model = $this->simtax_star_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 20:
				$model = $this->simtax_joglo_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;													
			case 21:
				$model = $this->simtax_cipondoh_a_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 22:
				$model = $this->simtax_cipondoh_b_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 23:
				$model = $this->simtax_cipondoh_c_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;
			case 24:
				$model = $this->simtax_tangsel_model;
				$arr = $this->loadSetoranUberDriver($start, $end, $id, $model);
				$data = array_merge($data, $arr);
				break;													
		}
		$this->xone_model->close_database();		
			
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_uber_driver_setoran_pool($date, $id);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_uber_driver_setoran($data);
	}
	
	private function loadSetoranUberDriver($start, $end, $id_pool, $model){
		$data = array();
		$arrDriver = $this->dashboard_model->load_drivers_from_pool($id_pool);
		$db = $model->load_db();
		foreach((Array) $arrDriver AS $key2 => $val2){
			$arrData = $model->setoran_get($start, $end, $val2['kip']); //1	 
			foreach((Array) $arrData AS $key3 => $val3){
				$arr = array();						
				$arr['tgl_spj'] = $val3['spj_date'];
				$arr['id_pool'] = $id_pool;
				$arr['kip'] = $val2['kip'];
				$arr['no_pintu'] = $val3['reg_no'];
				$arr['setor'] = $val3['setor'];
				$arr['s_wajib'] = $val3['s_wajib'];
				$arr['s_lain'] = $val3['s_lain'];
				$arr['denda'] = $val3['denda'];
				$arr['ks'] = $val3['ks'];	
				$arr['tipe_ops'] = $val3['tipe_ops'];							
				$arrRDS = $this->xone_model->get_trip_sum($arr['tgl_spj'], $arr['no_pintu'], $arr['tipe_ops']);
				$arr['rit_rds'] = 0;
				$arr['argo_rds'] = 0;
				$arr['bayar_ks'] = 0;
				$arr['rit_rds'] += $arrRDS[0]['trip'];
				$arr['argo_rds'] += $arrRDS[0]['argo'];		
				if($arr['setor'] == 0){
					$arr['bayar_ks'] += $model->adjustment_get($arr['tgl_spj'], $arr['no_pintu'])[0]['adjust_ks'];
				}
				array_push($data, $arr);				
			}
		}
		$db->close();
		return $data;
	}
	
	protected function readExcel(){
		$file = APPPATH.'./files/drivers.csv';
		//load the excel library
		$this->load->library('excel');
		//read file from path
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		//get only the Cell Collection
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		//extract to a PHP readable array format
		foreach ($cell_collection as $cell) {
			$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			//header will/should be in row 1 only. of course this can be modified to suit your need.
			if ($row == 1) {
				$header[$row][$column] = $data_value;
			} else {
				$arr_data[$row][$column] = $data_value;
			}
		}
		//send the data in an array format
		$data['header'] = $header;
		$data['values'] = $arr_data;
		
		foreach((Array) $data['values'] AS $key => $val){
			foreach((Array) $val AS $key2 => $val2)
			{
				print_r($val);
			}
			die();
		}
		die();
	}
	
	//CHECK COMMENT KS
	protected function checkCommentKS($id_pool, $date){
		if($this->user['id_privilege'] === '6' || $this->user['id_privilege'] === '4'){ //Operasi, Kapool, AM Check
			if($this->user['id_privilege'] === '4' && $this->user['pool'] !== '0'){
				$id_pool = $this->user['pool'].','.$id_pool;
			}
			if($this->user['area'] === '4'){
				return [];
			}
			if($this->user['id_privilege'] === '4' && $this->user['pool'] === '0'){ //AM
				$arr = $this->dashboard_model->get_pool_id_in_area($this->user['area']);
				$id_pool = '';
				foreach((Array) $arr AS $key => $val){
					if($id_pool === '')
						$id_pool .= $val['id'];
					else
						$id_pool .= ', '.$val['id'];
				}
			}
			$data = $this->dashboard_model->check_comment_ks($id_pool, $date);
			if(Count($data) > 0){
				return $data;
			}
			return [];
		}
		else {
			return [];
		}
	}
	
	protected function get_privilege(){
		$arrPrivilege = array(Admin::ADMINISTRATOR => 'ADMINISTRATOR', Admin::KAPOOL => 'KAPOOL', 
			Admin::MARKETING => 'MARKETING', Admin::QA => 'QA', Admin::CC => 'CC', Admin::CASHIER => 'CASHIER', Admin::DM=>'DM', 
			Admin::CHECKER=>'CHECKER', Admin::OPERASIONAL=>'OPERASIONAL', Admin::SOP=>'SOP', Admin::AKUNTING=>'AKUNTING', 
			Admin::ITMS=>'ITMS');
    	return $arrPrivilege;
	}
	
}

?>