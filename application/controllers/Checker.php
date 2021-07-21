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
	
	 function CekMobil($date = '', $date1 = '')
	{
		$username = $this->user['username'];
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d',strtotime("-3 days")))){
			$date = date('Y-m-d');
			$date1 = date('Y-m-d');
			$dataCt = $this->checker_model->getDataActivityChecker($date);
		}else{
			$dataCt = $this->checker_model->getDataActivityChecker1($date, $date1);
		}

		if(!$check){

			$check = date('j F Y H:i:s');
		} else {
			$datetime = new DateTime($check);
			$check = date('j F Y H:i:s', strtotime($check));
		}
					
		
		$this->load->view('header');
		$this->load->view('checker/V_cek_mobil', Array('data' => $data, 'date' => $date, 'dataCt' => $dataCt, 'username' => $username, 'date1' => $date1));
		$this->load->view('footer');
	}

	 function CheckerActivity($date = '', $date1 = '')
	{
		$username = $this->user['username'];
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d',strtotime("-3 days")))){
			$date = date('Y-m-d');
			$date1 = date('Y-m-d');
			$dataCt = $this->checker_model->getDataActivityChecker($date);
		}else{
			$dataCt = $this->checker_model->getDataActivityChecker1($date, $date1);
		}

		if(!$check){

			$check = date('j F Y H:i:s');
		} else {
			$datetime = new DateTime($check);
			$check = date('j F Y H:i:s', strtotime($check));
		}
					
		
		$this->load->view('header');
		$this->load->view('checker/activityChecker', Array('data' => $data, 'date' => $date, 'dataCt' => $dataCt, 'username' => $username, 'date1' => $date1));
		$this->load->view('footer');
	}
	
	function CheckerActivity2($date = '', $date1 = '')
	{
		$username = $this->user['username'];
		if($date === '' || strtotime($date) > strtotime(date('Y-m-d',strtotime("-3 days")))){
			$date = date('Y-m-d');
			$date1 = date('Y-m-d');
			$dataCt = $this->checker_model->getDataPenghitaman();
		}else{
			$dataCt = $this->checker_model->getDataPenghitaman();
		}

		if(!$check){

			$check = date('j F Y H:i:s');
		} else {
			$datetime = new DateTime($check);
			$check = date('j F Y H:i:s', strtotime($check));
		}
					
		
		$this->load->view('header');
		$this->load->view('checker/activityChecker2', Array('data' => $data, 'date' => $date, 'dataCt' => $dataCt, 'username' => $username, 'date1' => $date1));
		$this->load->view('footer');
	}
	
	function inputKondisi(){
        
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
                                     $pesan = 'Silahkan menginput Data Kondisi Mobil';

                            } else {
                                $pesan = 'No Mesin  yang anda masukan salah';
                        }
                    }
					
                    if(isset($post['proses']))
                        {
                            $pool_id 				= $idpool;	
							$val_ritase 			= $post['val_ritase'];
							$val_drop 				= $post['val_drop'];
							$val_km_argo 			= $post['val_km_argo'];
							$val_km_speedo  		= $post['val_km_speedo'];
							$val_fix_part   		= $post['val_fix_part'];

							$lampu_mahkota			= $post['lampu_mahkota'];
							$stiker_no_pintu		= $post['stiker_no_pintu'];
							$logo_express			= $post['logo_express'];
							$no_call_center			= $post['no_call_center'];
							$lampu_depan			= $post['lampu_depan'];
							$lampu_belakang			= $post['lampu_belakang'];
							$lampu_rem				= $post['lampu_rem'];
							$lampu_sign				= $post['lampu_sign'];
							$stiker_minimum_payment = $post['stiker_minimum_payment'];
							$lampu_led				= $post['lampu_led'];
							$argometer				= $post['argometer'];
							$aksesoris_tidak_standar= $post['aksesoris_tidak_standar'];
							$kebersihan				= $post['kebersihan'];
							$karpet_kaki			= $post['karpet_kaki'];
							$rds					= $post['rds'];										
							$struk_argo				= $post['struk_argo'];
							$ban_cadangan			= $post['ban_cadangan'];
							$jok					= $post['jok'];
							$seat_belt				= $post['seat_belt'];
							$ac 					= $post['ac'];
							$aroma_kabin			= $post['aroma_kabin'];

                            $query = $this->checker_model->insertDataMoce(
                            	$tglSpjProses,
                            	$noPintuProses,
                            	$pool_id,
                            	$val_ritase,
                            	$val_drop,
                            	$val_km_argo,
                            	$val_km_speedo,
                            	$val_fix_part,
                            	$username,

                            	$lampu_mahkota,
                            	$stiker_no_pintu,
                            	$logo_express,
                            	$no_call_center,
                            	$lampu_depan,
                            	$lampu_belakang,
                            	$lampu_rem,
                            	$lampu_sign,
                            	$stiker_minimum_payment,
                            	$lampu_led,
                            	$argometer,
                            	$aksesoris_tidak_standar,
                            	$kebersihan,
                            	$karpet_kaki,
                            	$rds,
                            	$struk_argo,
                            	$ban_cadangan,
                            	$jok,
                            	$seat_belt,
                            	$ac,
                            	$aroma_kabin);                                
                            $pesan = 'Data telah berhasil diinput';    
                        }
                            $this->load->view('header');
                            $this->load->view('checker/V_cek_mobil', Array('pesan' => $pesan, 'date' => $date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'tglSpjProses'=>$tglSpjProses, 'tglspj'=>$tglspj));
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
                            $pool_id 				= $idpool;	
							$val_ritase 			= $post['val_ritase'];
							$val_drop 				= $post['val_drop'];
							$val_km_argo 			= $post['val_km_argo'];
							$val_km_speedo  		= $post['val_km_speedo'];
							$val_fix_part   		= $post['val_fix_part'];

							$stnk                   = $post['stnk'];
                            $keur                   = $post['keur'];
                            $kp                     = $post['kp'];
                            $tera                   = $post['tera'];
                            $lampu_mahkota			= $post['lampu_mahkota'];
							$stiker_no_pintu		= $post['stiker_no_pintu'];
							$logo_express			= $post['logo_express'];
							$no_call_center			= $post['no_call_center'];
							$lampu_depan			= $post['lampu_depan'];
							$lampu_belakang			= $post['lampu_belakang'];
							$lampu_rem				= $post['lampu_rem'];
							$lampu_sign				= $post['lampu_sign'];
							$stiker_minimum_payment = $post['stiker_minimum_payment'];
							$lampu_led				= $post['lampu_led'];
							$argometer				= $post['argometer'];
							$aksesoris_tidak_standar= $post['aksesoris_tidak_standar'];
							$kebersihan				= $post['kebersihan'];
							$karpet_kaki			= $post['karpet_kaki'];
							$rds					= $post['rds'];										
							$struk_argo				= $post['struk_argo'];
							$ban_cadangan			= $post['ban_cadangan'];
							$jok					= $post['jok'];
							$seat_belt				= $post['seat_belt'];
							$ac 					= $post['ac'];
							$aroma_kabin			= $post['aroma_kabin'];

                            $query = $this->checker_model->insertDataMoce(
                            	$tglSpjProses,
                            	$noPintuProses,
                            	$pool_id,
                            	$val_ritase,
                            	$val_drop,
                            	$val_km_argo,
                            	$val_km_speedo,
                            	$val_fix_part,
                            	$username,

                            	$stnk,
                                $keur,
                                $kp,
                                $tera,
                                $lampu_mahkota,
                            	$stiker_no_pintu,
                            	$logo_express,
                            	$no_call_center,
                            	$lampu_depan,
                            	$lampu_belakang,
                            	$lampu_rem,
                            	$lampu_sign,
                            	$stiker_minimum_payment,
                            	$lampu_led,
                            	$argometer,
                            	$aksesoris_tidak_standar,
                            	$kebersihan,
                            	$karpet_kaki,
                            	$rds,
                            	$struk_argo,
                            	$ban_cadangan,
                            	$jok,
                            	$seat_belt,
                            	$ac,
                            	$aroma_kabin);                                
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
	
	function download($date,$date1 ){
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Detail Rit Drop.csv";
        $query = "select ID as ID, 
		tgl_spj as Tanggal_SPJ, no_pintu as No_Pintu, 
		val_rit as Nilai_Ritase, val_drop as Nilai_drop, 
		val_km_argo as KM_Argo, val_km_speedo as KM_Speedo, 
		val_fix_part as Bagian_Yang_Perlu_Diperbaiki, 
		user_insert as ID_Checker, dt_insert as Tanggal_input,
		lampu_mahkota,stiker_no_pintu,logo_express,no_call_center,lampu_depan,lampu_belakang,
		lampu_rem,lampu_sign,stiker_minimum_payment,lampu_led,argometer,aksesoris_tidak_standar,
		kebersihan,karpet_kaki,rds,struk_argo,ban_cadangan,jok,ac,aroma_kabin,seat_belt,stnk,keur,kp,tera
		from dashboard.public.moce_regular where tgl_spj >= '".$date."' and tgl_spj <= '".$date1."'"; //USE HERE YOUR QUERY
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);

    }  
	
	function download2($no_pintu,$idDbSimtax ){
		$no_pintu = str_replace("%20"," ",$no_pintu);
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
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Detail SPJ dan Setoran.csv";
        $query = "select SPJ_CODE, SPJ_DATE, NO_PINTU, KIP_SETOR, NAMA_SETOR from trx_operasi_armada
where SPJ_DATE >= '2010-1-1' and spj_date <='2019-1-1' and NO_PINTU ='".$no_pintu."'"; //USE HERE YOUR QUERY
		$DB1 = $this->load->database($connDb,TRUE);
        $result = $DB1->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);

    }
}
