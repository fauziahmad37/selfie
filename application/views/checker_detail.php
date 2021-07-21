		<!-- page content -->
		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Checker Pool <?php echo $name;?>
          		<?php
          			$datetime = new DateTime($date); echo ' - '.$datetime->format('F Y').'</h2>'; 
          		?>
				</div>
                <div class="input-group date form_date col-md-4" data-date-format="M yyyy" data-link-field="dtp_input1">
                    <input class="form-control inputdate" size="auto" type="text" value="<?php echo date('M Y', strtotime($date));?>" readonly>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
					<span class="input-group-btn"><button type="button" class="btn btn-primary btnSubmit" id="btnSubmit">Submit</button></span>
					<input type="hidden" id="dtp_input1" value="" /><br/>					
                </div>
          	</div>
          </div>
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel tile">
                <div class="x_title">
                  <h2>SPJ</h2>      
                  <div class="clearfix"></div>
                </div>
                <div class="x_content table-responsive">
                  <table id="datatable1" class="table table-striped table-bordered text-center" style="width:100%;">
                    <thead>
                    	<tr>
                    		<th rowspan="2" style="text-align:center">Nomor Pintu</th>                     		                   	
                    	<?php 
                    		$this_month = date('Y-m', strtotime($date));
                    		$t = date('t', strtotime($date));
                    		for($i = 1; $i <= $t;$i++){
                    			echo '<th colspan="5" style="text-align:center">'.$this_month.'-'.($i < 10 ? '0'.$i : $i).'</th>';
																                    			
                    		}
                    		echo '</tr><tr>';
                    		for($i = 1; $i <= $t;$i++){
                    			echo '<th style="text-align:center">Nomor SPJ</th>';
                    			echo '<th style="text-align:center">Jenis Operasi</th>';                    			
                    			echo '<th style="text-align:center">Rit</th>';
                    			echo '<th style="text-align:center">Drop</th>';
                    			echo '<th style="text-align:center">Checker</th>';                    			                    			
                    		}
                    	?>        		                         		              		
                    	</tr>
                    </thead>
                    <tbody>
						<?php							
						$today_dt = date('Y-m-d');		
						foreach ((Array) $data AS $key => $val) { 
                    		echo '<tr><td>'.$key.'</td>';
							$last_rit = 0;	
							$last_drop = 0;							                    	                    		
                    		for($i = 1; $i <= $t;$i++){
                    			$is_more_than_today = strtotime($this_month.'-'.($i < 10 ? '0'.$i : $i)) >= strtotime($today_dt);
								if(isset($val[$this_month.'-'.($i < 10 ? '0'.$i : $i)])){
                    				echo '<td>'.$val[$this_month.'-'.($i < 10 ? '0'.$i : $i)]['nomor_spj'].'</td>';
                    				if(isset($val[$this_month.'-'.($i < 10 ? '0'.$i : $i)]['rit'])){
                    					$rit = $val[$this_month.'-'.($i < 10 ? '0'.$i : $i)]['rit'];
                    					$drop = $val[$this_month.'-'.($i < 10 ? '0'.$i : $i)]['drop'];
										echo '<td>'.$val[$this_month.'-'.($i < 10 ? '0'.$i : $i)]['tipe'].'</td>';
										echo '<td '.($rit < $last_rit ? 'style="color:red;"':'').'>'.number_format($rit).'</td>';
										echo '<td '.($drop < $last_drop ? 'style="color:red;"':'').'>'.number_format($drop).'</td>';
										echo '<td>'.$val[$this_month.'-'.($i < 10 ? '0'.$i : $i)]['checker'].'</td>';
										$last_rit = $rit;
										$last_drop = $drop;										
									} else if(!$is_more_than_today){
										echo '<td style="background-color:red"></td>';
										echo '<td style="background-color:red"></td>';										
										echo '<td style="background-color:red"></td>';
										echo '<td style="background-color:red"></td>';
									} else {
										echo '<td></td>';
										echo '<td></td>';										
										echo '<td></td>';
										echo '<td></td>';
									}
                    			} else if($is_more_than_today){
                    				echo '<td></td>';
									echo '<td></td>';                    				
									echo '<td></td>';
									echo '<td></td>';
									echo '<td></td>';
                    			} else {
                    				echo '<td>TP</td>';
                    				echo '<td>TP</td>';                    				
									echo '<td>TP</td>';
									echo '<td>TP</td>';
									echo '<td>TP</td>';
                    			}
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
			var options = {
			  legend: false,
			  responsive: false
			};
			 $('#datatable1').dataTable({bFilter: false, paging: false,dom: 'Bfrtip', bInfo: false, bSort:false,
			buttons: [
				'csv', 'excel'
			]});
			$('.btnSubmit').on('click', function (e) {
				var date = new Date($('.inputdate').val());
				var mm = date.getMonth() + 1;
				var dd = date.getDate();
				var yy = date.getFullYear();
				window.location = "<?php echo site_url('/Checker/detail/'.$id);?>?start="+yy+'-'+mm+'-'+dd;
			});
			 $('.form_date').datetimepicker({
				autoclose: 1,
				startView: 3,
				minView: 3,
				maxView: 4
			}); 
		});
		</script>
		<!-- /Doughnut Chart -->