<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Driver extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');		
	}
	
	public function index($date = '')
	{
		if($date === '' || strtotime($date) >= strtotime(date('Y-m-d')))
			$date = date('Y-m-d',strtotime("-1 days"));
				
		//CHECK LAST UPDATE
		$check = $this->dashboard_model->check_driver($date);
		if(!$check){
// 			$this->backup_driver_today($date);
			$check = date('j F Y H:i:s');
		} else {
			$check = date('j F Y H:i:s', strtotime($check));
		}
		$data['last_update'] = $check;
		
		$arrData = $this->dashboard_model->get_driver($date);
		$arrDataCar = $this->dashboard_model->get_car($date);		
		$data['series'] = $this->dashboard_model->get_series_driver($date);
		$data['avg_hk_total'] = $data['series'][0]['ct'] / ($data['series'][0]['total'] > 0 ? $data['series'][0]['total'] : 1);
		$data['pool_reguler'] = $data['pool_reguler2'] = $data['pool_reguler3'] = $data['pool_reguler4'] = $data['eagle'] = $data['tiara'] = array();
		$data['mtd_driver_active'] = $data['series'][0]['total'];
		$data['mtd_car_active'] = $this->dashboard_model->get_series_car($date);
		
		$ct_reg_bravo_aktif = 0;
		$ct_reg_bravo_inaktif = 0;
		$ct_reg_charli_aktif = 0;				
		$ct_reg_charli_inaktif = 0;
		$ct_reg_mtd_aktif = 0;
		
		$ct_eagle_driver_aktif = 0;
		$ct_eagle_driver_inaktif = 0;
		$ct_eagle_driver_retire = 0;		
		$ct_eagle_driver_blacklist = 0;				
		$ct_eagle_mtd_aktif = 0;
		
		$ct_tiara_driver_aktif = 0;	
		$ct_tiara_driver_inaktif = 0;			
		$ct_tiara_driver_retire = 0;	
		$ct_tiara_driver_blacklist = 0;					
		$ct_tiara_mtd_aktif = 0;
		
		foreach((Array) $arrData AS $key => $val){
			//REGULER
			if($val['pool_area'] == Admin::AREA_REGULER_1 
				|| $val['pool_area'] == Admin::AREA_REGULER_2
				|| $val['pool_area'] == Admin::AREA_REGULER_3
				|| $val['pool_area'] == Admin::AREA_REGULER_4								
				) {
				$arr = array();
				$arr['id'] = $val['id_pool'];
				$arr['name'] = $val['name'];
				$arr['bravo_aktif'] = $val['bravo_aktif'];
				$arr['bravo_inaktif'] = $val['bravo_inaktif'];
				$arr['charli_aktif'] = $val['charli_aktif'];
				$arr['charli_inaktif'] = $val['charli_inaktif'];
				$arr['total_aktif'] = $val['bravo_aktif'] + $val['charli_aktif'];
				$arr['total_inaktif'] = $val['bravo_inaktif'] + $val['charli_inaktif'];
				$arr['total'] = $arr['total_aktif'] + $arr['total_inaktif'];
				$arr['mtd_aktif_driver'] = $val['ct'];									
				$arr['aktif_rate'] = $arr['mtd_aktif_driver'] / ($arr['total_aktif'] > 0 ? $arr['total_aktif'] : 1) * 100;
				$arr['avg_driver'] = $val['total_hk'] / ($val['ct'] > 0 ? $val['ct'] : 1);			
				$arr['avg_car'] = $this->get_car_avg($arrDataCar, $arr['id']);
				$arr['median_car'] = $this->get_car_median($arrDataCar, $arr['id'], $date);
								
				$ct_reg_bravo_aktif += $val['bravo_aktif'];
				$ct_reg_bravo_inaktif += $val['bravo_inaktif'];				
				$ct_reg_charli_aktif += $val['charli_aktif'];
				$ct_reg_charli_inaktif += $val['charli_inaktif'];
				$ct_reg_mtd_aktif += $val['ct'];
				
				if($val['pool_area'] == Admin::AREA_REGULER_1 )
					array_push($data['pool_reguler'], $arr);
				else if($val['pool_area'] == Admin::AREA_REGULER_2)
					array_push($data['pool_reguler2'], $arr);
				else if($val['pool_area'] == Admin::AREA_REGULER_3)
					array_push($data['pool_reguler3'], $arr);
				else if($val['pool_area'] == Admin::AREA_REGULER_4)
					array_push($data['pool_reguler4'], $arr);										
			}
			
			//EAGLE
			if($val['pool_area'] === '4') { 
				$arr = array();
				$arr['id'] = $val['id_pool'];
				$arr['name'] = $val['name'];
				$arr['driver_aktif'] = $val['driver_aktif'];
				$arr['driver_inaktif'] = $val['driver_inaktif'];
				$arr['driver_retire'] = $val['driver_retire'];
				$arr['driver_blacklist'] = $val['driver_blacklist'];
				$arr['total_aktif'] = $val['driver_aktif'];
				$arr['total_inaktif'] = $val['driver_inaktif'] + $val['driver_retire'] + $val['driver_blacklist'];
				$arr['total'] = $arr['total_aktif'] + $arr['total_inaktif'];
				$arr['mtd_aktif_driver'] = $val['ct'];					
				$arr['aktif_rate'] = $arr['mtd_aktif_driver'] / ($arr['total_aktif'] > 0 ? $arr['total_aktif'] : 1) * 100;
				$arr['avg_driver'] = $val['total_hk'] / ($val['ct'] > 0 ? $val['ct'] : 1);			
				$arr['avg_car'] = $this->get_car_avg($arrDataCar, $arr['id']);
				$arr['median_car'] = $this->get_car_median($arrDataCar, $arr['id'], $date);
				
				$ct_eagle_driver_aktif += $val['driver_aktif'];
				$ct_eagle_driver_inaktif += $val['driver_inaktif'];				
				$ct_eagle_driver_retire += $val['driver_retire'];
				$ct_eagle_driver_blacklist += $val['driver_blacklist'];
				$ct_eagle_mtd_aktif += $val['ct'];
				
				array_push($data['eagle'], $arr);
			}
			
			//TIARA
			if($val['pool_area'] === '5') { 
				$arr = array();
				$arr['id'] = $val['id_pool'];
				$arr['name'] = $val['name'];
				$arr['driver_aktif'] = $val['driver_aktif'] / 2;
				$arr['driver_inaktif'] = $val['driver_inaktif'] / 2;
				$arr['driver_retire'] = $val['driver_retire'] / 2;
				$arr['driver_blacklist'] = $val['driver_blacklist'] / 2;
				$arr['total_aktif'] = $val['driver_aktif'] / 2;
				$arr['total_inaktif'] = $arr['driver_inaktif'] + $arr['driver_retire'] + $arr['driver_blacklist'];
				$arr['total'] = $arr['total_aktif'] + $arr['total_inaktif'];
				$arr['mtd_aktif_driver'] = $val['ct'];					
				$arr['aktif_rate'] = $arr['mtd_aktif_driver'] / ($arr['total_aktif'] > 0 ? $arr['total_aktif'] : 1) * 100;
				$arr['avg_driver'] = $val['total_hk'] / ($val['ct'] > 0 ? $val['ct'] : 1);			
				$arr['avg_car'] = $this->get_car_avg($arrDataCar, $arr['id']);
				$arr['median_car'] = $this->get_car_median($arrDataCar, $arr['id'], $date);
								
				$ct_tiara_driver_aktif += $arr['driver_aktif'];
				$ct_tiara_driver_inaktif += $arr['driver_inaktif'];				
				$ct_tiara_driver_retire += $arr['driver_retire'];
				$ct_tiara_driver_blacklist += $arr['driver_blacklist'];
				$ct_tiara_mtd_aktif += $val['ct'];
				
				array_push($data['tiara'], $arr);
			}
		}
		
		$data['reg_bravo_aktif'] = $ct_reg_bravo_aktif;
		$data['reg_bravo_inaktif'] = $ct_reg_bravo_inaktif;
		$data['reg_charli_aktif'] = $ct_reg_charli_aktif;
		$data['reg_charli_inaktif'] = $ct_reg_charli_inaktif;
		$data['reg_total_aktif'] = $ct_reg_bravo_aktif + $ct_reg_charli_aktif;
		$data['reg_total_inaktif'] = $ct_reg_bravo_inaktif + $ct_reg_charli_inaktif;
		$data['reg_mtd_aktif'] = $ct_reg_mtd_aktif;		
		$data['reg_total_driver'] = $data['reg_total_aktif'] + $data['reg_total_inaktif'];
		$data['reg_driver_rate'] = $data['reg_mtd_aktif'] / ($data['reg_total_aktif'] > 0 ? $data['reg_total_aktif'] : 1) * 100;
		
		$data['eagle_driver_aktif'] = $ct_eagle_driver_aktif;
		$data['eagle_driver_inaktif'] = $ct_eagle_driver_inaktif;
		$data['eagle_driver_retire'] = $ct_eagle_driver_retire;
		$data['eagle_driver_blacklist'] = $ct_eagle_driver_blacklist;	
		$data['eagle_total_aktif'] = $ct_eagle_driver_aktif;
		$data['eagle_total_inaktif'] = $ct_eagle_driver_inaktif + $ct_eagle_driver_retire + $ct_eagle_driver_blacklist;
		$data['eagle_mtd_aktif'] = $ct_eagle_mtd_aktif;		
		$data['eagle_total_driver'] = $data['eagle_total_aktif'] + $data['eagle_total_inaktif'];
		$data['eagle_driver_rate'] = $data['eagle_mtd_aktif'] / ($data['eagle_total_aktif'] > 0 ? $data['eagle_total_aktif'] : 1) * 100;
		
		$data['tiara_driver_aktif'] = $ct_tiara_driver_aktif;
		$data['tiara_driver_inaktif'] = $ct_tiara_driver_inaktif;
		$data['tiara_driver_retire'] = $ct_tiara_driver_retire;
		$data['tiara_driver_blacklist'] = $ct_tiara_driver_blacklist;				
		$data['tiara_total_aktif'] = $ct_tiara_driver_aktif;
		$data['tiara_total_inaktif'] = $ct_tiara_driver_inaktif + $ct_tiara_driver_retire + $ct_tiara_driver_blacklist;
		$data['tiara_mtd_aktif'] = $ct_tiara_mtd_aktif;		
		$data['tiara_total_driver'] = $data['tiara_total_aktif'] + $data['tiara_total_inaktif'];
		$data['tiara_driver_rate'] = $data['tiara_mtd_aktif'] / ($data['tiara_total_aktif'] > 0 ? $data['tiara_total_aktif'] : 1) * 100;
		
		$data['driver_aktif'] = $ct_reg_bravo_aktif + $ct_reg_charli_aktif + $ct_eagle_driver_aktif + $ct_tiara_driver_aktif;
		$data['driver_inaktif'] = $ct_reg_bravo_inaktif + $ct_reg_charli_inaktif 
			+ $ct_eagle_driver_inaktif + $ct_eagle_driver_retire + $ct_eagle_driver_blacklist 
			+ $ct_tiara_driver_inaktif + $ct_tiara_driver_retire + $ct_tiara_driver_blacklist;
		$data['total_driver'] = $data['driver_aktif'] + $data['driver_inaktif'];
		$data['driver_rate'] = $data['driver_aktif'] / ($data['total_driver'] > 0 ? $data['total_driver'] : 1) * 100;		
		$data['mtd_driver_rate'] = $data['mtd_driver_active'] / ($data['driver_aktif'] > 0 ? $data['driver_aktif'] : 1) * 100;	
				
		$this->load->view('header');
		$this->load->view('driver', Array('data' => $data, 'date' => $date));
		$this->load->view('footer');	
	}
	
	function get_car_avg($arr, $id){
		foreach((Array) $arr AS $key => $val){
			if($val['id_pool'] == $id){
				return $val['total_hk'] / ($val['ct'] > 0 ? $val['ct'] : 1);			
			}
		}
		return 0;
	}
	
	function get_car_median($arr, $id, $date){
		foreach((Array) $arr AS $key => $val){
			if($val['id_pool'] == $id){
				$middleval = floor(($val['ct']-1)/2);
				$ct = 0;
				$arr_car = $this->dashboard_model->get_car_by_id($id, $date)[0];
				if(Count($arr_car) < 1) return 0;
				$ct += $arr_car['d1'];
				if($ct >= $middleval) return 1;
				$ct += $arr_car['d2'];
				if($ct >= $middleval) return 2;
				$ct += $arr_car['d3'];
				if($ct >= $middleval) return 3;
				$ct += $arr_car['d4'];
				if($ct >= $middleval) return 4;
				$ct += $arr_car['d5'];
				if($ct >= $middleval) return 5;
				$ct += $arr_car['d6'];
				if($ct >= $middleval) return 6;
				$ct += $arr_car['d7'];
				if($ct >= $middleval) return 7;
				$ct += $arr_car['d8'];
				if($ct >= $middleval) return 8;
				$ct += $arr_car['d9'];
				if($ct >= $middleval) return 9;
				$ct += $arr_car['d10'];
				if($ct >= $middleval) return 10;
				$ct += $arr_car['d11'];
				if($ct >= $middleval) return 11;
				$ct += $arr_car['d12'];
				if($ct >= $middleval) return 12;
				$ct += $arr_car['d13'];
				if($ct >= $middleval) return 13;
				$ct += $arr_car['d14'];
				if($ct >= $middleval) return 14;
				$ct += $arr_car['d15'];
				if($ct >= $middleval) return 15;
				$ct += $arr_car['d16'];
				if($ct >= $middleval) return 16;
				$ct += $arr_car['d17'];
				if($ct >= $middleval) return 17;
				$ct += $arr_car['d18'];
				if($ct >= $middleval) return 18;
				$ct += $arr_car['d19'];
				if($ct >= $middleval) return 19;
				$ct += $arr_car['d20'];
				if($ct >= $middleval) return 20;
				$ct += $arr_car['d21'];
				if($ct >= $middleval) return 21;
				$ct += $arr_car['d22'];
				if($ct >= $middleval) return 22;
				$ct += $arr_car['d23'];
				if($ct >= $middleval) return 23;
				$ct += $arr_car['d24'];
				if($ct >= $middleval) return 24;
				$ct += $arr_car['d25'];
				if($ct >= $middleval) return 25;
				$ct += $arr_car['d26'];
				if($ct >= $middleval) return 26;
				$ct += $arr_car['d27'];
				if($ct >= $middleval) return 27;
				$ct += $arr_car['d28'];
				if($ct >= $middleval) return 28;
				$ct += $arr_car['d29'];
				if($ct >= $middleval) return 29;
				$ct += $arr_car['d30'];
				if($ct >= $middleval) return 30;
				$ct += $arr_car['d31'];
				if($ct >= $middleval) return 31;																																																																																																								
			}
		}
		return 0;
	}
}
