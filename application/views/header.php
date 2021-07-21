	<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo base_url('/assets/images/icon.png');?>" />
    <title>Self Service IT</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('/assets/css/font-awesome.min.css');?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('/assets/css/nprogress.css');?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('/assets/css/blue.css');?>" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('/assets/css/bootstrap-progressbar-3.3.4.min.css');?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('/assets/css/jqvmap.min.css');?>" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('/assets/css/bootstrap-datetimepicker.min.css');?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('/assets/css/dashboard.css');?>" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
		    <img src="<?php echo base_url('/assets/images/spinner.gif');?>" id="gif" style="position:fixed;z-index:1050;top:50%;left:50%;margin-top:-100px;margin-left:-100px;width:200px;display:block;visibility:hidden">
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                <?php
				
				if(
						$this->user['id_privilege'] == Admin::ADMINISTRATOR ||
						$this->user['id_privilege'] == Admin::CHECKER
						
						
					){
						echo '<li>
								<a><i class="fa fa-taxi"></i> PENJUALAN UNIT</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/Penjualan/").'"><i class="fa fa-cab"></i>Index </a></li>
								</ul>
							</li>';
					}
				
				if(
						$this->user['id_privilege'] == 1
						|| $this->user['id_privilege'] == 7
					){
						echo '<li>
								<a><i class="fa fa fa-bank"></i>Master Vehicle </a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/Segel_argo").'">Segel Argo Tiara</a></li>
								</ul>
							</li>';
					}
				
				if(
						$this->user['id_privilege'] == 1
						|| $this->user['id_privilege'] == 7
					){
						echo '<li>
								<a><i class="fa fa fa-bank"></i> Tiara</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/Segel_argo").'">Segel Argo Tiara</a></li>
								</ul>
							</li>';
					}
							
				if ($this->user['id_privilege'] == 5){
					 echo 	'<li><a><i class="fa fa-taxi"></i>Taxi Ads</a>
							<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/Taxi_ads/cinemaxx").'">Cinemaxx</a></li>
								<li><a href="'.site_url("/Taxi_ads/itop_street_hunt").'">Itop Street Hunt</a></li>
								<li><a href="'.site_url("/Taxi_ads/shopee").'">Shopee</a></li>
								<li><a href="'.site_url("/Taxi_ads/venom").'">Venom</a></li>
								<li><a href="'.site_url("/Taxi_ads/blibli").'">Blibli</a></li>
								<li><a href="'.site_url("/Taxi_ads/tokopedia").'">Tokopedia</a></li>
								<li><a href="'.site_url("/Taxi_ads/ovutest").'">Ovutest</a></li>
								<li><a href="'.site_url("/Taxi_ads/lazada").'">Lazada</a></li>
							</ul>
						<li>';
						
				} else if($this->user['id_privilege'] == 21){
					echo 	'<li><a><i class="fa fa-taxi"></i>BUS</a>
							<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/Bus").'">Checklist Bus Eagle High</a></li>
							</ul>
						<li>';
				}
               else if  ($this->user['id_privilege'] == 1)
			   {

			   		echo 
			   			'<li><a><i class="fa fa-cab    "></i> CALL CENTER </a>
										<ul class="nav child_menu" width="100%">
											<li><a href="'.site_url("/C_callcenter/viewCall").'">Form Latlong</a></li>
										</ul>
								</li>'; 

				   echo 	'<li><a><i class="fa fa-taxi"></i>Taxi Ads</a>
							<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/Taxi_ads/cinemaxx").'">Cinemaxx</a></li>
								<li><a href="'.site_url("/Taxi_ads/itop_street_hunt").'">Itop Street Hunt</a></li>
								<li><a href="'.site_url("/Taxi_ads/shopee").'">Shopee</a></li>
								<li><a href="'.site_url("/Taxi_ads/venom").'">Venom</a></li>
								<li><a href="'.site_url("/Taxi_ads/Blibli").'">Blibli</a></li>
								<li><a href="'.site_url("/Taxi_ads/tokopedia").'">Tokopedia</a></li>
								<li><a href="'.site_url("/Taxi_ads/ovutest").'">Ovutest</a></li>
								<li><a href="'.site_url("/Taxi_ads/lazada").'">Lazada</a></li>
							</ul>
						<li>';

					echo 	'<li><a><i class="fa fa-taxi"></i>Data Eagle</a>
							<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/C_operasi_eagle/data_operasi").'">Data Unit Operasi</a></li>
							</ul>
						<li>';

					echo '<li>
							<a href="'.site_url("/C_dashboard/index").'"><i class="fa fa-cab"></i> New Dashboard </a>
						  </li>';
							
					echo '<li><a><i class="fa fa-cab    "></i> Operation</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/Operasi/bukaSos").'">Buka SOS</a></li>
									<li><a href="'.site_url("/Operasi/bukaSosAdmin").'">Buka SOS Admin</a></li>
									<li><a href="'.site_url("/Operasi/bukaBs").'">Buka BS</a></li>
									<li><a href="'.site_url("/Operasi/duplicatSpj").'">Duplicat Enrty SPJ</a></li>
									<li><a href="'.site_url("/Operasi/syncArArmadaMurni").'">Sync AR Murni</a></li>
									<li><a href="'.site_url("/Operasi/batalOperasi").'">Batal Operasi</a></li>
									<li><a href="'.site_url("/Operasi/batalOperasiPool").'">Batal Operasi (Khusus Kapool)</a></li>
									<li><a href="'.site_url("/Operasi/arArmadaMurniTidakAda").'">AR Armada Murni Tidak Ada</a></li>
									<li><a href="'.site_url("/Finance/ksDriverDetail").'">Data AR Driver Tidak Tampil</a></li>
									<li><a href="'.site_url("/Finance/ksDriver").'">Data KS berdasarkan KIP</a></li>
									<li><a href="'.site_url("/Finance/ksDriverDetail").'">Data KS Detail berdasarkan KIP</a></li>	
								</ul>
							</li>';
					echo '<li><a><i class="fa fa-cab    "></i> Checker</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/Checker/inputRitDrop").'">Input Rit Drop</a></li>
									<li><a href="'.site_url("/Checker/checkerActivity").'">Report Checker</a></li>
									<li><a href="'.site_url("/Checker/CekMobil").'">Cek Kondisi Mobil</a></li>
									<li><a href="'.site_url("/Bus").'">Checklist Bus Eagle High</a></li>
								</ul>
							</li>';
							
                     echo '<li><a><i class="fa fa-money    "></i> Kasir</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/Kasir/inputCt").'">CT Tidak Dapat Diinput</a></li>
									<li><a href="'.site_url("/Kasir/adjustmentTidakAdaDiPusat").'">Adj Tidak Ada Di Pusat</a></li>
									<li><a href="'.site_url("/Kasir/adjustmentTidakAdaDiPool").'">Adj Tidak Update Di Pool</a></li>
									<li><a href="'.site_url("/Kasir/adjustmentArmadaTidakAdaDiPusat").'">Adj Armada Pusat</a></li>
									<li><a href="'.site_url("/Kasir/arDriverTidakAda").'">Tidak bisa adjusment Driver</a></li>
									<li><a href="'.site_url("/Kasir/arArmadaTidakAda").'">Tidak bisa adjusment Armada</a></li>
								</ul>
							</li>';
							
					echo '<li><a><i class="fa fa-money    "></i> Finance</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/CreditTicket/DetailCreditTicket").'">Credit Ticket Non Simtax</a></li>
									<li><a href="'.site_url("/RevenueFinance").'">Revenue Setoran</a></li>
									<li><a href="'.site_url("/DetailSetoranSimtax").'">Detail Setoran Reguler</a></li>
									<li><a href="'.site_url("/CreditTicketView").'">Credit Ticket Express</a></li>
									<li><a href="'.site_url("/CTEagle").'">Credit Ticket Eagle</a></li>
									<li><a href="'.site_url("/ReceiptTiara").'">Receipt Tiara</a></li>
									<li><a href="'.site_url("/Finance/ksDriver").'">Data KS berdasarkan KIP</a></li>
									<li><a href="'.site_url("/Finance/ksDriverDetail").'">Data KS Detail berdasarkan KIP</a></li>
									<li><a href="'.site_url("/Kasir/inputCt").'">Jurnal</a></li>
									<li><a href="'.site_url("/C_setoran/data_hutang_armada").'">Data Hutang Armada</a></li>
								</ul>
							</li>';

					echo '<li><a><i class="fa fa-money    "></i> Credit Ticket</a>
								<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/CreditTicket/DetailCreditTicket").'">Credit Ticket Non Simtax</a></li>
									<li><a href="'.site_url("/C_tiket/master_customer").'">Master Customer CT</a></li>
									<li><a href="'.site_url("/C_tiket/master_ct").'">Generate/Release CT</a></li>
								</ul>
							</li>';
			  
					echo '<li><a><i class="fa fa-money    "></i> Akunting</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/Kasir/inputCt").'">Jurnal</a></li>
									<li><a href="'.site_url("/Kasir/menu_ar_driver_pusat").'">AR Driver Pusat</a></li>
									<li><a href="'.site_url("/C_setoran/data_penghitaman").'">Data Penghitaman</a></li>
									<li><a href="'.site_url("/C_setoran/data_operasi").'">Data Stop Operasi</a></li>
									<li><a href="'.site_url("/C_setoran/data_hutang_armada").'">Data Hutang Armada</a></li>
								</ul>
								
							</li>';

					echo '<li><a><i class="fa fa-money    "></i> Data Setoran</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/index").'">Detail Setoran Pool</a></li>
								</ul>
							</li>';

					echo '<li><a><i class="fa fa-money    "></i> Data XOne</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/dataXOne").'">Data Ritase Reguler</a></li>
									<li><a href="'.site_url("/C_setoran/dataEagle").'">Data Ritase Eagle</a></li>
								</ul>
							</li>';

					echo '<li><a><i class="fa fa-money    "></i> Data Wuling</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/dataWuling").'">Data Unit TP dan SOS Wuling</a></li>
									<li><a href="'.site_url("/C_setoran/dataKSWuling").'">Data Unit KS Wuling</a></li>
								</ul>
							</li>';
					echo '<li><a><i class="fa fa-money    "></i> Etaxi</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/UploadFoto").'">Upload Foto </a></li>
									<li><a href="'.site_url("/Etaxi/photo_kosong").'">Foto Kosong </a></li>
									<li><a href="'.site_url("/Etaxi/update_status_driver").'">Update Status </a></li>
									<li><a href="'.site_url("/Etaxi/change_pool_driver").'">Ganti Pool Driver </a></li>
								</ul>
							</li>';

					 echo '<li><a><i class="fa fa-money    "></i> Report Penghitaman</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/C_penghitaman/index").'">Data Detail Hari Operasi</a></li>
								   <li><a href="'.site_url("/C_setoran/data_penghitaman").'">Data Operasi Per Armada</a></li>
								</ul>
						</li>';

						echo '<li><a><i class="fa fa-money    "></i> Report ITMS</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/menuReportItms").'">Laporan Perbaikan ITMS </a></li>
									<li><a href="'.site_url("/C_setoran/menuRekapItms").'">Rekap Perbaikan ITMS </a></li>
								</ul>
							</li>';

					  echo '<li><a><i class="fa fa-money    "></i> Admin Menu</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Dashboard").'">Dashboard</a></li>
								  <li><a href="'.site_url("/Dashboard/listActivity").'">List Activity</a></li>
								  <li><a href="'.site_url("/Users").'">User Management</a></li>
								</ul>
							</li>';
							
						echo '<li><a><i class="fa fa-money    "></i> Etaxi</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Etaxi/Dashboard_operation").'">Dashboard Operation Etaxi</a></li>
								  <li><a href="'.site_url("/Etaxi/Detail_operation").'">Detail Dashboard Etaxi</a></li>
								  <li><a href="'.site_url("/Etaxi/depok").'">Etaxi Depok</a></li>
								  <li><a href="'.site_url("/Etaxi/index_pondok_bambu").'">Etaxi Pondok Bambu</a></li>
								</ul>
							</li>';
							
							echo '<li><a><i class="fa fa-money    "></i> Tutorial</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Tutorial/mappingS").'">Auto Login RDS</a></li>
								</ul>
							</li>';



							
						echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
			   }else if ($this->user['id_privilege'] == 22)
			   		{

			   			echo 	'<li><a><i class="fa fa-taxi"></i>Data Eagle</a>
							<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/C_operasi_eagle/data_operasi").'">Data Unit Operasi</a></li>
							</ul>
						<li>';
						
						echo '<li><a><i class="fa fa-money    "></i> Etaxi</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Etaxi/Dashboard_operation").'">Dashboard Operation Etaxi</a></li>
								  <li><a href="'.site_url("/Etaxi/Detail_operation").'">Detail Dashboard Etaxi</a></li>
								  <li><a href="'.site_url("/Etaxi/depok").'">Etaxi Depok</a></li>
								  <li><a href="'.site_url("/Etaxi/index_pondok_bambu").'">Etaxi Pondok Bambu</a></li>
								</ul>
							</li>';
						
				 		echo '<li><a><i class="fa fa-money    "></i> Data XOne</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/dataEagle").'">Data Ritase Eagle</a></li>
								</ul>
							 </li>';

				
			 			echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
			   }
			   else if ($this->user['id_privilege'] == 10)
			   		{
				 		echo 
			   			'<li><a><i class="fa fa-cab    "></i> CALL CENTER </a>
										<ul class="nav child_menu" width="100%">
											<li><a href="'.site_url("/C_callcenter/viewCall").'">Form Latlong</a></li>
										</ul>
								</li>'; 

				
			 			echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
			   }
			   else if ($this->user['id_privilege'] == 16)
			   {
						echo '<li><a><i class="fa fa-money    "></i> Finance</a>
					<ul class="nav child_menu" width="100%">
					<li><a href="'.site_url("/CreditTicket/DetailCreditTicket").'">Credit Ticket Non Simtax</a></li>
					<li><a href="'.site_url("/RevenueFinance").'">Revenue Setoran</a></li>
					<li><a href="'.site_url("/DetailSetoranSimtax").'">Detail Setoran Reguler</a></li>
					<li><a href="'.site_url("/CreditTicketView").'">Credit Ticket Express</a></li>
					<li><a href="'.site_url("/CTEagle").'">Credit Ticket Eagle</a></li>
					<li><a href="'.site_url("/ReceiptTiara").'">Receipt Tiara</a></li>
					<li><a href="'.site_url("/Finance/ksDriver").'">Data KS berdasarkan KIP</a></li>
				   <li><a href="'.site_url("/Finance/ksDriverDetail").'">Data KS Detail berdasarkan KIP</a></li>
				   <li><a href="'.site_url("/Kasir/inputCt").'">Jurnal</a></li>
				   <li><a href="'.site_url("/C_setoran/data_penghitaman").'">Data Penghitaman</a></li>
				   <li><a href="'.site_url("/C_setoran/data_operasi").'">Data Stop Operasi</a></li>
				   <li><a href="'.site_url("/C_setoran/data_hutang_armada").'">Data Hutang Armada</a></li>
				   <li><a href="'.site_url("/Kasir/menu_ar_driver_pusat").'">AR Driver Pusat</a></li>
					</ul>
				</li>';
				
				echo '<li><a><i class="fa fa-money    "></i> Tutorial</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Tutorial/mappingS").'">Auto Login RDS</a></li>
								</ul>
							</li>';
				echo '<li><a><i class="fa fa-money    "></i> Data Wuling</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/dataWuling").'">Data Unit TP dan SOS Wuling</a></li>
									<li><a href="'.site_url("/C_setoran/dataKSWuling").'">Data Unit KS Wuling</a></li>
								</ul>
							</li>';
			  echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
			   }

				else if ($this->user['id_privilege'] == 7)
			   {
				   
				   echo '<li><a><i class="fa fa-money    "></i> Etaxi</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Etaxi/Dashboard_operation").'">Dashboard Operation Etaxi</a></li>
								  <li><a href="'.site_url("/Etaxi/Detail_operation").'">Detail Dashboard Etaxi</a></li>
								  <li><a href="'.site_url("/Etaxi/depok").'">Etaxi Depok</a></li>
								  <li><a href="'.site_url("/Etaxi/index_pondok_bambu").'">Etaxi Pondok Bambu</a></li>
								</ul>
							</li>';
					echo '<li><a><i class="fa fa-cab    "></i> Checker</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/Checker/inputRitDrop").'">Input Rit Drop</a></li>
									<li><a href="'.site_url("/Checker/checkerActivity").'">Report Checker</a></li>
									<li><a href="'.site_url("/Checker/CekMobil").'">Cek Kondisi Mobil</a></li>
								</ul>
							</li>';

							echo '<li><a><i class="fa fa-money    "></i> Data Wuling</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/dataWuling").'">Data Unit TP dan SOS Wuling</a></li>
								</ul>
							</li>';
							
							echo 	'<li><a><i class="fa fa-taxi"></i>Data Eagle</a>
							<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/C_operasi_eagle/data_operasi").'">Data Unit Operasi</a></li>
							</ul>
							<li>';

							echo '<li><a><i class="fa fa-money    "></i> Tutorial</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Tutorial/mappingS").'">Auto Login RDS</a></li>
								</ul>
							</li>';
							
							echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
			   }

			   else if ($this->user['id_privilege'] == 4)
			   {
				   echo '<li><a><i class="fa fa-money    "></i> Etaxi</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Etaxi/Dashboard_operation").'">Dashboard Operation Etaxi</a></li>
								  <li><a href="'.site_url("/Etaxi/Detail_operation").'">Detail Dashboard Etaxi</a></li>
								  <li><a href="'.site_url("/Etaxi/depok").'">Etaxi Depok</a></li>
								  <li><a href="'.site_url("/Etaxi/index_pondok_bambu").'">Etaxi Pondok Bambu</a></li>
								</ul>
							</li>';
					echo '<li><a><i class="fa fa-cab    "></i> Operation</a>
								<ul class="nav child_menu" width="100%">
									  <li><a href="'.site_url("/Operasi/bukaSos").'">Buka SOS</a></li>
					                  <li><a href="'.site_url("/Operasi/bukaBs").'">Buka BS</a></li>
					                  <li><a href="'.site_url("/Operasi/duplicatSpj").'">Duplicat Enrty SPJ</a></li>
									  <li><a href="'.site_url("/Operasi/batalOperasiPool").'">Batal Operasi (Khusus Kapool)</a></li>
									  <li><a href="'.site_url("/Operasi/syncArArmadaMurni").'">Sync AR Murni</a></li>
									  <li><a href="'.site_url("/Finance/ksDriver").'">Data KS berdasarkan KIP</a></li>
									  <li><a href="'.site_url("/Finance/ksDriverDetail").'">Data KS Detail berdasarkan KIP</a></li>
									  <li><a href="'.site_url("/Etaxi/Dashboard_operation").'">Dashboard Operation Etaxi</a></li>
									  <li><a href="'.site_url("/Etaxi/depok").'">Etaxi Depok</a></li>
									  <li><a href="'.site_url("/Etaxi/index_pondok_bambu").'">Etaxi Pondok Bambu</a></li>
								</ul>
							</li>';

                     echo '<li><a><i class="fa fa-money    "></i> Kasir</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Kasir/inputCt").'">CT Tidak Dapat Diinput</a></li>
								  <li><a href="'.site_url("/Kasir/adjustmentTidakAdaDiPusat").'">Adj Tidak Ada Di Pusat</a></li>
                  				  <li><a href="'.site_url("/Kasir/adjustmentTidakAdaDiPool").'">Adj Tidak Update Di Pool</a></li>
                  				  <li><a href="'.site_url("/Kasir/arDriverTidakAda").'">Tidak bisa adjusment Driver</a></li>
                  				  <li><a href="'.site_url("/Kasir/arArmadaTidakAda").'">Tidak bisa adjusment Armada</a></li>
								</ul>
							</li>';

					echo '<li><a><i class="fa fa-cab    "></i> Checker</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/Checker/checkerActivity").'">Report Checker</a></li>
									<li><a href="'.site_url("/Checker/CekMobil").'">Cek Kondisi Mobil</a></li>
								</ul>
							</li>';
							 echo '<li><a><i class="fa fa-money    "></i> Akunting</a>
				                <ul class="nav child_menu" width="100%">
				             
				                  <li><a href="'.site_url("/C_setoran/data_penghitaman").'">Data Penghitaman</a></li>
				                  <li><a href="'.site_url("/C_setoran/data_operasi").'">Data Stop Operasi</a></li>
				                 
				                </ul>
				              </li>';
						echo '<li><a><i class="fa fa-money    "></i> Data XOne</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/dataXOne").'">Data Ritase Reguler</a></li>
									<li><a href="'.site_url("/C_setoran/dataEagle").'">Data Ritase Eagle</a></li>
								</ul>
							</li>';

               echo '<li><a><i class="fa fa-money    "></i> Akunting</a>
                <ul class="nav child_menu" width="100%">
                  <li><a href="'.site_url("/Kasir/inputCt").'">Jurnal</a></li>
                  <li><a href="'.site_url("/C_setoran/data_penghitaman").'">Data Penghitaman</a></li>
                  <li><a href="'.site_url("/C_setoran/data_operasi").'">Data Stop Operasi</a></li>
                  <li><a href="'.site_url("/C_setoran/data_hutang_armada").'">Data Hutang Armada</a></li>
                 
                </ul>
              </li>';
			  
			  echo '<li><a><i class="fa fa-money"></i> Etaxi</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Etaxi/depok").'">Etaxi Depok</a></li>
								</ul>
							</li>';
							
				echo 	'<li><a><i class="fa fa-taxi"></i>Taxi Ads</a>
							<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/Taxi_ads/").'"></a></li>
							</ul>
						<li>';

				echo '<li><a><i class="fa fa-money    "></i> Data Wuling</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/dataWuling").'">Data Unit TP dan SOS Wuling</a></li>
									<li><a href="'.site_url("/C_setoran/dataKSWuling").'">Data Unit KS Wuling</a></li>
								</ul>
							</li>';
				echo '<li><a><i class="fa fa-money    "></i> Data Wuling Etaxi</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/dataTPWulingEtaxi").'">Data TP Wuling Etaxi </a></li>
								</ul>
							</li>';
							
				echo '<li><a><i class="fa fa-money    "></i> Tutorial</a>
							<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/Tutorial/mappingS").'">Auto Login RDS</a></li>
							</ul>
					</li>';
			  
			  echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
			   }
			   
			   else if ($this->user['id_privilege'] == 3 
						|| $this->user['id_privilege'] == 17)
			   {
				   echo '<li><a><i class="fa fa-money    "></i> Etaxi</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Etaxi/Dashboard_operation").'">Dashboard Operation Etaxi</a></li>
								  <li><a href="'.site_url("/Etaxi/Detail_operation").'">Detail Dashboard Etaxi</a></li>
								  <li><a href="'.site_url("/Etaxi/depok").'">Etaxi Depok</a></li>
								  <li><a href="'.site_url("/Etaxi/index_pondok_bambu").'">Etaxi Pondok Bambu</a></li>
								</ul>
							</li>';
			
			  
			 	echo '<li><a><i class="fa fa-money    "></i> Etaxi</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Etaxi/depok").'">Depok</a></li>
								  <li><a href="'.site_url("/Etaxi/index_pondok_bambu").'">Etaxi Pondok Bambu</a></li>
								</ul>
							</li>';
				
				echo 	'<li><a><i class="fa fa-taxi"></i>Taxi Ads</a>
							<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/Taxi_ads/").'">Dice Aktif</a></li>
							</ul>
						<li>';
			  
			  	echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
			   }else if ($this->user['id_privilege'] == 500)
			   {
				  echo '<li><a><i class="fa fa-money    "></i> Report Penghitaman</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/C_penghitaman/index").'">Data Detail Hari Operasi</a></li>
								   <li><a href="'.site_url("/C_setoran/data_penghitaman").'">Data Operasi Per Armada</a></li>
								</ul>
						</li>';
			 
			  	echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
			   }
			   else if ($this->user['id_privilege'] == 800)
			   {
				 echo '<li><a><i class="fa fa-money    "></i> Report ITMS</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/menuReportItms").'">Laporan Perbaikan ITMS </a></li>
								</ul>
							</li>';

			  	echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
			   }
			   else if ($this->user['id_privilege'] == 501)
			   {
				  echo '<li><a><i class="fa fa-money    "></i> Report Penghitaman</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/C_penghitaman/index").'">Data Detail Hari Operasi</a></li>
								   <li><a href="'.site_url("/C_setoran/data_penghitaman").'">Data Operasi Per Armada</a></li>
								</ul>
						</li>';

					echo '<li><a><i class="fa fa-money    "></i> Akunting</a>
		                <ul class="nav child_menu" width="100%">
		                  <li><a href="'.site_url("/Kasir/inputCt").'">Jurnal</a></li>
						  <li><a href="'.site_url("/Kasir/menu_ar_driver_pusat").'">AR Driver Pusat</a></li>
		                  <li><a href="'.site_url("/C_setoran/data_operasi").'">Data Stop Operasi</a></li>
		                  <li><a href="'.site_url("/C_setoran/data_hutang_armada").'">Data Hutang Armada</a></li>
		                </ul>
		              </li>';
			 		echo '<li><a><i class="fa fa-money    "></i> Kasir</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Kasir/inputCt").'">CT Tidak Dapat Diinput</a></li>
								  <li><a href="'.site_url("/Kasir/adjustmentTidakAdaDiPusat").'">Adj Tidak Ada Di Pusat</a></li>
                  				  <li><a href="'.site_url("/Kasir/adjustmentTidakAdaDiPool").'">Adj Tidak Update Di Pool</a></li>
                  				  <li><a href="'.site_url("/Kasir/arDriverTidakAda").'">Tidak bisa adjusment Driver</a></li>
                  				  <li><a href="'.site_url("/Kasir/arArmadaTidakAda").'">Tidak bisa adjusment Armada</a></li>
								</ul>
							</li>';

					echo '<li><a><i class="fa fa-money    "></i> Finance</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/CreditTicket/DetailCreditTicket").'">Credit Ticket Non Simtax</a></li>
									<li><a href="'.site_url("/RevenueFinance").'">Revenue Setoran</a></li>
									<li><a href="'.site_url("/DetailSetoranSimtax").'">Detail Setoran Reguler</a></li>
									<li><a href="'.site_url("/CreditTicketView").'">Credit Ticket Express</a></li>
									<li><a href="'.site_url("/CTEagle").'">Credit Ticket Eagle</a></li>
									<li><a href="'.site_url("/ReceiptTiara").'">Receipt Tiara</a></li>
									<li><a href="'.site_url("/Finance/ksDriver").'">Data KS berdasarkan KIP</a></li>
									<li><a href="'.site_url("/Finance/ksDriverDetail").'">Data KS Detail berdasarkan KIP</a></li>
									<li><a href="'.site_url("/Kasir/inputCt").'">Jurnal</a></li>
									<li><a href="'.site_url("/C_setoran/data_hutang_armada").'">Data Hutang Armada</a></li>
								</ul>
							</li>';
			  	echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
			   } else if($this->user['id_privilege'] == 18){
				   echo 	'<li><a><i class="fa fa-money"></i>Driver Management</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/Etaxi/driver_management").'">Update Status Driver </a></li>
								</ul>
							</li>';
			   } else {
					echo '<li><a><i class="fa fa-cab    "></i> Operation</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Operasi/bukaSos").'">Buka SOS</a></li>
				                  <li><a href="'.site_url("/Operasi/bukaBs").'">Buka BS</a></li>
				                  <li><a href="'.site_url("/Operasi/duplicatSpj").'">Duplicat Enrty SPJ</a></li>
								  <li><a href="'.site_url("/Operasi/syncArArmadaMurni").'">Sync AR Murni</a></li>
								  <li><a href="'.site_url("/Operasi/arArmadaMurniTidakAda").'">AR Armada Murni Tidak Ada</a></li>
								  <li><a href="'.site_url("/Finance/ksDriver").'">Data KS berdasarkan KIP</a></li>
								  <li><a href="'.site_url("/Finance/ksDriverDetail").'">Data KS Detail berdasarkan KIP</a></li>
								  <li><a href="'.site_url("/C_setoran/data_penghitaman").'">Data Penghitaman</a></li>
                  				  <li><a href="'.site_url("/C_setoran/data_operasi").'">Data Stop Operasi</a></li>
                 				 <li><a href="'.site_url("/C_setoran/data_operasi").'">Data Stop Operasi</a></li>
								</ul>
							</li>';
                     echo '<li><a><i class="fa fa-money    "></i> Kasir</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Kasir/inputCt").'">CT Tidak Dapat Diinput</a></li>
								  <li><a href="'.site_url("/Kasir/adjustmentTidakAdaDiPusat").'">Adj Tidak Ada Di Pusat</a></li>
                  				  <li><a href="'.site_url("/Kasir/adjustmentTidakAdaDiPool").'">Adj Tidak Update Di Pool</a></li>
                  				  <li><a href="'.site_url("/Kasir/arDriverTidakAda").'">Tidak bisa adjusment Driver</a></li>
                  				  <li><a href="'.site_url("/Kasir/arArmadaTidakAda").'">Tidak bisa adjusment Armada</a></li>
								</ul>
							</li>';
		               
              echo '<li><a><i class="fa fa-money    "></i> Data XOne</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/dataXOne").'">Data Ritase Reguler</a></li>
									
								</ul>
							</li>';

						echo '<li><a><i class="fa fa-money    "></i> Data Wuling</a>
								<ul class="nav child_menu" width="100%">
									<li><a href="'.site_url("/C_setoran/dataWuling").'">Data Unit TP dan SOS Wuling</a></li>
									<li><a href="'.site_url("/C_setoran/dataKSWuling").'">Data Unit KS Wuling</a></li>
								</ul>
							</li>';
				
				echo 	'<li><a><i class="fa fa-taxi"></i>Taxi Ads</a>
							<ul class="nav child_menu" width="100%">
								<li><a href="'.site_url("/Taxi_ads/").'">Dice Aktif</a></li>
							</ul>
						<li>';

						echo '<li><a><i class="fa fa-money    "></i> Report Penghitaman</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/C_penghitaman/index").'">Rekap Hari Operasi</a></li>
								   <li><a href="'.site_url("/C_setoran/data_penghitaman").'">Detail Hari Operasi</a></li>
								</ul>
						</li>';


			  
			  echo '<li><a><i class="fa fa-money    "></i> Tutorial</a>
								<ul class="nav child_menu" width="100%">
								  <li><a href="'.site_url("/Tutorial/mappingS").'">Auto Login RDS</a></li>
								</ul>
							</li>';
			  
			  echo '<li><a><i class="fa fa-desktop    "></i>  IP ANDA : ';
						echo $this->input->ip_address();
						echo '</a> </br>
						Kami merecord setiap IP address pengguna untuk keperluan analisa, mohon diperhatikan setiap transaksi yang anda lakukan</ul>
							</li>';
				}
				  ?>

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
              	<li><a href="<?php echo site_url('Login/logout');?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        