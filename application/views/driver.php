		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Driver - <?php $datetime = new DateTime($date); echo $datetime->format('l, j F Y'); ?></h2>
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
            <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> MTD Active Driver</span>
              <div class="count"><?php echo number_format($data['mtd_driver_active']); ?></div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-briefcase"></i> Average HK per MTD Active Driver</span>
              <div class="count"><?php echo number_format($data['avg_hk_total'], 2); ?></div>
            </div> 
            <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> MTD Active VS Registered Active Driver Rate</span>
              <?php
				if($data['mtd_driver_rate'] >= 60){
					echo '<div class="count green">';
				} else if($data['mtd_driver_rate'] >= 45){
					echo '<div class="count orange">';
				} else {
					echo '<div class="count red">';
				}
				echo number_format($data['mtd_driver_rate'], 2).'%</div>';
			  ?>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Registered Active Driver</span>
              <div class="count"><?php echo number_format($data['driver_aktif']); ?></div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> Total Registered Driver</span>
              <div class="count"><?php echo number_format($data['total_driver']); ?></div>
            </div>    
            <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Registered Active VS Total Registered Driver Rate</span>
              <?php
				if($data['driver_rate'] >= 60){
					echo '<div class="count green">';
				} else if($data['driver_rate'] >= 45){
					echo '<div class="count orange">';
				} else {
					echo '<div class="count red">';
				}
				echo number_format($data['driver_rate'], 2).'%</div>';
			  ?>
            </div>
          </div>
          <div class="row">
		  <!-- graph area -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hari Kerja By Driver</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_line" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hari Kerja By Unit</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_line2" style="width:100%; height:300px;"></div>
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
                              <p><i class="fa fa-square green"></i>Bravo Active</p>
                            </td>
                            <td><?php echo number_format($data['reg_bravo_aktif']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Charlie Active</p>
                            </td>
                            <td><?php echo number_format($data['reg_charli_aktif']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Bravo Inactive</p>
                            </td>
                            <td><?php echo number_format($data['reg_bravo_inaktif']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>Charlie Inactive</p>
                            </td>
                            <td><?php echo number_format($data['reg_charli_inaktif']);?></td>
                          </tr>
                          </table>
                      </td>
                    </tr>
                    <tr>
						<td>
						  <p>Total Registered Driver</p>
						</td>
						<td><?php echo number_format($data['reg_total_driver']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Inactive</p>
						</td>
						<td><?php echo number_format($data['reg_total_inaktif']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Registered Active</p>
						</td>
						<td><?php echo number_format($data['reg_total_aktif']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>MTD Active Driver</p>
						</td>
						<td><?php echo number_format($data['reg_mtd_aktif']);?></td>
					  </tr>					  
					  <tr>
						<td>
						  <p>MTD Active Driver Rate</p>
						</td>
						<?php
						if($data['reg_driver_rate'] >= 60){
							echo '<td class="green">';
						} else if($data['reg_driver_rate'] >= 45){
							echo '<td class="orange">';
						} else {
							echo '<td class="red">';
						}
						echo number_format($data['reg_driver_rate'], 2).'%</td>';
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
                              <p><i class="fa fa-square green"></i>Driver Active</p>
                            </td>
                            <td><?php echo number_format($data['eagle_driver_aktif']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Driver Inactive</p>
                            </td>
                            <td><?php echo number_format($data['eagle_driver_inaktif']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Driver Retire</p>
                            </td>
                            <td><?php echo number_format($data['eagle_driver_retire']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>Driver Blacklist</p>
                            </td>
                            <td><?php echo number_format($data['eagle_driver_blacklist']);?></td>
                          </tr>
                          </table>
                      </td>
                    </tr>
                    <tr>
						<td>
						  <p>Total Registered Driver</p>
						</td>
						<td><?php echo number_format($data['eagle_total_driver']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Inactive</p>
						</td>
						<td><?php echo number_format($data['eagle_total_inaktif']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Registered Active</p>
						</td>
						<td><?php echo number_format($data['eagle_total_aktif']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>MTD Active Driver</p>
						</td>
						<td><?php echo number_format($data['eagle_mtd_aktif']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>MTD Active Driver Rate</p>
						</td>
						<?php
						if($data['eagle_driver_rate'] >= 60){
							echo '<td class="green">';
						} else if($data['eagle_driver_rate'] >= 45){
							echo '<td class="orange">';
						} else {
							echo '<td class="red">';
						}
						echo number_format($data['eagle_driver_rate'], 2).'%</td>';
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
                              <p><i class="fa fa-square green"></i>Driver Active</p>
                            </td>
                            <td><?php echo number_format($data['tiara_driver_aktif']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Driver Inactive</p>
                            </td>
                            <td><?php echo number_format($data['tiara_driver_inaktif']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Driver Retire</p>
                            </td>
                            <td><?php echo number_format($data['tiara_driver_retire']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>Driver Blacklist</p>
                            </td>
                            <td><?php echo number_format($data['tiara_driver_blacklist']);?></td>
                          </tr>
                          </table>
                      </td>
                    </tr>
                    <tr>
						<td>
						  <p>Total Registered Driver</p>
						</td>
						<td><?php echo number_format($data['tiara_total_driver']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Inactive</p>
						</td>
						<td><?php echo number_format($data['tiara_total_inaktif']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Registered Active</p>
						</td>
						<td><?php echo number_format($data['tiara_total_aktif']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>MTD Active Driver</p>
						</td>
						<td><?php echo number_format($data['tiara_mtd_aktif']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>MTD Active Driver Rate</p>
						</td>
						<?php
						if($data['tiara_driver_rate'] >= 60){
							echo '<td class="green">';
						} else if($data['tiara_driver_rate'] >= 45){
							echo '<td class="orange">';
						} else {
							echo '<td class="red">';
						}
						echo number_format($data['tiara_driver_rate'], 2).'%</td>';
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
                    		<th>Total Regis Driver</th>                    		
                    		<th>Bravo Act</th>
                    		<th>Bravo Inactive</th>
                    		<th>Charlie Active</th>
                    		<th>Charlie Inactive</th>
                    		<th>Total Regis Act Driver</th> 
                    		<th>Total Inactive Driver</th> 
                    		<th>MTD Act Driver</th>
                    		<th>Pct Act Driver</th>                    		   
                    		<th>Avg HK Driver</th>
                    		<th>Avg HK Unit</th>
                    		<th>Median HK Unit</th>                    		                    		                    		                 		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_bravo_aktif = 0;
                    	$total_bravo_inaktif = 0;
                    	$total_charlie_aktif = 0; 
                    	$total_charlie_inaktif = 0;            	
                    	$total_aktif = 0;
						$total_inaktif = 0;
						$total_driver = 0;
						$avg_driver = 0;
						$avg_car = 0;
						$median_car = 0;												
						$mtd_aktif_driver = 0;						
                    	foreach ((Array) $data['pool_reguler'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		
                    		'<td class="green">'.number_format($val['bravo_aktif']).'</td>'.
                    		'<td class="red">'.number_format($val['bravo_inaktif']).'</td>'.
                    		'<td class="blue">'.number_format($val['charli_aktif']).'</td>'.
                    		'<td class="orange">'.number_format($val['charli_inaktif']).'</td>'.
                    		'<td class="green">'.number_format($val['total_aktif']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['total_inaktif']).'</td>'.
                    		'<td class="green">'.number_format($val['mtd_aktif_driver']).'</td>';
                    		if($val['aktif_rate'] >= 60){
								echo '<td class="count green">';
							} else if($val['aktif_rate'] >= 45){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo number_format($val['aktif_rate'], 2).'%</td>'.
							'<td>'.number_format($val['avg_driver'], 2).'</td>'.
							'<td>'.number_format($val['avg_car'], 2).'</td>'.
							'<td>'.number_format($val['median_car']).'</td></tr>';							
                    		$total_bravo_aktif += $val['bravo_aktif'];
                    		$total_bravo_inaktif += $val['bravo_inaktif'];
                    		$total_charlie_aktif += $val['charli_aktif'];
                    		$total_charlie_inaktif += $val['charli_inaktif'];
                    		$total_aktif += $val['total_aktif'];
                    		$total_inaktif += $val['total_inaktif'];
                    		$total_driver += $val['total'];
                    		$avg_driver += $val['avg_driver'];    
                    		$avg_car += $val['avg_car']; 
                    		$median_car += $val['median_car'];               		
							$mtd_aktif_driver += $val['mtd_aktif_driver'];                    		
                    	}
                    	$total_pct_driver = $mtd_aktif_driver / ($total_aktif > 0 ? $total_aktif : 1) * 100;
                    	echo '<tr><td>TOTAL AREA 1</td>'.
						'<td>'.number_format($total_driver).'</td>'.                    	
                    	'<td class="green">'.number_format($total_bravo_aktif).'</td>'.
						'<td class="red">'.number_format($total_bravo_inaktif).'</td>'.
						'<td class="blue">'.number_format($total_charlie_aktif).'</td>'.
						'<td class="orange">'.number_format($total_charlie_inaktif).'</td>'.
						'<td class="green">'.number_format($total_aktif).'</td>'.                    		
						'<td class="red">'.number_format($total_inaktif).'</td>'.
						'<td class="green">'.number_format($mtd_aktif_driver).'</td>';
						if($total_pct_driver >= 60){
							echo '<td class="count green">';
						} else if($total_pct_driver >= 45){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count red">';
						}
						echo number_format($total_pct_driver, 2).'%</td>'.
						'<td>'.number_format($avg_driver / Count($data['pool_reguler']), 2).'</td>'.
						'<td>'.number_format($avg_car / Count($data['pool_reguler']), 2).'</td>'.
						'<td>'.number_format($median_car / Count($data['pool_reguler'])).'</td></tr>';						
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
                    		<th>Total Regis Driver</th>                    		
                    		<th>Bravo Act</th>
                    		<th>Bravo Inactive</th>
                    		<th>Charlie Active</th>
                    		<th>Charlie Inactive</th>
                    		<th>Total Regis Act Driver</th> 
                    		<th>Total Inactive Driver</th> 
                    		<th>MTD Act Driver</th>
                    		<th>Pct Act Driver</th>                    		   
                    		<th>Avg HK Driver</th>
                    		<th>Avg HK Unit</th>  
                    		<th>Median HK Unit</th>                    		                  		                    		                 		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_bravo_aktif = 0;
                    	$total_bravo_inaktif = 0;
                    	$total_charlie_aktif = 0; 
                    	$total_charlie_inaktif = 0;            	
                    	$total_aktif = 0;
						$total_inaktif = 0;
						$total_driver = 0;
						$avg_driver = 0;
						$avg_car = 0;	
						$median_car = 0;																							
						$mtd_aktif_driver = 0;						
                    	foreach ((Array) $data['pool_reguler2'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		
                    		'<td class="green">'.number_format($val['bravo_aktif']).'</td>'.
                    		'<td class="red">'.number_format($val['bravo_inaktif']).'</td>'.
                    		'<td class="blue">'.number_format($val['charli_aktif']).'</td>'.
                    		'<td class="orange">'.number_format($val['charli_inaktif']).'</td>'.
                    		'<td class="green">'.number_format($val['total_aktif']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['total_inaktif']).'</td>'.
                    		'<td class="green">'.number_format($val['mtd_aktif_driver']).'</td>';
                    		if($val['aktif_rate'] >= 60){
								echo '<td class="count green">';
							} else if($val['aktif_rate'] >= 45){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo number_format($val['aktif_rate'], 2).'%</td>'.
							'<td>'.number_format($val['avg_driver'], 2).'</td>'.
							'<td>'.number_format($val['avg_car'], 2).'</td>'.
							'<td>'.number_format($val['median_car']).'</td></tr>';							
                    		$total_bravo_aktif += $val['bravo_aktif'];
                    		$total_bravo_inaktif += $val['bravo_inaktif'];
                    		$total_charlie_aktif += $val['charli_aktif'];
                    		$total_charlie_inaktif += $val['charli_inaktif'];
                    		$total_aktif += $val['total_aktif'];
                    		$total_inaktif += $val['total_inaktif'];
                    		$total_driver += $val['total'];
                    		$avg_driver += $val['avg_driver'];   
                    		$avg_car += $val['avg_car'];   
                    		$median_car += $val['median_car'];               		              		
							$mtd_aktif_driver += $val['mtd_aktif_driver'];                    		
                    	}
                    	$total_pct_driver = $mtd_aktif_driver / ($total_aktif > 0 ? $total_aktif : 1) * 100;
                    	echo '<tr><td>TOTAL AREA 2</td>'.
						'<td>'.number_format($total_driver).'</td>'.                    	
                    	'<td class="green">'.number_format($total_bravo_aktif).'</td>'.
						'<td class="red">'.number_format($total_bravo_inaktif).'</td>'.
						'<td class="blue">'.number_format($total_charlie_aktif).'</td>'.
						'<td class="orange">'.number_format($total_charlie_inaktif).'</td>'.
						'<td class="green">'.number_format($total_aktif).'</td>'.                    		
						'<td class="red">'.number_format($total_inaktif).'</td>'.
						'<td class="green">'.number_format($mtd_aktif_driver).'</td>';
						if($total_pct_driver >= 60){
							echo '<td class="count green">';
						} else if($total_pct_driver >= 45){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count red">';
						}
						echo number_format($total_pct_driver, 2).'%</td>'.
						'<td>'.number_format($avg_driver / Count($data['pool_reguler2']), 2).'</td>'.
						'<td>'.number_format($avg_car / Count($data['pool_reguler2']), 2).'</td>'.
						'<td>'.number_format($median_car / Count($data['pool_reguler2'])).'</td></tr>';						
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
                    		<th>Total Regis Driver</th>                    		
                    		<th>Bravo Act</th>
                    		<th>Bravo Inactive</th>
                    		<th>Charlie Active</th>
                    		<th>Charlie Inactive</th>
                    		<th>Total Regis Act Driver</th> 
                    		<th>Total Inactive Driver</th> 
                    		<th>MTD Act Driver</th>
                    		<th>Pct Act Driver</th>                    		   
                    		<th>Avg HK Driver</th>
                    		<th>Avg HK Unit</th>  
                    		<th>Median HK Unit</th>                    		                  		                    		                 		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_bravo_aktif = 0;
                    	$total_bravo_inaktif = 0;
                    	$total_charlie_aktif = 0; 
                    	$total_charlie_inaktif = 0;            	
                    	$total_aktif = 0;
						$total_inaktif = 0;
						$total_driver = 0;
						$avg_driver = 0;
						$avg_car = 0;	
						$median_car = 0;																							
						$mtd_aktif_driver = 0;						
                    	foreach ((Array) $data['pool_reguler3'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		
                    		'<td class="green">'.number_format($val['bravo_aktif']).'</td>'.
                    		'<td class="red">'.number_format($val['bravo_inaktif']).'</td>'.
                    		'<td class="blue">'.number_format($val['charli_aktif']).'</td>'.
                    		'<td class="orange">'.number_format($val['charli_inaktif']).'</td>'.
                    		'<td class="green">'.number_format($val['total_aktif']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['total_inaktif']).'</td>'.
                    		'<td class="green">'.number_format($val['mtd_aktif_driver']).'</td>';
                    		if($val['aktif_rate'] >= 60){
								echo '<td class="count green">';
							} else if($val['aktif_rate'] >= 45){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo number_format($val['aktif_rate'], 2).'%</td>'.
							'<td>'.number_format($val['avg_driver'], 2).'</td>'.
							'<td>'.number_format($val['avg_car'], 2).'</td>'.
							'<td>'.number_format($val['median_car']).'</td></tr>';							
                    		$total_bravo_aktif += $val['bravo_aktif'];
                    		$total_bravo_inaktif += $val['bravo_inaktif'];
                    		$total_charlie_aktif += $val['charli_aktif'];
                    		$total_charlie_inaktif += $val['charli_inaktif'];
                    		$total_aktif += $val['total_aktif'];
                    		$total_inaktif += $val['total_inaktif'];
                    		$total_driver += $val['total'];
                    		$avg_driver += $val['avg_driver'];   
                    		$avg_car += $val['avg_car'];   
                    		$median_car += $val['median_car'];               		              		
							$mtd_aktif_driver += $val['mtd_aktif_driver'];                    		
                    	}
                    	$total_pct_driver = $mtd_aktif_driver / ($total_aktif > 0 ? $total_aktif : 1) * 100;
                    	echo '<tr><td>TOTAL AREA 3</td>'.
						'<td>'.number_format($total_driver).'</td>'.                    	
                    	'<td class="green">'.number_format($total_bravo_aktif).'</td>'.
						'<td class="red">'.number_format($total_bravo_inaktif).'</td>'.
						'<td class="blue">'.number_format($total_charlie_aktif).'</td>'.
						'<td class="orange">'.number_format($total_charlie_inaktif).'</td>'.
						'<td class="green">'.number_format($total_aktif).'</td>'.                    		
						'<td class="red">'.number_format($total_inaktif).'</td>'.
						'<td class="green">'.number_format($mtd_aktif_driver).'</td>';
						if($total_pct_driver >= 60){
							echo '<td class="count green">';
						} else if($total_pct_driver >= 45){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count red">';
						}
						echo number_format($total_pct_driver, 2).'%</td>'.
						'<td>'.number_format($avg_driver / Count($data['pool_reguler3']), 2).'</td>'.
						'<td>'.number_format($avg_car / Count($data['pool_reguler3']), 2).'</td>'.
						'<td>'.number_format($median_car / Count($data['pool_reguler3'])).'</td></tr>';						
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
                    		<th>Total Regis Driver</th>                    		
                    		<th>Bravo Act</th>
                    		<th>Bravo Inactive</th>
                    		<th>Charlie Active</th>
                    		<th>Charlie Inactive</th>
                    		<th>Total Regis Act Driver</th> 
                    		<th>Total Inactive Driver</th> 
                    		<th>MTD Act Driver</th>
                    		<th>Pct Act Driver</th>                    		   
                    		<th>Avg HK Driver</th>
                    		<th>Avg HK Unit</th>  
                    		<th>Median HK Unit</th>                    		                  		                    		                 		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_bravo_aktif = 0;
                    	$total_bravo_inaktif = 0;
                    	$total_charlie_aktif = 0; 
                    	$total_charlie_inaktif = 0;            	
                    	$total_aktif = 0;
						$total_inaktif = 0;
						$total_driver = 0;
						$avg_driver = 0;
						$avg_car = 0;	
						$median_car = 0;																							
						$mtd_aktif_driver = 0;						
                    	foreach ((Array) $data['pool_reguler4'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		
                    		'<td class="green">'.number_format($val['bravo_aktif']).'</td>'.
                    		'<td class="red">'.number_format($val['bravo_inaktif']).'</td>'.
                    		'<td class="blue">'.number_format($val['charli_aktif']).'</td>'.
                    		'<td class="orange">'.number_format($val['charli_inaktif']).'</td>'.
                    		'<td class="green">'.number_format($val['total_aktif']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['total_inaktif']).'</td>'.
                    		'<td class="green">'.number_format($val['mtd_aktif_driver']).'</td>';
                    		if($val['aktif_rate'] >= 60){
								echo '<td class="count green">';
							} else if($val['aktif_rate'] >= 45){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo number_format($val['aktif_rate'], 2).'%</td>'.
							'<td>'.number_format($val['avg_driver'], 2).'</td>'.
							'<td>'.number_format($val['avg_car'], 2).'</td>'.
							'<td>'.number_format($val['median_car']).'</td></tr>';							
                    		$total_bravo_aktif += $val['bravo_aktif'];
                    		$total_bravo_inaktif += $val['bravo_inaktif'];
                    		$total_charlie_aktif += $val['charli_aktif'];
                    		$total_charlie_inaktif += $val['charli_inaktif'];
                    		$total_aktif += $val['total_aktif'];
                    		$total_inaktif += $val['total_inaktif'];
                    		$total_driver += $val['total'];
                    		$avg_driver += $val['avg_driver'];   
                    		$avg_car += $val['avg_car'];   
                    		$median_car += $val['median_car'];               		              		
							$mtd_aktif_driver += $val['mtd_aktif_driver'];                    		
                    	}
                    	$total_pct_driver = $mtd_aktif_driver / ($total_aktif > 0 ? $total_aktif : 1) * 100;
                    	echo '<tr><td>TOTAL AREA 4</td>'.
						'<td>'.number_format($total_driver).'</td>'.                    	
                    	'<td class="green">'.number_format($total_bravo_aktif).'</td>'.
						'<td class="red">'.number_format($total_bravo_inaktif).'</td>'.
						'<td class="blue">'.number_format($total_charlie_aktif).'</td>'.
						'<td class="orange">'.number_format($total_charlie_inaktif).'</td>'.
						'<td class="green">'.number_format($total_aktif).'</td>'.                    		
						'<td class="red">'.number_format($total_inaktif).'</td>'.
						'<td class="green">'.number_format($mtd_aktif_driver).'</td>';
						if($total_pct_driver >= 60){
							echo '<td class="count green">';
						} else if($total_pct_driver >= 45){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count red">';
						}
						echo number_format($total_pct_driver, 2).'%</td>'.
						'<td>'.number_format($avg_driver / Count($data['pool_reguler4']), 2).'</td>'.
						'<td>'.number_format($avg_car / Count($data['pool_reguler4']), 2).'</td>'.
						'<td>'.number_format($median_car / Count($data['pool_reguler4'])).'</td></tr>';						
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
                    		<th>Total Regis Driver</th>                    		
                    		<th>Driver Act</th>
                    		<th>Driver Inactive</th>
                    		<th>Driver Retire</th>
                    		<th>Driver Blacklist</th>
                    		<th>Total Regis Act Driver</th> 
                    		<th>Total Inactive Driver</th> 
                    		<th>MTD Act Driver</th>
                    		<th>Pct Act Driver</th>                    		   
                    		<th>Avg HK Driver</th>
                    		<th>Avg HK Unit</th> 
                    		<th>Median HK Unit</th>                    		                   		                   		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_driver_aktif = 0;
                    	$total_driver_inaktif = 0;
                    	$total_driver_retire = 0; 
                    	$total_driver_blacklist = 0;            	
                    	$total_aktif = 0;
						$total_inaktif = 0;
						$total_driver = 0;
						$avg_driver = 0;
						$avg_car = 0;
						$median_car = 0;																		
						$mtd_aktif_driver = 0;						
                    	foreach ((Array) $data['eagle'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		
                    		'<td class="green">'.number_format($val['driver_aktif']).'</td>'.
                    		'<td class="red">'.number_format($val['driver_inaktif']).'</td>'.
                    		'<td class="blue">'.number_format($val['driver_retire']).'</td>'.
                    		'<td class="orange">'.number_format($val['driver_blacklist']).'</td>'.
                    		'<td class="green">'.number_format($val['total_aktif']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['total_inaktif']).'</td>'.
                    		'<td class="green">'.number_format($val['mtd_aktif_driver']).'</td>';
                    		if($val['aktif_rate'] >= 60){
								echo '<td class="count green">';
							} else if($val['aktif_rate'] >= 45){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo number_format($val['aktif_rate'], 2).'%</td>'.
							'<td>'.number_format($val['avg_driver'], 2).'</td>'.
							'<td>'.number_format($val['avg_car'], 2).'</td>'.
							'<td>'.number_format($val['median_car']).'</td></tr>';							
                    		$total_driver_aktif += $val['driver_aktif'];
                    		$total_driver_inaktif += $val['driver_inaktif'];
                    		$total_driver_retire += $val['driver_retire'];
                    		$total_driver_blacklist += $val['driver_blacklist'];
                    		$total_aktif += $val['total_aktif'];
                    		$total_inaktif += $val['total_inaktif'];
                    		$total_driver += $val['total'];
                    		$avg_driver += $val['avg_driver'];  
                    		$avg_car += $val['avg_car'];       
                    		$median_car += $val['median_car'];               		               		
                    		$mtd_aktif_driver += $val['mtd_aktif_driver'];                    		
                    	}
                    	$total_pct_driver = $mtd_aktif_driver / ($total_aktif > 0 ? $total_aktif : 1) * 100;
                    	echo '<tr><td>TOTAL EAGLE</td>'.
						'<td>'.number_format($total_driver).'</td>'.                    	
                    	'<td class="green">'.number_format($total_driver_aktif).'</td>'.
						'<td class="red">'.number_format($total_driver_inaktif).'</td>'.
						'<td class="blue">'.number_format($total_driver_retire).'</td>'.
						'<td class="orange">'.number_format($total_driver_blacklist).'</td>'.
						'<td class="green">'.number_format($total_aktif).'</td>'.                    		
						'<td class="red">'.number_format($total_inaktif).'</td>'.
						'<td class="green">'.number_format($mtd_aktif_driver).'</td>';
						if($total_pct_driver >= 60){
							echo '<td class="count green">';
						} else if($total_pct_driver >= 45){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count red">';
						}
						echo number_format($total_pct_driver, 2).'%</td>'.
						'<td>'.number_format($avg_driver / Count($data['eagle']), 2).'</td>'.
						'<td>'.number_format($avg_car / Count($data['eagle']), 2).'</td>'.
						'<td>'.number_format($median_car / Count($data['eagle'])).'</td></tr>';						
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
                    		<th>Total Regis Driver</th>                    		
                    		<th>Driver Act</th>
                    		<th>Driver Inactive</th>
                    		<th>Driver Retire</th>
                    		<th>Driver Blacklist</th>
                    		<th>Total Regis Act Driver</th> 
                    		<th>Total Inactive Driver</th> 
                    		<th>MTD Act Driver</th>
                    		<th>Pct Act Driver</th>                    		   
                    		<th>Avg HK Driver</th>
                    		<th>Avg HK Unit</th> 
                    		<th>Median HK Unit</th>                    		                   		                         		              		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_driver_aktif = 0;
                    	$total_driver_inaktif = 0;
                    	$total_driver_retire = 0; 
                    	$total_driver_blacklist = 0;            	
                    	$total_aktif = 0;
						$total_inaktif = 0;
						$total_driver = 0;
						$avg_driver = 0;
						$avg_car = 0;
						$median_car = 0;																		
						$mtd_aktif_driver = 0;												
                    	foreach ((Array) $data['tiara'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		
                    		'<td class="green">'.number_format($val['driver_aktif']).'</td>'.
                    		'<td class="red">'.number_format($val['driver_inaktif']).'</td>'.
                    		'<td class="blue">'.number_format($val['driver_retire']).'</td>'.
                    		'<td class="orange">'.number_format($val['driver_blacklist']).'</td>'.
                    		'<td class="green">'.number_format($val['total_aktif']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['total_inaktif']).'</td>'.
                    		'<td class="green">'.number_format($val['mtd_aktif_driver']).'</td>';
                    		if($val['aktif_rate'] >= 60){
								echo '<td class="count green">';
							} else if($val['aktif_rate'] >= 45){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo number_format($val['aktif_rate'], 2).'%</td>'.
							'<td>'.number_format($val['avg_driver'], 2).'</td>'.														
							'<td>'.number_format($val['avg_car'], 2).'</td>'.
							'<td>'.number_format($val['median_car']).'</td></tr>';														
                    		$total_driver_aktif += $val['driver_aktif'];
                    		$total_driver_inaktif += $val['driver_inaktif'];
                    		$total_driver_retire += $val['driver_retire'];
                    		$total_driver_blacklist += $val['driver_blacklist'];
                    		$total_aktif += $val['total_aktif'];
                    		$total_inaktif += $val['total_inaktif'];
                    		$total_driver += $val['total'];
                    		$avg_driver += $val['avg_driver']; 
                    		$avg_car += $val['avg_car'];   
                    		$median_car += $val['median_car'];               		                  		
                    		$mtd_aktif_driver += $val['mtd_aktif_driver'];                     		
                    	}
                    	$total_pct_driver = $mtd_aktif_driver / ($total_aktif > 0 ? $total_aktif : 1) * 100;
                    	echo '<tr><td>TOTAL TIARA</td>'.
						'<td>'.number_format($total_driver).'</td>'.                    	
                    	'<td class="green">'.number_format($total_driver_aktif).'</td>'.
						'<td class="red">'.number_format($total_driver_inaktif).'</td>'.
						'<td class="blue">'.number_format($total_driver_retire).'</td>'.
						'<td class="orange">'.number_format($total_driver_blacklist).'</td>'.
						'<td class="green">'.number_format($total_aktif).'</td>'.                    		
						'<td class="red">'.number_format($total_inaktif).'</td>'.
						'<td class="green">'.number_format($mtd_aktif_driver).'</td>';
						if($total_pct_driver >= 60){
							echo '<td class="count green">';
						} else if($total_pct_driver >= 45){
							echo '<td class="count orange">';
						} else {
							echo '<td class="count red">';
						}
						echo number_format($total_pct_driver, 2).'%</td>'.
						'<td>'.number_format($avg_driver / (Count($data['tiara']) > 0 ? Count($data['tiara']) : 1), 2).'</td>'.
						'<td>'.number_format($avg_car / (Count($data['tiara']) > 0 ? Count($data['tiara']) : 1), 2).'</td>'.
						'<td>'.number_format($median_car / (Count($data['tiara']) > 0 ? Count($data['tiara']) : 1)).'</td></tr>';						
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
			$('.btnSubmit').on('click', function (e) {
				var date = new Date($('.inputdate').val());
				var mm = date.getMonth() + 1;
				var dd = date.getDate();
				var yy = date.getFullYear();
				window.location = "<?php echo site_url('/Driver/index/');?>"+yy+'-'+mm+'-'+dd;
			});
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				startDate: '<?php echo $datetime->format('d-m-y');?>'
			});
			Morris.Bar({
			  element: 'graph_line',
			  data: [
			  	<?php 
			  	$last_day = date("t", strtotime($date));
			  	foreach((Array) $data['series'] AS $key => $val){
			  		echo "{HK: '1', hk: ".$val['d1']."},";
			  		echo "{HK: '2', hk: ".$val['d2']."},";
			  		echo "{HK: '3', hk: ".$val['d3']."},";
			  		echo "{HK: '4', hk: ".$val['d4']."},";
			  		echo "{HK: '5', hk: ".$val['d5']."},";			  					  					  					  		
			  		echo "{HK: '6', hk: ".$val['d6']."},";
			  		echo "{HK: '7', hk: ".$val['d7']."},";
			  		echo "{HK: '8', hk: ".$val['d8']."},";
			  		echo "{HK: '9', hk: ".$val['d9']."},";
			  		echo "{HK: '10', hk: ".$val['d10']."},";
			  		echo "{HK: '11', hk: ".$val['d11']."},";
			  		echo "{HK: '12', hk: ".$val['d12']."},";
			  		echo "{HK: '13', hk: ".$val['d13']."},";
			  		echo "{HK: '14', hk: ".$val['d14']."},";
			  		echo "{HK: '15', hk: ".$val['d15']."},";			  					  					  					  		
			  		echo "{HK: '16', hk: ".$val['d16']."},";
			  		echo "{HK: '17', hk: ".$val['d17']."},";
			  		echo "{HK: '18', hk: ".$val['d18']."},";
			  		echo "{HK: '19', hk: ".$val['d19']."},";
			  		echo "{HK: '20', hk: ".$val['d20']."},";
			  		echo "{HK: '21', hk: ".$val['d21']."},";
			  		echo "{HK: '22', hk: ".$val['d22']."},";
			  		echo "{HK: '23', hk: ".$val['d23']."},";
			  		echo "{HK: '24', hk: ".$val['d24']."},";
			  		echo "{HK: '25', hk: ".$val['d25']."},";			  					  					  					  		
			  		echo "{HK: '26', hk: ".$val['d26']."},";
			  		echo "{HK: '27', hk: ".$val['d27']."},";
			  		echo "{HK: '28', hk: ".$val['d28']."},";
			  		if($last_day >= 29)
				  		echo "{HK: '29', hk: ".$val['d29']."},";
				  	if($last_day >= 30)	
				  		echo "{HK: '30', hk: ".$val['d30']."},";
					if($last_day >= 31)					  		
			  			echo "{HK: '31', hk: ".$val['d31']."},";
			  	}
				?>
			  ],
			  xkey: 'HK',
			  ykeys: ['hk'],
			  labels: ['Total'],
			  barRatio: 0.4,
			  barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
			  xLabelAngle: 35,
			  hideHover: 'auto',
			  resize: false
			});
			Morris.Bar({
			  element: 'graph_line2',
			  data: [
			  	<?php 
			  	$last_day = date("t", strtotime($date));
			  	foreach((Array) $data['mtd_car_active'] AS $key => $val){
			  		echo "{HK: '1', hk: ".$val['d1']."},";
			  		echo "{HK: '2', hk: ".$val['d2']."},";
			  		echo "{HK: '3', hk: ".$val['d3']."},";
			  		echo "{HK: '4', hk: ".$val['d4']."},";
			  		echo "{HK: '5', hk: ".$val['d5']."},";			  					  					  					  		
			  		echo "{HK: '6', hk: ".$val['d6']."},";
			  		echo "{HK: '7', hk: ".$val['d7']."},";
			  		echo "{HK: '8', hk: ".$val['d8']."},";
			  		echo "{HK: '9', hk: ".$val['d9']."},";
			  		echo "{HK: '10', hk: ".$val['d10']."},";
			  		echo "{HK: '11', hk: ".$val['d11']."},";
			  		echo "{HK: '12', hk: ".$val['d12']."},";
			  		echo "{HK: '13', hk: ".$val['d13']."},";
			  		echo "{HK: '14', hk: ".$val['d14']."},";
			  		echo "{HK: '15', hk: ".$val['d15']."},";			  					  					  					  		
			  		echo "{HK: '16', hk: ".$val['d16']."},";
			  		echo "{HK: '17', hk: ".$val['d17']."},";
			  		echo "{HK: '18', hk: ".$val['d18']."},";
			  		echo "{HK: '19', hk: ".$val['d19']."},";
			  		echo "{HK: '20', hk: ".$val['d20']."},";
			  		echo "{HK: '21', hk: ".$val['d21']."},";
			  		echo "{HK: '22', hk: ".$val['d22']."},";
			  		echo "{HK: '23', hk: ".$val['d23']."},";
			  		echo "{HK: '24', hk: ".$val['d24']."},";
			  		echo "{HK: '25', hk: ".$val['d25']."},";			  					  					  					  		
			  		echo "{HK: '26', hk: ".$val['d26']."},";
			  		echo "{HK: '27', hk: ".$val['d27']."},";
			  		echo "{HK: '28', hk: ".$val['d28']."},";
			  		if($last_day >= 29)
				  		echo "{HK: '29', hk: ".$val['d29']."},";
				  	if($last_day >= 30)	
				  		echo "{HK: '30', hk: ".$val['d30']."},";
					if($last_day >= 31)					  		
			  			echo "{HK: '31', hk: ".$val['d31']."},";
			  	}
				?>
			  ],
			  xkey: 'HK',
			  ykeys: ['hk'],
			  labels: ['Total'],
			  barRatio: 0.4,
			  barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
			  xLabelAngle: 35,
			  hideHover: 'auto',
			  resize: false
			});
			var reg_total = <?php echo ($data['reg_total_driver'] > 0 ? $data['reg_total_driver'] : 1);?>;
			var reg_bravo_aktif = (<?php echo $data['reg_bravo_aktif'];?> / reg_total * 100).toFixed(2);
			var reg_bravo_inaktif = (<?php echo $data['reg_bravo_inaktif'];?> / reg_total * 100).toFixed(2);
			var reg_charli_aktif = (<?php echo $data['reg_charli_aktif'];?> / reg_total * 100).toFixed(2);
			var reg_charli_inaktif = (<?php echo $data['reg_charli_inaktif'];?> / reg_total * 100).toFixed(2);

			new Chart(document.getElementById("canvas_reguler"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "B Active",
				  "C Active",				  
				  "B Inactive",
				  "C Inactive"
				],
				datasets: [{
				  data: [reg_bravo_aktif, reg_charli_aktif, reg_bravo_inaktif, reg_charli_inaktif],
				  backgroundColor: [
					"#26B99A",
					"#3498DB",
					"#E74C3C",
					"#FFA500",
					"#9CC2CB"
				  ],
				  hoverBackgroundColor: [
					"#36CAAB",
					"#49A9EA",
					"#E95E4F",
					"#FED500",
					"#8CB2BB"				  
				  ]
				}]
			  },
			  options: options
			});
			var eagle_total = <?php echo ($data['eagle_total_driver'] > 0 ? $data['eagle_total_driver'] : 1);?>;
			var eagle_driver_aktif = (<?php echo $data['eagle_driver_aktif'];?> / eagle_total * 100).toFixed(2);
			var eagle_driver_inaktif = (<?php echo $data['eagle_driver_inaktif'];?> / eagle_total * 100).toFixed(2);
			var eagle_driver_retire = (<?php echo $data['eagle_driver_retire'];?> / eagle_total * 100).toFixed(2);
			var eagle_driver_blacklist = (<?php echo $data['eagle_driver_blacklist'];?> / eagle_total * 100).toFixed(2);
			new Chart(document.getElementById("canvas_eagle"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Active",
				  "Inactive",
				  "Retire",
				  "Blacklist"
				],
				datasets: [{
				  data: [eagle_driver_aktif, eagle_driver_inaktif, eagle_driver_retire, eagle_driver_blacklist],
				  backgroundColor: [
					"#26B99A",
					"#E74C3C",
					"#9B59B6",					
					"#FFA500"				
				  ],
				  hoverBackgroundColor: [
					"#36CAAB",
					"#E95E4F",
					"#B370CF",					
					"#FED500"	
				  ]
				}]
			  },
			  options: options
			});
			
			var tiara_total = <?php echo ($data['tiara_total_driver'] > 0 ? $data['tiara_total_driver'] : 1);?>;
			var tiara_driver_aktif = (<?php echo $data['tiara_driver_aktif'];?> / tiara_total * 100).toFixed(2);
			var tiara_driver_inaktif = (<?php echo $data['tiara_driver_inaktif'];?> / tiara_total * 100).toFixed(2);
			var tiara_driver_retire = (<?php echo $data['tiara_driver_retire'];?> / tiara_total * 100).toFixed(2);
			var tiara_driver_blacklist = (<?php echo $data['tiara_driver_blacklist'];?> / tiara_total * 100).toFixed(2);
			new Chart(document.getElementById("canvas_tiara"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Active",
				  "Inactive",
				  "Retire",
				  "Blacklist"
				],
				datasets: [{
				  data: [tiara_driver_aktif, tiara_driver_inaktif, tiara_driver_retire, tiara_driver_blacklist],
				  backgroundColor: [
					"#26B99A",
					"#E74C3C",
					"#9B59B6",					
					"#FFA500"					
				  ],
				  hoverBackgroundColor: [
					"#36CAAB",
					"#E95E4F",
					"#B370CF",					
					"#FED500"
				  ]
				}]
			  },
			  options: options
			});
		  });
		</script>
		<!-- /Doughnut Chart -->