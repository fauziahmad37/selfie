<!-- page content -->
<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
	<div class="right_col" role="main">
		<div class="row">
			<div class="x_panel tile" id="print_area">
				<div class="x_title">
					<h2>Update Status Driver</h2>
					<div class="clearfix"></div>
				</div>
				
					<div class="x_content">
						<form id="form-model" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Etaxi/update_status_driver/'); ?>" method="post">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">KIP <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="kip" class="form-control col-md-7 col-xs-12" value="<?php if(isset($res['kip_number'])) echo $res['kip_number']; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="radio">Status <span class="required">*</span></label>
								<div class="radio">
								  <label><input type="radio" name="status" value='Active' checked>Active</label>
								</div>
								<div class="radio">
								  <label><input type="radio" name="status" value='Inactive'>Inactive</label>
								</div>
								<div class="radio">
								  <label><input type="radio" name="status" value='Freeze'>Freeze</label>
								</div>
								<div class="radio">
								  <label><input type="radio" name="status" value='Blacklisted'>Blacklisted</label>
								</div>
							</div>
							
							<?php 
							if($res == null){
							?>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<button type="cari" class="btn btn-success" name="cari" id="cari">Cari</button>
									</div>
								</div>
							<?php
							}							
							?>
							
							
						</form>	

					
					</div>
				</div>
			</div>
		</div>
	</div>
		

<!-- /page content -->
<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/css/buttons.dataTables.min.css');?>" rel="stylesheet">		
<!-- jQuery -->
<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>		
<!-- Bootstrap -->
<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>
<!-- NProgress -->
<script src="<?php echo base_url('/assets/js/nprogress.js');?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js');?>"></script>		
<!-- Custom Theme Scripts -->
<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
<!-- Datatables -->





