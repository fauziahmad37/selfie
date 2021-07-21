		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Checker Activity - <?php $datetime = new DateTime($date); echo $datetime->format('l, j F Y'); ?></h2>
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
          
          
		  
          <div class="row">
			
			
         
          </div>
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Data Detail Receipt Tiara</a></h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content_setoran1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Detail</a>
                        </li>
                        
                      </ul>
                      <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content_setoran1" aria-labelledby="home-tab">
						  <table class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>Tanggal SPJ</th>                     		
									<th>No Pintu</th>
									<th>Nilai Ritase</th>							
									<th>Nilai Drop</th>
									<th>Nilai KM Argo</th>									
									<th>Nilai KM Speedo</th>
									<th>Bagian Yang Perlu Diperbaiki</th>	
									<th>ID Checker</th>	
									<th>Tanggal Input</th>	
								</tr>
							</thead>
							<tbody>
							<?php
								
								foreach ((Array) $dataCt AS $key => $val) { 
									echo 
									'<tr><td>'.$val['tgl_spj'].'</td>'.
									'<td>'.$val['no_pintu'].'</td>'.
									'<td>'.$val['val_rit'].'</td>'.
									'<td>'.$val['val_drop'].'</td>'.
									'<td>'.$val['val_km_argo'].'</td>'.
									'<td>'.$val['val_km_speedo'].'</td>'.
									'<td>'.$val['val_fix_part'].'</td>'.
									'<td>'.$val['user_insert'].'</td>'.
									'<td>'.$val['dt_insert'].'</td></tr>';
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
					window.location = "<?php echo site_url('/ReceiptTiara/index/');?>"+yy+'-'+mm+'-'+dd;
					$('<div class="modal-backdrop" style="opacity:0.8"></div>').appendTo(document.body);
					$('#gif').css('visibility', 'visible');	
				}
				else 
					alert('Please input date');
			});
			$('.btnUpdate').on('click', function (e) {
				window.location = "<?php echo site_url('/ReceiptTiara/update_revenue_now?start='.$date);?>";
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