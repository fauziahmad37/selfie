		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Amount KS Per No Pintu</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-savings" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
                  <div class="x_content">
		  			<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Finance/ksDriver'); ?>" method="post">
                      
					  <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="period_month">Masukan Pool <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						 <select name="id_pool" id="id_pool"  required="required" class="form-control col-md-7 col-xs-12">
						<option value="2">Jagakarsa</option>
						<option value="3">Bintaro</option>
						<option value="4">Ciganjur</option>
						<option value="6">Cipondoh B</option>
						<option value="7">Cipondoh C</option>
						<option value="10">Bekasi B</option>
						<option value="11">Star</option>
						<option value="12">Joglo</option>
						<option value="19">Bekasi C</option>
						<option value="32">Tangsel</option>
						<option value="33">Depok</option>
						<option value="34">Joglo Baru</option>
						<option value="35">Cipayung</option>
						<option value="36">Pekapuran</option>
						<option value="37">Pondok Bambu</option>
						<option value="38">Cipendawa</option>
						<option value="50">Mustika Sari</option>
						<option value="61">Semarang</option>
						<option value="62">Padang</option>
						</select>
						</div>   
                   	  </div>
					  
					  <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_pintu">Masukan No KIP <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						  <input type="text" id="no_pintu" name="no_pintu" required="required" class="form-control col-md-7 col-xs-12" />
						</div>                      
					  </div>
					  
					  <div class="ln_solid"></div>
					  <div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button type="submit" class="btn btn-success" id="cek" name="cek">Check</button>
						</div>
					  </div>
					</form>
                      
                  <div class="x_content table-responsive">
                	<table id="datatable" class="table table-striped" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nomor Pintu</th>
								<th>Kip Setor</th>
								<th>Nama Setor</th>
								<th>Jumlah KS</th>
																														
							</tr>
						</thead>
						<tbody>
						<?php
							$ct = 1;
							foreach ((Array) $data AS $key => $val) { 
								echo '<tr>'.
								'<td>'.$ct.'</td>'.
								'<td><a href="'.site_url('/Payment/detail/'.$val['id']).'" class="blue">'.$val['NO_PINTU'].'</a></td>'.          
								'<td>'.$val['KIP_SETOR'].'</td>'.	
								'<td>'.$val['NAMA_SETOR'].'</td>'.	
								'<td>'.$val['TOTAL_KS'].'</td>'.										
								'</tr>';
								$ct++;
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
