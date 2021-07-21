<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Operation extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}
	
	public function index($date = '')
	{
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d');
		
		//CHECK LAST UPDATE
		$check = $this->dashboard_model->check();
		if(!$check){
// 			$check_ping = $this->backup_operation_this_week();
// 			if(isset($check_ping['down']))
// 			{
// 				$this->load->view('error_data', Array('down' => $check_ping['down']));
// 				return;
// 			}
			$check = date('j F Y H:i:s');
		} else {
			$check = date('j F Y H:i:s', strtotime($check));
		}
		
		$ct_reg_operasi = 0;
		$ct_reg_reguler = 0;
		$ct_reg_kalong = 0;
		$ct_reg_tl = 0;
		$ct_reg_tp = 0;
		$ct_reg_so = 0;
		$ct_reg_lain = 0;
		$ct_total_fleet = 0;
		
		$ct_eagle_reg = 0;
		$ct_eagle_kal = 0;
		$ct_eagle_tp = 0;		
		$ct_eagle_body_repair = 0;
		$ct_eagle_tl = 0;
		$ct_eagle_argo_rds = 0;
		$ct_eagle_lain = 0;
		$ct_eagle_surat = 0;
		
		$ct_tiara_reg = 0;
		$ct_tiara_kal = 0;
		$ct_tiara_tp = 0;		
		$ct_tiara_inaktif_body_repair = 0;
		$ct_tiara_inaktif_tl = 0;
		$ct_tiara_inaktif_lain = 0;
		
		$data = array();
		$data['pool_reguler'] = $data['pool_reguler2'] = $data['eagle'] = $data['tiara'] = $data['pool_reguler3'] = $data['pool_reguler4'] = array();	
		$data['last_update'] = $check;
		$arrData = $this->dashboard_model->get_operation($date);
		if(Count($arrData) == 0){
// 			$arrData = $this->backup_operation_now($date);
		}
		
		$data['series'] = $this->dashboard_model->get_series_operation($date);

		foreach((Array) $arrData AS $key => $val){
			//REGULER
			if($val['pool_area'] === '1' || $val['pool_area'] === '2' || $val['pool_area'] === '6' || $val['pool_area'] === '7') {
				$arr = array();
				$arr['id'] = $val['id_pool'];
				$arr['name'] = $val['name'];
				$arr['reguler'] = $val['ops_reguler'];
				$arr['kalong'] = $val['ops_kalong'];
				$arr['tp'] = $val['ops_tp'];
				$arr['broken'] = $val['ops_broken'];
				$arr['other'] = $val['ops_other'];
				$arr['so'] = $val['ops_so'];
				$arr['operasi'] = $val['ops_operasi'];
				$arr['non_operasi'] = $val['ops_non_operasi'];
				$arr['total'] = $val['ops_total'];
				$arr['avg_tp'] = $val['avg_tp'];
				$arr['avg_spj'] = $val['avg_spj'];
				
				$ct_reg_reguler += $val['ops_reguler'];
				$ct_reg_kalong += $val['ops_kalong'];				
				$ct_reg_tp += $val['ops_tp'];
				$ct_reg_tl += $val['ops_broken'];
				$ct_reg_so += $val['ops_so'];
				$ct_reg_lain += $val['ops_other'];
				
				$ct_total_fleet += $arr['total'];
				
				if($val['pool_area'] === '1')
					array_push($data['pool_reguler'], $arr);
				else if($val['pool_area'] === '2')
					array_push($data['pool_reguler2'], $arr);
				if($val['pool_area'] === '6')
					array_push($data['pool_reguler3'], $arr);
				else if($val['pool_area'] === '7')
					array_push($data['pool_reguler4'], $arr);
			}
			
			//EAGLE
			if($val['pool_area'] === '4') { 
				$arr = array();
				$arr['id'] = $val['id_pool'];
				$arr['name'] = $val['name'];
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
				$arr['avg_tp'] = $val['avg_tp'];
				$arr['avg_spj'] = $val['avg_spj'];				
				
				$ct_eagle_reg += $val['ops_reguler'];
				$ct_eagle_kal += $val['ops_kalong'];
				$ct_eagle_tp += $val['ops_tp'];		
				$ct_eagle_body_repair += $val['ops_broken'];
				$ct_eagle_tl += $val['ops_tl'];
				$ct_eagle_argo_rds += $val['ops_argo_rds'];
				$ct_eagle_lain += $val['ops_other'];
				$ct_eagle_surat += $val['ops_surat'];
				
				$ct_total_fleet += $arr['total'];
				
				array_push($data['eagle'], $arr);
			}
			
			//TIARA
			if($val['pool_area'] === '5') { 
				$arr = array();
				$arr['id'] = $val['id_pool'];
				$arr['name'] = $val['name'];
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
				$arr['avg_tp'] = $val['avg_tp'];
				$arr['avg_spj'] = $val['avg_spj'];
				
				$ct_tiara_reg += $val['ops_reguler'];
				$ct_tiara_kal += $val['ops_kalong'];
				$ct_tiara_tp += $val['ops_tp'];		
				$ct_tiara_inaktif_body_repair += $val['ops_broken'];
				$ct_tiara_inaktif_tl += $val['ops_tl'];
				$ct_tiara_inaktif_lain += $val['ops_other'];
				$ct_total_fleet += $arr['total'];
				
				array_push($data['tiara'], $arr);
			}
		}
		
		//MOVING AVERAGE
		$datas['last_90'] = array();
		$ct = 119;
		$dt = 30;
		for($i = 0;$i <= 30;$i++){
			$a = array();
			$a['tgl_spj'] = date('Y-m-d', strtotime($date.'- '.($dt - $i).' day'));
			$a['operasi'] = $this->get_moving($data['series']['moving'], strtotime($date.'- '.$ct.' day'), false);
			array_push($datas['last_90'], $a);
			$ct--;
		}
		
		$datas['last_30'] = array();
		$ct = 59;
		$dt = 30;
		for($i = 0;$i <= 30;$i++){
			$a = array();
			$a['tgl_spj'] = date('Y-m-d', strtotime($date.'- '.($dt - $i).' day'));
			$a['operasi'] = $this->get_moving($data['series']['moving'], strtotime($date.'- '.$ct.' day'), true);
			array_push($datas['last_30'], $a);
			$ct--;
		}
		
		foreach((Array) $data['series']['spj'] AS $key => $val){
			$data['series']['spj'][$key]['last_30'] = 0;
			$data['series']['spj'][$key]['last_90'] = 0;
			foreach((Array) $datas['last_30'] AS $key2 => $val2){
				if($val2['tgl_spj'] == $val['tgl_spj']){
					$data['series']['spj'][$key]['last_30'] = $val2['operasi'];
					break;
				}
			}
			foreach((Array) $datas['last_90'] AS $key2 => $val2){
				if($val2['tgl_spj'] == $val['tgl_spj']){
					$data['series']['spj'][$key]['last_90'] = $val2['operasi'];
					break;
				}
			}
		}
		
		$data['reguler_reg'] = $ct_reg_reguler;
		$data['reguler_kal'] = $ct_reg_kalong;
		$data['reguler_tp'] = $ct_reg_tp;
		$data['reguler_brok'] = $ct_reg_tl;
		$data['reguler_so'] = $ct_reg_so;
		$data['reguler_lain'] = $ct_reg_lain;
		$data['reguler_operation'] = $data['reguler_reg'] + $data['reguler_kal'];
		$data['reguler_non_operation'] = $data['reguler_tp'] + $data['reguler_brok'] + $data['reguler_so'] + $data['reguler_lain'];
		$data['reguler_total'] = $data['reguler_operation'] + $data['reguler_non_operation'];
		$data['reguler_rate'] = $data['reguler_operation'] / ($data['reguler_total'] > 0 ? $data['reguler_total'] : 1) * 100;
				
		$data['eagle_reg'] = $ct_eagle_reg;
		$data['eagle_kal'] = $ct_eagle_kal;
		$data['eagle_tp'] = $ct_eagle_tp;
		$data['eagle_brok'] = $ct_eagle_body_repair;
		$data['eagle_tl'] = $ct_eagle_tl;
		$data['eagle_argo_rds'] = $ct_eagle_argo_rds;
		$data['eagle_surat'] = $ct_eagle_surat;
		$data['eagle_lain'] = $ct_eagle_lain;
		$data['eagle_operation'] = $data['eagle_reg'] + $data['eagle_kal'];
		$data['eagle_non_operation'] = $data['eagle_tp'] + $data['eagle_brok'] + $data['eagle_tl'] + $data['eagle_argo_rds'] + $data['eagle_surat'] + $data['eagle_lain'];
		$data['eagle_total'] = $data['eagle_operation'] + $data['eagle_non_operation'];
		$data['eagle_rate'] = $data['eagle_operation'] / ($data['eagle_total'] > 0 ? $data['eagle_total'] : 1) * 100;		
			
		$data['tiara_reg'] = $ct_tiara_reg;
		$data['tiara_kal'] = $ct_tiara_kal;
		$data['tiara_tp'] = $ct_tiara_tp;
		$data['tiara_brok'] = $ct_tiara_inaktif_body_repair;
		$data['tiara_tl'] = $ct_tiara_inaktif_tl;
		$data['tiara_lain'] = $ct_tiara_inaktif_lain;
		$data['tiara_operation'] = $ct_tiara_reg + $ct_tiara_kal;
		$data['tiara_non_operation'] = $data['tiara_tp'] + $data['tiara_brok'] + $data['tiara_tl'] + $data['tiara_lain'];
		$data['tiara_total'] = $data['tiara_operation'] + $data['tiara_non_operation'];
		$data['tiara_rate'] = $data['tiara_operation'] / ($data['tiara_total'] > 0 ? $data['tiara_total'] : 1) * 100;
		
		$data['total_spj'] = $data['reguler_operation'] + $data['eagle_operation'] + $data['tiara_operation'];
		$data['total_fleet'] = $data['reguler_total'] + $data['eagle_total'] + $data['tiara_total'];
		$data['fleet_utility'] = number_format($data['total_spj'] * 100 / $data['total_fleet'], 2);		
		
		$yest = Count($data['series']['spj']) >= 2 ? $data['series']['spj'][Count($data['series']['spj']) - 2]['operasi'] : 0;
		$data['spj_yest'] = ($data['total_spj'] - $yest) / $yest * 100;
		$this->load->view('header');
		$this->load->view('operation', Array('data' => $data, 'date' => $date));
		$this->load->view('footer');
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
}
