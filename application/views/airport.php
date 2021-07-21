		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
		<style type="text/css">
 a:hover {
  cursor:pointer !important;
 }
</style>

		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2><?php if(!isset($detail) && !isset($tipe) && !isset($area)) echo 'Airport'; else if(!isset($tipe) && !isset($area))echo $data['shelter'][0]['name'];
          		else if(isset($tipe)) echo $tipe; else echo 'Area '.$area; ?>
          		<?php if(strtotime($start) == strtotime($date)) {
          			$datetime = new DateTime($date); echo ' - '.$datetime->format('l, j F Y').'</h2>'; 
          			} else {
          			$datetime = new DateTime($start); echo '</h2><h4>'.$datetime->format('l, j F Y').' to '; 
          			$datetime2 = new DateTime($date); echo $datetime2->format('l, j F Y').'</h4>';           			
          			}
          		?>
          		<h4>Last Update <?php echo $data['last_update'];?>
				</div>
                <div class="input-group date form_date col-md-4" data-date-format="D, dd M yyyy" data-link-field="dtp_input1">
                    <input class="form-control inputdate" size="auto" type="text" value="<?php echo $start;?>" readonly>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
					<input type="hidden" id="dtp_input1" value="" /><br/>					
                </div>
                <div class="input-group date form_date col-md-4" data-date-format="D, dd M yyyy" data-link-field="dtp_input2">
                    <input class="form-control inputdate2" size="auto" type="text" value="<?php echo $date;?>" readonly>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
					<span class="input-group-btn"><button type="button" class="btn btn-primary btnSubmit" id="btnSubmit">Submit</button></span>
					<input type="hidden" id="dtp_input2" value="" /><br/>					
                </div>
          	</div>
          </div>
          <div class="row tile_count">
          	<div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-taxi"></i> Total Unique Unit Make Trip From Airport</span>
              <div class="count"><?php echo number_format($data['unique_unit']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-exchange"></i> Total Ritase From Airport</span>
              <div class="count blue"><?php echo number_format($data['total_ritase']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Total Argo From Airport</span>
              <div class="count green"><?php echo number_format($data['total_argo']); ?></div>
            </div> 
           </div>
           <div class="row tile_count"> 
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Avg Argo Per Ritase From Airport</span>
			  <div class="count purple"><?php echo number_format($data['arpu_shelter'], 2); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Avg Ritase From Airport Per Unit</span>
			  <div class="count blue"><?php echo number_format($data['total_arit'], 2); ?></div>
            </div>
			<div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Avg Argo From Airport Per Unit</span>
			  <div class="count green"><?php echo number_format($data['total_aapu'], 2); ?></div>
            </div>
          </div>
          <div class="row <?php if(isset($pool)) echo 'hidden';?>">
          	<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="x_panel tile fixed_height_320 overflow_hidden">
				  <div class="x_title">
					<h2>Unit Tiara VS Non Tiara</h2>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content2">
					<table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_tiara_unit" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Tiara</p>
                            </td>
                            <td><?php echo number_format($data['tiara_unit']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Non Tiara</p>
                            </td>
                            <td><?php echo number_format($data['non_tiara_unit']);?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
				  </div>
				</div>
			  </div>
			  <div class="col-md-4 col-sm-4 col-xs-12">
				<div class="x_panel tile fixed_height_320 overflow_hidden">
				  <div class="x_title">
					<h2>Ritase Tiara VS Non Tiara</h2>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content2">
					<table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_tiara_rit" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Tiara</p>
                            </td>
                            <td><?php echo number_format($data['tiara_rit']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Non Tiara</p>
                            </td>
                            <td><?php echo number_format($data['non_tiara_rit']);?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
				  </div>
				</div>
			  </div>
			  <div class="col-md-4 col-sm-4 col-xs-12">
				<div class="x_panel tile fixed_height_320 overflow_hidden">
				  <div class="x_title">
					<h2>Argo Tiara VS Non Tiara</h2>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content2">
					<table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_tiara_argo" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Tiara</p>
                            </td>
                            <td><?php echo number_format($data['tiara_argo']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Non Tiara</p>
                            </td>
                            <td><?php echo number_format($data['non_tiara_argo']);?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
				  </div>
				</div>
			  </div>
		  </div>
          <div class="row">			
          	<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>Total Unit by Ritase</h2>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content2">
					<div id="graph_area" style="width:100%; height:300px;"></div>
				  </div>
				</div>
			  </div>
			  <div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>Hourly Total Ritase VS Avg Argo Per Ritase</h2>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content2">
					<div id="graph_area3" style="width:100%; height:300px;"></div>
				  </div>
				</div>
			  </div>
          </div>
          <div class="row">
          	<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>30 Day Total Ritase VS Total Unit</h2>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content2">
					<div id="graph_area2" style="width:100%; height:300px;"></div>
				  </div>
				</div>
			  </div>
			  <div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>30 Day Total Ritase VS Avg Argo Per Unit</h2>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content2">
					<div id="graph_area4" style="width:100%; height:300px;"></div>
				  </div>
				</div>
			  </div>
          </div>
          <div class="row <?php if(isset($detail)) echo 'hidden';?>">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_content">
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content_detail" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">All</a>
                        </li>
                        <li role="presentation"><a href="#tab_content_pool" id="pool-tab" role="tab" data-toggle="tab" aria-expanded="true">Pool</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content_detail" aria-labelledby="home-tab">
                  <table id="datatable1" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Airport</th>
                    		<th>Check Map</th>
                    		<th>Ritase</th>                    		
                    		<th>Argo</th>
                    		<th>ARPU</th>
                    		<th>Ritase MTD</th>
                    		<th>Argo MTD</th>                    		
                    		<th>ARPU MTD</th>                    		
                    		<th>Ritase YTD</th>                    		
                    		<th>Argo YTD</th>                    		
                    		<th>ARPU YTD</th>                    		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <div id="ajax-modal-shelter" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
                    <?php
                    	echo '<script>
							var $modal = $("#ajax-modal-shelter"); 
							function load_page(url){
								$modal.load(url,function(){});
							}
							</script>';
                    	$total_ritase = 0;
                    	$total_argo = 0;	
                    	$total_ritase_mtd = 0;
                    	$total_argo_mtd = 0;	                    	
                    	$total_ritase_ytd = 0;
                    	$total_argo_ytd = 0;	                    	
                    	foreach ((Array) $data['shelter'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Airport/detail?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>';
                    		echo '<td><a id="click_'.$val['id'].'"><script>
									$("#click_'.$val['id'].'").on("click", function(){
										$modal.modal();
										load_page("'.site_url('/Airport/get_bandara?id='.$val['id']).'");
									});
									</script>Map</a></td>'.
                    		'<td class="'.($val['ritase'] >= $data['avg_ritase'] ? "green" : "red").'">'.number_format($val['ritase']).'</td>'.
							'<td class="'.($val['argo'] >= $data['avg_argo'] ? "green" : "red").'">'.number_format($val['argo']).'</td>'.
							'<td class="'.($val['arpu'] >= $data['arpu_shelter'] ? "green" : "red").'">'.number_format($val['arpu'], 2).'</td>'.
							'<td>'.number_format($val['ritase_mtd']).'</td>'.
							'<td>'.number_format($val['argo_mtd']).'</td>'.
							'<td class="'.($val['arpu_mtd'] >= $val['arpu_ytd'] ? "green" : "red").'">'.number_format($val['arpu_mtd'], 2).'</td>'.
							'<td>'.number_format($val['ritase_ytd']).'</td>'.
							'<td>'.number_format($val['argo_ytd']).'</td>'.
							'<td class="'.($val['arpu_ytd'] >= $data['arpu_shelter'] ? "green" : "red").'">'.number_format($val['arpu_ytd'], 2).'</td></tr>';
                    		$total_ritase += $val['ritase'];                    		
							$total_argo += $val['argo'];
							$total_ritase_mtd += $val['ritase_mtd'];                    		
							$total_argo_mtd += $val['argo_mtd'];
							$total_ritase_ytd += $val['ritase_ytd'];                    		
							$total_argo_ytd += $val['argo_ytd'];  
                    	}
                    	$total_arpu = $total_argo / ($total_ritase > 0 ? $total_ritase : 1);
                    	$total_arpu_mtd = $total_argo_mtd / ($total_ritase_mtd > 0 ? $total_ritase_mtd : 1);
                    	$total_arpu_ytd = $total_argo_ytd / ($total_ritase_ytd > 0 ? $total_ritase_ytd : 1);                    	                    	
                    	echo '</tbody><tfoot><tr><td colspan="2">TOTAL</td>'.
						'<td>'.number_format($total_ritase).'</td>'.     
						'<td>'.number_format($total_argo).'</td>'.
						'<td>'.number_format($total_arpu, 2).'</td>'.
						'<td>'.number_format($total_ritase_mtd).'</td>'.						
						'<td>'.number_format($total_argo_mtd).'</td>'.
						'<td>'.number_format($total_arpu_mtd, 2).'</td>'.						
						'<td>'.number_format($total_ritase_ytd).'</td>'.						
						'<td>'.number_format($total_argo_ytd).'</td>'.						
						'<td>'.number_format($total_arpu_ytd, 2).'</td></tr>';
                    ?>
                    </tfoot>
                  </table>
						  </div>
						  <div role="tabpanel" class="tab-pane fade " id="tab_content_pool" aria-labelledby="pool-tab">
                  			<?php 
								echo '<table id="datatable_pool" class="table table-striped" style="width:100%">';
									echo '<thead>
										<tr>
											<th>Pool</th>
											<th>Unit</th>
											<th>Ritase</th>                    		
											<th>Argo</th>
											<th>Avg Argo Per Ritase</th>
											<th>Avg Ritase</th>
											<th>Avg Argo Per Unit</th>																																	
										</tr>
									</thead>
									<tbody>';           	
										foreach((Array) $data['pool'] AS $key => $val){
											echo '<tr><td><a href="'.site_url("/Airport/pool?id=".$val['id_pool']."&date=".$date."").'">'.$val['name'].'</td>'.
											'<td>'.number_format($val['unit']).'</td>'.
											'<td>'.number_format($val['ct']).'</td>'.
											'<td>'.number_format($val['argo']).'</td>'.
											'<td class="'.($val['avg_argo'] >= $data['arpu_shelter'] ? "green" : "red").'">'.number_format($val['avg_argo'], 2).'</td>'.
											'<td class="'.($val['avg_ritase'] >= $data['total_arit'] ? "green" : "red").'">'.number_format($val['avg_ritase'], 2).'</td>'.
											'<td class="'.($val['avg_unit'] >= $data['total_aapu'] ? "green" : "red").'">'.number_format($val['avg_unit'], 2).'</td></tr>';
										}                   	                    	
										echo '</tbody>';
								  echo '</table>';
                        	?>
						  </div>
					</div>
					</div>	
                </div>
              </div>
			  </div>
              </div>
          <div class="row <?php if(!isset($detail)) echo 'hidden';?>">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_content">
                  <table id="datatable2" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>No.</th>                    	
                    		<th>No Pintu</th>
                    		<?php if(isset($pool)) echo '<th>Airport</th>';?>                    		
                    		<th>Argo</th>
                    		<th>Date</th>
                    		<th>Time Start</th>
                    		<th>Time End</th>
                    		<th>Trip Minutes</th>
                    		<th>Check Route</th>                    		                    		                    		           		                    		                    		                    		                    		           		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <div id="ajax-modal-map" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
                    <?php
                    	echo '<script>
							var $modal_map = $("#ajax-modal-map"); 
							function load_page_map(url){
								$modal_map.load(url,function(){});
							}
							</script>';
                    	$i = 1;
                    	foreach ((Array) $data['detail_unit'] AS $key => $val) { 
							$start = strtotime($val['time_start']);
							$end = strtotime($val['time_end']);
                    		echo '<tr><td>'.$i.'</td><td>'.$val['no_pintu'].'</td>';
							if(isset($pool)) echo '<td>'.($val['name']).'</td>';
							echo '<td>'.number_format($val['argo']).'</td>'.                    		
							'<td>'.date('Y-m-d', $start).'</td>'.
							'<td>'.date('H:i:s', $start).'</td>'.
							'<td>'.date('H:i:s', $end).'</td>'.
							'<td>'.number_format(round(abs($end - $start) / 60, 2)).' minutes</td>';
							if($val['id_trip'] !== null) {
								$is_tiara = $val['flag_tiara'] == 1;
								echo '<td><a id="click_map'.$val['id_trip'].'" class="blue"><script>
									$("#click_map'.$val['id_trip'].'").on("click", function(){
										$modal_map.modal();
										load_page_map("'.site_url('/Airport/get_map?id='.$val['id_trip'].'&is_tiara='.$is_tiara).'");
									});
									</script>Route</a></td></tr>';
							} else {
								echo '<td></td></tr>';
							}
							$i++;
                    	}                   	                    	
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
			  </div>
              </div>    
            </div>
          </div>
        </div>
        <!-- /page content -->
		
		<!-- jQuery -->
		<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/css/buttons.dataTables.min.css');?>" rel="stylesheet">
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
		<script src="<?php echo base_url('/assets/js/highcharts.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>		
		<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>		
		<script src="<?php echo base_url('/assets/js/dataTables.buttons.min.js');?>"></script>		
		<script src="<?php echo base_url('/assets/js/buttons.flash.min.js');?>"></script>		
		<script src="<?php echo base_url('/assets/js/buttons.html5.min.js');?>"></script>
		
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>

		<!-- Doughnut Chart -->
		<script>
		  $(document).ready(function(){
		  $('#datatable1').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
		  $('#datatable2').dataTable({bFilter: false, paging: false, bInfo: false, dom: 'Bfrtip', 
			buttons: [
				'csv', 'excel', 'pdf'
			]});	
		 $('#datatable_pool').dataTable({bFilter: false, paging: false, bInfo: false, dom: 'Bfrtip', 
			buttons: [
				'csv', 'excel', 'pdf'
			]});
		  $('#datatable4').dataTable({bFilter: false, paging: false, bInfo: false, dom: 'Bfrtip', 
			buttons: [
				'csv', 'excel', 'pdf'
			]});			
			var options = {
			  legend: false,
			  responsive: false
			};
			$('.btnSubmit').on('click', function (e) {
				var date = new Date($('.inputdate').val());
				var mm = date.getMonth() + 1;
				var dd = date.getDate();
				var yy = date.getFullYear();
				var date2 = new Date($('.inputdate2').val());
				var mm2 = date2.getMonth() + 1;
				var dd2 = date2.getDate();
				var yy2 = date2.getFullYear();
				if(yy2 > yy){
					var start = yy+'-'+mm+'-'+dd;
					var end = yy2+'-'+mm2+'-'+dd2;
				} else if (yy > yy2) {
					var start = yy2+'-'+mm2+'-'+dd2;
					var end = yy+'-'+mm+'-'+dd;
				} else if(yy2 == yy && mm2 > mm){
					var start = yy+'-'+mm+'-'+dd;
					var end = yy2+'-'+mm2+'-'+dd2;
				} else if(yy2 == yy && mm > mm2){
					var start = yy2+'-'+mm2+'-'+dd2;
					var end = yy+'-'+mm+'-'+dd;
				} else if(yy2 == yy && mm2 == mm && dd2 > dd) {
					var start = yy+'-'+mm+'-'+dd;
					var end = yy2+'-'+mm2+'-'+dd2;				
				} else {
					var start = yy2+'-'+mm2+'-'+dd2;
					var end = yy+'-'+mm+'-'+dd;
				}
				window.location = "<?php echo site_url('/Airport/'.(isset($tipe) ? 'tipe?id='.$tipe.'&' : (isset($area) ? 'area?id='.$area.'&' : (isset($detail) && !isset($pool) ? 'detail?id='.$detail.'&' : (isset($pool) ? 'pool?id='.$detail.'&' : 'index?')))));?>"+'start='+start+'&end='+end;
			});
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				startDate: '<?php echo $datetime->format('d-m-y');?>'
			});
			Morris.Bar({
			  element: 'graph_area',
			  data: [
			  	<?php 
			  	foreach((Array) $data['series']AS $key => $val){
			  		echo "{period: '".$val['total_ritase']."', ct: ".$val['ct']."},";
			  	}
				?>
			  ],
			  xkey: 'period',
			  ykeys: ['ct'],
			  lineColors: ['#E74C3C', '#1ABB9C', '#3498DB', '#3498DB'],
			  labels: ['Total Unit'],
			  hideHover: 'auto',
			  resize: true
			});
		});
		$(function () {
			Highcharts.chart('graph_area2', {
				chart: {
					zoomType: 'xy',
					type: 'column',					
				},
				title: {
					text: ''
				},
				xAxis: [{
					categories: [<?php 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo "'".date('D,d', strtotime($val['tgl']))."',";
						}
						?>],
					crosshair: false
				}],
				yAxis: [{ // Primary yAxis
					labels: {
						format: '{value}',
						style: {
							color: Highcharts.getOptions().colors[8]
						}
					},
					title: {
						text: 'Total Unit',
						style: {
							color: Highcharts.getOptions().colors[8]
						}
					},
					opposite: true					
				}, { // Secondary yAxis
					title: {
						text: 'Total Ritase',
						style: {
							color: Highcharts.getOptions().colors[0]						
						}
					},
					labels: {
						format: '{value}',
						style: {
							color: Highcharts.getOptions().colors[0]						
						}
					}
				}],
				tooltip: {
					shared: true
				},
				legend: {
					layout: 'vertical',
					align: 'left',
					x: 60,
					verticalAlign: 'top',
					y: 0,
					floating: true
				},
				plotOptions: {
					series: {
						stacking: 'normal'
					}
				},
				series: [<?php
				if(!isset($data['series_rds'][0]['rit_1'])){
					echo "{
					name: 'Total Ritase',
					yAxis: 1,					
					data: ["; 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo $val['total_ritase'].",";
						}
					echo "],
					color: Highcharts.getOptions().colors[0],
					},";
				}	
				else {				
				echo "{name: 'Term 3 Ultimate', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){					
							echo $val['rit_1'].",";
						}
					echo "], color: Highcharts.getOptions().colors[0], }, { name: 'Term 1A', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_2'])) continue;						
							echo $val['rit_2'].",";
						}
					echo "], color: Highcharts.getOptions().colors[1], }, {name: 'Term 1B', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_3'])) continue;						
							echo $val['rit_3'].",";
						}
					echo "], color: Highcharts.getOptions().colors[2], }, { name: 'Term 1C', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_4'])) continue;						
							echo $val['rit_4'].",";
						}
					echo "], color: Highcharts.getOptions().colors[3], }, { name: 'Term 2D', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_5'])) continue;						
							echo $val['rit_5'].",";
						}
					echo "], color: Highcharts.getOptions().colors[4], }, { name: 'Term 2F', yAxis: 1, data: ["; 
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_6'])) continue;						
							echo $val['rit_6'].",";
						}
					echo "], color: Highcharts.getOptions().colors[5], }, { name: 'Halim', yAxis: 1, data: ["; 
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_7'])) continue;						
							echo $val['rit_7'].",";
						}	
					echo "], color: Highcharts.getOptions().colors[6], },";
				}
				?>
				{
					name: 'Total Unit',
					type: 'spline',
					data: [
					<?php 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo ($val['total_unit']).",";
						}
					?>
					],
					color: Highcharts.getOptions().colors[8],
				}]
			});
    		Highcharts.chart('graph_area3', {
				chart: {
					zoomType: 'xy',
					type: 'column',
				},
				title: {
					text: ''
				},
				xAxis: [{
					categories: [<?php 
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							echo "'".($val['hr'] < 10 ? "0".$val['hr'] : $val['hr']).":00',";
						}
						?>],
					crosshair: false
				}],
				yAxis: [{ // Primary yAxis
					labels: {
						format: '{value}',
						style: {
							color: '#9B59B6'
						}
					},
					title: {
						text: 'Avg Argo Per Ritase',
						style: {
							color: '#9B59B6'
						}
					},
					opposite: true					
				}, { // Secondary yAxis
					title: {
						text: 'Total Ritase',
						style: {
							color: '#3498DB'
						}
					},
					labels: {
						format: '{value}',
						style: {
							color: '#3498DB'
						}
					},
				}],
				tooltip: {
					shared: true
				},
				legend: {
					layout: 'vertical',
					align: 'left',
					x: 55,
					verticalAlign: 'top',
					y: 0,
					floating: true
				},
				plotOptions: {
					series: {
						stacking: 'normal'
					}
				},
				series: [
				<?php
				if(!isset($data['hourly_ritase'][0]['rit_1'])){
					echo "{name: 'Non Tiara', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){					
							echo $val['rit_non_tiara'].",";
						}
					echo "], color: Highcharts.getOptions().colors[0], }, { name: 'Tiara', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_tiara'])) continue;						
							echo $val['rit_tiara'].",";
						}
					echo "], color: Highcharts.getOptions().colors[1], },";
				}	
				else {				
					echo "{name: 'Term 3 Ultimate', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){					
							echo $val['rit_1'].",";
						}
					echo "], color: Highcharts.getOptions().colors[0], }, { name: 'Term 1A', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_2'])) continue;						
							echo $val['rit_2'].",";
						}
					echo "], color: Highcharts.getOptions().colors[1], }, {name: 'Term 1B', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_3'])) continue;						
							echo $val['rit_3'].",";
						}
					echo "], color: Highcharts.getOptions().colors[2], }, { name: 'Term 1C', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_4'])) continue;						
							echo $val['rit_4'].",";
						}
					echo "], color: Highcharts.getOptions().colors[3], }, { name: 'Term 2D', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_5'])) continue;						
							echo $val['rit_5'].",";
						}
					echo "], color: Highcharts.getOptions().colors[4], }, { name: 'Term 2F', yAxis: 1, data: ["; 
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_6'])) continue;						
							echo $val['rit_6'].",";
						}
					echo "], color: Highcharts.getOptions().colors[5], }, { name: 'Halim', yAxis: 1, data: ["; 
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_7'])) continue;						
							echo $val['rit_7'].",";
						}	
					echo "], color: Highcharts.getOptions().colors[6], },";
				}
				?>
				{
					name: 'Avg Argo Per Ritase',
					type: 'spline',
					data: [
					<?php 
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							echo round($val['total_argo'] / $val['total_ritase'], 2).",";
						}
					?>
					],
					color: '#9B59B6',
				}]
			});
			Highcharts.chart('graph_area4', {
				chart: {
					zoomType: 'xy',
					type: 'column',
				},
				title: {
					text: ''
				},
				xAxis: [{
					categories: [<?php 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo "'".date('D,d', strtotime($val['tgl']))."',";
						}
						?>],
					crosshair: false
				}],
				yAxis: [{ // Primary yAxis
					labels: {
						format: '{value}',
						style: {
							color: Highcharts.getOptions().colors[5]
						}
					},
					title: {
						text: 'Avg Argo Per Unit',
						style: {
							color: Highcharts.getOptions().colors[5]
						}
					},
					opposite: true					
				}, { // Secondary yAxis
					title: {
						text: 'Total Ritase',
						style: {
							color: Highcharts.getOptions().colors[0]							
						}
					},
					labels: {
						format: '{value}',
						style: {
							color: Highcharts.getOptions().colors[0]							
						}
					}
				}],
				tooltip: {
					shared: true
				},
				legend: {
					layout: 'vertical',
					align: 'left',
					x: 120,
					verticalAlign: 'top',
					y: 0,
					floating: true
				},
				plotOptions: {
					series: {
						stacking: 'normal'
					}
				},
				series: [<?php
				if(!isset($data['series_rds'][0]['rit_tiara'])){
					echo "{
					name: 'Total Ritase',
					yAxis: 1,					
					data: ["; 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo $val['total_ritase'].",";
						}
					echo "],
					color: Highcharts.getOptions().colors[0],
					},";
				}	
				else {				
				echo "{name: 'Non Tiara', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){					
							echo $val['rit_non_tiara'].",";
						}
					echo "], color: Highcharts.getOptions().colors[0], }, { name: 'Tiara', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_tiara'])) continue;						
							echo $val['rit_tiara'].",";
						}
					echo "], color: Highcharts.getOptions().colors[1], },";
				}
				?>
				{
					name: 'Avg Argo Per Unit',
					type: 'spline',					
					data: [
					<?php 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo round($val['total_argo'] / ($val['total_unit'] > 0 ? $val['total_unit'] : 1), 2).",";
						}
					?>
					],
					color: Highcharts.getOptions().colors[5],					
				}]
			});
			var options = {
			  legend: false,
			  responsive: false
			};
			var tiara_unit = <?php echo round($data['tiara_unit'] / ($data['unique_unit'] > 0 ? $data['unique_unit'] : 1)*100,2);?>;
			var non_tiara_unit = <?php echo round($data['non_tiara_unit'] / ($data['unique_unit'] > 0 ? $data['unique_unit'] : 1) * 100,2);?>;		
			new Chart(document.getElementById("canvas_tiara_unit"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Tiara",
				  "Non Tiara"
				],
				datasets: [{
				  data: [tiara_unit, non_tiara_unit],
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
			var tiara_rit = <?php echo round($data['tiara_rit'] / ($data['total_ritase'] > 0 ? $data['total_ritase'] : 1)*100,2);?>;
			var non_tiara_rit = <?php echo round($data['non_tiara_rit'] / ($data['total_ritase'] > 0 ? $data['total_ritase'] : 1) * 100,2);?>;		
			new Chart(document.getElementById("canvas_tiara_rit"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Tiara",
				  "Non Tiara"
				],
				datasets: [{
				  data: [tiara_rit, non_tiara_rit],
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
			var tiara_argo = <?php echo round($data['tiara_argo'] / ($data['total_argo'] > 0 ? $data['total_argo'] : 1)*100,2);?>;
			var non_tiara_argo = <?php echo round($data['non_tiara_argo'] / ($data['total_argo'] > 0 ? $data['total_argo'] : 1) * 100,2);?>;		
			new Chart(document.getElementById("canvas_tiara_argo"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Tiara",
				  "Non Tiara"
				],
				datasets: [{
				  data: [tiara_argo, non_tiara_argo],
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