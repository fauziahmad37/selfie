		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Checklist Armada Eagle High</h2>

                  <div class="clearfix"></div>
				 
				  
                </div>
					
				<a href="<?php echo site_url('/Bus/Checklist_header'); ?>" class="btn btn-info" role="button">Data Checklist </a>
				
					
				<div id="ajax-modal-car" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
                <div class="x_content">
					<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Bus/'); ?>" method="post">
						  <div class="form-group">
						    <input type="hidden" id="id" name="id"/>
						    
						  
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<div class="input-group date form_date col-md-4" data-date-format="dd MM yyyy" data-link-field="tanggal">
										<input class="form-control inputdate" size="auto" type="text" name="tanggal" id="tanggal" value="<?php echo date('d M Y', strtotime($date));?>" readonly>
										<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
									</div>
								</div>       
							</div>
						  
						 
						  
						  <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_polisi">No. Polisi <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-9">
							  <input type="text" id="no_polisi" name="no_polisi" class="form-control col-md-7 col-xs-12" required="required"/>
							</div>
							                   
						  </div>
						  
						  <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_body">No. Body <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-9">
							  <input type="text" id="no_body" name="no_body" class="form-control col-md-7 col-xs-12" required="required"/>
							</div>
							                   
						  </div>
						  
						  <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_driver">Nama Driver <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-9">
							  <input type="text" id="nama_driver" name="nama_driver" class="form-control col-md-7 col-xs-12" required="required"/>
							</div>
							                   
						  </div>
						  
						 <div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="jam_out">Jam Out <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<div class="input-group date" id='datetimepicker3'>
										<input class="form-control inputdate" size="auto" type="text" id="jam_out" name="jam_out">
										<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>			
									</div>
								</div>
							</div>
							
							
						  
						  
						  
						  <div class="ln_solid"></div>
						  <div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							  <button type="submit" class="btn btn-success" id="save" name="save">Submit</button>
							</div>
						  </div>
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
		<!-- jQuery -->
		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>
		<!-- NProgress -->
		<script src="<?php echo base_url('/assets/js/nprogress.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
    	<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js');?>"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
		<!-- Datatables -->
    <script>

      $(document).ready(function() {
		  
		   $('#datetimepicker3').datetimepicker({
                  format: 'yyyy-mm-dd hh:ii:dd'
            });
			
			$('#datetimepicker4').datetimepicker({
                  format: 'yyyy-mm-dd hh:ii:dd'
            });
		  
					
		$('.form_date').datetimepicker({
			autoclose: 1,
			startView: 3,
			minView: 2,
			maxView: 3
		});

       } );
    </script>
    <!-- /Datatables -->