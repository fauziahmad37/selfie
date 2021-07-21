		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detail Data Setoran Per Pool</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-savings" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
                  <div class="x_content">
		  			<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/C_callcenter/index'); ?>" method="post">
                      
                      <div class="form-group">                   	
						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Latitude <span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-2 col-xs-2">
						  <input type="text"  name="latitude" required="required" />
						</div>  

						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Longtitude <span class="required">*</span>
						</label>
						<div class="col-md-2 col-sm-2 col-xs-2">
						  <input type="text"  name="longtitude" required="required" />
						</div>                      
					  </div>

					  <div class="form-group">                   	
						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Range/Meter<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-2 col-xs-2">
						  <input type="text"  name="km" required="required" />
						</div>                       
					  </div>

					  <div class="form-group">                   	
						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Tanggal Awal <span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-2 col-xs-2">
						  <input type="datetime-local"  name="tgl_awal" required="required" />
						</div>  

						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Tanggal Akhir <span class="required">*</span>
						</label>
						<div class="col-md-2 col-sm-2 col-xs-2">
						  <input type="datetime-local"  name="tgl_akhir" required="required" />
						</div>                      
					  </div>
					  
					  <div class="ln_solid"></div>
					  <div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button type="submit" class="btn btn-success" id="cek" name="cek">TAMPILKAN</button>
						  
						</div>
					  </div>
					</form>
           
                  <div class="x_content table-responsive">
                	<table id="datatable" class="table table-striped" style="width:100%">
						<thead>
							<tr>
								<th>Nomer Pintu</th>
								<th>Tanggal</th>
								<th>Latitude</th>
								<th>Longtitude</th>
								<th>Status</th>									
							</tr>
						</thead>
						<tbody>
						<?php
							if($data == null){
								echo '<tr>'.
										'<td colspan="5" align="center">Data Kosong</td>'.
									'</tr>';
							}else{
								foreach ($data AS $row) { 
								echo '<tr>'.
										'<td>'.$row['v_reg_no'].'</td>'.
										'<td>'.$row['d_gps_time_stamp'].'</td>'.								
										'<td>'.$row['n_latitude'].'</td>'.
										'<td>'.$row['n_longitude'].'</td>'.
										'<td>'.$row['v_bdt_status'].'</td>'.
									'</tr>';
								}
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
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
		<!-- Datatables -->
		<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js');?>"></script>
   
    <!-- /Datatables -->
	<script type="text/javascript">
    $(document).ready(function() {
       $('.form_date').datetimepicker({
			autoclose: 1,
			startView: 3,
			minView: 2,
			maxView: 4
		});
       }); 

    
</script>  


