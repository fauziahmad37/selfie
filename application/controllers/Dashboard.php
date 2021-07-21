<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Dashboard extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}


    public function index()
	{
        
        $this->load->model('dashboard_model');
        $dataCt = $this->dashboard_model->getDataInputCT();
		$dataBukaSos = $this->dashboard_model->getDataBukaSos();
		$dataBukaBs = $this->dashboard_model->getDataBukaBs();
		$dataDuplicateSpj = $this->dashboard_model->getDataDuplicateSpj();
		$dataBatalOperasi = $this->dashboard_model->getDataBatalOperasi();
                  
        $this->load->view('header');
        $this->load->view('dashboard', Array('dataCt' => $dataCt, 'dataBukaSos'=> $dataBukaSos, 'dataBukaBs'=> $dataBukaBs, 'dataDuplicateSpj'=> $dataDuplicateSpj));
        $this->load->view('footer');
                
    }
	
	function listActivity($name = '')
	{
        
       if(!$this->cac_user_model->is_administrator()){
			return show_404();
		}
		
		$post = $this->input->post();
		if(isset($post['username']))
		{
			if(isset($post['update'])) {
				$this->cac_user_model->update($post);
			}
			else if(isset($post['reset_pass'])){
				$this->cac_user_model->reset_pass($post['username']);
			}
			else {
				$this->cac_user_model->save($post);
			}
		}
		
		$user = array();
		if($name !== '')
			$user = $this->cac_user_model->detail($name);
			
		$data = $this->dashboard_model->dataActivity();
		$this->load->model('dashboard_model');
		$dataPool = $this->dashboard_model->get_pools();
		$arrPool = array();
		$arrPool[0] = 'All';
		foreach((Array) $dataPool AS $key => $val){
			$arrPool[$val['id']] = $val['name'];
		}
		
		$this->load->view('header');
		$this->load->view('list_activity', Array('data' => $data, 'user' => $user, 'arrPool' => $arrPool));
		$this->load->view('footer');
                
    }
    

    
        
        
	
	
}
