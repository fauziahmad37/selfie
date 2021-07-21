<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('api/Api.php');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Consolidate extends Api {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}
	
	
	function bintaro()
		{ 
			$pool =  'simtax_bintaro';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
	
	function ciganjur()
		{ 
			$pool =  'simtax_ciganjur';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function jagakarsa()
		{ 
			$pool =  'simtax_jagakarsa';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function jogloBaru()
		{ 
			$pool =  'simtax_joglo_baru';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function star()
		{ 
			$pool =  'simtax_star';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function joglo()
		{ 
			$pool =  'simtax_joglo';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function cipondohB()
		{ 
			$pool =  'simtax_cipondoh_b';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function cipondohC()
		{ 
			$pool =  'simtax_cipondoh_c';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function tangsel()
		{ 
			$pool =  'simtax_tangsel';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function bekasiB()
		{ 
			$pool =  'simtax_bekasi_b';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
	
		function bekasiC()
		{ 
			$pool =  'simtax_bekasi_c';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function cipendawa()
		{ 
			$pool =  'simtax_cipendawa';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function pondokBambu()
		{ 
			$pool =  'simtax_pondok_bambu';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function cipayung()
		{ 
			$pool =  'simtax_cipayung';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function depok()
		{ 
			$pool =  'simtax_depok';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function mustikasari()
		{ 
			$pool =  'simtax_mustikasari';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		function pekapuran()
		{ 
			$pool =  'simtax_pekapuran';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
		
		
		
		function padang()
		{ 
			$pool =  'simtax_padang';
			$this->load->model('consolidate_model');
			$dataIdRec = $this->consolidate_model->getIdRecConsolidate($pool);
			foreach($dataIdRec as $row)
			{
			$query = $this->consolidate_model->getQueryConsolidate($pool, $row['IDREC']);
			$this->consolidate_model->execQueryConsolidate($query);
			$this->consolidate_model->updateQueryConsolidate($pool, $row['IDREC']);
			}
			return $this->_print('SUCCESS!');
		}
        
        
	
	
}
