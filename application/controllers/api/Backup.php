<?php

include_once('Api.php');

class Backup extends Api {
	function index() {
		$this->_print('Hello'); 
	}
	
	//OPERATION
	function backup_operation_this_week(){
		$start = date('Y-m-d',strtotime("-4 days"));
		$end = date('Y-m-d');
		
		return $this->backup_operation($start, $end);
	}
	
	function operation(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_operation($start, $end);
	}
	
	private function backup_operation($start, $end){
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
		
// 		$bekasi_a = $this->simtax_bekasi_a_model->datas($start, $end); //1	 
		$bekasi_a = array(); //pool ditutup	 
		$bekasi_b = $this->simtax_bekasi_b_model->datas($start, $end); //2
		$bekasi_c = $this->simtax_bekasi_c_model->datas($start, $end); //3
		$bekasi_d = $this->simtax_bekasi_d_model->datas($start, $end); //4
	  	$cipendawa = $this->simtax_cipendawa_model->datas($start, $end); //5
		$pondok_bambu = $this->simtax_pondok_bambu_model->datas($start, $end); //6
		$cipayung = $this->simtax_cipayung_model->datas($start, $end); //7
		$depok = $this->simtax_depok_model->datas($start, $end); //8
		$mustikasari = $this->simtax_mustikasari_model->datas($start, $end); //9
		$pekapuran = $this->simtax_pekapuran_model->datas($start, $end); //10
		
// 		$padang = $this->simtax_padang_model->datas($start, $end); //11
// 		$semarang = $this->simtax_semarang_model->datas($start, $end); //12
		
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
		
		/*$arrDataLuar = array(); //AREA LUAR JAKARTA
		array_push($arrDataLuar, $padang);
		array_push($arrDataLuar, $semarang);*/
		$pool_updated = array();
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
				array_push($pool_updated, $arr['id_pool']);
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
				array_push($pool_updated, $arr['id_pool']);				
			}
			$i++;
		}
		
		/*$i = 11; //AREA 2
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
			if($save['id_pool'] >= 33) //TIARA MEGAPOOL
				$save['id_pool']++;
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
			array_push($pool_updated, $save['id_pool']);	
		}
		
		//TIARA
		$arrData4 = $this->dice_tiara_model->datas($start, $end);
		$arr = array();
		foreach((Array) $arrData4['operasi'] AS $key => $val){
			$save = array();
			$save['tgl_spj'] = $val['tgl_spj'];
			if($val['id_pool_mobil'] == 1)
				$save['id_pool'] = 32 + $val['id_pool_mobil']; //MASTER POOL FOR TIARA POOL ID MEGAPOOL = 33
			else
				$save['id_pool'] = 59 + $val['id_pool_mobil']; //MASTER POOL FOR TIARA POOL ID PONDOK BAMBU = 61
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
			array_push($pool_updated, $save['id_pool']);				
		}

		$this->load->model('dashboard_model');
		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup($start, $end, $pool_updated);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup($data);
		
		return $this->_print('SUCCESS!');
	}
	
	//REVENUE
 	function backup_revenue_this_week(){
		$start = date('Y-m-d',strtotime("-3 days"));
		$end = date('Y-m-d',strtotime("-1 days"));
		
		return $this->backup_revenue($start, $end);
	}
	
	function revenue(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_revenue($start, $end);
	}
	
	private function backup_revenue($start, $end){
		$data = array();
		
//		$this->load->model('simtax_bekasi_a_model');
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
//		$this->load->model('simtax_cipondoh_a_model');		
		$this->load->model('simtax_cipondoh_b_model');
		$this->load->model('simtax_cipondoh_c_model');
		$this->load->model('simtax_tangsel_model');
		
//		$this->load->model('dice_eagle_model');
				
//		$this->load->model('dice_tiara_model');
		$this->_print(1);
// 		$bekasi_a = $this->simtax_bekasi_a_model->revenue_set($start, $end); //1
		$bekasi_a = array(); //pool ditutup
		$this->_print(2);					 
		$bekasi_b = $this->simtax_bekasi_b_model->revenue_set($start, $end); //2
		$this->_print(3);		
		$bekasi_c = $this->simtax_bekasi_c_model->revenue_set($start, $end); //3
		$this->_print(4);		
//		$bekasi_d = $this->simtax_bekasi_d_model->revenue_set($start, $end); //4
		$bekasi_d = array();
		$this->_print(5);		
	  	$cipendawa = $this->simtax_cipendawa_model->revenue_set($start, $end); //5
		$this->_print(6);	
		$pondok_bambu = $this->simtax_pondok_bambu_model->revenue_set($start, $end); //6
		$this->_print(7);		
		$cipayung = $this->simtax_cipayung_model->revenue_set($start, $end); //7
		$this->_print(8);		
		$depok = $this->simtax_depok_model->revenue_set($start, $end); //8
		$this->_print(9);		
		$mustikasari = $this->simtax_mustikasari_model->revenue_set($start, $end); //9
		$this->_print(10);	
		$pekapuran = $this->simtax_pekapuran_model->revenue_set($start, $end); //10
		
// 		$padang = $this->simtax_padang_model->revenue_set($start, $end); //11
// 		$semarang = $this->simtax_semarang_model->revenue_set($start, $end); //12

		// $this->_print(11);		
		$bintaro = $this->simtax_bintaro_model->revenue_set($start, $end); //15
		$this->_print(12);
		$ciganjur = $this->simtax_ciganjur_model->revenue_set($start, $end); //16
		$this->_print(13);
		$jagakarsa = $this->simtax_jagakarsa_model->revenue_set($start, $end); //17
		$this->_print(14);
		$joglo_baru = $this->simtax_joglo_baru_model->revenue_set($start, $end); //18
		$this->_print(15);
		$star = $this->simtax_star_model->revenue_set($start, $end); //19
		$this->_print(16);
		$joglo = $this->simtax_joglo_model->revenue_set($start, $end); //20
		$this->_print(17);
		//$cipondoh_a = $this->simtax_cipondoh_a_model->revenue_set($start, $end); //21
		$cipondoh_a = array();
		$this->_print(18);
		$cipondoh_b = $this->simtax_cipondoh_b_model->revenue_set($start, $end); //22
		$this->_print(19);
	   	$cipondoh_c = $this->simtax_cipondoh_c_model->revenue_set($start, $end); //23
		$this->_print(20);
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
		
		$pool_updated = array();
		
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
				array_push($pool_updated, $arr['id_pool']);
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
				array_push($pool_updated, $arr['id_pool']);				
			}
			$i++;
		}
	
		//EAGLE
/*		$arrData3 = $this->dice_eagle_model->revenues($start, $end);
		$arr = array();
		foreach((Array) $arrData3 AS $skey => $val){
			$arr = array();
			$arr['id_pool'] = 24 + $val['id_pool_mobil']; //MASTER POOL FOR EAGLE POOL ID RAWA BOKOR = 25
			if($arr['id_pool'] >= 33) //TIARA MEGAPOOL
				$arr['id_pool']++;
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
			array_push($pool_updated, $arr['id_pool']);			
		}
			
		//TIARA
		$arrData4 = $this->dice_tiara_model->revenues($start, $end);
		$arr = array();
		foreach((Array) $arrData4 AS $skey => $val){
			$arr = array();
			if($val['id_pool_mobil'] == 1)
				$arr['id_pool'] = 32 + $val['id_pool_mobil']; //MASTER POOL FOR TIARA POOL ID MEGAPOOL = 33
			else
				$arr['id_pool'] = 59 + $val['id_pool_mobil']; //MASTER POOL FOR TIARA POOL ID PONDOK BAMBU = 61
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
			array_push($pool_updated, $arr['id_pool']);			
		}
		
		*/
		
		$this->load->model('dashboard_model');		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_rev($start, $end, $pool_updated);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_rev($data);
				
		$data = null;

		return $this->update_revenue($start, $end);
	}
	
	//KS
 	function backup_ks_this_week(){
		$start = date('Y-m-d',strtotime("-3 days"));
		$end = date('Y-m-d',strtotime("-1 days"));
		
		return $this->backup_ks($start, $end);
	}
	
	function ks(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_ks($start, $end);
	}
	
	private function backup_ks($start, $end){
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
		$this->load->model('xone_model');		
		$i = 1; //AREA 1
// 		$data = $this->get_ks_data($data, $this->simtax_bekasi_a_model, $start, $end, $i++); //BEKASI A SHUTDOWN
		$i++;
		$data = $this->get_ks_data($data, $this->simtax_bekasi_b_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_bekasi_c_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_bekasi_d_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_cipendawa_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_pondok_bambu_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_cipayung_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_depok_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_mustikasari_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_pekapuran_model, $start, $end, $i++);
				
		$i = 15; //AREA 2
		$data = $this->get_ks_data($data, $this->simtax_bintaro_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_ciganjur_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_jagakarsa_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_joglo_baru_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_star_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_joglo_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_cipondoh_a_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_cipondoh_b_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_cipondoh_c_model, $start, $end, $i++);
		$data = $this->get_ks_data($data, $this->simtax_tangsel_model, $start, $end, $i++);		
		
		$this->load->model('dashboard_model');
		
		$pool_updated = array();
		foreach((Array) $data AS $key => $val){
			array_push($pool_updated, $val['id_pool']);
		}
		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_ks($start, $end, $pool_updated);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_ks($data);
		$data = null;
		$this->update_revenue($start, $end);
	}
	
	private function get_ks_data($data, $model, $start, $end, $i){
		$db = $model->load_db();
		$this->_print($i."/24");
		$arrData = $model->ks_get_with_db($db, $start, $end); //1
		foreach((Array) $arrData['setoran'] as $key => $val){
			$arr = array();
			$arr['id_pool'] = $i;
			$arr['tgl_spj'] = $val['spj_date'];
			$arr['reg_no'] = $val['reg_no'];
			$arr['setor'] = $val['setor'];
			$arr['ks'] = $val['ks'];		
			$arr['s_wajib'] = $val['s_wajib'];
			$arr['s_lain'] = $val['s_lain'];
			$arr['denda'] = $val['denda'];	
			$arr['tipe_ops'] = $val['tipe_ops'];
			$arr['jenis_mitra'] = $val['jenis_mitra'];
			$arr['spj_code'] = $val['spj_code'];
			if($arr['setor'] <= 0)
				$arr['bayar_ks'] = $this->get_bayar_ks($arrData['adjust'], $arr['reg_no'], $arr['tgl_spj']);		
			else
				$arr['bayar_ks'] = 0;					
			array_push($data, $arr);
		}	
		$db->close();
		return $data;
	}
	
	private function get_bayar_ks($arr, $reg_no, $tgl){
		foreach((Array) $arr AS $key => $val){
			if($val['reg_no'] == $reg_no){
				if(date('Y-m-d', strtotime($tgl.'+ 1 day ')) == date('Y-m-d', strtotime($val['tgl']))){
					return -$val['adjust_ks'];
				}
			}
		}
		return 0;
	}
	
	private function update_revenue($start, $end){
		$data = array();
		$date = $start;
		$this->load->model('dashboard_model');
		$pool_updated = array();
		while(strtotime($date) <= strtotime($end)){
			$arrData = $this->dashboard_model->get_revenue($date);
			$arrTelatSetor = $this->dashboard_model->get_reguler_ks_telat($date);
				
			foreach((Array) $arrData AS $key => $val){
				//REGULER
				if($val['pool_area'] == Api::AREA_REGULER_1 
					|| $val['pool_area'] == Api::AREA_REGULER_2
					|| $val['pool_area'] == Api::AREA_REGULER_3
					|| $val['pool_area'] == Api::AREA_REGULER_4										
					) {
					$arr = array();
					$arr['id_pool'] = $val['id_pool'];
					$arr['tgl_spj'] = $date;
					$arr['total_spj'] = $val['total_spj'];
					$arr['total_rev'] = $val['total_rev'];
					$arr['tagihan_operasi'] = $val['tagihan_operasi'];
					$arr['ks_operasi'] = $val['ks_operasi'];
					$arr['ks_non_operasi'] = $val['ks_non_operasi'];
					$arr['angsuran_ks'] = $val['angsuran_ks'];	
					$arr['bayar_hutang'] = $val['bayar_hutang'];			
					$arr['total_arpof'] = number_format(($arr['total_rev'] / $arr['total_spj']),2 ,'.', '');
					$arr['total_setoran_telat'] = $this->get_total_setoran_spj_telat($arrTelatSetor, $arr['id_pool']);	
					array_push($data, $arr);
				}
			}
			$date = date('Y-m-d', strtotime($date.'+1 day'));
		}	
		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_rev_reguler($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_rev($data);
		
		return $this->_print('SUCCESS!');		
	}
	
	private function get_total_setoran_spj_telat($arr, $id){
		foreach((Array) $arr AS $key => $val){
			if($val['id_pool'] === $id)
				return $val['total_setoran'];
		}
		return 0;
	}
	
	//Driver
 	function backup_driver_today(){
		$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-01', strtotime($end));
		
		return $this->backup_driver($start, $end);
	}
	
	function driver(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_driver($start, $end);
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
		
		$i = 1; //AREA 1
// 		$data = $this->get_driver_data($data, $this->simtax_bekasi_a_model, $start, $end, $i++); //BEKASI A SHUTDOWN
		$i++;
		$data = $this->get_driver_data($data, $this->simtax_bekasi_b_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_bekasi_c_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_bekasi_d_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_cipendawa_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_pondok_bambu_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_cipayung_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_depok_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_mustikasari_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_pekapuran_model, $start, $end, $i++);
				
		$i = 15; //AREA 2
		$data = $this->get_driver_data($data, $this->simtax_bintaro_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_ciganjur_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_jagakarsa_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_joglo_baru_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_star_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_joglo_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_cipondoh_a_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_cipondoh_b_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_cipondoh_c_model, $start, $end, $i++);
		$data = $this->get_driver_data($data, $this->simtax_tangsel_model, $start, $end, $i++);		
		
		//EAGLE
		$data = $this->get_driver_data($data, $this->dice_eagle_model, $start, $end, 24, false, false);		
		
		//TIARA
		$data = $this->get_driver_data($data, $this->dice_tiara_model, $start, $end, 32, false, true);		
		
		$this->load->model('dashboard_model');		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_driver($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_driver($data);
		
		return $this->_print('SUCCESS!');
	}
	
	private function get_driver_data($data, $model, $start, $end, $i, $isReguler = true, $isTiara = false){
		$db = $model->load_db();
		$tmp_date = $start;
		while($tmp_date <= $end){
			$arrData = $model->drivers_backup($db, $tmp_date, $tmp_date); //1			
			foreach((Array) $arrData as $key => $val){
				$arr = array();
				if($isReguler)
					$arr['id_pool'] = $i;
				else {
					$arr['id_pool'] = $i + $val['id_pool'];	
					if(!$isTiara && $arr['id_pool'] >= 33)
						$arr['id_pool']++;	
					else if ($isTiara && $val['id_pool'] > 1)
						$arr['id_pool'] = 59 + $val['id_pool'];
				}
				$arr['tgl'] = $val['tgl_snapshot'];
				if(isset($val['bravo_aktif'])){
					$arr['bravo_aktif'] = $val['bravo_aktif'];
					$arr['bravo_inaktif'] = $val['bravo_inaktif'];
					$arr['charli_aktif'] = $val['charli_aktif'];
					$arr['charli_inaktif'] = $val['charli_inaktif'];
				} else {
					$arr['driver_aktif'] = $val['active'];
					$arr['driver_inaktif'] = $val['inactive'];
					$arr['driver_blacklist'] = $val['blacklist'];
					$arr['driver_retire'] = $val['retire'];	
				}
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
			$tmp_date = date('Y-m-d', strtotime($tmp_date.'+1 day'));
		}
		$db->close();
		return $data;
	}
	
	//Car
 	function backup_car_today(){
		$end = date('Y-m-d',strtotime("-1 days"));
		$start = date('Y-m-01', strtotime($end));
		
		return $this->backup_car($start, $end);
	}
	
	function car(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_car($start, $end);
	}
	
	private function backup_car($start, $end){
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
		
		$i = 1; //AREA 1
// 		$data = $this->get_car_data($data, $this->simtax_bekasi_a_model, $start, $end, $i++); //BEKASI A SHUTDOWN
		$i++;
		$data = $this->get_car_data($data, $this->simtax_bekasi_b_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_bekasi_c_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_bekasi_d_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_cipendawa_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_pondok_bambu_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_cipayung_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_depok_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_mustikasari_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_pekapuran_model, $start, $end, $i++);
				
		$i = 15; //AREA 2
		$data = $this->get_car_data($data, $this->simtax_bintaro_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_ciganjur_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_jagakarsa_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_joglo_baru_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_star_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_joglo_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_cipondoh_a_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_cipondoh_b_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_cipondoh_c_model, $start, $end, $i++);
		$data = $this->get_car_data($data, $this->simtax_tangsel_model, $start, $end, $i++);		
		
		//EAGLE
		$data = $this->get_car_data($data, $this->dice_eagle_model, $start, $end, 24, false, false);		
		
		//TIARA
		$data = $this->get_car_data($data, $this->dice_tiara_model, $start, $end, 32, false, true);		
		
		$this->load->model('dashboard_model');		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_car($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_car($data);
		
		return $this->_print('SUCCESS!');
	}
	
	private function get_car_data($data, $model, $start, $end, $i, $isReguler = true, $isTiara = false){
		$db = $model->load_db();
		$tmp_date = $start;
		while($tmp_date <= $end){
			$arrData = $model->car_backup($db, $tmp_date, $tmp_date); //1			
			foreach((Array) $arrData as $key => $val){
				$arr = array();
				if($isReguler)
					$arr['id_pool'] = $i;
				else {
					$arr['id_pool'] = $i + $val['id_pool'];	
					if(!$isTiara && $arr['id_pool'] >= 33)
						$arr['id_pool']++;	
					else if ($isTiara && $val['id_pool'] > 1)
						$arr['id_pool'] = 59 + $val['id_pool'];						
				}
				$arr['tgl'] = $val['tgl_snapshot'];
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
			$tmp_date = date('Y-m-d', strtotime($tmp_date.'+1 day'));
		}
		$db->close();
		return $data;
	}
	
	//RITASE SHELTER
	function ritase_shelter(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_ritase_shelter($start, $end);
	}
	
	function backup_ritase_shelter_this_week(){
		$start = date('Y-m-d',strtotime("-3 days"));
		$end = date('Y-m-d',strtotime("-1 days"));
		
		return $this->backup_ritase_shelter($start, $end);
	}
	
	private function backup_ritase_shelter($start, $end){
		$data = array();
		$this->load->model('xone_model');
		$this->load->model('xone_tiara_model');	
		$this->load->model('dashboard_model');
		$arrShelter = $this->dashboard_model->get_all_shelters_locations();
		$arrTiaraShelter = $this->dashboard_model->get_all_shelters_tiara();		
		$this->xone_model->load_database();	
		$counter = 1;
		$total = Count($arrShelter) + Count($arrTiaraShelter);
		foreach((Array) $arrShelter AS $key => $val){
			$this->_print($counter."/".$total); 
			$counter++;		
//  			if($val['id'] != 54) continue;
			$arrData = $this->xone_model->get_taxi_shelter($start, $end, $val['lat'], $val['lng'], $val['radius']);	
			foreach((Array) $arrData AS $key2 => $val2){								
				$a = array();
				$a['time_start'] = $val2['time_start'];
				$a['time_end'] = $val2['time_end'];
				$a['no_pintu'] = $val2['no_pintu'];
				$a['id_shelter'] = $val['id'];
				$a['argo'] = $val2['argo'];
				$a['start_lat'] = $val2['start_lat'];
				$a['start_lng'] = $val2['start_lng'];
				$a['end_lat'] = $val2['end_lat'];
				$a['end_lng'] = $val2['end_lng'];
				$a['id_trip'] = $val2['id'];
				$a['flag_tiara'] = 0;				
				$a['id_pool'] = $this->arrPool[$val2['pool_id']];
				if($a['id_pool'] > 0)
					array_push($data, $a);
			}
		}
		$this->xone_model->close_database();
		$this->xone_tiara_model->load_database();	
		foreach((Array) $arrTiaraShelter AS $key => $val){
			$this->_print($counter."/".$total); 
			$counter++;		
			$arrData = $this->xone_tiara_model->get_taxi_shelter($start, $end, $val['lat'], $val['lng'], $val['radius']);	
			foreach((Array) $arrData AS $key2 => $val2){								
				$a = array();
				$a['time_start'] = $val2['time_start'];
				$a['time_end'] = $val2['time_end'];
				$a['no_pintu'] = $val2['no_pintu'];
				$a['id_shelter'] = $val['id'];
				$a['argo'] = $val2['argo'];
				$a['start_lat'] = $val2['start_lat'];
				$a['start_lng'] = $val2['start_lng'];
				$a['end_lat'] = $val2['end_lat'];
				$a['end_lng'] = $val2['end_lng'];
				$a['id_trip'] = $val2['id'];
				$a['flag_tiara'] = 1;
				$a['id_pool'] = 33;
				array_push($data, $a);
			}
		}
		$this->xone_tiara_model->close_database();				
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_taxi_shelter($start, $end);
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_taxi_shelter($data);	
		ob_end_flush();	
		return $this->_print('SUCCESS!');
	}
	
	//RITASE BANDARA
	function ritase_bandara(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_ritase_bandara($start, $end);
	}
	
	function backup_ritase_bandara_this_week(){
		$start = date('Y-m-d',strtotime("-3 days"));
		$end = date('Y-m-d',strtotime("-1 days"));
		
		return $this->backup_ritase_bandara($start, $end);
	}
	
	private function backup_ritase_bandara($start, $end){
		$data = array();
		$this->load->model('xone_model');
		$this->load->model('xone_tiara_model');		
		$this->load->model('dashboard_model');
		$arrShelter = $this->dashboard_model->get_all_bandara_locations();
		$this->xone_model->load_database();	
		$counter = 1;
		$total = Count($arrShelter) * 2;
		foreach((Array) $arrShelter AS $key => $val){
			$this->_print($counter."/".$total); 
			$counter++;		
			$arrData = $this->xone_model->get_taxi_shelter($start, $end, $val['lat'], $val['lng'], $val['radius']);	
			foreach((Array) $arrData AS $key2 => $val2){								
				$a = array();
				$a['time_start'] = $val2['time_start'];
				$a['time_end'] = $val2['time_end'];
				$a['no_pintu'] = $val2['no_pintu'];
				$a['id_shelter'] = $val['id'];
				$a['argo'] = $val2['argo'];
				$a['start_lat'] = $val2['start_lat'];
				$a['start_lng'] = $val2['start_lng'];
				$a['end_lat'] = $val2['end_lat'];
				$a['end_lng'] = $val2['end_lng'];
				$a['id_trip'] = $val2['id'];
				$a['flag_tiara'] = 0;			
				$a['id_pool'] = $this->arrPool[$val2['pool_id']];
				if($a['id_pool'] > 0)
					array_push($data, $a);
			}
		}
		$this->xone_model->close_database();
		$this->xone_tiara_model->load_database();	
		foreach((Array) $arrShelter AS $key => $val){
			$this->_print($counter."/".$total); 
			$counter++;		
			$arrData = $this->xone_tiara_model->get_taxi_shelter($start, $end, $val['lat'], $val['lng'], $val['radius']);	
			foreach((Array) $arrData AS $key2 => $val2){								
				$a = array();
				$a['time_start'] = $val2['time_start'];
				$a['time_end'] = $val2['time_end'];
				$a['no_pintu'] = $val2['no_pintu'];
				$a['id_shelter'] = $val['id'];
				$a['argo'] = $val2['argo'];
				$a['start_lat'] = $val2['start_lat'];
				$a['start_lng'] = $val2['start_lng'];
				$a['end_lat'] = $val2['end_lat'];
				$a['end_lng'] = $val2['end_lng'];
				$a['id_trip'] = $val2['id'];
				$a['flag_tiara'] = 1;
				$a['id_pool'] = 33;				
				array_push($data, $a);
			}
		}
		$this->xone_tiara_model->close_database();			
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_taxi_bandara($start, $end);
		
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_taxi_bandara($data);	
		ob_end_flush();	
		return $this->_print('SUCCESS!');
	}
	
	//RITASE RDS
	function ritase_rds(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_ritase_rds($start, $end);
	}
	
	function backup_ritase_rds_this_week(){
		$start = date('Y-m-d',strtotime("-3 days"));
		$end = date('Y-m-d',strtotime("-1 days"));
		
		return $this->backup_ritase_rds($start, $end);
	}
	
	private function backup_ritase_rds($start, $end){
		$data = array();
		
		$this->load->model('xone_model');
		$this->load->model('xone_tiara_model');		
		$this->load->model('dashboard_model');
		
		$arrData = $this->xone_model->ritase_by_rds($start, $end);	
		foreach((Array) $arrData AS $key => $val){
			$arr = array();
			$arr['tgl'] = $val['dt'];
			$arr['pool_id'] = $this->arrPool[$val['pool_id']];			
			$arr['ritase'] = $val['ritase'];			
			$arr['ct'] = $val['ct'];			
			$arr['total_argo'] = $val['total_argo'];				
			$arr['total_ritase'] = $val['total_ritase'];
			if($arr['pool_id'] !== '0')				
				array_push($data, $arr);						
		}			
		
		$arrDataTiara = $this->xone_tiara_model->ritase_by_rds($start, $end);
		foreach((Array) $arrDataTiara AS $key => $val){
			$arr = array();
			$arr['tgl'] = $val['dt'];
			$arr['pool_id'] = 33;			
			$arr['ritase'] = $val['ritase'];			
			$arr['ct'] = $val['ct'];			
			$arr['total_argo'] = $val['total_argo'];				
			$arr['total_ritase'] = $val['total_ritase'];							
			array_push($data, $arr);
		}		
		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_ritase_rds($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_ritase_rds($data);	
		return $this->_print('SUCCESS!');
	}
	
	//RITASE HOUR RDS
	function ritase_hour_rds(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_ritase_hour_rds($start, $end);
	}
	
	function backup_ritase_hour_rds_this_week(){
		$start = date('Y-m-d',strtotime("-3 days"));
		$end = date('Y-m-d',strtotime("-1 days"));
		
		return $this->backup_ritase_hour_rds($start, $end);
	}
	
	private function backup_ritase_hour_rds($start, $end){
		$data = array();
		
		$this->load->model('xone_model');
		$this->load->model('xone_tiara_model');		
		$this->load->model('dashboard_model');
		
		$arrData = $this->xone_model->ritase_hour_rds($start, $end);	
		foreach((Array) $arrData AS $key => $val){
			$arr = array();
			$arr['tgl'] = $val['dt'];
			$arr['hr'] = $val['hr'];
			$arr['pool_id'] = $this->arrPool[$val['pool_id']];			
			$arr['total_argo'] = $val['argo'];				
			$arr['total_ritase'] = $val['ritase'];	
			if($arr['pool_id'] !== '0')				
				array_push($data, $arr);										
		}			
		
		$arrDataTiara = $this->xone_tiara_model->ritase_hour_rds($start, $end);
		foreach((Array) $arrDataTiara AS $key => $val){
			$arr = array();
			$arr['tgl'] = $val['dt'];
			$arr['hr'] = $val['hr'];
			$arr['pool_id'] = 33;		
			$arr['total_argo'] = $val['argo'];				
			$arr['total_ritase'] = $val['ritase'];						
			array_push($data, $arr);
		}		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_ritase_hour_rds($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_ritase_hour_rds($data);	
		return $this->_print('SUCCESS!');
	}
	
	//INVENTORY POOL
 	function backup_inventory_pool_today(){
		$start = date('Y-m-d',strtotime("-1 days"));
		$end = date('Y-m-d');
		
		return $this->backup_inventory_pool($start, $end);
	}
	
	function inventory_pool(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_inventory_pool($start, $end);
	}
	
	private function backup_inventory_pool($start, $end){
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
					
		$i = 1; //AREA 1
// 		$data = $this->get_inventory_data($data, $this->simtax_bekasi_a_model, $start, $end, $i++); //SHUTDOWN BEKASI A
		$i++;
		$data = $this->get_inventory_data($data, $this->simtax_bekasi_b_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_bekasi_c_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_bekasi_d_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_cipendawa_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_pondok_bambu_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_cipayung_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_depok_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_mustikasari_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_pekapuran_model, $start, $end, $i++);
				
		$i = 15; //AREA 2
		$data = $this->get_inventory_data($data, $this->simtax_bintaro_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_ciganjur_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_jagakarsa_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_joglo_baru_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_star_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_joglo_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_cipondoh_a_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_cipondoh_b_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_cipondoh_c_model, $start, $end, $i++);
		$data = $this->get_inventory_data($data, $this->simtax_tangsel_model, $start, $end, $i++);		
		
		$this->load->model('dashboard_model');		
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_inventory_pool($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_inventory_pool($data);
		
		return $this->_print('SUCCESS!');
	}
	
	private function get_inventory_data($data, $model, $start, $end, $i){
		$db = $model->load_db();
		$tmp_date = $start;
		$this->_print($i.'/25');
		while($tmp_date <= $end){
			$year = 2014 - idate('Y', strtotime($tmp_date));
			$period = 58 - ($year * 12) + idate('n', strtotime($tmp_date));
			//print_r($tmp_date.' = '.$period.'<br/>');
			$arrData = $model->inventory_get($db, $period); //1			
			foreach((Array) $arrData as $key => $val){
				$arr = array();
				$arr['id_pool'] = $i;
				$arr['tgl'] = $tmp_date;
				$arr['id_item'] = $val['item_id'];
				$arr['qty'] = $val['qty'];
				
				array_push($data, $arr);
			}
			$tmp_date = date('Y-m-d', strtotime($tmp_date.'+1 day'));
		}
		$db->close();		
		return $data;
	}
	
	//SPJ POOL
	function backup_spj_this_week(){
		$start = date('Y-m-d',strtotime("-3 days"));
		$end = date('Y-m-d');
		
		return $this->backup_spj($start, $end);
	}
	
	function spj(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_spj($start, $end);
	}
	
	private function backup_spj($start, $end){
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
		
		$this->_print("1/20");
// 		$bekasi_a = $this->simtax_bekasi_a_model->data_spj($start, $end); //1	 
		$bekasi_a = array(); //BEKASI A SHUTDOWN
		$this->_print("2/20");		
		$bekasi_b = $this->simtax_bekasi_b_model->data_spj($start, $end); //2
		$this->_print("3/20");		
		$bekasi_c = $this->simtax_bekasi_c_model->data_spj($start, $end); //3
		$this->_print("4/20");		
		$bekasi_d = $this->simtax_bekasi_d_model->data_spj($start, $end); //4
		$this->_print("5/20");		
	  	$cipendawa = $this->simtax_cipendawa_model->data_spj($start, $end); //5
		$this->_print("6/20");	  	
		$pondok_bambu = $this->simtax_pondok_bambu_model->data_spj($start, $end); //6
		$this->_print("7/20");		
		$cipayung = $this->simtax_cipayung_model->data_spj($start, $end); //7
		$this->_print("8/20");		
		$depok = $this->simtax_depok_model->data_spj($start, $end); //8
		$this->_print("9/20");		
		$mustikasari = $this->simtax_mustikasari_model->data_spj($start, $end); //9
		$this->_print("10/20");		
		$pekapuran = $this->simtax_pekapuran_model->data_spj($start, $end); //10
		$this->_print("11/20");		
		
		$bintaro = $this->simtax_bintaro_model->data_spj($start, $end); //15
		$this->_print("12/20");		
		$ciganjur = $this->simtax_ciganjur_model->data_spj($start, $end); //16
		$this->_print("13/20");		
		$jagakarsa = $this->simtax_jagakarsa_model->data_spj($start, $end); //17
		$this->_print("14/20");		
		$joglo_baru = $this->simtax_joglo_baru_model->data_spj($start, $end); //18
		$this->_print("15/20");		
		$star = $this->simtax_star_model->data_spj($start, $end); //19
		$this->_print("16/20");		
		$joglo = $this->simtax_joglo_model->data_spj($start, $end); //20
		$this->_print("17/20");		
		$cipondoh_a = $this->simtax_cipondoh_a_model->data_spj($start, $end); //21
		$this->_print("18/20");		
		$cipondoh_b = $this->simtax_cipondoh_b_model->data_spj($start, $end); //22
		$this->_print("19/20");		
	   	$cipondoh_c = $this->simtax_cipondoh_c_model->data_spj($start, $end); //23
		$this->_print("20/20");	   	
 		$tangsel = $this->simtax_tangsel_model->data_spj($start, $end); //24
		$this->_print("Saving");
				
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
		
		$pool_updated = array();
		$i = 1; //AREA 1
		foreach((Array) $arrData AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['id_pool'] = $i;
				$arr['tgl_spj'] = $val['SPJ_DATE'];
				$arr['nama'] = $val['NAMA_SETOR'];
				$arr['tipe_ops'] = $val['TIPE_OPERASI'];
				$arr['no_pintu'] = $val['NO_PINTU'];
				$arr['spj_code'] = $val['SPJ_CODE'];
				$arr['status_bs'] = $val['STATUS_BEBAS_SETOR'];		
				$arr['jam_spj'] = $val['POSTED_DATE'];
				$arr['kip_setor'] = $val['KIP_SETOR'];						
				array_push($data, $arr);
				array_push($pool_updated, $arr['id_pool']);
				
			}
			 $this->_print($sval['SPJ_CODE']);
			$i++;
		}
		
		$i = 15; //AREA 2
		foreach((Array) $arrData2 AS $skey => $sval){
			foreach ((Array) $sval AS $key => $val) {
				$arr = array();
				$arr['id_pool'] = $i;
				$arr['tgl_spj'] = $val['SPJ_DATE'];
				$arr['nama'] = $val['NAMA_SETOR'];
				$arr['tipe_ops'] = $val['TIPE_OPERASI'];
				$arr['no_pintu'] = $val['NO_PINTU'];
				$arr['spj_code'] = $val['SPJ_CODE'];
				$arr['status_bs'] = $val['STATUS_BEBAS_SETOR'];
				$arr['jam_spj'] = $val['POSTED_DATE'];
				$arr['kip_setor'] = $val['KIP_SETOR'];												
				array_push($data, $arr);
				array_push($pool_updated, $arr['id_pool']);
				 
			}
			$this->_print($i);
			$i++;
		}

		$this->load->model('dashboard_model');
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_spj($start, $end, $pool_updated);
		//$this->print_r($data, TRUE);
		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_spj($data);
		
		return $this->_print('SUCCESS!');
	}
	
	//RENTAL
	function backup_rental_this_week(){
		$start = date('Y-m-d',strtotime("-3 days"));
		$end = date('Y-m-d');
		
		return $this->backup_rental($start, $end);
	}
	
	function rental(){
		if(!isset($_GET["start"]) || !isset($_GET["end"])) {
			return $this->_json_err('-40');
		}		
		
		if(strtotime($_GET["start"]) > strtotime($_GET["end"]) || strtotime($_GET["start"]) > strtotime(date('y-m-d')) || strtotime($_GET["end"]) > strtotime(date('y-m-d'))) {
			return $this->_json_err('-30');
		}
		$start = $_GET["start"];
		$end = $_GET["end"];
		
		return $this->backup_rental($start, $end);
	}
	
	private function backup_rental($start, $end){
		$this->load->model('rental_model');
		
 		$arrData = $this->rental_model->data_rental($start, $end); //24
		$this->_print("Saving");
		$data = array();
		foreach((Array) $arrData AS $key => $val){
			$arr = array();
			$arr['id_pool'] = $this->arrPoolRental[$val['id_ms_pool']];
			$arr['no_pintu'] = $val['no_pintu'];
			$arr['jenis'] = $val['jenis'];			
			$arr['kip'] = $val['no_kip'];
			$arr['no_spj'] = $val['no_spj'];			
			$arr['pengemudi'] = $val['nama'];
			$arr['lama_sewa'] = $val['lama_sewa'];
			$arr['waktu_sewa'] = $val['waktu_sewa'];
			$arr['tgl_spj'] = date('Y-m-d', strtotime($val['waktu_sewa']));			
			$arr['harga_sewa'] = $val['harga_sewa'];
			$arr['waktu_kembali'] = $val['waktu_kembali'];
			$arr['jam_terlambat'] = $val['jam_terlambat'];										
			$arr['nominal_denda_perjam'] = $val['nominal_denda_perjam'];
			$arr['total_denda'] = $val['total_denda'];
			$arr['nominal_bayar_sewa'] = $val['nominal_bayar_sewa'];
			$arr['nominal_bayar_denda'] = $val['nominal_bayar_denda'];
			$arr['status'] = $val['status'];
			array_push($data, $arr);
		}

		$this->load->model('dashboard_model');
		//DELETE EXISTING DATA FIRST
		$this->dashboard_model->delete_backup_rental($start, $end);

		//INSERT NEW BACKUP FILES
		$this->dashboard_model->save_backup_rental($data);
		
		return $this->_print('SUCCESS!');
	}
}
?>