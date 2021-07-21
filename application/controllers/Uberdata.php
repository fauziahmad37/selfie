<?php

include_once('Admin.php');

class Uberdata extends Admin {
	public $data;
	function __construct() {
		parent::__construct();
		$this->load->model('uber_model');
		$this->load->library('form_validation');	
	}
	
	function index(){
		$success = null;
		if(isset($_GET['success'])) $success = $_GET['success'];
		
		$data = $this->uber_model->get_updated_data();
		
		$this->load->view('header');
		$this->load->view('uber_data', array('success' => $success, 'data' => $data));
		$this->load->view('footer');
	}
	
	function upload_sampledata()
	{
		if($_FILES['userfile']['size'] == 0) return redirect(site_url('/Uberdata?success=false'));
		$data = $this->uber_model->uber_upload_data($this->input->post());
		return redirect(site_url('/Uberdata?success='.$data));
	}
}