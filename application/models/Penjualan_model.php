<?php

class Penjualan_model extends CI_Model {	

	function data($date, $dateakhir, $id_status_invoice, $pool_id){
        $res = $this->db->query("select a.id, a.created_dt, a.number_code, a.no_pintu_lama, a.no_pintu, a.no_polisi, 
			a.tipe, a.tahun, a.no_rangka, a.no_mesin, a.lokasi, a.keterangan, b.name as pool_name, a.status
			from ms_vehicle a
			left join master_pool b on(b.id=a.pool_id)
			order by a.number_code asc;")->result_array();
        return $res;
    }
	
	function data_pool(){
        $res = $this->db->query("select * from master_pool order by name;")->result_array();
        return $res;
    }

	function data_edit($id){
        $res = $this->db->query("select a.id, a.created_dt, a.number_code, a.no_pintu_lama, a.no_pintu, a.no_polisi, 
			a.tipe, a.tahun, a.no_rangka, a.no_mesin, a.lokasi, a.keterangan, b.name as pool_name, a.status, a.pool_id
			from ms_vehicle a
			left join master_pool b on(b.id=a.pool_id)
			where  a.id=".$id." ;")->row_array();
			
		//print_r($res);die;
        return $res;
    }
	
	function update($post){
		$array = array(
			'updated_dt' => date('Y-m-d h:i:d'),
			'updated_by' => $this->user['id'],
			'number_code' => $post['number_code'],
			'no_pintu_lama' => $post['no_pintu_lama'],
			'no_pintu' => $post['no_pintu'],
			'no_polisi' => $post['no_polisi'],
			'tipe' => $post['tipe'],
			'tahun' => $post['tahun'],
			'no_rangka' => $post['no_rangka'],
			'no_mesin' => $post['no_mesin'],
			'lokasi' => $post['lokasi'],
			'pool_id' => $post['pool_id'],
			'keterangan' => $post['keterangan'],
			'status' => $post['status']
		);

		$this->db->set($array);
		$this->db->where('id', $post['id']);
		$this->db->update('ms_vehicle');
		
		return $this->db->affected_rows();
	}
}
?>