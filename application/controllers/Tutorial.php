<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Tutorial extends Admin {
	function __construct() {
		parent::__construct();
	}


    public function mappingS()
	{
		
                  
        $this->load->view('header');
        $this->load->view('tutorial/mapping_s');
        $this->load->view('footer');
                
    }
	
	
    

    
        
        
	
	
}
