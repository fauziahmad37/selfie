		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Checker <?php if(strtotime($start) == strtotime($date)) {
          			$datetime = new DateTime($date); echo ' - '.$datetime->format('l, j F Y').'</h2>'; 
          			} else {
          			$datetime = new DateTime($start); echo '</h2><h4>'.$datetime->format('l, j F Y').' to '; 
          			$datetime2 = new DateTime($date); echo $datetime2->format('l, j F Y').'</h4>';           			
          			}
          		?>
          		<h4>Last Update <?php echo date('d M Y');?>
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
            <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> SPJ Actual</span>
              <div class="count"><?php echo number_format($data['total_spj']); ?></div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> SPJ Moce</span>
              <div class="count"><?php echo number_format($data['total_moce_spj']); ?></div>
            </div> 
            <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Pct SPJ Moce</span>
              <?php
				if($data['pct_total'] >= 90){
					echo '<div class="count green">';
				} else if($data['pct_total'] >= 65){
					echo '<div class="count orange">';
				} else {
					echo '<div class="count red">';
				}
				echo number_format($data['pct_total'], 2).'%</div>';
			  ?>
            </div>
          </div>
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel tile">
                <div class="x_title">
                  <h2>Mobile Checker SPJ</h2>      
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>
                    		<th>SPJ Actual</th>                    		
                    		<th>SPJ Moce</th>
                    		<th>Pct SPJ Moce</th>                 		                   		                         		              		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php										
                    	foreach ((Array) $data['data'] AS $key => $val) { 
                    		echo '<tr><td><a href="'.site_url('/Checker/detail/'.$val['id']).'">'.$val['name'].'</a></td>'.
                    		'<td>'.number_format($val['ops_operasi']).'</td>'. 
                    		'<td class="green">'.number_format($val['ct_moce']).'</td>';
                    		if($val['pct'] >= 60){
								echo '<td class="count green">';
							} else if($val['pct'] >= 45){
								echo '<td class="count orange">';
							} else {
								echo '<td class="count red">';
							}
							echo number_format($val['pct'], 2).'%</td></tr>';
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
				window.location = "<?php echo site_url('/Checker/index');?>"+'?start='+start+'&end='+end;
			});
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				startDate: '<?php echo $datetime->format('d-m-y');?>'
			});
		});
		</script>
		<!-- /Doughnut Chart -->