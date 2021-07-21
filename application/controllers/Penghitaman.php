<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('api/Api.php');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Penghitaman extends Api {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}

    function callPenghitaman($pool){

        if($pool=='BekasiA'){
            $connDb = 'simtax_bekasi_a_jupiter';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='BekasiB'){
            $connDb = 'simtax_bekasi_b_jupiter';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='BekasiC'){
            $connDb = 'simtax_bekasi_c_jupiter';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='CipondohA'){
            $connDb = 'simtax_cipondoh_a_jupiter';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='CipondohB'){
            $connDb = 'simtax_cipondoh_b_jupiter';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='CipondohC'){
            $connDb = 'simtax_cipondoh_c_jupiter';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='Bintaro'){
            $connDb = 'simtax_bintaro';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='Cipendawa'){
            $connDb = 'simtax_cipendawa';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='Pekapuran'){
            $connDb = 'simtax_pekapuran';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='Jagakarsa'){
            $connDb = 'simtax_jagakarsa';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='JogloLama'){
            $connDb = 'simtax_joglo_jupiter';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='JogloBaru'){
            $connDb = 'simtax_joglo_baru_jupiter';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='Mustikasari'){
            $connDb = 'simtax_mustikasari_jupite';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='Ciganjur'){
            $connDb = 'simtax_ciganjur_jupiter';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }else if($pool=='Depok'){
            $connDb = 'localdepok';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }
    }
}
