<!-- page content -->
<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel tile" id="print_area">
				<div class="x_title">
					<div class="x_panel">
						<div class="x_title">
							<h2>Upload Foto DMS</h2>
							<!--span class="right"><a href="<?php //echo site_url('/Etaxi/upload_foto');?>" class="btn btn-danger no-print" method="post">List Pengambilan</a></span -->
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Etaxi/upload_file/'); ?>" method="post">
							<?php echo $error;?>

							<?php //echo form_open_multipart('upload/do_upload');?>

							<input type="file" name="userfile" size="20" />

							<br /><br />

							<input type="submit" value="upload" />

							</form>
						</div>  
					</div>                                                   
					<div class="clearfix"></div>
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

