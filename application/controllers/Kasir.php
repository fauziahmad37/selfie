<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

include_once('Admin.php');
class Kasir extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
       
	}
	
    public function C_truncate(){
        $this->load->model('kasir_model');
                echo "<script>
                function myFunction() {
                    alert('Data Berhasil di Bersihkan');
                }
                </script>";
             $truncate = $this->kasir_model->M_truncate();
                
                
            
         $this->load->view('header');
                $this->load->view('kasir/inputCt', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noCtProses'=>$noCtProses));
        $this->load->view('footer');
    }
	function inputCt()
	{   
                $pesan='0';
                $flagProses =0;
                $post = $this->input->post();;
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $ct_no =0;
                $arrNoCtPusat = null;
                $noCtProses =(isset($post['noCtProses']) ? $post['noCtProses'] : 0);
                $connDb = '0';
                
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
			$no_ct = $post['no_ct'];
                        $noCtProses = $post['no_ct'];
                        $this->load->model('kasir_model');
                        $countDataPool = $this->kasir_model->countDataCtPool($no_ct, $connDb);
                        $countDataPusat = $this->kasir_model->countDataCtPusat($no_ct);
                        
                        
                        if ($countDataPool > 0 && $countDataPusat > 0) {
                        $pesan = 'No Tiket Sudah ada di Simtax silahkan coba kembali';
                         
                        } else if ($countDataPool == 0 && $countDataPusat == 0) {
                             $pesan = 'No Tiket tersebut tidak ditemukan di Pusat, silahkan hubungi Finance terlebih dahulu';
                             
                        } else if ($countDataPool == 0 && $countDataPusat > 0) {
                             $pesan = 'Silahkan tekan tombol Proses dibawah untuk memproses No Tiket ';
                             $flagProses =1;
                        } 
		}
                
                if(isset($post['proses']))
		{
                       
			$this->load->model('kasir_model');
                        $arrNoCtPusat = $this->kasir_model->getDataCtPusat($ct_no);
                        $query = $this->kasir_model->insertCtPool($connDb,$username,$noCtProses);                                
                        $pesan = 'Silahkan cek kembali Simtax anda';    
		}
                
                $this->load->view('header');
                $this->load->view('kasir/inputCt', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noCtProses'=>$noCtProses));
		$this->load->view('footer');	
	}
	
	function adjustmentTidakAdaDiPusat()
	{   
                $pesan='0';
                $flagProses =0;
                $post = $this->input->post();;
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $ct_no =0;
                $arrNoAdjPusat = null;
                $noAdjProses =(isset($post['noAdjProses']) ? $post['noAdjProses'] : 0);
                $connDb = '0';
                
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
						$no_adj = $post['no_adj'];
                        $noAdjProses = $post['no_adj'];
                        $this->load->model('kasir_model');
                        $countDataPool = $this->kasir_model->countDataAdjPool($connDb, $no_adj );
                        $countDataPusat = $this->kasir_model->countDataAdjPusat($no_adj);
                        $getKipPool = $this->kasir_model->getKipAdjPool($connDb, $no_adj);
						$getKipPusat = $this->kasir_model->getKipAdjPusat( $no_adj);
						$getAmtPool = $this->kasir_model->getAmountAdjPool($connDb, $no_adj);
						$getAmtPusat = $this->kasir_model->getAmountAdjPusat( $no_adj);
                        
                        if ($countDataPool > 0 && $countDataPusat > 0) 
						{
                        
						
							if ($getKipPool == $getKipPusat && $getAmtPool == $getAmtPusat)
							{
								$pesan = 'No Ajd Sudah ada di Pusat, sudah dapat diapprove';
							}
							else if ($getKipPool != $getKipPusat || $getAmtPool != $getAmtPusat)
							{
								$pesan = 'No Ajd tidak sesuai, harap hubungi IT';
							}
                         
                        } else if ($countDataPool == 0 && $countDataPusat == 0) 
						{
                             $pesan = 'No Adj salah, mohon ditulis dengan benar';
                             
                        } else if ($countDataPool > 0 && $countDataPusat == 0) {
                             $pesan = 'Silahkan tekan tombol Proses dibawah untuk mengirim No Ajd ke Pusat';
                             $flagProses =1;
                        } 
		}
                
                if(isset($post['proses']))
		{
                       
						$this->load->model('kasir_model');
                        $query = $this->kasir_model->insertAdjPusat($connDb,$username,$noAdjProses);                                
                        $pesan = 'Silahkan cek kembali Simtax anda';    
		}
                
                $this->load->view('header');
                $this->load->view('kasir/adjTidakAdaDiPusat', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
		$this->load->view('footer');	
	}

    function adjustmentTidakAdaDiPool()
    {   
                $pesan='0';
                $flagProses =0;
                $post = $this->input->post();;
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $ct_no =0;
                $arrNoAdjPusat = null;
                $noAdjProses =(isset($post['noAdjProses']) ? $post['noAdjProses'] : 0);
                $connDb = '0';
                
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
                        $no_adj = $post['no_adj'];
                        $noAdjProses = $post['no_adj'];
                        $this->load->model('kasir_model');
                        $countDataPool = $this->kasir_model->countDataAdjPool($connDb, $no_adj );
                        $countDataPusat = $this->kasir_model->DataAdjPusat($no_adj);
                        $getKipPool = $this->kasir_model->getKipAdjPool($connDb, $no_adj);
                        $getKipPusat = $this->kasir_model->getKipAdjPusat( $no_adj);
                        $getAmtPool = $this->kasir_model->getAmountAdjPool($connDb, $no_adj);
                        $getAmtPusat = $this->kasir_model->getAmountAdjPusat( $no_adj);


                        if($countDataPool > 0 && $countDataPusat > 0){
                            if($countDataPusat >0){
                                $pesan = 'Silahkan tekan tombol Proses dibawah untuk merubah status adjusment';
                                $flagProses =1;
                            }

                        }else{
                             $pesan = 'Data Tidak di Temukan';
                        }

                        
                        // if ($countDataPool > 0 && $countDataPusat > 0) 
                        // {
                        
                        
                        //     if ($getKipPool == $getKipPusat && $getAmtPool == $getAmtPusat)
                        //     {
                        //         $pesan = 'No Ajd Sudah ada di Pusat, sudah dapat diapprove';
                        //     }
                        //     else if ($getKipPool != $getKipPusat || $getAmtPool != $getAmtPusat)
                        //     {
                        //         $pesan = 'No Ajd tidak sesuai, harap hubungi IT';
                        //     }
                         
                        // } else if ($countDataPool == 0 && $countDataPusat == 0) 
                        // {
                        //      $pesan = 'No Adj salah, mohon ditulis dengan benar';
                             
                        // } else if ($countDataPool > 0 && $countDataPusat == 0) {
                        //      $pesan = 'Silahkan tekan tombol Proses dibawah untuk mengirim No Ajd ke Pusat';
                        //      $flagProses =1;
                        // } 
        }
                
                if(isset($post['proses']))
        {
                       
                        $this->load->model('kasir_model');
                        $query = $this->kasir_model->insertAdjPool($connDb,$username,$noAdjProses);                                
                        $pesan = 'Silahkan cek kembali Simtax anda';    
        }
                
                $this->load->view('header');
                $this->load->view('kasir/adjTidakAdaDiPool', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
                $this->load->view('footer');    
    }
        
    function adjustmentArmadaTidakAdaDiPusat()
    {   
                $pesan='0';
                $flagProses =0;
                $post = $this->input->post();;
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $ct_no =0;
                $arrNoAdjPusat = null;
                $noAdjProses =(isset($post['noAdjProses']) ? $post['noAdjProses'] : 0);
                $connDb = '0';
                
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
                        $no_adj = $post['no_adj'];
                        $noAdjProses = $post['no_adj'];
                        $this->load->model('kasir_model');
                        $countDataPool = $this->kasir_model->countDataAdjPool($connDb, $no_adj );
                        $countDataPusat = $this->kasir_model->countDataAdjPusat($no_adj);
                        $getKipPool = $this->kasir_model->getKipAdjPool($connDb, $no_adj);
                        $getKipPusat = $this->kasir_model->getKipAdjPusat( $no_adj);
                        $getAmtPool = $this->kasir_model->getAmountAdjPool($connDb, $no_adj);
                        $getAmtPusat = $this->kasir_model->getAmountAdjPusat( $no_adj);
                        
                        if ($countDataPool > 0 && $countDataPusat > 0) 
                        {
                        
                        
                            if ($getKipPool == $getKipPusat && $getAmtPool == $getAmtPusat)
                            {
                                $pesan = 'No Ajd Sudah ada di Pusat, sudah dapat diapprove';
                            }
                            else if ($getKipPool != $getKipPusat || $getAmtPool != $getAmtPusat)
                            {
                                $pesan = 'No Ajd tidak sesuai, harap hubungi IT';
                            }
                         
                        } else if ($countDataPool == 0 && $countDataPusat == 0) 
                        {
                             $pesan = 'No Adj salah, mohon ditulis dengan benar';
                             
                        } else if ($countDataPool > 0 && $countDataPusat == 0) {
                             $pesan = 'Silahkan tekan tombol Proses dibawah untuk mengirim No Ajd ke Pusat';
                             $flagProses =1;
                        } 
        }
                
                if(isset($post['proses']))
        {
                       
                        $this->load->model('kasir_model');
                        $query = $this->kasir_model->insertAdjPusat($connDb,$username,$noAdjProses);                                
                        $pesan = 'Silahkan cek kembali Simtax anda';    
        }
                
                $this->load->view('header');
                $this->load->view('kasir/adjustmentArmadaPusat', Array('pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
                $this->load->view('footer');    
    }

    public function menu_ar_driver_pusat(){
    
        $data = array();
        $this->load->view('header');
        $this->load->view('akunting/V_ar_driver_pusat', Array('data'=>$data,'pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
        $this->load->view('footer'); 
    }

    public function ar_driver_pusat(){
        $this->load->model('Kasir_model');
        $post = $this->input->post();
        if(isset($post['cek'])){
            $nokip = $post['no_kip'];
        }
        $data = $this->Kasir_model->DataArDriverPusat($nokip);
        $this->load->view('header');
        $this->load->view('akunting/V_ar_driver_pusat', Array('data'=>$data,'pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
        $this->load->view('footer'); 
    }

    public function ArDriverTidakAda(){

                $this->load->model('Kasir_model');
                $pesan='0';
                $flagProses =0;
                $post = $this->input->post();
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $ct_no =0;
                $arrNoAdjPusat = null;
                $noAdjProses =(isset($post['noAdjProses']) ? $post['noAdjProses'] : 0);
                $connDb = '0';


                if(isset($post['cek'])){
                    $nokip = $post['no_kip'];
                    $namaPool = $post['id_pool'];
                    $noPintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
                  
                    $idpool = $post['id_pool'];
                        
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
                }else if($idDbSimtax == '2'){
                     $connDb = 'simtax_pusat';
                }

        $data = $this->Kasir_model->DataArDriver($connDb,$nokip);
        $this->load->view('header');
        $this->load->view('kasir/Ar_driver', Array('data'=>$data,'pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
        $this->load->view('footer'); 
    }

        public function InsertArDriverPusat(){

                $this->load->model('Kasir_model');
                $pesan='0';
                $flagProses =0;
                $post = $this->input->post();;
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $ct_no =0;
                $arrNoAdjPusat = null;
                $noAdjProses =(isset($post['noAdjProses']) ? $post['noAdjProses'] : 0);
                $connDb = '0';


                if(isset($post['cek'])){
                    //print_r($post);die;
                    for($i=0; $i<=$max;$i++){
                        $insert = array(
                            'periodeid'         =>$this->input->post('periodeid')+1,
                            'ptid'              =>$this->input->post('ptid'),
                            'poolid'            =>$this->input->post('poolid'),
                            'no_kip'            =>$this->input->post('no_kip'),
                            'nama_pengemudi'    =>$this->input->post('nama_pengemudi'),
                            'ar_saldo_awal'     =>$this->input->post('ar_saldo_akhir'),
                            'ar_plus'           =>$this->input->post('ar_plus'),
                            'ar_minus'          =>$this->input->post('ar_minus'),
                            'ar_saldo_akhir'    =>$this->input->post('ar_saldo_akhir')
                        );
                    }
                    
                    $namaPool = $post['id_pool'];
                    $noPintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
                    $idpool = $post['id_pool'];
                    $nokip = $post['no_kip'];
                }

           $max = $this->Kasir_model->MaxIdPusat( $connDb = 'simtax_pusat');
            //print_r($post['periodeid']);die;

        if($post['periodeid'] == $max[0]['PERIODID']){
             echo "<script>
                    alert('Data Sudah Ada di SIMTAX silahkan dicek kembali');
                </script>";
                $data = $this->Kasir_model->DataArDriver($connDb = 'simtax_pusat',$nokip);
                $this->load->view('header');
                $this->load->view('kasir/Ar_driver', Array('data'=>$data,'pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
                $this->load->view('footer'); 
        }else{
             echo "<script>
                    alert('Data Berhasil Ditambahkan');
                </script>";
            $data1 = $this->Kasir_model->DataArDriverPusat($nokip);
            $data = $this->Kasir_model->InsertDataArDriverPusat($insert);
            $this->load->view('header');
            $this->load->view('akunting/V_ar_driver_pusat', Array('data'=>$data,'data'=>$data1,'pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
            $this->load->view('footer');        
        }
    }

    public function InsertArDriver(){

                $this->load->model('Kasir_model');
                $pesan='0';
                $flagProses =0;
                $post = $this->input->post();;
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $ct_no =0;
                $arrNoAdjPusat = null;
                $noAdjProses =(isset($post['noAdjProses']) ? $post['noAdjProses'] : 0);
                $connDb = '0';


                if(isset($post['cek'])){
                    //print_r($post);die;

                    $insert = array(
                            'periodeid'         =>$this->input->post('periodeid')+1,
                            'ptid'              =>$this->input->post('ptid'),
                            'poolid'            =>$this->input->post('poolid'),
                            'no_kip'            =>$this->input->post('no_kip'),
                            'nama_pengemudi'    =>$this->input->post('nama_pengemudi'),
                            'ar_saldo_awal'     =>$this->input->post('ar_saldo_akhir'),
                            'ar_plus'           =>$this->input->post('ar_plus'),
                            'ar_minus'          =>$this->input->post('ar_minus'),
                            'ar_saldo_akhir'    =>$this->input->post('ar_saldo_akhir')
                        );
                    
                    $namaPool = $post['id_pool'];
                    $noPintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
                  
                    $idpool = $post['id_pool'];
                        
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

       $max = $this->Kasir_model->MaxId($connDb);
        //print_r($post['periodeid']);die;

        if($post['periodeid'] == $max[0]['PERIODID']){
             echo "<script>
                 
                    alert('Data Sudah Ada di SIMTAX silahkan dicek kembali');
                
                </script>";
                $data = $this->Kasir_model->DataArDriver($connDb,$nokip);
                $this->load->view('header');
                $this->load->view('kasir/Ar_driver', Array('data'=>$data,'pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
                $this->load->view('footer'); 
        }else{

             echo "<script>
                 
                    alert('Data Berhasil Ditambahkan');
                
                </script>";
            $data1 = $this->Kasir_model->DataArDriver($connDb,$nokip);
            $data = $this->Kasir_model->InsertDataArDriver($connDb,$insert);
            $this->load->view('header');
            $this->load->view('kasir/Ar_driver', Array('data'=>$data,'data'=>$data1,'pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
            $this->load->view('footer');        
        }
    }

    public function ArArmadaTidakAda(){
            $this->load->model('Kasir_model');
                $pesan='0';
                $flagProses =0;
                $post = $this->input->post();;
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $ct_no =0;
                $arrNoAdjPusat = null;
                $noAdjProses =(isset($post['noAdjProses']) ? $post['noAdjProses'] : 0);
                $connDb = '0';

                if(isset($post['cek'])){
                    
                    $nomerpintu = $post['no_pintu'];
                
                    $idpool = $post['id_pool'];
                        
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

            $max = $this->Kasir_model->MaxId($connDb);
            $data = $this->Kasir_model->DataArArmada($connDb,$nomerpintu);
            $this->load->view('header');
            $this->load->view('kasir/Ar_armada', Array('data'=>$data,'data1'=>$data1,'pesan' => $pesan));
            $this->load->view('footer'); 
    }

public function InsertArArmada(){

                $this->load->model('Kasir_model');
                $pesan='0';
                $flagProses =0;
                $post = $this->input->post();;
                $idDbSimtax = $this->user['id_pool_simtax'];
                $username = $this->user['username'];
                $ct_no =0;
                $arrNoAdjPusat = null;
                $noAdjProses =(isset($post['noAdjProses']) ? $post['noAdjProses'] : 0);
                $connDb = '0';


                if(isset($post['cek'])){
                   
                    $insert = array(
                            'period_id'                 =>$this->input->post('period_id')+1,
                            'owner_pt_id'               =>$this->input->post('owner_pt_id'),
                            'pool_id'                   =>$this->input->post('pool_id'),
                            'car_id'                    =>$this->input->post('car_id'),
                            'no_pintu'                  =>$this->input->post('no_pintu'),
                            'kip_owner'                 =>$this->input->post('kip_owner'),
                            'nama_owner'                =>$this->input->post('nama_owner'),
                            'ar_ks_saldo_awal'          =>$this->input->post('ar_ks_saldo_akhir'),
                            'ar_ks_bulan_ini_plus'      =>$this->input->post('ar_ks_bulan_ini_plus'),
                            'ar_ks_bulan_ini_minus'     =>$this->input->post('ar_ks_bulan_ini_minus'),
                            'ar_ks_saldo_akhir'         =>$this->input->post('ar_ks_saldo_akhir'),
                            'ar_tabsp_saldo_awal'       =>$this->input->post('ar_tabsp_saldo_akhir'),
                            'ar_tabsp_bulan_ini_plus'   =>$this->input->post('ar_tabsp_bulan_ini_plus'),
                            'ar_tabsp_bulan_ini_minus'  =>$this->input->post('ar_tabsp_bulan_ini_minus'),
                            'ar_tabsp_saldo_akhir'      =>$this->input->post('ar_tabsp_saldo_akhir'),
                            'ar_lain_saldo_awal'        =>$this->input->post('ar_lain_saldo_akhir'),
                            'ar_lain_bulan_ini_plus'    =>$this->input->post('ar_lain_bulan_ini_plus'),
                            'ar_lain_bulan_ini_minus'   =>$this->input->post('ar_lain_bulan_ini_minus'),
                            'ar_lain_saldo_akhir'       =>$this->input->post('ar_lain_saldo_akhir'),

                        );
                     //print_r($insert);die;

                    $namaPool = $post['id_pool'];
                    $noPintu = $post['no_pintu'];
                    $noPintuProses = $noPintu;
                  
                    $idpool = $post['id_pool'];
                        
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

       $max = $this->Kasir_model->MaxId($connDb);
        //print_r($max);die;

        if($post['period_id'] == $max[0]['PERIODID']){
             echo "<script>
                 
                    alert('Data Sudah Ada di SIMTAX silahkan dicek kembali');
                
                </script>";
               
                $data = $this->Kasir_model->DataArArmada($connDb, $noPintu);
                $this->load->view('header');
                $this->load->view('kasir/Ar_armada', Array('data'=>$data,'pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
                $this->load->view('footer'); 
        }else{

             echo "<script>
                    
                    alert('Data Berhasil Ditambahkan');
                
                </script>";
            $page = $_SERVER['PHP_SELF'];
                    $sec = 1;

            $data1 = $this->Kasir_model->DataArArmada($connDb, $noPintu);
            $data = $this->Kasir_model->InsertDataArArmada($connDb,$insert);
            $this->load->view('header');
            $this->load->view('kasir/Ar_armada', Array('data'=>$data,'data'=>$data1,'pesan' => $pesan, 'flagProses' => $flagProses,'noAdjProses'=>$noAdjProses));
            $this->load->view('footer');        
        }
    }

}