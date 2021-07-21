		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Input Master Customer</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-savings" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
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
				    	<div class="col-sm-6">
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		Customer Data
                        		</div>
		                        <div class="panel-body">
		                            <table width="100%" >
		                                <tr>
		                                	<td>Customer Code</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='customer_shortname'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                 <tr>
		                                	<td>Full Name</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='customer_name'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>NPWP</td>
		                                	<td><input type='text' name='npwp'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                            </table>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
                		</div>
				    </div>
				    <div class="col">
				    	<div class="col-sm-6">
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		Bank Data 
                        		</div>
		                        <div class="panel-body">
		                           <table width="100%" >
		                                <tr>
		                                	<td>Bank Name</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='bank_name' required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                 <tr>
		                                	<td>Bank Brance</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='bank_branch'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Bank Account Name</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='bank_account_name'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Bank Account No</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='bank_account_no'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                            </table>
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
                		</div>
				    </div>
				     <div class="col">
				    	<div class="col-sm-6">
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		Invoice Data
                        		</div>
		                        <div class="panel-body">
		                            <table width="100%" >
		                                <tr>
		                                	<td>Invoice Address</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='address_invoice'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                 <tr>
		                                	<td>City</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='city_invoice'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Post Code</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='postcode_invoice'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Phone Invoice</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='phone_invoice'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>FAX Invoice</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='fax_invoice'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Post Code Company</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='postcode_company'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Phone Company</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='phone_company'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Mobile Phone</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='mobile_phone_bill'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                            </table>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
                		</div>
				    </div>
				     <div class="col">
				    	<div class="col-sm-6" >
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		Company Data 
                        		</div>
		                        <div class="panel-body">
		                             <table width="100%" >
		                                <tr>
		                                	<td>Company Address</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='address_company' required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                 <tr>
		                                	<td>City</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='city_company'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Post Code</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='postcode_company'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Phone</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='phone_bill'  required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Fax</td>
		                                	<td style='padding-bottom:10px;'><input type='text' name='fax_company' required class="form-control col-md-7 col-xs-12"></td>
		                                </tr>
		                                <tr>
		                                	<td>Description</td>
		                                	<td style='padding-bottom:10px;'><textarea name='description' class="form-control col-md-7 col-xs-12"></textarea></td>
		                                </tr>
		                            </table>
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

		<script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
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

    
</script>  


