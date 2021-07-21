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
              <div class="count green"><?php echo number_format($data['cash_inflow']); ?></div>
              <span class="count_bottom"><i class="<?php echo ($data['rev_yest'] >= 0 ? 'green' : 'red');?>">
			  <?php 
              	if($data['rev_yest'] >= 0) echo '<i class="fa fa-sort-asc"></i>'; 
              	else echo '<i class="fa fa-sort-desc"></i>';
              	echo ($data['rev_yest'] >= 0 ? number_format($data['rev_yest'], 2) : -number_format($data['rev_yest'], 2));?>%</i> from yesterday</span>
            </div> 
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total SPJ Setor</span>
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
                    <h2>Last 30 Day Not Operation</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_not_op" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
          <!-- graph area -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day Cash Inflow</h2>
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
                    <h2>Last 30 Day % Argo Component</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_area2" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
          </div>
          <div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile fixed_height_440 overflow_hidden">
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
                              <p><i class="fa fa-square red"></i>Broken</p>
                            </td>
                            <td><?php echo number_format($data['body_repair']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>TL</p>
                            </td>
                            <td><?php echo number_format($data['tl']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square pink"></i>Surat - surat</p>
                            </td>
                            <td><?php echo number_format($data['surat']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square dark"></i>Argo / RDS</p>
                            </td>
                            <td><?php echo number_format($data['argo_rds']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Other</p>
                            </td>
                            <td><?php echo number_format($data['lain']);?></td>
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
              <div class="x_panel tile fixed_height_440 overflow_hidden">
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
                            <td class="green pull-right"><?php echo number_format($data['total_rev']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Komisi</p>
                            </td>
                            <td class="red pull-right"><?php echo number_format($data['total_komisi']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>BBM</p>
                            </td>
                            <td class="red pull-right"><?php echo number_format($data['total_bbm']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>Hutang</p>
                            </td>
                            <td class="red pull-right"><?php echo number_format($data['hutang_baru']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square pink"></i>Denda</p>
                            </td>
                            <td class="green pull-right"><?php echo number_format($data['total_denda']);?></td>
                          </tr>
                           <tr>
                            <td>
                              <p><i class="fa fa-square dark"></i>Byr Hutang</p>
                            </td>
                            <td class="green pull-right"><?php echo number_format($data['bayar_hutang']);?></td>
                          </tr>
                           <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Lain2</p>
                            </td>
                            <td class="green pull-right <?php echo ($data['total_lain'] < 0 ? 'red' : 'green');?>"><?php echo number_format(abs($data['total_lain']));?></td>
                          </tr>
                          <tr><td></br></td></tr>
                        </table>
                      </td>
                    </tr>
                     <tr>
						<td>
						  <p>Total Argo</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['total_gross']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Cash Inflow</p>
						</td>
						<td class="pull-right green"><p><?php echo number_format($data['cash_inflow']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Operating</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['total_spj']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Avg Cash Inflow / Op Fleet</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['cash_inflow'] / ($data['total_spj'] > 0 ? $data['total_spj'] : 1), 2);?></p></td>
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
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Units</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Performance Setoran Per Unit</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Performance BBM Per Unit</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Performance Order Per Unit</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in table-responsive" id="tab_content1" aria-labelledby="home-tab" style="white-space: nowrap;">
						  <table id="datatable1" class="table table-striped">
							<thead>
								<tr>
									<?php $is_passed_new_tiara_komisi = strtotime($date) >= strtotime(Admin::DATE_NEW_KOMISI_TIARA); ?>
									<th>No</th>
									<th>No Pintu</th>
									<th>Pengemudi</th>
									<th>No KIP</th>									
									<th>Rit Dice</th>										
									<?php if(!$data['is_tiara'] || !$is_passed_new_tiara_komisi) echo '<th>Argo Dice</th>'; ?>								
									<?php if(!$data['is_tiara'] || !$is_passed_new_tiara_komisi) echo '<th>Adjustment</th>'; ?>
									<?php if(!$data['is_tiara'] || !$is_passed_new_tiara_komisi) 
											echo '<th>Total Argo</th>'; 
										else
											echo '<th>Argo Kotor</th>';  
									?>
									<?php if($data['is_tiara'] && $is_passed_new_tiara_komisi) echo '<th>Total BBM</th>'; ?>
									<?php if($data['is_tiara'] && $is_passed_new_tiara_komisi) echo '<th>Argo Bersih</th>'; ?>									
									<th>Komisi Argo</th>
									<?php if($data['is_tiara']) {
									 	if($is_passed_new_tiara_komisi){
											echo '<th>Komisi Trip</th>';										
											echo '<th>Komisi Argo Bersih</th>';
										} else {					
											echo '<th>Insentif</th>';
										}
									} 
									?>
									<?php if(!$data['is_tiara']) echo '<th>Rupiah BBM</th>';?>
									<th>Lain2</th>									
									<th>Hutang</th>
									<th>Bayar Hutang</th>																		
									<th>Denda</th> 									
									<th>Setoran</th>								
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
								$i = 1;
								$total_argo_rds = 0;
								$total_argo_dice = 0;								
								$total_argo = 0;
								$total_komisi = 0;
								$total_bbm = 0;
								$total_lain2 = 0;
								$total_hutang = 0;	
								$total_bayar_hutang = 0;						
								$total_denda = 0;
								$total_setoran = 0;
								$total_ritase = 0;
								$total_ritase_rds = 0;
								$total_adjustment = 0;
								$nominal_insentif_kehadiran = 0;
								$nominal_komisi_trip = 0;
								$nominal_komisi_argo_bersih = 0;								
								foreach ((Array) $data['detail_unit'] AS $key => $val) { 
// 									$is_argo_rds_same_xone = $val['argo_from_rds'] == $val['argo_from_dice'];
// 									$is_rit_rds_same_xone = $val['rit_from_rds'] == $val['rit'];
									$reg_url = str_replace(' ', '%20',$val['nomor_pintu']);
									$is_under_arpof = ($val['total_setoran'] < $data['total_arpof']);
									if(!$data['is_tiara']){
										echo '<tr><td>'.$i.'</td><td>'.'<a id="click_'.$i.'" '.((/*!$is_rit_rds_same_xone || !$is_argo_rds_same_xone ||*/ $is_under_arpof) ? 'class="red"' : '').'>
										<script>
										$("#click_'.$i.'").on("click", function(){
											$modal.modal();
											load_page("'.site_url('/Detail/get_trip_spj?spj_code='.$val['nomor_spj'].'&reg_no='.$reg_url.'&tipe='.$val['jenis_ops']).'");
										});
										</script>'.$val['nomor_pintu'].'</a></td>';
									} else {
										echo '<tr><td>'.$i.'</td><td>'.'<a id="click_'.$i.'" '.((/*!$is_rit_rds_same_xone || !$is_argo_rds_same_xone ||*/ $is_under_arpof) ? 'class="red"' : '').'>
										<script>
										$("#click_'.$i.'").on("click", function(){
											$modal.modal();
											load_page("'.site_url('/Detail/get_trip_tiara?nomor_spj='.$val['nomor_spj'].'&reg_no='.$reg_url.'&tipe='.$val['jenis_ops']).'");
										});
										</script>'.$val['nomor_pintu'].'</a></td>';
									}
									echo 
// 									'<td class="'.($is_rit_rds_same_xone ? 'green' : 'red').'">'.number_format($val['rit_from_rds']).'</td>'.
									'<td class="">'.($val['nama']).'</td>'.
									'<td class="">'.($val['no_kip']).'</td>'.
									'<td class="">'.number_format($val['rit']).'</td>';
// 									'<td class="'.($is_argo_rds_same_xone ? 'green' : 'red').'">'.number_format($val['argo_from_rds']).'</td>'.
									if(!$data['is_tiara'] || !$is_passed_new_tiara_komisi){
										echo '<td class="">'.number_format($val['argo_from_dice']).'</td>'.
										'<td>'.number_format($val['adjustment']).'</td>';
									}
									echo '<td>'.number_format($val['argo_setelah_adj']).'</td>';
									if($data['is_tiara'] && $is_passed_new_tiara_komisi){
										echo '<td class="purple">'.number_format($val['total_bbm']).'</td>'.
										'<td>'.number_format($val['argo_setelah_adj'] - $val['total_bbm']).'</td>';
									}
									echo '<td class="orange">'.number_format($val['total_komisi']).'</td>';
									if($data['is_tiara'] && !$is_passed_new_tiara_komisi)
										echo '<td class="orange">'.number_format($val['nominal_insentif_kehadiran']).'</td>';									
									else if(!$data['is_tiara'])
										echo '<td class="purple">'.number_format($val['total_bbm']).'</td>';
									else {
										echo '<td class="orange">'.number_format($val['komisi_trip']).'</td>';
										echo '<td class="orange">'.number_format($val['komisi_argo_bersih']).'</td>';										
									}
									echo '<td class="'.($val['lain'] < 0 ? "green" : "red").'">'.number_format($val['lain']).'</td>'.
									'<td class="'.($val['hutang_baru'] > 0 ? 'red' : 'green').'">'.number_format($val['hutang_baru']).'</td>'.
									'<td class="green">'.number_format($val['bayar_hutang']).'</td>'.									
									'<td class="green">'.number_format($val['bayar_denda']).'</td>'.
									'<td class="'.($is_under_arpof ? 'red' : 'green').'">'.number_format($val['total_setoran'] - $val['bayar_hutang'] - $val['bayar_denda']).'</td></tr>';
									$i++;
									$total_adjustment += $val['adjustment'];
// 									$total_argo_rds += $val['argo_from_rds'];
									$total_argo_dice += $val['argo_from_dice'];
									$total_argo += $val['argo_setelah_adj'];
									$total_komisi += $val['total_komisi'];
									$total_bbm += $val['total_bbm'];
									$total_lain2 += $val['lain'];
									$total_hutang += $val['hutang_baru'];
									$total_bayar_hutang += $val['bayar_hutang'];									
									$total_denda += $val['bayar_denda'];
									$total_setoran += $val['total_setoran'] - $val['bayar_hutang'] - $val['bayar_denda'];
									$total_ritase += $val['rit'];
// 									$total_ritase_rds += $val['rit_from_rds'];	
									if($data['is_tiara']){
										$nominal_insentif_kehadiran += $val['nominal_insentif_kehadiran'];	
										$nominal_komisi_trip += $val['komisi_trip'];
										$nominal_komisi_argo_bersih += $val['komisi_argo_bersih'];																	
									}
								}
								echo '</tbody><tfoot>';
								echo '<tr><td colspan="4">TOTAL '.$data['name'].'</td>'.
// 									'<td>'.number_format($total_ritase_rds).'</td>'.
									'<td>'.number_format($total_ritase).'</td>';
// 									'<td>'.number_format($total_argo_rds).'</td>'.
									if(!$data['is_tiara'] || !$is_passed_new_tiara_komisi){
										echo '<td>'.number_format($total_argo_dice).'</td>'.
										'<td>'.number_format($total_adjustment).'</td>';
									}
									echo '<td>'.number_format($total_argo).'</td>';
									if($data['is_tiara'] && $is_passed_new_tiara_komisi){
										echo '<td class="purple">'.number_format($total_bbm).'</td>'.
										'<td>'.number_format($total_argo - $total_bbm).'</td>';
									}
									echo '<td class="orange">'.number_format($total_komisi).'</td>';
									if($data['is_tiara'] && !$is_passed_new_tiara_komisi)
										echo '<td class="orange">'.number_format($nominal_insentif_kehadiran).'</td>';
									else if(!$data['is_tiara'])
										echo '<td class="purple">'.number_format($total_bbm).'</td>';
									else {
										echo '<td class="orange">'.number_format($nominal_komisi_trip).'</td>';
										echo '<td class="orange">'.number_format($nominal_komisi_argo_bersih).'</td>';										
									}
									echo '<td class="'.($total_lain2 <= 0 ? "green" : "red").'">'.number_format($total_lain2).'</td>'.
									'<td class="'.($total_hutang > 0 ? 'red' : 'green').'">'.number_format($total_hutang).'</td>'.
									'<td class="green">'.number_format($total_bayar_hutang).'</td>'.									
									'<td class="green">'.number_format($total_denda).'</td>'.
									'<td class="green">'.number_format($total_setoran).'</td></tr>';
							?>
							</tfoot>
						  </table>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="home-tab">
						  <table id="datatable2" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>No Pintu</th>
									<th>BBM Rupiah</th>
									<th>KM Isi</th>
									<th>KM Kosong</th>									
									<th>Total KM</th>
									<th>Pct KM Isi</th>
									<th>Ltr BBM</th>
									<th>BBM Eff</th>									
								</tr>
							</thead>
							<tbody>
							<div id="ajax-modal-approval2" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
							<?php   
								echo '<script>
								var $modal2 = $("#ajax-modal-approval2"); 
								function load_page2(url){
									$modal2.load(url,function(){});
									$("#gif").css("visibility", "visible");
								}
								</script>';	
								$i = 1;
								$total_bbm = 0;
								$total_km_isi = 0;
								$total_km_kosong = 0;
								$total_km = 0;
								$total_ltr_bbm = 0;
								foreach ((Array) $data['detail_unit'] AS $key => $val) { 
									$reg_url = str_replace(' ', '%20',$val['nomor_pintu']);
									$km_isi = $val['rit'] + ($val['drop'] * 0.1);
									$km_kosong = $val['speedo'] - $km_isi;
									$pct_km_isi = $km_isi / ($val['speedo'] > 0 ? $val['speedo'] : 1) * 100;
									$eff = $val['speedo'] / ($val['liter'] > 0 ? $val['liter'] : 1);
									$is_km_isi_under = $pct_km_isi < 50;
									$is_eff_under = (!$data['is_tiara'] ? $eff < 10 : $eff < 7);
									$is_eff_above = (!$data['is_tiara'] ? $eff > 12 : $eff > 10);
									if(!$data['is_tiara']){
										echo '<tr><td>'.$i.'</td><td>'.(($is_km_isi_under || $is_eff_under || $is_eff_above) ? '<a id="click2_'.$i.'" class="red">
										<script>
										$("#click2_'.$i.'").on("click", function(){
											$modal2.modal();
											load_page2("'.site_url('/Detail/get_trip_spj?spj_code='.$val['nomor_spj'].'&reg_no='.$reg_url.'&tipe='.$val['jenis_ops']).'");
										});
										</script>':'').$val['nomor_pintu'].'</a></td>';
									} else {
										echo '<tr><td>'.$i.'</td><td>'.(($is_km_isi_under || $is_eff_under || $is_eff_above) ? '<a id="click2_'.$i.'" class="red">
										<script>
										$("#click2_'.$i.'").on("click", function(){
											$modal2.modal();
											load_page2("'.site_url('/Detail/get_trip_tiara?reg_no='.$reg_url.'&nomor_spj='.$val['nomor_spj'].'&tipe='.$val['jenis_ops']).'");
										});
										</script>':'').$val['nomor_pintu'].'</a></td>';
									}
									echo '<td class="purple">'.number_format($val['total_bbm']).'</td>'.
									'<td>'.number_format($km_isi).'</td>'.
									'<td>'.number_format($km_kosong).'</td>'.
									'<td>'.number_format($val['speedo']).'</td>'.
									'<td class="'.($is_km_isi_under ? 'red' : 'green').'">'.number_format($pct_km_isi, 2).'%</td>'.
									'<td>'.number_format($val['liter'], 2).'</td>'.
									'<td class="'.($is_eff_under ? 'red' : ($is_eff_above ? 'orange' : '')).'">1 : '.number_format($eff, 1).'</td></tr>';
									$i++;
									$total_bbm += $val['total_bbm'];
									$total_km_isi += $km_isi;
									$total_km_kosong += $km_kosong;
									$total_km += $val['speedo'];
									$total_ltr_bbm += $val['liter'];
								}
								$total_pct_km_isi = $total_km_isi / ($total_km > 0 ? $total_km : 1) * 100;
								$total_bbm_eff = $total_km / ($total_ltr_bbm > 0 ? $total_ltr_bbm : 1);
								echo '</tbody><tfoot>';
								echo '<tr><td colspan="2">TOTAL '.$data['name'].'</td>'.
									'<td class="purple">'.number_format($total_bbm).'</td>'.
									'<td>'.number_format($total_km_isi).'</td>'.
									'<td>'.number_format($total_km_kosong).'</td>'.
									'<td>'.number_format($total_km).'</td>'.
									'<td class="'.($total_pct_km_isi < 50 ? 'red' : 'green').'">'.number_format($total_pct_km_isi, 2).'%</td>'.
									'<td>'.number_format($total_ltr_bbm, 2).'</td>';
								if(!$data['is_tiara']){	
									echo '<td class="'.($total_bbm_eff < 10 ? 'red' : ($total_bbm_eff > 12 ? 'orange' : '')).'">1 : '.number_format($total_bbm_eff, 1).'</td></tr>';
								} else {
									echo '<td class="'.($total_bbm_eff < 8 ? 'red' : ($total_bbm_eff > 10 ? 'orange' : '')).'">1 : '.number_format($total_bbm_eff, 1).'</td></tr>';
								}								
							?>
							</tfoot>
						  </table>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <table id="datatable3" class="table table-striped" style="width:100%">
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
								$total_pct_accept = $total_accept / ($total_broadcast > 0 ? $total_broadcast : 1) * 100;
								$total_no_response = $total_broadcast - $total_accept;
								$total_pct_no_resp =  $total_no_response / ($total_broadcast > 0 ? $total_broadcast : 1) * 100;
								echo '</tbody><tfoot>';
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
                        <li role="presentation" class="active"><a href="#tab_content5" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Operations</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Revenues</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content5" aria-labelledby="home-tab">
                        	<table id="datatable4" class="table table-striped" style="width:100%">
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
										<th>Broken</th>
										<th>TL</th>
										<th>Surat</th>
										<th>Argo/RDS</th>
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
										'<td class="'.($val['avg_spj'] > $val['operasi'] ? 'red' : 'green').'">'.number_format($val['avg_spj']).'</td>'.
										'<td class="'.($val['avg_tp'] < $val['tp'] ? 'red' : 'green').'">'.number_format($val['avg_tp'], 2).'</td>'.
										'<td>'.number_format($val['ops_mtd']).'</td></tr>';
									}
								?>
								</tbody>
						    </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                        <table id="datatable5" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>Pool</th>
									<th>Argo</th>                    		
									<?php 
									if(!$data['is_tiara']) echo '<th>BBM</th>';
									else echo '<th>Insentif</th>';
									?>
									<th>Komisi</th>
									<th>Hutang</th>
									<th>Lain2</th>
									<th>Setoran</th>
									<th>Bayar Hutang</th>                    		
									<th>Denda</th>
									<th>Cash Inflow</th>
									<th>Total Op</th>                    		
									<th>ARPOF</th>
									<th>ARPOF MTD</th>
									<th>ARPOF YTD</th>
									<th>Rev MTD</th>									
									<?php if(!$data['is_tiara'])
									echo '<th>% BBM</th>';
									?>                    		
								</tr>
							</thead>
							<tbody>
							<?php
								foreach ((Array) $data['pool_revs'] AS $key => $val) { 
									echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
									'<td class="">'.number_format($val['total_gross']).'</td>';
									if(!$data['is_tiara'])                    		
										echo '<td class="purple">'.number_format($val['total_bbm']).'</td>';
									else
										echo '<td class="purple">'.number_format($val['total_insentif']).'</td>';									
									echo '<td class="red">'.number_format($val['total_komisi']).'</td>'.
									'<td class="red">'.number_format($val['hutang_baru']).'</td>'.
									'<td class="'.($val['total_lain'] > 0 ? "green" : "red").'">'.number_format(abs($val['total_lain'])).'</td>'.
									'<td class="green">'.number_format($val['total_rev']).'</td>'.
									'<td class="green">'.number_format($val['bayar_hutang']).'</td>'.
									'<td class="green">'.number_format($val['total_denda']).'</td>'.
									'<td class="green">'.number_format($val['cash_inflow']).'</td>'.
									'<td class="blue">'.number_format($val['total_spj']).'</td>'.
									'<td>'.number_format($val['cash_inflow'] / ($val['total_spj'] > 0 ? $val['total_spj'] : 1), 2).'</td>'.
									'<td>'.number_format($val['rev_mtd'] / $val['spj_mtd'], 2).'</td>'.
									'<td>'.number_format($val['rev_ytd']  / $val['spj_ytd'], 2).'</td>'.
									'<td>'.number_format($val['rev_mtd']).'</td>';
									if(!$data['is_tiara']){                    		
									echo '<td class="purple">'.number_format($val['total_bbm'] / ($val['total_gross'] > 0 ? $val['total_gross'] : 1) * 100, 2).'%</td>';
									}
									echo '</tr>';
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
			  element: 'graph_not_op',
			  data: [
			  	<?php 
			  	foreach((Array) $data['series']['operasi'] AS $key => $val){
			  		echo "{period: '".$val['tgl_spj']."', tp: ".('' + $val['tp']).", broken: ".('' + $val['broken']).", tl: ".('' + $val['tl']).", argo_rds: ".('' + $val['argo_rds']).", surat: ".('' + $val['surat']).", lain: ".('' + $val['lain'])."},";
			  	}
				?>
			  ],
			  pointSize: 0,			  
			  xkey: 'period',
			  ykeys: ['tp', 'broken', 'tl', 'surat', 'argo_rds', 'lain'],
			  lineColors: ['#9B59B6', '#E74C3C', '#FFA500', '#FF00FF', '#34495E', '#9CC2CB'],
			  labels: ['TP', 'Broken', 'TL', 'Surat2', 'Argo/RDS', 'Other'],
			  hideHover: 'auto',
			  resize: false
			});
			
			Morris.Line({
			  element: 'graph_area',
			  data: [
			  	<?php 
			  	foreach((Array) $data['series']['revenue'] AS $key => $val){
			  		echo "{period: '".$val['tgl_spj']."', rev: ".$val['rev'].", komisi: ".$val['komisi'].", bbm: ".$val['bbm']."},";
			  	}
				?>
			  ],
			  xkey: 'period',
			  ykeys: ['rev', 'komisi', 'bbm'],
			  lineColors: ['#1ABB9C', '#E74C3C', '#3498DB', '#3498DB'],
			  labels: ['Cash Inflow', 'Komisi', 'BBM'],
			  hideHover: 'auto',
			  resize: false
			});
			
			Morris.Area({
			  element: 'graph_area2',
			  data: [
			  	<?php 
			  	foreach((Array) $data['series']['revenue'] AS $key => $val){
			  		$total = $val['rev'] + $val['komisi'] + ($data['is_tiara'] ? $val['insentif'] : $val['bbm']);
			  		echo "{period: '".$val['tgl_spj']."', rev: ".number_format($val['rev'] / $total * 100, 2).", komisi: ".number_format($val['komisi'] / $total * 100, 2).", bbm: ".number_format(($data['is_tiara'] ? $val['insentif'] : $val['bbm']) / $total * 100, 2)."},";
			  	}
				?>
			  ],
			  xkey: 'period',
			  pointSize: 0,			  
			  ykeys: ['bbm', 'komisi', 'rev'],
			  lineColors: ['#9B59B6', '#E74C3C', '#1ABB9C', '#3498DB'],
			  labels: [<?php echo ($data['is_tiara'] ? "'Insentif'" : "'BBM'");?>, 'Komisi', 'Cash Inflow'],
			  hideHover: 'auto',
			  ymax: 100,
			  postUnits: '%',
			  resize: false
			});
			var eagle_reg = <?php echo number_format($data['reguler'] / $data['total'] * 100, 2);?>;
			var eagle_kal = <?php echo number_format($data['kalong'] / $data['total'] * 100, 2);?>;
			var eagle_tp = <?php echo number_format($data['tp'] / $data['total'] * 100, 2);?>;
			var eagle_brok = <?php echo number_format($data['body_repair'] / $data['total'] * 100, 2);?>;
			var eagle_tl = <?php echo number_format($data['tl'] / $data['total'] * 100, 2);?>;
			var eagle_argo_rds = <?php echo number_format($data['argo_rds'] / $data['total'] * 100, 2);?>;
			var eagle_surat = <?php echo number_format($data['surat'] / $data['total'] * 100, 2);?>;
			var eagle_lain = <?php echo number_format($data['lain'] / $data['total'] * 100, 2);?>;	
			new Chart(document.getElementById("canvas_operation"), {
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
			var eagle_rev = <?php echo round($data['total_rev'] / ($data['total_gross'] > 0 ? $data['total_gross'] : 1) * 100, 2);?>;
			var eagle_komisi = <?php echo round($data['total_komisi'] / ($data['total_gross'] > 0 ? $data['total_gross'] : 1) * 100, 2);?>;
			var eagle_bbm = <?php echo round((!$data['is_tiara'] ? $data['total_bbm'] : $data['total_insentif']) / ($data['total_gross'] > 0 ? $data['total_gross'] : 1) * 100, 2);?>;
			var eagle_hutang = <?php echo round($data['hutang_baru'] / ($data['total_gross'] > 0 ? $data['total_gross'] : 1) * 100, 2);?>;
			var eagle_denda = <?php echo round($data['total_denda'] / ($data['total_gross'] > 0 ? $data['total_gross'] : 1) * 100, 2);?>;
			var eagle_bayar = <?php echo round($data['bayar_hutang'] / ($data['total_gross'] > 0 ? $data['total_gross'] : 1) * 100, 2);?>;
			var eagle_lain = <?php echo round(abs($data['total_lain'] / ($data['total_gross'] > 0 ? $data['total_gross'] : 1) * 100), 2);?>;
			new Chart(document.getElementById("canvas_revenue"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Setoran",
				  "Komisi",
				  <?php if(!$data['is_tiara']) 
				  		echo '"BBM"'; 
				  	else 
				  		echo '"Insentif"'; ?>,
				  "Hutang",
				  "Denda",
				  "Byr Htg",
				  "Lain2"
				],
				datasets: [{
				  data: [eagle_rev, eagle_komisi, eagle_bbm, eagle_hutang, eagle_denda, eagle_bayar, eagle_lain],
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