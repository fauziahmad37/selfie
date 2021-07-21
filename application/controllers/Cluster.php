<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Admin.php');
class Cluster extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->model('xone_model');
		$this->load->model('xone_tiara_model');		
	}
	
	public function index()
	{
		$date = date('Y-m-d');
		$data = array();
		$search = 0;
		$temp = array();
		if(isset($_POST['search']) && $_POST['search'] === '1' && $_POST['date'] != '' && $_POST['date2'] != '' && $_POST['hour'] != '' && $_POST['hour2'] != ''){
			$data = $this->xone_model->get_lat_lng($_POST['day'], $_POST['date'], $_POST['date2'], $_POST['hour'], $_POST['hour2']);
			$data = array_merge($data, $this->xone_tiara_model->get_lat_lng($_POST['day'], $_POST['date'], $_POST['date2'], $_POST['hour'], $_POST['hour2']));
			$search = $_POST['cluster'];
			$temp = $_POST;
		}
		
		$cluster = $this->dashboard_model->get_clusters();
		
		$this->load->view('header');
		$this->load->view('cluster', Array('temp' => $temp, 'search' => $search, 'cluster' => $cluster, 'data' => $data, 'date' => $date));
		$this->load->view('footer');
	}
}
