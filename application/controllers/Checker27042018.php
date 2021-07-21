<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Checker extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->model('moce_model');		
		$this->load->model('checker_model');		
	}
	
	 function CheckerActivity($date = '')
	{
		$username = $this->user['username'];
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d',strtotime("-3 days"))))
			$date = date('Y-m-d',strtotime("-3 days"));
		

		if(!$check){

			$check = date('j F Y H:i:s');
		} else {
			$datetime = new DateTime($check);
			$check = date('j F Y H:i:s', strtotime($check));
		}
		$dataCt = $this->checker_model->getDataActivityChecker($date);
		
		
				
		
				
		
		$this->load->view('header');
		$this->load->view('checker/activityChecker', Array('data' => $data, 'date' => $date, 'dataCt' => $dataCt, 'username' => $username));
		$this->load->view('footer');
	}
	
	
	function inputRitDrop(){
        
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

                if(isset($post['cek'])){

                    $noPintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
                    //$dataPintu = $this->operasi_model->getNoPintuBs($connDb,$noPintu);
                    $dataPintu = 1;
					$tglSpj = $post['tglspj'];
					$tglSpjProses = $tglSpj;
					$date = $post['tglspj'];

                        if ($dataPintu > 0 ) {
                               

                               
                                        $flagProses = 1;
                                     $pesan = 'Silahkan menginput Data RIT dan DROP';

                            } else {
                                $pesan = 'No Pintu yang anda masukan salah';
                        }
                    }
					
                    if(isset($post['proses']))
                        {
                           $pool_id =$idpool;	
							$val_ritase = $post['val_ritase'];
							$val_drop = $post['val_drop'];
							$val_km_argo = $post['val_km_argo'];
							$val_km_speedo = $post['val_km_speedo'];
							$val_fix_part = $post['val_fix_part'];
                            $query = $this->checker_model->insertDataMoce($tglSpjProses,$noPintuProses,$pool_id,$val_ritase,$val_drop,$val_km_argo,$val_km_speedo,$val_fix_part,$username);                                
                            $pesan = 'Data telah berhasil diinput';    
                        }
                            $this->load->view('header');
                            $this->load->view('checker/inputRitDrop', Array('pesan' => $pesan, 'date' => $date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'tglSpjProses'=>$tglSpjProses, 'tglspj'=>$tglspj));
                            $this->load->view('footer');
                
    }
	
	public function index($date = '')
	{
		$start = '';
		$start = isset($_GET['start']) ? $_GET['start'] : $start;
		$date = isset($_GET['end']) ? $_GET['end'] : $date;		

		if($date === '' || strtotime($date) >= strtotime(date('Y-m-d')))
			$date = date('Y-m-d',strtotime("-1 days"));
		if($start === '')
			$start = date('Y-m-d',strtotime("-1 days"));
	
		if(strtotime($start) > strtotime($date)){
			$temp = $start;
			$start = $date;
			$date = $start;
		}	
		
		$arrData = $this->dashboard_model->get_operation_reguler($start, $date);
		$arrDataMoce = $this->moce_model->get_summary_moce($start, $date);
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
		
		$this->load->view('header');
		$this->load->view('checker', Array('data' => $data, 'date' => $date, 'start' => $start));
		$this->load->view('footer');	
	}
	
	public function detail($id){
		$start = isset($_GET['start']) ? $_GET['start'] : date('Y-m-1');
		$date = date('Y-m-t', strtotime($start));
		
		$id_moce = $this->get_id_moce($id);
		
		if($id_moce < 0)
			return redirect('/Checker');
			
		$arrData = $this->dashboard_model->get_operation_reguler_detail($id, $start, $date);
		$arrDataMoce = $this->moce_model->get_summary_moce_detail($id_moce, $start, $date);
		$name = $this->dashboard_model->get_pool_name($id);
		$data = array();
		foreach((Array) $arrData AS $key => $val){ 
			if(!isset($data[$val['no_pintu']])){
				$data[$val['no_pintu']] = array();
			}
			$data[$val['no_pintu']][$val['tgl_spj']]['nomor_spj'] = $val['spj_code'];
			$data[$val['no_pintu']][$val['tgl_spj']]['tipe'] = ($val['tipe_ops'] === '0' ? 'Reguler' : 'Kalong');						
		}
		foreach((Array) $arrDataMoce AS $key => $val){
			foreach((Array) $data AS $key2 => $val2){
				$isFound = false;
				foreach((Array) $val2 AS $key3 => $val3){
					if($val3['nomor_spj'] === $val['nomor_spj']){
						$data[$key2][$key3]['rit'] = $val['rit'];
						$data[$key2][$key3]['drop'] = $val['drop'];
						$data[$key2][$key3]['checker'] = $val['name'];												
						$isFound = true;
						break;
					} 
				}
				if($isFound)
					break;
			}
		}
		$this->load->view('header');
		$this->load->view('checker_detail', Array('data' => $data, 'date' => $start, 'name' => $name, 'id' => $id));
		$this->load->view('footer');	
	}
	
	private function get_ct_moce($id, $arr){
		foreach((Array) $arr AS $key => $val){
			if($this->arrPoolMoceReguler[$val['id']] == $id){
				return $val['ct'];
			}
		}
		return 0;
	}
	
	private function get_id_moce($id){
		foreach((Array) $this->arrPoolMoceReguler AS $key => $val){
			if($val == $id) return $key;
		}
		return -1;
	}
}
