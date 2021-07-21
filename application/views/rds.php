		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>RDS - <?php $datetime = new DateTime($date); echo $datetime->format('l, j F Y'); ?></h2>
          		<h4>Last Update <?php echo $date;?>
				</div>
          	</div>
          </div>
          <div class="row tile_count">
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-mobile-phone"></i> Total RDS Troubled</span>
              <div class="count red"><?php echo number_format($data['total_trouble']); ?></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Pct RDS Troubled</span>
              <div class="count <?php echo ($data['pct_na'] >= 5 ? 'red' : 'green'); ?>"><?php echo $data['pct_na']; ?>%</div>
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
          <div class="row <?php if(Count($data['area_checker']) > 0) echo 'hidden';?>">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Pool Reguler Area 1</h2>              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>    
                    		<th>Total Login</th>                    		               		                    		
                    		<th>Normal</th> 
                    		<th>N/A</th>
                    		<th>Pct N/A</th>
                    		<th>Error</th>
                    		<th>Argo Not Connected</th>                    		                    		
                    		<th>None Connected</th>
                    		<th>All Connected</th>                    		
                    		<th>Fail Login</th>
                    		<th>Manual Login</th>                     		                    		                    		                    		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php				
						$total_connected = 0; 
						$total_error = 0;
						$total_argo = 0;
						$total_none = 0;
						$total_total = 0;
						$total_normal = 0;
						$total_na = 0;
						$total_fail = 0;
						$total_manual = 0;	
						
                    	foreach ((Array) $data['area_1'] AS $key => $val) { 
                    		$pct_na = $val['na'] / ($val['total'] > 0 ? $val['total'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Rds/Detail?id=".$val['id']).'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		                  		                     		
                    		'<td class="green">'.number_format($val['normal']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['na']).'</td>';
                    		if($pct_na > 5){
                    			echo '<td class="red">';
                    		} else {
                    			echo '<td class="green">';
                    		}	 
                    		echo number_format($pct_na,2).'%</td>'.
                    		'<td class="orange">'.number_format($val['error']).'</td>'.
                    		'<td class="blue">'.number_format($val['argo']).'</td>'.
                    		'<td class="red">'.number_format($val['none']).'</td>'.
                    		'<td class="green">'.number_format($val['connected']).'</td>'.                    									   
                    		'<td class="orange">'.number_format($val['fail']).'</td>'.
							'<td class="red">'.number_format($val['manual']).'</td></tr>'; 							
                    		$total_connected += $val['connected']; 
                    		$total_error += $val['error'];
                    		$total_argo += $val['argo'];
                    		$total_none += $val['none'];
                    		$total_total += $val['total'];                    		                    		                    		                    		  		
                    		$total_normal += $val['normal'];
                    		$total_na += $val['na'];
							$total_fail += $val['fail'];
							$total_manual += $val['manual'];							                    		
                    	}
                    ?>
                    </tbody>
                    <tfoot>
                    <?php 
                    	$pct_na = $total_na / ($total_total > 0 ? $total_total : 1) * 100;
                    	echo '<tr><td>Total Area 1</td>'.  
						'<td>'.number_format($total_total).'</td>'.                    	
						'<td class="green">'.number_format($total_normal).'</td>'.                    		
						'<td class="red">'.number_format($total_na).'</td>';
						if($pct_na > 5){
							echo '<td class="red">';
						} else {
							echo '<td class="green">';
						}	 
						echo number_format($pct_na,2).'%</td>'.                    	                		
						'<td class="orange">'.number_format($total_error).'</td>'.
						'<td class="blue">'.number_format($total_argo).'</td>'.
						'<td class="red">'.number_format($total_none).'</td>'.
						'<td class="green">'.number_format($total_connected).'</td>'.
						'<td class="orange">'.number_format($total_fail).'</td>'.
						'<td class="red">'.number_format($total_manual).'</td></tr>';						
                    ?>
                    </tfoot>
                  </table>
                </div>
              </div>
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Pool Reguler Area 2</h2>              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>    
                    		<th>Total Login</th>                    		               		                    		
                    		<th>Normal</th> 
                    		<th>N/A</th>
                    		<th>Pct N/A</th>
                    		<th>Error</th>
                    		<th>Argo Not Connected</th>                    		                    		
                    		<th>None Connected</th>
                    		<th>All Connected</th>                    		
                    		<th>Fail Login</th>
                    		<th>Manual Login</th>                   		                   		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php				
						$total_connected = 0; 
						$total_error = 0;
						$total_argo = 0;
						$total_none = 0;
						$total_total = 0;
						$total_normal = 0;
						$total_na = 0;
						$total_fail = 0;	
						$total_manual = 0;																							
                    	foreach ((Array) $data['area_2'] AS $key => $val) { 
                    		$pct_na = $val['na'] / ($val['total'] > 0 ? $val['total'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Rds/Detail?id=".$val['id']).'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		                  		                     		
                    		'<td class="green">'.number_format($val['normal']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['na']).'</td>';
                    		if($pct_na > 5){
                    			echo '<td class="red">';
                    		} else {
                    			echo '<td class="green">';
                    		}	 
                    		echo number_format($pct_na,2).'%</td>'.
                    		'<td class="orange">'.number_format($val['error']).'</td>'.
                    		'<td class="blue">'.number_format($val['argo']).'</td>'.
                    		'<td class="red">'.number_format($val['none']).'</td>'.
                    		'<td class="green">'.number_format($val['connected']).'</td>'.                    									   
                    		'<td class="orange">'.number_format($val['fail']).'</td>'.
							'<td class="red">'.number_format($val['manual']).'</td></tr>'; 
                    		$total_connected += $val['connected']; 
                    		$total_error += $val['error'];
                    		$total_argo += $val['argo'];
                    		$total_none += $val['none'];
                    		$total_total += $val['total'];                    		                    		                    		                    		  		
                    		$total_normal += $val['normal'];
                    		$total_na += $val['na'];
							$total_fail += $val['fail'];  
							$total_manual += $val['manual'];							                  		
                    	}
                    ?>
                    </tbody>
                    <tfoot>
                    <?php 
                    	$pct_na = $total_na / ($total_total > 0 ? $total_total : 1) * 100;
                    	echo '<tr><td>Total Area 2</td>'.                  		
						'<td>'.number_format($total_total).'</td>'.                    	
						'<td class="green">'.number_format($total_normal).'</td>'.                    		
						'<td class="red">'.number_format($total_na).'</td>';
						if($pct_na > 5){
							echo '<td class="red">';
						} else {
							echo '<td class="green">';
						}	 
						echo number_format($pct_na,2).'%</td>'.                    	                		
						'<td class="orange">'.number_format($total_error).'</td>'.
						'<td class="blue">'.number_format($total_argo).'</td>'.
						'<td class="red">'.number_format($total_none).'</td>'.
						'<td class="green">'.number_format($total_connected).'</td>'.
						'<td class="orange">'.number_format($total_fail).'</td>'.
						'<td class="red">'.number_format($total_manual).'</td></tr>';	
                    ?>
                    </tfoot>
                  </table>
                </div>
              </div>
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Pool Reguler Area 3</h2>              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>    
                    		<th>Total Login</th>                    		               		                    		
                    		<th>Normal</th> 
                    		<th>N/A</th>
                    		<th>Pct N/A</th>
                    		<th>Error</th>
                    		<th>Argo Not Connected</th>                    		                    		
                    		<th>None Connected</th>
                    		<th>All Connected</th>                    		
                    		<th>Fail Login</th>
                    		<th>Manual Login</th>                   		                   		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php				
						$total_connected = 0; 
						$total_error = 0;
						$total_argo = 0;
						$total_none = 0;
						$total_total = 0;
						$total_normal = 0;
						$total_na = 0;
						$total_fail = 0;	
						$total_manual = 0;																							
                    	foreach ((Array) $data['area_3'] AS $key => $val) { 
                    		$pct_na = $val['na'] / ($val['total'] > 0 ? $val['total'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Rds/Detail?id=".$val['id']).'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		                  		                     		
                    		'<td class="green">'.number_format($val['normal']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['na']).'</td>';
                    		if($pct_na > 5){
                    			echo '<td class="red">';
                    		} else {
                    			echo '<td class="green">';
                    		}	 
                    		echo number_format($pct_na,2).'%</td>'.
                    		'<td class="orange">'.number_format($val['error']).'</td>'.
                    		'<td class="blue">'.number_format($val['argo']).'</td>'.
                    		'<td class="red">'.number_format($val['none']).'</td>'.
                    		'<td class="green">'.number_format($val['connected']).'</td>'.                    									   
                    		'<td class="orange">'.number_format($val['fail']).'</td>'.
							'<td class="red">'.number_format($val['manual']).'</td></tr>'; 
                    		$total_connected += $val['connected']; 
                    		$total_error += $val['error'];
                    		$total_argo += $val['argo'];
                    		$total_none += $val['none'];
                    		$total_total += $val['total'];                    		                    		                    		                    		  		
                    		$total_normal += $val['normal'];
                    		$total_na += $val['na'];
							$total_fail += $val['fail'];  
							$total_manual += $val['manual'];							                  		
                    	}
                    ?>
                    </tbody>
                    <tfoot>
                    <?php 
                    	$pct_na = $total_na / ($total_total > 0 ? $total_total : 1) * 100;
                    	echo '<tr><td>Total Area 3</td>'.                  		
						'<td>'.number_format($total_total).'</td>'.                    	
						'<td class="green">'.number_format($total_normal).'</td>'.                    		
						'<td class="red">'.number_format($total_na).'</td>';
						if($pct_na > 5){
							echo '<td class="red">';
						} else {
							echo '<td class="green">';
						}	 
						echo number_format($pct_na,2).'%</td>'.                    	                		
						'<td class="orange">'.number_format($total_error).'</td>'.
						'<td class="blue">'.number_format($total_argo).'</td>'.
						'<td class="red">'.number_format($total_none).'</td>'.
						'<td class="green">'.number_format($total_connected).'</td>'.
						'<td class="orange">'.number_format($total_fail).'</td>'.
						'<td class="red">'.number_format($total_manual).'</td></tr>';	
                    ?>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="x_panel tile">
                <div class="x_title">
                  <h2>Pool Reguler Area 4</h2>              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>    
                    		<th>Total Login</th>                    		               		                    		
                    		<th>Normal</th> 
                    		<th>N/A</th>
                    		<th>Pct N/A</th>
                    		<th>Error</th>
                    		<th>Argo Not Connected</th>                    		                    		
                    		<th>None Connected</th>
                    		<th>All Connected</th>                    		
                    		<th>Fail Login</th>
                    		<th>Manual Login</th>                   		                   		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php				
						$total_connected = 0; 
						$total_error = 0;
						$total_argo = 0;
						$total_none = 0;
						$total_total = 0;
						$total_normal = 0;
						$total_na = 0;
						$total_fail = 0;	
						$total_manual = 0;																							
                    	foreach ((Array) $data['area_4'] AS $key => $val) { 
                    		$pct_na = $val['na'] / ($val['total'] > 0 ? $val['total'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Rds/Detail?id=".$val['id']).'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		                  		                     		
                    		'<td class="green">'.number_format($val['normal']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['na']).'</td>';
                    		if($pct_na > 5){
                    			echo '<td class="red">';
                    		} else {
                    			echo '<td class="green">';
                    		}	 
                    		echo number_format($pct_na,2).'%</td>'.
                    		'<td class="orange">'.number_format($val['error']).'</td>'.
                    		'<td class="blue">'.number_format($val['argo']).'</td>'.
                    		'<td class="red">'.number_format($val['none']).'</td>'.
                    		'<td class="green">'.number_format($val['connected']).'</td>'.                    									   
                    		'<td class="orange">'.number_format($val['fail']).'</td>'.
							'<td class="red">'.number_format($val['manual']).'</td></tr>'; 
                    		$total_connected += $val['connected']; 
                    		$total_error += $val['error'];
                    		$total_argo += $val['argo'];
                    		$total_none += $val['none'];
                    		$total_total += $val['total'];                    		                    		                    		                    		  		
                    		$total_normal += $val['normal'];
                    		$total_na += $val['na'];
							$total_fail += $val['fail'];  
							$total_manual += $val['manual'];							                  		
                    	}
                    ?>
                    </tbody>
                    <tfoot>
                    <?php 
                    	$pct_na = $total_na / ($total_total > 0 ? $total_total : 1) * 100;
                    	echo '<tr><td>Total Area 4</td>'.                  		
						'<td>'.number_format($total_total).'</td>'.                    	
						'<td class="green">'.number_format($total_normal).'</td>'.                    		
						'<td class="red">'.number_format($total_na).'</td>';
						if($pct_na > 5){
							echo '<td class="red">';
						} else {
							echo '<td class="green">';
						}	 
						echo number_format($pct_na,2).'%</td>'.                    	                		
						'<td class="orange">'.number_format($total_error).'</td>'.
						'<td class="blue">'.number_format($total_argo).'</td>'.
						'<td class="red">'.number_format($total_none).'</td>'.
						'<td class="green">'.number_format($total_connected).'</td>'.
						'<td class="orange">'.number_format($total_fail).'</td>'.
						'<td class="red">'.number_format($total_manual).'</td></tr>';	
                    ?>
                    </tfoot>
                  </table>
                </div>
              </div>
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Pool Eagle</h2>              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>    
                    		<th>Total Login</th>                    		               		                    		
                    		<th>Normal</th> 
                    		<th>N/A</th>
                    		<th>Pct N/A</th>
                    		<th>Error</th>
                    		<th>Argo Not Connected</th>                    		                    		
                    		<th>None Connected</th>
                    		<th>All Connected</th>                    		
                    		<th>Fail Login</th>
                    		<th>Manual Login</th>                    		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php				
						$total_connected = 0; 
						$total_error = 0;
						$total_argo = 0;
						$total_none = 0;
						$total_total = 0;
						$total_normal = 0;
						$total_na = 0;
						$total_fail = 0;	
						$total_manual = 0;																							
                    	foreach ((Array) $data['area_eagle'] AS $key => $val) { 
                    		$pct_na = $val['na'] / ($val['total'] > 0 ? $val['total'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Rds/Detail?id=".$val['id']).'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		                  		                     		
                    		'<td class="green">'.number_format($val['normal']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['na']).'</td>';
                    		if($pct_na > 5){
                    			echo '<td class="red">';
                    		} else {
                    			echo '<td class="green">';
                    		}	 
                    		echo number_format($pct_na,2).'%</td>'.
                    		'<td class="orange">'.number_format($val['error']).'</td>'.
                    		'<td class="blue">'.number_format($val['argo']).'</td>'.
                    		'<td class="red">'.number_format($val['none']).'</td>'.
                    		'<td class="green">'.number_format($val['connected']).'</td>'.                    									   
                    		'<td class="orange">'.number_format($val['fail']).'</td>'.
							'<td class="red">'.number_format($val['manual']).'</td></tr>'; 
                    		$total_connected += $val['connected']; 
                    		$total_error += $val['error'];
                    		$total_argo += $val['argo'];
                    		$total_none += $val['none'];
                    		$total_total += $val['total'];                    		                    		                    		                    		  		
                    		$total_normal += $val['normal'];
                    		$total_na += $val['na'];
							$total_fail += $val['fail'];    
							$total_manual += $val['manual'];							                		
                    	}
                    ?>
                    </tbody>
                    <tfoot>
                    <?php 
                    	$pct_na = $total_na / ($total_total > 0 ? $total_total : 1) * 100;
                    	echo '<tr><td>Total Eagle</td>'.                  		
						'<td>'.number_format($total_total).'</td>'.                    	
						'<td class="green">'.number_format($total_normal).'</td>'.                    		
						'<td class="red">'.number_format($total_na).'</td>';
						if($pct_na > 5){
							echo '<td class="red">';
						} else {
							echo '<td class="green">';
						}	 
						echo number_format($pct_na,2).'%</td>'.                    	                		
						'<td class="orange">'.number_format($total_error).'</td>'.
						'<td class="blue">'.number_format($total_argo).'</td>'.
						'<td class="red">'.number_format($total_none).'</td>'.
						'<td class="green">'.number_format($total_connected).'</td>'.
						'<td class="orange">'.number_format($total_fail).'</td>'.
						'<td class="red">'.number_format($total_manual).'</td></tr>';	
                    ?>
                    </tfoot>
                  </table>
                </div>
              </div>  
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Pool Tiara</h2>              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>    
                    		<th>Total Login</th>                    		               		                    		
                    		<th>Normal</th> 
                    		<th>N/A</th>
                    		<th>Pct N/A</th>
                    		<th>Error</th>
                    		<th>Argo Not Connected</th>                    		                    		
                    		<th>None Connected</th>
                    		<th>All Connected</th>                    		
                    		<th>Fail Login</th>
                    		<th>Manual Login</th>                    		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php				
						$total_connected = 0; 
						$total_error = 0;
						$total_argo = 0;
						$total_none = 0;
						$total_total = 0;
						$total_normal = 0;
						$total_na = 0;
						$total_fail = 0;
						$total_manual = 0;
						//var_dump($data['area_tiara']);
                    	foreach ((Array) $data['area_tiara'] AS $key => $val) { 
                    		$pct_na = $val['na'] / ($val['total'] > 0 ? $val['total'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Rds/Detail?id=".$val['id']).'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		                  		                     		
                    		'<td class="green">'.number_format($val['normal']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['na']).'</td>';
                    		if($pct_na > 5){
                    			echo '<td class="red">';
                    		} else {
                    			echo '<td class="green">';
                    		}	 
                    		echo number_format($pct_na,2).'%</td>'.
                    		'<td class="orange">'.number_format($val['error']).'</td>'.
                    		'<td class="blue">'.number_format($val['argo']).'</td>'.
                    		'<td class="red">'.number_format($val['none']).'</td>'.
                    		'<td class="green">'.number_format($val['connected']).'</td>'.                    									   
                    		'<td class="orange">'.number_format($val['fail']).'</td>'.
							'<td class="red">'.number_format($val['manual']).'</td></tr>'; 
                    		$total_connected += $val['connected']; 
                    		$total_error += $val['error'];
                    		$total_argo += $val['argo'];
                    		$total_none += $val['none'];
                    		$total_total += $val['total'];                    		                    		                    		                    		  		
                    		$total_normal += $val['normal'];
                    		$total_na += $val['na'];
							$total_fail += $val['fail'];       
							$total_manual += $val['manual'];							             		
                    	}
                    ?>
                    </tbody>
                    <tfoot>
                    <?php 
                    	$pct_na = $total_na / ($total_total > 0 ? $total_total : 1) * 100;
                    	echo '<tr><td>Total Tiara</td>'.                  		
						'<td>'.number_format($total_total).'</td>'.                    	
						'<td class="green">'.number_format($total_normal).'</td>'.                    		
						'<td class="red">'.number_format($total_na).'</td>';
						if($pct_na > 5){
							echo '<td class="red">';
						} else {
							echo '<td class="green">';
						}	 
						echo number_format($pct_na,2).'%</td>'.                    	                		
						'<td class="orange">'.number_format($total_error).'</td>'.
						'<td class="blue">'.number_format($total_argo).'</td>'.
						'<td class="red">'.number_format($total_none).'</td>'.
						'<td class="green">'.number_format($total_connected).'</td>'.
						'<td class="orange">'.number_format($total_fail).'</td>'.
						'<td class="red">'.number_format($total_manual).'</td></tr>';	
                    ?>
                    </tfoot>
                  </table>
                </div>
              </div>  
              <div class="x_panel tile">
                <div class="x_title">
                  <h2>Eagle High</h2>              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>    
                    		<th>Total Login</th>                    		               		                    		
                    		<th>Normal</th> 
                    		<th>N/A</th>
                    		<th>Pct N/A</th>
                    		<th>Fail Login</th>
                    		<th>Manual Login</th>                    		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php				
						$total_connected = 0; 
						$total_error = 0;
						$total_argo = 0;
						$total_none = 0;
						$total_total = 0;
						$total_normal = 0;
						$total_na = 0;
						$total_fail = 0;
						$total_manual = 0;																								
                    	foreach ((Array) $data['area_eagle_high'] AS $key => $val) { 
                    		$pct_na = $val['na'] / ($val['total'] > 0 ? $val['total'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Rds/Detail?id=".$val['id']).'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		                  		                     		
                    		'<td class="green">'.number_format($val['normal']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['na']).'</td>';
                    		if($pct_na > 5){
                    			echo '<td class="red">';
                    		} else {
                    			echo '<td class="green">';
                    		}	 
                    		echo number_format($pct_na,2).'%</td>'.
                    		'<td class="orange">'.number_format($val['fail']).'</td>'.
							'<td class="red">'.number_format($val['manual']).'</td></tr>'; 
                    		$total_connected += $val['connected']; 
                    		$total_error += $val['error'];
                    		$total_argo += $val['argo'];
                    		$total_none += $val['none'];
                    		$total_total += $val['total'];                    		                    		                    		                    		  		
                    		$total_normal += $val['normal'];
                    		$total_na += $val['na'];
							$total_fail += $val['fail'];       
							$total_manual += $val['manual'];							             		
                    	}
                    ?>
                    </tbody>
                    <tfoot>
                    <?php 
                    	$pct_na = $total_na / ($total_total > 0 ? $total_total : 1) * 100;
                    	echo '<tr><td>Total Eagle High</td>'.                  		
						'<td>'.number_format($total_total).'</td>'.                    	
						'<td class="green">'.number_format($total_normal).'</td>'.                    		
						'<td class="red">'.number_format($total_na).'</td>';
						if($pct_na > 5){
							echo '<td class="red">';
						} else {
							echo '<td class="green">';
						}	 
						echo number_format($pct_na,2).'%</td>'.                    	                		
						'<td class="orange">'.number_format($total_fail).'</td>'.
						'<td class="red">'.number_format($total_manual).'</td></tr>';	
                    ?>
                    </tfoot>
                  </table>
                </div>
              </div>  
			  </div>
              </div>
          <div class="row <?php if(Count($data['area_checker']) == 0) echo 'hidden';?>">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Pools</h2>              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>    
                    		<th>Total Login</th>                    		               		                    		
                    		<th>Normal</th> 
                    		<th>N/A</th>
                    		<th>Pct N/A</th>
                    		<th>Error</th>
                    		<th>Argo Not Connected</th>                    		                    		
                    		<th>None Connected</th>
                    		<th>All Connected</th>                    		
                    		<th>Fail Login</th>
                    		<th>Manual Login</th>                    		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php				
						$total_connected = 0; 
						$total_error = 0;
						$total_argo = 0;
						$total_none = 0;
						$total_total = 0;
						$total_normal = 0;
						$total_na = 0;
						$total_fail = 0;	
						$total_manual = 0;											
                    	foreach ((Array) $data['area_checker'] AS $key => $val) { 
                    		$pct_na = $val['na'] / ($val['total'] > 0 ? $val['total'] : 1) * 100;
                    		echo '<tr><td><a href="'.site_url("/Rds/Detail?id=".$val['id']).'">'.$val['name'].'</td>'.
                    		'<td>'.number_format($val['total']).'</td>'.                    		                  		                     		
                    		'<td class="green">'.number_format($val['normal']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['na']).'</td>';
                    		if($pct_na > 10){
                    			echo '<td class="red">';
                    		} else {
                    			echo '<td class="green">';
                    		}	 
                    		echo number_format($pct_na,2).'%</td>'.
                    		'<td class="orange">'.number_format($val['error']).'</td>'.
                    		'<td class="blue">'.number_format($val['argo']).'</td>'.
                    		'<td class="red">'.number_format($val['none']).'</td>'.
                    		'<td class="green">'.number_format($val['connected']).'</td>'.                    									   
                    		'<td class="orange">'.number_format($val['fail']).'</td>'.
							'<td class="red">'.number_format($val['manual']).'</td></tr>';                      		
                    		$total_connected += $val['connected']; 
                    		$total_error += $val['error'];
                    		$total_argo += $val['argo'];
                    		$total_none += $val['none'];
                    		$total_total += $val['total'];                    		                    		                    		                    		  		
                    		$total_normal += $val['normal'];
                    		$total_na += $val['na'];
							$total_fail += $val['fail'];
							$total_manual += $val['manual'];							                    		
                    	}
                    ?>
                    </tbody>
                    <tfoot>
                    <?php 
                    	$pct_na = $total_na / ($total_total > 0 ? $total_total : 1) * 100;
                    	echo '<tr><td>Total</td>'.                  		
						'<td>'.number_format($total_total).'</td>'.                    	
						'<td class="green">'.number_format($total_normal).'</td>'.                    		
						'<td class="red">'.number_format($total_na).'</td>';
						if($pct_na > 10){
							echo '<td class="red">';
						} else {
							echo '<td class="green">';
						}	 
						echo number_format($pct_na,2).'%</td>'.                    	                		
						'<td class="orange">'.number_format($total_error).'</td>'.
						'<td class="blue">'.number_format($total_argo).'</td>'.
						'<td class="red">'.number_format($total_none).'</td>'.
						'<td class="green">'.number_format($total_connected).'</td>'.
						'<td class="orange">'.number_format($total_fail).'</td>'.
						'<td class="red">'.number_format($total_manual).'</td></tr>';							
                    ?>
                    </tfoot>
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