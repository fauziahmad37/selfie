<?php
	
	class M_setoran extends CI_Model{

		public function getDataKSWulingBintaro($connDb){
			$CI = &get_instance();
			$this->db = $CI->load->database('simtax_bintaro',TRUE);
			$res = $this->db->query("SELECT NO_PINTU, NAMA_SETOR, TOTAL_KS_TERBIT FROM trx_setoran
			WHERE SPJ_DATE = CURDATE()-1 AND OWNER_PT_ID = 22 AND TOTAL_TERIMA >0 AND TOTAL_KS_TERBIT <0 ")->result_array();
			return $res;
		}

		public function getDataKSWulingCipayung($connDb){
			$CI = &get_instance();
			$this->db = $CI->load->database('simtax_cipayung',TRUE);
			$res = $this->db->query("SELECT NO_PINTU, NAMA_SETOR, TOTAL_KS_TERBIT FROM trx_setoran
			WHERE SPJ_DATE = CURDATE()-1 AND OWNER_PT_ID = 22 AND TOTAL_TERIMA >0 AND TOTAL_KS_TERBIT <0 ")->result_array();
			return $res;
		}
		public function getDataKSWulingCipendawa($connDb){
			$CI = &get_instance();
			$this->db = $CI->load->database('simtax_cipendawa',TRUE);
			$res = $this->db->query("SELECT NO_PINTU, NAMA_SETOR, TOTAL_KS_TERBIT FROM trx_setoran
			WHERE SPJ_DATE = CURDATE()-1 AND OWNER_PT_ID = 22 AND TOTAL_TERIMA >0 AND TOTAL_KS_TERBIT <0 ")->result_array();
			return $res;
		}
		public function getDataKSWulingJagakarsa($connDb){
			$CI = &get_instance();
			$this->db = $CI->load->database('simtax_jagakarsa',TRUE);
			$res = $this->db->query("SELECT NO_PINTU, NAMA_SETOR, TOTAL_KS_TERBIT FROM trx_setoran
			WHERE SPJ_DATE = CURDATE()-1 AND OWNER_PT_ID = 22 AND TOTAL_TERIMA >0 AND TOTAL_KS_TERBIT <0 ")->result_array();
			return $res;
		}

		public function getDataWulingBintaro($connDb){
			$CI = &get_instance();
			$this->db = $CI->load->database('simtax_bintaro',TRUE);
			$res = $this->db->query("SELECT CASE 
			WHEN STATUS_OPERASI=0 THEN 'SF'
			WHEN STATUS_OPERASI =1 THEN 'TP'
			WHEN STATUS_OPERASI = 4 THEN 'SOS'
			END AS STATUS_OPERASI, NO_PINTU FROM trx_operasi_armada WHERE STATUS_OPERASI IN ('1','4')  AND OWNER_PT_ID='22' AND spj_date= CURDATE() 
			ORDER BY status_operasi DESC")->result_array();
			return $res;
		}
		public function getDataWulingCipayung($connDb){
			$CI = &get_instance();
			$this->db = $CI->load->database('simtax_cipayung',TRUE);
			$res = $this->db->query("SELECT CASE 
			WHEN STATUS_OPERASI=0 THEN 'SF'
			WHEN STATUS_OPERASI =1 THEN 'TP'
			WHEN STATUS_OPERASI = 4 THEN 'SOS'
			END AS STATUS_OPERASI, NO_PINTU FROM trx_operasi_armada WHERE STATUS_OPERASI IN ('1','4')  AND OWNER_PT_ID='22' AND spj_date= CURDATE() 
			ORDER BY status_operasi DESC")->result_array();;
			return $res;
		}
		public function getDataWulingJagakarsa($connDb){
			$CI = &get_instance();
			$this->db = $CI->load->database('simtax_jagakarsa',TRUE);
			$res = $this->db->query("SELECT CASE 
			WHEN STATUS_OPERASI=0 THEN 'SF'
			WHEN STATUS_OPERASI =1 THEN 'TP'
			WHEN STATUS_OPERASI = 4 THEN 'SOS'
			END AS STATUS_OPERASI, NO_PINTU FROM trx_operasi_armada WHERE STATUS_OPERASI IN ('1','4')  AND OWNER_PT_ID='22' AND spj_date= CURDATE() 
			ORDER BY status_operasi DESC")->result_array();
			return $res;
		}
		public function getDataWulingCipendawa($connDb){
			$CI = &get_instance();
			$this->db = $CI->load->database('simtax_cipendawa',TRUE);
			$res = $this->db->query("SELECT CASE 
			WHEN STATUS_OPERASI=0 THEN 'SF'
			WHEN STATUS_OPERASI =1 THEN 'TP'
			WHEN STATUS_OPERASI = 4 THEN 'SOS'
			END AS STATUS_OPERASI, NO_PINTU FROM trx_operasi_armada WHERE STATUS_OPERASI IN ('1','4')  AND OWNER_PT_ID='22' AND spj_date= CURDATE() 
			ORDER BY status_operasi DESC")->result_array();;
			return $res;
		}


		public function getDataDetailSetoran ($connDb, $tgl_awal,$tgl_akhir){
			$CI = &get_instance();
	        $this->db = $CI->load->database($connDb,TRUE);
	        $res = $this->db->query("SELECT * FROM TRX_SETORAN WHERE SPJ_DATE>='$tgl_awal' AND SPJ_DATE <='$tgl_akhir'")->result_array();
	        return $res;
		}

		public function getDataDetailPenghitaman($connDb, $no_pintu){
			$CI = &get_instance();
	        $this->db = $CI->load->database($connDb,TRUE);
	
		
	        $res = $this->db->query("SELECT 
			trx_operasi_armada.SPJ_CODE, trx_operasi_armada.SPJ_DATE, trx_operasi_armada.NO_PINTU, trx_operasi_armada.KIP_SETOR,
			trx_operasi_armada.NAMA_SETOR,
			CASE 
			WHEN trx_operasi_armada.STATUS_OPERASI=0 THEN 'SF'
			WHEN trx_operasi_armada.STATUS_OPERASI=1 THEN 'TP'
			WHEN trx_operasi_armada.STATUS_OPERASI=2 THEN 'TL'
			WHEN trx_operasi_armada.STATUS_OPERASI=3 THEN 'LL'
			WHEN trx_operasi_armada.STATUS_OPERASI=4 THEN 'SOS'
			END AS STATUS_OPERASI, trx_operasi_armada.S_WAJIB, trx_setoran.TOTAL_TERIMA,
			trx_setoran.KS_ADJUSMENT 
			FROM trx_operasi_armada 
			LEFT JOIN trx_setoran ON (trx_operasi_armada.no_pintu = trx_setoran.no_pintu AND 
				trx_operasi_armada.SPJ_DATE =  trx_setoran.SPJ_DATE)
			WHERE trx_operasi_armada.no_pintu ='$no_pintu'")->result_array();
		
	        return $res;
		}


		public function getDataDetailOperasi($connDb, $no_pintu){
			$CI = &get_instance();
	        $this->db = $CI->load->database($connDb,TRUE);
	        $res = $this->db->query("SELECT ms_pool.POOLFULLNAME,ms_pt.PTFULLNAME,trx_stop_operasi.NO_PINTU,
			trx_stop_operasi.NAMA,trx_stop_operasi.KIP_OWNER,
			trx_stop_operasi.TGL_AWAL_SO,trx_stop_operasi.TGL_AKHIR_SO,trx_stop_operasi.SISA_HARI,
			trx_stop_operasi.NOTES FROM trx_stop_operasi 

			LEFT JOIN ms_pool ON ms_pool.`POOLID` = trx_stop_operasi.`POOL_ID`
			LEFT JOIN ms_pt ON ms_pt.`PTID` = trx_stop_operasi.`OWNER_PT_ID`
			WHERE no_pintu='$no_pintu'")->result_array();
	        return $res;
	    }

		public function getDataSetoran ($connDb, $date,$date1){
			$CI = &get_instance();
	        $this->db = $CI->load->database($connDb,TRUE);
	        $res = $this->db->query("SELECT * FROM TRX_SETORAN limit 1")->result_array();
	        return $res;
		}

		public function getDataXOne($connDb){

			$CI = &get_instance();
	        $this->db = $CI->load->database('x_one',TRUE);
	        $res = $this->db->query("SELECT to_char(driver_access.created,'YYYY-MM-DD') as tanggal, taxi.id,taxi.reg_no,driver_access.assignment_code, COALESCE(sum(payment_total),0) 
	        	FROM taxi 
	        	LEFT JOIN driver_access ON taxi.id = driver_access.taxi_id 
	        	LEFT JOIN trip ON driver_access.id = trip.driver_access_id 
	        	WHERE business_id='3' AND driver_access.created >= (CURRENT_DATE -2) AND driver_access.pool_id ='".$connDb."'
	        	GROUP BY to_char(driver_access.created,'YYYY-MM-DD'), taxi.id,taxi.reg_no,driver_access.assignment_code
	        	order by  taxi.reg_no asc, to_char(driver_access.created,'YYYY-MM-DD') asc ;")->result_array();
	        return $res;
		}

		public function getDataEagle($connDb){

			$CI = &get_instance();
	        $this->db = $CI->load->database('x_one',TRUE);
	        $res = $this->db->query("SELECT to_char(driver_access.created,'YYYY-MM-DD') as tanggal, taxi.id,taxi.reg_no,driver_access.assignment_code, COALESCE(sum(payment_total),0) 
	        	FROM taxi 
	        	LEFT JOIN driver_access ON taxi.id = driver_access.taxi_id 
	        	LEFT JOIN trip ON driver_access.id = trip.driver_access_id 
	        	WHERE business_id='5' AND driver_access.created >= (CURRENT_DATE -2) AND driver_access.pool_id ='".$connDb."'
	        	GROUP BY to_char(driver_access.created,'YYYY-MM-DD'), taxi.id,taxi.reg_no,driver_access.assignment_code
	        	order by  taxi.reg_no asc, to_char(driver_access.created,'YYYY-MM-DD') asc ;")->result_array();
	        return $res;
		}

		public function getDataHutangArmada($connDb,$no_kip){
			$CI = &get_instance();
	        $this->db = $CI->load->database($connDb,TRUE);
	        $res = $this->db->query("SELECT ms_period.STARTDT,ar_armada.* FROM ar_armada 
			LEFT JOIN ms_period ON ms_period.PERIODID = ar_armada.`PERIOD_ID` WHERE KIP_OWNER='$no_kip'")->result_array();
	        return $res;
		}

		public function insertReport($insert){
			//print_r($insert);die();
			  $username = $insert['username'];
			  $pool 	= $insert['pool'];
			  $no_pintu = $insert['no_pintu'];
			  $nama_driver = $insert['nama_driver'];
			  $jenis_perbaikan = $insert['jenis_perbaikan'];
			  $keterangan = $insert['keterangan'];
			  $CI = &get_instance();
              $this->db = $CI->load->database('default', TRUE);
              $res = $this->db->query("INSERT INTO tb_report_itms (username,created,pool,no_pintu,nama_driver,jenis_perbaikan,keterangan,status)
              	VALUES ('$username',now(),'$pool','$no_pintu','$nama_driver','$jenis_perbaikan','$keterangan','Aktif')");
              return $res;
		}

		public function dataReport($data,$username){
			$CI = &get_instance();
            $this->db = $CI->load->database('default', TRUE);
            $res = $this->db->query("SELECT id_report, username,to_char(created,'YYYY-MM-DD')as created,
            	pool,no_pintu,nama_driver,jenis_perbaikan,keterangan,status
             FROM tb_report_itms WHERE username = '$username' ORDER BY id_report DESC")->result_array();
	        return $res;

		}

		public function cekData($cek){
			  $username = $cek['username'];
			  $pool 	= $cek['pool'];
			  $no_pintu = $cek['no_pintu'];
			  $nama_driver = $cek['nama_driver'];
			  $jenis_perbaikan = $cek['jenis_perbaikan'];
			  $keterangan =$cek['keterangan'];
			  $CI = &get_instance();
              $this->db = $CI->load->database('default', TRUE);
              $res = $this->db->query("SELECT username,pool,no_pintu,nama_driver,jenis_perbaikan,keterangan FROM tb_report_itms 
              WHERE username = '$username'  AND no_pintu = '$no_pintu' AND 
              jenis_perbaikan = '$jenis_perbaikan'  AND status='Aktif' ")->result_array();
	         return $res;
		}

		public function updateStatusModel($id){
			  $CI = &get_instance();
              $this->db = $CI->load->database('default', TRUE);
              $res = $this->db->query("UPDATE tb_report_itms SET created_finish=now(), status='Done'
              WHERE id_report='$id' AND status='Aktif' ");
	          return $res;
		}

		public function statusReport($id){
			 $CI = &get_instance();
             $this->db = $CI->load->database('default', TRUE);
             $res = $this->db->query(" SELECT status FROM tb_report_itms WHERE id_report ='$id'")->result_array();
	         // print_r($res);die();
	         return $res;

		}

		public function dataRekap($data){
			$CI = &get_instance();
            $this->db = $CI->load->database('default', TRUE);
            $res = $this->db->query("SELECT id_report, username,to_char(created,'YYYY-MM-DD HH24:MI')as created,
            	pool,no_pintu,nama_driver,jenis_perbaikan,keterangan,
            	to_char(created_finish,'YYYY-MM-DD HH24:MI')as created_finish,status
             FROM tb_report_itms  ")->result_array();
	        return $res;

		}
	}
?>