		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Ritase RDS 
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
              <span class="count_top"><i class="fa fa-taxi"></i> Total Operating Unit in RDS</span>
              <div class="count"><?php echo number_format($data['total_unit']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-exchange"></i> Total Ritase in RDS</span>
              <div class="count blue"><?php echo number_format($data['total_ritase']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
            <?php
            	if($this->user['id_privilege'] === '8'){
            		echo '<span class="count_top"><i class="fa fa-car"></i> Total Unit SPJ</span>'.
              	   		 '<div class="count green">'.number_format($data['total_spj']).'</div>';
            	} else {
              		echo '<span class="count_top"><i class="fa fa-money"></i> Total Argo in RDS</span>'.
              	   		 '<div class="count green">'.number_format($data['total_argo']).'</div>';
              	}
            ?>  
            </div> 
           </div>
           <div class="row tile_count"> 
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Avg Argo Per Ritase</span>
			  <div class="count purple"><?php echo number_format($data['total_aapr'], 2); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Avg Ritase Per Unit</span>
			  <div class="count blue"><?php echo number_format($data['total_arit'], 2); ?></div>
            </div>
			<div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Avg Argo Per Unit</span>
			  <div class="count green"><?php echo number_format($data['total_arpu'], 2); ?></div>
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
					<h2>30 Day Avg Ritase VS Total Unit</h2>
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
					<h2>30 Day Avg Ritase VS Avg Argo Per Unit</h2>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content2">
					<div id="graph_area4" style="width:100%; height:300px;"></div>
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
                    		<th>Name</th>
                    		<th>Op Unit in RDS</th>                    		
                    		<th>Ritase RDS</th>
                    		<th>Argo RDS</th>
                    		<th>Avg Ritase RDS</th>                    		
                    		<th>Avg Argo RDS</th>  
                    		<th>Avg Argo Per Ritase RDS</th>                      		                  		    
							<th>OP Unit SPJ</th>
							<th>Pct RDS Active</th>						                		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_ritase = 0;
                    	$total_argo = 0;	
                    	$total_unit = 0;
                    	$total_spj = 0;	                    	    	
                    	foreach ((Array) $data['pool_reguler'] AS $key => $val) { 
                    		$pct_rds = $val['unit'] / $val['spj'] * 100;
                    		echo '<tr><td>'.$val['name'].'</td>'.
							'<td>'.number_format($val['unit']).'</td>'.
							'<td class="blue">'.number_format($val['ritase']).'</td>'.
							'<td>'.number_format($val['argo']).'</td>'.							
							'<td class="'.($val['arit'] >= $data['total_arit'] ? "green" : "red").'">'.number_format($val['arit'], 2).'</td>'.
							'<td class="'.($val['arpu'] >= $data['total_arpu'] ? "green" : "red").'">'.number_format($val['arpu'], 2).'</td>'.
							'<td class="'.($val['aapr'] >= $data['total_aapr'] ? "green" : "red").'">'.number_format($val['aapr'], 2).'</td>'.							
							'<td>'.number_format($val['spj']).'</td>';
							if($pct_rds < 75)
								echo '<td class="red">';
							else if($pct_rds < 90)
								echo '<td class="orange">';
							else if($pct_rds > 100)
								echo '<td class="purple">';
							else 
								echo '<td class="green">';
							echo number_format($pct_rds, 2).'%</td></tr>';
                    		$total_ritase += $val['ritase'];                    		
							$total_argo += $val['argo'];
							$total_unit += $val['unit'];                    		
							$total_spj += $val['spj'];
                    	}
                    	$total_pct_rds = $total_unit / ($total_spj > 0 ? $total_spj : 1)* 100;
                    	$total_arit = $total_ritase / ($total_unit > 0 ? $total_unit : 1);
                    	$total_arpu = $total_argo / ($total_unit > 0 ? $total_unit : 1);
                    	$total_aapr = $total_argo / ($total_ritase > 0 ? $total_ritase : 1);                    	                    	                  	                    	
                    	echo '<tr><td>TOTAL AREA 1</td>'.
						'<td>'.number_format($total_unit).'</td>'.                         	
						'<td class="blue">'.number_format($total_ritase).'</td>'.     
						'<td>'.number_format($total_argo).'</td>'.
						'<td class="'.($total_arit >= $data['total_arit'] ? "green" : "red").'">'.number_format($total_arit, 2).'</td>'.
						'<td class="'.($total_arpu >= $data['total_arpu'] ? "green" : "red").'">'.number_format($total_arpu, 2).'</td>'.
						'<td class="'.($total_aapr >= $data['total_aapr'] ? "green" : "red").'">'.number_format($total_aapr, 2).'</td>'.
						'<td>'.number_format($total_spj).'</td>';
						if($total_pct_rds < 75)
							echo '<td class="red">';
						else if($total_pct_rds < 90 || $total_pct_rds > 100)
							echo '<td class="orange">';
						else 
							echo '<td class="green">';
						echo number_format($total_pct_rds, 2).'%</td></tr>';
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
                    		<th>Name</th>
                    		<th>Op Unit in RDS</th>                    		
                    		<th>Ritase RDS</th>
                    		<th>Argo RDS</th>
                    		<th>Avg Ritase RDS</th>                    		
                    		<th>Avg Argo RDS</th>  
                    		<th>Avg Argo Per Ritase RDS</th>                      		                  		    
							<th>OP Unit SPJ</th>  
							<th>Pct RDS Active</th>							              		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_ritase = 0;
                    	$total_argo = 0;	
                    	$total_unit = 0;
                    	$total_spj = 0;	                    	    	
                    	foreach ((Array) $data['pool_reguler2'] AS $key => $val) { 
                    		$pct_rds = $val['unit'] / ($val['spj'] > 0 ? $val['spj'] : 1) * 100;
                    		echo '<tr><td>'.$val['name'].'</td>'.
							'<td>'.number_format($val['unit']).'</td>'.
							'<td class="blue">'.number_format($val['ritase']).'</td>'.
							'<td>'.number_format($val['argo']).'</td>'.							
							'<td class="'.($val['arit'] >= $data['total_arit'] ? "green" : "red").'">'.number_format($val['arit'], 2).'</td>'.
							'<td class="'.($val['arpu'] >= $data['total_arpu'] ? "green" : "red").'">'.number_format($val['arpu'], 2).'</td>'.
							'<td class="'.($val['aapr'] >= $data['total_aapr'] ? "green" : "red").'">'.number_format($val['aapr'], 2).'</td>'.							
							'<td>'.number_format($val['spj']).'</td>';
							if($pct_rds < 75)
								echo '<td class="red">';
							else if($pct_rds < 90)
								echo '<td class="orange">';
							else if($pct_rds > 100)
								echo '<td class="purple">';
							else 
								echo '<td class="green">';
							echo number_format($pct_rds, 2).'%</td></tr>';
                    		$total_ritase += $val['ritase'];                    		
							$total_argo += $val['argo'];
							$total_unit += $val['unit'];                    		
							$total_spj += $val['spj'];
                    	}
                    	$total_pct_rds = $total_unit / ($total_spj > 0 ? $total_spj : 1) * 100;
                    	$total_arit = $total_ritase / ($total_unit > 0 ? $total_unit : 1);
                    	$total_arpu = $total_argo / ($total_unit > 0 ? $total_unit : 1);
                    	$total_aapr = $total_argo / ($total_ritase > 0 ? $total_ritase : 1);                    	                    	                  	                    	
                    	echo '<tr><td>TOTAL AREA 2</td>'.
						'<td>'.number_format($total_unit).'</td>'.                         	
						'<td class="blue">'.number_format($total_ritase).'</td>'.     
						'<td>'.number_format($total_argo).'</td>'.
						'<td class="'.($total_arit >= $data['total_arit'] ? "green" : "red").'">'.number_format($total_arit, 2).'</td>'.
						'<td class="'.($total_arpu >= $data['total_arpu'] ? "green" : "red").'">'.number_format($total_arpu, 2).'</td>'.
						'<td class="'.($total_aapr >= $data['total_aapr'] ? "green" : "red").'">'.number_format($total_aapr, 2).'</td>'.
						'<td>'.number_format($total_spj).'</td>';
						if($total_pct_rds < 75)
							echo '<td class="red">';
						else if($total_pct_rds < 90 || $total_pct_rds > 100)
							echo '<td class="orange">';
						else 
							echo '<td class="green">';
						echo number_format($total_pct_rds, 2).'%</td></tr>';
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
                    		<th>Name</th>
                    		<th>Op Unit in RDS</th>                    		
                    		<th>Ritase RDS</th>
                    		<th>Argo RDS</th>
                    		<th>Avg Ritase RDS</th>                    		
                    		<th>Avg Argo RDS</th>  
                    		<th>Avg Argo Per Ritase RDS</th>                      		                  		    
							<th>OP Unit SPJ</th>  
							<th>Pct RDS Active</th>							              		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_ritase = 0;
                    	$total_argo = 0;	
                    	$total_unit = 0;
                    	$total_spj = 0;	                    	    	
                    	foreach ((Array) $data['pool_reguler3'] AS $key => $val) { 
                    		$pct_rds = $val['unit'] / ($val['spj'] > 0 ? $val['spj'] : 1) * 100;
                    		echo '<tr><td>'.$val['name'].'</td>'.
							'<td>'.number_format($val['unit']).'</td>'.
							'<td class="blue">'.number_format($val['ritase']).'</td>'.
							'<td>'.number_format($val['argo']).'</td>'.							
							'<td class="'.($val['arit'] >= $data['total_arit'] ? "green" : "red").'">'.number_format($val['arit'], 2).'</td>'.
							'<td class="'.($val['arpu'] >= $data['total_arpu'] ? "green" : "red").'">'.number_format($val['arpu'], 2).'</td>'.
							'<td class="'.($val['aapr'] >= $data['total_aapr'] ? "green" : "red").'">'.number_format($val['aapr'], 2).'</td>'.							
							'<td>'.number_format($val['spj']).'</td>';
							if($pct_rds < 75)
								echo '<td class="red">';
							else if($pct_rds < 90)
								echo '<td class="orange">';
							else if($pct_rds > 100)
								echo '<td class="purple">';
							else 
								echo '<td class="green">';
							echo number_format($pct_rds, 2).'%</td></tr>';
                    		$total_ritase += $val['ritase'];                    		
							$total_argo += $val['argo'];
							$total_unit += $val['unit'];                    		
							$total_spj += $val['spj'];
                    	}
                    	$total_pct_rds = $total_unit / ($total_spj > 0 ? $total_spj : 1) * 100;
                    	$total_arit = $total_ritase / ($total_unit > 0 ? $total_unit : 1);
                    	$total_arpu = $total_argo / ($total_unit > 0 ? $total_unit : 1);
                    	$total_aapr = $total_argo / ($total_ritase > 0 ? $total_ritase : 1);                    	                    	                  	                    	
                    	echo '<tr><td>TOTAL AREA 3</td>'.
						'<td>'.number_format($total_unit).'</td>'.                         	
						'<td class="blue">'.number_format($total_ritase).'</td>'.     
						'<td>'.number_format($total_argo).'</td>'.
						'<td class="'.($total_arit >= $data['total_arit'] ? "green" : "red").'">'.number_format($total_arit, 2).'</td>'.
						'<td class="'.($total_arpu >= $data['total_arpu'] ? "green" : "red").'">'.number_format($total_arpu, 2).'</td>'.
						'<td class="'.($total_aapr >= $data['total_aapr'] ? "green" : "red").'">'.number_format($total_aapr, 2).'</td>'.
						'<td>'.number_format($total_spj).'</td>';
						if($total_pct_rds < 75)
							echo '<td class="red">';
						else if($total_pct_rds < 90 || $total_pct_rds > 100)
							echo '<td class="orange">';
						else 
							echo '<td class="green">';
						echo number_format($total_pct_rds, 2).'%</td></tr>';
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
                    		<th>Name</th>
                    		<th>Op Unit in RDS</th>                    		
                    		<th>Ritase RDS</th>
                    		<th>Argo RDS</th>
                    		<th>Avg Ritase RDS</th>                    		
                    		<th>Avg Argo RDS</th>  
                    		<th>Avg Argo Per Ritase RDS</th>                      		                  		    
							<th>OP Unit SPJ</th>  
							<th>Pct RDS Active</th>							              		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_ritase = 0;
                    	$total_argo = 0;	
                    	$total_unit = 0;
                    	$total_spj = 0;	                    	    	
                    	foreach ((Array) $data['pool_reguler4'] AS $key => $val) { 
                    		$pct_rds = $val['unit'] / ($val['spj'] > 0 ? $val['spj'] : 1) * 100;
                    		echo '<tr><td>'.$val['name'].'</td>'.
							'<td>'.number_format($val['unit']).'</td>'.
							'<td class="blue">'.number_format($val['ritase']).'</td>'.
							'<td>'.number_format($val['argo']).'</td>'.							
							'<td class="'.($val['arit'] >= $data['total_arit'] ? "green" : "red").'">'.number_format($val['arit'], 2).'</td>'.
							'<td class="'.($val['arpu'] >= $data['total_arpu'] ? "green" : "red").'">'.number_format($val['arpu'], 2).'</td>'.
							'<td class="'.($val['aapr'] >= $data['total_aapr'] ? "green" : "red").'">'.number_format($val['aapr'], 2).'</td>'.							
							'<td>'.number_format($val['spj']).'</td>';
							if($pct_rds < 75)
								echo '<td class="red">';
							else if($pct_rds < 90)
								echo '<td class="orange">';
							else if($pct_rds > 100)
								echo '<td class="purple">';
							else 
								echo '<td class="green">';
							echo number_format($pct_rds, 2).'%</td></tr>';
                    		$total_ritase += $val['ritase'];                    		
							$total_argo += $val['argo'];
							$total_unit += $val['unit'];                    		
							$total_spj += $val['spj'];
                    	}
                    	$total_pct_rds = $total_unit / ($total_spj > 0 ? $total_spj : 1) * 100;
                    	$total_arit = $total_ritase / ($total_unit > 0 ? $total_unit : 1);
                    	$total_arpu = $total_argo / ($total_unit > 0 ? $total_unit : 1);
                    	$total_aapr = $total_argo / ($total_ritase > 0 ? $total_ritase : 1);                    	                    	                  	                    	
                    	echo '<tr><td>TOTAL AREA 4</td>'.
						'<td>'.number_format($total_unit).'</td>'.                         	
						'<td class="blue">'.number_format($total_ritase).'</td>'.     
						'<td>'.number_format($total_argo).'</td>'.
						'<td class="'.($total_arit >= $data['total_arit'] ? "green" : "red").'">'.number_format($total_arit, 2).'</td>'.
						'<td class="'.($total_arpu >= $data['total_arpu'] ? "green" : "red").'">'.number_format($total_arpu, 2).'</td>'.
						'<td class="'.($total_aapr >= $data['total_aapr'] ? "green" : "red").'">'.number_format($total_aapr, 2).'</td>'.
						'<td>'.number_format($total_spj).'</td>';
						if($total_pct_rds < 75)
							echo '<td class="red">';
						else if($total_pct_rds < 90 || $total_pct_rds > 100)
							echo '<td class="orange">';
						else 
							echo '<td class="green">';
						echo number_format($total_pct_rds, 2).'%</td></tr>';
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
                    		<th>Name</th>
                    		<th>Op Unit in RDS</th>                    		
                    		<th>Ritase RDS</th>
                    		<th>Argo RDS</th>
                    		<th>Avg Ritase RDS</th>                    		
                    		<th>Avg Argo RDS</th>  
                    		<th>Avg Argo Per Ritase RDS</th>                      		                  		    
							<th>OP Unit SPJ</th>    
							<th>Pct RDS Active</th>							            		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_ritase = 0;
                    	$total_argo = 0;	
                    	$total_unit = 0;
                    	$total_spj = 0;	                    	    	
                    	foreach ((Array) $data['pool_eagle'] AS $key => $val) { 
                    		$pct_rds = $val['unit'] / $val['spj'] * 100;
                    		echo '<tr><td>'.$val['name'].'</td>'.
							'<td>'.number_format($val['unit']).'</td>'.
							'<td class="blue">'.number_format($val['ritase']).'</td>'.
							'<td>'.number_format($val['argo']).'</td>'.							
							'<td class="'.($val['arit'] >= $data['total_arit'] ? "green" : "red").'">'.number_format($val['arit'], 2).'</td>'.
							'<td class="'.($val['arpu'] >= $data['total_arpu'] ? "green" : "red").'">'.number_format($val['arpu'], 2).'</td>'.
							'<td class="'.($val['aapr'] >= $data['total_aapr'] ? "green" : "red").'">'.number_format($val['aapr'], 2).'</td>'.							
							'<td>'.number_format($val['spj']).'</td>';
							if($pct_rds < 75)
								echo '<td class="red">';
							else if($pct_rds < 90)
								echo '<td class="orange">';
							else if($pct_rds > 100)
								echo '<td class="purple">';
							else 
								echo '<td class="green">';
							echo number_format($pct_rds, 2).'%</td></tr>';
                    		$total_ritase += $val['ritase'];                    		
							$total_argo += $val['argo'];
							$total_unit += $val['unit'];                    		
							$total_spj += $val['spj'];
                    	}
                    	$total_pct_rds = $total_unit / ($total_spj > 0 ? $total_spj : 1) * 100;
                    	$total_arit = $total_ritase / ($total_unit > 0 ? $total_unit : 1);
                    	$total_arpu = $total_argo / ($total_unit > 0 ? $total_unit : 1);
                    	$total_aapr = $total_argo / ($total_ritase > 0 ? $total_ritase : 1);                    	                    	                  	                    	
                    	echo '<tr><td>TOTAL EAGLE</td>'.
						'<td>'.number_format($total_unit).'</td>'.                         	
						'<td class="blue">'.number_format($total_ritase).'</td>'.     
						'<td>'.number_format($total_argo).'</td>'.
						'<td class="'.($total_arit >= $data['total_arit'] ? "green" : "red").'">'.number_format($total_arit, 2).'</td>'.
						'<td class="'.($total_arpu >= $data['total_arpu'] ? "green" : "red").'">'.number_format($total_arpu, 2).'</td>'.
						'<td class="'.($total_aapr >= $data['total_aapr'] ? "green" : "red").'">'.number_format($total_aapr, 2).'</td>'.
						'<td>'.number_format($total_spj).'</td>';
						if($total_pct_rds < 75)
							echo '<td class="red">';
						else if($total_pct_rds < 90 || $total_pct_rds > 100)
							echo '<td class="orange">';
						else 
							echo '<td class="green">';
						echo number_format($total_pct_rds, 2).'%</td></tr>';
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
                    		<th>Name</th>
                    		<th>Op Unit in RDS</th>                    		
                    		<th>Ritase RDS</th>
                    		<th>Argo RDS</th>
                    		<th>Avg Ritase RDS</th>                    		
                    		<th>Avg Argo RDS</th>  
                    		<th>Avg Argo Per Ritase RDS</th>                      		                  		    
							<th>OP Unit SPJ</th>  
							<th>Pct RDS Active</th>							              		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_ritase = 0;
                    	$total_argo = 0;	
                    	$total_unit = 0;
                    	$total_spj = 0;	                    	    	
                    	foreach ((Array) $data['pool_tiara'] AS $key => $val) { 
                    		$pct_rds = $val['unit'] / $val['spj'] * 100;
                    		echo '<tr><td>'.$val['name'].'</td>'.
							'<td>'.number_format($val['unit']).'</td>'.
							'<td class="blue">'.number_format($val['ritase']).'</td>'.
							'<td>'.number_format($val['argo']).'</td>'.							
							'<td class="'.($val['arit'] >= $data['total_arit'] ? "green" : "red").'">'.number_format($val['arit'], 2).'</td>'.
							'<td class="'.($val['arpu'] >= $data['total_arpu'] ? "green" : "red").'">'.number_format($val['arpu'], 2).'</td>'.
							'<td class="'.($val['aapr'] >= $data['total_aapr'] ? "green" : "red").'">'.number_format($val['aapr'], 2).'</td>'.							
							'<td>'.number_format($val['spj']).'</td>';
							if($pct_rds < 75)
								echo '<td class="red">';
							else if($pct_rds < 90)
								echo '<td class="orange">';
							else if($pct_rds > 100)
								echo '<td class="purple">';
							else 
								echo '<td class="green">';
							echo number_format($pct_rds, 2).'%</td></tr>';
                    		$total_ritase += $val['ritase'];                    		
							$total_argo += $val['argo'];
							$total_unit += $val['unit'];                    		
							$total_spj += $val['spj'];
                    	}
                    	$total_pct_rds = $total_unit / ($total_spj > 0 ? $total_spj : 1) * 100;
                    	$total_arit = $total_ritase / ($total_unit > 0 ? $total_unit : 1);
                    	$total_arpu = $total_argo / ($total_unit > 0 ? $total_unit : 1);
                    	$total_aapr = $total_argo / ($total_ritase > 0 ? $total_ritase : 1);                    	                    	                  	                    	
                    	echo '<tr><td>TOTAL TIARA</td>'.
						'<td>'.number_format($total_unit).'</td>'.                         	
						'<td class="blue">'.number_format($total_ritase).'</td>'.     
						'<td>'.number_format($total_argo).'</td>'.
						'<td class="'.($total_arit >= $data['total_arit'] ? "green" : "red").'">'.number_format($total_arit, 2).'</td>'.
						'<td class="'.($total_arpu >= $data['total_arpu'] ? "green" : "red").'">'.number_format($total_arpu, 2).'</td>'.
						'<td class="'.($total_aapr >= $data['total_aapr'] ? "green" : "red").'">'.number_format($total_aapr, 2).'</td>'.
						'<td>'.number_format($total_spj).'</td>';
						if($total_pct_rds < 75)
							echo '<td class="red">';
						else if($total_pct_rds < 90 || $total_pct_rds > 100)
							echo '<td class="orange">';
						else 
							echo '<td class="green">';
						echo number_format($total_pct_rds, 2).'%</td></tr>';
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
		<script src="<?php echo base_url('/assets/js/highcharts.js');?>"></script>
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
				window.location = "<?php echo site_url('/Ritase/index?');?>"+'start='+start+'&end='+end;
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
			  		echo "{period: '".$val['ritase']."', ct: ".$val['ct']."},";
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
					zoomType: 'xy'
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
							color: Highcharts.getOptions().colors[6]
						}
					},
					title: {
						text: 'Total Unit',
						style: {
							color: Highcharts.getOptions().colors[6]
						}
					}
				}, { // Secondary yAxis
					title: {
						text: 'Avg Ritase',
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
					floating: true,
					backgroundColor: '#FFFFFF'
				},
				series: [{
					name: 'Total Unit',
					type: 'column',
					data: [
					<?php 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo ($val['total_unit']).",";
						}
					?>
					],
					color: Highcharts.getOptions().colors[6],
				}, {
					name: 'Avg Ritase',
					type: 'spline',
					yAxis: 1,
					data: [
					<?php 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo round($val['total_ritase'] / ($val['total_unit'] > 0 ? $val['total_unit'] : 1), 2).",";
						}
						?>
					],
					color: '#3498DB',
				}]
			});
    		Highcharts.chart('graph_area3', {
				chart: {
					zoomType: 'xy'
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
				yAxis: [{ // Secondary yAxis
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
				}, { // Primary yAxis
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
					floating: true,
					backgroundColor: '#FFFFFF'
				},
				series: [{
					name: 'Total Ritase',
					type: 'column',
					data: [
					<?php 
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							echo $val['total_ritase'].",";
						}
					?>
					],
					color: '#3498DB',
				}, {
					name: 'Avg Argo Per Ritase',
					type: 'spline',
					yAxis: 1,
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
					zoomType: 'xy'
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
							color: Highcharts.getOptions().colors[2]
						}
					},
					title: {
						text: 'Avg Argo Per Unit',
						style: {
							color: Highcharts.getOptions().colors[2]
						}
					}
				}, { // Secondary yAxis
					title: {
						text: 'Avg Ritase',
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
					floating: true,
					backgroundColor: '#FFFFFF'
				},
				series: [{
					name: 'Avg Argo Per Unit',
					type: 'column',
					data: [
					<?php 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo round($val['total_argo'] / ($val['total_unit'] > 0 ? $val['total_unit'] : 1), 2).",";
						}
					?>
					],
					color: Highcharts.getOptions().colors[2],
				}, {
					name: 'Avg Ritase',
					type: 'spline',
					yAxis: 1,
					data: [
					<?php 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo round($val['total_ritase'] / ($val['total_unit'] > 0 ? $val['total_unit'] : 1), 2).",";
						}
						?>
					],
					color: '#3498DB',
				}]
			});
		});
		</script>
		<!-- /Doughnut Chart -->