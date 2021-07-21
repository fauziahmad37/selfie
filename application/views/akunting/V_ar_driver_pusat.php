		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Ar Driver Pusat</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-savings" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
                  <div class="x_content">
		  			<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Kasir/ar_driver_pusat'); ?>" method="post">
                      
					  <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="period_month">Masukan Nomer KIP <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						 <input type='text' name='no_kip' required="required" class="form-control col-md-7 col-xs-12">
						</div>   
                   	  </div>
					 
					  <div class="ln_solid"></div>
					  <div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button type="submit" class="btn btn-success" id="cek" name="cek">TAMPILKAN</button>
						  
						</div>
					  </div>
					</form>
                    
		 <div id="page-wrapper">
            <div class="row">
               <!--  <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div> -->
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<form action="<?php echo site_url('/Kasir/InsertArDriverPusat'); ?>" method="post">
                        	
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th>Periode Bulan</th>
                                    	<th>Periode Id</th>
                                    	<th hidden>PT ID</th>
                                    	<th hidden>POOL ID</th>
                                        <th>NO KIP</th>
                                        <th>Nama Pengemudi</th>
                                        <th>Ar Saldo Awal</th>
                                        <th hidden>Ar Plus</th>
                                        <th hidden>Ar Minus</th>
                                        <th>Ar Saldo Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php foreach ($data AS $row) { ?>
                                   	 <tr class="odd gradeX" >
                                   	 	<td align='center' ><?php echo $row['startdt'];?></td>
                                   	 	<td align='center' ><input placeholder class="form-control col-md-3 col-xs-4" size='4' type="text" readonly name='periodeid' value="<?php echo $row['PERIODEID'];?>"></td>
                                   	 	<td align='center' hidden ><input placeholder class="form-control col-md-3 col-xs-4" type="text" readonly name='ptid' value="<?php echo $row['PTID'];?>"></td>
                                   	 	<td align='center' hidden ><input placeholder class="form-control col-md-3 col-xs-4" type="text" readonly name='poolid' value="<?php echo $row['POOLID'];?>"></td>
                                        <td align='center' ><input placeholder class="form-control col-md-3 col-xs-4" type="text" readonly name='no_kip' value="<?php echo $row['NO_KIP'];?>"></td>
                                        <td align='center' ><input placeholder class="form-control col-md-3 col-xs-4" type="text" readonly name='nama_pengemudi' value="<?php echo $row['NAMA_PENGEMUDI'];?>"></td>
                                        <td align='center' hidden><input type="text" readonly name='ar_saldo_awal'size='8' value="<?php echo $row['AR_SALDO_AWAL'];?>"></td>
                                        <td align='center' hidden><input class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_plus' value="0"></td>
                                        <td align='center' ><input placeholder class="form-control col-md-3 col-xs-4" size='8' type="text" readonly name='ar_minus' value="0"></td>
                                        <td align='center' ><input placeholder class="form-control col-md-3 col-xs-4" size='8'type="text" readonly name='ar_saldo_akhir' value="<?php echo $row['AR_SALDO_AKHIR'];?>"></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                                 <button type="submit" class="btn btn-success" id="cek" name="cek">PROSES</button>
                             </form>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
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


