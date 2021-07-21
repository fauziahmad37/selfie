<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	ini_set('max_execution_time', 600); 
	ini_set('memory_limit','2048M');

	include_once('Admin.php');
	class C_tiket extends admin{

		function master_customer(){

			$this->load->view('header');
            $this->load->view('finance/V_master_customer', Array('data'=>$data));
            $this->load->view('footer');
		}

			function master_ct(){

			$this->load->view('header');
            $this->load->view('finance/V_master_ct', Array('data'=>$data));
            $this->load->view('footer');
		}

			function get_data_by_name_customer(){
				$this->load->model('M_tiket');
			$post = $this->input->post();
			$nama_customer = $post['customer_name'];
			$data = $this->M_tiket->load_data_by_name_customer($nama_customer);
			$this->load->view('/finance/customer_data', Array('data'=> $data));
		}

		function insert_master_customer(){
			$this->load->model('M_tiket');
			$data = array(
				'customer_shortname'  => $this->input->post('customer_shortname'),
				'customer_name' 	  => $this->input->post('customer_name'),
				'address_invoice'	  => $this->input->post('address_invoice'),
				'city_invoice'		  => $this->input->post('city_invoice'),
				'postcode_invoice'	  => $this->input->post('postcode_invoice'),
				'phone_invoice'		  => $this->input->post('phone_invoice'),
				'fax_invoice'		  => $this->input->post('fax_invoice'),
				'address_company'	  => $this->input->post('address_company'),
				'city_company'		  => $this->input->post('city_company'),
				'postcode_company'	  => $this->input->post('postcode_company'),
				'phone_company'		  => $this->input->post('phone_company'),
				'fax_company'		  => $this->input->post('fax_company'),
				'contact_bill'		  => $this->input->post('contact_bill'),
				'phone_bill'		  => $this->input->post('phone_bill'),
				'mobile_phone_bill'	  => $this->input->post('mobile_phone_bill'),
				'npwp'				  => $this->input->post('npwp'),
				'description'		  => $this->input->post('description'),
				'bank_name'			  => $this->input->post('bank_name'),
				'bank_branch'		  => $this->input->post('bank_branch'),
				'bank_account_name'	  => $this->input->post('bank_account_name'),
				'bank_account_no'	  => $this->input->post('bank_account_no')
				);
			//print_r(isset($data['customer_name']));die;
			$cek    = $this->M_tiket->cek_master_customer($data);
			//print_r($cek[0]['count']);die;
			if($cek[0]['count'] >=1){
				echo "<script>
				    alert('Customer code already registered');
				</script>
				";
				 $this->load->view('header');
	             $this->load->view('finance/V_master_customer', Array('data'=>$data));
	             $this->load->view('footer');
			}else{
				$insert = $this->M_tiket->insert_master_ct($data);
			}
				echo "<script>
				    alert('Customer code success registered');
				</script>
				";
			// $this->load->view('header');
   //          $this->load->view('finance/V_master_customer', Array('data'=>$data));
   //          $this->load->view('footer');
		}

		
		
		function insert_master_ct(){
			$this->load->model('M_tiket');
			$data = array(
				//'ct_no'  				=> $this->input->post('ct_no'),
				'ct_released_date' 		=> $this->input->post('ct_released_date'),
				'customer_id'	  		=> $this->input->post('customer_id'),
				'customer_name'		  	=> $this->input->post('customer_name'),
				'trid'	  				=> $this->input->post('trid'),
				'trcode'			 	=> $this->input->post('trcode'),
				'trdate'		  		=> $this->input->post('trdate'),
				'setoran_code'	  		=> $this->input->post('setoran_code'),
				'spj_code'		  		=> $this->input->post('spj_code'),
				'used_date'	  			=> $this->input->post('used_date'),
				'used_by'		  		=> $this->input->post('used_by'),
				'used_value'		 	=> $this->input->post('used_value'),
				'used_poolid'		  	=> $this->input->post('used_poolid'),
				'used_ptid'		  		=> $this->input->post('used_ptid'),
				'driver_id'	  			=> $this->input->post('driver_id'),
				'driver_name'			=> $this->input->post('driver_name'),
				'car_id'		  		=> $this->input->post('car_id'),
				'no_pintu'			  	=> $this->input->post('no_pintu'),
				'status_invoice'		=> $this->input->post('status_invoice'),
				'no_invoice'	  		=> $this->input->post('no_invoice'),
				'purpose'	  			=> $this->input->post('purpose'),
				'status_double'	  		=> $this->input->post('status_double')
				);

				$insert = $this->M_tiket->insert_master_ct($data);
		// 	//print_r(isset($data['customer_name']));die;
		// 	$cek    = $this->M_tiket->cek_master_customer($data);
		// 	//print_r($cek[0]['count']);die;
		// 	if($cek[0]['count'] >=1){
		// 		echo "<script>
		// 		    alert('Customer code already registered');
		// 		</script>
		// 		";
		// 		 $this->load->view('header');
	 //             $this->load->view('finance/V_master_customer', Array('data'=>$data));
	 //             $this->load->view('footer');
		// 	}else{
		// 		$insert = $this->M_tiket->insert_master_ct($data);
		// 	}
		// 		echo "<script>
		// 		    alert('Customer code success registered');
		// 		</script>
		// 		";
		// 	// $this->load->view('header');
  //  //          $this->load->view('finance/V_master_customer', Array('data'=>$data));
  //  //          $this->load->view('footer');
		 }
	}
?>