<?php

class Etaxi_model extends CI_Model {	

	function getSpjTodaySimtax(){
        $CI = &get_instance();
        $this->db = $CI->load->database('simtax_depok',TRUE);

        $res = $this->db->query("select count(0) as hitung from trx_operasi_armada where SPJ_DATE = curdate() and STATUS_OPERASI = 0;")->row()->hitung;
        return $res;
    }
	
	function getSpjTodaySimtax_pondok_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('simtax_pondok_bambu',TRUE);
		
		$res = $this->db->query("select count(0) as hitung from trx_operasi_armada where SPJ_DATE = curdate() and STATUS_OPERASI = 0;")->row()->hitung;
        return $res;
	}
	
	function get_detail_spj_today_simtax_depok(){
		$CI = &get_instance();
		$this->db = $CI->load->database('simtax_depok',TRUE);
		
		$res = $this->db->query("select no_pintu from trx_operasi_armada where SPJ_DATE = curdate() and STATUS_OPERASI = 0 order by no_pintu asc;");
        return $res->result_array();
	}
	
	function get_detail_spj_today_simtax_pondok_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('simtax_pondok_bambu',TRUE);
		
		$res = $this->db->query("select no_pintu from trx_operasi_armada where SPJ_DATE = curdate() and STATUS_OPERASI = 0 order by no_pintu asc;");
        return $res->result_array();
	}
	
	function get_detail_spj_today_etaxi_depok(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi',TRUE);
		
		$res = $this->db->query("select ms_vehicle.door_number from doc_spj 
			join ms_armada on (ms_armada.id=doc_spj.armada_id)
			join ms_vehicle on (ms_vehicle.id=ms_armada.vehicle_id)
			where doc_spj.created >= CURRENT_DATE and doc_spj.pool_id = 14 and doc_spj.status not in ('Cancelled') order by door_number asc;");
        return $res->result_array();
	}
	
	function get_detail_spj_today_etaxi_pondok_bambu(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi',TRUE);
		
		$res = $this->db->query("select ms_vehicle.door_number from doc_spj 
			join ms_armada on (ms_armada.id=doc_spj.armada_id)
			join ms_vehicle on (ms_vehicle.id=ms_armada.vehicle_id)
			where doc_spj.created >= CURRENT_DATE and doc_spj.pool_id = 18 and doc_spj.status not in ('Cancelled') order by door_number asc;");
        return $res->result_array();
	}
	
	function getSpjTodayEtaxi(){
        $CI = &get_instance();
        $this->db = $CI->load->database('etaxi',TRUE);

        $res = $this->db->query("select count(0) as hitung from doc_spj where created >=CURRENT_DATE and pool_id=14 and status not in ('Cancelled');")->row()->hitung;
        return $res;
    }
	
	function getSpjTodayEtaxi_pondok_bambu(){
        $CI = &get_instance();
        $this->db = $CI->load->database('etaxi',TRUE);

        $res = $this->db->query("select count(0) as hitung from doc_spj where created >=CURRENT_DATE and pool_id=18 and status not in ('Cancelled');")->row()->hitung;
        return $res;
    }
	
	
	function getSetoranTodaySimtax(){
        $CI = &get_instance();
        $this->db = $CI->load->database('simtax_depok',TRUE);

        $res = $this->db->query("select sum(TOTAL_TERIMA) as hitung from trx_setoran where setoran_date = curdate() ;")->row()->hitung;
        return $res;
    }
	
	function getSetoranTodaySimtax_pondok_bambu(){
        $CI = &get_instance();
        $this->db = $CI->load->database('simtax_pondok_bambu',TRUE);

        $res = $this->db->query("select sum(ifnull(IFNULL(a.TOTAL_TERIMA,0) + ifnull(b.NILAI_CUCI,0),0) + 
			IFNULL(CASE
				WHEN c.STICKER_BANDARA  = 1  THEN 15000
				ELSE 0
			end, 0)) as hitung
			from trx_setoran a
			left join trx_cuci b on (a.SPJ_CODE = b.SPJ_CODE)
			left join ms_armada c on (a.NO_PINTU = c.NO_PINTU)
			where setoran_date = curdate()  
			and a.TOTAL_TERIMA >0
			and c.STATUS_ARMADA = 0;")->row()->hitung;
        return $res;
    }
	
	function getSetoranTodayEtaxi(){
        $CI = &get_instance();
        $this->db = $CI->load->database('etaxi',TRUE);

        $res = $this->db->query("select sum(payment) as hitung from  trx_spj_m where created >=CURRENT_DATE and pool_id=14;")->row()->hitung;
        return $res;
    }
	
	function getSetoranTodayEtaxi_pondok_bambu(){
        $CI = &get_instance();
        $this->db = $CI->load->database('etaxi',TRUE);

        $res = $this->db->query("select sum(payment_cash) as hitung from  trx_spj_m where created >=CURRENT_DATE and pool_id=18;")->row()->hitung;
        return $res;
    }
	
	function getDetailSetoranTodayEtaxi_depok(){
        $CI = &get_instance();
        $this->db = $CI->load->database('etaxi',TRUE);

        $res = $this->db->query("select ms_vehicle.door_number, sum(trx_spj_m.payment) as payment from trx_spj_m 
			left join doc_spj on (trx_spj_m.spj_id = doc_spj.id)
			join ms_armada on (ms_armada.id=doc_spj.armada_id)
			join ms_vehicle on (ms_vehicle.id=ms_armada.vehicle_id)
			where trx_spj_m.created >=CURRENT_DATE and trx_spj_m.pool_id=14 group by ms_vehicle.door_number
			order by ms_vehicle.door_number asc;")->result_array();
        return $res;
    }
	
	function getDetailSetoranTodayEtaxi_pondok_bambu(){
        $CI = &get_instance();
        $this->db = $CI->load->database('etaxi',TRUE);

        $res = $this->db->query("select ms_vehicle.door_number, sum(trx_spj_m.payment) as payment from trx_spj_m 
			left join doc_spj on (trx_spj_m.spj_id = doc_spj.id)
			join ms_armada on (ms_armada.id=doc_spj.armada_id)
			join ms_vehicle on (ms_vehicle.id=ms_armada.vehicle_id)
			where trx_spj_m.created >=CURRENT_DATE and trx_spj_m.pool_id=18 group by ms_vehicle.door_number
			order by ms_vehicle.door_number asc;;")->result_array();
        return $res;
    }
	
	function getDetailSetoranTodaySimtax_pondok_bambu(){
		$CI = &get_instance();
        $this->db = $CI->load->database('simtax_pondok_bambu',TRUE);
		$res = $this->db->query("select a.no_pintu, ifnull(IFNULL(a.TOTAL_TERIMA,0) + ifnull(b.NILAI_CUCI,0),0) + 
			IFNULL(CASE
				WHEN c.STICKER_BANDARA  = 1  THEN 15000
				ELSE 0
			end, 0) as total_terima
			from trx_setoran a
			left join trx_cuci b on (a.SPJ_CODE = b.SPJ_CODE)
			left join ms_armada c on (a.NO_PINTU = c.NO_PINTU)
			where setoran_date = curdate()  
			and a.TOTAL_TERIMA >0
			and c.STATUS_ARMADA = 0
			group by a.no_pintu order by a.no_pintu asc;")->result_array();
        return $res;
	}
	
	function getDetailSetoranTodaySimtax_depok(){
		$CI = &get_instance();
        $this->db = $CI->load->database('simtax_depok',TRUE);
		$res = $this->db->query("select a.no_pintu, ifnull(IFNULL(a.TOTAL_TERIMA,0) + ifnull(b.NILAI_CUCI,0),0) + 
			IFNULL(CASE
				WHEN c.STICKER_BANDARA  = 1  THEN 15000
				ELSE 0
			end, 0) as total_terima
			from trx_setoran a
			left join trx_cuci b on (a.SPJ_CODE = b.SPJ_CODE)
			left join ms_armada c on (a.NO_PINTU = c.NO_PINTU)
			where setoran_date = curdate()  
			and a.TOTAL_TERIMA >0
			and c.STATUS_ARMADA = 0
			group by a.no_pintu order by a.no_pintu asc;")->result_array();
        return $res;
	}

	function wulingEtaxiPekapuran(){
        $CI = &get_instance();
        $this->db = $CI->load->database('etaxi',TRUE);

        $res = $this->db->query("select d.name , c.door_number, 'TP' as status from ar_setoran_wajib a
		left join ms_armada b on (a.armada_id = b.id)
		left join ms_vehicle c on (b.vehicle_id = c.id)
		left join sys_pool d on (a.pool_id = d.id)
		where a.created >=CURRENT_DATE and a.spj_id is null and a.armada_id not in (
		select armada_id from doc_spj
		where status = 'Active')
		and a.pool_id = 17
		union
		select d.name , c.door_number , 'SOS' as status from stg_daily_armada a
		left join ms_armada b on (a.armada_id = b.id)
		left join ms_vehicle c on (b.vehicle_id = c.id)
		left join sys_pool d on (a.pool_id = d.id)
		where a.created >=CURRENT_DATE 
		and a.status_pko ='Approved'
		and b.status ='Stop Operasi Sementara'
		and a.pool_id = 17
		order by 1 asc, 3 desc;")->result_array();
		return $res;
    }

    function wulingEtaxiPondokBambu(){
        $CI = &get_instance();
        $this->db = $CI->load->database('etaxi',TRUE);

        $res = $this->db->query("select d.name , c.door_number, 'TP' as status from ar_setoran_wajib a
		left join ms_armada b on (a.armada_id = b.id)
		left join ms_vehicle c on (b.vehicle_id = c.id)
		left join sys_pool d on (a.pool_id = d.id)
		where a.created >=CURRENT_DATE and a.spj_id is null and a.armada_id not in (
		select armada_id from doc_spj
		where status = 'Active')
		and a.pool_id = 18
		union
		select d.name , c.door_number , 'SOS' as status from stg_daily_armada a
		left join ms_armada b on (a.armada_id = b.id)
		left join ms_vehicle c on (b.vehicle_id = c.id)
		left join sys_pool d on (a.pool_id = d.id)
		where a.created >=CURRENT_DATE 
		and a.status_pko ='Approved'
		and b.status ='Stop Operasi Sementara'
		and a.pool_id = 18
		order by 1 asc, 3 desc;")->result_array();
		return $res;
    }
	

	function cari_kip($post){
		$CI = &get_instance();
		$this->dbdms = $CI->load->database('dms', TRUE);
		$res = $this->dbdms->query("select * from ms_driver where kip_number='".$post."'; ")->row_array();
		return $res;
	}
	
	function insert_photo($res){
		
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		//$res = $this->dbdms->query("update ms_driver set photo='".$res['photo']."' where kip_number='".$res['kip_number']."'; ");
		//$res = $this->db->query("update ms_driver set photo='".$res['photo']."' where kip_number='".$res['kip_number']."';")->affected_rows();
		
		$a = $this->db->set('photo', $res['photo']);
		$a = $this->db->where('kip_number', $res['kip_number']);
		$a = $this->db->update('ms_driver'); 
		$a = $this->db->affected_rows(); 
		if($a){
			?>
			<script type="text/javascript">
				alert("Data Berhasil Di Update.");
				window.location = "<?php echo site_url('/Etaxi/photo_kosong');?>";
			</script>
			<?php
		}else{
			echo 'gagal';die;
		}
	}
	
	function update_status_driver($post){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		
		$a = $this->db->set('status', $post['status']);
		$a = $this->db->where('kip_number', $post['kip']);
		$a = $this->db->update('ms_driver'); 
		$a = $this->db->affected_rows(); 
		if($a){
			?>
			<script type="text/javascript">
				alert("Data Berhasil Di Update.");
				window.location = "<?php echo site_url('/Etaxi/update_status_driver');?>";
			</script>
			<?php
		}else{
			echo 'gagal';die;
		}
	}
	
	function driver_management($post){
		$save = array();
		$save['name_user'] = $this->user['username'];
		$save['name_case'] = "DriverManagement - ".$post['status']." - ".$post['kip'];
		$save['key_case'] = $post['keterangan'];
		$save['tanggal_proses'] = date('Y-m-d h:i:d');
		
		$this->db->insert('log_proses', $save);
		$insert = $this->db->insert_id();
		
		
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		
		$a = $this->db->set('status', $post['status']);
		$a = $this->db->where('kip_number', $post['kip']);
		$a = $this->db->update('ms_driver'); 
		$a = $this->db->affected_rows(); 
		if($a){
			?>
			<script type="text/javascript">
				alert("Data Berhasil Di Update.");
				window.location = "<?php echo site_url('/Etaxi/driver_management');?>";
			</script>
			<?php
		}else{
			echo 'gagal';die;
		}
	}
	
	function data_pool(){
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		
		$query = $this->db->get('sys_pool')->result_array();
		return $query;
		// print_r($query);die;
	}
	
	function change_pool_driver($post){
		// print_r($post);die;
		$CI = &get_instance();
		$this->db = $CI->load->database('etaxi', TRUE);
		
		// UPDATE MS DRIVER
		$a = $this->db->set('pool_id', $post['pool']);
		$a = $this->db->where('kip_number', $post['kip']);
		$a = $this->db->update('ms_driver'); 
		$a = $this->db->affected_rows(); 
		if($a){
			// UPDATE DOC SRPB
			$b = $this->db->query("select b.pool_id, b.id from doc_srpb a 
				left join ms_driver b on(a.driver_id=b.id)
				where b.kip_number='".$post['kip']."';")->row_array();
			
			$update = $this->db->query("update doc_srpb set pool_id=".$b['pool_id']." where driver_id=".$b['id'].";");
			
			if($update){
				?>
			<script type="text/javascript">
				alert("Data Berhasil Di Update.");
				window.location = "<?php echo site_url('/Etaxi/change_pool_driver');?>";
			</script>
			<?php
			}else{
				echo 'gagal update doc_srpb';die;
			}
			
			?>
			<script type="text/javascript">
				alert("Data Berhasil Di Update.");
				window.location = "<?php echo site_url('/Etaxi/change_pool_driver');?>";
			</script>
			<?php
		}else{
			echo 'gagal update ms_driver';die;
		}
	}
	
	function update_path($res, $foto){
		$CI = &get_instance();
		$this->db = $CI->load->database('dms', TRUE);
		
		$query = $this->db->query("update ms_driver set photo='media/tmp2/".$foto.".jpg' where kip_number='".$res['kip_number']."' ");
	}
	
}

