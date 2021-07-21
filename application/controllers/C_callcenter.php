
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ini_set('max_execution_time', 30); 
    ini_set('memory_limit','2048M');

    include_once('Admin.php');
    class C_callcenter extends admin{
		function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');	
	}

    public function viewCall(){
        $this->load->model('M_callcenter');
        $data = null;
        $this->load->view('header');
        $this->load->view('CALLCENTER/V_callcenter', Array('data'=>$data));
        $this->load->view('footer');  
    }

    function index(){
        
        $this->load->model('M_callcenter');

        $latitude   = (isset($post['latitude']) ? $post['latitude'] : 0);
        $longtitude = (isset($post['longtitude']) ? $post['longtitude'] : 0);
        $km         = (isset($post['km']) ? $post['km'] : 0);
        $tgl_awal   = (isset($post['tgl_awal']) ? $post['tgl_awal'] : '2018-01-01 08:15:00');
        $tgl_akhir  = (isset($post['tgl_akhir']) ? $post['tgl_akhir'] : '2018-01-01 08:15:00');

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

            $latitude = $post['latitude'];
            $longtitude = $post['longtitude'];
            $km = $post['km'];
			$tgl_awal = $post['tgl_awal'];
			$tgl_akhir = $post['tgl_akhir'];
                        
            }	
				 
                if ($idDbSimtax == '38'){
                    $connDb = 'simtax_integration';
                }else{
                    $connDb = 'simtax_integration';
                }

				$data = $this->M_callcenter->getDataDetail($connDb,$latitude,$longtitude,$km,$tgl_awal,$tgl_akhir);
                $this->load->view('header');
                $this->load->view('CALLCENTER/V_callcenter', Array('data'=>$data));
                $this->load->view('footer');   
        }
    }
?>