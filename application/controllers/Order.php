<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Order extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('xone_model');		
	}
	
	public function index($date = '')
	{
		if(isset($_GET['date']))
			$date = $_GET['date'];
		$start = '';
		$start = isset($_GET['start']) ? $_GET['start'] : $start;
		$date = isset($_GET['end']) ? $_GET['end'] : $date;	
				
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d')))
			$date = date('Y-m-d',strtotime("-1 days"));
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
	
		if(strtotime($start) > strtotime($date)){
			$temp = $start;
			$start = $date;
			$date = $start;
		}
		$arrData = $this->xone_model->order($start, $date);

		$arr = array();
		
		$arr['broadcast_series'] = $arrData['broadcast_series'];
		$arr['order_series'] = $arrData['order_series'];
		$arr['time'] = $arrData['time'][0];		
		$arr['progress'] = 0;
		$arr['failed'] = 0;		
		$arr['completed'] = 0;	
		$arr['thomas'] = 0;
		$arr['call_center'] = 0;
		$arr['cancel_customer'] = 0;
		$arr['cancel_driver'] = 0;
		$arr['cancel_other_taxi'] = 0;						
		foreach((Array) $arrData['order'] AS $key => $val){
			if($val['status'] === '1'){
				$arr['progress'] += $val['ct'];
			} else if($val['status'] === '2'){
				$arr['progress'] += $val['ct'];
			} else if($val['status'] === '3'){
				$arr['progress'] += $val['ct'];
			} else if($val['status'] === '4'){
				$arr['progress'] += $val['ct'];
			} else if($val['status'] === '5'){
				$arr['progress'] += $val['ct'];
			} else if($val['status'] === '6'){
				$arr['completed'] += $val['ct'];
			} else if($val['status'] === '8'){
				$arr['failed'] += $val['ct'];
			} else if($val['status'] === '9'){
				$arr['completed'] += $val['ct'];
			}
			
			if($val['thomas'] === 't'){
				$arr['thomas'] += $val['ct'];
			} else if($val['thomas'] === 'f'){
				$arr['call_center'] += $val['ct'];
			}
		}
		
		$arr['total_order'] = $arr['thomas'] + $arr['call_center'];		
		$arr['rate_order'] = $arr['completed'] / ($arr['total_order'] > 0 ? $arr['total_order'] : 1) * 100;
		
		foreach((Array) $arrData['order_cancel'] AS $key => $val){
			if($val['cancel_type'] === '1'){
				$arr['cancel_customer'] += $val['ct'];
			} else if($val['cancel_type'] === '2'){
				$arr['cancel_driver'] += $val['ct'];
			} else if($val['cancel_type'] === '3'){
				$arr['cancel_other_taxi'] += $val['ct'];
			} 
		}
		
		$arr['pool_reguler'] = array();		
		$arr['pool_reguler']['broadcast'] = 0;
		$arr['pool_reguler']['accept'] = 0;
		$arr['pool_reguler']['reject'] = 0;	
		
		$arr['pool_reguler2'] = array();		
		$arr['pool_reguler2']['broadcast'] = 0;
		$arr['pool_reguler2']['accept'] = 0;
		$arr['pool_reguler2']['reject'] = 0;		

		$arr['pool_eagle'] = array();		
		$arr['pool_eagle']['broadcast'] = 0;
		$arr['pool_eagle']['accept'] = 0;
		$arr['pool_eagle']['reject'] = 0;
		
		foreach((Array) $arrData['broadcast'] AS $key => $val){
			$id = $this->arrPool[$val['pool_id']];
			//AREA 1
			if($id <= 10)
			{
				$arr['pool_reguler']['broadcast'] += $val['ct'];
				$arr['pool_reguler']['accept'] += $val['accept'];								
				$arr['pool_reguler']['reject'] += $val['reject'];
				
				$arr['pool_reguler_data'][$id]['pool_id'] = $id;
				$arr['pool_reguler_data'][$id]['name'] = $val['name'];
				$arr['pool_reguler_data'][$id]['broadcast'] = $val['ct'];
				$arr['pool_reguler_data'][$id]['accept'] = $val['accept'];
				$arr['pool_reguler_data'][$id]['reject'] = $val['reject'];
				$arr['pool_reguler_data'][$id]['pct_accept'] = $val['accept'] / ($val['ct'] > 0 ? $val['ct'] : 1) * 100;
				$arr['pool_reguler_data'][$id]['pct_reject'] = $val['reject'] / ($val['ct'] > 0 ? $val['ct'] : 1) * 100;
			}
			//AREA 2
			if($id >= 15 && $id <= 24)
			{
				$arr['pool_reguler2']['broadcast'] += $val['ct'];
				$arr['pool_reguler2']['accept'] += $val['accept'];								
				$arr['pool_reguler2']['reject'] += $val['reject'];
				
				$arr['pool_reguler2_data'][$id]['pool_id'] = $id;
				$arr['pool_reguler2_data'][$id]['name'] = $val['name'];				
				$arr['pool_reguler2_data'][$id]['broadcast'] = $val['ct'];
				$arr['pool_reguler2_data'][$id]['accept'] = $val['accept'];
				$arr['pool_reguler2_data'][$id]['reject'] = $val['reject'];
				$arr['pool_reguler2_data'][$id]['pct_accept'] = $val['accept'] / ($val['ct'] > 0 ? $val['ct'] : 1) * 100;
				$arr['pool_reguler2_data'][$id]['pct_reject'] = $val['reject'] / ($val['ct'] > 0 ? $val['ct'] : 1) * 100;
			}
			//EAGLE
			if($id >= 25 && $id <= 32)
			{
				$arr['pool_eagle']['broadcast'] += $val['ct'];
				$arr['pool_eagle']['accept'] += $val['accept'];								
				$arr['pool_eagle']['reject'] += $val['reject'];

				$arr['pool_eagle_data'][$id]['pool_id'] = $id;
				$arr['pool_eagle_data'][$id]['name'] = $val['name'];
				$arr['pool_eagle_data'][$id]['broadcast'] = $val['ct'];
				$arr['pool_eagle_data'][$id]['accept'] = $val['accept'];
				$arr['pool_eagle_data'][$id]['reject'] = $val['reject'];				
				$arr['pool_eagle_data'][$id]['pct_accept'] = $val['accept'] / ($val['ct'] > 0 ? $val['ct'] : 1) * 100;
				$arr['pool_eagle_data'][$id]['pct_reject'] = $val['reject'] / ($val['ct'] > 0 ? $val['ct'] : 1) * 100;				
			}
		}
		$arr['pool_reguler']['pct_accept'] = $arr['pool_reguler']['accept'] / ($arr['pool_reguler']['broadcast'] > 0 ? $arr['pool_reguler']['broadcast'] : 1) * 100;				
		$arr['pool_reguler']['pct_reject'] = $arr['pool_reguler']['reject'] / ($arr['pool_reguler']['broadcast'] > 0 ? $arr['pool_reguler']['broadcast'] : 1) * 100;
		$arr['pool_reguler2']['pct_accept'] = $arr['pool_reguler2']['accept'] / ($arr['pool_reguler2']['broadcast'] > 0 ? $arr['pool_reguler2']['broadcast'] : 1) * 100;				
		$arr['pool_reguler2']['pct_reject'] = $arr['pool_reguler2']['reject'] / ($arr['pool_reguler2']['broadcast'] > 0 ? $arr['pool_reguler2']['broadcast'] : 1) * 100;
		$arr['pool_eagle']['pct_accept'] = $arr['pool_eagle']['accept'] / ($arr['pool_eagle']['broadcast'] > 0 ? $arr['pool_eagle']['broadcast'] : 1) * 100;				
		$arr['pool_eagle']['pct_reject'] = $arr['pool_eagle']['reject'] / ($arr['pool_eagle']['broadcast'] > 0 ? $arr['pool_eagle']['broadcast'] : 1) * 100;
		
		function sort_pool($item1, $item2)
		{
			if ($item1['pool_id'] == $item2['pool_id']) return 0;
			return ($item1['pool_id'] > $item2['pool_id']) ? 1 : -1;
		}
		usort($arr['pool_reguler_data'],'sort_pool');
		usort($arr['pool_reguler2_data'],'sort_pool');
		usort($arr['pool_eagle_data'],'sort_pool');
		
		$this->load->view('header');
		$this->load->view('order', Array('data' => $arr, 'start'=> $start, 'date' => $date));
		$this->load->view('footer');	
	}
}
