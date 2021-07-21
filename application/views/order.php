		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Order
          		<?php if(strtotime($start) == strtotime($date)) {
          			$datetime = new DateTime($date); echo ' - '.$datetime->format('l, j F Y').'</h2>'; 
          			} else {
          			$datetime = new DateTime($start); echo '</h2><h4>'.$datetime->format('l, j F Y').' to '; 
          			$datetime2 = new DateTime($date); echo $datetime2->format('l, j F Y').'</h4>';           			
          			}
          		?>
          		<h4> Last Update <?php echo date('j F Y H:i:s');?>          		
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
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Order</span>
              <div class="count"><?php echo number_format($data['total_order']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total Successful Order</span>
              <div class="count"><?php echo number_format($data['completed']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Successful Rate</span>
              <?php
				if($data['rate_order'] >= 85){
					echo '<div class="count green">';
				} else if($data['rate_order'] >= 60){
					echo '<div class="count orange">';
				} else {
					echo '<div class="count red">';
				}
				echo number_format($data['rate_order'], 2).'%</div>';
			  ?>
            </div>     
          </div>
		  <div class="row tile_count">
		  	 <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Avg Arrived Time</span>
              <div class="count"><?php echo date('i \m\i\n s \s\e\c',strtotime($data['time']['arrived'])); ?></div>
            </div>
		  	 <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Avg Board Time</span>
              <div class="count"><?php echo date('i \m\i\n s \s\e\c',strtotime($data['time']['board'])); ?></div>
            </div>
          </div>
          <div class="row">  
		  <!-- graph area -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day Order</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_order" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
          <!-- graph area -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day Broadcast</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_broadcast" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
          </div>
          <div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Progress Order</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_order" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Completed</p>
                            </td>
                            <td><?php echo number_format($data['completed']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>On Progress</p>
                            </td>
                            <td><?php echo number_format($data['progress']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Cancelled By Cust</p>
                            </td>
                            <td><?php echo number_format($data['cancel_customer']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Cancelled By Driver</p>
                            </td>
                            <td><?php echo number_format($data['cancel_driver']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>Cancelled By Other Taxi</p>
                            </td>
                            <td><?php echo number_format($data['cancel_other_taxi']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Failed</p>
                            </td>
                            <td><?php echo number_format($data['failed']);?></td>
                          </tr>
                          <tr>
                          	<td><p><br/></p> 
                          	</td>
                          </tr>
                          <tr>
                          	<td><p><br/></p> 
                          	</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Order Channel</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_channel" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>MyTrip</p>
                            </td>
                            <td><?php echo number_format($data['thomas']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Call Center</p>
                            </td>
                            <td><?php echo number_format($data['call_center']);?></td>
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
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2><?php echo '<a href="'.site_url("/Detail/area?id=1&date=".$date."").'">';?>Pool Reguler Area 1</a></h2>              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>
                    		<th>Broadcast</th>
                    		<th>Accept</th>
                    		<th>Reject</th>
                    		<th>No Response</th>
                    		<th>Pct Accept</th> 
                    		<th>Pct No Response + Reject</th> 
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_broadcast = 0;
                    	$total_accept = 0;
                    	$total_reject = 0; 
                    	$total_no_response = 0;            	
                    	foreach ((Array) $data['pool_reguler_data'] AS $key => $val) { 
                    		$no_response = $val['broadcast'] - $val['accept'];
                    		$pct_no_response = $no_response / ($val['broadcast'] > 0 ? $val['broadcast'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['pool_id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['broadcast']).'</td>'.
                    		'<td class="green">'.number_format($val['accept']).'</td>'.
                    		'<td class="red">'.number_format($val['reject']).'</td>'.
                    		'<td class="orange">'.number_format($no_response - $val['reject']).'</td>';
                    		if($val['pct_accept'] >= 85){
								echo '<td class="count green">';
							} else if($val['pct_accept'] >= 60){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo number_format($val['pct_accept'], 2).'%</td>';
							if($pct_no_response >= 50){
								echo '<td class="count red">';
							} else if($pct_no_response >= 25){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count green">';
							}
							echo number_format($pct_no_response, 2).'%</td></tr>';
                    		$total_accept += $val['accept'];
                    		$total_reject += $val['reject'];
                    		$total_broadcast += $val['broadcast'];
                    	}
                    	$total_pct_accept = $total_accept / ($total_broadcast > 0 ? $total_broadcast : 1) * 100;
                    	$total_no_response = $total_broadcast - $total_accept;
                    	$total_pct_no_resp =  $total_no_response / ($total_broadcast > 0 ? $total_broadcast : 1) * 100;
                    	echo '<tr><td>TOTAL AREA 1</td>'.
                    	'<td>'.number_format($total_broadcast).'</td>'.
                    	'<td class="green">'.number_format($total_accept).'</td>'.
                    	'<td class="red">'.number_format($total_reject).'</td>'.
                    	'<td class="orange">'.number_format($total_no_response - $total_reject).'</td>';
                    	if($total_pct_accept >= 85){
							echo '<td class="count green">';
						} else if($total_pct_accept >= 60){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count red">';
						}
						echo number_format($total_pct_accept, 2).'%</td>';
						if($total_pct_no_resp >= 50){
							echo '<td class="count red">';
						} else if($total_pct_no_resp >= 25){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count green">';
						}
						echo number_format($total_pct_no_resp, 2).'%</td></tr>';
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="x_panel tile">
                <div class="x_title">
                  <h2><?php echo '<a href="'.site_url("/Detail/area?id=2&date=".$date."").'">';?>Pool Reguler Area 2</a></h2>      
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>
                    		<th>Broadcast</th>
                    		<th>Accept</th>
                    		<th>Reject</th>
                    		<th>No Response</th>
                    		<th>Pct Accept</th> 
                    		<th>Pct No Response + Reject</th> 
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_broadcast = 0;
                    	$total_accept = 0;
                    	$total_reject = 0; 
                    	$total_no_response = 0;            	
                    	foreach ((Array) $data['pool_reguler2_data'] AS $key => $val) { 
                    		$no_response = $val['broadcast'] - $val['accept'];
                    		$pct_no_response = $no_response / ($val['broadcast'] > 0 ? $val['broadcast'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['pool_id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['broadcast']).'</td>'.
                    		'<td class="green">'.number_format($val['accept']).'</td>'.
                    		'<td class="red">'.number_format($val['reject']).'</td>'.
                    		'<td class="orange">'.number_format($no_response - $val['reject']).'</td>';
                    		if($val['pct_accept'] >= 85){
								echo '<td class="count green">';
							} else if($val['pct_accept'] >= 60){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo number_format($val['pct_accept'], 2).'%</td>';
							if($pct_no_response >= 50){
								echo '<td class="count red">';
							} else if($pct_no_response >= 25){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count green">';
							}
							echo number_format($pct_no_response, 2).'%</td></tr>';
                    		$total_accept += $val['accept'];
                    		$total_reject += $val['reject'];
                    		$total_broadcast += $val['broadcast'];
                    	}
                    	$total_pct_accept = $total_accept / ($total_broadcast > 0 ? $total_broadcast : 1) * 100;
                    	$total_no_response = $total_broadcast - $total_accept;
                    	$total_pct_no_resp =  $total_no_response / ($total_broadcast > 0 ? $total_broadcast : 1) * 100;
                    	echo '<tr><td>TOTAL AREA 2</td>'.
                    	'<td>'.number_format($total_broadcast).'</td>'.
                    	'<td class="green">'.number_format($total_accept).'</td>'.
                    	'<td class="red">'.number_format($total_reject).'</td>'.
                    	'<td class="orange">'.number_format($total_no_response - $total_reject).'</td>';
                    	if($total_pct_accept >= 85){
							echo '<td class="count green">';
						} else if($total_pct_accept >= 60){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count red">';
						}
						echo number_format($total_pct_accept, 2).'%</td>';
						if($total_pct_no_resp >= 50){
							echo '<td class="count red">';
						} else if($total_pct_no_resp >= 25){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count green">';
						}
						echo number_format($total_pct_no_resp, 2).'%</td></tr>';
                    ?>
                    </tbody>
                  </table>
                </div>
            </div>
			<div class="x_panel tile">
                <div class="x_title">
                  <h2><?php echo '<a href="'.site_url("/Detail/area?id=4&date=".$date."").'">';?>Pool Eagle</a></h2>      
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>
                    		<th>Broadcast</th>
                    		<th>Accept</th>
                    		<th>Reject</th>
                    		<th>No Response</th>
                    		<th>Pct Accept</th> 
                    		<th>Pct No Response + Reject</th> 
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_broadcast = 0;
                    	$total_accept = 0;
                    	$total_reject = 0; 
                    	$total_no_response = 0;            	
                    	foreach ((Array) $data['pool_eagle_data'] AS $key => $val) { 
                    		$no_response = $val['broadcast'] - $val['accept'];
                    		$pct_no_response = $no_response / ($val['broadcast'] > 0 ? $val['broadcast'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['pool_id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['broadcast']).'</td>'.
                    		'<td class="green">'.number_format($val['accept']).'</td>'.
                    		'<td class="red">'.number_format($val['reject']).'</td>'.
                    		'<td class="orange">'.number_format($no_response - $val['reject']).'</td>';
                    		if($val['pct_accept'] >= 85){
								echo '<td class="count green">';
							} else if($val['pct_accept'] >= 60){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo number_format($val['pct_accept'], 2).'%</td>';
							if($pct_no_response >= 50){
								echo '<td class="count red">';
							} else if($pct_no_response >= 25){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count green">';
							}
							echo number_format($pct_no_response, 2).'%</td></tr>';
                    		$total_accept += $val['accept'];
                    		$total_reject += $val['reject'];
                    		$total_broadcast += $val['broadcast'];
                    	}
                    	$total_pct_accept = $total_accept / ($total_broadcast > 0 ? $total_broadcast : 1) * 100;
                    	$total_no_response = $total_broadcast - $total_accept;
                    	$total_pct_no_resp =  $total_no_response / ($total_broadcast > 0 ? $total_broadcast : 1) * 100;
                    	echo '<tr><td>TOTAL EAGLE</td>'.
                    	'<td>'.number_format($total_broadcast).'</td>'.
                    	'<td class="green">'.number_format($total_accept).'</td>'.
                    	'<td class="red">'.number_format($total_reject).'</td>'.
                    	'<td class="orange">'.number_format($total_no_response - $total_reject).'</td>';
                    	if($total_pct_accept >= 85){
							echo '<td class="count green">';
						} else if($total_pct_accept >= 60){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count red">';
						}
						echo number_format($total_pct_accept, 2).'%</td>';
						if($total_pct_no_resp >= 50){
							echo '<td class="count red">';
						} else if($total_pct_no_resp >= 25){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count green">';
						}
						echo number_format($total_pct_no_resp, 2).'%</td></tr>';
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
		
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>

		<!-- Doughnut Chart -->
		<script>
		  $(document).ready(function(){
			var options = {
			  legend: false,
			  responsive: false
			};
			
			Morris.Line({
			  element: 'graph_broadcast',
			  data: [
			  	<?php 
			  	foreach((Array) $data['broadcast_series'] AS $key => $val){
			  		echo "{period: '".$val['dt']."', broadcast: ".$val['broadcast'].", accept: ".$val['accept'].", reject: ".$val['reject']."},";
			  	}
				?>
			  ],
			  xkey: 'period',
			  ykeys: ['broadcast', 'accept', 'reject'],
			  lineColors: ['#3498DB', '#1ABB9C', '#E74C3C', '#3498DB'],
			  labels: ['Broadcast', 'Accept', 'Reject'],
			  pointSize: 2,
			  hideHover: 'auto',
			  resize: true
			});
			
			Morris.Area({
			  element: 'graph_order',
			  data: [
			  	<?php 
			  	foreach((Array) $data['order_series'] AS $key => $val){
			  		echo "{period: '".$val['dt']."', mytrip: ".$val['mytrip'].", call_center: ".$val['call_center']."},";
			  	}
				?>
			  ],
			  xkey: 'period',
			  ykeys: ['call_center', 'mytrip'],
			  lineColors: ['#1ABB9C', '#E74C3C', '#3498DB', '#3498DB'],
			  labels: ['Call Center', 'MyTrip'],
			  hideHover: 'auto',
			  resize: true
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
				window.location = "<?php echo site_url('/Order/index?');?>"+'start='+start+'&end='+end;
			});
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				startDate: '<?php echo $datetime->format('d-m-y');?>'
			});
			
			var completed = <?php echo $data['completed'];?>;
			var on_progress = <?php echo $data['progress'];?>;
			var cancel_cust = <?php echo $data['cancel_customer'];?>;
			var cancel_driver = <?php echo $data['cancel_driver'];?>;
			var cancel_other_taxi = <?php echo $data['cancel_other_taxi'];?>;
			var failed = <?php echo $data['failed'];?>;		
			new Chart(document.getElementById("canvas_order"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Completed",
				  "On Progress",
				  "Cancel Cust",
				  "Cancel Driver",
				  "Cancel Other",
				  "Failed"
				],
				datasets: [{
				  data: [completed, on_progress, cancel_cust, cancel_driver, cancel_other_taxi, failed],
				  backgroundColor: [
					"#26B99A",
					"#3498DB",
					"#9B59B6",
					"#E74C3C",
					"#FFA500",
					"#9CC2CB"
				  ],
				  hoverBackgroundColor: [
					"#36CAAB",
					"#49A9EA",
					"#B370CF",
					"#E95E4F",
					"#FED500",
					"#8CB2BB"				  
				  ]
				}]
			  },
			  options: options
			});
			var thomas = <?php echo $data['thomas'];?>;
			var call_center = <?php echo $data['call_center'];?>;
			new Chart(document.getElementById("canvas_channel"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "MyTrip",
				  "Call Center"
				],
				datasets: [{
				  data: [thomas, call_center],
				  backgroundColor: [
					"#26B99A",
					"#3498DB",
					"#9B59B6",
					"#E74C3C",
					"#FFA500",
					"#9CC2CB"
				  ],
				  hoverBackgroundColor: [
					"#36CAAB",
					"#49A9EA",
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