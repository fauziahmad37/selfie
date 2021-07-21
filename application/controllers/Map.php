<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Map extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
		$this->load->model('xone_model');				
		$this->load->model('xone_tiara_model');						
	}
	
	public function index($date = '')
	{
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d H:i:s');
		
		$data = array();
		$data['pool'] = $this->dashboard_model->get_pools_maps();
		$data['shelter'] = $this->dashboard_model->get_shelters();
		$data['shelter_premium'] = $this->dashboard_model->get_shelters_premium();
		$taxis = $this->xone_model->get_status_taxi();
		$tiaras = $this->xone_tiara_model->get_status_taxi();
		$data[0] = $data[1] = $data[2] = $data[3] = $data[4] = $data[5] = $data[6] = $data[7] = $data[8] = $data[9] = $data[10] = $data[11] = $data[12] = $data[13] = $data[14] = $data[15] = 
		$data[16] = $data[17] = $data[18] = $data[19] = $data[20] = $data[21] = $data[22] = $data[23] = $data[24] = $data[25] = $data[26] = $data[27] = $data[28] = $data[29] = $data[30] = 
		$data[31] = $data[32]  = $data[34] = $data[35] = $data[36] = $data[37] = $data[38] = $data[39] = $data[40] = $data[41] = $data[42] = $data[43] = $data[44] = $data[45] = $data[46] = 
		$data[47] = $data[48] = $data[49] = $data[50] = $data[51] = $data[52] = $data[53] = $data[54] = array();
		$data[33] = $tiaras['status'];
		$data[62] = $tiaras['status_tamcit'];
		$data[64] = $tiaras['status_atr'];
		$data['installed'] = $tiaras['ct']['count'] + $taxis['ct']['count'];
		foreach((array) $taxis['status'] AS $key => $val){
			$arr = array();
			$arr['reg_no'] = $val['reg_no'];
			$arr['lat'] = $val['lat'];
			$arr['lng'] = $val['lng'];
			$arr['hired_status'] = $val['hired_status'];
			$arr['last_location_update'] = $val['last_location_update'];
			$arr['last_location_time'] = $val['last_location_time'];
			$arr['access_time'] = $val['access_time'];
			$arr['pool_id'] = $this->arrPool[$val['pool_id']];
			$arr['assignment_code'] = $val['assignment_code'];
			$arr['name'] = $val['name'] !== null ? $val['name'] : "";
			$arr['mobile_no'] = $val['mobile_no'];
			$arr['msisdn'] = $val['msisdn'] !== null ? $val['msisdn'] : "";												
			array_push($data[intval($arr['pool_id'])], $arr);			
		}
		
		$this->load->view('header');
		$this->load->view('map', Array('date' => $date, 'data' => $data));
		$this->load->view('footer');	
	}
}
