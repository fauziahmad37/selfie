<?php

class Bus_model extends CI_Model {
	public function checklist_bus_header_save($post){
		$save = array();
		$save['police_number'] = $post['no_polisi'];	
		$save['body_number'] = $post['no_body'];	
		$save['driver_name'] = $post['nama_driver'];	
		$save['created_dt']= date('Y-m-d h:i:d');
		$save['created_by']= $this->user['username']; 
		$save['date'] = date('Y-m-d 00:00:00');	
		$save['out_dt'] = $post['jam_out'];	
		$save['status'] = 'active';
		$this->db->insert('checklist_bus_header', $save);
		$insert = $this->db->insert_id();
		return $insert;
	}
	
	public function get_header($id){
		$res = $this->db->query("select * from checklist_bus_header where id=".$id."; ");
		return $res->row_array();
	}
	
	public function save_detail($id_header, $pertanyaan, $jawaban, $keterangan){
		$save = array();
		$save['checklist_bus_header_id'] = $id_header;
		$save['master_checklist_bus_id'] = $pertanyaan;
		$save['notes_out'] = $keterangan;
		$save['out'] = $jawaban;
		$save['created_dt'] = date('Y-m-d h:i:d');
		$this->db->insert('checklist_bus_detail', $save);
		$insert = $this->db->insert_id();
		return $insert;
	}
	
	public function save_km_bbm($post){
		
		$save = array();
		if($post['km_in'] == '' && $post['km_out'] !== '' ){
			
			$save['km_out'] = $post['km_out'];
			$save['bbm_out'] = $post['bbm_out'];
		} else {
			$save['km_in'] = $post['km_in'];
			$save['bbm_in'] = $post['bbm_in'];
		}
		// print_r($post['id']);die;
		$this->db->where('id', $post['id']);
		$this->db->update('checklist_bus_header', $save);
		
		$updated_status = $this->db->affected_rows();
		
		return $updated_status;
		
	}
	
	
	public function update_detail($id_header, $pertanyaan, $jawaban, $keterangan){
		$data = array(
				'in' => $jawaban,
				'notes_in' => $keterangan,
				'updated_dt' => date('Y-m-d h:i:d')
		);

		$this->db->where('checklist_bus_header_id', $id_header);
		$this->db->where('master_checklist_bus_id', $pertanyaan);
		$this->db->update('checklist_bus_detail', $data);
		
		$updated_status = $this->db->affected_rows();
		return $updated_status;
	}
	
	public function update_header($id_header, $in_dt){
		$data = array(
				'status' => 'closed',
				'updated_dt' => date('Y-m-d h:i:d'),
				'updated_by' => $this->user['username'],
				'in_dt' => $in_dt
		);
		
		$this->db->where('id', $id_header);
		$this->db->update('checklist_bus_header', $data); 
		$updated_status = $this->db->affected_rows();
		return $updated_status;
	}
	
	public function checklist_header($date, $dateakhir ,$status){
		$start = date('Y-m-d 00:00:00', strtotime($date));
		$end = date('Y-m-d 23:59:59', strtotime($dateakhir));
		$res = $this->db->query("select * from checklist_bus_header a
 			where a.created_dt >= '".$start."' and a.created_dt <= '".$end."'
			and status in('".$status."');")->result_array();
		
		return $res;
	}
	
	public function input_checklist_detail($id){
		$res = $this->db->query("select a.police_number, a.body_number, a.driver_name, a.date, a.created_by, a.out_dt, 
			a.in_dt, a.status, km_out, km_in, bbm_out, bbm_in, 
				CASE WHEN b.out=1 THEN 'Baik'
				WHEN b.out=2 THEN 'Tidak Baik/Rusak'
				ELSE 'Hilang'
				END as out, 
				CASE WHEN b.in=1 THEN 'Baik'
				WHEN b.in=2 THEN 'Tidak Baik/Rusak'
				WHEN b.in=3 THEN 'Hilang'
				ELSE '-'
				END as in,
			b.notes_out, b.notes_in,  
			c.name, c.category
			from checklist_bus_header a 
			left join checklist_bus_detail b on(a.id=b.checklist_bus_header_id)
			left join master_checklist_bus c on(c.id=b.master_checklist_bus_id)
			where a.id=".$id." order by c.category asc; ");
		return $res->result_array();
	}
	
}

?>