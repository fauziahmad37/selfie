		<!-- page content -->
		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>		
<style type="text/css">
 a:hover {
  cursor:pointer !important;
 }
</style>		
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2><?php if(!isset($is_detail)) echo 'Uber'; else echo $name; ?>, <?php $datetime = new DateTime($start); echo $datetime->format('j M Y').' - '.date('j M Y', strtotime($date)); ?></h2>
				<h4>Last Update <?php echo $data['last_update'];?></h4>
				</div>
                <div class="input-group col-md-4">
					<div class="input-group date form_date col-md-12" data-date-format="D, dd M yyyy" data-link-field="dtp_input1">
                    <input class="form-control inputdate" size="auto" type="text" value="<?php echo $start;?>" readonly>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
					<input type="hidden" id="dtp_input1" value="" /><br/>					
                </div>
                <div class="input-group date form_date col-md-12" data-date-format="D, dd M yyyy" data-link-field="dtp_input2">
                    <input class="form-control inputdate2" size="auto" type="text" value="<?php echo $date;?>" readonly>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
					<span class="input-group-btn"><button type="button" class="btn btn-primary btnSubmit" id="btnSubmit">Submit</button></span>
					<input type="hidden" id="dtp_input2" value="" /><br/>					
				  <?php
				  if($this->user['id_privilege'] === '1' || $this->user['id_privilege'] === '8' || $this->user['id_privilege'] === '3')
				  	echo '<span class="input-group-btn"><button type="button" class="btn btn-primary btnUpdate" id="btnUpdate">Update</button></span>';
				  ?>
                </div>
          	</div>
          </div>
          <div class="row tile_count">
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Registered Active Driver</span>
              <div class="count"><?php echo number_format($data['active']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-car"></i> Total Online Driver</span>
              <div class="count green"><?php echo number_format($data['has_online']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Online Rate</span>
              <?php
				if($data['active_rate'] >= 80){
					echo '<div class="count green">';
				} else if($data['active_rate'] >= 50){
					echo '<div class="count orange">';
				} else {
					echo '<div class="count red">';
				}
				echo number_format($data['active_rate'], 2).'%</div>';
			  ?>
            </div>     
          </div>
          <div class="row tile_count">
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Trips</span>
              <div class="count blue"><?php echo number_format($data['total_trip']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-car"></i> Total Fares</span>
              <div class="count green"><?php echo number_format($data['total_fare']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Avg Fares per Trip</span>
              <div class="count"><?php echo number_format($data['avg_fare'], 2); ?></div>
            </div>   
          </div>
		  <div class="row">
		  <!-- graph area -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day Online</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_line" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
          <!-- graph area -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day Trips</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_trip" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
          </div>
          <div class="x_panel col-md-12 col-sm-12 col-xs-12">
			  <div>
				<div class="x_title">
				  <h2>Top Performer Uber</h2>
				  <div class="clearfix"></div>
				</div>
				<?php 
				$ct_col = 0;
				$ct_row = 0;				
				foreach((Array) $data['top'] AS $key => $val){
					if($ct_row == 0)
						echo '<div class="col-md-6 col-sm-12 col-xs-12"><ul class="list-unstyled top_profiles scroll-view">';
					
					echo '<li class="media event">
						<a class="pull-left border-aero profile_thumb">
						  <i class="fa fa-user aero"></i>
						</a>
						<div class="media-body">
						  <a class="title">'.$val['driver'].'</a>						  
						  <p>Rp '.number_format($val['fare']).'<small> ('.$val['trip'].' trips)</small></p>
						  <p><strong>'.$val['name'].'</strong> <i class="fa fa-phone"></i>  '.$val['no_hp'].'</p> 
						</div>
					  </li>';
					
					$ct_row++;
					if($ct_row == 10){
						echo '</ul></div>';
						$ct_row = 0;
						$ct_col++;
					}					
				}
				?>
			  </div>
			</div>
          <div class="row <?php echo (isset($is_detail) ? 'hidden' : '');?>">
			<div class="col-md-12 col-sm-12 col-xs-12">
            
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Pools</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="datatable" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>
                    		<th>Registered</th>    
                    		<th>Online</th>
                    		<th>Online Rate</th> 
                    		<th>Hours Online</th>
                    		<th>Avg Hours Online</th>                    		
                    		<th>Made Trip</th>                    		
                    		<th>Trips</th>             
                    		<th>Avg Trip per Driver</th>                    		       		
                    		<th>Gross Fares</th>
                    		<th>Avg Fares per Trip</th> 
                    		<th>Setoran</th>
                    		<th>KS</th>                    		                     		                   		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_registered = 0;
                    	$total_online = 0;
                    	$total_hours_online = 0;
                    	$total_made_trip = 0;
                    	$total_trips = 0;
                    	$total_fares = 0;      
                    	$total_setoran = 0;
                    	$total_ks = 0;                    	              	                    	                    	                    	                    	
                    	foreach ((Array) $data['pool'] AS $key => $val) { 
                    		$rate = number_format($val['online'] / ($val['active'] > 0 ? $val['active'] : 1) * 100,2);
                    		echo '<tr><td><a href="'.site_url("/Uber/detail?id=".$val['id']."&start=".$start."&end=".$date).'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['active']).'</td>'.
                    		'<td class="green">'.number_format($val['online']).'</td>';
                    		if($rate >= 80){
								echo '<td class="count green">';
							} else if($rate >= 50){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo ($rate).'%</td>'.               
                    		'<td class="purple">'.number_format($val['hours_online'], 2).'</td>'.
                    		'<td class="purple">'.number_format($val['avg_hours_online'], 2).'</td>'.                    									
                    		'<td class="blue">'.number_format($val['has_trip']).'</td>'.                    		
                    		'<td class="blue">'.number_format($val['trip']).'</td>'.
                    		'<td class="blue">'.number_format($val['avg_trip'], 2).'</td>'.
                    		'<td class="green">'.number_format($val['fare']).'</td>'.
                    		'<td class="green">'.number_format($val['avg_fare'], 2).'</td>'.
                    		'<td class="green">'.number_format($val['setoran']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['ks']).'</td></tr>';
							$total_registered += $val['active'];
							$total_online += $val['online'];
							$total_hours_online += $val['hours_online'];
							$total_made_trip += $val['has_trip'];
							$total_trips += $val['trip'];
							$total_fares += $val['fare'];
							$total_setoran += $val['setoran'];
							$total_ks += $val['ks'];
                    	}
                    	$total_avg_hours_online = $total_hours_online / ($total_online > 0 ? $total_online : 1);
                    	$total_avg_trip = $total_trips / ($total_made_trip > 0 ? $total_made_trip : 1);
                    	$total_avg_fare = $total_fares / ($total_trips > 0 ? $total_trips : 1);
                    	$total_online_rate = $total_online / ($total_registered > 0 ? $total_registered : 1) * 100;
						echo '</tbody><tfoot><tr><td>Total</td>'.
						'<td>'.number_format($total_registered).'</td>'.
						'<td class="green">'.number_format($total_online).'</td>';
						if($total_online_rate >= 80){
							echo '<td class="count green">';
						} else if($total_online_rate >= 50){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count red">';
						}
						echo number_format($total_online_rate, 2).'%</td>'.               
						'<td class="purple">'.number_format($total_hours_online, 2).'</td>'.
						'<td class="purple">'.number_format($val['avg_hours_online'], 2).'</td>'.                    									
						'<td class="blue">'.number_format($total_made_trip).'</td>'.                    		
						'<td class="blue">'.number_format($total_trips).'</td>'.
						'<td class="blue">'.number_format($total_avg_trip, 2).'</td>'.
						'<td class="green">'.number_format($total_fares).'</td>'.
						'<td class="green">'.number_format($total_avg_fare, 2).'</td>'.
						'<td class="green">'.number_format($total_setoran).'</td>'.												
						'<td class="red">'.number_format($total_ks).'</td></tr></tfoot>';               	                    	                    	
                    ?>
                  </table>
                </div>
              </div>
          </div>
              </div>
          <div class="row <?php echo (!isset($is_detail) ? 'hidden' : '');?>">
			<div class="col-md-12 col-sm-12 col-xs-12">
            
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Drivers</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="datatable2" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Name</th>
                    		<th>HP</th>                    		
                    		<th>Status</th>    
                    		<th>Trips Offered</th>                    		
                    		<th>Trips</th>                    		
                    		<th>Gross Fares</th> 
                    		<th>Avg Gross Fares Per Trip</th> 
                    		<th>Hours Online</th>
                    		<th>Uber Days</th>
                    		<th>Avg Trip Uber / Day</th>
                    		<th>Avg Hours Online / Day</th>
                    		<th>Acceptance Rate</th>
                    		<!--<th>Completion Rate</th>-->
                    		<th>Setoran</th>
                    		<th>KS</th>
							<th>SPJ Days</th>                    				                    		           		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_trip = 0;
                    	$total_fare = 0;                    	
                    	$total_hours = 0;
                    	$total_hk = 0;
                    	$total_setoran = 0;                    	
                    	$total_ks = 0;
                    	$total_spj = 0; 
						$total_avg_acceptance = 0;
						$total_avg_completion = 0;
						$total_trip_offered = 0;
						$total_trip_accepted = 0;
                    	foreach ((Array) $data['drivers'] AS $key => $val) { 
                    		$avg_trip_day = $val['trip'] / ($val['hk'] > 0 ? $val['hk'] : 1);
                    		$avg_hour_day = $val['hours_online'] / 60 / ($val['hk'] > 0 ? $val['hk'] : 1);  
                    		$trip_offered = 1 / ($val['avg_completion'] > 0 ? $val['avg_completion'] : 1) * 100 * $val['trip']; 
							$trip_accepted = 1 / ($val['avg_acceptance'] > 0 ? $val['avg_acceptance'] : 1) * 100 * $val['trip']; 
                    		echo '<tr><td class="'.(($val['hk'] == 0 && $val['spj'] > 0 && 
                    			$val['status'] === 'active') ? 'red' : ($val['status'] === 'active' && $val['hk'] > 0 ? 'blue' : '')).'">'.
                    			$val['driver'].'</td>'.
                    		'<td>'.($val['no_hp']).'</td>'.                    			
                    		'<td>'.($val['status']).'</td>'.                    		
                    		'<td>'.number_format($trip_offered).'</td>'.                    		
                    		'<td class="'.($val['trip'] > 0 ? 'blue' : 'red').'">'.number_format($val['trip']).'</td>'.             
                    		'<td class="'.($val['fare'] > 0 ? 'green' : 'red').'">'.number_format($val['fare']).'</td>'.
                    		'<td class="'.($val['fare'] > 0 ? 'green' : 'red').'">'.number_format($val['avg_fare'], 2).'</td>'.                    									
                    		'<td class="'.($val['hours_online'] > 0 ? 'purple' : 'red').'">'.number_format($val['hours_online']/ 60, 2).'</td>'.
                    		'<td class="'.($val['hk'] > 0 ? 'green' : 'red').'">'.number_format($val['hk']).'</td>'.
                    		'<td class="'.($avg_trip_day > 0 ? 'blue' : 'red').'">'.number_format($avg_trip_day, 2).'</td>'.
                    		'<td class="'.($avg_hour_day > 0 ? 'purple' : 'red').'">'.number_format($avg_hour_day, 2).'</td>'.                    		
                    		'<td class="'.($val['avg_acceptance'] > 75 ? 'green' : 'red').'">'.number_format($val['avg_acceptance'], 2).'%</td>'.
//                     		'<td class="'.($val['avg_completion'] > 75 ? 'green' : 'red').'">'.number_format($val['avg_completion'], 2).'%</td>'.                    		                    		                    		                    		
                    		'<td class="'.($val['setoran'] > 0 ? 'green' : 'red').'">'.number_format($val['setoran']).'</td>'.
                    		'<td class="'.($val['ks'] > 0 ? 'red' : 'green').'">'.number_format($val['ks']).'</td>'.
                    		'<td>'.number_format($val['spj']).'</td></tr>';                    		                    		                    		                    		
                    		$total_trip += $val['trip'];
							$total_fare += $val['fare'];
							$total_hours += ($val['hours_online'] / 60);
							$total_hk += $val['hk'];
							$total_setoran += $val['setoran'];
							$total_ks += $val['ks'];
							$total_spj += $val['spj'];
							$total_avg_acceptance += $val['avg_acceptance'];
							$total_avg_completion += $val['avg_completion'];		
							$total_trip_offered += $trip_offered;
							$total_trip_accepted += $trip_accepted;												
                    	}
                    	$total_avg_fare = $total_fare / ($total_trip > 0 ? $total_trip : 1);
						$total_avg_hour_day = $total_hours / ($total_hk > 0 ? $total_hk : 1);
						$total_avg_trip_day = $total_trip / ($total_hk > 0 ? $total_hk : 1);
						$total_avg_acceptance = $total_trip_accepted / ($total_trip_offered > 0 ? $total_trip_offered : 1) * 100;
						$total_avg_completion = $total_trip / ($total_trip_offered > 0 ? $total_trip_offered : 1) * 100;						
                    	echo '</tbody><tfoot>'.
                    		'<tr><td colspan = "3">Total</td>'.
                    		'<td>'.number_format($total_trip_offered).'</td>'.
                    		'<td class="'.($total_trip > 0 ? 'blue' : 'red').'">'.number_format($total_trip).'</td>'.
                    		'<td class="'.($total_fare > 0 ? 'green' : 'red').'">'.number_format($total_fare).'</td>'.
                    		'<td class="'.($total_fare > 0 ? 'green' : 'red').'">'.number_format($total_avg_fare, 2).'</td>'.                    									
                    		'<td class="'.($total_hours > 0 ? 'purple' : 'red').'">'.number_format($total_hours, 2).'</td>'.
                    		'<td class="'.($total_hk > 0 ? 'green' : 'red').'">'.number_format($total_hk).'</td>'.
                    		'<td class="'.($total_avg_trip_day > 0 ? 'blue' : 'red').'">'.number_format($total_avg_trip_day, 2).'</td>'.
                    		'<td class="'.($total_avg_hour_day > 0 ? 'purple' : 'red').'">'.number_format($total_avg_hour_day, 2).'</td>'.
                    		'<td class="'.($total_avg_acceptance > 75 ? 'green' : 'red').'">'.number_format($total_avg_acceptance, 2).'%</td>'.
//                     		'<td class="'.($total_avg_completion > 75 ? 'green' : 'red').'">'.number_format($total_avg_completion, 2).'%</td>'.                    		                    		                    		                    		
                    		'<td class="'.($total_setoran > 0 ? 'green' : 'red').'">'.number_format($total_setoran).'</td>'.
                    		'<td class="'.($total_ks > 0 ? 'red' : 'green').'">'.number_format($total_ks).'</td>'.
                    		'<td>'.number_format($total_spj).'</td></tr>';                    		                    		                    		                    		
                    ?>
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
		<script>
		$(document).ready(function(){
		  $('#datatable').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
		  $('#datatable2').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});	
		});
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
			window.location = "<?php echo site_url('/Uber/'.(isset($is_detail) ? 'detail?id='.$id.'&' : 'index?'));?>"+'start='+start+'&end='+end;
		});
		$('.btnUpdate').on('click', function (e) {
				window.location = "<?php echo site_url('/Uberdata');?>";
			});	
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				startDate: '<?php echo $datetime->format('d-m-y');?>'
			});
		Highcharts.chart('graph_line', {
				chart: {
					zoomType: 'xy',
					type: 'column',					
				},
				title: {
					text: ''
				},
				xAxis: [{
					categories: [<?php 
						foreach((Array) $data['last_30']AS $key => $val){
							echo "'".date('D,d', strtotime($val['tgl']))."',";
						}
						?>],
					crosshair: false
				}],
				yAxis: [{ // Primary yAxis
					labels: {
						format: '{value}',
						style: {
							color: Highcharts.getOptions().colors[0]						
						}
					},
					title: {
						text: 'Total Online',
						style: {
							color: Highcharts.getOptions().colors[0]						
						}
					},
					opposite: true					
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
				},
				series: [<?php
					echo "{name: 'Driver Online', data: [";
						foreach((Array) $data['last_30']AS $key => $val){					
							echo $val['online'].",";
						}
					echo "], color: Highcharts.getOptions().colors[0], }, { name: 'Driver Made Trip', data: [";
						foreach((Array) $data['last_30']AS $key => $val){						
							echo $val['ct'].",";
						}
					echo "], color: Highcharts.getOptions().colors[5], }";
				?>
				]
			});
		Highcharts.chart('graph_trip', {
				chart: {
					zoomType: 'xy',
					type: 'column',
				},
				title: {
					text: ''
				},
				xAxis: [{
					categories: [<?php 
						foreach((Array) $data['last_30'] AS $key => $val){
							echo "'".date('D,d', strtotime($val['tgl']))."',";
						}
						?>],
					crosshair: false
				}],
				yAxis: [{ // Primary yAxis
					labels: {
						format: '{value}',
						style: {
							color: '#3498DB'
						}
					},
					title: {
						text: 'Avg Fare Per Trip',
						style: {
							color: '#3498DB'
						}
					},
					opposite: true					
				}, { // Secondary yAxis
					title: {
						text: 'Avg Trip Per Driver',
						style: {
							color: Highcharts.getOptions().colors[2]							
						}
					},
					labels: {
						format: '{value}',
						style: {
							color: Highcharts.getOptions().colors[2]							
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
					echo "{
					name: 'Avg Trip Per Driver',
					yAxis: 1,					
					data: ["; 
						foreach((Array) $data['last_30']AS $key => $val){
							echo round($val['trip'] / ($val['ct'] > 0 ? $val['ct'] : 1), 2).",";
						}
					echo "],
					color: Highcharts.getOptions().colors[2],
					},";
				?>
				{
					name: 'Avg Fare Per Trip',
					type: 'spline',					
					data: [
					<?php 
						foreach((Array) $data['last_30']AS $key => $val){
							echo round($val['fare'] / ($val['trip'] > 0 ? $val['trip'] : 1), 2).",";
						}
					?>
					],
					color: '#3498DB',					
				}]
			});	
		</script>
		
		<!-- Doughnut Chart -->
		<!-- /Doughnut Chart -->