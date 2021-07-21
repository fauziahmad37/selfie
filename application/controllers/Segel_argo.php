<?php
include_once('Admin.php');
class Segel_argo extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('taxi_ads_model');
	}
	
	function index(){
		$this->load->view('header');
		$this->load->view('tiara/segel_argo', Array('data' => $data, 'data2' => $data2));
		$this->load->view('footer');
	}
}
?>