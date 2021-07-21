		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Rental - <?php $datetime = new DateTime($date); echo $datetime->format('l, j F Y'); ?></h2>
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
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count" style="color:#26B99A">
              <span class="count_top"><i class="fa fa-user"></i> Total SPJ</span>
              <div class="count"><?php echo number_format($data['total_spj']); ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count" style="color:#3498DB">
              <span class="count_top"><i class="fa fa-money"></i> Total Revenue</span>
              <div class="count"><?php echo number_format($data['total_revenue']); ?></div>
            </div>
			<div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count" style="color:#E74C3C">
              <span class="count_top"><i class="fa fa-money"></i> APRU</span>
              <div class="count"><?php echo number_format($data['arpu']); ?></div>
            </div>
          </div>
		  <div class="row">
		  <!-- graph area -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 30 Day SPJ</h2>
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
                    <h2>Last 30 Day Revenue</h2>
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
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_content">
                  <table class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>#</th>
                    		<th>Pool</th>
                    		<th>No SPJ</th>
                    		<th>No KIP</th>                    		
                    		<th>Jenis Mobil</th>
                    		<th>Lama Sewa</th>
                    		<th>Waktu Sewa</th>
                    		<th>Waktu Kembali</th> 
                    		<th>Harga Sewa</th>
                    		<th>Total Denda</th>
                    		<th>Total Pembayaran</th>
                    		<th>Status Rental</th>                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php        
                    	$i = 1;         	        	
                    	foreach ((Array) $data['data'] AS $key => $val) { 
                    		echo '<tr><td>'.$i.'</td><td>'.$val['name'].'</td>'.
                    		'<td>'.($val['no_spj']).'</td>'.
                    		'<td>'.($val['kip']).'</td>'.                    		
                    		'<td>'.($val['jenis']).'</td>'.
                    		'<td>'.($val['lama_sewa']).'</td>'.
                    		'<td>'.date('d M H:i:s', strtotime($val['waktu_sewa'])).'</td>'.
                    		'<td>'.(isset($val['waktu_kembali']) ? date('d M H:i:s', strtotime($val['waktu_kembali'])) : '').'</td>'.
                    		'<td>'.number_format($val['harga_sewa']).'</td>'.
                    		'<td>'.number_format($val['nominal_bayar_denda']).'</td>'.
							'<td>'.number_format($val['nominal_bayar_sewa'] + $val['nominal_bayar_denda']).'</td>'.
							'<td style="color:'.($val['status'] === 'OPEN' ? '#E74C3C' : '#1ABB9C').'">'.($val['status']).'</td></tr>';
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
			
			Morris.Line({
			  element: 'graph_line',
			  data: [
			  	<?php
			  	$max = 0;
			  	$min = 10000; 
			  	foreach((Array) $data['series'] AS $key => $val){	
			  		echo "{period: '".date('D, d',strtotime($val['tgl_spj']))."', operasi: ".$val['operasi']."},";
			  	}
				?>
			  ],
			  parseTime: false,
			  xkey: 'period',
			  ykeys: ['operasi'],
			  lineColors: ['#1ABB9C'],
			  labels: ['SPJ'],
			  hideHover: 'auto',
			  pointSize: 1,			  
			  resize: true
			});
			
			Morris.Line({
			  element: 'graph_area',
			  data: [
			  	<?php
			  	$max = 0;
			  	$min = 10000; 
			  	foreach((Array) $data['series'] AS $key => $val){	
			  		echo "{period: '".date('D, d',strtotime($val['tgl_spj']))."', revenue: ".$val['revenue']."},";
			  	}
				?>
			  ],
			  parseTime: false,
			  xkey: 'period',
			  ykeys: ['revenue'],
			  lineColors: ['#3498DB'],
			  labels: ['Revenue'],
			  hideHover: 'auto',
			  pointSize: 1,			  
			  resize: true
			});
			
			$('.btnSubmit').on('click', function (e) {
				var date = new Date($('.inputdate').val());
				var mm = date.getMonth() + 1;
				var dd = date.getDate();
				var yy = date.getFullYear();
				window.location = "<?php echo site_url('/Rental/index/');?>"+yy+'-'+mm+'-'+dd;
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
			
		  });
		</script>
		<!-- /Doughnut Chart -->