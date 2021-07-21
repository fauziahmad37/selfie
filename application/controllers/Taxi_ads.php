<?php 
include_once('Admin.php');
class Taxi_ads extends Admin {
	function __construct() {
		parent::__construct();
		$this->load->model('taxi_ads_model');
	}
	
	function Cinemaxx(){
		$data = $this->taxi_ads_model->cinemaxx();
		$data2 = $this->taxi_ads_model->cinemaxx_dice();
		
		$this->load->view('header');
		$this->load->view('taxi_ads/cinemaxx', Array('data' => $data, 'data2' => $data2));
		$this->load->view('footer');
	}
	
	function Itop_street_hunt(){
		$data = $this->taxi_ads_model->itop_street_hunt();
		$data2 = $this->taxi_ads_model->itop_street_hunt_dice();
		
		$this->load->view('header');
		$this->load->view('taxi_ads/itop_street_hunt', Array('data' => $data, 'data2' => $data2));
		$this->load->view('footer');
	}
	
	function Shopee(){
		$data = $this->taxi_ads_model->shopee();
		$data2 = $this->taxi_ads_model->shopee_dice();
		
		$this->load->view('header');
		$this->load->view('taxi_ads/shopee', Array('data' => $data, 'data2' => $data2));
		$this->load->view('footer');
	}
	
	function Venom(){
		$data = $this->taxi_ads_model->venom();
		$data2 = $this->taxi_ads_model->venom_dice();
		
		$this->load->view('header');
		$this->load->view('taxi_ads/venom', Array('data' => $data, 'data2' => $data2));
		$this->load->view('footer');
	}
	
	function Blibli(){
		$data = $this->taxi_ads_model->blibli();
		$data2 = $this->taxi_ads_model->blibli_dice();
		
		$this->load->view('header');
		$this->load->view('taxi_ads/blibli', Array('data' => $data, 'data2' => $data2));
		$this->load->view('footer');
	}
	
	function Tokopedia(){
		$data = $this->taxi_ads_model->tokopedia();
		$data2 = $this->taxi_ads_model->tokopedia_dice();
		
		$this->load->view('header');
		$this->load->view('taxi_ads/tokopedia', Array('data' => $data, 'data2' => $data2));
		$this->load->view('footer');
	}
	
	function Ovutest(){
		$data = $this->taxi_ads_model->ovutest();
		$data2 = $this->taxi_ads_model->ovutest_dice();
		
		$this->load->view('header');
		$this->load->view('taxi_ads/ovutest', Array('data' => $data, 'data2' => $data2));
		$this->load->view('footer');
	}
	
	function Lazada(){
		$data = $this->taxi_ads_model->lazada();
		$data2 = $this->taxi_ads_model->lazada_dice();
		
		$this->load->view('header');
		$this->load->view('taxi_ads/lazada', Array('data' => $data, 'data2' => $data2));
		$this->load->view('footer');
	}
}
?>