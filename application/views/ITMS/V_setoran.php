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
		  			<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/C_setoran/index'); ?>" method="post">
                      
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
						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Tanggal Awal <span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-2 col-xs-2">
						  <input type="date"  name="tgl_awal" required="required" />
						</div>  

						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Tanggal Akhir <span class="required">*</span>
						</label>
						<div class="col-md-2 col-sm-2 col-xs-2">
						  <input type="date"  name="tgl_akhir" required="required" />
						</div>                      
					  </div>
					  
					  <div class="ln_solid"></div>
					  <div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button type="submit" class="btn btn-success" id="cek" name="cek">TAMPILKAN</button>
						  
						</div>
					  </div>
					</form>
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <a href="<?php echo site_url('/C_setoran/export'); ?>">
						  	<button type="submit" class="btn btn-primary btnSubmit1" id="btnSubmit1" name="btnSubmit1">Download</button>
						  </a>
					  </div>
                  <div class="x_content table-responsive">--
                	<table id="datatable" class="table table-striped" style="width:100%">
						<thead>
							<tr>
								<th>KODE SETOR</th>
								<th>TGL SETOR</th>
								<th>NO SPJ</th>
								<th>TGL SPJ</th>
								<th>NAMA POSTING</th>
								<!--<th>TGL POSTING</th>-->
								<th>NO PINTU</th>
								<!--<th>ID POOL</th>-->
								<th>NO KIP</th>
								<th>NAMA DRIVER</th>
								<th>STATUS OPERASI</th>
								<th>TOTAL KS TERBIT</th>
								<th>JUMLAH BAYAR KS</th>
								<th>KS ADJUSMENT</th>												
							</tr>
						</thead>
						<tbody>
						<?php
							
							foreach ($data AS $row) { 
								echo '<tr>'.
										'<td>'.$row['SETORAN_CODE'].'</td>'.
										'<td>'.$row['SETORAN_DATE'].'</td>'.								
										'<td>'.$row['SPJ_CODE'].'</td>'.
										'<td>'.$row['SPJ_DATE'].'</td>'.
										'<td>'.$row['POSTED_BY'].'</td>'.
										//'<td>'.$row['POSTED_DATE'].'</td>'.
										'<td>'.$row['NO_PINTU'].'</td>'.
										//'<td>'.$row['POOL_ID'].'</td>'.
										'<td>'.$row['KIP_SETOR'].'</td>'.
										'<td>'.$row['NAMA_SETOR'].'</td>'.
										'<td>'.$row['STATUS_OPERASI'].'</td>'.
										'<td>'.$row['TOTAL_KS_TERBIT'].'</td>'.
										'<td>'.$row['JUMLAH_BAYAR_KS'].'</td>'.
										'<td>'.$row['KS_ADJUSMENT'].'</td>'.
									'</tr>';
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


