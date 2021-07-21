<?php

class kasir_model extends CI_Model {	


    public function M_truncate(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
                $res = $this->db->query(" truncate table sun_trx_head_jurnal ");
    }
	//input CT start
	function countDataCtPool($no_ct, $connDb){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res = $this->db->query("select * from ms_credit_ticket where ct_no  in( ".$no_ct." ) limit 1;")->num_rows();
		return $res;
	}
        
        function countDataCtPusat($no_ct){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
                $res = $this->db->query("select * from ms_credit_ticket where ct_no  in( ".$no_ct." ) limit 1;")->num_rows();
		return $res;
	}
        
        function getDataCtPusat($no_ct){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
                $res = $this->db->query("select ct_no, ct_released_date, costumer_id, costumer_name, trid, trcode, trdate, setoran_code, spj_code, used_date, used_by, used_value, used_poolid, used_ptid, driver_id, driver_name, car_id, no_pintu, status_invoice, no_invoice, purpose, status_double from ms_credit_ticket where ct_no  in( ".$no_ct." ) limit 1;")->result_array();
		return $res;
	}
        
        function insertCtPool($connDb,$username,$ct_no){
            $CI = &get_instance();
            $this->db = $CI->load->database('simtax_pusat', TRUE);
            $res = $this->db->query("select ct_no, ct_released_date, costumer_id, costumer_name, trid, trcode, trdate, setoran_code, spj_code, used_date, used_by, used_value, used_poolid, used_ptid, driver_id, driver_name, car_id, no_pintu, status_invoice, no_invoice, purpose, status_double from ms_credit_ticket where ct_no  in( ".$ct_no." ) limit 1;");

            $this->db = $CI->load->database($connDb, TRUE);
           foreach ($res->result() as $row) {
           $res = $this->db->insert('ms_credit_ticket',$row);
            }
            
             $CI = &get_instance();
             $this->db = $CI->load->database('default', TRUE);
             $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'inputCt', '".$ct_no."', now());");

            return $res;
		}
	
	//input CT end
	
	//adjustment tidak ada di pusat start
	
	function countDataAdjPool($connDb, $no_adj ){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res = $this->db->query("select * from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->num_rows();
		return $res;
	}
	
	function countDataAdjPusat($no_adj){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
                $res = $this->db->query("select * from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->num_rows();
		return $res;
	}
	
	function getKipAdjPool($connDb,$no_adj){
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);

        $res = $this->db->query("select kip from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->row()->kip;
        return $res;
    }
	
	function getKipAdjPusat($no_adj){
        $CI = &get_instance();
        $this->db = $CI->load->database('simtax_pusat', TRUE);

        $res = $this->db->query("select kip from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->row()->kip;
        return $res;
    }
	
	function getAmountAdjPool($connDb,$no_adj){
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);

        $res = $this->db->query("select total_adjusment from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->row()->total_adjusment;
        return $res;
    }
	
	function getAmountAdjPusat($no_adj){
        $CI = &get_instance();
        $this->db = $CI->load->database('simtax_pusat', TRUE);

        $res = $this->db->query("select total_adjusment from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->row()->total_adjusment;
        return $res;
    }
	
	function insertAdjPusat($connDb,$username,$no_adj){
            $CI = &get_instance();
            $this->db = $CI->load->database($connDb, TRUE);
            $res = $this->db->query("select TRID, PTID, POOLID, ADJCODE, TANGGAL_ADJ, KIP, NAMA, TIPE_KOREKSI, TYPE_PENGEMUDI, POSTED, POSTED_BY, POSTED_DATE, NOTE, TOTAL_ADJUSMENT, REFF_CODE, RELEASED, PRINTED, IMPACT from trx_koreksi_ar_driver where ADJCODE  in( '".$no_adj."' ) limit 1;");
			$res1 = $this->db->query("select trx_name, user_approval, trx_code, status_approval, approval_datetime from trx_list_approval where trx_code  in( '".$no_adj."' );");

			
			
           $this->db = $CI->load->database('simtax_pusat', TRUE);
           foreach ($res->result() as $row) {
           $res = $this->db->insert('trx_koreksi_ar_driver',$row);
            }
						
           foreach ($res1->result() as $row1) {
           $res1 = $this->db->insert('trx_list_approval',$row1);
            }
            
             $CI = &get_instance();
             $this->db = $CI->load->database('default', TRUE);
             $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'ajdTidakAdaDiPusat', '".$no_adj."', now());");

            return $res;
		}
	//adjustment tidak ada di pusat end

        //  function countDataAdjPool($connDb, $no_adj ){
        //             $CI = &get_instance();
        //             $this->db = $CI->load->database($connDb, TRUE);
        //             $res = $this->db->query("select * from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->num_rows();
        //     return $res;
        // }
        
        function DataAdjPusat($no_adj){
                    $CI = &get_instance();
                    $this->db = $CI->load->database('simtax_pusat', TRUE);
                    $res = $this->db->query("select * from trx_koreksi_ar_driver where POSTED='2' AND ADJCODE = '".$no_adj."';")->num_rows();
            return $res;
        }

        function insertAdjPool($connDb,$username,$no_adj){
            $CI = &get_instance();
            $this->db = $CI->load->database($connDb, TRUE);
            $res = $this->db->query("UPDATE trx_koreksi_ar_driver SET posted='2' WHERE ADJCODE IN ( '".$no_adj."' ) ;");
            //$res1 = $this->db->query("UPDATE trx_list_approval SET status_approval=2 WHERE trx_code IN ( '".$no_adj."' );");

            
            return $res;
           // $this->db = $CI->load->database($connDb, TRUE);
           // foreach ($res->result() as $row) {
           // $res = $this->db->insert('trx_koreksi_ar_driver',$row);
           //  }
                        
           // foreach ($res1->result() as $row1) {
           // $res1 = $this->db->insert('trx_list_approval',$row1);
           //  }
            
             $CI = &get_instance();
             $this->db = $CI->load->database('default', TRUE);
             $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'ajdTidakAdaDiPool', '".$no_adj."', now());");

            return $res;
        }


    function countDataAdjPool_armada($connDb, $no_adj ){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res = $this->db->query("select * from trx_koreksi_ar_armada where TRCODE = '".$no_adj."';")->num_rows();
        return $res;
    }
    
    function countDataAdjPusat_armada($no_adj){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
                $res = $this->db->query("select * from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->num_rows();
        return $res;
    }
    
    function getKipAdjPool_armada($connDb,$no_adj){
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);

        $res = $this->db->query("select kip from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->row()->kip;
        return $res;
    }
    
    function getKipAdjPusat_armada($no_adj){
        $CI = &get_instance();
        $this->db = $CI->load->database('simtax_pusat', TRUE);

        $res = $this->db->query("select kip from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->row()->kip;
        return $res;
    }
    
    function getAmountAdjPool_armada($connDb,$no_adj){
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);

        $res = $this->db->query("select total_adjusment from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->row()->total_adjusment;
        return $res;
    }
    
    function getAmountAdjPusat_armada($no_adj){
        $CI = &get_instance();
        $this->db = $CI->load->database('simtax_pusat', TRUE);

        $res = $this->db->query("select total_adjusment from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->row()->total_adjusment;
        return $res;
    }
    
    function insertAdjPusat_armada($connDb,$username,$no_adj){
            $CI = &get_instance();
            $this->db = $CI->load->database($connDb, TRUE);
            $res = $this->db->query("select TRID, PTID, POOLID, ADJCODE, TANGGAL_ADJ, KIP, NAMA, TIPE_KOREKSI, TYPE_PENGEMUDI, POSTED, POSTED_BY, POSTED_DATE, NOTE, TOTAL_ADJUSMENT, REFF_CODE, RELEASED, PRINTED, IMPACT from trx_koreksi_ar_driver where ADJCODE  in( '".$no_adj."' ) limit 1;");
            $res1 = $this->db->query("select trx_name, user_approval, trx_code, status_approval, approval_datetime from trx_list_approval where trx_code  in( '".$no_adj."' );");

            
            
           $this->db = $CI->load->database('simtax_pusat', TRUE);
           foreach ($res->result() as $row) {
           $res = $this->db->insert('trx_koreksi_ar_driver',$row);
            }
                        
           foreach ($res1->result() as $row1) {
           $res1 = $this->db->insert('trx_list_approval',$row1);
            }
            
             $CI = &get_instance();
             $this->db = $CI->load->database('default', TRUE);
             $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'ajdTidakAdaDiPusat', '".$no_adj."', now());");

            return $res;
        }
    //adjustment tidak ada di pusat end

        //  function countDataAdjPool($connDb, $no_adj ){
        //             $CI = &get_instance();
        //             $this->db = $CI->load->database($connDb, TRUE);
        //             $res = $this->db->query("select * from trx_koreksi_ar_driver where ADJCODE = '".$no_adj."';")->num_rows();
        //     return $res;
        // }
        
        function DataAdjPusat_armada($no_adj){
                    $CI = &get_instance();
                    $this->db = $CI->load->database('simtax_pusat', TRUE);
                    $res = $this->db->query("select * from trx_koreksi_ar_driver where POSTED='2' AND ADJCODE = '".$no_adj."';")->num_rows();
                    return $res;
        }

        function insertAdjPool_armada($connDb,$username,$no_adj){
            $CI = &get_instance();
            $this->db = $CI->load->database($connDb, TRUE);
            $res = $this->db->query("UPDATE trx_koreksi_ar_driver SET posted='2' WHERE ADJCODE IN ( '".$no_adj."' ) ;");
            //$res1 = $this->db->query("UPDATE trx_list_approval SET status_approval=2 WHERE trx_code IN ( '".$no_adj."' );");

            
            return $res;
           // $this->db = $CI->load->database($connDb, TRUE);
           // foreach ($res->result() as $row) {
           // $res = $this->db->insert('trx_koreksi_ar_driver',$row);
           //  }
                        
           // foreach ($res1->result() as $row1) {
           // $res1 = $this->db->insert('trx_list_approval',$row1);
           //  }
            
             $CI = &get_instance();
             $this->db = $CI->load->database('default', TRUE);
             $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'ajdTidakAdaDiPool', '".$no_adj."', now());");

            return $res;
        }

         public function DataArDriverPusat($nokip){

            $CI = &get_instance();
            $this->db = $CI->load->database('simtax_pusat', TRUE);
            $res = $this->db->query("select ms_period.startdt,ar_driver.PERIODEID,
                ar_driver.PTID,ar_driver.POOLID , ar_driver.NO_KIP,
                ar_driver.NAMA_PENGEMUDI,ar_driver.AR_SALDO_AWAL,
                ar_driver.AR_PLUS,ar_driver.AR_MINUS,ar_driver.AR_SALDO_AKHIR
                FROM ar_driver 
                LEFT JOIN ms_period ON ar_driver.PERIODEID = ms_period.PERIODID
                where ar_driver.no_kip = '".$nokip."' 
                ORDER BY ar_driver.periodeid DESC LIMIT 1;")->result_array();
            return $res;
        }

        public function DataArDriver($connDb,$nokip){

            $CI = &get_instance();
            $this->db = $CI->load->database($connDb,TRUE);
            $res = $this->db->query("select ms_period.startdt,ar_driver.PERIODEID,
                ar_driver.PTID,ar_driver.POOLID , ar_driver.NO_KIP,
                ar_driver.NAMA_PENGEMUDI,ar_driver.AR_SALDO_AWAL,
                ar_driver.AR_PLUS,ar_driver.AR_MINUS,ar_driver.AR_SALDO_AKHIR
                FROM ar_driver 
                LEFT JOIN ms_period ON ar_driver.PERIODEID = ms_period.PERIODID
                where ar_driver.no_kip = '".$nokip."' 
                ORDER BY ar_driver.periodeid DESC LIMIT 1;")->result_array();
            return $res;
        }

         public function DataArArmada($connDb,$nomerpintu){

            $CI = &get_instance();
            $this->db = $CI->load->database($connDb,TRUE);
            $res = $this->db->query("SELECT  PERIOD_ID, ms_period.STARTDT as BULAN,MS_PT.PTFULLNAME AS PT,MS_POOL.POOLFULLNAME,OWNER_PT_ID,POOL_ID,CAR_ID,NO_PINTU,KIP_OWNER,NAMA_OWNER,
             AR_KS_SALDO_AWAL,AR_KS_BULAN_INI_PLUS,AR_KS_BULAN_INI_MINUS,AR_KS_SALDO_AKHIR,AR_TABSP_SALDO_AWAL,
             AR_TABSP_BULAN_INI_PLUS,AR_TABSP_BULAN_INI_MINUS,AR_TABSP_SALDO_AKHIR,AR_LAIN_SALDO_AWAL,
             AR_LAIN_BULAN_INI_PLUS,AR_LAIN_BULAN_INI_MINUS,AR_LAIN_SALDO_AKHIR
             FROM ar_armada
             LEFT JOIN ms_period ON ar_armada.PERIOD_ID = ms_period.PERIODID
             LEFT JOIN ms_pt ON ar_armada.OWNER_PT_ID = ms_pt.PTID
             LEFT JOIN ms_pool ON ar_armada.POOL_ID = ms_pool.POOLID
             WHERE no_pintu ='".$nomerpintu."'  ORDER BY ar_armada.PERIOD_ID DESC LIMIT 1;")->result_array();
            return $res;
        }

        public function MaxId($connDb){
            
            $CI = &get_instance();
            $this->db = $CI->load->database($connDb,TRUE);
            $res = $this->db->query("SELECT MAX(periodid) AS PERIODID FROM ms_period")->result_array();
            return $res;
        }

         public function MaxIdPusat($connDb){
            
            $CI = &get_instance();
            $this->db = $CI->load->database('simtax_pusat', TRUE);;
            $res = $this->db->query("SELECT MAX(periodid) AS PERIODID FROM ms_period")->result_array();
            return $res;
        }

        public function InsertDataArDriverPusat($insert){
            $CI = &get_instance();
            $this->db = $CI->load->database('simtax_pusat', TRUE);
            $res = $this->db->insert('ar_driver',$insert);
        }

        public function InsertDataArDriver($connDb,$insert){
            $CI = &get_instance();
            $this->db = $CI->load->database($connDb,TRUE);
            $res = $this->db->insert('ar_driver',$insert);
        }

        public function InsertDataArArmada($connDb,$insert){
            $CI = &get_instance();
            $this->db = $CI->load->database($connDb,TRUE);
            $res = $this->db->insert('ar_armada',$insert);
        }

}

