		<!-- page content -->
	


	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Input Master CT</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-ct" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
                  <div class="x_content">
		  			
                    
		 <div id="page-wrapper">
            <div class="row">
               <!--  <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div> -->
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form action="<?php echo site_url('/C_tiket/insert_master_customer'); ?>" method="post">
            <div class="row">
            	<div class="container">
				  <div class="row">
				    <div class="col">
				    	<div class="col-sm-12">
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		Customer Data
                        		</div>
		                        <div class="panel-body">
		                            <table width="100%">
		                                <tr>
		                                	<td>No Transaksi</td>
		                                	<td style='padding-bottom:10px;padding-right:10px;'><input type='text' name='no_transaksi' id='no_transaksi' required readonly placeholder='Auto Generate'class="form-control col-md-7 col-xs-12"></td>
		                                	
											<td>Nomer Awal</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='no_awal'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                 <tr>
		                                	<td>Tanggal Transaksi</td>
		                                	<td style='padding-bottom:10px;padding-right:10px;'><input type='date' name='tgl_transaksi'  required class="form-control col-md-7 col-xs-12"></td>
		                                	<td>Nomer Akhir</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='nomer_akhir'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td><label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Kode Customer</td>
		                                	<td style='padding-bottom:10px;padding-right:10px;'><input type='text' name='customer_shortname'  id='customer_shortname' required class="form-control col-md-7 col-xs-12"></td>
		                                	<td>Total CT</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='total_ct'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                 <tr>
		                                	<td><label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Nama Customer</label></td>
		                                	<td style='padding-bottom:10px;padding-right:10px;'><input type='text' name='customer_name' id='customer_name' required class="form-control col-sm-4"></td>
											<td style='padding-bottom:10px;padding-right:10px;'> <a id="click_no_mesin"><i class="fa fa-search fa-2x"></i></td>
		                                </tr>
		                                <tr>
		                                	<td>Total Tiket</td>
		                                	<td style='padding-bottom:10px;padding-right:10px;'><input type='text' name='npwp'  required class="form-control col-md-7 col-xs-12"></td>
		                                	<td>Catatan </td>
		                                	<td style='padding-bottom:10px;'><textarea class="form-control col-md-7 col-xs-12"></textarea></td>
		                                </tr>
		                            </table>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
                		</div>
				    </div>
				    <div class="col">
				    	<div class="col-sm-12" >
				    		<input type='submit' name='simpan' value='Simpan Data' class="btn btn-info">
		                </div>
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

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
   
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
	   
	   var $modal = $("#ajax-modal-ct"); 
	$("#click_no_mesin").on("click", function(){
			var customer_name = $("#customer_name").val();
			if(customer_name !== '') {
				$modal.modal();
				$modal.load('<?php echo site_url('/C_tiket2/get_data_by_name_customer');?>',{"customer_name": customer_name});
			}
		});
</script>  


	


