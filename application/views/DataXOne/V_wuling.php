		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>DATA UNIT TIDAK OPERASI WULING</h2>
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
            <div class="row">
            	<div class="container">
				  <div class="row">
				    <div class="col">
				    	<div class="col-sm-3">
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		Data Wuling Jagakarsa
                        		</div>
		                        <div class="panel-body">
		                            <table width="100%" class="table table-striped table-bordered table-hover" >
		                                <thead>
		                                    <tr>
		                                        <th>NO PINTU</th>
		                                        <th>STATUS</th>
		                                        
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php foreach ($data_jagakarsa AS $row) { ?>
		                                   	 <tr class="odd gradeX">
		                                        <td align='center'><?php echo $row['NO_PINTU'];?></td>
		                                        <td align='center'><?php echo $row['STATUS_OPERASI'];?></td>
		                                    </tr>
		                                    <?php } ?>
		                                </tbody>
		                            </table>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
                		</div>
				    </div>
				     <div class="col">
				    	<div class="col-sm-3">
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		Data Wuling Cipayung
                        		</div>
		                        <div class="panel-body">
		                            <table width="100%" class="table table-striped table-bordered table-hover" >
		                                <thead>
		                                    <tr>
		                                        <th>NO PINTU</th>
		                                        <th>STATUS</th>
		                                        
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php foreach ($data_cipayung AS $row) { ?>
		                                   	 <tr class="odd gradeX">
		                                        <td align='center'><?php echo $row['NO_PINTU'];?></td>
		                                        <td align='center'><?php echo $row['STATUS_OPERASI'];?></td>
		                                    </tr>
		                                    <?php } ?>
		                                </tbody>
		                            </table>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
                		</div>
				    </div>
				     <div class="col">
				    	<div class="col-sm-3">
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		Data Wuling Cipendawa
                        		</div>
		                        <div class="panel-body">
		                            <table width="100%" class="table table-striped table-bordered table-hover" >
		                                <thead>
		                                    <tr>
		                                        <th>NO PINTU</th>
		                                        <th>STATUS</th>
		                                        
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php foreach ($data_cipendawa AS $row) { ?>
		                                   	 <tr class="odd gradeX">
		                                        <td align='center'><?php echo $row['NO_PINTU'];?></td>
		                                        <td align='center'><?php echo $row['STATUS_OPERASI'];?></td>
		                                    </tr>
		                                    <?php } ?>
		                                </tbody>
		                            </table>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
                		</div>
				    </div>
				    <div class="col">
				    	<div class="col-sm-3">
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		Data Wuling Bintaro
                        		</div>
		                        <div class="panel-body">
		                            <table width="100%" class="table table-striped table-bordered table-hover" >
		                                <thead>
		                                    <tr>
		                                        <th>NO PINTU</th>
		                                        <th>STATUS</th>
		                                        
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php foreach ($data AS $row) { ?>
		                                   	 <tr class="odd gradeX">
		                                        <td align='center'><?php echo $row['NO_PINTU'];?></td>
		                                        <td align='center'><?php echo $row['STATUS_OPERASI'];?></td>
		                                    </tr>
		                                    <?php } ?>
		                                </tbody>
		                            </table>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
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


