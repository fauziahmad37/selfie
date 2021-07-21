<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('api/Api.php');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class CreditTicketView extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}
	
	
	
	public function index($date = '', $date1 = '')
	{
		$username = $this->user['username'];
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d',strtotime("-3 days"))))
			$date = date('Y-m-d',strtotime("-3 days"));
		
		if($date1 === '' || strtotime($date1) > strtotime(date('Y-m-d',strtotime("-3 days"))))
			$date1 = date('Y-m-d',strtotime("-3 days"));
		

		if(!$check){

			$check = date('j F Y H:i:s');
		} else {
			$datetime = new DateTime($check);
			$check = date('j F Y H:i:s', strtotime($check));
		}
		$dataCt = $this->dashboard_model->getDataDetailCreditTicket($date, $date1);
		
		
		$this->load->view('header');
		$this->load->view('creditTicket', Array('data' => $data, 'date' => $date, 'dataCt' => $dataCt, 'username' => $username, 'date1' => $date1));
		$this->load->view('footer');
	}
	
	public function download($date = '', $date1 = '')
	{
		$username = $this->user['username'];
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d',strtotime("-3 days"))))
			$date = date('Y-m-d',strtotime("-3 days"));
		
		if($date1 === '' || strtotime($date1) > strtotime(date('Y-m-d',strtotime("-3 days"))))
			$date1 = date('Y-m-d',strtotime("-3 days"));
		

		if(!$check){

			$check = date('j F Y H:i:s');
		} else {
			$datetime = new DateTime($check);
			$check = date('j F Y H:i:s', strtotime($check));
		}
		$dataCt = $this->dashboard_model->getDataDetailCreditTicket($date, $date1);
		
		
		$this->dashboard_model->downloadDataDetailCreditTicket($date, $date1);
	}
	
	
        
       
        
        
        
        
	
	
}
