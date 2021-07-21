<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Operasi extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}


    function duplicatSpj(){
        
        $this->load->model('operasi_model');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $noPintuProses =(isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
                $periodMonth = $this->operasi_model->getPeriodMonth();
                $flagProses = 0;    
                $pesan = 0;
                
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
                    $noPintuProses =$noPintu;
                    $dataPintu = $this->operasi_model->getNoPintuDup($connDb,$noPintu);
                    if($noPintu >0){
                        $pesan = 'Data sudah ada';
                    }

                        if ($dataPintu > 0 ) {
                            $pesan = 'Data ditemukan Silahkan Tekan Tombol Proses';
                            $flagProses = 1;

                            } else {
                                $pesan = 'No Pintu yang anda masukan salah';
                        }
                    }
                    if(isset($post['proses']))
                        {
                                       
                            $query = $this->operasi_model->updateDuplicat($connDb, $username, $noPintuProses);                                
                            $pesan = 'Silahkan cek kembali Simtax anda';    
                        }
                            $this->load->view('header');
                            $this->load->view('operasi/duplicatSpj', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses));
                            $this->load->view('footer');
                
    }
    

    function bukaBs(){
        
        $this->load->model('operasi_model');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $noPintuProses =(isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
				$periodMonthProses =(isset($post['periodMonthProses']) ? $post['periodMonthProses'] : 0);
                $flagProses = 0;    
                $pesan = 0;
                
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
					$periodMonth  = $post['period_month'];
                    $noPintuProses =$noPintu;
                    $dataPintu = $this->operasi_model->getNoPintuBs($connDb,$noPintu);
					$periodMonthProses = $periodMonth;
                    

                        if ($dataPintu > 0 ) {
                               

                                $CekDataBs = $this->operasi_model->getDataBs($connDb,$noPintu,$periodMonthProses );
                                if($CekDataBs >0){
                                    $pesan = 'Status sudah BEBAS SETOR ';
                                    $flagProses = 0;
                                }else{
                                    $cekTotalSetor1 = $this->operasi_model->getTotalSetor1($connDb,$noPintu, $periodMonthProses);
                                    $cekTotalSetor2 = $this->operasi_model->getTotalSetor2($connDb,$noPintu, $periodMonthProses);
                                    $cekTotalSetor2 = $cekTotalSetor2 *-1;
                                    $cekTotal = $cekTotalSetor1 + $cekTotalSetor2;
									$getSetorHarian = $this->operasi_model->getSetoran($connDb,$noPintu);

                                    if($cekTotal >= $getSetorHarian ){
                                        $pesan = 'Silahkan Tekan Tombol Proses di Bawah ';
                                        $flagProses = 1;
                                    }else{
                                        $pesan = 'Setoran BS Tidak Terpenuhi Mohon Untuk Membayar Setoran';
                                        $flagProses = 0;
                                    }
                                }

                            } else {
                                $pesan = 'No Pintu yang anda masukan salah';
                        }
                    }
                    if(isset($post['proses']))
                        {
                                       
                            $query = $this->operasi_model->updateBukaBs($connDb, $username, $noPintuProses, $periodMonthProses);                                
                            $pesan = 'Silahkan cek kembali Simtax anda';    
                        }
                            $this->load->view('header');
                            $this->load->view('operasi/bukaBs', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'periodMonthProses'=>$periodMonthProses));
                            $this->load->view('footer');
                
    }
	
	function bukaSos()
	{   
                
                $this->load->model('operasi_model');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $noPintuProses =(isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
                $periodMonth = $this->operasi_model->getPeriodMonth();
                $flagProses = 0;    
                $pesan = 0;
                
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
                
                if(isset($post['cek']))
		{
			            $noPintu = $post['no_pintu'];
                        $noPintuProses =$noPintu;
                        $dataSos = $this->operasi_model->getDataSos($connDb,$noPintu,$periodMonth);
						$cekDataSos = $this->operasi_model->cekDataSos($connDb,$noPintu);
                        
                        
                        
                        if ($dataSos > 0 ) {
						if ($cekDataSos > 0) {
                            $ArMurniBulan = $this->operasi_model->getAmountSosBulan($connDb,$noPintu,$periodMonth);
                            $ArMurniTotal = $this->operasi_model->getAmountSosTotal($connDb,$noPintu,$periodMonth);
                            
                            if ($ArMurniTotal >= 1000000)
                            {
                                $pesan = 'Total AR Murni > 1.000.000, mohon bayar terlebih dahulu';
                                $flagProses = 0;
                            } else if ($ArMurniBulan >= 300000)
                            {
                                $pesan = 'AR Murni Bulan ini > 300.000, mohon bayar terlebih dahulu';
                                $flagProses = 0;
                            } else 
                            {
                                $pesan = 'Silahkan melanjutkan dengan menekan tombol Proses dibawah';
                                $flagProses = 1;
                            }
						} else {
							 $pesan = 'No Pintu sudah terbuka SOS';
						}
                        } else {
                            $pesan = 'No Pintu yang anda masukan salah';
                        }
		}
                
                if(isset($post['proses']))
		{
                       
			$query = $this->operasi_model->updateBukaSos($connDb, $username, $noPintuProses);                                
                        $pesan = 'Silahkan cek kembali Simtax anda';    
		}
                
                $this->load->view('header');
                $this->load->view('operasi/bukaSos', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses));
		        $this->load->view('footer');	
	}

	function bukaSosAdmin()
	{   
                
                $this->load->model('operasi_model');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $noPintuProses =(isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
                $periodMonth = $this->operasi_model->getPeriodMonth();
                $flagProses = 0;    
                $pesan = 0;
                
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
                
                if(isset($post['cek']))
		{
			            $noPintu = $post['no_pintu'];
                        $noPintuProses =$noPintu;
                        $dataSos = $this->operasi_model->getDataSos($connDb,$noPintu,$periodMonth);
						$cekDataSos = $this->operasi_model->cekDataSos($connDb,$noPintu);
                        
                        
                        
                        if ($dataSos > 0 ) {
						if ($cekDataSos > 0) {
                            $ArMurniBulan = $this->operasi_model->getAmountSosBulan($connDb,$noPintu,$periodMonth);
                            $ArMurniTotal = $this->operasi_model->getAmountSosTotal($connDb,$noPintu,$periodMonth);
                            
                            if ($ArMurniTotal >= 1000000)
                            {
                                $pesan = 'Total AR Murni > 1.000.000, mohon bayar terlebih dahulu';
                                $flagProses = 1;
                            } else if ($ArMurniBulan >= 300000)
                            {
                                $pesan = 'AR Murni Bulan ini > 300.000, mohon bayar terlebih dahulu';
                                $flagProses = 1;
                            } else 
                            {
                                $pesan = 'Silahkan melanjutkan dengan menekan tombol Proses dibawah';
                                $flagProses = 1;
                            }
						} else {
							 $pesan = 'No Pintu sudah terbuka SOS';
						}
                        } else {
                            $pesan = 'No Pintu yang anda masukan salah';
                        }
		}
                
                if(isset($post['proses']))
		{
                       
			$query = $this->operasi_model->updateBukaSos($connDb, $username, $noPintuProses);                                
                        $pesan = 'Silahkan cek kembali Simtax anda';    
		}
                
                $this->load->view('header');
                $this->load->view('operasi/bukaSosAdmin', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses));
		        $this->load->view('footer');	
	}	
	
	function syncArArmadaMurni()
	{   
                
                $this->load->model('operasi_model');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $noPintuProses =(isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
				$periodMonthProses =(isset($post['periodMonthProses']) ? $post['periodMonthProses'] : 0);
				
                $flagProses = 0;    
                $pesan = 0;
                
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
                
                if(isset($post['cek']))
		{
			            $noPintu = $post['no_pintu'];
						$periodMonth  = $post['period_month'];
                        $noPintuProses = $noPintu;
						$periodMonthProses = $periodMonth;
                        $dataArArmadaMurni = $this->operasi_model->getDataArArmadaMurni($connDb,$noPintu,$periodMonth);
						                        
                        
                        if ($dataArArmadaMurni > 0 ) {

                                $pesan = 'Silahkan Melanjutkan Proses';
                                $flagProses = 1;
                           
							
                        } else {
                            $pesan = 'No Pintu atau Periode  yang anda masukan tidak ditemukan';
							$flagProses = 0;
                        }
		}
                
                if(isset($post['proses']))
		{
						$dataTanggalAwal = $this->operasi_model->getFirstDate($connDb,$noPintuProses);
						
                       if ($periodMonthProses == 110)
					  {
								$dateStart = '2018-4-1';
								$dateEnd = '2018-5-1';
					  }
					  else if ($periodMonthProses == 109)
					  {
								$dateStart = '2018-3-1';
								$dateEnd = '2018-4-1';
					  }
					  else if ($periodMonthProses == 108)
					  {
								$dateStart = '2018-2-1';
								$dateEnd = '2018-3-1';
					  }
					  else if ($periodMonthProses == 107)
					  {
								$dateStart = '2018-1-1';
								$dateEnd = '2018-2-1';
					  }
					   else if ($periodMonthProses == 106)
					  {
								$dateStart = '2017-12-1';
								$dateEnd = '2018-1-1';
					  }
					   else if ($periodMonthProses == 111)
					  {
								$dateStart = '2018-05-1';
								$dateEnd = '2018-6-1';
					  }
					   else if ($periodMonthProses == 112)
					  {
								$dateStart = '2018-06-1';
								$dateEnd = '2018-7-1';
					  }
					   else if ($periodMonthProses == 113)
					  {
								$dateStart = '2018-07-1';
								$dateEnd = '2018-8-1';
					  }
					  else if ($periodMonthProses == 114)
					  {
								$dateStart = '2018-08-1';
								$dateEnd = '2018-9-1';
					  }else if ($periodMonthProses == 115)
					  {
								$dateStart = '2018-09-1';
								$dateEnd = '2018-10-1';
					  }
					  
					  $dataKsAwal = $this->operasi_model->getDataKsBulanLalu($connDb,$noPintuProses, $periodMonthProses);
					  
					  if (strtotime($dataTanggalAwal) > strtotime($dateStart))
					  {
						  $dateStart = $dataTanggalAwal;
						  $dataKsAwal = 0;
					  }
							
							
							
							$dataKsTerbit = $this->operasi_model->getDataKsTerbit($connDb,$noPintuProses,$dateStart, $dateEnd);
                            $dataBayarKs1 = $this->operasi_model->getDataBayarKs1($connDb,$noPintuProses,$dateStart, $dateEnd);
							$dataBayarKs2 = $this->operasi_model->getDataBayarKs2($connDb,$noPintuProses,$dateStart, $dateEnd);
							$dataBayarKsTotal = $dataBayarKs1 + $dataBayarKs2;
							$dataKsAkhir = $dataKsAwal + $dataKsTerbit - $dataBayarKsTotal;
							
			$query = $this->operasi_model->updateSyncArMurni($connDb, $username, $noPintuProses, $periodMonthProses, $dataKsAwal, $dataKsTerbit, $dataBayarKsTotal, $dataKsAkhir  );                                
                        $pesan = 'Silahkan cek kembali Simtax anda';    
		}
                
                $this->load->view('header');
                $this->load->view('operasi/syncArMurni', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'periodMonthProses'=>$periodMonthProses,'dataTanggalAwal'=>$dataTanggalAwal));
		        $this->load->view('footer');	
	}
        
    function batalOperasi()
	{   
                
                $this->load->model('operasi_model');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $noPintuProses =(isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
				$spjDateProses =(isset($post['spjDateProses']) ? $post['spjDateProses'] : 0);
				
                $flagProses = 0;    
                $pesan = 0;
				$date = date('Y-m-d');
                
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
                
                if(isset($post['cek']))
		{
			            $noPintu = $post['no_pintu'];
						$spjDate = $post['tglspj'];
						$spjDate = date('Y-m-d', strtotime($spjDate));
                        $noPintuProses = $noPintu;
						$spjDateProses = $spjDate;
                        $dataArArmadaMurni = $this->operasi_model->getDataBatalOperasi($connDb,$noPintu,$spjDate);
						$date = $post['tglspj'];                        
                        
                        if ($dataArArmadaMurni > 0 ) {

                                $pesan = 'Silahkan Melanjutkan Proses';
                                $flagProses = 1;
                           
							
                        } else {
                            $pesan = 'No Pintu atau Tanggal SPJ  yang anda masukan tidak ditemukan ('.$spjDate.')';
							$flagProses = 0;
                        }
		}
                
                if(isset($post['proses']))
		{
                       	$query = $this->operasi_model->updateBatalOperasi($connDb, $username, $noPintuProses, $spjDateProses);                                
                        $pesan = 'Silahkan cek kembali Simtax anda';    
		}
                
                $this->load->view('header');
                $this->load->view('operasi/batalOperasi', Array('pesan' => $pesan,'date' =>$date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'spjDateProses'=>$spjDateProses, 'tglspj'=>$tglspj));
		        $this->load->view('footer');	
	}
	
	function batalOperasiPool()
	{   
                
                $this->load->model('operasi_model');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $noPintuProses =(isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
				$spjDateProses =(isset($post['spjDateProses']) ? $post['spjDateProses'] : 0);
				$alasanBatalOperasiProses =(isset($post['alasanBatalOperasiProses']) ? $post['alasanBatalOperasiProses'] : 0);
				
                $flagProses = 0;    
                $pesan = 0;
				$date = date('Y-m-d');
                
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
                
                if(isset($post['cek']))
		{
			            $noPintu = $post['no_pintu'];
						$spjDate = $post['tglspj'];
						$alasanBatalOperasi = $post['v_alasan'];
						$spjDate = date('Y-m-d', strtotime($spjDate));
                        $noPintuProses = $noPintu;
						$spjDateProses = $spjDate;
						$alasanBatalOperasiProses = $alasanBatalOperasi;
                        $dataArArmadaMurni = $this->operasi_model->getDataBatalOperasi($connDb,$noPintu,$spjDate);
						$date = $post['tglspj'];   
						$hariIni = date('Y-m-d');
						$dif =strtotime($hariIni)-strtotime($spjDate);	
						$dif =$dif/ (60 * 60 * 24);			
						$panjangAlasan = strlen($alasanBatalOperasiProses);
                        
                        if ($dataArArmadaMurni > 0 ) {
							
							if ($dif < 3)
							{
								
								if ($panjangAlasan >= 16)
								{
                                $pesan = 'Silahkan Melanjutkan Proses';
                                $flagProses = 1;
								}
								else
									{
								 $pesan = 'Alasan Minimum 16 Karakter';
                                $flagProses = 0;
							}
							}
							else
							{
								 $pesan = 'Tanggal SPJ Tidak boleh lebih dari 2 hari'.$dif;
                                $flagProses = 0;
							}
                           
							
                        } else {
                            $pesan = 'No Pintu atau Tanggal SPJ  yang anda masukan tidak ditemukan ('.$spjDate.')';
							$flagProses = 0;
                        }
		}
                
                if(isset($post['proses']))
		{
                       	$query = $this->operasi_model->updateBatalOperasi($connDb, $username, $noPintuProses, $spjDateProses, $alasanBatalOperasiProses);                     

						$dataTanggalAwal = $this->operasi_model->getFirstDate($connDb,$noPintuProses);
						
                      $periodMonthProses = 112;
					  
								$dateStart = '2018-6-1';
								$dateEnd = '2018-7-1';
					  
					  
					  $dataKsAwal = $this->operasi_model->getDataKsBulanLalu($connDb,$noPintuProses, $periodMonthProses);
					  
					  if (strtotime($dataTanggalAwal) > strtotime($dateStart))
					  {
						  $dateStart = $dataTanggalAwal;
						  $dataKsAwal = 0;
					  }
							
							
							
							$dataKsTerbit = $this->operasi_model->getDataKsTerbit($connDb,$noPintuProses,$dateStart, $dateEnd);
                            $dataBayarKs1 = $this->operasi_model->getDataBayarKs1($connDb,$noPintuProses,$dateStart, $dateEnd);
							$dataBayarKs2 = $this->operasi_model->getDataBayarKs2($connDb,$noPintuProses,$dateStart, $dateEnd);
							$dataBayarKsTotal = $dataBayarKs1 + $dataBayarKs2;
							$dataKsAkhir = $dataKsAwal + $dataKsTerbit - $dataBayarKsTotal;
							
			$query = $this->operasi_model->updateSyncArMurni($connDb, $username, $noPintuProses, $periodMonthProses, $dataKsAwal, $dataKsTerbit, $dataBayarKsTotal, $dataKsAkhir  );  

			
                        $pesan = 'Silahkan cek kembali Simtax anda';    
		}
                
                $this->load->view('header');
                $this->load->view('operasi/batalOperasiKapool', Array('pesan' => $pesan,'date' =>$date, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'spjDateProses'=>$spjDateProses, 'tglspj'=>$tglspj, 'alasanBatalOperasiProses' => $alasanBatalOperasiProses));
		        $this->load->view('footer');	
	}
	
	function arArmadaMurniTidakAda()
	{   
                
                $this->load->model('operasi_model');
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $noPintuProses =(isset($post['noPintuProses']) ? $post['noPintuProses'] : 0);
				$periodMonthProses =(isset($post['periodMonthProses']) ? $post['periodMonthProses'] : 0);
				
                $flagProses = 0;    
                $pesan = 0;
                
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
                
                if(isset($post['cek']))
		{
			            $noPintu = $post['no_pintu'];
						$periodMonth  = $post['period_month'];
                        $noPintuProses = $noPintu;
						$periodMonthProses = $periodMonth;
                        $dataArArmadaMurni = $this->operasi_model->getDataArArmadaMurni($connDb,$noPintu,$periodMonth);
						                        
                        
                        if ($dataArArmadaMurni > 0 ) {

                                $pesan = 'No Pintu sudah ada di periode tersebut';
                                $flagProses = 0;
                           
							
                        } else {
                            $pesan = 'Silahkan melanjutkan proses';
							$flagProses = 1;
                        }
		}
                
                if(isset($post['proses']))
		{
				$query = $this->operasi_model->insertArArmadaMurni($connDb, $username, $noPintuProses, $periodMonthProses  );                                
                        $pesan = 'Silahkan cek kembali Simtax anda';    
		}
                
                $this->load->view('header');
                $this->load->view('operasi/syncArMurni', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noPintuProses'=>$noPintuProses, 'periodMonthProses'=>$periodMonthProses,'dataTanggalAwal'=>$dataTanggalAwal));
		        $this->load->view('footer');	
	}
	
	
}
