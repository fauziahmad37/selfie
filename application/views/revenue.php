		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Revenue - <?php $datetime = new DateTime($date); echo $datetime->format('l, j F Y'); ?></h2>
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
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Total Cash Inflow</span>
              <div class="count green"><?php echo number_format(round($data['total_rev']/1000)); ?><?php echo 'k'; ?></div>
              <span class="count_bottom"><i class="<?php echo ($data['rev_yest'] > 0 ? 'green' : 'red');?>">
              <?php 
              	if($data['rev_yest'] >= 0) echo '<i class="fa fa-sort-asc"></i>'; 
              	else echo '<i class="fa fa-sort-desc"></i>';
              	echo ($data['rev_yest'] >= 0 ? number_format($data['rev_yest'], 2) : -number_format($data['rev_yest'], 2));?>%</i> from yesterday</span>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-car"></i> Total SPJ Closed</span>
              <div class="count"><?php echo number_format($data['total_op']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Average Cash Inflow per Operating Fleet</span>
              <div class="count"><?php echo number_format($data['total_arof'], 2); ?></div>
            </div>
          </div>
          <?php if($this->cac_user_model->get_privilege() <= 2){ //BOARD OR ADMINISTRATOR
          echo '<div class="row tile_count">
            <div class="col-md-6 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Month to Date Cash Inflow</span>
              <div class="count green">IDR '.number_format($data['annual_revenue']['mtd_rev'][0]['rev']).'</div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Year to Date Cash Inflow</span>
              <div class="count green">IDR '.number_format($data['annual_revenue']['ytd_rev'][0]['rev']).'</div>
              <span class="rev_ytd" style="height: 160px;">
                      <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                  </span>
            </div>
          </div>';
          }
          ?>
		  <div class="row">
		  <!-- graph area -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day Cash Inflow VS Total KS</h2>
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
                    <h2>Last 30 Day Cash Inflow Per Fleet</h2>
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
              <div class="x_panel tile fixed_height_460 overflow_hidden">
                <div class="x_title">
                  <h2>Reguler</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_reguler" height="140" width="140" style="margin: 0px 0px 0px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Setoran</p>
                            </td>
                            <td class="pull-right green"><?php echo number_format($data['reguler_setoran']);?></td>
                          </tr>
						  <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Setoran Telat</p>
                            </td>
                            <td class="pull-right green"><?php echo number_format($data['reguler_setoran_telat']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>KS Murni</p>
                            </td>
                            <td class="pull-right red"><?php echo number_format($data['reguler_ks'] * -1);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>KS TP</p>
                            </td>
                            	<td class="pull-right red"><?php echo number_format($data['reguler_ks_non_operasi']  * -1);?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
					  <tr>
						<td>
						  <p>Total Revenue</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['reguler_total_tagihan']);?></p></td>
					  </tr>					 
					  <tr>
						<td>
						  <p>Total KS</p>
						</td>
						<td class="pull-right red"><p><?php echo number_format(($data['reguler_ks'] + $data['reguler_ks_non_operasi']) * -1);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>KS Rate</p>
						</td>
						<?php
							if($data['reguler_rate'] >= 40){
								echo '<td class="red pull-right">';
							} else if($data['reguler_rate'] >= 20){
								echo '<td class="orange pull-right">';
							} else {
								echo '<td class="green pull-right">';
							}
							echo '<p>'.$data['reguler_rate'].'%</p></td>';
						?>
					  </tr>
					   <tr>
						<td>
						  <p>Adjustment KS</p>
						</td>
						<td class="pull-right green"><?php echo number_format($data['reguler_angsuran_ks']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Bayar KS</p>
						</td>
						<td class="pull-right green"><?php echo number_format($data['reguler_bayar_ks']);?></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Cash Inflow</p>
						</td>
						<td class="pull-right green"><p><?php echo number_format($data['reguler_rev']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Operating</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['reguler_spj']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Avg Cash Inflow / Op Fleet</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['reguler_rev'] / ($data['reguler_spj'] > 0 ? $data['reguler_spj'] : 1), 2);?></p></td>
					  </tr>
                  </table>
                </div>
              </div>
            </div>
			
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_460 overflow_hidden">
                <div class="x_title">
                  <h2>Eagle</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_eagle" height="140" width="140" style="margin: 0px 0px 0px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Setoran</p>
                            </td>
                            <td class="green pull-right"><?php echo number_format($data['eagle_rev']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Komisi</p>
                            </td>
                            <td class="red pull-right"><?php echo number_format($data['eagle_komisi']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>BBM</p>
                            </td>
                            <td class="red pull-right"><?php echo number_format($data['eagle_bbm']);?></td>
                          </tr>
                           <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>Hutang</p>
                            </td>
                            <td class="red pull-right"><?php echo number_format($data['eagle_hutang_baru']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square pink"></i>Denda</p>
                            </td>
                            <td class="green pull-right"><?php echo number_format($data['eagle_denda']);?></td>
                          </tr>
                           <tr>
                            <td>
                              <p><i class="fa fa-square dark"></i>Byr Hutang</p>
                            </td>
                            <td class="green pull-right"><?php echo number_format($data['eagle_bayar_hutang']);?></td>
                          </tr>
                           <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Lain2</p>
                            </td>
                            <td class="green pull-right <?php echo ($data['eagle_lain'] < 0 ? 'red' : 'green');?>"><?php echo number_format(abs($data['eagle_lain']));?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                      <tr>
						<td>
						  <p>Total Argo</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['eagle_gross']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Cash Inflow</p>
						</td>
						<td class="pull-right green"><p><?php echo number_format($data['eagle_cash_inflow']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Operating</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['eagle_spj']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Avg Cash Inflow / Op Fleet</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['eagle_cash_inflow'] / ($data['eagle_spj'] > 0 ? $data['eagle_spj'] : 1), 2);?></p></td>
					  </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_460 overflow_hidden">
                <div class="x_title">
                  <h2>Tiara</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_tiara" height="140" width="140" style="margin: 0px 0px 0px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Setoran</p>
                            </td>
                            <td class="green pull-right"><?php echo number_format($data['tiara_rev']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Komisi</p>
                            </td>
                            <td class="red pull-right"><?php echo number_format($data['tiara_komisi']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Insentif</p>
                            </td>
                            <td class="red pull-right"><?php echo number_format($data['tiara_insentif']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>Hutang</p>
                            </td>
                            <td class="red pull-right"><?php echo number_format($data['tiara_hutang_baru']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square pink"></i>Denda</p>
                            </td>
                            <td class="green pull-right"><?php echo number_format($data['tiara_denda']);?></td>
                          </tr>
                           <tr>
                            <td>
                              <p><i class="fa fa-square dark"></i>Byr Hutang</p>
                            </td>
                            <td class="green pull-right"><?php echo number_format($data['tiara_bayar_hutang']);?></td>
                          </tr>
                           <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Lain2</p>
                            </td>
                            <td class="green pull-right <?php echo ($data['tiara_lain'] < 0 ? 'red' : 'green');?>"><?php echo number_format(abs($data['tiara_lain']));?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                      <tr>
						<td>
						  <p>Total Argo</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['tiara_gross']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Cash Inflow</p>
						</td>
						<td class="pull-right green"><p><?php echo number_format($data['tiara_cash_inflow']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Total Operating</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['tiara_spj']);?></p></td>
					  </tr>
					  <tr>
						<td>
						  <p>Avg Cash Inflow / Op Fleet</p>
						</td>
						<td class="pull-right"><p><?php echo number_format($data['tiara_rev'] / ($data['tiara_spj'] > 0 ? $data['tiara_spj'] : 1), 2);?></p></td>
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
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content_setoran1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Setoran</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content_ks1" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">KS</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content_setoran1" aria-labelledby="home-tab">
						  <table class="table table-striped" style="width:100%">
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
								</tr>
							</thead>
							<tbody>
							<?php
								$setoran = 0;
								$total_spj = 0;
								$total_spj_setor = 0; 								
								$total_spj_telat = 0;   	
								$total_spj_telat_sudah_setor = 0;
								$total_setoran_spj_telat = 0;			
								foreach ((Array) $data['pool_reguler'] AS $key => $val) { 
									$total_setoran_detail = $val['setoran'] + $val['total_setoran_spj_telat'];
									$total_spj_sudah_setor_detail = $val['total_spj_setor'] + $val['total_spj_telat_sudah_setor'];
									echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
									'<td>'.number_format($val['total_spj']).'</td>'.
									'<td class="blue">'.number_format($val['total_spj_setor']).'</td>'.									
									'<td class="green">'.number_format($val['setoran']).'</td>'.
									'<td>'.number_format($val['setoran'] / $val['total_spj_setor'], 2).'</td>'.									
									'<td class="red">'.number_format($val['total_spj_telat']).'</td>'.
									'<td class="orange">'.number_format($val['total_spj_telat_sudah_setor']).'</td>'.									
									'<td class="orange">'.number_format($val['total_setoran_spj_telat']).'</td>'.
									'<td>'.number_format($val['total_setoran_spj_telat'] / ($val['total_spj_telat_sudah_setor'] > 0 ? $val['total_spj_telat_sudah_setor'] : 1),2).'</td>'.
									'<td class="green">'.number_format($total_setoran_detail).'</td>'.
									'<td>'.number_format($total_setoran_detail / ($total_spj_sudah_setor_detail > 0 ? $total_spj_sudah_setor_detail : 1),2).'</td></tr>';     
									$setoran += $val['setoran'];
									$total_spj += $val['total_spj'];
									$total_spj_setor += $val['total_spj_setor'];
									$total_spj_telat += $val['total_spj_telat'];
									$total_spj_telat_sudah_setor += $val['total_spj_telat_sudah_setor'];									    
									$total_setoran_spj_telat += $val['total_setoran_spj_telat'];
								}
								$total_setoran = $setoran + $total_setoran_spj_telat;
								$total_spj_sudah_setor = $total_spj_setor + $total_spj_telat_sudah_setor;
								echo '<tr><td>TOTAL AREA 1</td>'.
								'<td>'.number_format($total_spj).'</td>'.				
								'<td class="blue">'.number_format($total_spj_setor).'</td>'.																	
								'<td class="green">'.number_format($setoran).'</td>'.	
								'<td>'.number_format($setoran / ($total_spj_setor > 0 ? $total_spj_setor : 1), 2).'</td>'.																
								'<td class="red">'.number_format($total_spj_telat).'</td>'.
								'<td class="orange">'.number_format($total_spj_telat_sudah_setor).'</td>'.														
								'<td class="orange">'.number_format($total_setoran_spj_telat).'</td>'.
								'<td>'.number_format($total_setoran_spj_telat / ($total_spj_telat_sudah_setor > 0 ? $total_spj_telat_sudah_setor : 1),2).'</td>'.
								'<td class="green">'.number_format($total_setoran).'</td>'.
								'<td>'.number_format($total_setoran / ($total_spj_sudah_setor > 0 ? $total_spj_sudah_setor : 1),2).'</td></tr>';
							?>
							</tbody>
						  </table>
						</div>
                        <div role="tabpanel" class="tab-pane fade in" id="tab_content_ks1" aria-labelledby="home-tab">
						  <table class="table table-striped" style="width:100%">
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
								$setoran = 0;
								$total_ks_operasi = 0;
								$total_spj = 0;
								$total_spj_sudah_setor = 0;                    	  
								$total_ks_non_operasi = 0;     
								$total_ksmurni_mtd = 0;            	
								$total_kstp_mtd = 0;
								$total_ksmurni_ytd = 0;
								$total_kstpytd = 0;
								$total_bayar_ks = 0;		
								$total_setoran_sudah_setor = 0;		
								$total_tagihan = 0;
								foreach ((Array) $data['pool_reguler'] AS $key => $val) { 
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
									$setoran += $val['setoran'];
									$total_ks_operasi += $val['ks_after_bayar_telat'];
									$total_spj += $val['total_spj'];
									$total_spj_sudah_setor += $val['total_spj_sudah_setor'];            		
									$total_ks_non_operasi += $val['ks_non_operasi'];
									$total_ksmurni_mtd += $val['ksmurni_mtd'];            	
									$total_kstp_mtd += $val['kstp_mtd'];
									$total_ksmurni_ytd += $val['ksmurni_ytd'];
									$total_kstpytd += $val['kstp_ytd'];
									$total_bayar_ks += $val['bayar_hutang'];
									$total_setoran_sudah_setor += $val['total_setoran_sudah_setor'];
									$total_tagihan += $val['total_tagihan'];
								}
								$total_ks = $total_ks_operasi + $total_ks_non_operasi;
								$total_pct_ks = -$total_ks_operasi / ($total_tagihan > 0 ? $total_tagihan : 1) * 100;
								echo '<tr><td>TOTAL AREA 1</td>'.
								'<td>'.number_format($total_spj).'</td>'.
								'<td class="blue">'.number_format($total_spj_sudah_setor).'</td>'.
								'<td class="green">'.number_format($total_setoran_sudah_setor).'</td>'.								
								'<td class="red">'.number_format(-$total_ks_operasi).'</td>'.
								'<td class="orange">'.number_format(-$total_ks_non_operasi).'</td>'.   
								'<td>'.number_format($total_tagihan).'</td>'.
								'<td class="red">'.number_format($total_pct_ks,2).'%</td>'.
								'<td class="green">'.number_format($total_bayar_ks).'</td>'.
								'<td class="red">'.number_format($total_ksmurni_mtd).'</td>'.
								'<td class="orange">'.number_format($total_kstp_mtd).'</td>'.																								
								'<td class="red">'.number_format($total_ksmurni_ytd).'</td>'.
								'<td class="orange">'.number_format($total_kstpytd).'</td></tr>';
							?>
							</tbody>
						  </table>
						</div>						
					</div>
                </div>
              </div>
            </div>
            <div class="x_panel tile">
                <div class="x_title">
                  <h2><?php echo '<a href="'.site_url("/Detail/area?id=2&date=".$date."").'">';?>Pool Reguler Area 2</a></h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content_setoran2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Setoran</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content_ks2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">KS</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content_setoran2" aria-labelledby="home-tab">
						  <table class="table table-striped" style="width:100%">
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
								</tr>
							</thead>
							<tbody>
							<?php
								$setoran = 0;
								$total_spj = 0;
								$total_spj_setor = 0; 								
								$total_spj_telat = 0;   	
								$total_spj_telat_sudah_setor = 0;
								$total_setoran_spj_telat = 0;			
								foreach ((Array) $data['pool_reguler2'] AS $key => $val) { 
									$total_setoran_detail = $val['setoran'] + $val['total_setoran_spj_telat'];
									$total_spj_sudah_setor_detail = $val['total_spj_setor'] + $val['total_spj_telat_sudah_setor'];
									echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
									'<td>'.number_format($val['total_spj']).'</td>'.
									'<td class="blue">'.number_format($val['total_spj_setor']).'</td>'.									
									'<td class="green">'.number_format($val['setoran']).'</td>'.
									'<td>'.number_format($val['setoran'] / $val['total_spj_setor'], 2).'</td>'.									
									'<td class="red">'.number_format($val['total_spj_telat']).'</td>'.
									'<td class="orange">'.number_format($val['total_spj_telat_sudah_setor']).'</td>'.									
									'<td class="orange">'.number_format($val['total_setoran_spj_telat']).'</td>'.
									'<td>'.number_format($val['total_setoran_spj_telat'] / ($val['total_spj_telat_sudah_setor'] > 0 ? $val['total_spj_telat_sudah_setor'] : 1),2).'</td>'.
									'<td class="green">'.number_format($total_setoran_detail).'</td>'.
									'<td>'.number_format($total_setoran_detail / ($total_spj_sudah_setor_detail > 0 ? $total_spj_sudah_setor_detail : 1),2).'</td></tr>';     
									$setoran += $val['setoran'];
									$total_spj += $val['total_spj'];
									$total_spj_setor += $val['total_spj_setor'];
									$total_spj_telat += $val['total_spj_telat'];
									$total_spj_telat_sudah_setor += $val['total_spj_telat_sudah_setor'];									    
									$total_setoran_spj_telat += $val['total_setoran_spj_telat'];
								}
								$total_setoran = $setoran + $total_setoran_spj_telat;
								$total_spj_sudah_setor = $total_spj_setor + $total_spj_telat_sudah_setor;
								echo '<tr><td>TOTAL AREA 2</td>'.
								'<td>'.number_format($total_spj).'</td>'.				
								'<td class="blue">'.number_format($total_spj_setor).'</td>'.																	
								'<td class="green">'.number_format($setoran).'</td>'.	
								'<td>'.number_format($setoran / ($total_spj_setor > 0 ? $total_spj_setor : 1), 2).'</td>'.																
								'<td class="red">'.number_format($total_spj_telat).'</td>'.
								'<td class="orange">'.number_format($total_spj_telat_sudah_setor).'</td>'.														
								'<td class="orange">'.number_format($total_setoran_spj_telat).'</td>'.
								'<td>'.number_format($total_setoran_spj_telat / ($total_spj_telat_sudah_setor > 0 ? $total_spj_telat_sudah_setor : 1),2).'</td>'.
								'<td class="green">'.number_format($total_setoran).'</td>'.
								'<td>'.number_format($total_setoran / ($total_spj_sudah_setor > 0 ? $total_spj_sudah_setor : 1),2).'</td></tr>';
							?>
							</tbody>
						  </table>
						</div>
                        <div role="tabpanel" class="tab-pane fade in" id="tab_content_ks2" aria-labelledby="home-tab">
						  <table class="table table-striped" style="width:100%">
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
								$setoran = 0;
								$total_ks_operasi = 0;
								$total_spj = 0;
								$total_spj_sudah_setor = 0;                    	  
								$total_ks_non_operasi = 0;     
								$total_ksmurni_mtd = 0;            	
								$total_kstp_mtd = 0;
								$total_ksmurni_ytd = 0;
								$total_kstpytd = 0;
								$total_bayar_ks = 0;		
								$total_setoran_sudah_setor = 0;		
								$total_tagihan = 0;
								foreach ((Array) $data['pool_reguler2'] AS $key => $val) { 
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
									$setoran += $val['setoran'];
									$total_ks_operasi += $val['ks_after_bayar_telat'];
									$total_spj += $val['total_spj'];
									$total_spj_sudah_setor += $val['total_spj_sudah_setor'];            		
									$total_ks_non_operasi += $val['ks_non_operasi'];
									$total_ksmurni_mtd += $val['ksmurni_mtd'];            	
									$total_kstp_mtd += $val['kstp_mtd'];
									$total_ksmurni_ytd += $val['ksmurni_ytd'];
									$total_kstpytd += $val['kstp_ytd'];
									$total_bayar_ks += $val['bayar_hutang'];
									$total_setoran_sudah_setor += $val['total_setoran_sudah_setor'];
									$total_tagihan += $val['total_tagihan'];
								}
								$total_ks = $total_ks_operasi + $total_ks_non_operasi;
								$total_pct_ks = -$total_ks_operasi / ($total_tagihan > 0 ? $total_tagihan : 1) * 100;
								echo '<tr><td>TOTAL AREA 2</td>'.
								'<td>'.number_format($total_spj).'</td>'.
								'<td class="blue">'.number_format($total_spj_sudah_setor).'</td>'.
								'<td class="green">'.number_format($total_setoran_sudah_setor).'</td>'.								
								'<td class="red">'.number_format(-$total_ks_operasi).'</td>'.
								'<td class="orange">'.number_format(-$total_ks_non_operasi).'</td>'.   
								'<td>'.number_format($total_tagihan).'</td>'.
								'<td class="red">'.number_format($total_pct_ks).'%</td>'.
								'<td class="green">'.number_format($total_bayar_ks).'</td>'.
								'<td class="red">'.number_format($total_ksmurni_mtd).'</td>'.
								'<td class="orange">'.number_format($total_kstp_mtd).'</td>'.																								
								'<td class="red">'.number_format($total_ksmurni_ytd).'</td>'.
								'<td class="orange">'.number_format($total_kstpytd).'</td></tr>';
							?>
							</tbody>
						  </table>
						</div>						
					</div>
                </div>
              </div>
              </div>
            <div class="x_panel tile">
                <div class="x_title">
                  <h2><?php echo '<a href="'.site_url("/Detail/area?id=6&date=".$date."").'">';?>Pool Reguler Area 3</a></h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content_setoran3" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Setoran</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content_ks3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">KS</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content_setoran3" aria-labelledby="home-tab">
						  <table class="table table-striped" style="width:100%">
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
								</tr>
							</thead>
							<tbody>
							<?php
								$setoran = 0;
								$total_spj = 0;
								$total_spj_setor = 0; 								
								$total_spj_telat = 0;   	
								$total_spj_telat_sudah_setor = 0;
								$total_setoran_spj_telat = 0;			
								foreach ((Array) $data['pool_reguler3'] AS $key => $val) { 
									$total_setoran_detail = $val['setoran'] + $val['total_setoran_spj_telat'];
									$total_spj_sudah_setor_detail = $val['total_spj_setor'] + $val['total_spj_telat_sudah_setor'];
									echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
									'<td>'.number_format($val['total_spj']).'</td>'.
									'<td class="blue">'.number_format($val['total_spj_setor']).'</td>'.									
									'<td class="green">'.number_format($val['setoran']).'</td>'.
									'<td>'.number_format($val['setoran'] / $val['total_spj_setor'], 2).'</td>'.									
									'<td class="red">'.number_format($val['total_spj_telat']).'</td>'.
									'<td class="orange">'.number_format($val['total_spj_telat_sudah_setor']).'</td>'.									
									'<td class="orange">'.number_format($val['total_setoran_spj_telat']).'</td>'.
									'<td>'.number_format($val['total_setoran_spj_telat'] / ($val['total_spj_telat_sudah_setor'] > 0 ? $val['total_spj_telat_sudah_setor'] : 1),2).'</td>'.
									'<td class="green">'.number_format($total_setoran_detail).'</td>'.
									'<td>'.number_format($total_setoran_detail / ($total_spj_sudah_setor_detail > 0 ? $total_spj_sudah_setor_detail : 1),2).'</td></tr>';     
									$setoran += $val['setoran'];
									$total_spj += $val['total_spj'];
									$total_spj_setor += $val['total_spj_setor'];
									$total_spj_telat += $val['total_spj_telat'];
									$total_spj_telat_sudah_setor += $val['total_spj_telat_sudah_setor'];									    
									$total_setoran_spj_telat += $val['total_setoran_spj_telat'];
								}
								$total_setoran = $setoran + $total_setoran_spj_telat;
								$total_spj_sudah_setor = $total_spj_setor + $total_spj_telat_sudah_setor;
								echo '<tr><td>TOTAL AREA 3</td>'.
								'<td>'.number_format($total_spj).'</td>'.				
								'<td class="blue">'.number_format($total_spj_setor).'</td>'.																	
								'<td class="green">'.number_format($setoran).'</td>'.	
								'<td>'.number_format($setoran / ($total_spj_setor > 0 ? $total_spj_setor : 1), 2).'</td>'.																
								'<td class="red">'.number_format($total_spj_telat).'</td>'.
								'<td class="orange">'.number_format($total_spj_telat_sudah_setor).'</td>'.														
								'<td class="orange">'.number_format($total_setoran_spj_telat).'</td>'.
								'<td>'.number_format($total_setoran_spj_telat / ($total_spj_telat_sudah_setor > 0 ? $total_spj_telat_sudah_setor : 1),2).'</td>'.
								'<td class="green">'.number_format($total_setoran).'</td>'.
								'<td>'.number_format($total_setoran / ($total_spj_sudah_setor > 0 ? $total_spj_sudah_setor : 1),2).'</td></tr>';
							?>
							</tbody>
						  </table>
						</div>
                        <div role="tabpanel" class="tab-pane fade in" id="tab_content_ks3" aria-labelledby="home-tab">
						  <table class="table table-striped" style="width:100%">
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
								$setoran = 0;
								$total_ks_operasi = 0;
								$total_spj = 0;
								$total_spj_sudah_setor = 0;                    	  
								$total_ks_non_operasi = 0;     
								$total_ksmurni_mtd = 0;            	
								$total_kstp_mtd = 0;
								$total_ksmurni_ytd = 0;
								$total_kstpytd = 0;
								$total_bayar_ks = 0;		
								$total_setoran_sudah_setor = 0;		
								$total_tagihan = 0;
								foreach ((Array) $data['pool_reguler3'] AS $key => $val) { 
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
									$setoran += $val['setoran'];
									$total_ks_operasi += $val['ks_after_bayar_telat'];
									$total_spj += $val['total_spj'];
									$total_spj_sudah_setor += $val['total_spj_sudah_setor'];            		
									$total_ks_non_operasi += $val['ks_non_operasi'];
									$total_ksmurni_mtd += $val['ksmurni_mtd'];            	
									$total_kstp_mtd += $val['kstp_mtd'];
									$total_ksmurni_ytd += $val['ksmurni_ytd'];
									$total_kstpytd += $val['kstp_ytd'];
									$total_bayar_ks += $val['bayar_hutang'];
									$total_setoran_sudah_setor += $val['total_setoran_sudah_setor'];
									$total_tagihan += $val['total_tagihan'];
								}
								$total_ks = $total_ks_operasi + $total_ks_non_operasi;
								$total_pct_ks = -$total_ks_operasi / ($total_tagihan > 0 ? $total_tagihan : 1) * 100;
								echo '<tr><td>TOTAL AREA 3</td>'.
								'<td>'.number_format($total_spj).'</td>'.
								'<td class="blue">'.number_format($total_spj_sudah_setor).'</td>'.
								'<td class="green">'.number_format($total_setoran_sudah_setor).'</td>'.								
								'<td class="red">'.number_format(-$total_ks_operasi).'</td>'.
								'<td class="orange">'.number_format(-$total_ks_non_operasi).'</td>'.   
								'<td>'.number_format($total_tagihan).'</td>'.
								'<td class="red">'.number_format($total_pct_ks).'%</td>'.
								'<td class="green">'.number_format($total_bayar_ks).'</td>'.
								'<td class="red">'.number_format($total_ksmurni_mtd).'</td>'.
								'<td class="orange">'.number_format($total_kstp_mtd).'</td>'.																								
								'<td class="red">'.number_format($total_ksmurni_ytd).'</td>'.
								'<td class="orange">'.number_format($total_kstpytd).'</td></tr>';
							?>
							</tbody>
						  </table>
						</div>						
					</div>
                </div>
              </div>
              </div>
              <div class="x_panel tile">
                <div class="x_title">
                  <h2><?php echo '<a href="'.site_url("/Detail/area?id=7&date=".$date."").'">';?>Pool Reguler Area 4</a></h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content_setoran4" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Setoran</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content_ks4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">KS</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content_setoran4" aria-labelledby="home-tab">
						  <table class="table table-striped" style="width:100%">
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
								</tr>
							</thead>
							<tbody>
							<?php
								$setoran = 0;
								$total_spj = 0;
								$total_spj_setor = 0; 								
								$total_spj_telat = 0;   	
								$total_spj_telat_sudah_setor = 0;
								$total_setoran_spj_telat = 0;			
								foreach ((Array) $data['pool_reguler4'] AS $key => $val) { 
									$total_setoran_detail = $val['setoran'] + $val['total_setoran_spj_telat'];
									$total_spj_sudah_setor_detail = $val['total_spj_setor'] + $val['total_spj_telat_sudah_setor'];
									echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
									'<td>'.number_format($val['total_spj']).'</td>'.
									'<td class="blue">'.number_format($val['total_spj_setor']).'</td>'.									
									'<td class="green">'.number_format($val['setoran']).'</td>'.
									'<td>'.number_format($val['setoran'] / $val['total_spj_setor'], 2).'</td>'.									
									'<td class="red">'.number_format($val['total_spj_telat']).'</td>'.
									'<td class="orange">'.number_format($val['total_spj_telat_sudah_setor']).'</td>'.									
									'<td class="orange">'.number_format($val['total_setoran_spj_telat']).'</td>'.
									'<td>'.number_format($val['total_setoran_spj_telat'] / ($val['total_spj_telat_sudah_setor'] > 0 ? $val['total_spj_telat_sudah_setor'] : 1),2).'</td>'.
									'<td class="green">'.number_format($total_setoran_detail).'</td>'.
									'<td>'.number_format($total_setoran_detail / ($total_spj_sudah_setor_detail > 0 ? $total_spj_sudah_setor_detail : 1),2).'</td></tr>';     
									$setoran += $val['setoran'];
									$total_spj += $val['total_spj'];
									$total_spj_setor += $val['total_spj_setor'];
									$total_spj_telat += $val['total_spj_telat'];
									$total_spj_telat_sudah_setor += $val['total_spj_telat_sudah_setor'];									    
									$total_setoran_spj_telat += $val['total_setoran_spj_telat'];
								}
								$total_setoran = $setoran + $total_setoran_spj_telat;
								$total_spj_sudah_setor = $total_spj_setor + $total_spj_telat_sudah_setor;
								echo '<tr><td>TOTAL AREA 4</td>'.
								'<td>'.number_format($total_spj).'</td>'.				
								'<td class="blue">'.number_format($total_spj_setor).'</td>'.																	
								'<td class="green">'.number_format($setoran).'</td>'.	
								'<td>'.number_format($setoran / ($total_spj_setor > 0 ? $total_spj_setor : 1), 2).'</td>'.																
								'<td class="red">'.number_format($total_spj_telat).'</td>'.
								'<td class="orange">'.number_format($total_spj_telat_sudah_setor).'</td>'.														
								'<td class="orange">'.number_format($total_setoran_spj_telat).'</td>'.
								'<td>'.number_format($total_setoran_spj_telat / ($total_spj_telat_sudah_setor > 0 ? $total_spj_telat_sudah_setor : 1),2).'</td>'.
								'<td class="green">'.number_format($total_setoran).'</td>'.
								'<td>'.number_format($total_setoran / ($total_spj_sudah_setor > 0 ? $total_spj_sudah_setor : 1),2).'</td></tr>';
							?>
							</tbody>
						  </table>
						</div>
                        <div role="tabpanel" class="tab-pane fade in" id="tab_content_ks4" aria-labelledby="home-tab">
						  <table class="table table-striped" style="width:100%">
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
								$setoran = 0;
								$total_ks_operasi = 0;
								$total_spj = 0;
								$total_spj_sudah_setor = 0;                    	  
								$total_ks_non_operasi = 0;     
								$total_ksmurni_mtd = 0;            	
								$total_kstp_mtd = 0;
								$total_ksmurni_ytd = 0;
								$total_kstpytd = 0;
								$total_bayar_ks = 0;		
								$total_setoran_sudah_setor = 0;		
								$total_tagihan = 0;
								foreach ((Array) $data['pool_reguler4'] AS $key => $val) { 
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
									$setoran += $val['setoran'];
									$total_ks_operasi += $val['ks_after_bayar_telat'];
									$total_spj += $val['total_spj'];
									$total_spj_sudah_setor += $val['total_spj_sudah_setor'];            		
									$total_ks_non_operasi += $val['ks_non_operasi'];
									$total_ksmurni_mtd += $val['ksmurni_mtd'];            	
									$total_kstp_mtd += $val['kstp_mtd'];
									$total_ksmurni_ytd += $val['ksmurni_ytd'];
									$total_kstpytd += $val['kstp_ytd'];
									$total_bayar_ks += $val['bayar_hutang'];
									$total_setoran_sudah_setor += $val['total_setoran_sudah_setor'];
									$total_tagihan += $val['total_tagihan'];
								}
								$total_ks = $total_ks_operasi + $total_ks_non_operasi;
								$total_pct_ks = -$total_ks_operasi / ($total_tagihan > 0 ? $total_tagihan : 1) * 100;
								echo '<tr><td>TOTAL AREA 4</td>'.
								'<td>'.number_format($total_spj).'</td>'.
								'<td class="blue">'.number_format($total_spj_sudah_setor).'</td>'.
								'<td class="green">'.number_format($total_setoran_sudah_setor).'</td>'.								
								'<td class="red">'.number_format(-$total_ks_operasi).'</td>'.
								'<td class="orange">'.number_format(-$total_ks_non_operasi).'</td>'.   
								'<td>'.number_format($total_tagihan).'</td>'.
								'<td class="red">'.number_format($total_pct_ks).'%</td>'.
								'<td class="green">'.number_format($total_bayar_ks).'</td>'.
								'<td class="red">'.number_format($total_ksmurni_mtd).'</td>'.
								'<td class="orange">'.number_format($total_kstp_mtd).'</td>'.																								
								'<td class="red">'.number_format($total_ksmurni_ytd).'</td>'.
								'<td class="orange">'.number_format($total_kstpytd).'</td></tr>';
							?>
							</tbody>
						  </table>
						</div>						
					</div>
                </div>
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
                    		<th>Argo</th>                    		
                    		<th>BBM</th>
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
                    		<th>% BBM</th>
                    		<th>% Komisi</th>
                    		<th>% Setoran</th>                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_revenue = 0;
                    	$total_spj = 0;
                    	$total_gross = 0;
                    	$total_bbm = 0;
                    	$total_komisi = 0;
                    	$total_hutang = 0;
                    	$total_bayar_hutang = 0;
                    	$total_denda = 0;
                    	$total_lain = 0;
                    	$total_cash_inflow = 0;
                    	$total_rev_mtd = 0;
                    	$total_spj_mtd = 0;
                    	$total_rev_ytd = 0;
                    	$total_spj_ytd = 0;
                    	foreach ((Array) $data['eagle'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td class="">'.number_format($val['total_gross']).'</td>'.                    		
                    		'<td class="purple">'.number_format($val['total_bbm']).'</td>'.
                    		'<td class="red">'.number_format($val['total_komisi']).'</td>'.
                    		'<td class="red">'.number_format($val['hutang_baru']).'</td>'.
							'<td class="'.($val['total_lain'] > 0 ? "green" : "red").'">'.number_format(abs($val['total_lain'])).'</td>'.
                    		'<td class="green">'.number_format($val['total_rev']).'</td>'.
                    		'<td class="green">'.number_format($val['bayar_hutang']).'</td>'.
                    		'<td class="green">'.number_format($val['total_denda']).'</td>'.
                    		'<td class="green">'.number_format($val['cash_inflow']).'</td>'.
                    		'<td class="blue">'.number_format($val['total_spj']).'</td>'.
                    		'<td>'.number_format($val['cash_inflow'] / $val['total_spj'], 2).'</td>'.
                    		'<td>'.number_format($val['rev_mtd'] / $val['spj_mtd'], 2).'</td>'.
                    		'<td>'.number_format($val['rev_ytd']  / $val['spj_ytd'], 2).'</td>'.                    		
                    		'<td class="purple">'.number_format($val['total_bbm'] / ($val['total_gross'] > 0 ? $val['total_gross'] : 1) * 100, 2).'%</td>'.
                    		'<td class="red">'.number_format($val['total_komisi'] / ($val['total_gross'] > 0 ? $val['total_gross'] : 1) * 100, 2).'%</td>'.
                    		'<td class="green">'.number_format($val['total_rev'] / ($val['total_gross'] > 0 ? $val['total_gross'] : 1) * 100, 2).'%</td></tr>';
                    		$total_revenue += $val['total_rev'];
                    		$total_spj += $val['total_spj'];
                    		$total_gross += $val['total_gross'];
                    		$total_bbm += $val['total_bbm'];
							$total_komisi += $val['total_komisi'];
							$total_hutang += $val['hutang_baru'];
							$total_bayar_hutang += $val['bayar_hutang'];
							$total_denda += $val['total_denda'];
							$total_lain += $val['total_lain'];
							$total_cash_inflow += $val['cash_inflow'];
							$total_rev_mtd += $val['rev_mtd'];
							$total_spj_mtd += $val['spj_mtd'];
							$total_rev_ytd += $val['rev_ytd'];
							$total_spj_ytd += $val['spj_ytd'];
                    	}
                    	echo '<tr><td>TOTAL</td>'.
                    	'<td class="">'.number_format($total_gross).'</td>'.
                    	'<td class="purple">'.number_format($total_bbm).'</td>'.
                    	'<td class="red">'.number_format($total_komisi).'</td>'.
                    	'<td class="red">'.number_format($total_hutang).'</td>'.
						'<td class="'.($total_lain > 0 ? "green" : "red").'">'.number_format(abs($total_lain)).'</td>'.
						'<td class="green">'.number_format($total_revenue).'</td>'.
						'<td class="green">'.number_format($total_bayar_hutang).'</td>'.
						'<td class="green">'.number_format($total_denda).'</td>'.
						'<td class="green">'.number_format($total_cash_inflow).'</td>'.
                    	'<td class="blue">'.number_format($total_spj).'</td>'.
                    	'<td>'.number_format($total_revenue / ($total_spj > 0 ? $total_spj : 1), 2).'</td>'.
                    	'<td>'.number_format($total_rev_mtd / ($total_spj_mtd > 0 ? $total_spj_mtd : 1), 2).'</td>'.
                    	'<td>'.number_format($total_rev_ytd / ($total_spj_ytd > 0 ? $total_spj_ytd : 1), 2).'</td>'.
						'<td class="purple">'.number_format($total_bbm / ($total_gross > 0 ? $total_gross : 1) * 100, 2).'%</td>'.
                    	'<td class="red">'.number_format($total_komisi / ($total_gross > 0 ? $total_gross : 1) * 100, 2).'%</td>'.
                    	'<td class="green">'.number_format($total_revenue / ($total_gross > 0 ? $total_gross : 1) * 100, 2).'%</td></tr>';                 	                   	
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
                    		<th>Argo</th>                    		
                    		<th>Komisi</th>
                    		<th>Insentif</th>                    		
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
                    		<th>% Insentif</th>
                    		<th>% Komisi</th>
                    		<th>% Setoran</th>                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
                    	$total_revenue = 0;
                    	$total_spj = 0;
                    	$total_gross = 0;
                    	$total_insentif = 0;
                    	$total_komisi = 0;
                    	$total_hutang = 0;
                    	$total_bayar_hutang = 0;
                    	$total_denda = 0;
                    	$total_lain = 0;
                    	$total_cash_inflow = 0;
                    	$total_rev_mtd = 0;
                    	$total_spj_mtd = 0;
                    	$total_rev_ytd = 0;
                    	$total_spj_ytd = 0;
                    	foreach ((Array) $data['tiara'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Detail/index?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td class="">'.number_format($val['total_gross']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['total_komisi']).'</td>'.
                    		'<td class="orange">'.number_format($val['total_insentif']).'</td>'.                    		
                    		'<td class="red">'.number_format($val['hutang_baru']).'</td>'.
                    		'<td class="'.($val['total_lain'] > 0 ? "green" : "red").'">'.number_format(abs($val['total_lain'])).'</td>'.
                    		'<td class="green">'.number_format($val['total_rev']).'</td>'.
                    		'<td class="green">'.number_format($val['bayar_hutang']).'</td>'.
                    		'<td class="green">'.number_format($val['total_denda']).'</td>'.
                    		'<td class="green">'.number_format($val['cash_inflow']).'</td>'.
                    		'<td class="blue">'.number_format($val['total_spj']).'</td>'.
                    		'<td>'.number_format($val['cash_inflow'] / $val['total_spj'], 2).'</td>'.
                    		'<td>'.number_format($val['rev_mtd'] / $val['spj_mtd'], 2).'</td>'.
                    		'<td>'.number_format($val['rev_ytd']  / $val['spj_ytd'], 2).'</td>'.                    		
                    		'<td class="orange">'.number_format($val['total_insentif'] / $val['total_gross'] * 100, 2).'%</td>'.
                    		'<td class="red">'.number_format($val['total_komisi'] / $val['total_gross'] * 100, 2).'%</td>'.
                    		'<td class="green">'.number_format($val['total_rev'] / $val['total_gross'] * 100, 2).'%</td></tr>';
                    		$total_revenue += $val['total_rev'];
                    		$total_spj += $val['total_spj'];
                    		$total_gross += $val['total_gross'];
                    		$total_insentif += $val['total_insentif'];
							$total_komisi += $val['total_komisi'];
							$total_hutang += $val['hutang_baru'];
							$total_bayar_hutang += $val['bayar_hutang'];
							$total_denda += $val['total_denda'];
							$total_lain += $val['total_lain'];
							$total_cash_inflow += $val['cash_inflow'];
							$total_rev_mtd += $val['rev_mtd'];
							$total_spj_mtd += $val['spj_mtd'];
							$total_rev_ytd += $val['rev_ytd'];
							$total_spj_ytd += $val['spj_ytd'];
                    	}
                    	echo '<tr><td>TOTAL</td>'.
                    	'<td class="">'.number_format($total_gross).'</td>'.
                    	'<td class="red">'.number_format($total_komisi).'</td>'.
                    	'<td class="orange">'.number_format($total_insentif).'</td>'.                    	
                    	'<td class="red">'.number_format($total_hutang).'</td>'.
						'<td class="'.($total_lain > 0 ? "green" : "red").'">'.number_format(abs($total_lain)).'</td>'.
						'<td class="green">'.number_format($total_revenue).'</td>'.
						'<td class="green">'.number_format($total_bayar_hutang).'</td>'.
						'<td class="green">'.number_format($total_denda).'</td>'.
						'<td class="green">'.number_format($total_cash_inflow).'</td>'.
                    	'<td class="blue">'.number_format($total_spj).'</td>'.
                    	'<td>'.number_format($total_revenue / ($total_spj > 0 ? $total_spj : 1), 2).'</td>'.
                    	'<td>'.number_format($total_rev_mtd / ($total_spj_mtd > 0 ? $total_spj_mtd : 1), 2).'</td>'.
                    	'<td>'.number_format($total_rev_ytd / ($total_spj_ytd > 0 ? $total_spj_ytd : 1), 2).'</td>'.
						'<td class="orange">'.number_format($total_insentif / ($total_gross > 0 ? $total_gross : 1) * 100, 2).'%</td>'.
                    	'<td class="red">'.number_format($total_komisi / ($total_gross > 0 ? $total_gross : 1) * 100, 2).'%</td>'.
                    	'<td class="green">'.number_format($total_revenue / ($total_gross > 0 ? $total_gross : 1) * 100, 2).'%</td></tr>';                 	                   	
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
		<!-- jQuery Sparklines -->
    	<script src="<?php echo base_url('/assets/js/jquery.sparkline.min.js');?>"></script>
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
				if(yy > 0 && mm > 0 && dd > 0){
					window.location = "<?php echo site_url('/Revenue/index/');?>"+yy+'-'+mm+'-'+dd;
					$('<div class="modal-backdrop" style="opacity:0.8"></div>').appendTo(document.body);
					$('#gif').css('visibility', 'visible');	
				}
				else 
					alert('Please input date');
			});
			$('.btnUpdate').on('click', function (e) {
				window.location = "<?php echo site_url('/Revenue/update_revenue_now?start='.$date);?>";
			});
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				startDate: '<?php echo $datetime->format('d-m-y');?>'
			});
			
			$(".rev_ytd").sparkline([
			<?php 
				foreach((Array)$data['annual_revenue']['series_ytd'] AS $key => $val){
					echo $val['rev'].',';
				}
			?>
			], {
			  type: 'bar',
			  height: '40',
			  barWidth: 15,
			  barSpacing: 2,
			  barColor: '#26B99A'
			});
			
			Morris.Area({
			  element: 'graph_area',
			  data: [
			  	<?php 
			  	foreach((Array) $data['series']['rev'] AS $key => $val){
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
			  	foreach((Array) $data['series']['revs'] AS $key => $val){
			  		echo "{period: '".date('D, d',strtotime($val['tgl_spj']))."', rev: ".$val['total_rev'].", ks: ".-$val['total_ks']."},";
			  	}
				?>
			  ],
			  parseTime: false,
			  xkey: 'period',
			  ykeys: ['ks', 'rev'],
			  lineColors: ['#E74C3C', '#1ABB9C', '#3498DB', '#3498DB'],
			  labels: ['KS', 'Cash Inflow'],
			  hideHover: 'auto',
			  resize: true
			});
			
			var reg_rev = <?php echo round($data['reguler_setoran'] / ($data['reguler_total_tagihan'] > 0 ? $data['reguler_total_tagihan'] : 1) * 100, 2);?>;
			var reg_rev_telat = <?php echo round($data['reguler_setoran_telat'] / ($data['reguler_total_tagihan'] > 0 ? $data['reguler_total_tagihan'] : 1) * 100, 2);?>;
			var reg_ks_op = <?php echo round($data['reguler_ks'] / ($data['reguler_total_tagihan'] > 0 ? $data['reguler_total_tagihan'] : 1) * -100, 2);?>;
			var reg_ks_non_op = <?php echo round($data['reguler_ks_non_operasi'] / ($data['reguler_total_tagihan'] > 0 ? $data['reguler_total_tagihan'] : 1) * -100, 2);?>;			
			new Chart(document.getElementById("canvas_reguler"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Setoran",			  
				  "Setoran telat",			  
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
			
			var eagle_rev = <?php echo round($data['eagle_rev'] / ($data['eagle_gross'] > 0 ? $data['eagle_gross'] : 1) * 100, 2);?>;
			var eagle_komisi = <?php echo round($data['eagle_komisi'] / ($data['eagle_gross'] > 0 ? $data['eagle_gross'] : 1) * 100, 2);?>;
			var eagle_bbm = <?php echo round($data['eagle_bbm'] / ($data['eagle_gross'] > 0 ? $data['eagle_gross'] : 1) * 100, 2);?>;
			var eagle_hutang = <?php echo round($data['eagle_hutang_baru'] / ($data['eagle_gross'] > 0 ? $data['eagle_gross'] : 1) * 100, 2);?>;
			var eagle_denda = <?php echo round($data['eagle_denda'] / ($data['eagle_gross'] > 0 ? $data['eagle_gross'] : 1) * 100, 2);?>;
			var eagle_bayar = <?php echo round($data['eagle_bayar_hutang'] / ($data['eagle_gross'] > 0 ? $data['eagle_gross'] : 1) * 100, 2);?>;
			var eagle_lain = <?php echo round(abs($data['eagle_lain'] / ($data['eagle_gross'] > 0 ? $data['eagle_gross'] : 1) * 100), 2);?>;
			new Chart(document.getElementById("canvas_eagle"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Setoran",
				  "Komisi",
				  "BBM",
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
			
			var tiara_rev = <?php echo round($data['tiara_rev'] / ($data['tiara_gross'] > 0 ? $data['tiara_gross'] : 1) * 100, 2);?>;
			var tiara_komisi = <?php echo round($data['tiara_komisi'] / ($data['tiara_gross'] > 0 ? $data['tiara_gross'] : 1) * 100, 2);?>;
			var tiara_insentif = <?php echo round($data['tiara_insentif'] / ($data['tiara_gross'] > 0 ? $data['tiara_gross'] : 1) * 100, 2);?>;
			var tiara_hutang = <?php echo round($data['tiara_hutang_baru'] / ($data['tiara_gross'] > 0 ? $data['tiara_gross'] : 1) * 100, 2);?>;
			var tiara_denda = <?php echo round($data['tiara_denda'] / ($data['tiara_gross'] > 0 ? $data['tiara_gross'] : 1) * 100, 2);?>;
			var tiara_bayar = <?php echo round($data['tiara_bayar_hutang'] / ($data['tiara_gross'] > 0 ? $data['tiara_gross'] : 1) * 100, 2);?>;
			var tiara_lain = <?php echo round(abs($data['tiara_lain'] / ($data['tiara_gross'] > 0 ? $data['tiara_gross'] : 1) * 100), 2);?>;
			new Chart(document.getElementById("canvas_tiara"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Setoran",
				  "Komisi",
				  "Insentif",
				  "Hutang",
				  "Denda",
				  "Byr Htg",
				  "Lain2"
				],
				datasets: [{
				  data: [tiara_rev, tiara_komisi, tiara_insentif, tiara_hutang, tiara_denda, tiara_bayar, tiara_lain],
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