<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Detail extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
		$this->load->model('xone_model');	
	}
	
	public function index($id = 0, $date = '')
	{
		if(isset($_GET['id']))
			$id = $_GET['id'];
		if(isset($_GET['date']))
			$date = $_GET['date'];
		$post = $this->input->post();
		if(isset($post['id']))
			$id = $post['id'];
		if(isset($post['date']))
			$date = $post['date'];
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');
		if(isset($_GET['show']))
			$arr['is_show'] = $_GET['show'];	
			
		$arrData = $this->dashboard_model->get_detail($id, $date);		
		if(Count($arrData) == 0){
			return show_404();
		}
		
		$val = $arrData[0];		
		if(($val['pool_area'] == Admin::AREA_REGULER_1
			|| $val['pool_area'] == Admin::AREA_REGULER_2
			|| $val['pool_area'] == Admin::AREA_REGULER_3
			|| $val['pool_area'] == Admin::AREA_REGULER_4	
			) && strtotime($date) >= strtotime(Admin::DATE_USE_COMMENT_KS)){

			if(isset($post['save'])){ //SAVE COMMENT
				$res = $this->dashboard_model->save_comment_ks($post);
				if($res){
					return redirect('/Detail/index?id='.$id.'&date='.$date);
				}
			}
			
			$check_comment = $this->checkCommentKS($id, $date);
			if(Count($check_comment) > 0){
				$date = $check_comment[0]['tgl_spj'];
				$id = $check_comment[0]['id_pool'];
				return redirect('/Detail/index?id='.$id.'&date='.$date.'&show=1');
			}
		}
						
		$this->load->view('header');
		
		$arr['series'] = $this->dashboard_model->get_series_detail($id, $date);
		
		//MOVING AVERAGE
		$datas['last_90'] = array();
		$ct = 119;
		$dt = 30;
		for($i = 0;$i <= 30;$i++){
			$a = array();
			$a['tgl_spj'] = date('Y-m-d', strtotime($date.'- '.($dt - $i).' day'));
			$a['operasi'] = $this->get_moving($arr['series']['moving'], strtotime($date.'- '.$ct.' day'), false);
			array_push($datas['last_90'], $a);
			$ct--;
		}
		
		$datas['last_30'] = array();
		$ct = 59;
		$dt = 30;
		for($i = 0;$i <= 30;$i++){
			$a = array();
			$a['tgl_spj'] = date('Y-m-d', strtotime($date.'- '.($dt - $i).' day'));
			$a['operasi'] = $this->get_moving($arr['series']['moving'], strtotime($date.'- '.$ct.' day'), true);
			array_push($datas['last_30'], $a);
			$ct--;
		}
		
		foreach((Array) $arr['series']['operasi'] AS $key => $val3){
			$arr['series']['operasi'][$key]['last_30'] = 0;
			$arr['series']['operasi'][$key]['last_90'] = 0;
			foreach((Array) $datas['last_30'] AS $key2 => $val2){
				if($val2['tgl_spj'] == $val['tgl_spj']){
					$arr['series']['operasi'][$key]['last_30'] = $val2['operasi'];
					break;
				}
			}
			foreach((Array) $datas['last_90'] AS $key2 => $val2){
				if($val2['tgl_spj'] == $val['tgl_spj']){
					$arr['series']['operasi'][$key]['last_90'] = $val2['operasi'];
					break;
				}
			}
		}
		
		$arr['order_perf'] = $this->xone_model->detail_order($this->translate_xone($id), $date);
		$yest = Count($arr['series']['operasi']) >= 2 ? $arr['series']['operasi'][Count($arr['series']['operasi']) - 2]['op'] : 0;
		$yest2 = Count($arr['series']['revenue']) >= 2 ? $arr['series']['revenue'][Count($arr['series']['revenue']) - 2]['rev'] : 0;
		
		$arr['name'] = $val['name'];
		$arr['id'] = $id;
		$arr['last_update'] = date('Y-m-d H:00:00');
		$arr['series_driver'] = $this->dashboard_model->get_series_driver_pool($id, $date);
		$arr['series_car'] = $this->dashboard_model->get_series_car_pool($id, $date);		
		
		$arr['is_uber_pool'] = false; /*$this->dashboard_model->is_uber_pool($id);*/
		if($val['pool_area'] == Admin::AREA_REGULER_1
			|| $val['pool_area'] == Admin::AREA_REGULER_2
			|| $val['pool_area'] == Admin::AREA_REGULER_3
			|| $val['pool_area'] == Admin::AREA_REGULER_4						
		) { 
			//REGULER
			
			//KS Unit & KS Comment
			$arr['ks_unit'] = $this->dashboard_model->get_ks_unit($id, $date);
			$str_spj_ks = '';
			foreach((Array) $arr['ks_unit'] AS $key2 => $val2){
				if($str_spj_ks === '')
					$str_spj_ks .= "'".$val2['spj_code']."'";
				else 
					$str_spj_ks .= ", '".$val2['spj_code']."'";
			}
			if($str_spj_ks === '')
				$arr['comment_ks'] = array();
			else 
				$arr['comment_ks'] = $this->dashboard_model->get_comment_ks($str_spj_ks);
				
			//Performa Operasi	
			$arr['performa_operasi_ks'] = array();
			if(strtotime($date) >= strtotime(Admin::DATE_USE_COMMENT_KS))	
				$arr['performa_operasi_ks'] = $this->dashboard_model->get_performa_operasi_ks($id, $date);
			
			$arr['reguler'] = $val['ops_reguler'];
			$arr['kalong'] = $val['ops_kalong'];
			$arr['tp'] = $val['ops_tp'];
			$arr['broken'] = $val['ops_broken'];
			$arr['other'] = $val['ops_other'];
			$arr['so'] = $val['ops_so'];
			$arr['operasi'] = $val['ops_operasi'];
			$arr['non_operasi'] = $val['ops_non_operasi'];
			$arr['total'] = $val['ops_total'];
			$arr['fleet_utility'] = $arr['operasi'] / $arr['total'] * 100;
			
			$arr['total_rev'] = $val['total_rev'] + $val['bayar_hutang'] + $val['angsuran_ks'];
			$arr['total_spj'] = $val['total_spj'];
			$arr['total_arpof'] = $arr['total_rev'] / ($arr['total_spj'] > 0 ? $arr['total_spj'] : 1);
			$arr['tagihan_operasi'] = $val['tagihan_operasi'];
			$arr['ks_operasi'] = $val['ks_operasi'];
			$arr['ks_non_operasi'] = $val['ks_non_operasi'];
			$arr['setoran'] = $val['total_rev'] - $val['angsuran_ks'];
			$arr['total_tagihan'] = -$val['ks_non_operasi'] - $val['ks_operasi'] + $val['total_rev'];
			$arr['setoran_telat'] = $val['total_setoran_telat'];			
			$arr['ks_operasi'] += $arr['setoran_telat'];			
			$arr['angsuran_ks'] = $val['angsuran_ks'] - $arr['setoran_telat'];
			$arr['bayar_ks'] = $val['bayar_hutang'];			
			$arr['total_ks'] = $arr['ks_operasi'] + $arr['ks_non_operasi'];				
			$arr['setoran'] = $val['total_rev'];			
			$arr['rate'] = $arr['ks_operasi'] / ($arr['total_tagihan'] > 0 ? $arr['total_tagihan'] : 1) * -100;	
			$arr['ks_rate'] = $arr['total_ks'] / ($arr['total_tagihan'] > 0 ? $arr['total_tagihan'] : 1) * -100;
			$arr['avg_ks'] = $arr['ks_operasi'] / ($arr['total_spj'] > 0 ? $arr['total_spj'] : 1);					
			$arr['spj_yest'] = ($arr['operasi'] - $yest) / $yest * 100;
			$arr['rev_yest'] = ($arr['total_rev'] - $yest2) / $yest2 * 100;	
			
			//INVENTORY
			$arrDataInventory = $this->dashboard_model->get_inventories_in_pool($id, $date);
			$arr['inventory_area'] = array();
			
			foreach((Array) $arrDataInventory AS $key => $val){
				$a = array();
				$a['namepart'] = $val['namepart'];			
				$a['satuan'] = $val['satuan'];	
				$a['jenis'] = $val['jenis'];
				$a['qty'] = $val['qty'];
				$a['id_item'] = $val['id_item'];				
				array_push($arr['inventory_area'], $a);	
			}
			
			//SPJ
			$arrDataSPJ = $this->dashboard_model->get_spj($id, $date);
			$query_spj = "";
			$arr['unit_argo'] = array();
			if(count($arrDataSPJ) > 0) {
				$row_size = count($arrDataSPJ);
				$i = 1;
				foreach($arrDataSPJ as $key => $val)
				{
					if($i == $row_size)
					{
						$query_spj .= "'".$val['spj_code']."'";
					}
					else
					{
						$query_spj .= "'".$val['spj_code']."', ";
					}
					$i++;
				}
				$isNotMoce = (strtotime($date) < strtotime(Admin::DATE_USE_MOCE));
				if($isNotMoce){
					$arrDataTripSPJ = $this->xone_model->get_trip_from_spj($query_spj);
				} else {				
					$this->load->model('moce_model');
					$arrDataTripSPJ = $this->moce_model->get_trip_from_spj($query_spj, $date);
				}
				foreach((Array) $arrDataSPJ AS $key => $val){
					$a = array();
					$a['nama'] = $val['nama'];
					$a['tipe_ops'] = $val['tipe_ops'] === '0' ? 'Reguler' : 'Kalong';
					$a['no_pintu'] = $val['no_pintu'];
					$a['spj_code'] = $val['spj_code'];
					$a['status_bs'] = $val['status_bs'];					
					if(!$isNotMoce)
						$b = $this->get_trip_argo_spj_array2($arrDataTripSPJ, $a['spj_code']);
					else 
						$b = $this->get_trip_argo_spj_array($arrDataTripSPJ, $a['spj_code']);
					$a['trip'] = $b['trip'];
					$a['argo'] = $b['argo'];
					array_push($arr['unit_argo'], $a);
				}
				
				foreach((Array) $arr['ks_unit'] AS $key => $val){
					if(!$isNotMoce)
						$a = $this->get_trip_argo_spj_array2($arrDataTripSPJ, $val['spj_code']);
					else 
						$a = $this->get_trip_argo_spj_array($arrDataTripSPJ, $val['spj_code']);
					
					$arr['ks_unit'][$key]['argo_from_rds'] = $a['argo'];
					$arr['ks_unit'][$key]['rit_from_rds'] = $a['trip'];
				}
			}
			
			$this->load->view('detail_reg', Array('data' => $arr, 'date' => $date));
		} else if($val['pool_area'] === '4' || $val['pool_area'] === '5') { //EAGLE AND TIARA
			$arr['reguler'] = $val['ops_reguler'];
			$arr['kalong'] = $val['ops_kalong'];
			$arr['tp'] = $val['ops_tp'];
			$arr['body_repair'] = $val['ops_broken'];
			$arr['lain'] = $val['ops_other'];
			$arr['tl'] = $val['ops_tl'];
			$arr['argo_rds'] = $val['ops_argo_rds'];				
			$arr['surat'] = $val['ops_surat'];
			$arr['operasi'] = $val['ops_operasi'];
			$arr['non_operasi'] = $val['ops_non_operasi'];
			$arr['total'] = $val['ops_total'];
			$arr['fleet_utility'] = $arr['operasi'] / $arr['total'] * 100;
			
			$arr['total_rev'] = $val['total_rev'];
			$arr['total_spj'] = $val['total_spj'];
			$arr['total_gross'] = $val['total_gross'];
			$arr['total_komisi'] = $val['total_komisi'];
			$arr['total_bbm'] = $val['total_bbm'];
			$arr['total_arpof'] = $val['total_arpof'];
			$arr['total_lain'] = $val['total_lain'];
			$arr['total_denda'] = $val['total_denda'];
			$arr['bayar_hutang'] = $val['bayar_hutang'];
			$arr['hutang_baru'] = $val['hutang_baru'];
			$arr['cash_inflow'] = $val['total_rev'] + $val['total_denda'] + $val['bayar_hutang'] + ($val['total_lain'] > 0 ? $val['total_lain'] : 0);
			$arr['spj_yest'] = ($arr['operasi'] - $yest) / ($yest > 0 ? $yest : 1) * 100;	
			$arr['rev_yest'] = ($arr['cash_inflow'] - $yest2) / ($yest2 > 0 ? $yest : 1) * 100;
			if($val['pool_area'] === '4'){
				$arr['is_tiara'] = FALSE;
				$this->load->model('dice_eagle_model');					
				$arr['detail_unit'] = $this->dice_eagle_model->get_detail_unit(($id <= 33 ? ($id - 24) : ($id - 25)), $date);
// 				$this->xone_model->load_database();
				foreach((Array)$arr['detail_unit'] AS $skey => $sval){
// 					$detail = $this->xone_model->get_trip_sum_spj($sval['nomor_spj']);
					$arr['detail_unit'][$skey]['nomor_spj'] = $sval['nomor_spj'];					
// 					$arr['detail_unit'][$skey]['argo_from_rds'] = $detail[0]['argo'];
// 					$arr['detail_unit'][$skey]['rit_from_rds'] = $detail[0]['trip'];			
					$arr['detail_unit'][$skey]['argo_from_dice'] = $arr['detail_unit'][$skey]['argo_setelah_adj'] - $arr['detail_unit'][$skey]['adjustment'];
				}
// 				$this->xone_model->close_database();
			}
			else if($val['pool_area'] === '5'){
				$arr['is_tiara'] = TRUE;
				$arr['total_insentif'] = $val['nominal_insentif_kehadiran'];
// 				$this->load->model('Xone_tiara_model');
				$this->load->model('dice_tiara_model');					
				if($id == 33)
					$arr['detail_unit'] = $this->dice_tiara_model->get_detail_unit(($id - 32), $date);
				else if($id > 60)
					$arr['detail_unit'] = $this->dice_tiara_model->get_detail_unit(($id - 59), $date);	
// 				$this->Xone_tiara_model->load_database();
				foreach((Array)$arr['detail_unit'] AS $skey => $sval){
// 					$detail = $this->Xone_tiara_model->get_trip_sum_spj($sval['nomor_spj']);
					$arr['detail_unit'][$skey]['nomor_spj'] = $sval['nomor_spj'];
// 					$arr['detail_unit'][$skey]['argo_from_rds'] = Count($detail) > 0 ? $detail[0]['argo'] : 0;
// 					$arr['detail_unit'][$skey]['rit_from_rds'] = Count($detail) > 0 ? $detail[0]['trip'] : 0;		
					$arr['detail_unit'][$skey]['argo_from_dice'] = $arr['detail_unit'][$skey]['argo_setelah_adj'] - $arr['detail_unit'][$skey]['adjustment'];
				}
// 				$this->Xone_tiara_model->close_database();
			}
			$this->load->view('detail_eagle', Array('data' => $arr, 'date' => $date));
		}
		$this->load->view('footer');
	}
	
	public function area($id = '', $date = '')
	{
		if(isset($_GET['id']))
			$id = $_GET['id'];
		if(isset($_GET['date']))
			$date = $_GET['date'];
		$post = $this->input->post();
		if(isset($post['id']))
			$id = $post['id'];
		if(isset($post['date']))
			$date = $post['date'];
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');
		
		$user = $this->user;		
		$arrData = $this->dashboard_model->get_detail_area($id, $date);
		if(Count($arrData) == 0){
			return show_404();
		}
		
		$arr['series_driver'] = $this->dashboard_model->get_series_driver_area($id, $date);
		$arr['series_car'] = $this->dashboard_model->get_series_car_area($id, $date);		
		
		$this->load->view('header');

		$arr['series'] = $this->dashboard_model->get_series_area($id, $date);
		$yest = Count($arr['series']['operasi']) >= 2 ? $arr['series']['operasi'][Count($arr['series']['operasi']) - 2]['op'] : 0;
		$yest2 = Count($arr['series']['revenue']) >= 2 ? $arr['series']['revenue'][Count($arr['series']['revenue']) - 2]['rev'] : 0;
		$arr['pool_ops'] = $arr['pool_revs'] = array();
		
		//MOVING AVERAGE
		$datas['last_90'] = array();
		$ct = 119;
		$dt = 30;
		for($i = 0;$i <= 30;$i++){
			$a = array();
			$a['tgl_spj'] = date('Y-m-d', strtotime($date.'- '.($dt - $i).' day'));
			$a['operasi'] = $this->get_moving($arr['series']['moving'], strtotime($date.'- '.$ct.' day'), false);
			array_push($datas['last_90'], $a);
			$ct--;
		}
		
		$datas['last_30'] = array();
		$ct = 59;
		$dt = 30;
		for($i = 0;$i <= 30;$i++){
			$a = array();
			$a['tgl_spj'] = date('Y-m-d', strtotime($date.'- '.($dt - $i).' day'));
			$a['operasi'] = $this->get_moving($arr['series']['moving'], strtotime($date.'- '.$ct.' day'), true);
			array_push($datas['last_30'], $a);
			$ct--;
		}
		
		foreach((Array) $arr['series']['operasi'] AS $key => $val){
			$arr['series']['operasi'][$key]['last_30'] = 0;
			$arr['series']['operasi'][$key]['last_90'] = 0;
			foreach((Array) $datas['last_30'] AS $key2 => $val2){
				if($val2['tgl_spj'] == $val['tgl_spj']){
					$arr['series']['operasi'][$key]['last_30'] = $val2['operasi'];
					break;
				}
			}
			foreach((Array) $datas['last_90'] AS $key2 => $val2){
				if($val2['tgl_spj'] == $val['tgl_spj']){
					$arr['series']['operasi'][$key]['last_90'] = $val2['operasi'];
					break;
				}
			}
		}
		
		if($id == Admin::AREA_REGULER_1
			|| $id == Admin::AREA_REGULER_2
			|| $id == Admin::AREA_REGULER_3
			|| $id == Admin::AREA_REGULER_4) { //REGULER
			$arr['name'] = ($id == Admin::AREA_REGULER_1 ? 'Pool Reguler Area 1' : 
				($id == Admin::AREA_REGULER_2 ? 'Pool Reguler Area 2' : 
				($id == Admin::AREA_REGULER_3 ? 'Pool Reguler Area 3' : 
				($id == Admin::AREA_REGULER_4 ? 'Pool Reguler Area 4' : 'Pool Reguler Area Luar Jakarta'))));
			$arr['id'] = $id;				
			$arr['reguler'] = 0;
			$arr['kalong'] = 0;
			$arr['tp'] = 0;
			$arr['broken'] = 0;
			$arr['other'] = 0;
			$arr['so'] = 0;
			$arr['operasi'] = 0;
			$arr['non_operasi'] = 0;
			$arr['total'] = 0;
		
			$arr['total_rev'] = 0;
			$arr['total_spj'] = 0;
			$arr['total_arpof'] = 0;
			$arr['tagihan_operasi'] = 0;
			$arr['ks_operasi'] = 0;
			$arr['ks_non_operasi'] = 0;
			$arr['total_tagihan'] = 0;
			$arr['total_ks'] = 0;
			$arr['setoran'] = 0;
			$arr['angsuran_ks'] = 0;
			$arr['bayar_ks'] = 0;
			$arr['setoran_telat'] = 0;
			$arrTelatSetor = $this->dashboard_model->get_reguler_ks_telat($date);			
			foreach((Array) $arrData AS $key => $val){
				$pool_ops = $pool_rev = array();
				$pool_ops['id'] = $val['id_poolx'];
				$pool_ops['name'] = $val['name'];	
				$pool_ops['reguler'] = $val['ops_reguler'];
				$pool_ops['kalong'] = $val['ops_kalong'];
				$pool_ops['tp'] = $val['ops_tp'];
				$pool_ops['broken'] = $val['ops_broken'];
				$pool_ops['other'] = $val['ops_other'];
				$pool_ops['so'] = $val['ops_so'];
				$pool_ops['operasi'] = $val['ops_operasi'];
				$pool_ops['non_operasi'] = $val['ops_non_operasi'];
				$pool_ops['total'] = $val['ops_total'];
				$pool_ops['avg_tp'] = $val['avg_tp'];
				$pool_ops['avg_spj'] = $val['avg_spj'];
				$pool_ops['ops_mtd'] = $val['ops_mtd'];				

				$pool_rev['id'] = $val['id_poolx'];	
				$pool_rev['name'] = $val['name'];				
				$pool_rev['angsuran_ks'] = $val['angsuran_ks'];
				$pool_rev['setoran'] = $val['total_rev'];
				$pool_rev['total_spj'] = $val['total_spj'];
				$pool_rev['tagihan_operasi'] = $val['tagihan_operasi'];
				$pool_rev['ks_operasi'] = $val['ks_operasi'];
				$pool_rev['ks_non_operasi'] = $val['ks_non_operasi'];
				$pool_rev['setoran'] = $val['total_rev'];
				$pool_rev['total_tagihan'] = -$val['ks_non_operasi'] - $val['ks_operasi'] + $val['total_rev'];
				$pool_rev['bayar_ks'] = $val['bayar_hutang'];		
				$pool_rev['ksmurni_ytd'] = $val['ksmurni_ytd'];
				$pool_rev['kstp_ytd'] = $val['kstp_ytd'];
				$pool_rev['ksmurni_mtd'] = $val['ksmurni_mtd'];
				$pool_rev['kstp_mtd'] = $val['kstp_mtd'];	
				$pool_rev['bayar_hutang'] = $val['bayar_hutang'];		
				$pool_rev['total_cash_inflow'] = $val['total_rev'] + $val['angsuran_ks'] + $val['bayar_hutang'];
				$pool_rev['total_spj_telat'] = $this->get_total_spj_telat($arrTelatSetor, $pool_rev['id']);
				$pool_rev['total_spj_setor'] = $pool_rev['total_spj'] - $pool_rev['total_spj_telat'];		
				$pool_rev['total_spj_telat_sudah_setor'] = $this->get_total_spj_telat_sudah_setor($arrTelatSetor, $pool_rev['id']);
				$pool_rev['total_spj_sudah_setor'] = $pool_rev['total_spj_setor'] + $pool_rev['total_spj_telat_sudah_setor'];
				$pool_rev['total_setoran_spj_telat'] = $this->get_total_setoran_spj_telat($arrTelatSetor, $pool_rev['id']);
				$pool_rev['total_setoran_sudah_setor'] = $pool_rev['setoran'] + $pool_rev['total_setoran_spj_telat'];
				$pool_rev['ks_after_bayar_telat'] = $pool_rev['ks_operasi'] + $pool_rev['total_setoran_spj_telat'];
				$pool_rev['angsuran_ks'] = $pool_rev['angsuran_ks'] - $pool_rev['total_setoran_spj_telat'];
				//$arr['rate'] = $arr['ks_operasi'] / $arr['tagihan_operasi'] * -100;				
				$pool_rev['total_tagihan'] = $pool_rev['setoran'] + $pool_rev['total_setoran_spj_telat'] - $pool_rev['ks_after_bayar_telat'] - $pool_rev['ks_non_operasi'];				
				$pool_rev['pct_ks'] = -$pool_rev['ks_after_bayar_telat'] / ($pool_rev['total_tagihan'] > 0 ? $pool_rev['total_tagihan'] : 1) * 100;
				$pool_rev['rev_mtd'] = $val['rev_mtd'];				
									
				
				$arr['last_update'] = date('Y-m-d H:00:00');				
				$arr['reguler'] += $val['ops_reguler'];
				$arr['kalong'] += $val['ops_kalong'];
				$arr['tp'] += $val['ops_tp'];
				$arr['broken'] += $val['ops_broken'];
				$arr['other'] += $val['ops_other'];
				$arr['so'] += $val['ops_so'];
				$arr['operasi'] += $val['ops_operasi'];
				$arr['non_operasi'] += $val['ops_non_operasi'];
				$arr['total'] += $val['ops_total'];
				
				$arr['angsuran_ks'] += $val['angsuran_ks'] - $pool_rev['total_setoran_spj_telat'];
				$arr['total_rev'] += $val['total_rev'] + $val['angsuran_ks'] + $val['bayar_hutang'];
				$arr['total_spj'] += $val['total_spj'];
				$arr['tagihan_operasi'] += $val['tagihan_operasi'];
				$arr['ks_operasi'] += $pool_rev['ks_after_bayar_telat'];
				$arr['ks_non_operasi'] += $val['ks_non_operasi'];
				$arr['total_tagihan'] += -$val['ks_non_operasi'] + -$val['ks_operasi'] + $val['total_rev'];
				$arr['bayar_ks'] += $val['bayar_hutang'];	
				$arr['setoran'] += $val['total_rev'];
				$arr['setoran_telat'] += $pool_rev['total_setoran_spj_telat'];	
				
				array_push($arr['pool_ops'], $pool_ops);
				array_push($arr['pool_revs'], $pool_rev);
			}
			$arr['total_arpof'] = $arr['total_rev'] / ($arr['total_spj'] > 0 ? $arr['total_spj'] : 1);
			$arr['fleet_utility'] = $arr['operasi'] / $arr['total'] * 100;
			$arr['total_ks'] = $arr['ks_operasi'] + $arr['ks_non_operasi'];
			$arr['rate'] = $arr['ks_operasi'] / ($arr['total_tagihan'] > 0 ? $arr['total_tagihan'] : 1) * -100;	
			$arr['ks_rate'] = $arr['total_ks'] / ($arr['total_tagihan'] > 0 ? $arr['total_tagihan'] : 1) * -100;
			$arr['avg_ks'] = $arr['ks_operasi'] / ($arr['total_spj'] > 0 ? $arr['total_spj'] : 1);
			$arr['spj_yest'] = ($arr['operasi'] - $yest) / $yest * 100;
			$arr['rev_yest'] = ($arr['total_rev'] - $yest2) / $yest2 * 100;

			//INVENTORY
			$arrDataInventory = $this->dashboard_model->get_inventory_pool_area($date);
			$arr['inventory_area'] = array();
		
			foreach((Array) $arrDataInventory AS $key => $val){
				$a = array();
				$a['namepart'] = $val['namepart'];			
				$a['satuan'] = $val['satuan'];	
				$a['jenis'] = $val['jenis'];
				$a['qty'] = $val['qty'];
				$a['id_item'] = $val['id_item'];				
				$a['area'] = $val['pool_area'];
				if(($val['pool_area'] == Admin::AREA_REGULER_1 && $id == Admin::AREA_REGULER_1) 
					|| ($val['pool_area'] == Admin::AREA_REGULER_2 && $id == Admin::AREA_REGULER_2)
					|| ($val['pool_area'] == Admin::AREA_REGULER_3 && $id == Admin::AREA_REGULER_3)
					|| ($val['pool_area'] == Admin::AREA_REGULER_4 && $id == Admin::AREA_REGULER_4)					
					){
					array_push($arr['inventory_area'], $a);
				}	
			}

			$this->load->view('detail_reg', Array('data' => $arr, 'date' => $date, 'area' => true));
		} else if($id === '4' || $id === '5') { //EAGLE AND TIARA
			$arr['name'] = $id === '4' ? 'Pool Eagle' : 'Pool Tiara';
			$arr['id'] = $id;
			$arr['reguler'] = 0;
			$arr['kalong'] = 0;
			$arr['tp'] = 0;
			$arr['body_repair'] = 0;
			$arr['lain'] = 0;
			$arr['tl'] = 0;
			$arr['argo_rds'] = 0;
			$arr['surat'] = 0;
			$arr['operasi'] = 0;
			$arr['non_operasi'] = 0;
			$arr['total'] = 0;
			
			$arr['total_rev'] = 0;
			$arr['total_spj'] = 0;
			$arr['total_gross'] = 0;
			$arr['total_komisi'] = 0;
			$arr['total_bbm'] = 0;
			$arr['total_arpof'] = 0;
			$arr['total_lain'] = 0;
			$arr['total_denda'] = 0;
			$arr['bayar_hutang'] = 0;
			$arr['hutang_baru'] = 0;
			$arr['cash_inflow'] = 0;
			$arr['total_insentif'] = 0;
			foreach((Array) $arrData AS $key => $val){
				$pool_ops = $pool_rev = array();
				
				$pool_ops['id'] = $val['id_poolx'];	
				$pool_ops['name'] = $val['name'];	
				$pool_ops['reguler'] = $val['ops_reguler'];
				$pool_ops['kalong'] = $val['ops_kalong'];
				$pool_ops['tp'] = $val['ops_tp'];
				$pool_ops['body_repair'] = $val['ops_broken'];
				$pool_ops['lain'] = $val['ops_other'];
				$pool_ops['tl'] = $val['ops_tl'];
				$pool_ops['argo_rds'] = $val['ops_argo_rds'];				
				$pool_ops['surat'] = $val['ops_surat'];
				$pool_ops['operasi'] = $val['ops_operasi'];
				$pool_ops['non_operasi'] = $val['ops_non_operasi'];
				$pool_ops['total'] = $val['ops_total'];
				$pool_ops['avg_tp'] = $val['avg_tp'];
				$pool_ops['avg_spj'] = $val['avg_spj'];
				$pool_ops['ops_mtd'] = $val['ops_mtd'];				
				
				$pool_rev['id'] = $val['id_poolx'];	
				$pool_rev['name'] = $val['name'];	
				$pool_rev['total_rev'] = $val['total_rev'];
				$pool_rev['total_spj'] = $val['total_spj'];
				$pool_rev['total_gross'] = $val['total_gross'];
				$pool_rev['total_komisi'] = $val['total_komisi'];
				$pool_rev['total_bbm'] = $val['total_bbm'];
				$pool_rev['total_arpof'] = $val['total_arpof'];
				$pool_rev['total_lain'] = $val['total_lain'];
				$pool_rev['total_denda'] = $val['total_denda'];
				$pool_rev['bayar_hutang'] = $val['bayar_hutang'];
				$pool_rev['hutang_baru'] = $val['hutang_baru'];
				$pool_rev['total_insentif'] = $val['nominal_insentif_kehadiran'];
				$pool_rev['cash_inflow'] = $val['total_rev'] + $val['total_denda'] + $val['bayar_hutang'] + ($val['total_lain'] > 0 ? $val['total_lain'] : 0);
				$pool_rev['rev_mtd'] = $val['rev_mtd'];
				$pool_rev['spj_mtd'] = $val['spj_mtd'];									
				$pool_rev['rev_ytd'] = $val['rev_ytd'];
				$pool_rev['spj_ytd'] = $val['spj_ytd'];		
				
				$arr['last_update'] = date('Y-m-d H:00:00');				
				$arr['reguler'] += $val['ops_reguler'];
				$arr['kalong'] += $val['ops_kalong'];
				$arr['tp'] += $val['ops_tp'];
				$arr['body_repair'] += $val['ops_broken'];
				$arr['lain'] += $val['ops_other'];
				$arr['tl'] += $val['ops_tl'];
				$arr['argo_rds'] += $val['ops_argo_rds'];				
				$arr['surat'] += $val['ops_surat'];
				$arr['operasi'] += $val['ops_operasi'];
				$arr['non_operasi'] += $val['ops_non_operasi'];
				$arr['total'] += $val['ops_total'];
			
				$arr['total_rev'] += $val['total_rev'];
				$arr['total_spj'] += $val['total_spj'];
				$arr['total_gross'] += $val['total_gross'];
				$arr['total_komisi'] += $val['total_komisi'];
				$arr['total_bbm'] += $val['total_bbm'];
				$arr['total_insentif'] += $val['nominal_insentif_kehadiran'];				
				$arr['total_arpof'] += $val['total_arpof'];
				$arr['total_lain'] += $val['total_lain'];
				$arr['total_denda'] += $val['total_denda'];
				$arr['bayar_hutang'] += $val['bayar_hutang'];
				$arr['hutang_baru'] += $val['hutang_baru'];
				$arr['cash_inflow'] += $val['total_rev'] + $val['total_denda'] + $val['bayar_hutang'] + ($val['total_lain'] > 0 ? $val['total_lain'] : 0);	
				array_push($arr['pool_ops'], $pool_ops);
				array_push($arr['pool_revs'], $pool_rev);
			}
			$arr['is_tiara'] = 	$id === '5';
			$arr['spj_yest'] = ($arr['operasi'] - $yest) / $yest * 100;	
			$arr['rev_yest'] = ($arr['cash_inflow'] - $yest2) / $yest2 * 100;					
			$arr['total_arpof'] = $arr['cash_inflow'] / ($arr['total_spj'] > 0 ? $arr['total_spj'] : 1);			
			$arr['fleet_utility'] = $arr['operasi'] / $arr['total'] * 100;
			$this->load->view('detail_eagle', Array('data' => $arr, 'date' => $date, 'area' => true));			
		}
		$this->load->view('footer');
	}
	
	function get_trip(){
		$date = $_GET['date'];
		$reg_no = $_GET['reg_no'];
		$tipe = $_GET['tipe'];
		$data = $this->xone_model->get_trip($date, $reg_no, $tipe);
		$this->load->view('location', Array('reg_no'=> $reg_no, 'date'=> $date, 'data' => $data, 'tipe' => ($tipe === '0' ? 'Reguler' : 'Kalong')));
	}
	
	function get_trip_spj(){
		$reg_no = $_GET['reg_no'];
		$tipe = $_GET['tipe'];
		$spj_code = $_GET['spj_code'];
		$data = $this->xone_model->get_trip_spj($spj_code);
		$this->load->view('location', Array('reg_no'=> $reg_no, 'data' => $data, 'tipe' => ($tipe === '0' ? 'Reguler' : ($tipe === '1' ? 'Kalong' : $tipe))));
	}
	
	function get_trip_tiara(){
		$this->load->model('xone_tiara_model');	
		$reg_no = $_GET['reg_no'];
		$nomor_spj = $_GET['nomor_spj'];
		$tipe = $_GET['tipe'];
		$data = $this->xone_tiara_model->get_trip_spj($nomor_spj);
		$this->load->view('location', Array('reg_no'=> $reg_no, 'data' => $data, 'tipe' => ($tipe === '0' ? 'Reguler' : 'Kalong')));
	}
	
	function get_moving($arr, $date, $is_30){
		$a = array();
		$start = false;
		$ct = 0;
		$max = $is_30 ? 30 : 90;
		foreach((Array) $arr AS $key => $val){
			if(strtotime($val['tgl_spj']) == $date){
				$start = true;
			}
			if($start && $ct < $max){
				array_push($a, $val['operasi']);
				$ct++;
			}
			if($ct >= $max)
				break;
		}
		$avg = array_sum($a) / (count($a) > 0 ? count($a) : 1);
		return round($avg);
	}
	
	function get_trip_argo_spj_array($arr, $no_spj){
		$a = array();
		$a['trip'] = 0;
		$a['argo'] = 0;
		foreach((Array) $arr AS $key2 => $val2){
			if($val2['assignment_code'] === $no_spj){
				if(!isset($val2['total_trip'])) {
					print_r($val2);
					die();
				}
				$a['trip'] = $val2['total_trip'];
				$a['argo'] = $val2['total_argo'];
				break;
			}
		}
		return $a;
	}
	
	function get_trip_argo_spj_array2($arr, $no_spj){
		$a = array();
		$a['trip'] = 0;
		$a['argo'] = 0;
		foreach((Array) $arr AS $key2 => $val2){
			if($val2['assignment_code'] === $no_spj){
				if($val2['rit2'] <= $val2['rit1']){
					$a['trip'] = $val2['rit1'] - $val2['rit2'];
				} else {
					$a['trip'] = ($val2['rit1'] + 9999) - $val2['rit2'];
				}
				if($val2['drop2'] <= $val2['drop1']){
					$a['argo'] = $val2['drop1'] - $val2['drop2'];
				} else {	
					$a['argo'] = ($val2['drop1'] + 9999) - $val2['drop2'];
				}
				$a['argo'] = ($a['trip'] * 6500) + ($a['argo'] * 380);				
				break;
			}
		}
		return $a;
	}
	
	function new_comment(){
		$spj_code = $_GET['spj_code'];
		$id_pool = $_GET['id_pool'];
		$date = $_GET['date'];
		$rit = $_GET['rit'];
		$argo = $_GET['argo'];								
		$this->load->view('new_comment', Array('username'=> $this->user['username'], 
			'tipe_alasan' => $this->dashboard_model->get_alasan_ks(), 'spj_code' => $spj_code, 
			'id_pool' => $id_pool, 'date' => $date, 'rit' => $rit, 'argo' => $argo));
	}
	
	function get_perf_ks(){
		$date = $_GET['date'];
		$username = $_GET['username'];
		$pool = $_GET['pool'];
		$data = $this->dashboard_model->get_performa_operasi_ks_detail($username, $pool, $date);
		$this->load->view('performance_ks', Array('data' => $data, 'username' => $username));
	}
}
