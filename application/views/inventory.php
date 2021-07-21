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
          		<h2>Inventory Sparepart - <?php $datetime = new DateTime($date); echo $datetime->format('l, j F Y'); ?></h2>
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
          	<div id="ajax-modal-shelter" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
			<?php
				echo '<script>
					var $modal = $("#ajax-modal-shelter"); 
					function load_page(url){
						$modal.load(url,function(){});
					}
					</script>';
			?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel tile">
					<div class="x_title">
					  <h2>Inventory Stock</h2>                 
					  <div class="clearfix"></div>
					</div>
					<div class="x_content">
					  <table class="table table-striped" style="width:100%">
						<thead>
							<tr>
								<th>Sparepart Name</th>
								<th>Type</th>                    		
								<th>Unit</th>
								<th>Qty Area 1</th>
								<th>Qty Area 2</th>
								<th>Qty Area 3</th>
								<th>Qty Area 4</th>																
								<th>Qty Total</th>								                  		                    		
							</tr>
						</thead>
						<tbody>
						<?php                    	
							foreach ((Array) $data['inventory'] AS $key => $val) { 
								$total = $val['qty1'] + $val['qty2'] + $val['qty3'] + $val['qty4'];
								echo '<tr><td>'.$val['namepart'].'</td>'.
								'<td>'.($val['jenis']).'</td>'.
								'<td>'.($val['satuan']).'</td>'.
								'<td><a id="click_'.$val['id_item'].'" class="'.($val['qty1'] < 10 ? "red" : ($val['qty1'] < 50 ? "orange" : "green")).'"><script>
										$("#click_'.$val['id_item'].'").on("click", function(){
											$modal.modal();
											load_page("'.site_url('/Inventory/pool?id='.$val['id_item'].'&date='.$date.'&area=1').'");
										});
										</script>'.number_format($val['qty1']).'</a></td>'.
								'<td><a id="click2_'.$val['id_item'].'" class="'.($val['qty2'] < 10 ? "red" : ($val['qty2'] < 50 ? "orange" : "green")).'"><script>
										$("#click2_'.$val['id_item'].'").on("click", function(){
											$modal.modal();
											load_page("'.site_url('/Inventory/pool?id='.$val['id_item'].'&date='.$date.'&area=2').'");
										});
										</script>'.number_format($val['qty2']).'</a></td>'.
								'<td><a id="click3_'.$val['id_item'].'" class="'.($val['qty3'] < 10 ? "red" : ($val['qty3'] < 50 ? "orange" : "green")).'"><script>
										$("#click3_'.$val['id_item'].'").on("click", function(){
											$modal.modal();
											load_page("'.site_url('/Inventory/pool?id='.$val['id_item'].'&date='.$date.'&area=6').'");
										});
										</script>'.number_format($val['qty3']).'</a></td>'.
								'<td><a id="click4_'.$val['id_item'].'" class="'.($val['qty4'] < 10 ? "red" : ($val['qty4'] < 50 ? "orange" : "green")).'"><script>
										$("#click4_'.$val['id_item'].'").on("click", function(){
											$modal.modal();
											load_page("'.site_url('/Inventory/pool?id='.$val['id_item'].'&date='.$date.'&area=7').'");
										});
										</script>'.number_format($val['qty4']).'</a></td>'.												
								'<td class="'.($total < 10 ? "red" : ($total < 50 ? "orange" : "green")).'">'.number_format($total).'</td></tr>'; 
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
		
		<script>
			$('.btnSubmit').on('click', function (e) {
				var date = new Date($('.inputdate').val());
				var mm = date.getMonth() + 1;
				var dd = date.getDate();
				var yy = date.getFullYear();
				window.location = "<?php echo site_url('/Inventory/index/');?>"+yy+'-'+mm+'-'+dd;
			});
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				startDate: '<?php echo $datetime->format('d-m-y');?>'
			});
		</script>