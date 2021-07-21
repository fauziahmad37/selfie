<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	ini_set('max_execution_time', 600); 
	ini_set('memory_limit','2048M');

	include_once('Admin.php');
	class C_penghitaman extends admin{

		public function index(){
            $this->load->model('M_penghitaman');
			$data = $this->M_penghitaman->getDataPenghitaman($connDb = 'simtax_cipondoh_c_jupiter');
			$this->load->view('header');
			$this->load->view('penghitaman/V_penghitaman',Array('data'=>$data,'pesan' => $pesan));
			$this->load->view('footer');
		}

		public function cekDataPenghitaman(){

				$this->load->model('M_penghitaman');

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
                else if ($idDbSimtax == '63')
                {
                    $connDb = 'localdepok';
                }
		


            $data = $this->M_penghitaman->getDataPenghitaman($connDb);
			$this->load->view('header');
			$this->load->view('penghitaman/V_penghitaman',Array('data'=>$data,'pesan' => $pesan));
			$this->load->view('footer');
		}

        public function callPenghitaman(){
            $connDb = 'simtax_bekasi_a_jupiter';
            $this->load->model('M_penghitaman');
            $this->M_penghitaman->getCallProcedure($connDb);
        }
	}
?>