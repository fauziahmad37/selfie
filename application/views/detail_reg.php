		<!-- jQuery -->
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
          	<div class="modal fade" id="modalKSNotInput" role="dialog">
				<div class="modal-dialog">
	
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header" style="background-color:orange;color:white;">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title text-center">Perhatian!</h4>
					</div>
					<div class="modal-body">
					  <p style="text-align:justify">Anda tidak dapat membuka dashboard pool <?php echo $data['name'];?> untuk tanggal lain setelah tanggal <?php echo date('d M Y', strtotime($date));?>
					  sebelum salah satu tim operasi pool <?php echo $data['name'];?> mengisi keterangan untuk semua armada yang KS di tab "Unit Kurang Setor" 
					  pada tanggal <?php echo date('d M Y', strtotime($date));?></p>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				  </div>
	  
				</div>
			</div>
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2><?php $datetime = new DateTime($date); echo $data['name'].' - '.$datetime->format('l, j F Y'); ?></h2>
				<h4>Last Update <?php echo $data['last_update'];?></h4>
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
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total SPJ</span>
              <div class="count"><?php echo number_format($data['operasi']); ?></div>
              <span class="count_bottom"><i class="<?php echo ($data['spj_yest'] >= 0 ? 'green' : 'red');?>">
              <?php 
              	if($data['spj_yest'] >= 0) echo '<i class="fa fa-sort-asc"></i>'; 
              	else echo '<i class="fa fa-sort-desc"></i>';
              	echo ($data['spj_yest'] >= 0 ? number_format($data['spj_yest'], 2) : -number_format($data['spj_yest'], 2));?>%</i> from yesterday</span>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-car"></i> Total Fleet</span>
              <div class="count"><?php echo number_format($data['total']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Utility Rate</span>
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
            <div class="row tile_count">
             <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Total Cash Inflow</span>
              <div class="count green"><?php echo number_format($data['total_rev']); ?></div>
              <span class="count_bottom"><i class="<?php echo ($data['rev_yest'] >= 0 ? 'green' : 'red');?>">
			  <?php 
              	if($data['rev_yest'] >= 0) echo '<i class="fa fa-sort-asc"></i>'; 
              	else echo '<i class="fa fa-sort-desc"></i>';
              	echo ($data['rev_yest'] >= 0 ? number_format($data['rev_yest'], 2) : -number_format($data['rev_yest'], 2));?>%</i> from yesterday</span>
            </div> 
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total SPJ Closed</span>
              <div class="count"><?php echo number_format($data['total_spj']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Avg Cash Inflow per Op Fleet</span>
              <div class="count"><?php echo number_format($data['total_arpof'], 2); ?></div>
            </div>     
          </div>
           <div class="row">
		  <!-- graph area -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day Operation</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_line" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
              <!-- graph area -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day TP & SOS</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_tpso" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
          <!-- graph area -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day Cash Inflow VS Total KS</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_area" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
             <!-- graph area -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day KS Murni VS KS TP</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_ks" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area --> 
          </div>
          <div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile fixed_height_460 overflow_hidden">
                <div class="x_title">
                  <h2>Operation</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_operation" height="140" width="140" style="margin: 0px 0px 0px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Reguler</p>
                            </td>
                            <td><?php echo number_format($data['reguler']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Kalong</p>
                            </td>
                            <td><?php echo number_format($data['kalong']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>TP</p>
                            </td>
                            <td><?php echo number_format($data['tp']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>SOS</p>
                            </td>
                            <td><?php echo number_format($data['so']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>TL</p>
                            </td>
                            <td><?php echo number_format($data['broken']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Other</p>
                            </td>
                            <td><?php echo number_format($data['other']);?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
						<td>
						  <p>Total Operation</p>
						</td>
						<td><?php echo number_format($data['operasi']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Non Operation</p>
						</td>
						<td><?php echo number_format($data['non_operasi']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Fleet</p>
						</td>
						<td><?php echo number_format($data['total']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Utility Rate</p>
						</td>
						<?php
						if($data['fleet_utility'] >= 60){
							echo '<td class="green">';
						} else if($data['fleet_utility'] >= 45){
							echo '<td class="orange">';
						} else {
							echo '<td class="red">';
						}
						echo number_format($data['fleet_utility'], 2).'%</td>';
						?>
					  </tr>
                  </table>
                </div>
              </div>
            </div>
			
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile fixed_height_460 overflow_hidden">
                <div class="x_title">
                  <h2>Revenue</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_revenue" height="140" width="140" style="margin: 0px 0px 0px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Setoran</p>
                            </td>
                            <td class="green"><?php echo number_format($data['setoran']);?></td>
                          </tr> 
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Setoran Telat</p>
                            </td>
                            <td class="green"><?php echo number_format($data['setoran_telat']);?></td>
                          </tr>                         
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>KS Murni</p>
                            </td>
                            <td class="red"><?php echo number_format(-$data['ks_operasi']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>KS TP</p>
                            </td>
                            <td class="red"><?php echo number_format(-$data['ks_non_operasi']);?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
						<td>
						  <p>Total Revenue</p>
						</td>
						<td><?php echo number_format($data['total_tagihan']);?></td>
					  </tr>					   
					  <tr>
						<td>
						  <p>Total KS</p>
						</td>
						<td class="red"><?php echo number_format(-$data['total_ks']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>KS Murni Rate</p>
						</td>
						<?php
						if($data['rate'] >= 25){
							echo '<td class="red">';
						} else if($data['rate'] >= 10){
							echo '<td class="orange">';
						} else {
							echo '<td class="green">';
						}
						echo number_format($data['rate'], 2).'%</td>';
						?>
					  </tr>
					  <tr>
						<td>
						  <p>KS Total Rate</p>
						</td>
						<?php
						if($data['ks_rate'] >= 25){
							echo '<td class="red">';
						} else if($data['ks_rate'] >= 10){
							echo '<td class="orange">';
						} else {
							echo '<td class="green">';
						}
						echo number_format($data['ks_rate'], 2).'%</td>';
						?>
					  </tr>
					  <tr>
						<td>
						  <p>Avg KS Murni Per Op Fleet</p>
						</td>
						<td class="red"><?php echo number_format(-$data['avg_ks'], 2);?></td>
					  </tr>
					  <tr>
						<td>
							 <p>Adjustment KS</p>
							</td>
							<td class="green"><?php echo number_format($data['angsuran_ks']);?></td>
						  </tr>
					<tr>
						<td>
							 <p>Bayar KS</p>
							</td>
							<td class="green"><?php echo number_format($data['bayar_ks']);?></td>
						  </tr>  
					  <tr>
						<td>
						  <p>Total Cash Inflow</p>
						</td>
						<td class="green"><?php echo number_format($data['total_rev']);?></td>
					  </tr>
                  </table>
                </div>
              </div>
            </div>
            <!-- graph area -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hari Kerja By Driver</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_driver" style="width:100%; height:300px;"></div>
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
                    <div id="graph_car" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
          </div>
          
          <div class="row <?php if(isset($area)) echo 'hidden';?>">
          <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
			  <div class="x_title">
				<h2>Inventory Sparepart</h2>
				<ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link inventory-collapse"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
				<div class="clearfix"></div>
			  </div>
			  <div class="x_content2" id="content_inventory">
				 <table class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>Sparepart Name</th>
							<th>Type</th>                    		
							<th>Qty</th>
							<th>Unit</th>                  		                    		
						</tr>
					</thead>
					<tbody>
					<?php                    	
						foreach ((Array) $data['inventory_area'] AS $key => $val) { 
							echo '<tr><td>'.$val['namepart'].'</td>'.
							'<td>'.($val['jenis']).'</td>'.
							'<td class="'.($val['qty'] < 10 ? "red" : ($val['qty'] < 50 ? "orange" : "green")).'">'.number_format($val['qty']).'</td>'.
							'<td>'.($val['satuan']).'</td></tr>'; 
						}
					?>
					</tbody>
				  </table>
			  </div>
			</div>
		  </div>
		  <div class="col-md-12 col-sm-12 col-xs-12 <?php if(strtotime($date) < strtotime(Admin::DATE_USE_COMMENT_KS)) echo 'hidden';?>">
			<div class="x_panel">
			  <div class="x_title">
				<h2>Performance Operasi Terhadap KS</h2>
				<ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link ks-collapse"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
				<div class="clearfix"></div>
			  </div>
			  <div id="ajax-modal-perf-ks" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
			  <div class="x_content2" id="content_performa_operasi_ks">
				 <table class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>Nama Operasi</th>
							<th>Total Armada yang KS</th>                    		
							<th>Total Kumulasi KS</th>
						</tr>
					</thead>
					<tbody>
					<?php     
						echo '<script>
							var $modal_perf_ks = $("#ajax-modal-perf-ks"); 
							function load_page_perf_ks(url){
								$modal_perf_ks.load(url,function(){});
								$("#gif").css("visibility", "visible");								
							}
							</script>';	               	
						$i = 1;
						foreach ((Array) $data['performa_operasi_ks'] AS $key => $val) { 
							echo '<tr><td class="blue"><a id="click_perf_ks_'.$i.'" class="blue">
									<script>
									$("#click_perf_ks_'.$i.'").on("click", function(){
										$modal_perf_ks.html("");									
										$modal_perf_ks.modal();
										load_page_perf_ks("'.site_url('/Detail/get_perf_ks?date='.$date.'&username='.$val['username'].'&pool='.$data['id']).'");
									});
									</script>'.$val['username'].'</a></td>'.
							'<td>'.number_format($val['ct']).'</td>'.
							'<td class="red">'.number_format(-$val['ks']).'</td></tr>'; 
							$i++;
						}
					?>
					</tbody>
				  </table>
			  </div>
			</div>
		  </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Units</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content_argo_unit" role="tab" id="argo_unit-tab" data-toggle="tab" aria-expanded="true">Ritase SPJ (Realtime)</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Unit Kurang Setor</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Performance Order Per Unit</a>
                        </li>                        
                        <?php
                        if(isset($data['is_uber_pool']) && $data['is_uber_pool'] === TRUE){
                        	echo '<li role="presentation" class=""><a href="#tab_content_uber_setoran" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Performance Uber Driver</a>
                        </li>';
                        }
                        ?>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content_argo_unit" aria-labelledby="home-tab">
                        	<table id="datatable_ritase" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>No Pintu</th>	
									<th>No SPJ</th>
									<th>Nama</th>									
									<th>Tipe Operasi</th>								
									<th>Ritase</th>
									<th>Argo</th>
								</tr>
							</thead>
							<tbody>
							<div id="ajax-modal-ritase" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
							<?php
								echo '<script>
								var $modal_ritase = $("#ajax-modal-ritase"); 
								function load_page_ritase(url){
									$modal_ritase.load(url,function(){});
									$("#gif").css("visibility", "visible");
								}
								</script>';												
								$i = 1;				
								foreach ((Array) $data['unit_argo'] AS $key => $val) { 
									$reg_url = str_replace(' ', '%20',$val['no_pintu']);									
									echo '<tr><td>'.$i.'</td><td><a id="click_r_'.$i.'" class="blue">
									<script>
									$("#click_r_'.$i.'").on("click", function(){
										$modal_ritase.html("");									
										$modal_ritase.modal();
										load_page_ritase("'.site_url('/Detail/get_trip_spj?date='.$date.'&reg_no='.$reg_url.'&tipe='.$val['tipe_ops'].'&spj_code='.$val['spj_code']).'");
									});
									</script>'.$val['no_pintu'].'</a></td>'.
									'<td>'.($val['spj_code']).'</td>'.	
									'<td>'.($val['nama']).'</td>'.																		
									'<td class="'.($val['status_bs'] == 1 ? 'green' : '').'">'.($val['tipe_ops']).' '.($val['status_bs'] == 1 ? '(BS)' : '').'</td>'.
									'<td class="'.($val['trip'] >= 7 ? "green" : "red").'">'.number_format($val['trip']).'</td>'.
									'<td class="'.($val['argo'] >= 400000 ? "green" : "red").'">'.number_format($val['argo']).'</td></tr>';																		
									$i++;
								}
								?>
							</tbody>
						  </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content1" aria-labelledby="home-tab">
                        	<table id="datatable1" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>No Pintu</th>
									<th>B/C</th>	
									<th>Nomor SPJ</th>																		
									<th>Rit From RDS</th>
									<th>Argo From RDS</th>																	
									<th>Setoran Wajib</th>
									<th>Cicilan Uang Muka</th>
									<th>Denda</th>
									<th>Jumlah Setor</th>									
									<th>KS</th>
									<th>Pembayaran Telat Setor</th>									
									<th>KS After Adjustment</th>
									<?php
									if(strtotime($date) >= strtotime(Admin::DATE_USE_COMMENT_KS)){
										echo '<th>#</th>';
									} else {
										echo '<th></th>';
									}
									?>
								</tr>
							</thead>
							<tbody>
							<div id="ajax-modal-approval" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
							<?php
								echo '<script>
								var $modal = $("#ajax-modal-approval"); 
								function load_page(url){
									$modal.load(url,function(){});
									$("#gif").css("visibility", "visible");									
								}
								</script>';
								$bayar_ks= 0;
								$setor = 0;
								$s_wajib = 0;
								$s_lain = 0;
								$denda = 0;
								$ks = 0;
								$i = 1;
								$argo_rds = 0;
								$rit_rds = 0;																
								foreach ((Array) $data['ks_unit'] AS $key => $val) { 
									$ks_adjustment = -$val['ks'] - $val['bayar_ks'];
									$reg_url = str_replace(' ', '%20',$val['reg_no']);
									echo '<tr><td>'.$i.'</td><td><a id="click_'.$i.'" class="'.($ks_adjustment > 0 ? "red" : "").'">
									<script>
									$("#click_'.$i.'").on("click", function(){
										$modal.html("");									
										$modal.modal();
										load_page("'.site_url('/Detail/get_trip_spj?date='.$date.'&reg_no='.$reg_url.'&tipe='.($val['tipe_ops'] == 1 ? "Kalong" : "Reguler").'&spj_code='.$val['spj_code']).'");
									});
									</script>'.$val['reg_no'].'</a></td>'.
									'<td>'.($val['jenis_mitra']).'</td>'.
									'<td>'.($val['spj_code']).'</td>'.									
									'<td>'.number_format($val['rit_from_rds']).'</td>'.									
									'<td>'.number_format($val['argo_from_rds']).'</td>'.									
									'<td class="blue">'.number_format($val['s_wajib']).'</td>'.
									'<td class="purple">'.number_format($val['s_lain']).'</td>'.
									'<td class="orange">'.number_format($val['denda']).'</td>'.
									'<td class="green">'.number_format($val['setor']).'</td>'.									
									'<td class="red">'.number_format(-$val['ks']).'</td>'.
									'<td class="'.($val['bayar_ks'] < 0 ? 'red' : 'green').'">'.number_format($val['bayar_ks']).'</td>'.
									'<td class="'.($ks_adjustment > 0 ? 'red' : 'green').'">'.number_format($ks_adjustment).'</td>';
									if(strtotime($date) >= strtotime(Admin::DATE_USE_COMMENT_KS) && $ks_adjustment > 0){
										if($val['username'] !== null){
											echo '<td><a id="click_comment_'.$i.'" data-toggle="modal" data-target="#modal-comment-'.$i.'"><i class="fa fa-comment fa-2x"></i></a>
											<div id="modal-comment-'.$i.'" class="modal fade" role="dialog">
											  <div class="modal-dialog">
												<div class="modal-content">
												  <div class="modal-header">
													<h4 class="modal-title text-center">'.$val['reg_no'].' ('.$val['spj_code'].')</h4>
												  </div>
												  <div class="modal-body">
												  	<div class="col-md-6">
														<p><strong>'.$val['username'].' ('.date('d M Y H:i:s', strtotime($val['create_dt'])).') : </strong></p>
														<p>'.nl2br($val['komentar']).'</p>
												  	</div>
												  	<div class="clearfix" />
												  	<div class="col-md-6">
														<table class="table" style="width:100%;">
															<tr><td>Ritase</td><td>:</td><td style="text-align:right;">'.number_format($val['rit_from_rds']).'</td></tr>
															<tr><td>Argo</td><td>:</td><td style="text-align:right;">'.number_format($val['argo_from_rds']).'</td></tr>
															<tr><td>Setor</td><td>:</td><td style="text-align:right;">'.number_format($val['setor']).'</td></tr>
															<tr><td>KS</td><td>:</td><td style="text-align:right;">'.number_format($ks_adjustment).'</td></tr>																																										
														</table>
												  	</div>													
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												  </div>
												</div>
											  </div>
											</div>
											</td>';
										} else {
											if($this->user['id_privilege'] === '6'){
											echo '<td><a id="click_no_comment_'.$i.'"><i class="fa fa-comment-o fa-2x"></i></a>
											<script>
											$("#click_no_comment_'.$i.'").on("click", function(){
												$modal.html("");
												$modal.modal();
												load_page("'.site_url('/Detail/new_comment?spj_code='.$val['spj_code'].'&id_pool='.$data['id'].'&date='.$date.'&rit='.$val['rit_from_rds'].'&argo='.$val['argo_from_rds']).'");
											});
											</script></a></td>';
											} else {
												echo '<td><i class="fa fa-exclamation-circle fa-2x"></i></td>';
											}
										}
									}
									else {
										echo '<td></td>';
									}
									echo '</tr>';
									$bayar_ks += $val['bayar_ks'];
									$setor += $val['setor'];
									$s_wajib += $val['s_wajib'];
									$s_lain += $val['s_lain'];
									$denda += $val['denda'];
									$ks += $val['ks'];
									$argo_rds += $val['argo_from_rds'];
									$rit_rds += $val['rit_from_rds'];
									$i++;
								}
								echo '</tbody><tfoot>';
								$total_ks_adjustment = -$ks - $bayar_ks;
								echo '<tr><td></td><td colspan="3">TOTAL '.$data['name'].'</td>'.
								'<td>'.number_format($rit_rds).'</td>'.
								'<td>'.number_format($argo_rds).'</td>'.
								'<td class="blue">'.number_format($s_wajib).'</td>'.
								'<td class="purple">'.number_format($s_lain).'</td>'.
								'<td class="orange">'.number_format($denda).'</td>'.
								'<td class="green">'.number_format($setor).'</td>'.								
								'<td class="red">'.number_format(-$ks).'</td>'.
								'<td class="green">'.number_format($bayar_ks).'</td>'.
								'<td class="'.($total_ks_adjustment > 0 ? 'red' : 'green').'">'.number_format($total_ks_adjustment).'</td>'.
								'<td></td></tr>';
								?>
							</tfoot>
						  </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <table id="datatable2" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No Pintu</th>
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
								foreach ((Array) $data['order_perf'] AS $key => $val) { 
									$no_response = $val['broadcast'] - $val['accept'];
									$pct_no_response = $no_response / ($val['broadcast'] > 0 ? $val['broadcast'] : 1) * 100;
									$val['pct_accept'] = $val['accept'] / ($val['broadcast'] > 0 ? $val['broadcast'] : 1) * 100;
									echo '<tr><td>'.$val['reg_no'].'</td>'.
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
								echo '</tbody><tfoot>';
								$total_pct_accept = $total_accept / ($total_broadcast > 0 ? $total_broadcast : 1) * 100;
								$total_no_response = $total_broadcast - $total_accept;
								$total_pct_no_resp =  $total_no_response / ($total_broadcast > 0 ? $total_broadcast : 1) * 100;
								echo '<tr><td>TOTAL '.$data['name'].'</td>'.
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
							</tfoot>
						  </table>
                        </div>
                        <?php if(isset($data['is_uber_pool']) && $data['is_uber_pool'] === TRUE){
                        	echo '<div role="tabpanel" class="tab-pane fade" id="tab_content_uber_setoran" aria-labelledby="profile-tab">
                          <table class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>KIP</th>
									<th>No Pintu</th>
									<th>Ritase</th>									
									<th>Argo</th>
									<th>Setor</th>
									<th>Setoran Wajib</th>
									<th>Cicilan Uang Muka</th> 
									<th>Denda</th>
									<th>KS</th>									
									<th>Pembayaran Telat Setor</th>
									<th>KS After Adjustment</th>																											 
								</tr>
							</thead>
							<tbody>';     	
								$i = 1;
								foreach ((Array) $data['uber_driver_setoran'] AS $key => $val) { 
									$ks_adjustments = -$val['ks'] + $val['bayar_ks'];
									echo '<tr><td>'.$i.'</td><td class="'.($ks_adjustments > 0 ? "red" : "").'">'.$val['name'].'</td>'.
									'<td>'.$val['kip'].'</td>'.
									'<td>'.$val['no_pintu'].'</td>'.
									'<td>'.number_format($val['rit_rds']).'</td>'.
									'<td>'.number_format($val['argo_rds']).'</td>'.
									'<td class="green">'.number_format($val['setor']).'</td>'.
									'<td class="blue">'.number_format($val['s_wajib']).'</td>'.
									'<td class="purple">'.number_format($val['s_lain']).'</td>'.
									'<td class="orange">'.number_format($val['denda']).'</td>'.
									'<td class="'.($val['ks'] < 0 ? "red" : "green").'">'.number_format(-$val['ks']).'</td>'.
									'<td class="green">'.number_format(-$val['bayar_ks']).'</td>'.
									'<td class="'.($ks_adjustments > 0 ? 'red' : 'green').'">'.number_format($ks_adjustments).'</td></tr>';
									$i++;
								}
							echo '</tbody>
						  </table>
                        </div>';
                        } ?>
                      </div>
                    </div>
                </div>
              </div>
              </div>              
		  </div>              
		  <div class="row <?php if(!isset($area)) echo 'hidden';?>">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Pools</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content3" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Operations</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Setoran</a>
                        </li>
						<li role="presentation" class=""><a href="#tab_content_ks" role="tab" id="ks-tab" data-toggle="tab" aria-expanded="false">KS</a>
                        </li>
						<li role="presentation" class=""><a href="#tab_content5" role="tab" id="inventory-tab" data-toggle="tab" aria-expanded="false">Inventories</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content3" aria-labelledby="home-tab">
                        	<table id="datatable3" class="table table-striped" style="width:100%">
								<thead>
									<tr>
										<th>Pool</th>
										<th>Utility Rate</th>
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
										<th>Ops MTD</th>										                    		
									</tr>
								</thead>
								<tbody>
								<?php      	
									foreach ((Array) $data['pool_ops'] AS $key => $val) { 
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
										'<td class="'.($val['avg_spj'] > $val['operasi'] ? 'red' : 'green').'">'.number_format($val['avg_spj']).'</td>'.
										'<td class="'.($val['avg_tp'] < $val['tp'] ? 'red' : 'green').'">'.number_format($val['avg_tp'], 2).'</td>'.
										'<td>'.number_format($val['ops_mtd']).'</td></tr>';
									}                  	
								?>
							</tbody>
						    </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                          <table id="datatable4" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>Pool</th>
									<th>SPJ Closed</th>                     		
									<th>SPJ Setor</th>
									<th>Setoran</th>  		
									<th>Avg Setoran SPJ Setor</th>  										                    		
									<th>SPJ Telat</th>
									<th>SPJ Telat Sudah Setor</th>                    		                    		
									<th>Setoran Telat</th>
									<th>Avg Setoran Telat</th>
									<th>Total Setoran</th>
									<th>Avg Total Setoran</th>
									<th>Rev MTD</th>									
								</tr>
							</thead>
							<tbody>
							<?php       	
								foreach ((Array) $data['pool_revs'] AS $key => $val) { 
									$total_setoran_detail = $val['setoran'] + $val['total_setoran_spj_telat'];
									$total_spj_sudah_setor_detail = $val['total_spj_setor'] + $val['total_spj_telat_sudah_setor'];
									echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
									'<td>'.number_format($val['total_spj']).'</td>'.
									'<td class="blue">'.number_format($val['total_spj_setor']).'</td>'.									
									'<td class="green">'.number_format($val['setoran']).'</td>'.
									'<td>'.number_format($val['setoran'] / ($val['total_spj_setor'] > 0 ? $val['total_spj_setor'] : 1), 2).'</td>'.									
									'<td class="red">'.number_format($val['total_spj_telat']).'</td>'.
									'<td class="orange">'.number_format($val['total_spj_telat_sudah_setor']).'</td>'.									
									'<td class="orange">'.number_format($val['total_setoran_spj_telat']).'</td>'.
									'<td>'.number_format($val['total_setoran_spj_telat'] / ($val['total_spj_telat_sudah_setor'] > 0 ? $val['total_spj_telat_sudah_setor'] : 1),2).'</td>'.
									'<td class="green">'.number_format($total_setoran_detail).'</td>'.
									'<td>'.number_format($total_setoran_detail / ($total_spj_sudah_setor_detail > 0 ? $total_spj_sudah_setor_detail : 1),2).'</td>'.
									'<td>'.number_format($val['rev_mtd']).'</td></tr>';     
								}
							?>
							</tbody>
						  </table>
                        </div>
                         <div role="tabpanel" class="tab-pane fade" id="tab_content_ks" aria-labelledby="ks-tab">
                          <table id="datatable5" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>Pool</th>
									<th>SPJ Closed</th>                     		
									<th>Total SPJ Sudah Setor</th>
									<th>Total Setoran</th>
									<th>KS Murni</th>
									<th>KS TP</th>
									<th>Revenue</th> 
									<th>Pct KS Murni</th> 									       
									<th>Bayar KS</th>     
									<th>KS Murni MTD</th>
									<th>KSTP MTD</th>
									<th>KS Murni YTD</th>
									<th>KSTP YTD</th>
								</tr>
							</thead>
							<tbody>
							<?php       	
								foreach ((Array) $data['pool_revs'] AS $key => $val) { 
									echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
									'<td>'.number_format($val['total_spj']).'</td>'.
									'<td class="blue">'.number_format($val['total_spj_sudah_setor']).'</td>'.
									'<td class="green">'.number_format($val['total_setoran_sudah_setor']).'</td>'.									
									'<td class="'.($val['ks_after_bayar_telat'] > 0 ? 'green' : 'red').'">'.number_format(-$val['ks_after_bayar_telat']).'</td>'.
									'<td class="orange">'.number_format(-$val['ks_non_operasi']).'</td>'.
									'<td>'.number_format($val['total_tagihan']).'</td>'.									
									'<td class="'.($val['pct_ks'] <= 0 ? 'green' : 'red').'">'.number_format($val['pct_ks'],2).'%</td>'.
									'<td class="green">'.number_format($val['bayar_hutang']).'</td>'.
									'<td class="red">'.number_format($val['ksmurni_mtd']).'</td>'.
									'<td class="orange">'.number_format($val['kstp_mtd']).'</td>'.
									'<td class="red">'.number_format($val['ksmurni_ytd']).'</td>'.
									'<td class="orange">'.number_format($val['kstp_ytd']).'</td></tr>'; 
								}
							?>
							</tbody>
						  </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="inventory-tab">
                        <div id="ajax-modal-inventory" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
						<?php
							echo '<script>
								var $modal_inventory = $("#ajax-modal-inventory"); 
								function load_page_inventory(url){
									$modal_inventory.load(url,function(){});
								}
								</script>';
						?>
                          <table id="datatable6" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>Sparepart Name</th>
									<th>Type</th>                    		
									<th>Qty</th>
									<th>Unit</th>
								</tr>
							</thead>
							<tbody>
							<?php       	
								foreach ((Array) $data['inventory_area'] AS $key => $val) { 
									echo '<tr><td><a id="click_'.$val['id_item'].'"><script>
											$("#click_'.$val['id_item'].'").on("click", function(){
												$modal_inventory.modal();
												load_page_inventory("'.site_url('/Inventory/pool?id='.$val['id_item'].'&date='.$date.'&area='.$val['area']).'");
											});
											</script>'.$val['namepart'].'</a></td>'.
									'<td>'.($val['jenis']).'</td>'.
									'<td class="'.($val['qty'] < 10 ? "red" : ($val['qty'] < 50 ? "orange" : "green")).'">'.number_format($val['qty']).'</td>'.
									'<td>'.($val['satuan']).'</td></tr>'; 
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
        </div>
        <!-- /page content -->
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
			$('#content_inventory').hide(); //hides the modal div to be displayed later
			$(document).on('click', '.inventory-collapse' , function(){ 
				$('#content_inventory').toggle();
			});
				
			$(document).on('click', '.ks-collapse' , function(){ 
				$('#content_performa_operasi_ks').toggle();
			});
		  	<?php 
		  		if(isset($data['is_show'])){
		  			echo "$('#modalKSNotInput').modal('show');";
		  		}
		  	?>
		  	$('#datatable1').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
			$('#datatable2').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
			$('#datatable3').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
			$('#datatable4').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
			$('#datatable5').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
			$('#datatable6').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
			$('#datatable_ritase').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
			var options = {
			  legend: false,
			  responsive: false
			};
			
			function post(path, params, method) {
				method = method || "post"; // Set method to post by default if not specified.

				// The rest of this code assumes you are not using a library.
				// It can be made less wordy if you use one.
				var form = document.createElement("form");
				form.setAttribute("method", method);
				form.setAttribute("action", path);

				for(var key in params) {
					if(params.hasOwnProperty(key)) {
						var hiddenField = document.createElement("input");
						hiddenField.setAttribute("type", "hidden");
						hiddenField.setAttribute("name", key);
						hiddenField.setAttribute("value", params[key]);

						form.appendChild(hiddenField);
					 }
				}

				document.body.appendChild(form);
				form.submit();
			}

			Morris.Line({
			  element: 'graph_line',
			  data: [
			  	<?php 
			  	$max = 0;
			  	$min = 10000;
			  	foreach((Array) $data['series']['operasi'] AS $key => $val){
			  		$max = max($max, $val['last_90'], $val['op'], /*$val['non_op'],*/ $val['last_30']);
			  		$min = min($min, $val['last_90'], $val['op'], /*$val['non_op'],*/ $val['last_30']);			  		
			  		echo "{period: '".$val['tgl_spj']."', op: ".$val['op']./*", non_op: ".$val['non_op'].*/
			  			", last_30: ".$val['last_30'].", last_90: ".$val['last_90']."},";
			  	}
			  	$max += 10;
			  	$min = ($min > 10 ? ($min - 10) : 0);			  	
				?>
			  ],
			  xkey: 'period',
			  ykeys: ['op', /*'non_op',*/ 'last_30', 'last_90'],
			  lineColors: ['#1ABB9C', /*'#E74C3C',*/ '#FFA500', '#000'],
			  labels: ['Operating', /*'Not Operating',*/ 'Avg (30)', 'Avg (90)'],
			  hideHover: 'auto',
			  pointSize: 1,
			  ymax: <?php echo $max;?>,
			  ymin: <?php echo $min;?>,			  
			  resize: false
			});
			
			Morris.Area({
			  element: 'graph_tpso',
			  data: [
			  	<?php 
			  	foreach((Array) $data['series']['operasi'] AS $key => $val){
			  		echo "{period: '".$val['tgl_spj']."', tp: ".$val['tp'].", sos: ".$val['sos']."},";
			  	}
				?>
			  ],
			  xkey: 'period',
			  ykeys: ['sos', 'tp'],
			  lineColors: ['#E74C3C', '#9B59B6', '#3498DB', '#FFA500'],
			  labels: ['SOS', 'TP'],
			  pointSize: 0,			  
			  hideHover: 'auto',
			  resize: false
			});
			
			Morris.Area({
			  element: 'graph_ks',
			  data: [
			  	<?php 
			  	foreach((Array) $data['series']['revenue'] AS $key => $val){
			  		echo "{period: '".$val['tgl_spj']."', ksmurni: ".$val['ksmurni'].", kstp: ".$val['kstp']."},";
			  	}
				?>
			  ],
			  xkey: 'period',
			  ykeys: ['ksmurni', 'kstp'],
			  lineColors: ['#E74C3C', '#FFA500', '#3498DB', '#FFA500'],
			  labels: ['KS Murni', 'KS TP'],
			  hideHover: 'auto',
			  pointSize: 0,			  
			  resize: false
			});
			
			Morris.Line({
			  element: 'graph_area',
			  data: [
			  	<?php 
			  	foreach((Array) $data['series']['revenue'] AS $key => $val){
			  		echo "{period: '".$val['tgl_spj']."', rev: ".$val['rev'].", ks: ".$val['ks']."},";
			  	}
				?>
			  ],
			  xkey: 'period',
			  ykeys: ['rev', 'ks'],
			  lineColors: ['#1ABB9C', '#E74C3C', '#3498DB', '#FFA500'],
			  labels: ['Cash Inflow', 'Total KS'],
			  hideHover: 'auto',
			  resize: false
			});
			
			$('.btnSubmit').on('click', function (e) {
				var date = new Date($('.inputdate').val());
				var mm = date.getMonth() + 1;
				var dd = date.getDate();
				var yy = date.getFullYear();
				var url = "<?php if(isset($area)) echo site_url('/Detail/area/'); else echo site_url('/Detail/index/');?>";
				var values = {
					date: yy+'-'+mm+'-'+dd,
					id: "<?php echo $data['id'];?>"
				}
				post(url, values);
				$('<div class="modal-backdrop" style="opacity:0.8"></div>').appendTo(document.body);
				$('#gif').css('visibility', 'visible');
			});
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				startDate: '<?php echo $datetime->format('d-m-y');?>'
			});
			var reg_reg = <?php echo $data['reguler'];?>;
			var reg_kal = <?php echo $data['kalong'];?>;
			var reg_tp = <?php echo $data['tp'];?>;
			var reg_brok = <?php echo $data['broken'];?>;
			var reg_so = <?php echo $data['so'];?>;
			var reg_lain = <?php echo $data['other'];?>;		
			new Chart(document.getElementById("canvas_operation"), {
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
			var reg_rev = <?php echo round($data['setoran'] / ($data['total_tagihan'] > 0 ? $data['total_tagihan'] : 1) * 100, 2);?>;
			var reg_rev_telat = <?php echo round($data['setoran_telat'] / ($data['total_tagihan'] > 0 ? $data['total_tagihan'] : 1) * 100, 2);?>;			
			var reg_ks_op = Math.abs(<?php echo round($data['ks_operasi'] / ($data['total_tagihan'] > 0 ? $data['total_tagihan'] : 1) * -100, 2);?>);
			var reg_ks_non_op = <?php echo round($data['ks_non_operasi'] / ($data['total_tagihan'] > 0 ? $data['total_tagihan'] : 1) * -100, 2);?>;			
			new Chart(document.getElementById("canvas_revenue"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Setoran",
				  "Setoran Telat",				  
				  "KS Murni",				  
				  "KS TP"			  
				],
				datasets: [{
				  data: [reg_rev, reg_rev_telat, reg_ks_op, reg_ks_non_op],
				  backgroundColor: [
					"#26B99A",
					"#9B59B6",					
					"#E74C3C",
					"#FFA500"
				  ],
				  hoverBackgroundColor: [
					"#36CAAB",
					"#B370CF",					
					"#E95E4F",
					"#FED500"				  
				  ]
				}]
			  },
			  options: options
			});
			Morris.Bar({
			  element: 'graph_driver',
			  data: [
			  	<?php 
			  	$last_day = date("t", strtotime($date));
			  	foreach((Array) $data['series_driver'] AS $key => $val){
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
			  element: 'graph_car',
			  data: [
			  	<?php 
			  	$last_day = date("t", strtotime($date));
			  	foreach((Array) $data['series_car'] AS $key => $val){
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
		  });
		</script>
		<!-- /Doughnut Chart -->