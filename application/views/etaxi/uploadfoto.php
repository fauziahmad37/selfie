<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<div class="right_col" role="main">  
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel tile" id="print_area">
				<div class="x_title">
					<div class="x_panel">
						
						<div class="x_title">
							<h2>Upload Foto DMS </h2>
							<div class="clearfix"></div>
						</div>	
						
						<div class="x_content">

							
								<br /><br />
								<form>
								<?php echo form_open_multipart('/UploadFoto/upload_file'); ?>
								<?php echo $error; ?>
								<input type="file" name="userfile" size="20" class=" mr-sm-2" />
								<br /><br />
								<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Upload File</button>
								</form>
							
						<form id="form-model" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/UploadFoto/'); ?>" method="post">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">KIP <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="kip" class="form-control col-md-7 col-xs-12" value="<?php if(isset($res['kip_number'])) echo $res['kip_number']; ?>">
									<input type="text" name="foto" value="<?php if(isset($foto)) echo $foto; ?>">
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