		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
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
		  			<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/C_setoran/data_operasi'); ?>" method="post">
                      
					  <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="period_month">Masukan Pool <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						 <select name="id_pool" id="id_pool"  required="required" class="form-control col-md-7 col-xs-12">
						<option value="2">Jagakarsa Sebelum Migrasi</option>
						<option value="3">Bintaro</option>
						<option value="4">Ciganjur Sebelum Migrasi</option>
						<option value="6">Cipondoh B Sebelum Migrasi</option>
						<option value="7">Cipondoh C Sebelum Migrasi</option>
						<option value="10">Bekasi B Sebelum Migrasi</option>
						<option value="11">Star Sebelum Migrasi</option>
						<option value="12">Joglo Sebelum Migrasi</option>
						<option value="19">Bekasi C Sebelum Migrasi</option>
						<option value="32">Tangsel Sebelum Migrasi</option>
						<option value="33">Depok Sebelum Migrasi</option>
						<option value="34">Joglo Baru Sebelum Migrasi</option>
						<option value="35">Cipayung Sebelum Migrasi</option>
						<option value="36">Pekapuran Sebelum Migrasi</option>
						<option value="37">Pondok Bambu Sebelum Migrasi</option>
						<option value="38">Cipendawa</option>
						<option value="50">Mustika Sari Sebelum Migrasi</option>
						<option value="61">Semarang Sebelum Migrasi</option>
						<option value="62">Padang Sebelum Migrasi</option>
						</select>
						</div>   
                   	  </div>
					  
					  <div class="form-group">                   	
						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Nomer Pintu<span class="required">*</span>
						</label>
						<div class="col-md-2 col-sm-2 col-xs-2">
						  <input type="text"  name="no_pintu" required="required" />
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
					<table id="example" class="display nowrap" style="width:100%">
				        <thead>
				            <tr>
				                <th>Nama Pool</th>
				                <th>Nama PT</th>
				                <th>NO PINTU</th>
				                <th>Nama Pengemudi</th>
				                <th>NO KIP</th>
				                <th>TGL Awal SO</th>
				                <th>TGL Akhir SO</th>
				                <th>Sisa Hari</th>
				                <th>Catatan SO</th>
				            </tr>
				        </thead>
				        <tbody>
				            <?php
							foreach ($data AS $row) { 
								echo '<tr>'.
										'<td>'.$row['POOLFULLNAME'].'</td>'.
										'<td>'.$row['PTFULLNAME'].'</td>'.								
										'<td>'.$row['NO_PINTU'].'</td>'.
										'<td>'.$row['NAMA'].'</td>'.
										'<td>'.$row['KIP_OWNER'].'</td>'.
										'<td>'.$row['TGL_AWAL_SO'].'</td>'.
										'<td>'.$row['TGL_AKHIR_SO'].'</td>'.
										'<td>'.$row['SISA_HARI'].'</td>'.
										'<td>'.$row['NOTES'].'</td>'.
								'</tr>';
								}
							?>
				        </tbody>
						<tfoot>
			            <tr>
			                <th>NO KIP</th>
				            <th>NAMA</th>
				            <th>NO PINTU</th>
				            <th>TGL SPJ</th>
				            <th>NO SPJ</th>
				            <th>STATUS OPERASI</th>
				            <th>SETORAN WAJIB</th>
				            <th>TOTAL TERIMA</th>
				            <th>KS ADJUSMENT</th>
						</tr>
				        </tfoot>
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

		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" ></script>
		<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js" ></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" ></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" ></script>
		<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js" ></script>
		<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js" ></script>
   
    <!-- /Datatables -->
	<script type="text/javascript">
    $(document).ready(function() {
       $('.form_date').datetimepicker({
			autoclose: 1,
			startView: 3,
			minView: 2,
			maxView: 4
		});
       $('#example').DataTable( {
	        dom: 'Bfrtip',
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print'
	        ]
	    } );
     }); 
</script>  


