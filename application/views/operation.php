		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Operation - <?php $datetime = new DateTime($date); echo $datetime->format('l, j F Y'); ?></h2>
				<h4>Last Update <?php echo $data['last_update'];?>
				</div>
                <div class="input-group date form_date col-md-4" data-date-format="D, dd M yyyy" data-link-field="dtp_input1">
                    <input class="form-control inputdate" size="auto" type="text" value="<?php echo $date;?>" readonly>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
					<span class="input-group-btn"><button type="button" class="btn btn-primary btnSubmit" id="btnSubmit">Submit</button></span>
					<input type="hidden" id="dtp_input1" value="" /><br/>					
                </div>
          	</div>
          </div>
          <div class="row tile_count">
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total SPJ</span>
              <div class="count"><?php echo number_format($data['total_spj']); ?></div>
              <span class="count_bottom"><i class="<?php echo ($data['spj_yest'] > 0 ? 'green' : 'red');?>">
              <?php 
              	if($data['spj_yest'] >= 0) echo '<i class="fa fa-sort-asc"></i>'; 
              	else echo '<i class="fa fa-sort-desc"></i>';
              	echo ($data['spj_yest'] >= 0 ? number_format($data['spj_yest'], 2) : -number_format($data['spj_yest'], 2));?>%</i> from yesterday</span>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-car"></i> Total Fleet</span>
              <div class="count"><?php echo number_format($data['total_fleet']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Utilization Rate</span>
              <?php
				if($data['fleet_utility'] >= 60){
					echo '<div class="count green">';
				} else if($data['fleet_utility'] >= 45){
					echo '<div class="count orange">';
				} else {
					echo '<div class="count red">';
				}
				echo number_format($data['fleet_utility'], 2).'%</div>';
			  ?>
            </div>     
          </div>
		  <div class="row">
		  <!-- graph area -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day SPJ</h2>
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
                    <h2>Last 30 Day Per Fleet</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_area" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
          </div>
          <div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_440 overflow_hidden">
                <div class="x_title">
                  <h2>Reguler</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_reguler" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Reguler</p>
                            </td>
                            <td><?php echo number_format($data['reguler_reg']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Kalong</p>
                            </td>
                            <td><?php echo number_format($data['reguler_kal']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>TP</p>
                            </td>
                            <td><?php echo number_format($data['reguler_tp']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>SOS</p>
                            </td>
                            <td><?php echo number_format($data['reguler_so']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>TL</p>
                            </td>
                            <td><?php echo number_format($data['reguler_brok']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Other</p>
                            </td>
                            <td><?php echo number_format($data['reguler_lain']);?></td>
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
                    <tr>
						<td>
						  <p>Total Operation</p>
						</td>
						<td><?php echo number_format($data['reguler_operation']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Non Operation</p>
						</td>
						<td><?php echo number_format($data['reguler_non_operation']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Fleet</p>
						</td>
						<td><?php echo number_format($data['reguler_total']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Utilization Rate</p>
						</td>
						<?php
						if($data['reguler_rate'] >= 60){
							echo '<td class="green">';
						} else if($data['reguler_rate'] >= 45){
							echo '<td class="orange">';
						} else {
							echo '<td class="red">';
						}
						echo number_format($data['reguler_rate'], 2).'%</td>';
						?>
					  </tr>
                  </table>
                </div>
              </div>
            </div>
			
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_440 overflow_hidden">
                <div class="x_title">
                  <h2>Eagle</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_eagle" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Reguler</p>
                            </td>
                            <td><?php echo number_format($data['eagle_reg']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Kalong</p>
                            </td>
                            <td><?php echo number_format($data['eagle_kal']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>TP</p>
                            </td>
                            <td><?php echo number_format($data['eagle_tp']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Broken</p>
                            </td>
                            <td><?php echo number_format($data['eagle_brok']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>TL</p>
                            </td>
                            <td><?php echo number_format($data['eagle_tl']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square pink"></i>Surat - surat</p>
                            </td>
                            <td><?php echo number_format($data['eagle_surat']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square dark"></i>Argo / RDS</p>
                            </td>
                            <td><?php echo number_format($data['eagle_argo_rds']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Other</p>
                            </td>
                            <td><?php echo number_format($data['eagle_lain']);?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
						<td>
						  <p>Total Operation</p>
						</td>
						<td><?php echo number_format($data['eagle_operation']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Non Operation</p>
						</td>
						<td><?php echo number_format($data['eagle_non_operation']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Fleet</p>
						</td>
						<td><?php echo number_format($data['eagle_total']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Utilization Rate</p>
						</td>
						<?php
						if($data['eagle_rate'] >= 60){
							echo '<td class="green">';
						} else if($data['eagle_rate'] >= 45){
							echo '<td class="orange">';
						} else {
							echo '<td class="red">';
						}
						echo number_format($data['eagle_rate'], 2).'%</td>';
						?>
					  </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_440 overflow_hidden">
                <div class="x_title">
                  <h2>Tiara</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_tiara" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Reguler</p>
                            </td>
                            <td><?php echo number_format($data['tiara_reg']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Kalong</p>
                            </td>
                            <td><?php echo number_format($data['tiara_kal']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>TP</p>
                            </td>
                            <td><?php echo number_format($data['tiara_tp']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Broken</p>
                            </td>
                            <td><?php echo number_format($data['tiara_brok']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>TL</p>
                            </td>
                            <td><?php echo number_format($data['tiara_tl']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Other</p>
                            </td>
                            <td><?php echo number_format($data['tiara_lain']);?></td>
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
					  <tr>
						<td>
						  <p>Total Operation</p>
						</td>
						<td><?php echo number_format($data['tiara_operation']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Non Operation</p>
						</td>
						<td><?php echo number_format($data['tiara_non_operation']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Fleet</p>
						</td>
						<td><?php echo number_format($data['tiara_total']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Utilization Rate</p>
						</td>
						<?php
						if($data['tiara_rate'] >= 60){
							echo '<td class="green">';
						} else if($data['tiara_rate'] >= 45){
							echo '<td class="orange">';
						} else {
							echo '<td class="red">';
						}
						echo number_format($data['tiara_rate'], 2).'%</td>';
						?>
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
                    		<th>Utilization Rate</th>
                    		<th>Total Op</th>
                    		<th>Total Non Op</th>
                    		<th>Total Fleet</th> 
                    		<th>Reguler</th>
                    		<th>Kalong</th>
                    		<th>TP</th>
                    		<th>TL</th>
                    		<th>SOS</th>
                    		<th>Other</th>
                    		<th>Avg Op 30d</th>
                    		<th>Avg TP 30d</th>                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_reguler = 0;
                    	$total_kalong = 0;
                    	$total_tp = 0;
                    	$total_broken = 0;
                    	$total_so = 0;
                    	$total_other = 0;
                    	$total_operasi = 0;
                    	$total_non_operasi = 0;
                    	$total = 0;            
                    	$avg_tp = 0;
                    	$avg_spj = 0;                    	        	
                    	foreach ((Array) $data['pool_reguler'] AS $key => $val) { 
                    		$rate = number_format($val['operasi'] / ($val['non_operasi'] + $val['operasi']) * 100,2);
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</a></td>';
                    		if($rate >= 60){
								echo '<td class="green">';
							} else if($rate >= 45){
								echo '<td class="orange">';
							} else {
								echo '<td class="red">';
							}
							echo number_format($rate, 2).'%</td>'.
                    		'<td class="green">'.number_format($val['operasi']).'</td>'.
                    		'<td class="red">'.number_format($val['non_operasi']).'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.
                    		'<td class="blue">'.number_format($val['reguler']).'</td>'.
                    		'<td class="blue">'.number_format($val['kalong']).'</td>'.
                    		'<td class="orange">'.number_format($val['tp']).'</td>'.
                    		'<td class="orange">'.number_format($val['broken']).'</td>'.
                    		'<td class="orange">'.number_format($val['so']).'</td>'.
                    		'<td class="orange">'.number_format($val['other']).'</td>'.
							'<td class="'.($val['avg_spj'] > $val['operasi'] ? 'red' : 'green').'">'.number_format($val['avg_spj'], 2).'</td>'.
                    		'<td class="'.($val['avg_tp'] < $val['tp'] ? 'red' : 'green').'">'.number_format($val['avg_tp'], 2).'</td></tr>';
                    		$total_reguler += $val['reguler'];
                    		$total_kalong += $val['kalong'];
                    		$total_tp += $val['tp'];
                    		$total_broken += $val['broken'];
                    		$total_so += $val['so'];
                    		$total_other += $val['other'];
                    		$total_operasi += $val['operasi'];
                    		$total_non_operasi += $val['non_operasi'];
                    		$total += $val['total'];
                    		$avg_tp += $val['avg_tp'];
                    		$avg_spj += $val['avg_spj'];
                    	}
                    	$total_rate = $total_operasi / (($total_operasi + $total_non_operasi) > 0 ? ($total_operasi + $total_non_operasi) : 1) * 100;
                    	echo '<tr><td>TOTAL AREA 1</td>';
                    	if($total_rate >= 60){
                    		echo '<td class="green">';
                    	} else if($total_rate >= 45){
	                    	echo '<td class="orange">';
                    	} else {
                    		echo '<td class="red">';
                    	}
                    	echo number_format($total_rate, 2).'%</td>'.
                    	'<td class="green">'.number_format($total_operasi).'</td>'.
                    	'<td class="red">'.number_format($total_non_operasi).'</td>'.
                    	'<td>'.number_format($total).'</td>'.
                    	'<td class="blue">'.number_format($total_reguler).'</td>'.
                    	'<td class="blue">'.number_format($total_kalong).'</td>'.
                    	'<td class="orange">'.number_format($total_tp).'</td>'.
                    	'<td class="orange">'.number_format($total_broken).'</td>'.
                    	'<td class="orange">'.number_format($total_so).'</td>'.
                    	'<td class="orange">'.number_format($total_other).'</td>'.
                    	'<td class="'.($avg_spj > $total_operasi ? 'red' : 'green').'">'.number_format($avg_spj, 2).'</td>'.
                    	'<td class="'.($avg_tp < $total_tp ? 'red' : 'green').'">'.number_format($avg_tp, 2).'</td></tr>';                       	
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
                    		<th>Utilization Rate</th>
                    		<th>Total Op</th>
                    		<th>Total Non Op</th>
                    		<th>Total Fleet</th> 
                    		<th>Reguler</th>
                    		<th>Kalong</th>
                    		<th>TP</th>
                    		<th>TL</th>
                    		<th>SOS</th>
                    		<th>Other</th>
                    		<th>Avg Op 30d</th>
                    		<th>Avg TP 30d</th>                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_reguler = 0;
                    	$total_kalong = 0;
                    	$total_tp = 0;
                    	$total_broken = 0;
                    	$total_so = 0;
                    	$total_other = 0;
                    	$total_operasi = 0;
                    	$total_non_operasi = 0;
                    	$total = 0;            
                    	$avg_tp = 0;
                    	$avg_spj = 0;                    	        	
                    	foreach ((Array) $data['pool_reguler2'] AS $key => $val) { 
                    		$rate = number_format($val['operasi'] / ($val['non_operasi'] + $val['operasi']) * 100,2);
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</a></td>';
                    		if($rate >= 60){
								echo '<td class="green">';
							} else if($rate >= 45){
								echo '<td class="orange">';
							} else {
								echo '<td class="red">';
							}
							echo number_format($rate, 2).'%</td>'.
                    		'<td class="green">'.number_format($val['operasi']).'</td>'.
                    		'<td class="red">'.number_format($val['non_operasi']).'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.
                    		'<td class="blue">'.number_format($val['reguler']).'</td>'.
                    		'<td class="blue">'.number_format($val['kalong']).'</td>'.
                    		'<td class="orange">'.number_format($val['tp']).'</td>'.
                    		'<td class="orange">'.number_format($val['broken']).'</td>'.
                    		'<td class="orange">'.number_format($val['so']).'</td>'.
                    		'<td class="orange">'.number_format($val['other']).'</td>'.
							'<td class="'.($val['avg_spj'] > $val['operasi'] ? 'red' : 'green').'">'.number_format($val['avg_spj'], 2).'</td>'.
                    		'<td class="'.($val['avg_tp'] < $val['tp'] ? 'red' : 'green').'">'.number_format($val['avg_tp'], 2).'</td></tr>';
                    		$total_reguler += $val['reguler'];
                    		$total_kalong += $val['kalong'];
                    		$total_tp += $val['tp'];
                    		$total_broken += $val['broken'];
                    		$total_so += $val['so'];
                    		$total_other += $val['other'];
                    		$total_operasi += $val['operasi'];
                    		$total_non_operasi += $val['non_operasi'];
                    		$total += $val['total'];
                    		$avg_tp += $val['avg_tp'];
                    		$avg_spj += $val['avg_spj'];
                    	}
                    	$total_rate = $total_operasi / (($total_operasi + $total_non_operasi) > 0 ? ($total_operasi + $total_non_operasi) : 1) * 100;
                    	echo '<tr><td>TOTAL AREA 2</td>';
                    	if($total_rate >= 60){
                    		echo '<td class="green">';
                    	} else if($total_rate >= 45){
	                    	echo '<td class="orange">';
                    	} else {
                    		echo '<td class="red">';
                    	}
                    	echo number_format($total_rate, 2).'%</td>'.
                    	'<td class="green">'.number_format($total_operasi).'</td>'.
                    	'<td class="red">'.number_format($total_non_operasi).'</td>'.
                    	'<td>'.number_format($total).'</td>'.
                    	'<td class="blue">'.number_format($total_reguler).'</td>'.
                    	'<td class="blue">'.number_format($total_kalong).'</td>'.
                    	'<td class="orange">'.number_format($total_tp).'</td>'.
                    	'<td class="orange">'.number_format($total_broken).'</td>'.
                    	'<td class="orange">'.number_format($total_so).'</td>'.
                    	'<td class="orange">'.number_format($total_other).'</td>'.
                    	'<td class="'.($avg_spj > $total_operasi ? 'red' : 'green').'">'.number_format($avg_spj, 2).'</td>'.
                    	'<td class="'.($avg_tp < $total_tp ? 'red' : 'green').'">'.number_format($avg_tp, 2).'</td></tr>';                  	
                    ?>
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="x_panel tile">
                <div class="x_title">
                  <h2><?php echo '<a href="'.site_url("/Detail/area?id=6&date=".$date."").'">';?>Pool Reguler Area 3</a></h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>
                    		<th>Utilization Rate</th>
                    		<th>Total Op</th>
                    		<th>Total Non Op</th>
                    		<th>Total Fleet</th> 
                    		<th>Reguler</th>
                    		<th>Kalong</th>
                    		<th>TP</th>
                    		<th>TL</th>
                    		<th>SOS</th>
                    		<th>Other</th>
                    		<th>Avg Op 30d</th>
                    		<th>Avg TP 30d</th>                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_reguler = 0;
                    	$total_kalong = 0;
                    	$total_tp = 0;
                    	$total_broken = 0;
                    	$total_so = 0;
                    	$total_other = 0;
                    	$total_operasi = 0;
                    	$total_non_operasi = 0;
                    	$total = 0;            
                    	$avg_tp = 0;
                    	$avg_spj = 0;                    	        	
                    	foreach ((Array) $data['pool_reguler3'] AS $key => $val) { 
                    		$rate = number_format($val['operasi'] / ($val['non_operasi'] + $val['operasi']) * 100,2);
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</a></td>';
                    		if($rate >= 60){
								echo '<td class="green">';
							} else if($rate >= 45){
								echo '<td class="orange">';
							} else {
								echo '<td class="red">';
							}
							echo number_format($rate, 2).'%</td>'.
                    		'<td class="green">'.number_format($val['operasi']).'</td>'.
                    		'<td class="red">'.number_format($val['non_operasi']).'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.
                    		'<td class="blue">'.number_format($val['reguler']).'</td>'.
                    		'<td class="blue">'.number_format($val['kalong']).'</td>'.
                    		'<td class="orange">'.number_format($val['tp']).'</td>'.
                    		'<td class="orange">'.number_format($val['broken']).'</td>'.
                    		'<td class="orange">'.number_format($val['so']).'</td>'.
                    		'<td class="orange">'.number_format($val['other']).'</td>'.
							'<td class="'.($val['avg_spj'] > $val['operasi'] ? 'red' : 'green').'">'.number_format($val['avg_spj'], 2).'</td>'.
                    		'<td class="'.($val['avg_tp'] < $val['tp'] ? 'red' : 'green').'">'.number_format($val['avg_tp'], 2).'</td></tr>';
                    		$total_reguler += $val['reguler'];
                    		$total_kalong += $val['kalong'];
                    		$total_tp += $val['tp'];
                    		$total_broken += $val['broken'];
                    		$total_so += $val['so'];
                    		$total_other += $val['other'];
                    		$total_operasi += $val['operasi'];
                    		$total_non_operasi += $val['non_operasi'];
                    		$total += $val['total'];
                    		$avg_tp += $val['avg_tp'];
                    		$avg_spj += $val['avg_spj'];
                    	}
                    	$total_rate = $total_operasi / (($total_operasi + $total_non_operasi) > 0 ? ($total_operasi + $total_non_operasi) : 1) * 100;
                    	echo '<tr><td>TOTAL AREA 3</td>';
                    	if($total_rate >= 60){
                    		echo '<td class="green">';
                    	} else if($total_rate >= 45){
	                    	echo '<td class="orange">';
                    	} else {
                    		echo '<td class="red">';
                    	}
                    	echo number_format($total_rate, 2).'%</td>'.
                    	'<td class="green">'.number_format($total_operasi).'</td>'.
                    	'<td class="red">'.number_format($total_non_operasi).'</td>'.
                    	'<td>'.number_format($total).'</td>'.
                    	'<td class="blue">'.number_format($total_reguler).'</td>'.
                    	'<td class="blue">'.number_format($total_kalong).'</td>'.
                    	'<td class="orange">'.number_format($total_tp).'</td>'.
                    	'<td class="orange">'.number_format($total_broken).'</td>'.
                    	'<td class="orange">'.number_format($total_so).'</td>'.
                    	'<td class="orange">'.number_format($total_other).'</td>'.
                    	'<td class="'.($avg_spj > $total_operasi ? 'red' : 'green').'">'.number_format($avg_spj, 2).'</td>'.
                    	'<td class="'.($avg_tp < $total_tp ? 'red' : 'green').'">'.number_format($avg_tp, 2).'</td></tr>';                  	
                    ?>
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="x_panel tile">
                <div class="x_title">
                  <h2><?php echo '<a href="'.site_url("/Detail/area?id=7&date=".$date."").'">';?>Pool Reguler Area 4</a></h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>
                    		<th>Utilization Rate</th>
                    		<th>Total Op</th>
                    		<th>Total Non Op</th>
                    		<th>Total Fleet</th> 
                    		<th>Reguler</th>
                    		<th>Kalong</th>
                    		<th>TP</th>
                    		<th>TL</th>
                    		<th>SOS</th>
                    		<th>Other</th>
                    		<th>Avg Op 30d</th>
                    		<th>Avg TP 30d</th>                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_reguler = 0;
                    	$total_kalong = 0;
                    	$total_tp = 0;
                    	$total_broken = 0;
                    	$total_so = 0;
                    	$total_other = 0;
                    	$total_operasi = 0;
                    	$total_non_operasi = 0;
                    	$total = 0;            
                    	$avg_tp = 0;
                    	$avg_spj = 0;                    	        	
                    	foreach ((Array) $data['pool_reguler4'] AS $key => $val) { 
                    		$rate = number_format($val['operasi'] / ($val['non_operasi'] + $val['operasi']) * 100,2);
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</a></td>';
                    		if($rate >= 60){
								echo '<td class="green">';
							} else if($rate >= 45){
								echo '<td class="orange">';
							} else {
								echo '<td class="red">';
							}
							echo number_format($rate, 2).'%</td>'.
                    		'<td class="green">'.number_format($val['operasi']).'</td>'.
                    		'<td class="red">'.number_format($val['non_operasi']).'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.
                    		'<td class="blue">'.number_format($val['reguler']).'</td>'.
                    		'<td class="blue">'.number_format($val['kalong']).'</td>'.
                    		'<td class="orange">'.number_format($val['tp']).'</td>'.
                    		'<td class="orange">'.number_format($val['broken']).'</td>'.
                    		'<td class="orange">'.number_format($val['so']).'</td>'.
                    		'<td class="orange">'.number_format($val['other']).'</td>'.
							'<td class="'.($val['avg_spj'] > $val['operasi'] ? 'red' : 'green').'">'.number_format($val['avg_spj'], 2).'</td>'.
                    		'<td class="'.($val['avg_tp'] < $val['tp'] ? 'red' : 'green').'">'.number_format($val['avg_tp'], 2).'</td></tr>';
                    		$total_reguler += $val['reguler'];
                    		$total_kalong += $val['kalong'];
                    		$total_tp += $val['tp'];
                    		$total_broken += $val['broken'];
                    		$total_so += $val['so'];
                    		$total_other += $val['other'];
                    		$total_operasi += $val['operasi'];
                    		$total_non_operasi += $val['non_operasi'];
                    		$total += $val['total'];
                    		$avg_tp += $val['avg_tp'];
                    		$avg_spj += $val['avg_spj'];
                    	}
                    	$total_rate = $total_operasi / (($total_operasi + $total_non_operasi) > 0 ? ($total_operasi + $total_non_operasi) : 1) * 100;
                    	echo '<tr><td>TOTAL AREA 4</td>';
                    	if($total_rate >= 60){
                    		echo '<td class="green">';
                    	} else if($total_rate >= 45){
	                    	echo '<td class="orange">';
                    	} else {
                    		echo '<td class="red">';
                    	}
                    	echo number_format($total_rate, 2).'%</td>'.
                    	'<td class="green">'.number_format($total_operasi).'</td>'.
                    	'<td class="red">'.number_format($total_non_operasi).'</td>'.
                    	'<td>'.number_format($total).'</td>'.
                    	'<td class="blue">'.number_format($total_reguler).'</td>'.
                    	'<td class="blue">'.number_format($total_kalong).'</td>'.
                    	'<td class="orange">'.number_format($total_tp).'</td>'.
                    	'<td class="orange">'.number_format($total_broken).'</td>'.
                    	'<td class="orange">'.number_format($total_so).'</td>'.
                    	'<td class="orange">'.number_format($total_other).'</td>'.
                    	'<td class="'.($avg_spj > $total_operasi ? 'red' : 'green').'">'.number_format($avg_spj, 2).'</td>'.
                    	'<td class="'.($avg_tp < $total_tp ? 'red' : 'green').'">'.number_format($avg_tp, 2).'</td></tr>';                  	
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
                    		<th>Utilization Rate</th>
                    		<th>Total Op</th>
                    		<th>Total Non Op</th>
                    		<th>Total Fleet</th>
                    		<th>Reguler</th>
                    		<th>Kalong</th>
                    		<th>TP</th>
                    		<th>Broken</th>
                    		<th>TL</th>
                    		<th>Surat</th>
                    		<th>Argo/RDS</th>
                    		<th>Other</th>
                    		<th>Avg Op 30d</th>
                    		<th>Avg TP 30d</th>                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_reguler = 0;
                    	$total_kalong = 0;
                    	$total_tp = 0;
                    	$total_broken = 0;
                    	$total_tl = 0;
                    	$total_argo_rds = 0;
                    	$total_surat = 0;
                    	$total_other = 0;
                    	$total_operasi = 0;
                    	$total_non_operasi = 0;
                    	$total = 0;
                    	$avg_tp = 0;
                    	$avg_spj = 0;                    	
                    	foreach ((Array) $data['eagle'] AS $key => $val) { 
                    		$tt = $val['non_operasi'] + $val['operasi'];
                    		$rate = number_format($val['operasi'] / ($tt > 0 ? $tt : 1) * 100,2);
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>';
                    		if($rate >= 60){
								echo '<td class="green">';
							} else if($rate >= 45){
								echo '<td class="orange">';
							} else {
								echo '<td class="red">';
							}
							echo number_format($rate, 2).'%</td>'.
                    		'<td class="green">'.number_format($val['operasi']).'</td>'.
                    		'<td class="red">'.number_format($val['non_operasi']).'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		
                    		'<td class="blue">'.number_format($val['reguler']).'</td>'.
                    		'<td class="blue">'.number_format($val['kalong']).'</td>'.
                    		'<td class="orange">'.number_format($val['tp']).'</td>'.
                    		'<td class="orange">'.number_format($val['body_repair']).'</td>'.
                    		'<td class="orange">'.number_format($val['tl']).'</td>'.
                    		'<td class="orange">'.number_format($val['surat']).'</td>'.                    		
                    		'<td class="orange">'.number_format($val['argo_rds']).'</td>'.
                    		'<td class="orange">'.number_format($val['lain']).'</td>'.
                    		'<td class="'.($val['avg_spj'] > $val['operasi'] ? 'red' : 'green').'">'.number_format($val['avg_spj'], 2).'</td>'.
                    		'<td class="'.($val['avg_tp'] < $val['tp'] ? 'red' : 'green').'">'.number_format($val['avg_tp'], 2).'</td></tr>';
                    		;
                    		$total_reguler += $val['reguler'];
                    		$total_kalong += $val['kalong'];
                    		$total_tp += $val['tp'];
                    		$total_broken += $val['body_repair'];
                    		$total_tl += $val['tl'];
                    		$total_argo_rds += $val['argo_rds'];
                    		$total_surat += $val['surat'];
                    		$total_other += $val['lain'];
                    		$total_operasi += $val['operasi'];
                    		$total_non_operasi += $val['non_operasi'];
                    		$total += $val['total'];
                    		$avg_tp += $val['avg_tp'];
                    		$avg_spj += $val['avg_spj'];                    		
                    	}
                    	$total_rate = $total_operasi / (($total_operasi + $total_non_operasi) > 0 ? ($total_operasi + $total_non_operasi) : 1) * 100;
                    	echo '<tr><td>TOTAL</td>';
                    	if($total_rate >= 60){
                    		echo '<td class="green">';
                    	} else if($total_rate >= 45){
	                    	echo '<td class="orange">';
                    	} else {
                    		echo '<td class="red">';
                    	}
                    	echo number_format($total_rate, 2).'%</td>'.
                    	'<td class="green">'.number_format($total_operasi).'</td>'.
                    	'<td class="red">'.number_format($total_non_operasi).'</td>'.
                    	'<td>'.number_format($total).'</td>'.
                    	'<td class="blue">'.number_format($total_reguler).'</td>'.
                    	'<td class="blue">'.number_format($total_kalong).'</td>'.
                    	'<td class="orange">'.number_format($total_tp).'</td>'.
                    	'<td class="orange">'.number_format($total_broken).'</td>'.
                    	'<td class="orange">'.number_format($total_tl).'</td>'.
                    	'<td class="orange">'.number_format($total_surat).'</td>'.
                    	'<td class="orange">'.number_format($total_argo_rds).'</td>'.
                    	'<td class="orange">'.number_format($total_other).'</td>'.
                    	'<td class="'.($avg_spj > $total_operasi ? 'red' : 'green').'">'.number_format($avg_spj, 2).'</td>'.
                    	'<td class="'.($avg_tp < $total_tp ? 'red' : 'green').'">'.number_format($avg_tp, 2).'</td></tr>';
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            
            <div class="x_panel tile">
                <div class="x_title">
                  <h2><?php echo '<a href="'.site_url("/Detail/area?id=5&date=".$date."").'">';?>Pool Tiara</a></h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>
                    		<th>Utilization Rate</th>                    		
                    		<th>Total Op</th>
                    		<th>Total Non Op</th>
                    		<th>Total Fleet</th>                    		
                    		<th>Reguler</th>
                    		<th>Kalong</th>
                    		<th>TP</th>
                    		<th>Broken</th>
                    		<th>TL</th>
                    		<th>Other</th>
                    		<th>Avg Op 30d</th>                    		
                    		<th>Avg TP 30d</th>
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_reguler = 0;
                    	$total_kalong = 0;
                    	$total_tp = 0;
                    	$total_broken = 0;
                    	$total_tl = 0;
                    	$total_other = 0;
                    	$total_operasi = 0;
                    	$total_non_operasi = 0;
                    	$total = 0;
                    	$avg_tp = 0;                    	
                    	$avg_spj = 0;
                    	foreach ((Array) $data['tiara'] AS $key => $val) { 
                    		$rate = number_format($val['operasi'] / ($val['non_operasi'] + $val['operasi']) * 100,2);
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>';
                    		if($rate >= 60){
								echo '<td class="green">';
							} else if($rate >= 45){
								echo '<td class="orange">';
							} else {
								echo '<td class="red">';
							}
							echo number_format($rate, 2).'%</td>'.
                    		'<td class="green">'.number_format($val['operasi']).'</td>'.
                    		'<td class="red">'.number_format($val['non_operasi']).'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		
                    		'<td class="blue">'.number_format($val['reguler']).'</td>'.
                    		'<td class="blue">'.number_format($val['kalong']).'</td>'.
                    		'<td class="orange">'.number_format($val['tp']).'</td>'.
                    		'<td class="orange">'.number_format($val['body_repair']).'</td>'.
                    		'<td class="orange">'.number_format($val['tl']).'</td>'.
                    		'<td class="orange">'.number_format($val['lain']).'</td>'.
                    		'<td class="'.($val['avg_spj'] > $val['operasi'] ? 'red' : 'green').'">'.number_format($val['avg_spj'], 2).'</td>'.
                    		'<td class="'.($val['avg_tp'] < $val['tp'] ? 'red' : 'green').'">'.number_format($val['avg_tp'], 2).'</td></tr>';
                    		$total_reguler += $val['reguler'];
                    		$total_kalong += $val['kalong'];
                    		$total_tp += $val['tp'];
                    		$total_broken += $val['body_repair'];
                    		$total_tl += $val['tl'];
                    		$total_other += $val['lain'];
                    		$total_operasi += $val['operasi'];
                    		$total_non_operasi += $val['non_operasi'];
                    		$total += $val['total'];
                    		$avg_tp += $val['avg_tp'];
                    		$avg_spj += $val['avg_spj'];
                    	}
                    	$total_rate = $total_operasi / (($total_operasi + $total_non_operasi) > 0 ? ($total_operasi + $total_non_operasi) : 1) * 100;
                    	echo '<tr><td>TOTAL</td>';
                    	if($total_rate >= 60){
                    		echo '<td class="green">';
                    	} else if($total_rate >= 45){
	                    	echo '<td class="orange">';
                    	} else {
                    		echo '<td class="red">';
                    	}
                    	echo number_format($total_rate, 2).'%</td>'.
                    	'<td class="green">'.number_format($total_operasi).'</td>'.
                    	'<td class="red">'.number_format($total_non_operasi).'</td>'.
                    	'<td>'.number_format($total).'</td>'.
                    	'<td class="blue">'.number_format($total_reguler).'</td>'.
                    	'<td class="blue">'.number_format($total_kalong).'</td>'.
                    	'<td class="orange">'.number_format($total_tp).'</td>'.
                    	'<td class="orange">'.number_format($total_broken).'</td>'.
                    	'<td class="orange">'.number_format($total_tl).'</td>'.
                    	'<td class="orange">'.number_format($total_other).'</td>'.
                    	'<td class="'.($avg_spj > $total_operasi ? 'red' : 'green').'">'.number_format($avg_spj, 2).'</td>'.
                    	'<td class="'.($avg_tp < $total_tp ? 'red' : 'green').'">'.number_format($avg_tp, 2).'</td></tr>';
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