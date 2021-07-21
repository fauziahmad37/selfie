<?php

class api extends CI_Controller {
	const AREA_REGULER_1 = 1;
	const AREA_REGULER_2 = 2;
	const AREA_REGULER_3 = 6;
	const AREA_REGULER_4 = 7;
	const AREA_EAGLE = 4;
	const AREA_TIARA = 5;
		
	private $ms_start;
	function __construct() {
		$this->ms_start = strtotime(date('Y:m:d H:i:s'));	
		ob_start();
		ini_set('memory_limit', '1024M');
		parent::__construct();
	}
	
	protected function _print($r = '') {
		ob_clean();
		if (!is_array($r)) {
			$ms_end = strtotime(date('Y:m:d H:i:s'));
			ob_end_flush();
			echo nl2br($r." Time elapsed : ".number_format(($ms_end - $this->ms_start), 2)." Seconds\n");		
			ob_flush();
			sleep(.1);
			flush();
			ob_start();
			return;
		}
		
		$out = Array();
		
		foreach ((Array) $r AS $key => $val) {
			if (is_array($val)) {
				$out[(string) $key] = $this->_json_str($val);
			} else {
				$out[(string) $key] = (string) $val;
			}
		}
		echo json_encode((Array) $out);
	}
	
	protected function _json_err($code = '', $json = array()) {
		$err = array(			
			'-10' => 'signature failed',
			'-20' => 'user not found',
			'-30' => 'invalid parameter',
			'-40' => 'parameter not complete',
			'-99' => 'db err',
			);
		
		$result = $err[$code];
		if (!$result) $result = 'unknown err';
		$json['code'] = $code;
		$json['description'] = $result;
		
		return $this->_print($json);
	}
	
	private function _json_str($var) {
		$out = Array();
		foreach ((Array) $var AS $key => $val) {
			if (is_array($val)) {
				$out[(string) $key] = $this->_json_str($val);
			} else {
				$out[(string) $key] = (string) $val;
			}
		}
		
		return $out;
	}
	
	protected function _rfilter($data) {
		if (!method_exists($this, '_filter')) return $data;
		
		foreach ((Array) $data AS $key => $val) {
			$data[$key] = $this->_filter($val);
		}
		
		return $data;
	}
	
	protected $arrPool = array( //RDS ID POOL -> DASHBOARD ID POOL
		'1' => '0', '2' => '25', '3' => '26', '4' => '27', '5' => '28', '6' => '29', '7' => '30', '8' => '31', '9' => '32', '10' => '23',
		'11' => '10', '12' => '1', '13' => '22', '14' => '17', '15' => '21', '16' => '4', '17' => '16', '18' => '19', '19' => '7', '20' => '5', 
		'21' => '2', '22' => '18', '23' => '15', '24' => '20', '25' => '3', '26' => '6', '27' => '0', '28' => '9', '29' => '8', '30' => '24', '31' => '0', 
		'32' => '34', '33' => '35', '34' => '40', '35' => '42', '36' => '50', '37' => '45', '38' => '49', '39' => '43', '40' => '0', '41' => '52', 
		'42' => '36', '43' => '0', '44' => '38', '45' => '41', '46' => '47', '47' => '39');
	
	protected $arrPoolMoceReguler = array( //Moce Reguler ID POOL -> DASHBOARD ID POOL
		'2' => '17', '3' => '15',  '4' => '16',  '5' => '21',  '6' => '22',  '7' => '23',  '9' => '1',  '10' => '2',  '11' => '19',  '12' => '20', 
		'19' => '3',  '20' => '4',  '32' => '24',  '33' => '8',  '34' => '18',  '35' => '7',  '36' => '10',  '37' => '6',  '38' => '5',  '50' => '9');	
	
	protected $arrPoolRental = array( //Rental ID POOL -> DASHBOARD ID POOL
		'82518066' => '54', '86320448' => '55', '102841766' => '56', '121697290' => '57', 
		'175798644' => '58', '203071733' => '59', '251976689' => '60'
		);
		
}
?>