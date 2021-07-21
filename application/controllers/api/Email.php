<?php

include_once('Api.php');
class email extends Api {
	function index() {
		$this->_print('Hello'); 
	}
	
	function moce(){
		$this->load->model('moce_model');
		$this->load->model('dashboard_model');		
		$today = date('Y-m-d', strtotime("-2 days"));
		$arrDataMoce = $this->moce_model->get_summary_moce($today, $today);
		$arrData = $this->dashboard_model->get_operation_reguler($today, $today);
		
		$data = array();
		$data['data'] = array();
		$data['total_spj'] = 0;
		$data['total_moce_spj'] = 0;		
		foreach((Array) $arrData AS $key => $val){
			$arr = array();
			$arr['id'] = $val['id'];
			$arr['name'] = $val['name'];
			$arr['ops_operasi'] = $val['ops_operasi'];	
			$arr['ct_moce'] = $this->get_ct_moce($arr['id'], $arrDataMoce);
			
			$arr['pct'] = $arr['ct_moce'] / ($arr['ops_operasi'] > 0 ? $arr['ops_operasi'] : 1) * 100;
			array_push($data['data'], $arr);
					
			$data['total_spj'] += $arr['ops_operasi'];									
			$data['total_moce_spj'] += $arr['ct_moce'];									
		}
		

		$data['pct_total'] = $data['total_moce_spj'] / ($data['total_spj'] > 0 ? $data['total_spj'] : 1) * 100;
		$message = $this->load->view('checker', Array('data' => $data, 'date' => $today, 'start' => $today),  TRUE);	
		$this->email_to($message);
	}
	
	private function email_to($message){
		$this->load->library('email');
		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://mail.expressgroup.co.id';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'sebastian.soesilo@expressgroup.co.id';
        $config['smtp_pass']    = 'D3n1s0v4';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE;

		$this->email->initialize($config);
		$this->email->from('sebastian.soesilo@expressgroup.co.id', 'Your Name');
		$this->email->to('sebastian.soesilo@expressgroup.co.id'); 
// 		$this->email->cc('another@another-example.com'); 
// 		$this->email->bcc('them@their-example.com'); 

		$this->email->subject('Email Test');
		$this->email->message($message);  

		$this->email->send();
		echo $this->email->print_debugger();
	}
	
	private function get_ct_moce($id, $arr){
		foreach((Array) $arr AS $key => $val){
			if($this->arrPoolMoceReguler[$val['id']] == $id){
				return $val['ct'];
			}
		}
		return 0;
	}
}
?>