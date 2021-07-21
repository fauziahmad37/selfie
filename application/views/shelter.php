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
          		<h2><?php if(!isset($detail) && !isset($tipe) && !isset($area) && !isset($pool)) echo 'Shelter'; else if(!isset($tipe) && !isset($area) && !isset($pool))echo $data['shelter'][0]['name'];
          		else if(isset($tipe) && !isset($pool)) echo $tipe; else if(!isset($pool))echo 'Area '.$area; else echo $pool ?>
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
              <span class="count_top"><i class="fa fa-taxi"></i> Total Unique Unit Make Trip From Shelter</span>
              <div class="count"><?php echo number_format($data['unique_unit']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-exchange"></i> Total Ritase From Shelter</span>
              <div class="count blue"><?php echo number_format($data['total_ritase']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Total Argo From Shelter</span>
              <div class="count green"><?php echo number_format($data['total_argo']); ?></div>
            </div> 
           </div>
           <div class="row tile_count"> 
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Avg Argo Per Ritase From Shelter</span>
			  <div class="count purple"><?php echo number_format($data['arpu_shelter'], 2); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Avg Ritase From Shelter Per Unit</span>
			  <div class="count blue"><?php echo number_format($data['total_arit'], 2); ?></div>
            </div>
			<div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Avg Argo From Shelter Per Unit</span>
			  <div class="count green"><?php echo number_format($data['total_aapu'], 2); ?></div>
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
                        <li role="presentation" class="active"><a href="#tab_content_detail" id="detail-tab" role="tab" data-toggle="tab" aria-expanded="true">All</a>
                        </li>
                        <li role="presentation" class="<?php if(isset($tipe) || isset($area)) echo 'hidden';?>"><a href="#tab_content_tipe" role="tab" id="area-tab" data-toggle="tab" aria-expanded="false">Tipe</a>
                        </li>
                        <li role="presentation" class="<?php if(isset($tipe) || isset($area)) echo 'hidden';?>"><a href="#tab_content_area" role="tab" id="area-tab" data-toggle="tab" aria-expanded="false">Area</a>
                        </li>
                        <li role="presentation" class="<?php if(isset($tipe) || isset($area)) echo 'hidden';?>"><a href="#tab_content_pool" role="tab" id="area-tab" data-toggle="tab" aria-expanded="false">Pools</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content_detail" aria-labelledby="home-tab">
                  <table id="datatable1" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Shelter</th>
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
                    		echo '<tr><td><a href="'.site_url("/Shelter/detail".(isset($pool) ? "Pool" : "")."?id=".$val['id']."&date=".$date.(isset($pool) ? "&idPool=".$area : "")).'">'.$val['name'].'</td>';
                    		echo '<td><a id="click_'.$val['id'].'"><script>
									$("#click_'.$val['id'].'").on("click", function(){
										$modal.modal();
										load_page("'.site_url('/Shelter/get_shelter?id='.$val['id']).'");
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
                        <div role="tabpanel" class="tab-pane fade in" id="tab_content_tipe" aria-labelledby="home-tab">
                        	<?php 
								echo '<table id="datatable3" class="table table-striped" style="width:100%">';
									echo '<thead>
										<tr>
											<th>Shelter</th>
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
									<tbody>';
										$total_ritase = 0;
										$total_argo = 0;	
										$total_ritase_mtd = 0;
										$total_argo_mtd = 0;	                    	
										$total_ritase_ytd = 0;
										$total_argo_ytd = 0;	                    	
										foreach((Array) $data['tipe'] AS $key => $val){
											echo '<tr><td><a href="'.site_url("/Shelter/tipe?id=".$val['tipe']."&date=".$date."").'">'.$val['tipe'].'</td>'.
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
										echo '</tbody><tfoot><tr><td>TOTAL</td>'.
										'<td>'.number_format($total_ritase).'</td>'.     
										'<td>'.number_format($total_argo).'</td>'.
										'<td>'.number_format($total_arpu, 2).'</td>'.
										'<td>'.number_format($total_ritase_mtd).'</td>'.						
										'<td>'.number_format($total_argo_mtd).'</td>'.
										'<td>'.number_format($total_arpu_mtd, 2).'</td>'.						
										'<td>'.number_format($total_ritase_ytd).'</td>'.						
										'<td>'.number_format($total_argo_ytd).'</td>'.						
										'<td>'.number_format($total_arpu_ytd, 2).'</td></tr>';
									echo '</tfoot>';
								  echo '</table>';
                        	?>
                  		</div>
                  		<div role="tabpanel" class="tab-pane fade in" id="tab_content_area" aria-labelledby="home-tab">
                        	<?php 
                        		echo '<div class="x_panel"><div class="x_title">
									<h2><a href="'.site_url("/Shelter/area_big?id=A&date=".$date."").'">Area A</a></h2>
									<div class="clearfix"></div>
								  </div><div class="x_content">';                        	
								echo '<table id="datatable4" class="table table-striped" style="width:100%">';
									echo '<thead>
										<tr>
											<th>Shelter</th>
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
									<tbody>';
										$total_ritase = 0;
										$total_argo = 0;	
										$total_ritase_mtd = 0;
										$total_argo_mtd = 0;	                    	
										$total_ritase_ytd = 0;
										$total_argo_ytd = 0;	                    	
										foreach((Array) $data['area_a'] AS $key => $val){
											echo '<tr><td><a href="'.site_url("/Shelter/area?id=".$val['area']."&date=".$date."").'">Area '.$val['area'].'</td>'.
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
										echo '</tbody><tfoot><tr><td>TOTAL</td>'.
										'<td>'.number_format($total_ritase).'</td>'.     
										'<td>'.number_format($total_argo).'</td>'.
										'<td>'.number_format($total_arpu, 2).'</td>'.
										'<td>'.number_format($total_ritase_mtd).'</td>'.						
										'<td>'.number_format($total_argo_mtd).'</td>'.
										'<td>'.number_format($total_arpu_mtd, 2).'</td>'.						
										'<td>'.number_format($total_ritase_ytd).'</td>'.						
										'<td>'.number_format($total_argo_ytd).'</td>'.						
										'<td>'.number_format($total_arpu_ytd, 2).'</td></tr>';
									echo '</tfoot>';
								  echo '</table>';
                        		echo '</div></div>';								  
                        	?>
                        	<?php 
                        		echo '<div class="x_panel"><div class="x_title">
									<h2><a href="'.site_url("/Shelter/area_big?id=B&date=".$date."").'">Area B</a></h2>
									<div class="clearfix"></div>
								  </div><div class="x_content">';
								echo '<table id="datatable4b" class="table table-striped" style="width:100%">';
									echo '<thead>
										<tr>
											<th>Shelter</th>
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
									<tbody>';
										$total_ritase = 0;
										$total_argo = 0;	
										$total_ritase_mtd = 0;
										$total_argo_mtd = 0;	                    	
										$total_ritase_ytd = 0;
										$total_argo_ytd = 0;	                    	
										foreach((Array) $data['area_b'] AS $key => $val){
											echo '<tr><td><a href="'.site_url("/Shelter/area?id=".$val['area']."&date=".$date."").'">Area '.$val['area'].'</td>'.
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
										echo '</tbody><tfoot><tr><td>TOTAL</td>'.
										'<td>'.number_format($total_ritase).'</td>'.     
										'<td>'.number_format($total_argo).'</td>'.
										'<td>'.number_format($total_arpu, 2).'</td>'.
										'<td>'.number_format($total_ritase_mtd).'</td>'.						
										'<td>'.number_format($total_argo_mtd).'</td>'.
										'<td>'.number_format($total_arpu_mtd, 2).'</td>'.						
										'<td>'.number_format($total_ritase_ytd).'</td>'.						
										'<td>'.number_format($total_argo_ytd).'</td>'.						
										'<td>'.number_format($total_arpu_ytd, 2).'</td></tr>';
									echo '</tfoot>';
								  echo '</table>';
                        		echo '</div></div>';								  
                        	?>
                  		</div>
                  		<div role="tabpanel" class="tab-pane fade in" id="tab_content_pool" aria-labelledby="home-tab">
                        	<?php 
								echo '<table id="datatable5" class="table table-striped" style="width:100%">';
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
											echo '<tr><td><a href="'.site_url("/Shelter/pool?id=".$val['id_pool']."&date=".$date."").'">'.$val['name'].'</td>'.
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
                    		echo '<tr><td>'.$i.'</td><td>'.$val['no_pintu'].'</td>'.
							'<td>'.number_format($val['argo']).'</td>'.                    		
							'<td>'.date('Y-m-d', $start).'</td>'.
							'<td>'.date('H:i:s', $start).'</td>'.
							'<td>'.date('H:i:s', $end).'</td>'.
							'<td>'.number_format(round(abs($end - $start) / 60, 2)).' minutes</td>';
							if($val['id_trip'] !== null) {
								$is_tiara = $val['flag_tiara'] == 1;
								echo '<td><a id="click_map'.$val['id_trip'].'" class="blue"><script>
									$("#click_map'.$val['id_trip'].'").on("click", function(){
										$modal_map.modal();
										load_page_map("'.site_url('/Shelter/get_map?id='.$val['id_trip'].'&is_tiara='.$is_tiara).'");
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
		 $('#datatable3').dataTable({bFilter: false, paging: false, bInfo: false, dom: 'Bfrtip', 
			buttons: [
				'csv', 'excel', 'pdf'
			]});
		  $('#datatable4').dataTable({bFilter: false, paging: false, bInfo: false, dom: 'Bfrtip', 
			buttons: [
				'csv', 'excel', 'pdf'
			]});
		  $('#datatable4b').dataTable({bFilter: false, paging: false, bInfo: false, dom: 'Bfrtip', 
			buttons: [
				'csv', 'excel', 'pdf'
			]});		
		  $('#datatable5').dataTable({bFilter: false, paging: false, bInfo: false, dom: 'Bfrtip', 
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
				window.location = "<?php echo site_url('/Shelter/'.(isset($tipe) ? 'tipe?id='.$tipe.'&' : (isset($area) && !isset($pool) && !isset($big)? 'area?id='.$area.'&' : (isset($area) && !isset($pool) && isset($big)? 'area_big?id='.$area.'&' : (isset($detail) && !isset($idPool) ? 'detail?id='.$detail.'&' : (isset($pool) ? 'pool?id='.$area.'&' : (isset($idPool) ? 'detailPool?id='.$detail.'&idPool='.$idPool.'&' : 'index?')))))));?>"+'start='+start+'&end='+end;
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
						text: 'Total Unit',
						style: {
							color: Highcharts.getOptions().colors[5]						
						}
					},
					opposite: true					
				}, { // Secondary yAxis
					title: {
						text: 'Total Ritase',
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
				if(!isset($data['series_rds'][0]['rit_apartment'])){
					echo "{
					name: 'Total Ritase',
					yAxis: 1,					
					data: ["; 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo $val['total_ritase'].",";
						}
					echo "],
					color: Highcharts.getOptions().colors[2],
					},";
				}	
				else {				
				echo "{name: 'Apartment', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){					
							echo $val['rit_apartment'].",";
						}
					echo "], color: Highcharts.getOptions().colors[0], }, { name: 'Mall', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_mall'])) continue;						
							echo $val['rit_mall'].",";
						}
					echo "], color: Highcharts.getOptions().colors[1], }, {name: 'Hotel', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_hotel'])) continue;						
							echo $val['rit_hotel'].",";
						}
					echo "], color: Highcharts.getOptions().colors[2], }, { name: 'Office', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_office'])) continue;						
							echo $val['rit_office'].",";
						}
					echo "], color: Highcharts.getOptions().colors[3], }, { name: 'Hospital', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_hospital'])) continue;						
							echo $val['rit_hospital'].",";
						}
					echo "], color: Highcharts.getOptions().colors[4], }, { name: 'Other', yAxis: 1, data: ["; 
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_other'])) continue;						
							echo $val['rit_other'].",";
						}
					echo "], color: Highcharts.getOptions().colors[5], },";
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
					color: Highcharts.getOptions().colors[5],					
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
				if(!isset($data['hourly_ritase'][0]['rit_apartment'])){
					echo "{
					name: 'Total Ritase',
					yAxis: 1,					
					data: ["; 
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							echo $val['total_ritase'].",";
						}
					echo "],
					color: Highcharts.getOptions().colors[0],
					},";
				}	
				else {				
				echo "{name: 'Apartment', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){					
							echo $val['rit_apartment'].",";
						}
					echo "], color: Highcharts.getOptions().colors[0], }, { name: 'Mall', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_mall'])) continue;						
							echo $val['rit_mall'].",";
						}
					echo "], color: Highcharts.getOptions().colors[1], }, {name: 'Hotel', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_hotel'])) continue;						
							echo $val['rit_hotel'].",";
						}
					echo "], color: Highcharts.getOptions().colors[2], }, { name: 'Office', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_office'])) continue;						
							echo $val['rit_office'].",";
						}
					echo "], color: Highcharts.getOptions().colors[3], }, { name: 'Hospital', yAxis: 1, data: [";
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_hospital'])) continue;						
							echo $val['rit_hospital'].",";
						}
					echo "], color: Highcharts.getOptions().colors[4], }, { name: 'Other', yAxis: 1, data: ["; 
						foreach((Array) $data['hourly_ritase']AS $key => $val){
							if(!isset($val['rit_other'])) continue;						
							echo $val['rit_other'].",";
						}
					echo "], color: Highcharts.getOptions().colors[5], },";
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
							color: '#3498DB'
						}
					},
					title: {
						text: 'Avg Argo Per Unit',
						style: {
							color: '#3498DB'
						}
					},
					opposite: true					
				}, { // Secondary yAxis
					title: {
						text: 'Total Ritase',
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
				if(!isset($data['series_rds'][0]['rit_area1'])){
					echo "{
					name: 'Total Ritase',
					yAxis: 1,					
					data: ["; 
						foreach((Array) $data['series_rds']AS $key => $val){
							echo $val['total_ritase'].",";
						}
					echo "],
					color: Highcharts.getOptions().colors[2],
					},";
				}	
				else {				
				echo "{name: 'Area 1', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){					
							echo $val['rit_area1'].",";
						}
					echo "], color: Highcharts.getOptions().colors[0], }, { name: 'Area 2', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_area2'])) continue;						
							echo $val['rit_area2'].",";
						}
					echo "], color: Highcharts.getOptions().colors[1], }, {name: 'Area 3', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_area4'])) continue;						
							echo $val['rit_area3'].",";
						}
					echo "], color: Highcharts.getOptions().colors[2], }, { name: 'Area 4', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_area4'])) continue;						
							echo $val['rit_area4'].",";
						}
					echo "], color: Highcharts.getOptions().colors[3], }, { name: 'Area 5', yAxis: 1, data: [";
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_area5'])) continue;						
							echo $val['rit_area5'].",";
						}
					echo "], color: Highcharts.getOptions().colors[4], }, { name: 'Area 6', yAxis: 1, data: ["; 
						foreach((Array) $data['series_rds']AS $key => $val){
							if(!isset($val['rit_area6'])) continue;						
							echo $val['rit_area6'].",";
						}
					echo "], color: Highcharts.getOptions().colors[5], },";
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
					color: '#3498DB',					
				}]
			});
		});
		</script>
		<!-- /Doughnut Chart -->