<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	ini_set('max_execution_time', 600); 
	ini_set('memory_limit','2048M');

	include_once('Admin.php');
	class C_setoran extends admin{


        function dataTPWulingEtaxi(){
                $idDbSimtax = $this->user['id_pool_simtax'];
                $idpool = $this->user['pool'];
                $this->load->model('M_setoran');
                $this->load->model('Etaxi_model');
                


                $dataPekapuran     = $this->Etaxi_model->wulingEtaxiPekapuran($connDb);
                $dataPondokBambu   = $this->Etaxi_model->wulingEtaxiPondokBambu($connDb);


                $this->load->view('header');
                $this->load->view('DataXOne/V_WulingEtaxi', Array('dataPekapuran'=>$dataPekapuran,'dataPondokBambu'=>$dataPondokBambu,'data_jagakarsa'=>$data_jagakarsa,'data_cipayung'=>$data_cipayung,'namaPool'=>$namaPool,'pesan' => $pesan, 'date' => $date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'tglSpjProses'=>$tglSpjProses, 'tglspj'=>$tglspj));
                $this->load->view('footer');
        }

        function dataKSWuling(){
                $idDbSimtax = $this->user['id_pool_simtax'];
                $idpool = $this->user['pool'];
                $this->load->model('M_setoran');
                


                $data           = $this->M_setoran->getDataKSWulingBintaro($connDb);
                $data_cipayung  = $this->M_setoran->getDataKSWulingCipayung($connDb);
                $data_jagakarsa = $this->M_setoran->getDataKSWulingJagakarsa($connDb);
                $data_cipendawa = $this->M_setoran->getDataKSWulingCipendawa($connDb);

                $this->load->view('header');
                $this->load->view('DataXOne/V_KS_Wuling', Array('data'=>$data,'data_cipendawa'=>$data_cipendawa,'data_jagakarsa'=>$data_jagakarsa,'data_cipayung'=>$data_cipayung,'namaPool'=>$namaPool,'pesan' => $pesan, 'date' => $date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'tglSpjProses'=>$tglSpjProses, 'tglspj'=>$tglspj));
                $this->load->view('footer');
        }



        function dataWuling(){
                $idDbSimtax = $this->user['id_pool_simtax'];
                $idpool = $this->user['pool'];
                $this->load->model('M_setoran');
                


                $data = $this->M_setoran->getDataWulingBintaro($connDb);
                $data_cipayung = $this->M_setoran->getDataWulingCipayung($connDb);
                $data_jagakarsa = $this->M_setoran->getDataWulingJagakarsa($connDb);
                $data_cipendawa = $this->M_setoran->getDataWulingCipendawa($connDb);
                $this->load->view('header');
                $this->load->view('DataXOne/V_wuling', Array('data'=>$data,'data_cipendawa'=>$data_cipendawa,'data_jagakarsa'=>$data_jagakarsa,'data_cipayung'=>$data_cipayung,'namaPool'=>$namaPool,'pesan' => $pesan, 'date' => $date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'tglSpjProses'=>$tglSpjProses, 'tglspj'=>$tglspj));
                $this->load->view('footer');
        }

        function dataXOne(){

                 $this->load->model('M_setoran');

                //$post = $this->input->post('id_pool');
				$post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $idpool = $this->user['pool'];
                $noPintuProses = (isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
                $flagProses = 0;    
                $pesan = 0;
                $date = date('Y-m-d');
                $tglSpjProses = (isset($post['tglSpjProses']) ? $post['tglSpjProses'] : 0);
				$namaPool = (isset($post['id_pool']) ? $post['id_pool'] : 0);

                if(isset($post['cek'])){
					$namaPool = $post['id_pool'];
                    $noPintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
                    $idDbSimtax = $post['id_pool'];

                    $tgl_awal = $post['tgl_awal'];
                    $tgl_akhir = $post['tgl_akhir'];
					
					$idpool = $post['id_pool'];
                        
                    }
                    
                if($idpool=='23'){
                    $connDb ='10';
                }else if($idpool == '10'){
                    $connDb ='11';
                }else if($idpool == '22'){
                    $connDb ='13';
                }else if($idpool == '17'){
                    $connDb ='14';
                }else if($idpool == '16'){
                    $connDb ='17';
                }else if($idpool == '19'){
                    $connDb ='18';
                }else if($idpool == '7'){
                    $connDb ='19';
                }else if($idpool == '5'){
                    $connDb ='20';
                }else if($idpool == '2'){
                    $connDb ='21';
                }else if($idpool == '18'){
                    $connDb ='22';
                }else if($idpool == '15'){
                    $connDb ='23';
                }else if($idpool == '20'){
                    $connDb ='24';
                }else if($idpool == '3'){
                    $connDb ='25';
                } else if($idpool == '6'){
                    $connDb ='26';
                } else if($idpool == '8'){
                    $connDb ='29';
                }else if($idpool == '24'){
                    $connDb ='30';
                }


                

                $data = $this->M_setoran->getDataXOne($connDb);
                $this->load->view('header');
                $this->load->view('DataXOne/V_dataXone', Array('data'=>$data,'namaPool'=>$namaPool,'pesan' => $pesan, 'date' => $date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'tglSpjProses'=>$tglSpjProses, 'tglspj'=>$tglspj));
                $this->load->view('footer');
                
        }

        function dataEagle(){

                 $this->load->model('M_setoran');

                //$post = $this->input->post('id_pool');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $idpool = $this->user['pool'];
                $noPintuProses = (isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
                $flagProses = 0;    
                $pesan = 0;
                $date = date('Y-m-d');
                $tglSpjProses = (isset($post['tglSpjProses']) ? $post['tglSpjProses'] : 0);
                $namaPool = (isset($post['id_pool']) ? $post['id_pool'] : 0);

                if(isset($post['cek'])){
                    $namaPool = $post['id_pool'];
                    $noPintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
                    $idDbSimtax = $post['id_pool'];

                    $tgl_awal = $post['tgl_awal'];
                    $tgl_akhir = $post['tgl_akhir'];
                    
                    $idpool = $post['id_pool'];
                        
                    }

                    
                if($idpool == '31'){
                    $connDb ='8';
                }else if($idpool == '30'){
                    $connDb ='7';
                }else if($idpool == '29'){
                    $connDb ='6';
                }else if($idpool == '28'){
                    $connDb ='5';
                }else if($idpool == '26'){
                    $connDb ='3';
                }else if($idpool == '25'){
                    $connDb ='2';
                }else if($idpool=='23'){
                    $connDb ='10';
                }else if($idpool == '10'){
                    $connDb ='11';
                }else if($idpool == '22'){
                    $connDb ='13';
                }else if($idpool == '17'){
                    $connDb ='14';
                }else if($idpool == '16'){
                    $connDb ='17';
                }else if($idpool == '19'){
                    $connDb ='18';
                }else if($idpool == '7'){
                    $connDb ='19';
                }else if($idpool == '5'){
                    $connDb ='20';
                }else if($idpool == '2'){
                    $connDb ='21';
                }else if($idpool == '18'){
                    $connDb ='22';
                }else if($idpool == '15'){
                    $connDb ='23';
                }else if($idpool == '20'){
                    $connDb ='24';
                }else if($idpool == '3'){
                    $connDb ='25';
                } else if($idpool == '6'){
                    $connDb ='26';
                } else if($idpool == '8'){
                    $connDb ='29';
                }else if($idpool == '24'){
                    $connDb ='30';
                }


                $data = $this->M_setoran->getDataEagle($connDb);
                $this->load->view('header');
                $this->load->view('DataXOne/V_dataXoneEagle', Array('data'=>$data,'namaPool'=>$namaPool,'pesan' => $pesan, 'date' => $date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'tglSpjProses'=>$tglSpjProses, 'tglspj'=>$tglspj));
                $this->load->view('footer');
                
        }

		function index(){
        
        $this->load->model('M_setoran');

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

					$tgl_awal = $post['tgl_awal'];
					$tgl_akhir = $post['tgl_akhir'];
                        
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
                    
							
				$data = $this->M_setoran->getDataDetailSetoran($connDb, $tgl_awal,$tgl_akhir);
                $this->load->view('header');
                $this->load->view('ITMS/V_setoran', Array('data'=>$data,'pesan' => $pesan, 'date' => $date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'tglSpjProses'=>$tglSpjProses, 'tglspj'=>$tglspj));
                $this->load->view('footer');
                
         }  

    function download(){

            if(isset($post['cek'])){

                    $no_pintu = $post['no_pintu'];
                    
                        
                    }

            $this->load->dbutil();
            $this->load->helper('file');
            $this->load->helper('download');
            $delimiter = ",";
            $newline = "\r\n";
            $filename = "Detail setoran.csv";
            $query = "SELECT * FROM TRX_SETORAN WHERE no_pintu='$no_pintu'"; //USE HERE YOUR QUERY
            $result = $this->db->query($query);
            $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
            force_download($filename, $data);

        }  

    function data_penghitaman(){
         $this->load->model('M_setoran');

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
                    $no_pintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
                    $idDbSimtax = $post['id_pool'];
					//print_r($idDbSimtax);die;
                }


                    
                if ($idDbSimtax == '2')
                {
                    $connDb = 'simtax_jagakarsa';
                } else if ($idDbSimtax == '3')
                {
                    $connDb = 'simtax_bintaro';
                }else if ($idDbSimtax == '4')
                {
                    $connDb = 'simtax_ciganjur_jupiter';
                } else if ($idDbSimtax == '5')
                {
                    $connDb = 'simtax_cipondoh_a_jupiter';
                } else if ($idDbSimtax == '6')
                {
                    $connDb = 'simtax_cipondoh_b_jupiter';
                } else if ($idDbSimtax == '7')
                {
                    $connDb = 'simtax_cipondoh_c_jupiter';
                } else if ($idDbSimtax == '9')
                {
                    $connDb = 'simtax_bekasi_a_jupiter';
                } else if ($idDbSimtax == '10')
                {
                    $connDb = 'simtax_bekasi_b_jupiter';
                } else if ($idDbSimtax == '11')
                {
                    $connDb = 'simtax_star_jupiter';
                } else if ($idDbSimtax == '12')
                {
                    $connDb = 'simtax_joglo_jupiter';
                } else if ($idDbSimtax == '19')
                {
                    $connDb = 'simtax_bekasi_c_jupiter';
                } else if ($idDbSimtax == '20')
                {
                    $connDb = 'simtax_bekasi_d_jupiter';
                } else if ($idDbSimtax == '32')
                {
                    $connDb = 'simtax_tangsel_jupiter';
                } else if ($idDbSimtax == '33')
                {
                    $connDb = 'simtax_depok_jupiter';
                } else if ($idDbSimtax == '34')
                {
                    $connDb = 'simtax_joglo_baru_jupiter';
                } else if ($idDbSimtax == '35')
                {
                    $connDb = 'simtax_cipayung';
                } else if ($idDbSimtax == '36')
                {
                    $connDb = 'simtax_pekapuran';
                } else if ($idDbSimtax == '37')
                {
                    $connDb = 'simtax_pondok_bambu_jupiter';
                } else if ($idDbSimtax == '38')
                {
                    $connDb = 'simtax_cipendawa';
                } else if ($idDbSimtax == '50')
                {
                    $connDb = 'simtax_mustikasari_jupiter';
                } else if ($idDbSimtax == '61')
                {
                    $connDb = 'simtax_semarang';
                } else if ($idDbSimtax == '62')
                {
                    $connDb = 'simtax_padang';
                } 
                else if ($idDbSimtax == '63')
                {
                    $connDb = 'localdepok';
                } 
                
		//print_r($idDbSimtax);die;

                $data = $this->M_setoran->getDataDetailPenghitaman($connDb, $no_pintu);
			//	print_r($data);die;
                $this->load->view('header');
                $this->load->view('akunting/V_data_penghitaman', Array('data'=>$data,'pesan' => $pesan));
                $this->load->view('footer');
                
        }

        function data_operasi(){
         $this->load->model('M_setoran');

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
                    $no_pintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
                    $idDbSimtax = $post['id_pool'];        
                }


                    
                if ($idDbSimtax == '2')
                {
                    $connDb = 'simtax_jagakarsa_jupiter';
                } else if ($idDbSimtax == '3')
                {
                    $connDb = 'simtax_bintaro';
                }else if ($idDbSimtax == '4')
                {
                    $connDb = 'simtax_ciganjur_jupiter';
                } else if ($idDbSimtax == '5')
                {
                    $connDb = 'simtax_cipondoh_a_jupiter';
                } else if ($idDbSimtax == '6')
                {
                    $connDb = 'simtax_cipondoh_b_jupiter';
                } else if ($idDbSimtax == '7')
                {
                    $connDb = 'simtax_cipondoh_c_jupiter';
                } else if ($idDbSimtax == '9')
                {
                    $connDb = 'simtax_bekasi_a_jupiter';
                } else if ($idDbSimtax == '10')
                {
                    $connDb = 'simtax_bekasi_b_jupiter';
                } else if ($idDbSimtax == '11')
                {
                    $connDb = 'simtax_star_jupiter';
                } else if ($idDbSimtax == '12')
                {
                    $connDb = 'simtax_joglo_jupiter';
                } else if ($idDbSimtax == '19')
                {
                    $connDb = 'simtax_bekasi_c_jupiter';
                } else if ($idDbSimtax == '20')
                {
                    $connDb = 'simtax_bekasi_d_jupiter';
                } else if ($idDbSimtax == '32')
                {
                    $connDb = 'simtax_tangsel_jupiter';
                } else if ($idDbSimtax == '33')
                {
                    $connDb = 'simtax_depok_jupiter';
                } else if ($idDbSimtax == '34')
                {
                    $connDb = 'simtax_joglo_baru_jupiter';
                } else if ($idDbSimtax == '35')
                {
                    $connDb = 'simtax_cipayung';
                } else if ($idDbSimtax == '36')
                {
                    $connDb = 'simtax_pekapuran_jupiter';
                } else if ($idDbSimtax == '37')
                {
                    $connDb = 'simtax_pondok_bambu_jupiter';
                } else if ($idDbSimtax == '38')
                {
                    $connDb = 'simtax_cipendawa';
                } else if ($idDbSimtax == '50')
                {
                    $connDb = 'simtax_mustikasari_jupiter';
                } else if ($idDbSimtax == '61')
                {
                    $connDb = 'simtax_semarang';
                } else if ($idDbSimtax == '62')
                {
                    $connDb = 'simtax_padang';
                } 
                

                $data = $this->M_setoran->getDataDetailOperasi($connDb, $no_pintu);
                $this->load->view('header');
                $this->load->view('akunting/V_info_operasi', Array('data'=>$data,'pesan' => $pesan));
                $this->load->view('footer');
                
        }

        function data_detail_prnghitaman($date = '', $date1 = '')
        {
            $username = $this->user['username'];
            if($date === '' || strtotime($date) > strtotime(date('Y-m-d',strtotime("-3 days")))){
                $dataCt = $this->M_setoran->getDatasetoran($date, $date1);
            }else{
                $dataCt = $this->M_setoran->getDatasetoran($date, $date1);
            }

            if(!$check){

                $check = date('j F Y H:i:s');
            } else {
                $datetime = new DateTime($check);
                $check = date('j F Y H:i:s', strtotime($check));
            }
                        
            
            $this->load->view('header');
            $this->load->view('checker/activityChecker', Array('data' => $data));
            $this->load->view('footer');
        }

        
        function data_hutang_armada(){
         $this->load->model('M_setoran');

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
                    $no_kip = $post['no_kip'];
                    $noPintuProses = $noPintu;
                    $idDbSimtax = $post['id_pool'];        
                }


                    
                if ($idDbSimtax == '2')
                {
                    $connDb = 'simtax_jagakarsa_jupiter';
                } else if ($idDbSimtax == '3')
                {
                    $connDb = 'simtax_bintaro';
                }else if ($idDbSimtax == '4')
                {
                    $connDb = 'simtax_ciganjur_jupiter';
                } else if ($idDbSimtax == '5')
                {
                    $connDb = 'simtax_cipondoh_a_jupiter';
                } else if ($idDbSimtax == '6')
                {
                    $connDb = 'simtax_cipondoh_b_jupiter';
                } else if ($idDbSimtax == '7')
                {
                    $connDb = 'simtax_cipondoh_c_jupiter';
                } else if ($idDbSimtax == '9')
                {
                    $connDb = 'simtax_bekasi_a_jupiter';
                } else if ($idDbSimtax == '10')
                {
                    $connDb = 'simtax_bekasi_b_jupiter';
                } else if ($idDbSimtax == '11')
                {
                    $connDb = 'simtax_star_jupiter';
                } else if ($idDbSimtax == '12')
                {
                    $connDb = 'simtax_joglo_jupiter';
                } else if ($idDbSimtax == '19')
                {
                    $connDb = 'simtax_bekasi_c_jupiter';
                } else if ($idDbSimtax == '20')
                {
                    $connDb = 'simtax_bekasi_d_jupiter';
                } else if ($idDbSimtax == '32')
                {
                    $connDb = 'simtax_tangsel_jupiter';
                } else if ($idDbSimtax == '33')
                {
                    $connDb = 'simtax_depok_jupiter';
                } else if ($idDbSimtax == '34')
                {
                    $connDb = 'simtax_joglo_baru_jupiter';
                } else if ($idDbSimtax == '35')
                {
                    $connDb = 'simtax_cipayung';
                } else if ($idDbSimtax == '36')
                {
                    $connDb = 'simtax_pekapuran_jupiter';
                } else if ($idDbSimtax == '37')
                {
                    $connDb = 'simtax_pondok_bambu_jupiter';
                } else if ($idDbSimtax == '38')
                {
                    $connDb = 'simtax_cipendawa';
                } else if ($idDbSimtax == '50')
                {
                    $connDb = 'simtax_mustikasari_jupiter';
                } else if ($idDbSimtax == '61')
                {
                    $connDb = 'simtax_semarang';
                } else if ($idDbSimtax == '62')
                {
                    $connDb = 'simtax_padang';
                } 
                

                $data = $this->M_setoran->getDataHutangArmada($connDb, $no_kip);
                $this->load->view('header');
                $this->load->view('akunting/V_hutang_armada', Array('data'=>$data,'pesan' => $pesan));
                $this->load->view('footer');
                
        }

        public function reportItms(){
            $this->load->model('M_setoran');

            $post = $this->input->post();
            $idDbSimtax = $this->user['id_pool_simtax'];
            $username = $this->user['username'];
           
            $noPintuProses = (isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
            $flagProses = 0;    
            $pesan = 0;
            $date = date('Y-m-d');
            $tglSpjProses = (isset($post['tglSpjProses']) ? $post['tglSpjProses'] : 0);

           $pool            = $this->input->post('pool');
           $no_pintu        = $this->input->post('no_pintu');
           $nama_driver     = $this->input->post('nama_driver');
           $jenis_perbaikan = $this->input->post('jenis_perbaikan');
           $keterangan      = $this->input->post('keterangan');

           $data = array(
                'username'          => $username,
                'pool'              => $pool,
                'no_pintu'          => $no_pintu,
                'nama_driver'       => $nama_driver,
                'jenis_perbaikan'   => $jenis_perbaikan,
                'keterangan'        => $keterangan

            );
            $cek = $this->M_setoran->cekData($data);
            //print_r($data);die();
            if($data = $cek){
                echo " <script>    
                      alert('Data yang sama sudah di input oleh : ' + '$username ' + ' dan ber status AKTIF');
                </script>";
                $data = $this->M_setoran->dataReport($data,$username);
                $this->load->view('header');
                $this->load->view('ITMS/V_report_itms', Array('insert'=>$insert,'data' =>$data,'pesan' => $pesan));
                $this->load->view('footer');
            }else{
                $data = array(
                'username'          => $username,
                'pool'              => $pool,
                'no_pintu'          => $no_pintu,
                'nama_driver'       => $nama_driver,
                'jenis_perbaikan'   => $jenis_perbaikan,
                'keterangan'        => $keterangan
            );
                $insert = $this->M_setoran->insertReport($data);
                $data = $this->M_setoran->dataReport($data,$username);
                $this->load->view('header');
                $this->load->view('ITMS/V_report_itms', Array('insert'=>$insert,'data' =>$data,'pesan' => $pesan));
                $this->load->view('footer');
                
            }
            
        }

        public function menuReportItms(){
            $this->load->model('M_setoran');
            $post = $this->input->post();
            $idDbSimtax = $this->user['id_pool_simtax'];
            $username = $this->user['username'];
           
            $post = $this->input->post();
            $idDbSimtax = $this->user['id_pool_simtax'];
            $username = $this->user['username'];

            $data = $this->M_setoran->dataReport($data,$username);
            $this->load->view('header');
            $this->load->view('ITMS/V_report_itms', Array('data'=>$data,'pesan' => $pesan));
            $this->load->view('footer');
        }

        public function updateStatus(){
            $this->load->model('M_setoran');
            $post = $this->input->post();
            $idDbSimtax = $this->user['id_pool_simtax'];
            $username = $this->user['username'];
            
            $id = $_GET['id'];
            $done = ['Done'];
            
            $cek = $this->M_setoran->statusReport($id);
            //print($cek{0}{'status'});die();
            //print_r($done{0});die();
            if($cek{0}{'status'} == $done{0}){
                echo " <script>    
                      alert('Data sudah Berstatus : ' + 'Done ' + ' oleh : ' + '$username');
                </script>";
                $data = $this->M_setoran->dataReport($data,$username);
                $this->load->view('header');
                $this->load->view('ITMS/V_report_itms', Array('insert'=>$insert,'data' =>$data,'pesan' => $pesan));
                $this->load->view('footer');
            }else{
                $update = $this->M_setoran->updateStatusModel($id);
                $data = $this->M_setoran->dataReport($data,$username);
                $this->load->view('header');
                $this->load->view('ITMS/V_report_itms', Array('data'=>$data,'update'=>$update,'pesan' => $pesan));
                $this->load->view('footer');

            }
        }

         public function menuRekapItms(){
            $this->load->model('M_setoran');
            $post = $this->input->post();
            $idDbSimtax = $this->user['id_pool_simtax'];
            $username = $this->user['username'];
           
            $post = $this->input->post();
            $idDbSimtax = $this->user['id_pool_simtax'];
            $username = $this->user['username'];

            $data = $this->M_setoran->dataRekap($data,$username);
            $this->load->view('header');
            $this->load->view('ITMS/V_rekap_itms', Array('data'=>$data,'pesan' => $pesan));
            $this->load->view('footer');
        }
    }
     
?>