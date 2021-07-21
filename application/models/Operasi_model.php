<?php

class operasi_model extends CI_Model {	


    function getNoPintuDup($connDb,$noPintu){
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);

        $res = $this->db->query("SELECT COUNT(0) AS hitung  FROM trx_operasi_armada where SPJ_DATE = CURDATE() and NO_PINTU  = '".$noPintu."'")->row()->hitung;
        return $res;
    }


        function updateDuplicat($connDb, $username, $noPintu){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res  = $this->db->query("update trx_operasi_armada set STATUS_OPERASI  = 0, POSTED = 1 where SPJ_DATE = CURDATE() and NO_PINTU  = '".$noPintu."';");
        
                 $CI = &get_instance();
                 $this->db = $CI->load->database('default', TRUE);
                 $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'Duplicat SPJ', '".$noPintu."', now());");
             
                return $res;
    }

    function getNoPintuBs($connDb,$noPintu){
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);

        $res = $this->db->query("SELECT COUNT(0) AS hitung FROM ms_armada WHERE NO_PINTU = '".$noPintu."'")->row()->hitung;
        return $res;
    }

    function getDataBs($connDb,$noPintu, $periodMonthProses){
		$yearmonth = date('Y-m');
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);

        $res = $this->db->query("select status_bebas_setor  from trx_operasi_armada WHERE NO_PINTU = '".$noPintu."' AND SPJ_DATE='".$yearmonth."-".$periodMonthProses."';")->row()->status_bebas_setor;
        return $res;
    }

  function getTotalSetor1($connDb,$noPintu, $periodMonthProses){
		$yearmonth = date('Y-m');
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);
		
		if ($periodMonthProses == '5')
		{
			$tglAwal ='01';
		} else if ($periodMonthProses == '10')
        {
            $tglAwal = '05';
        } else if ($periodMonthProses == '15')
        {
            $tglAwal = '10';
        } else if ($periodMonthProses == '20')
        {
            $tglAwal = '15';
        } else if ($periodMonthProses == '25')
        {
            $tglAwal = '20';
        } else if ($periodMonthProses == '30')
        {
            $tglAwal = '25';
        }

        $res = $this->db->query("select ifnull(sum(total_terima-s_lain-10000-terima_denda),0) as setor1 from trx_setoran
        where SPJ_DATE >= '".$yearmonth."-".$tglAwal."' and SPJ_DATE <'".$yearmonth."-".$periodMonthProses."' and NO_PINTU = '".$noPintu."' ")->row()->setor1;
        return $res;
    }

     function getTotalSetor2($connDb,$noPintu, $periodMonthProses){
		 $year = date('Y');
		 $yearmonth = date('Y-m');
        $CI = &get_instance();
        $this->db = $CI->load->database($connDb,TRUE);
		
		if ($periodMonthProses == '5')
		{
			$tglAwal ='1';
			$firstDate = '2';
			$secondDate = '3';
			$thirdDate = '4';
			$fourthDate = '5';
		} else if ($periodMonthProses == '10')
        {
            $tglAwal = '5';
			$firstDate = '6';
			$secondDate = '7';
			$thirdDate = '8';
			$fourthDate = '9';
        } else if ($periodMonthProses == '15')
        {
            $tglAwal = '10';
			$firstDate = '11';
			$secondDate = '12';
			$thirdDate = '13';
			$fourthDate = '14';
        } else if ($periodMonthProses == '20')
        {
            $tglAwal = '15';
			$firstDate = '16';
			$secondDate = '17';
			$thirdDate = '18';
			$fourthDate = '19';
        } else if ($periodMonthProses == '25')
        {
            $tglAwal = '20';
			$firstDate = '21';
			$secondDate = '22';
			$thirdDate = '23';
			$fourthDate = '24';
        } else if ($periodMonthProses == '30')
        {
            $tglAwal = '25';
			$firstDate = '26';
			$secondDate = '27';
			$thirdDate = '28';
			$fourthDate = '29';
        }

        $res = $this->db->query("select ifnull(sum(ar_ks_saldo_koreksi),0)  as setor2 from trx_koreksi_ar_armada
        where trdate >= '".$yearmonth."-".$tglAwal."' and trdate <='".$yearmonth."-".$fourthDate."'  and NO_PINTU = '".$noPintu."' and posted = 3 
		and (notes like '%".$firstDate."%".$year."%' or notes like '%".$secondDate."%".$year."%' or notes like '%".$thirdDate."%".$year."%' or notes like '%".$fourthDate."%".$year."%' or notes like '%ks%');")->row()->setor2;
        return $res;
    }

     function updateBukaBs($connDb, $username, $noPintu, $periodMonthProses){
				$yearmonth = date('Y-m');
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res  = $this->db->query(" UPDATE trx_operasi_armada SET S_WAJIB=0,S_TAB_WAJIB=0,STATUS_BEBAS_SETOR=1 WHERE NO_PINTU = '".$noPintu."'
                AND spj_date='".$yearmonth."-".$periodMonthProses."' AND posted!=2;"); 
				
        
                 $CI = &get_instance();
                 $this->db = $CI->load->database('default', TRUE);
                 $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'bukaBs', '".$noPintu."+".$periodMonthProses."', now());");
             
                return $res;
    }

	       
        function getPeriodMonth(){
                $CI = &get_instance();
                $this->db = $CI->load->database('simtax_pusat', TRUE);
                //$res = $this->db->query("select periodid from ms_period where startdt = DATE_SUB(DATE(NOW()),INTERVAL (DAY(NOW())-1) DAY);")->row()->periodid;
				$res = $this->db->query("select periodid from ms_period where periodid = 114;")->row()->periodid;

		return $res;
	}
        
        function getDataSos($connDb, $noPintu, $periodMonth){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
				//$res = $this->db->query("SELECT count(0) as jumlah FROM ar_armada_murni WHERE NO_PINTU = '".$noPintu."' and period_id = ".$periodMonth.";")->row()->jumlah;
				$res = $this->db->query("SELECT count(0) as jumlah FROM ar_armada_murni WHERE NO_PINTU = '".$noPintu."' and period_id = 114;")->row()->jumlah;
		return $res;
	}
	
		function getDataArArmadaMurni($connDb, $noPintu, $periodMonth){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
				$res = $this->db->query("SELECT count(0) as jumlah FROM ar_armada_murni WHERE NO_PINTU = '".$noPintu."' and period_id = ".$periodMonth.";")->row()->jumlah;
				return $res;
		}
		
		function getDataKsBulanLalu($connDb, $noPintu, $periodMonth){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
				$res = $this->db->query("select ifnull(sum(ifnull(AR_KS_SALDO_AKHIR,0)),0) as jumlah from ar_armada_murni WHERE NO_PINTU = '".$noPintu."' and period_id = (".$periodMonth." - 1);")->row()->jumlah;
				return $res;
		}
		
		function getDataKsTerbit($connDb, $noPintu, $dateStart, $dateEnd){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
				$res = $this->db->query("select ifnull((sum(ifnull(b.total_ks_terbit,0)) * -1),0) as jumlah from trx_operasi_armada a left join trx_setoran b on (a.SPJ_DATE = b.SPJ_DATE and a.NO_PINTU = b.NO_PINTU)
										 where a.spj_date >= '".$dateStart."' and a.spj_date < '".$dateEnd."'
										 and a.no_pintu = '".$noPintu."' and a.STATUS_BEBAS_SETOR = 0 and a.STATUS_OPERASI = 0 and b.TOTAL_KS_TERBIT < 0;")->row()->jumlah;
				return $res;
		}
		
		function getDataBayarKs1($connDb, $noPintu, $dateStart, $dateEnd){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
				$res = $this->db->query("select ifnull(sum(ifnull(b.total_ks_terbit,0)),0)  as jumlah from trx_operasi_armada a left join trx_setoran b on (a.SPJ_DATE = b.SPJ_DATE and a.NO_PINTU = b.NO_PINTU)
										 where a.spj_date >= '".$dateStart."' and a.spj_date < '".$dateEnd."'
										 and a.no_pintu = '".$noPintu."' and a.STATUS_OPERASI = 0 and b.TOTAL_KS_TERBIT > 0;")->row()->jumlah;
				return $res;
		}
		
		function getDataBayarKs2($connDb, $noPintu, $dateStart, $dateEnd){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
				$res = $this->db->query("select ifnull((sum(ifnull(AR_KS_SALDO_KOREKSI,0)) * -1),0) as jumlah from trx_koreksi_ar_armada 
										 where  TRDATE >= '".$dateStart."' and TRDATE < '".$dateEnd."' and no_pintu = '".$noPintu."' and posted = 3  and notes not like '%hitam%';")->row()->jumlah;
				return $res;
		}
	
	function cekDataSos($connDb, $noPintu){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res = $this->db->query("select count(0) as jumlah from trx_stop_operasi WHERE TRDATE >= '2017-11-1'
										 and posted = 3 and status = 0 and no_pintu = '".$noPintu."' ;")->row()->jumlah;
		return $res;
	}
        
        function getAmountSosBulan($connDb, $noPintu, $periodMonth){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                //$res = $this->db->query("SELECT ar_ks_bulan_ini_plus - ar_ks_bulan_ini_minus as saldobulanini FROM ar_armada_murni WHERE  no_pintu ='".$noPintu."' and period_id = ".$periodMonth.";")->row()->saldobulanini;
				$res = $this->db->query("SELECT ar_ks_bulan_ini_plus - ar_ks_bulan_ini_minus as saldobulanini FROM ar_armada_murni WHERE  no_pintu ='".$noPintu."' and period_id = 114;")->row()->saldobulanini;
                return $res;
	}
        
    function getAmountSosTotal($connDb, $noPintu, $periodMonth){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res  = $this->db->query("SELECT ar_ks_saldo_akhir as saldototal FROM ar_armada_murni WHERE  no_pintu = '".$noPintu."' and period_id = 114;")->row()->saldototal;
		return $res;
	}
	
	function getFirstDate($connDb, $noPintu){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res  = $this->db->query("select tanggal_mulai from ms_armada where NO_PINTU = '".$noPintu."' and STATUS_ARMADA = 0;")->row()->tanggal_mulai;
		return $res;
	}
	
	    
        function updateBukaSos($connDb, $username, $noPintu){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res  = $this->db->query("update trx_stop_operasi  set posted = 4 and status = 1  WHERE TRDATE >= '2017-11-1' and posted = 3 and status = 0 and no_pintu = '".$noPintu."';");
		
                 $CI = &get_instance();
                 $this->db = $CI->load->database('default', TRUE);
                 $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'bukaSos', '".$noPintu."', now());");
             
                return $res;
		}
		
		function updateSyncArMurni($connDb, $username, $noPintu, $periodMonth, $ksAwal, $ksTerbit, $ksBayar, $ksAkhir){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res  = $this->db->query("update ar_armada_murni
									      set AR_KS_SALDO_AWAL = ".$ksAwal.", AR_KS_BULAN_INI_PLUS = ".$ksTerbit.", 
										  AR_KS_BULAN_INI_MINUS = ".$ksBayar.", AR_KS_SALDO_AKHIR = ".$ksAkhir."
										  where no_pintu = '".$noPintu."' and PERIOD_ID = ".$periodMonth." ;");
		
                 $CI = &get_instance();
                 $this->db = $CI->load->database('default', TRUE);
                 $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'syncArMurni', '".$noPintu."+".$ksAwal."+".$ksTerbit."+".$ksBayar."+".$ksAkhir."+".$periodMonth."', now());");
             
                return $res;
		}
		
		function insertArArmadaMurni($connDb, $username, $noPintu, $periodMonth){
				$periodMonthBefore = $periodMonth - 1;
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res  = $this->db->query("insert into ar_armada_murni
										  select ".$periodMonth.", OWNER_PT_ID, POOL_ID, CAR_ID, NO_PINTU, KIP_OWNER, NAMA_OWNER, AR_KS_SALDO_AKHIR, 0, 0, AR_KS_SALDO_AKHIR 
										  from ar_armada_murni where NO_PINTU ='".$noPintu."' and PERIOD_ID = ".$periodMonthBefore." ;");
		
                 $CI = &get_instance();
                 $this->db = $CI->load->database('default', TRUE);
                 $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'insertArMurni', '".$noPintu."+".$ksAwal."+".$ksTerbit."+".$ksBayar."+".$ksAkhir."+".$periodMonth."', now());");
             
                return $res;
		}
		
		
		function getDataBatalOperasi($connDb, $noPintu, $spjDate){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
				$res = $this->db->query("select count(0) as jumlah from trx_operasi_armada
										 where NO_PINTU = '".$noPintu."'  and SPJ_DATE = '".$spjDate."';")->row()->jumlah;
				return $res;
		}
		
		function updateBatalOperasi($connDb, $username, $noPintu, $spjDate, $alasanBatalOperasi){
                $CI = &get_instance();
                $this->db = $CI->load->database($connDb, TRUE);
                $res  = $this->db->query("update trx_operasi_armada
									      set status_operasi = 1
										  where NO_PINTU = '".$noPintu."'  and SPJ_DATE = '".$spjDate."';");
				
				$this->db->query("update trx_setoran
								  set status_operasi = 1
                                  where NO_PINTU = '".$noPintu."'  and SPJ_DATE = '".$spjDate."';");
								  
				$this->db->query("update trx_setoran
								  set TOTAL_DENDA = 0 , terima_denda = 0
								  where SPJ_date = '".$spjDate."' and NO_PINTU  = '".$noPintu."';");
								  
				$this->db->query("update trx_setoran
								  set TOTAL_KS_TERBIT = TOTAL_TERIMA - S_WAJIB - TERIMA_DENDA - S_CUCI - 10000
								  where SPJ_date = '".$spjDate."' and NO_PINTU  = '".$noPintu."' ;");	

				$this->db->query("update trx_setoran
								  set KS_ADJUSMENT = TOTAL_KS_TERBIT
								  where SPJ_date = '".$spjDate."'  and NO_PINTU  = '".$noPintu."' ;");	
								  
				$this->db->query("update trx_setoran
								  set JUMLAH_BAYAR_KS = TOTAL_KS_TERBIT
								  where SPJ_date = '".$spjDate."'  and NO_PINTU = '".$noPintu."' and TOTAL_KS_TERBIT > 0;");	
		
                 $CI = &get_instance();
                 $this->db = $CI->load->database('default', TRUE);
                 $this->db->query("INSERT INTO public.log_proses VALUES(nextval('log_proses_id_seq'), '".$username."', '".$connDb."', 'batalOperasi', '".$noPintu."+".$spjDate."+".$alasanBatalOperasi."', now());");
             
                return $res;
		}
       function getSetoran($connDb,$noPintu){
		

        $res = $this->db->query("select s_hari_biasa * 4  from ms_armada where NO_PINTU = '".$noPintu."' and STATUS_ARMADA = 0;")->row()->s_hari_biasa;
        return $res;
    }
}

