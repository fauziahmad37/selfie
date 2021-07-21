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
          		<h2><?php if(!isset($name)) echo 'Call Center'; else echo $name;
          		$datetime = new DateTime($date); echo ' - '.$datetime->format('F Y').'</h2>';?>
				<h4> Last Update <?php echo date('j F Y H:i:s');?>
				</div>
				<div class="input-group date form_date col-md-4" data-date-format="M yyyy" data-link-field="dtp_input1">
                    <input class="form-control inputdate" size="auto" type="text" value="<?php echo date('M Y', strtotime($date));?>" readonly>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
					<span class="input-group-btn"><button type="button" class="btn btn-primary btnSubmit" id="btnSubmit">Submit</button></span>
					<input type="hidden" id="dtp_input1" value="" /><br/>					
                </div>
          	</div>
          </div>
          <div class="row tile_count">
          	<div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-warning"></i> Total Complaint</span>
              <div class="count"><?php echo number_format($data['ct']); ?></div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-exclamation"></i> Total Open</span>
              <div class="count <?php echo ($data['open'] > 0 ? 'red' : ''); ?>"><?php echo number_format($data['open']); ?></div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total In Progress</span>
              <div class="count <?php echo ($data['fu'] > 0 ? 'orange' : ''); ?>"><?php echo number_format($data['fu']); ?></div>
            </div> 
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-check"></i> Total Closed</span>
              <div class="count green"><?php echo number_format($data['closed']); ?></div>
            </div> 
           </div>
           <div class="row tile_count">
          	<div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-warning"></i> Total Lost & Found</span>
              <div class="count"><?php echo number_format($data['lost_ct']); ?></div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-exclamation"></i> Total Open</span>
              <div class="count <?php echo ($data['lost_open'] > 0 ? 'red' : ''); ?>"><?php echo number_format($data['lost_open']); ?></div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total In Progress</span>
              <div class="count <?php echo ($data['lost_fu'] > 0 ? 'orange' : ''); ?>"><?php echo number_format($data['lost_fu']); ?></div>
            </div> 
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-check"></i> Total Closed</span>
              <div class="count green"><?php echo number_format($data['lost_closed']); ?></div>
            </div> 
           </div>
          <div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                  <h2>Complaints Category</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_complaints" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Kondisi Unit</p>
                            </td>
                            <td><?php echo number_format($data['kondisi']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Tata Tertib</p>
                            </td>
                            <td><?php echo number_format($data['tertib']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Sikap dan Perilaku</p>
                            </td>
                            <td><?php echo number_format($data['sikap']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Pelayanan Pengemudi</p>
                            </td>
                            <td><?php echo number_format($data['pengemudi']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square orange"></i>Contact Center / Shelter</p>
                            </td>
                            <td><?php echo number_format($data['callcenter']);?></td>
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
                  <h2>Lost & Found Category</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%;font-size:15px;">
                    <tr>
                      <td>
                        <canvas id="canvas_lostfounds" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Lost Items</p>
                            </td>
                            <td><?php echo number_format($data['lost']);?></td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Found Items</p>
                            </td>
                            <td><?php echo number_format($data['found']);?></td>
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
		  <!-- graph area -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Trend Complaint</h2>
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
                    <h2>Trend Lost & Found</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_area" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
          </div> 
          <div class="row <?php if(isset($name)) echo 'hidden';?>">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_content">
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Complaints</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Lost and Founds</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                  <table id="datatable1" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>
                    		<th>Open</th>
                    		<th>In Progress</th>                    		
                    		<th>Closed</th>
                    		<th>Total</th>                    		
                    		<th>Kondisi Unit</th>
                    		<th>Tata Tertib</th>
                    		<th>Sikap dan Perilaku</th>                    		
                    		<th>Pelayanan Pengemudi</th>                    		
                    		<th>Latest Complaint</th>                    		                 		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php                   	
                    	foreach ((Array) $data['data'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Callcenter/detail?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td class="'.($val['open'] > 0 ? 'red' : '').'">'.number_format($val['open']).'</td>'.
                    		'<td class="'.($val['fu'] > 0 ? 'orange' : '').'">'.number_format($val['fu']).'</td>'.
                    		'<td class="'.($val['closed'] == $val['ct'] ? 'green' : 'orange').'">'.number_format($val['closed']).'</td>'.
                    		'<td>'.number_format($val['ct']).'</td>'.
                    		'<td>'.number_format($val['kondisi']).'</td>'.
                    		'<td>'.number_format($val['tertib']).'</td>'.
                    		'<td>'.number_format($val['sikap']).'</td>'.
                    		'<td>'.number_format($val['pengemudi']).'</td>'.
                    		'<td class="'.($val['latest'] == 0 ? 'green' : 'red').'">'.($val['latest'] > 0 ? $val['latest'] : 'All Closed').'</td></tr>';                    		                    		                    		                    		                    		                    		                    		                    		
                    	}
                    ?>
                  </table>
                </div>
                		<div role="tabpanel" class="tab-pane fade in" id="tab_content2" aria-labelledby="home-tab">
                  <table id="datatable2" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>
                    		<th>Open</th>
                    		<th>In Progress</th>                    		
                    		<th>Closed</th>
                    		<th>Total</th>                    		
                    		<th>Lost</th>
                    		<th>Lost Resolved</th>
                    		<th>Lost Unresolved</th>                    		                    		
                    		<th>Found</th>
                    		<th>Found Resolved</th>
                    		<th>Found Unresolved</th>                    		                    		
                    		<th>Luxury Item</th>                    		
                    		<th>Non Luxury Item</th>
                    		<th>Latest Lost & Found</th>                     		                    		                 		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php                   	
                    	foreach ((Array) $data['data'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url("/Callcenter/detail?id=".$val['id']."&date=".$date."").'">'.$val['name'].'</td>'.
                    		'<td class="'.($val['lost_open'] > 0 ? 'red' : '').'">'.number_format($val['lost_open']).'</td>'.
                    		'<td class="'.($val['lost_fu'] > 0 ? 'orange' : '').'">'.number_format($val['lost_fu']).'</td>'.
                    		'<td class="'.($val['lost_closed'] == $val['lost_ct'] ? 'green' : 'orange').'">'.number_format($val['lost_closed']).'</td>'.
                    		'<td>'.number_format($val['lost_ct']).'</td>'.
                    		'<td>'.number_format($val['lost']).'</td>'.
                    		'<td class="green">'.number_format($val['lost_found']).'</td>'.
                    		'<td class="red">'.number_format($val['lost_notfound']).'</td>'.
							'<td>'.number_format($val['found']).'</td>'.
                    		'<td class="green">'.number_format($val['found_found']).'</td>'.
                    		'<td class="red">'.number_format($val['found_notfound']).'</td>'.
                    		'<td>'.number_format($val['mewah']).'</td>'.
                    		'<td>'.number_format($val['not_mewah']).'</td>'.                    		
                    		'<td class="'.($val['lost_latest'] == 0 ? 'green' : 'red').'">'.($val['lost_latest'] > 0 ? $val['lost_latest'] : 'All Closed').'</td></tr>';                    		                    		                    		                    		                    		                    		                    		                    		
                    	}
                    ?>
                  </table>
                </div>
                	  </div>
                	</div>
              </div>
			  </div>
              </div>
            </div>
          <div class="row <?php if(!isset($name)) echo 'hidden';?>">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_content">
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content3" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Complaints</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Lost and Founds</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content3" aria-labelledby="home-tab">
                  <table id="datatable3" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Date</th>
                    		<th>Status</th>
                    		<th>Type</th>                    		
                    		<th>Name</th>                    		
                    		<th>Phone</th>
                    		<th>Driver</th>                    		
                    		<th>No Pintu</th>
                    		<th>Police Number</th>
                    		<th>Detail</th>                    		
                    		<th>Result</th>                    		
                    		<th>Closed Date</th>                    		                 		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php                   	
                    	foreach ((Array) $data['complain'] AS $key => $val) { 
                    		echo '<tr><td>'.$val['complain_date'].'</td>'.
                    		'<td class="'.($val['complain_status'] != 'Closed' ? 'red' : '').'">'.($val['complain_status']).'</td>'.
                    		'<td>'.($val['complain_type']).'</td>'.
                    		'<td>'.($val['caller_name']).'</td>'.
                    		'<td>'.($val['caller_number']).'</td>'.
                    		'<td>'.($val['driver_name']).'</td>'.
                    		'<td>'.($val['no_pintu']).'</td>'.
                    		'<td>'.($val['police_number']).'</td>'.
                    		'<td>'.
                    		'<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_d_c_'.$val['complainid'].'">Check</button>
							  <div class="modal fade modal_d_c_'.$val['complainid'].'" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg">
								  <div class="modal-content">

									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
									  </button>
									  <h4 class="modal-title" id="myModalLabel">Detail</h4>
									</div>
									<div class="modal-body">
									  <p>'.$val['complain_detail'].'</p>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								  </div>
								</div>
							  </div>'.
							'</td>'.
                    		'<td>'.
                    		'<button type="button" class="btn btn-primary '.($val['closed_date'] == 0 ? "hidden" : "").'" data-toggle="modal" data-target=".modal_r_c_'.$val['complainid'].'">Check</button>
							  <div class="modal fade modal_r_c_'.$val['complainid'].'" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg">
								  <div class="modal-content">

									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
									  </button>
									  <h4 class="modal-title" id="myModalLabel">Detail</h4>
									</div>
									<div class="modal-body">
									  <p>'.$val['complain_result'].'</p>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								  </div>
								</div>
							  </div>'.
							'</td>'.
                    		'<td class="'.($val['closed_date'] == 0 ? 'red' : 'green').'">'.($val['closed_date']).'</td></tr>';                    		                    		                    		                    		                    		                    		                    		                    		
                    	}
                    ?>
                  </table>
                </div>
                		<div role="tabpanel" class="tab-pane fade in" id="tab_content4" aria-labelledby="home-tab">
                  <table id="datatable5" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Date</th>
                    		<th>Status</th>
                    		<th>Type</th>
                    		<th>Luxurious</th>                    		
                    		<th>Kind</th>                    		                    		                    		
                    		<th>Name</th>                    		
                    		<th>Phone</th>
                    		<th>Driver</th>                    		
                    		<th>No Pintu</th>
                    		<th>Police Number</th>
                    		<th>Detail</th>                    		
                    		<th>Result</th>
                    		<th>Result Note</th>                    		                    		
                    		<th>Closed Date</th>                    		                 		                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php                   	
                    	foreach ((Array) $data['lostfound'] AS $key => $val) { 
                    		echo '<tr><td>'.$val['lostfound_date'].'</td>'.
                    		'<td class="'.($val['lostfound_status'] != 'Closed' ? 'red' : '').'">'.($val['lostfound_status']).'</td>'.
                    		'<td>'.($val['lostfound_type']).'</td>'.
                    		'<td>'.($val['lostfound_kind2']).'</td>'.
                    		'<td>'.($val['lostfound_kind']).'</td>'.                    		                    		
                    		'<td>'.($val['caller_name']).'</td>'.
                    		'<td>'.($val['caller_number']).'</td>'.
                    		'<td>'.($val['driver_name']).'</td>'.
                    		'<td>'.($val['no_pintu']).'</td>'.
                    		'<td>'.($val['police_number']).'</td>'.
                    		'<td>'.
                    		'<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_d_l_'.$val['lostfoundid'].'">Check</button>
							  <div class="modal fade modal_d_l_'.$val['lostfoundid'].'" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg">
								  <div class="modal-content">

									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
									  </button>
									  <h4 class="modal-title" id="myModalLabel">Detail</h4>
									</div>
									<div class="modal-body">
									  <p>'.$val['lostfound_detail'].'</p>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								  </div>
								</div>
							  </div>'.
							'</td>'.
                    		'<td>'.
                    		'<button type="button" class="btn btn-primary '.($val['closed_date'] == 0 ? "hidden" : "").'" data-toggle="modal" data-target=".modal_r_l_'.$val['lostfoundid'].'">Check</button>
							  <div class="modal fade modal_r_l_'.$val['lostfoundid'].'" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg">
								  <div class="modal-content">

									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
									  </button>
									  <h4 class="modal-title" id="myModalLabel">Detail</h4>
									</div>
									<div class="modal-body">
									  <p>'.$val['lostfound_result'].'</p>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								  </div>
								</div>
							  </div>'.
							'</td>'.
                    		'<td>'.($val['lostfound_result2']).'</td>'.							
                    		'<td class="'.($val['closed_date'] == 0 ? 'red' : 'green').'">'.($val['closed_date']).'</td></tr>';                    		                    		                    		                    		                    		                    		                    		                    		
                    	}
                    ?>
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
		  $('#datatable2').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
			buttons: [
				'csv', 'excel', 'pdf'
			]});
		  $('#datatable3').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false,
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
			$('.btnSubmit').on('click', function (e) {
				var date = new Date($('.inputdate').val());
				var mm = date.getMonth() + 1;
				var dd = date.getDate();
				var yy = date.getFullYear();
				window.location = "<?php echo site_url('/Callcenter/index/');?>"+yy+'-'+mm+'-'+dd;
			});
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 3,
				minView: 3,
				dateFormat: 'MM yy',
				startDate: '<?php echo $datetime->format('d-m');?>',
				onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
			});
			var sikap = <?php echo round($data['sikap'] / ($data['ct'] > 0 ? $data['ct'] : 1) * 100, 2);?>;
			var tertib = <?php echo round($data['tertib'] / ($data['ct'] > 0 ? $data['ct'] : 1) * 100, 2);?>;
			var pengemudi = <?php echo round($data['pengemudi'] / ($data['ct'] > 0 ? $data['ct'] : 1) * 100, 2);?>;
			var callcenter = <?php echo round($data['callcenter'] / ($data['ct'] > 0 ? $data['ct'] : 1) * 100, 2);?>;
			var kondisi = <?php echo round($data['kondisi'] / ($data['ct'] > 0 ? $data['ct'] : 1) * 100, 2);?>;
			new Chart(document.getElementById("canvas_complaints"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Unit",
				  "Ketertiban",
				  "Sikap",
				  "Pelayanan",
				  "CC/Shelter"
				],
				datasets: [{
				  data: [kondisi, tertib, sikap, pengemudi, callcenter],
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
			var lost = <?php echo round($data['lost'] / ($data['lost_ct'] > 0 ? $data['lost_ct'] : 1) * 100, 2);?>;
			var found = <?php echo round($data['found'] / ($data['lost_ct'] > 0 ? $data['lost_ct'] : 1) * 100, 2);?>;
			new Chart(document.getElementById("canvas_lostfounds"), {
			  type: 'doughnut',
			  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
			  data: {
				labels: [
				  "Lost",
				  "Found"
				],
				datasets: [{
				  data: [lost, found],
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
			Highcharts.chart('graph_line', {
				chart: {
					type: 'column'
				},
				title : '',
				xAxis: {
					categories: [
					<?php
					foreach((Array) $data['series_complain'] AS $key => $val){
						echo "'".date('M Y', strtotime($val['y'].'-'.$val['mt'].'-1'))."',";
					}
					?>
					]
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Complaints'
					},
					stackLabels: {
						enabled: true,
						style: {
							fontWeight: 'bold',
							color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
						}
					}
				},
				legend: {
					align: 'left',
					x: 120,
					verticalAlign: 'top',
					y: 0,
					floating: true,
					shadow: false
				},
				tooltip: {
					headerFormat: '<b>{point.x}</b><br/>',
					pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
				},
				plotOptions: {
					column: {
						stacking: 'normal',
						dataLabels: {
							enabled: true,
							color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
						}
					}
				},
				series: [{
					name: 'Unresolved',
					data: [
					<?php
					foreach((Array) $data['series_complain'] AS $key => $val){
						echo ($val['cases'] - $val['solves']).",";
					}
					?>
					],
					color: Highcharts.getOptions().colors[5]
				}, {
					name: 'Resolved',
					data: [
					<?php
					foreach((Array) $data['series_complain'] AS $key => $val){
						echo $val['solves'].",";
					}
					?>
					],
					color: Highcharts.getOptions().colors[2]
				}]
			});
			Highcharts.chart('graph_area', {
				chart: {
					type: 'column'
				},
				title : '',
				xAxis: {
					categories: [
					<?php
					foreach((Array) $data['series_complain'] AS $key => $val){
						echo "'".date('M Y', strtotime($val['y'].'-'.$val['mt'].'-1'))."',";
					}
					?>
					]
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Lost & Founds'
					},
					stackLabels: {
						enabled: true,
						style: {
							fontWeight: 'bold',
							color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
						}
					}
				},
				legend: {
					align: 'left',
					x: 120,
					verticalAlign: 'top',
					y: 0,
					floating: true,
					shadow: false
				},
				tooltip: {
					headerFormat: '<b>{point.x}</b><br/>',
					pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
				},
				plotOptions: {
					column: {
						stacking: 'normal',
						dataLabels: {
							enabled: true,
							color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
						}
					}
				},
				series: [{
					name: 'Unresolved',
					data: [
					<?php
					foreach((Array) $data['series_lostfound'] AS $key => $val){
						echo ($val['cases'] - $val['solves']).",";
					}
					?>
					],
					color: Highcharts.getOptions().colors[5]
				}, {
					name: 'Resolved',
					data: [
					<?php
					foreach((Array) $data['series_lostfound'] AS $key => $val){
						echo $val['solves'].",";
					}
					?>
					],
					color: Highcharts.getOptions().colors[2]
				}]
			});
		});
		</script>
		<!-- /Doughnut Chart -->