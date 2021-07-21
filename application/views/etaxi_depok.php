		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div class="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>REPORT HARIAN ETAXI VS SIMTAX</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
		  			<div class role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
							<li role="presentation" class="active"><a href="#tab_content6" id="spj-hari-ini-tab" role="tab" data-toggle="tab" aria-expanded="true">SPJ Hari Ini</a></li>						
							<li role="presentation"><a href="#tab_content2" id="setoran-hari-ini-tab" role="tab" data-toggle="tab" aria-expanded="true">Setoran Hari Ini</a></li>
						</ul>
					</div>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in" id="tab_content2" aria-labelledby="setoran-hari-ini-tab">
							<table id="table6" class="table table-bordered" style="width:100%">
								<thead>
									<tr>
										<td>ETAXI</td>
										<td>SIMTAX</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo 'Rp. '.number_format($dataSetoranTodayEtaxi) ?></td>
										<td><?php echo 'Rp. '.number_format($dataSetoranTodaySimtax) ?></td>
									</tr>
								</tbody>
							</table>
							<table style="width:100%">
								<tr>
									<td valign="top">
										<table class="table table-bordered" style="width:100%">
											<thead>
												<th width="10%">No</th>
												<th align='center' width="40%">SPJ ETAXI</th>
												<th align='center' width="40%">Amount</th>
											</thead>
											<tbody>
												<?php $d=1 ?>
												<?php foreach ((Array) $data_detail_spj_etaxi as $key4 => $val4){ ?>
												<tr>
													<td><?php echo $d; ?></td>
													<td><?php echo ($val4['door_number']); ?></td>
													<td><?php echo 'Rp. '.number_format($val4['payment']); ?></td> 
												</tr>
												<?php 
													$d++;
													} 
												?>
											</tbody>
										</table>
									</td>
									<td valign="top">
										<table class="table table-bordered" style="width:100%">
											<thead>
												<th width="10%">No</th>
												<th align='center' width="40%">SPJ SIMTAX</th>
												<th align='center' width="40%">Amount</th>
											</thead>
											<tbody>
												<?php $c=1 ?>
												<?php foreach ((Array) $data_detail_spj_simtax as $key3 => $val3){ ?>
												<tr>
													<td><?php echo $c; ?></td>
													<td><?php echo ($val3['no_pintu']); ?></td>
													<td><?php echo 'Rp. '.number_format($val3['total_terima']); ?></td>
												</tr>
												<?php 
													$c++;
													} 
												?>
											</tbody>
										</table>
									</td>
								</tr>
							</table>
							
						</div>
					
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content6" aria-labelledby="spj-hari-ini-tab">
							<table id="table6" class="table table-bordered" style="width:100%">
								<thead>
									<tr>
										<td>ETAXI</td>
										<td>SIMTAX</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $dataSpjTodayEtaxi ?></td>
										<td><?php echo $dataSpjTodaySimtax ?></td>
									</tr>
								</tbody>
							</table>
							
							<table style="width:100%">
								<tr>
									<td valign="top">
										<table id="table6" class="table table-bordered" style="width:100%">
											<thead>
												<tr>
													<td>ETAXI<td>
												</tr>
												<tr>
													<td>No</td>
													<td>No Pintu</td>
												</tr>
											</thead>
											<tbody>
											
											<?php
											$a=1;
											foreach((Array) $data_spj_etaxi as $key => $val){ ?>
												<tr>
													<td><?php echo $a; ?></td>
													<td><?php echo $val['door_number'] ?></td>
												</tr>
											<?php
											$a++;
											}
											?>
											</tbody>
										</table>
									</td>
									<td valign="top">
										<table id="table6" class="table table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>SIMTAX<th>
												</tr>
												<tr>
													<th>No</th>
													<th>No Pintu</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											$b=1;
											foreach((Array) $data_spj_simtax as $key => $val){
											?>
												<tr>
													<td><?php echo $b; ?></td>
													<td><?php echo $val['no_pintu'] ?></td>
												</tr>
											<?php
											$b++;
											}
											?>
											</tbody>
										</table>
									</td>
								</tr>
							</table>
							
							
							
							
							
						</div>
						
						
						
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
		<!-- jQuery -->
		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>
		<!-- NProgress -->
		<script src="<?php echo base_url('/assets/js/nprogress.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
    	<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
		<!-- Datatables -->
    <script>
      $(document).ready(function() {
		   $('#table2').dataTable();
		   $('#table3').dataTable();
		   $('#table6').dataTable();		   		   
        } );
    </script>
    <!-- /Datatables -->
