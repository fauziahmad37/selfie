		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Detail Operation Etaxi - <?php $datetime = new DateTime($date); echo $datetime->format('l, j F Y'); ?></h2>
				</div>
                
          	</div>
          </div>
       </br>
       </br>
       </br>
		  
<!-- =================================================================================================================================-->
<!-- ========================================================= SOS TODAY =============================================================-->
<!-- =================================================================================================================================-->
			<div class="panel panel-primary">
				<div class="panel-heading">SOS Today</div>
				<div class="panel-body">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<tr>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Podok Bambu</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $sos_pd_bambu as $key => $val ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Pekapuran</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $sos_pekapuran as $key => $val ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Jagakarsa</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $sos_jagakarsa as $key => $val ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Cipayung</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $sos_cipayung as $key => $val ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									
									</div>
								</div>
							</td>
						</tr>
					</table>
			  </div>
			</div>
		  
<!-- =================================================================================================================================-->
<!-- ========================================================= DETAIL TP =============================================================-->
<!-- =================================================================================================================================-->
			<div class="panel panel-primary">
				<div class="panel-heading">TP Today</div>
				<div class="panel-body">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<tr>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Podok Bambu</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $tp_pd_bambu as $key => $val2 ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val2['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Pekapuran</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $tp_pekapuran as $key => $val ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Jagakarsa</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $tp_jagakarsa as $key => $val ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Cipayung</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $tp_cipayung as $key => $val ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									
									</div>
								</div>
							</td>
						</tr>
					</table>
			  </div>
			</div>
		  		  


<!-- =================================================================================================================================-->
<!-- ========================================================= 5 Hari Blm Pulang =====================================================-->
<!-- =================================================================================================================================-->
			<div class="panel panel-primary">
				<div class="panel-heading">5 Days Dont Back</div>
				<div class="panel-body">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<tr>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Podok Bambu</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $spj_5days_pd_bambu as $key => $val2 ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val2['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Pekapuran</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $spj_5days_pekapuran as $key => $val ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Jagakarsa</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $spj_5days_jagakarsa as $key => $val ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-primary">
									<div class="panel-heading">Cipayung</div>
									<div class="panel-body">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Door Number</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$a=1;
													foreach((Array) $spj_5days_cipayung as $key => $val ){
													
												?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number']; ?></td>
												<?php  ?>
												</tr>
												<?php 
													$a++;
												}?>
											</tbody>
										</table>
									
									</div>
								</div>
							</td>
						</tr>
					</table>
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
		<script src="<?php  echo base_url('/assets/js/morris.min.js');?>"></script>
		
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>


		
	
		
		<!-- Doughnut Chart -->
		<script>
		  $(document).ready(function(){
			   $('#example').DataTable();
			  
			var options = {
			  legend: false,
			  responsive: false
			};
			
			Morris.Area({
			  element: 'graph_area',
			  data: [
			  	<?php 
			  	foreach((Array) $data['series']['fleet'] AS $key => $val){
			  		echo "{period: '".date('D, d',strtotime($val['tgl_spj']))."', reguler: ".$val['reguler'].", eagle: ".$val['eagle'].", tiara: ".$val['tiara']."},";
			  	}
				?>
			  ],
			  parseTime: false,
			  xkey: 'period',
			  ykeys: ['tiara', 'eagle', 'reguler'],
			  lineColors: ['#E74C3C', '#1ABB9C', '#3498DB', '#3498DB'],
			  labels: ['Tiara', 'Eagle', 'Reguler'],
			  pointSize: 0,
			  hideHover: 'auto',
			  resize: true
			});
			
			Morris.Line({
			  element: 'graph_line',
			  data: [
			  	<?php
			  	$max = 0;
			  	$min = 10000; 
			  	foreach((Array) $data['series']['spj'] AS $key => $val){
					$max = max($max, $val['last_90'], $val['operasi'], $val['no_operasi'], $val['last_30']);
			  		$min = min($min, $val['last_90'], $val['operasi'], $val['no_operasi'], $val['last_30']);		
			  		echo "{period: '".date('D, d',strtotime($val['tgl_spj']))."', operasi: ".$val['operasi'].", no_operasi: ".$val['no_operasi'].
			  			", last_30: ".$val['last_30'].", last_90: ".$val['last_90']."},";
			  	}
				?>
			  ],
			  parseTime: false,
			  xkey: 'period',
			  ykeys: ['no_operasi', 'operasi', 'last_30', 'last_90'],
			  lineColors: ['#E74C3C', '#1ABB9C', '#FFA500', '#000'],
			  labels: ['Not Operating', 'Operating', 'Avg (30)', 'Avg (90)'],
			  hideHover: 'auto',
			  pointSize: 1,
			  ymax: <?php echo $max;?>,
			  ymin: <?php echo $min;?>,			  
			  resize: true
			});
			
			$('.btnSubmit').on('click', function (e) {
				var date = new Date($('.inputdate').val());
				var mm = date.getMonth() + 1;
				var dd = date.getDate();
				var yy = date.getFullYear();
				window.location = "<?php echo site_url('/Operation/index/');?>"+yy+'-'+mm+'-'+dd;
				$('<div class="modal-backdrop" style="opacity:0.8"></div>').appendTo(document.body);
				$('#gif').css('visibility', 'visible');
			});
			$('.btnUpdate').on('click', function (e) {
				window.location = "<?php echo site_url('/Operation/update_operation_now?start='.$date);?>";
			});
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				startDate: '<?php echo $datetime->format('d-m-y');?>'
			});
			var reg_reg = <?php echo $data['reguler_reg'];?>;
			var reg_kal = <?php echo $data['reguler_kal'];?>;
			var reg_tp = <?php echo $data['reguler_tp'];?>;
			var reg_brok = <?php echo $data['reguler_brok'];?>;
			var reg_so = <?php echo $data['reguler_so'];?>;
			var reg_lain = <?php echo $data['reguler_lain'];?>;		
			new Chart(document.getElementById("canvas_reguler"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Reguler",
				  "Kalong",
				  "TP",
				  "SOS",
				  "TL",
				  "Other"
				],
				datasets: [{
				  data: [reg_reg, reg_kal, reg_tp, reg_so, reg_brok, reg_lain],
				  backgroundColor: [
					"#3498DB",
					"#26B99A",
					"#9B59B6",
					"#E74C3C",
					"#FFA500",
					"#9CC2CB"
				  ],
				  hoverBackgroundColor: [
					"#49A9EA",
					"#36CAAB",
					"#B370CF",
					"#E95E4F",
					"#FED500",
					"#8CB2BB"				  
				  ]
				}]
			  },
			  options: options
			});
			var eagle_reg = <?php echo $data['eagle_reg'];?>;
			var eagle_kal = <?php echo $data['eagle_kal'];?>;
			var eagle_tp = <?php echo $data['eagle_tp'];?>;
			var eagle_brok = <?php echo $data['eagle_brok'];?>;
			var eagle_tl = <?php echo $data['eagle_tl'];?>;
			var eagle_argo_rds = <?php echo $data['eagle_argo_rds'];?>;
			var eagle_surat = <?php echo $data['eagle_surat'];?>;
			var eagle_lain = <?php echo $data['eagle_lain'];?>;	
			new Chart(document.getElementById("canvas_eagle"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Reguler",
				  "Kalong",
				  "TP",
				  "Broken",
				  "TL",
				  "Surat2",
				  "Argo/RDS",
				  "Other"
				],
				datasets: [{
				  data: [eagle_reg, eagle_kal, eagle_tp, eagle_brok, eagle_tl, eagle_surat, eagle_argo_rds, eagle_lain],
				  backgroundColor: [
					"#3498DB",
					"#26B99A",
					"#9B59B6",
					"#E74C3C",
					"#FFA500",
					"#FF00FF",
					"#34495E",
					"#9CC2CB"					
				  ],
				  hoverBackgroundColor: [
					"#49A9EA",
					"#36CAAB",
					"#B370CF",
					"#E95E4F",
					"#FED500",
					"#DD00DD",
					"#24394E",
					"#8CB2BB"	
				  ]
				}]
			  },
			  options: options
			});
			
			var tiara_reg = <?php echo $data['tiara_reg'];?>;
			var tiara_kal = <?php echo $data['tiara_kal'];?>;
			var tiara_tp = <?php echo $data['tiara_tp'];?>;
			var tiara_brok = <?php echo $data['tiara_brok'];?>;
			var tiara_tl = <?php echo $data['tiara_tl'];?>;
			var tiara_lain = <?php echo $data['tiara_lain'];?>;	
			new Chart(document.getElementById("canvas_tiara"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Reguler",
				  "Kalong",
				  "TP",
				  "Broken",
				  "TL",
				  "Other"
				],
				datasets: [{
				  data: [tiara_reg, tiara_kal, tiara_tp, tiara_brok, tiara_tl, tiara_lain],
				  backgroundColor: [
					"#3498DB",
					"#26B99A",
					"#9B59B6",
					"#E74C3C",
					"#FFA500",
					"#9CC2CB"
				  ],
				  hoverBackgroundColor: [
					"#49A9EA",
					"#36CAAB",
					"#B370CF",
					"#E95E4F",
					"#FED500",
					"#8CB2BB"				  
				  ]
				}]
			  },
			  options: options
			});
		  });
		</script>
		<!-- /Doughnut Chart -->