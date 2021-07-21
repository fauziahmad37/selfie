<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Finance extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->model('moce_model');		
		$this->load->model('checker_model');	
		$this->load->model('finance_model');
	}

	
	function ksDriver(){
        
        $this->load->model('checker_model');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
				$idpool = $this->user['pool'];
                $noPintuProses = (isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
                $flagProses = 0;    
                $pesan = 0;
				$date = date('Y-m-d');
				$tglSpjProses = (isset($post['tglSpjProses']) ? $post['tglSpjProses'] : 0);
                
                 

                if(isset($post['cek'])){

                    $noPintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
					$idDbSimtax = $post['id_pool'];
                        
                    }
					
					 if ($idDbSimtax == '2')
                {
                    $connDb = 'simtax_jagakarsa';
                } else if ($idDbSimtax == '3')
                {
                    $connDb = 'simtax_bintaro';
                }else if ($idDbSimtax == '4')
                {
                    $connDb = 'simtax_ciganjur';
                } else if ($idDbSimtax == '5')
                {
                    $connDb = 'simtax_cipondoh_a';
                } else if ($idDbSimtax == '6')
                {
                    $connDb = 'simtax_cipondoh_b';
                } else if ($idDbSimtax == '7')
                {
                    $connDb = 'simtax_cipondoh_c';
                } else if ($idDbSimtax == '9')
                {
                    $connDb = 'simtax_bekasi_a';
                } else if ($idDbSimtax == '10')
                {
                    $connDb = 'simtax_bekasi_b';
                } else if ($idDbSimtax == '11')
                {
                    $connDb = 'simtax_star';
                } else if ($idDbSimtax == '12')
                {
                    $connDb = 'simtax_joglo';
                } else if ($idDbSimtax == '19')
                {
                    $connDb = 'simtax_bekasi_c';
                } else if ($idDbSimtax == '20')
                {
                    $connDb = 'simtax_bekasi_d';
                } else if ($idDbSimtax == '32')
                {
                    $connDb = 'simtax_tangsel';
                } else if ($idDbSimtax == '33')
                {
                    $connDb = 'simtax_depok';
                } else if ($idDbSimtax == '34')
                {
                    $connDb = 'simtax_joglo_baru';
                } else if ($idDbSimtax == '35')
                {
                    $connDb = 'simtax_cipayung';
                } else if ($idDbSimtax == '36')
                {
                    $connDb = 'simtax_pekapuran';
                } else if ($idDbSimtax == '37')
                {
                    $connDb = 'simtax_pondok_bambu';
                } else if ($idDbSimtax == '38')
                {
                    $connDb = 'simtax_cipendawa';
                } else if ($idDbSimtax == '50')
                {
                    $connDb = 'simtax_mustikasari';
                } else if ($idDbSimtax == '61')
                {
                    $connDb = 'simtax_semarang';
                } else if ($idDbSimtax == '62')
                {
                    $connDb = 'simtax_padang';
                } 
                    
							
							$data = $this->finance_model->getDataKs($connDb, $noPintuProses);
                            $this->load->view('header');
                            $this->load->view('finance/ksDriver', Array('data'=>$data,'pesan' => $pesan, 'date' => $date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'tglSpjProses'=>$tglSpjProses, 'tglspj'=>$tglspj));
                            $this->load->view('footer');
                
    }
	
	function ksDriverDetail(){
        
        $this->load->model('checker_model');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
				$idpool = $this->user['pool'];
                $noPintuProses = (isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
                $flagProses = 0;    
                $pesan = 0;
				$date = date('Y-m-d');
				$tglSpjProses = (isset($post['tglSpjProses']) ? $post['tglSpjProses'] : 0);
                
                 

                if(isset($post['cek'])){

                    $noPintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
					$idDbSimtax = $post['id_pool'];
                        
                    }
					
					 if ($idDbSimtax == '2')
                {
                    $connDb = 'simtax_jagakarsa';
                } else if ($idDbSimtax == '3')
                {
                    $connDb = 'simtax_bintaro';
                }else if ($idDbSimtax == '4')
                {
                    $connDb = 'simtax_ciganjur';
                } else if ($idDbSimtax == '5')
                {
                    $connDb = 'simtax_cipondoh_a';
                } else if ($idDbSimtax == '6')
                {
                    $connDb = 'simtax_cipondoh_b';
                } else if ($idDbSimtax == '7')
                {
                    $connDb = 'simtax_cipondoh_c';
                } else if ($idDbSimtax == '9')
                {
                    $connDb = 'simtax_bekasi_a';
                } else if ($idDbSimtax == '10')
                {
                    $connDb = 'simtax_bekasi_b';
                } else if ($idDbSimtax == '11')
                {
                    $connDb = 'simtax_star';
                } else if ($idDbSimtax == '12')
                {
                    $connDb = 'simtax_joglo';
                } else if ($idDbSimtax == '19')
                {
                    $connDb = 'simtax_bekasi_c';
                } else if ($idDbSimtax == '20')
                {
                    $connDb = 'simtax_bekasi_d';
                } else if ($idDbSimtax == '32')
                {
                    $connDb = 'simtax_tangsel';
                } else if ($idDbSimtax == '33')
                {
                    $connDb = 'simtax_depok';
                } else if ($idDbSimtax == '34')
                {
                    $connDb = 'simtax_joglo_baru';
                } else if ($idDbSimtax == '35')
                {
                    $connDb = 'simtax_cipayung';
                } else if ($idDbSimtax == '36')
                {
                    $connDb = 'simtax_pekapuran';
                } else if ($idDbSimtax == '37')
                {
                    $connDb = 'simtax_pondok_bambu';
                } else if ($idDbSimtax == '38')
                {
                    $connDb = 'simtax_cipendawa';
                } else if ($idDbSimtax == '50')
                {
                    $connDb = 'simtax_mustikasari';
                } else if ($idDbSimtax == '61')
                {
                    $connDb = 'simtax_semarang';
                } else if ($idDbSimtax == '62')
                {
                    $connDb = 'simtax_padang';
                } 
                    
							
							$data = $this->finance_model->getDataKsDetail($connDb, $noPintuProses);
                            $this->load->view('header');
                            $this->load->view('finance/ksDriverDetail', Array('data'=>$data,'pesan' => $pesan, 'date' => $date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'tglSpjProses'=>$tglSpjProses, 'tglspj'=>$tglspj));
                            $this->load->view('footer');
                
    }
	
	
}
