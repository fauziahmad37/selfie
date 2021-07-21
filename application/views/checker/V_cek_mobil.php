		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Input Kondisi Mobil</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-savings" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
                  <div class="x_content">
		  			<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Checker/inputKondisi'); ?>" method="post">
                      <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_stnk">Tanggal Pengecekan<span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						 <div class="input-group date form_date col-md-4" data-date-format="dd MM yyyy" data-link-field="dtp_input2">
							<input class="form-control inputdate" size="auto" type="text" name="tglspj" id="tglspj" value="<?php echo date('d M Y', strtotime($date));?>" readonly>
							<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
						</div>
						</div>       
					  </div>
					  <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_pintu">Masukan Nomer Mesin<span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						  <input type="text" id="no_pintu" name="no_pintu" required="required" class="form-control col-md-7 col-xs-12" />
						</div>                      
					  </div>
					  <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_pintu">Masukan Nomer Rangka<span class="required">*</span>
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
                      
                      <form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Checker/inputKondisi'); ?>" method="post">
                      <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_ct">Keterangan <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
                          <input type="hidden" id="noPintuProses" name="noPintuProses" value="<?php echo $noPintuProses;?>"/>
						  <input type="hidden" id="tglSpjProses" name="tglSpjProses" value="<?php echo $tglSpjProses;?>"/>
						  <input type="text" id="pesan" name="pesan" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $pesan;?>"/>
						</div>                      
					  </div>
					  
					  <div class="ln_solid"></div>
                                          <?php if ($flagProses > 0) { 
											echo '<div class="form-group">';               	
											// echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="val_ritase">Masukan Rit <span class="required">*</span>';
											// echo '</label>';
											// echo '<div class="col-md-6 col-sm-6 col-xs-9">';
											// echo '<input type="text" id="val_ritase" name="val_ritase" required="required" class="form-control col-md-7 col-xs-12" />';
											// echo '</div>';
											// echo '</div>';
											
											// echo '<div class="form-group">';               	
											// echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="val_drop">Masukan Drop <span class="required">*</span>';
											// echo '</label>';
											// echo '<div class="col-md-6 col-sm-6 col-xs-9">';
											// echo '<input type="text" id="val_drop" name="val_drop" required="required" class="form-control col-md-7 col-xs-12" />';
											// echo '</div>';
											// echo '</div>';
											
											// echo '<div class="form-group">';               	
											// echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="val_km_argo">Masukan KM Argo <span class="required">*</span>';
											// echo '</label>';
											// echo '<div class="col-md-6 col-sm-6 col-xs-9">';
											// echo '<input type="text" id="val_km_argo" name="val_km_argo" required="required" class="form-control col-md-7 col-xs-12" />';
											// echo '</div>';
											// echo '</div>';
											
											// echo '<div class="form-group">';               	
											// echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="val_km_speedo">Masukan KM Speedo <span class="required">*</span>';
											// echo '</label>';
											// echo '<div class="col-md-6 col-sm-6 col-xs-9">';
											// echo '<input type="text" id="val_km_speedo" name="val_km_speedo" required="required" class="form-control col-md-7 col-xs-12" />';
											// echo '</div>';
											// echo '</div>';

											echo '<div class="form-group">'; 
											echo "
													<table >
														<tr height='100%'>
															<td>Kondisi Lampu Mahkota </td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='lampu_mahkota' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Stiker Nomor Pintu</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='stiker_no_pintu' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Logo Express</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='logo_express' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi No Call Center</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='no_call_center' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Lampu Depan</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='lampu_depan' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Lampu Belakang</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='lampu_belakang' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Lampu Rem</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='lampu_rem' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Lampu Sign</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='lampu_sign' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Stiker Minimum Payment</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='stiker_minimum_payment' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Lampu LED</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='lampu_led' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Argo Meter</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='argometer' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Aksesoris Tidak Standar</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='aksesoris_tidak_standar' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Kebersihan</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='kebersihan' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Karpet Kaki</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='karpet_kaki' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi RDS</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='rds' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Struk Argo</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='struk_argo' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Ban Cadangan</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='ban_cadangan' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Jok</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='jok' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Seat Belt</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='seat_belt' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi AC</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='ac' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
														<tr height='100%'>
															<td>Kondisi Aroma Kabin</td>
														</tr>
														<tr height='100%'>
															<td align='right'><input type='checkbox' name='aroma_kabin' value='TIDAK BAIK'>
															<td>Tidak Baik</td>
														</tr>
													</table>
											";
											echo '</div>';

											// echo '<div class="form-group">';               	
											// echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="val_km_speedo">Kondisi Lampu Mahkota  <span class="required">*</span>';
											// echo '</label>';
											// echo '<div class="col-md-6 col-sm-6 col-xs-9">';
											// echo '<label>Rusak</label>';
											// echo '<input type="checkbox" id="val_km_speedo" name="val_km_speedo" required="required" class="form-control col-md-7 col-xs-12" />';
											// echo '</div>';
											// echo '</div>';
											
											echo '<div class="form-group">';               	
											echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="val_fix_part">Bagian yang harus diperbaiki <span class="required">*</span>';
											echo '</label>';
											echo '<div class="col-md-6 col-sm-6 col-xs-9">';
											echo '<input type="text" id="val_fix_part" name="val_fix_part" required="required" class="form-control col-md-7 col-xs-12" />';
											echo '</div>';
											echo '</div>';
					  
                                            echo '<div class="form-group">';
                                            echo '<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">';
                                            echo '<button type="submit" class="btn btn-success" id="proses" name="proses">Proses</button>';
                                            echo '</div>';
                                            echo '</div>';
                                          } ?>
                                          
					</form>
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
