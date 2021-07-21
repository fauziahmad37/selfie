<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');

include_once('Admin.php');

  class Uploads extends Admin {
        public function __construct()
        {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
			$this->load->model('etaxi_model');
        }
        public function index(){
			$post = $this->input->post();
			$res = array();
			
			if(isset($post['cari'])){
				$res = $this->etaxi_model->cari_kip($post);
				if($res == ''){
					?>
					<script type="text/javascript">
						alert("Kip Tidak Ditemukan!");
						window.location = "<?php echo site_url('/Uploads/');?>";
					</script>
					<?php
					
				}
			}
			
			$this->load->view('/header');		
			$this->load->view('etaxi/upload', array('error' => ' ', 'res' => $res));
			$this->load->view('/footer');
        }
        public function upload_file(){
			
		
			
            $config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc';
			$config['max_size']             = 1000;
			$config['max_width']            = 1300;
			$config['max_height']           = 1024;
			$this->load->library('upload', $config);
				
				
                
				
				if (!$this->upload->do_upload('userfile')){
					
                    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
                    $error = array('error' => $this->upload->display_errors());
				
					
                    $this->load->view('etaxi/upload', $error);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $this->load->view('etaxi/success', $data);
                }
        }
}