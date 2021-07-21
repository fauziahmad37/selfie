		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Ar Armada</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-savings" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
                  <div class="x_content">
		  			<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Kasir/ArArmadaTidakAda'); ?>" method="post">
                      
					  <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="period_month">Masukan Nomer Pintu <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						 <input type='text' name='no_pintu' required="required" class="form-control col-md-7 col-xs-12">
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
                        	<form action="<?php echo site_url('/Kasir/InsertArArmada'); ?>" method="post">
                        	
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th>Periode Bulan</th>
                                    	<th hidden>Id Periode</th>
                                    	<th hidden>Owner Pt Id</th>
                                    	<th hidden>Pool Id</th>
                                    	<th hidden>Car Id</th>
                                    	<th>No Pintu</th>
                                    	<th>No Kip</th>
                                    	<th>Nama</th>
                                        <th hidden>Ar Saldo Awal</th>
                                        <th hidden>Ar Ks Bulan Ini Plus</th>
                                        <th hidden>Ar Ks Bulan Ini Minus</th>
                                        <th>Ar Ks Sldo Akhir</th>
                                        <th hidden>Ar Tabungan Awal</th>
                                        <th hidden>Ar Tabungan Bulan Ini Plus</th>
                                        <th hidden>Ar Tabungan Bulan Ini Minus</th>
                                        <th>Ar Tabungan Saldo Akhir</th>
                                        <th hidden>Ar Lain Awal</th>
                                        <th hidden>Ar Lain Bulan Ini Plus</th>
                                        <th hidden>Ar Lain Bulan Ini Minus</th>
                                        <th>Ar Lain Akhir</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php foreach ($data AS $row) { ?>
                                   	 <tr class="odd gradeX" >
                                   	 	<td align='center' ><?php echo $row['BULAN'];?></td>
                                   	 	<td align='center' hidden><input size='5' required class="form-control col-md-3 col-xs-4" type="text" readonly name='period_id' value="<?php echo $row['PERIOD_ID'];?>"></td>
                                   	 	<td align='center' hidden><input size='5' required class="form-control col-md-3 col-xs-4" type="text" readonly name='owner_pt_id' value="<?php echo $row['OWNER_PT_ID'];?>"></td>
                                   	 	<td align='center' hidden><input size='5' required class="form-control col-md-3 col-xs-4" type="text" readonly name='pool_id' value="<?php echo $row['POOL_ID'];?>"></td>
                                   	 	<td align='center' hidden><input size='5' required class="form-control col-md-3 col-xs-4" type="text" readonly name='car_id' value="<?php echo $row['CAR_ID'];?>"></td>
                                   	 	<td align='center' ><input size='5' required class="form-control col-md-3 col-xs-4" type="text" readonly name='no_pintu' value="<?php echo $row['NO_PINTU'];?>"></td>
                                   	 	<td align='center' ><input size='13'required class="form-control col-md-3 col-xs-4" type="text" readonly name='kip_owner' value="<?php echo $row['KIP_OWNER'];?>"></td>
                                   	 	<td align='center' ><input size='13'required class="form-control col-md-3 col-xs-4" type="text" readonly name='nama_owner' value="<?php echo $row['NAMA_OWNER'];?>"></td>
                                        <td align='center' ><input size='7' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_ks_saldo_awal' value="<?php echo $row['AR_KS_SALDO_AWAL'];?>"></td>
                                        <td align='center' hidden><input size='5' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_ks_bulan_ini_plus' value="0"></td>
                                        <td align='center' hidden><input size='5' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_ks_bulan_ini_minus' value="0"></td>
                                        <td align='center' ><input size='8' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_ks_saldo_akhir' value="<?php echo $row['AR_KS_SALDO_AKHIR'];?>"></td>
                                        <td align='center' hidden><input size='7' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_tabsp_saldo_awal' value="<?php echo $row['AR_TABSP_SALDO_AWAL'];?>"></td>
                                        <td align='center' hidden><input size='5' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_tabsp_bulan_ini_plus' value="0"></td>
                                        <td align='center' hidden><input size='5' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_tabsp_bulan_ini_minus' value="0"></td>
                                        <td align='center' ><input size='8' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_tabsp_saldo_akhir' value="<?php echo $row['AR_TABSP_SALDO_AKHIR'];?>"></td>
                                        <td align='center' hidden><input size='7' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_lain_saldo_awal' value="<?php echo $row['AR_LAIN_SALDO_AWAL'];?>"></td>
                                        <td align='center' hidden ><input size='7' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_lain_bulan_ini_plus' value="0"></td>
                                        <td align='center' hidden><input size='7' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_lain_bulan_ini_minus' value="0"></td>
                                        <td align='center' hidden><input size='7' required class="form-control col-md-3 col-xs-4" type="text" readonly name='ar_lain_saldo_akhir' value="<?php echo $row['AR_LAIN_SALDO_AKHIR'];?>"></td>
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


