		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2><?php echo $name.' - '; $datetime = new DateTime($date); echo $datetime->format('l, j F Y'); ?></h2>
          		<h4>Last Update <?php echo $date;?>
				</div>
          	</div>
          </div>
          <div class="row tile_count">
            <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-mobile-phone"></i> Total Login</span>
              <div class="count"><?php echo number_format($data['total_total']); ?></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-mobile-phone"></i> Total Normal</span>
              <div class="count green"><?php echo number_format($data['total_normal']); ?></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-mobile-phone"></i> Total N/A</span>
              <div class="count red"><?php echo number_format($data['total_na']); ?></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Pct N/A</span>
              <div class="count <?php echo ($data['pct_na'] >= 20 ? 'red' : ($data['pct_na'] >= 10 ? 'orange' : 'green')); ?>"><?php echo $data['pct_na']; ?>%</div>
            </div>            
          </div>
		  <div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                  <h2>RDS Update Location</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_na" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Normal</p>
                            </td>
                            <td><?php echo number_format($data['total_normal']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>N/A</p>
                            </td>
                            <td><?php echo number_format($data['total_na']);?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
			
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                  <h2>Status RDS</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_status" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>All Connected</p>
                            </td>
                            <td><?php echo number_format($data['total_connected']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Error</p>
                            </td>
                            <td><?php echo number_format($data['total_error']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Argometer Not Connected</p>
                            </td>
                            <td><?php echo number_format($data['total_argo']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>None Connected</p>
                            </td>
                            <td><?php echo number_format($data['total_none']);?></td>
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
                  <h2>Fail Login</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="datatable2" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>No</th>      
                    		<th>Nomor Pintu</th>                  		                    		                    		                    		             		
                    		<th>Username / SPJ</th>
                    		<th>DDS IMEI</th>
                    		<th>Response</th>                    		
                    		<th>Attempt Time</th>
                    	</tr>
                    </thead>
                    <tbody>
                    <?php				
                    	$i = 1;
                    	foreach ((Array) $data['fail'] AS $key => $val) { 
                    		echo '<tr><td>'.$i.'</td>'.   
                    		'<td>'.($val['reg_no']).'</td>'.                    		               		
                    		'<td>'.($val['username_spj']).'</td>'.
                    		'<td>'.($val['imei']).'</td>'.
                    		'<td>'.($val['response']).'</td>'.
                    		'<td>'.date('H:i:s d M Y', strtotime($val['attempt_time'])).'</td></tr>';                    		
                    		$i++;  
                    	}
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
			  </div>
              </div>
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
				<div class="x_title">
                  <h2>Taxi Status</h2>                 
                  <div class="clearfix"></div>
                </div>            
                <div class="x_content">
                  <table id="datatable1" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>No</th>                   		
                    		<th>No Pintu</th>
                    		<th>Driver</th>
                    		<th>Nomor SPJ</th>                    		                    		                    		
                    		<th>Login</th>                    	                     		
                    		<th>Device Status</th>
                    		<th>N/A Status</th>                    		
                    		<th>Problem Since</th>
                    		<th>QA Status</th>                    		                    		 
                    		<th>Last Loc Upd</th>                    		
                    		<th>Hired Status</th>               
                    		<th>Battery Level</th>                    		     		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php				
                    	$i = 1;
                    	foreach ((Array) $data['data'] AS $key => $val) { 
                    		echo '<tr><td>'.$i.'</td>'.                  		
                    		'<td>'.($val['reg_no']).'</td>'.
                    		'<td>'.($val['name']).'</td>'.
                    		'<td>'.($val['assignment_code']).'</td>'.
                    		'<td>'.($val['created']).'</td>'.
                    		'<td class="'.($val['status'] === 'All Connected' ? "green" : "red").'">'.($val['status']).'</td>'.
                    		'<td class="'.($val['na'] === 'Normal' ? "green" : "red").'">'.($val['na']).'</td>'.                    		
                    		'<td class="'.($val['status'] === 'All Connected' ? "green" : "red").'">'.($val['status'] !== 'All Connected' ? ($val['since'] > 0 ? date('Y-m-d H:i:s', strtotime($val['since'])) : "> 1 Days Ago") : "").'</td>'.
                    		'<td class="'.(($val['status'] === 'All Connected' && $val['na'] === 'Normal') ? "green" : 
                    			($val['since'] > 0 ? (strtotime($val['since']) <= strtotime($val['created']) ? "red" : 
                    			($val['na'] !== 'Normal' ? (strtotime($val['last_location_update']) <= strtotime($val['created']) ? "red" : "green") : "green")) : "red")).'">'.
                    			($val['status'] !== 'All Connected' ? ($val['since'] > 0 ? (strtotime($val['since']) <= strtotime($val['created']) ? "Lolos QA" : "Problem Di Jalan") : "Lolos QA") : 
                    			(strtotime($val['last_location_update']) <= strtotime($val['created']) ? "Lolos QA" : "")).'</td>'.                    		                    		
                    		'<td class="'.($val['na'] === 'Normal' ? "green" : "red").'">'.($val['na'] !== 'Normal' ? date('Y-m-d H:i:s', strtotime($val['last_location_update'])) : "").'</td>'.
							'<td class="'.($val['hired_status'] === 'Vacant' ? "blue" : ($val['hired_status'] === 'Hired' ? "green" : "orange")).'">'.($val['hired_status']).'</td>'.
							'<td class="'.($val['battery_level'] > 80 ? "green" : "red").'">'.($val['battery_level']).'</td></tr>';
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
		<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/css/buttons.dataTables.min.css');?>" rel="stylesheet">
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
		<script src="<?php echo base_url('/assets/js/dataTables.buttons.min.js');?>"></script>		
		<script src="<?php echo base_url('/assets/js/buttons.flash.min.js');?>"></script>		
		<script src="<?php echo base_url('/assets/js/buttons.html5.min.js');?>"></script>
		
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>

		<!-- Doughnut Chart -->
		<script>
		  $(document).ready(function(){
			var options = {
			  legend: false,
			  responsive: false
			};
			 $('#datatable1').dataTable({ paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
			$('#datatable2').dataTable({ paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
			var total_na = <?php echo round($data['total_na'] / $data['total_total'] * 100, 2);?>;
			var total_normal = <?php echo round($data['total_normal'] / $data['total_total'] * 100, 2);?>;		
			new Chart(document.getElementById("canvas_na"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Normal",
				  "N/A"
				],
				datasets: [{
				  data: [total_normal, total_na],
				  backgroundColor: [
					"#26B99A",				  
					"#E74C3C",
					"#FFA500",
					"#9CC2CB"
				  ],
				  hoverBackgroundColor: [
					"#36CAAB",				  
					"#E95E4F",
					"#FED500",
					"#8CB2BB"				  
				  ]
				}]
			  },
			  options: options
			});
			var total_connected = <?php echo round($data['total_connected'] / $data['total_total'] * 100, 2);?>;
			var total_error = <?php echo round($data['total_error'] / $data['total_total'] * 100, 2);?>;
			var total_argo = <?php echo round($data['total_argo'] / $data['total_total'] * 100, 2);?>;
			var total_none = <?php echo round($data['total_none'] / $data['total_total'] * 100, 2);?>;
			new Chart(document.getElementById("canvas_status"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Connected",
				  "Error",
				  "Argo",
				  "None"
				],
				datasets: [{
				  data: [total_connected, total_error, total_argo, total_none],
				  backgroundColor: [
					"#26B99A",
					"#E74C3C",
					"#9B59B6",					
					"#FFA500",
					"#FF00FF",
					"#34495E",
					"#9CC2CB"					
				  ],
				  hoverBackgroundColor: [
					"#36CAAB",
					"#E95E4F",
					"#B370CF",					
					"#FED500",
					"#DD00DD",
					"#24394E",
					"#8CB2BB"	
				  ]
				}]
			  },
			  options: options
			});
			});
		</script>
		<!-- /Doughnut Chart -->