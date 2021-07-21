	<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">	
        <div class="right_col" role="main">
			<div class="x_content">
			  <!-- top tiles -->
				<div class="row top_tiles">
					<div class="col-md-12 col-sm-12 col-xs-12 tile">
						<div class="col-md-8 col-sm-8 col-xs-12">
						<h2>Etaxi vs Simtax - <?php $datetime = new DateTime($date); echo $datetime->format('l, j F Y'); ?></h2>
						</div>
					</div>
				</div>
		  
				<div class role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
						<li role="presentation" class="active"><a href="#tab_content3" id="warna-tab" role="tab" data-toggle="tab" aria-expanded="true">Pilih =></a></li>
						<li role="presentation"><a href="#tab_content6" id="spjDay-tab" role="tab" data-toggle="tab" aria-expanded="true">SPJ Hari Ini</a></li>
						<li role="presentation"><a href="#tab_content2" id="model-tab" role="tab" data-toggle="tab" aria-expanded="true">Setoran Hari Ini</a></li>
						
					</ul>
				</div>
				
					
				
				
				<div id="myTabContent" class="tab-content">
					
					<div role="tabpanel" class="tab-pane fade in" id="tab_content3" aria-labelledby="warna-tab">
						<table style='width:100%' id="table2" >
							<h2>REPORT HARIAN ETAXI VS SIMTAX</h2>
						</table>
					</div>
				
				
					<div role="tabpanel" class="tab-pane fade in" id="tab_content6" aria-labelledby="spjDay-tab">
						<table style='width:100%' id="table1" >
							<tr>
								<td>
									<div class="row tile_count">
										<div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
											<div class="count"><?php echo ' '; ?></div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
											<div class="count"><?php echo 'eTaxi'	; ?></div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
											<div class="count"><?php echo 'Simtax'; ?></div>
										</div>  
										<div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
											<div class="count"><?php echo 'SPJ Hari Ini' ?></div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
											<div class="count"><?php echo $dataSpjTodayEtaxi ?></div>
										</div> 

										<div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
											<div class="count"><?php echo $dataSpjTodaySimtax ?></div>

										</div>
									</div>
								</td>
							</tr>
						</table>
					
						<table style='width:100%' id="table1">
							<tr>
								<td valign="top">
									<div class="x_content table-responsive">
										<table id="datatable2" class="table table-bordered" style="width:100%">
											<thead>
												<tr>
													<th colspan=2 class="text-center">DETAIL SPJ ETAXI HARI INI</th>
												</tr>
												<tr>
													<th>NO</th>
													<th align="center">No Pintu</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$b=1;
													foreach ((Array) $data_spj_etaxi AS $key2 => $var2) { 
														echo '<tr>'.
														'<td width="20%">'.$b.'</td>'.				
														'<td width="80%" align="center">'.$var2['door_number'].'</td>'.
														'</tr>';
														$b++;
													}
												?>
											</tbody>
										</table>		
									</div>
								</td>
								<td valign="top">
									<div class="x_content table-responsive">
										<table id="datatable2" class="table table-bordered" style="width:100%">
											<thead>
												<tr>
													<th colspan=2 class="text-center">DETAIL SPJ SIMTAX HARI INI</th>
												</tr>
												<tr>
													<th>NO</th>
													<th align="center">No Pintu</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$a=1;
													foreach ((Array) $data_spj_simtax AS $key => $var) { 
														echo '<tr>'.
														'<td width="20%">'.$a.'</td>'.				
														'<td width="80%" align="center">'.$var['no_pintu'].'</td>'.
														'</tr>';
														$a++;
													}
												?>
											</tbody>
										</table>		
									</div>
								</td>
								
							</tr>	
						</table>	
					</div>
					
					<div role="tabpanel" class="tab-pane fade in" id="tab_content2" aria-labelledby="model-tab">
						<table id="table3" class="table table-bordered" style="width:100%">
							<thead>
								<tr>
									<td align='center' style="font-size: 20px;">Setoran eTaxi Hari Ini</td>
									<td align='center' style="font-size: 20px;">Setoran Simtax Hari Ini</td>
									
								</tr>
							</thead>
							<tbody>
								<tr>
									<td align='center' style="font-size: 20px;"><?php echo 'Rp. '.number_format($dataSetoranTodayEtaxi); ?></td>
									<td align='center' style="font-size: 20px;"><?php echo 'Rp. '.number_format($dataSetoranTodaySimtax); ?></td>
									
								</tr>								
							</tbody>
						</table>
						
						<table id="table3" style="width:100%">
							<tr>
								
								<td valign="top">
									<table id="table3" class="table table-bordered" style="width:100%">
										<thead>
											<th width="10%">No</th>
											<th align='center' width="40%">SPJ ETAXI</th>
											<th align='center' width="40%">Amount</th>
										</thead>
										<tbody>
											<?php $d=1 ?>
											<?php foreach ((Array) $data_detail_spj_etaxi as $key4 => $val4){ ?>
											<tr>
												<td><?php echo $d; ?></td>
												<td><?php echo ($val4['door_number']); ?></td>
												<td><?php echo 'Rp. '.number_format($val4['payment']); ?></td> 
											</tr>
											<?php 
												$d++;
												} 
											?>
										</tbody>
									</table>
								</td>
								<td valign="top">
									<table id="table3" class="table table-bordered" style="width:100%">
										<thead>
											<th width="10%">No</th>
											<th align='center' width="40%">SPJ SIMTAX</th>
											<th align='center' width="40%">Amount</th>
										</thead>
										<tbody>
											<?php $c=1 ?>
											<?php foreach ((Array) $data_detail_spj_simtax as $key3 => $val3){ ?>
											<tr>
												<td><?php echo $c; ?></td>
												<td><?php echo ($val3['no_pintu']); ?></td>
												<td><?php echo 'Rp. '.number_format($val3['total_terima']); ?></td>
											</tr>
											<?php 
												$c++;
												} 
											?>
										</tbody>
									</table>
								</td>
							</tr>
						</table>
						
						<?php
						print_r($dif_spj);
						echo '<br>';
						echo '<br>';
						print_r($data_spj_simtax);
						?>
						
					</div>
					
					
				</div>
				
			</div>
		</div>
        <!-- /page content -->
		
		<!-- jQuery -->
		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>
		<!-- NProgress -->
		<script src="<?php echo base_url('/assets/js/nprogress.js');?>"></script>
		<!-- Chart.js -->
		<script src="<?php echo base_url('/assets/js/Chart.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js');?>"></script>
		<!-- morris.js -->
		<script src="<?php echo base_url('/assets/js/raphael.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/morris.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
    	<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>
		<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
	
	 <script>
      $(document).ready(function() {
			$('#table1').dataTable();
		   $('#table2').dataTable();
		   $('#table3').dataTable();
		   // $('#table4').dataTable();
		   // $('#table5').dataTable();
		   // $('#table6').dataTable();		   		   
        } );
    </script>	