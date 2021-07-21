<?php

class checker_model extends CI_Model {	


    function insertDataMoce(
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
                            	$ban_cadangan,
                            	$rds,
                            	$struk_argo,
                            	$jok,
                            	$seat_belt,
                            	$ac,
                            	$aroma_kabin){
                
                 $CI = &get_instance();
                 $this->db = $CI->load->database('default', TRUE);
                 $this->db->query("INSERT INTO public.moce_regular VALUES(nextval('log_proses_id_seq'),
                     '".$tglSpjProses."', 
                     '".$noPintuProses."', 
                     '".$pool_id."', 
                     '".$val_ritase."',
                     '".$val_drop."',
                     '".$val_km_argo."',
                     '".$val_km_speedo."',
                     '".$val_fix_part."',
                     '".$username."',
                     now(),
                 	 '".$lampu_mahkota."',
                 	 '".$stiker_no_pintu."',
                 	 '".$logo_express."',
                 	 '".$no_call_center."',
                 	 '".$lampu_depan."',
                 	 '".$lampu_belakang."',
                 	 '".$lampu_rem."',
                 	 '".$lampu_sign."',
                 	 '".$stiker_minimum_payment."',
                 	 '".$lampu_led."',
                 	 '".$argometer."',
                 	 '".$aksesoris_tidak_standar."',
                 	 '".$kebersihan."',
                 	 '".$karpet_kaki."',
                 	 '".$ban_cadangan."',
                 	 '".$rds."',
                 	 '".$struk_argo."',
                 	 '".$jok."',
                 	 '".$seat_belt."',
                 	 '".$ac."',
                 	 '".$aroma_kabin."',
                     '".$stnk."',
                     '".$keur."',
                     '".$kp."',
                     '".$tera."'
                 	);");
             
                return $res;
    }
	
	function getDataActivityChecker($date)
		{
		
			$CI = &get_instance();
			$this->db = $CI->load->database('default', TRUE);
    		$res = $this->db->query("select * from moce_regular where tgl_spj = '".$date."' ;")->result_array();
    		return $res;
		}
	function getDataActivityChecker1($date,$date1){
		
		
		$CI = &get_instance();
                $this->db = $CI->load->database('default', TRUE);
		$res = $this->db->query ("select * from moce_regular where tgl_spj >= '".$date."' and tgl_spj <= '".$date1."';")->result_array();
		return $res;
	}
	
	function getDataPenghitaman(){
		
		
		$CI = &get_instance();
         $this->db = $CI->load->database('simtax_pusat', TRUE);
		$res = $this->db->query ("select * from trx_operasi_armada where SPJ_DATE = '2018-10-1' and POOL_ID = 38 and OWNER_PT_ID = 3;")->result_array();
		return $res;
	}
  
   
}

