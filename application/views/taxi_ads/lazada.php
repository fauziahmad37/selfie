        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>MONITORING TAXI EXPRESS</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-savings" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
                  <div class="x_content">
		  			
                    
		 <div id="page-wrapper">
            <div class="row">
               
            </div>
            <!-- /.row -->
            <div class="row">
            	<div class="container">
				  <div class="row">
				    
				     <div class="col">
				    	<div class="col-sm-5">
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		DATA LAZADA
                        		</div>
		                        <div class="panel-body">
		                            <table id="example" width="100%" class="table table-striped table-bordered table-hover" >
		                                <thead>
		                                    <tr>
												<th>NO</th>
		                                        <th>NO PINTU</th>
												<th>NOMOR POLISI</th>
		                                        <th>DATE TIME</th>
												<th>LAT</th>
												<th>LONG</th>
												<th>KM</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php $i=1; foreach ($data AS $row) { ?>
		                                   	 <tr class="odd gradeX">
												<td align='center'><?php echo $i;?></td>
		                                   	 	<td align='center'><?php echo $row['vehicle_id'];?></td>
		                                        <td align='center'><?php echo $row['license_plate_no'];?></td>
		                                        <td align='center'><?php echo $row['date_time'];?></td>
		                                        <td align='center'><?php echo $row['lat'];?></td>
		                                        <td align='center'><?php echo $row['lng'];?></td>
		                                        <td align='center'><?php echo $row['km'];?></td>
		                                    </tr>
		                                    <?php $i++; } ?>
		                                </tbody>
		                            </table>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
                		</div>
				    </div>
				    <div class="col">
				    	<div class="col-sm-5">
                    		<div class="panel panel-default">
                        		<div class="panel-heading">
                            		DATA SPJ TERAKHIR DICE
                        		</div>
		                        <div class="panel-body">
		                            <table id="example2" width="100%" class="table table-striped table-bordered table-hover" >
		                                <thead>
		                                    <tr>
		                                        <th>NO</th>
												<th>NO PINTU</th>
												<th>JAM MULAI SPJ</th>
												<th>NOMOR SPJ</th>
		                                        <th>STATUS OPERASI</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php $i=1; foreach ($data2 AS $row) { ?>
		                                   	 <tr class="odd gradeX">
												<td align='center'><?php echo $i;?></td>
												<td align='center'><?php echo $row['nomor_pintu'];?></td>
		                                   	 	<td align='center'><?php echo $row['jam_mulai_spj'];?></td>
		                                        <td align='center'><?php echo $row['nomor_spj'];?></td>
		                                        <td align='center'><?php echo $row['case'];?></td>
		                                    </tr>
		                                    <?php $i++; } ?>
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
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        
    } );
	
	$('#example2').DataTable( {
       
    } );
} );
</script>