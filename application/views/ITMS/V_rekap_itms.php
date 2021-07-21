		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Report ITMS</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-savings" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
                  <div class="x_content">
		  			<!-- <form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/C_setoran/reportItms'); ?>" method="post">
                      
					  <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="period_month">Masukan Pool <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						 <select name="pool" required="required" class="form-control col-md-7 col-xs-12">
							<option value="Bintaro">Bintaro</option>
							<option value="Pekapuran">Pekapuran</option>
							<option value="Jagakarsa">Jagakarsa</option>
							<option value="Cipendawa">Cipendawa</option>
							<option value="Cipayung">Cipayung</option>
							<option value="Pondok Bambu">Pondok Bambu</option>
							<option value="Tangsel">Tangsel</option>
							<option value="Ciater">Ciater</option>
							<option value="Cipondoh C">Cipondoh C</option>
						</select>
						</div>   
                   	  </div>
					  
					  <div class="form-group">                   	
						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Nomer Pintu<span class="required">*</span>
						</label>
						<div class="col-md-4 col-sm-2 col-xs-8">
						  <input type="text"  name="no_pintu" required="required" class="form-control col-md-7 col-xs-12"/>
						</div>                      
					  </div>

					  <div class="form-group">                   	
						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Nama Driver<span class="required">*</span>
						</label>
						<div class="col-md-4 col-sm-2 col-xs-8">
						  <input type="text"  name="nama_driver" required="required" class="form-control col-md-7 col-xs-12"/>
						</div>                       
					  </div>

					  <div class="form-group">                   	
						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Jenis Perbaikan<span class="required">*</span>
						</label>
						<div class="col-md-4 col-sm-2 col-xs-8">
						 <select class="form-control col-md-7 col-xs-12" name='jenis_perbaikan'>
						 	<option><-Silahkan Pilih-></option>
						 	<option value='ARGO'>ARGO</option>
						 	<option value='RDS'>RDS</option>
						 	<option value='ELEKTRIKAL'>ELEKTRIKAL</option>
						 	<option value='Lain-Lain'>Lain-Lain</option>
						 </select>
						</div>                        
					  </div>

					  <div class="form-group">                   	
						<label class="control-label col-md-2 col-sm-2 col-xs-2" for="no_pintu">Keterangan<span class="required">*</span>
						</label>
						<div class="col-md-4 col-sm-4 col-xs-8" >
						  <textarea class="form-control col-md-12 col-xs-12" name='keterangan'></textarea>
						</div>                       
					  </div>
					  <div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button type="submit" class="btn btn-success" id="cek" name="cek">Simpan Data</button>
						</div>
					  </div>
					</form> -->
                  <div class="x_content table-responsive">
					<table id="example" class="display nowrap" style="width:100%">
				        <thead>
				            <tr>
				                <th>USERNAME</th> 
				                <th>CREATED</th>
				                <th>NAMA POOL</th>
				                <th>NO PINTU</th>
				                <th>NAMA DRIVER</th>
				                <th>JENIS PERBAIKAN</th>
				                <th>KETERANGAN</th>
				                <th>JAM SELESAI</th>
				                <th>STATUS</th>
				               <!--  <th>AKSI</th> -->
				            </tr>
				        </thead>
				        <tbody>
				          <?php
							foreach ($data AS $row) { 
								echo '<tr>'.
										'<td>'.$row['username'].'</td>'.
										'<td>'.$row['created'].'</td>'.
										'<td>'.$row['pool'].'</td>'.
										'<td>'.$row['no_pintu'].'</td>'.
										'<td>'.$row['nama_driver'].'</td>'.
										'<td>'.$row['jenis_perbaikan'].'</td>'.
										'<td>'.preg_replace('/\v+|\\\r\\\n/Ui','<br/>',$row['keterangan']).'</td>'.
										'<td>'.$row['created_finish'].'</td>'.
										'<td>'.$row['status'].'</td>'.
										// '<td><a href="'.site_url("/C_setoran/updateStatus?id=$row[id_report]").'"><input type="submit" value="update"></a></td>'.
								'</tr>';
								}
							?>
				        </tbody>
						<tfoot>
			             <tr>

				                <th>USERNAME</th> 
				                <th>CREATED</th>
				                <th>NAMA POOL</th>
				                <th>NO PINTU</th> 
				                <th>NAMA DRIVER</th>
				                <th>JENIS PERBAIKAN</th>
				                <th>KETERANGAN</th>
				                <th>JAM SELESAI</th>
				                <th>STATUS</th>
				               <!--  <th>AKSI</th> -->
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


