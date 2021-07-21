<!-- page content -->
<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<div class="right_col" role="main">
	<div class="row">
	<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Penjualan/index/'); ?>" method="post" enctype="multipart/form-data">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel tile">
				<div class="x_title">
					<h2>Edit Vehicle</h2>
					<div class="clearfix"></div>
				</div>
				
				<div id="ajax-modal-car" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
				<div class="x_content">
					
						<div class="form-group">
						   					  
							
							<input type="hidden" name="id" value="<?php if(isset($data_edit['id'])){ echo $data_edit['id']; } ?>" />
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kode <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<input required type="text"  name="number_code" value="<?php if(isset($data_edit['number_code'])){ echo $data_edit['number_code']; } ?>" 
									class="form-control col-md-7 col-xs-12 text-uppercase"/>
								</div>                   
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Pintu Lama <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<input type="text"  name="no_pintu_lama" value="<?php if(isset($data_edit['no_pintu_lama'])){ echo $data_edit['no_pintu_lama']; } ?>" 
									class="form-control col-md-7 col-xs-12 text-uppercase"/>
								</div>                   
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Pintu <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<input required type="text"  name="no_pintu" value="<?php if(isset($data_edit['no_pintu'])){ echo $data_edit['no_pintu']; } ?>" 
									class="form-control col-md-7 col-xs-12 text-uppercase"/>
								</div>                   
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Polisi <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<input required type="text"  name="no_polisi" value="<?php if(isset($data_edit['no_polisi'])){ echo $data_edit['no_polisi']; } ?>" 
									class="form-control col-md-7 col-xs-12 text-uppercase"/>
								</div>                   
							</div>
							
								
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tipe <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <select name="tipe" class="form-control">
									<option value="">-- Select One --</option>
										<option value="Nissan Elgrand 2.5 HWS AT" <?php if(isset($data_edit['tipe']) && $data_edit['tipe'] == 'Nissan Elgrand 2.5 HWS AT') echo 'selected' ?> >Nissan Elgrand 2.5 HWS AT</option>;
										<option value="Toyota New Limo" <?php if(isset($data_edit['tipe']) && $data_edit['tipe'] == 'Toyota New Limo') echo 'selected' ?>>Toyota New Limo</option>;
										<option value="Chevrolet Lova" <?php if(isset($data_edit['tipe']) && $data_edit['tipe'] == 'Chevrolet Lova') echo 'selected' ?>>Chevrolet Lova</option>;
										<option value="MB. Viano / V 350 AT" <?php if(isset($data_edit['tipe']) && $data_edit['tipe'] == 'MB. Viano / V 350 AT') echo 'selected' ?>>MB. Viano / V 350 AT</option>;
										<option value="Mercedes Benz C 200 CGI AT" <?php if(isset($data_edit['tipe']) && $data_edit['tipe'] == 'Mercedes Benz C 200 CGI AT') echo 'selected' ?>>Mercedes Benz C 200 CGI AT</option>;
										<option value="Toyota Alphard X 2.4 AT" <?php if(isset($data_edit['tipe']) && $data_edit['tipe'] == 'Toyota Alphard X 2.4 AT') echo 'selected' ?>>Toyota Alphard X 2.4 AT</option>;
										<option value="Limo 1.5 STD" <?php if(isset($data_edit['tipe']) && $data_edit['tipe'] == 'Limo 1.5 STD') echo 'selected' ?>>Limo 1.5 STD</option>;
										<option value="Vellfire" <?php if(isset($data_edit['tipe']) && $data_edit['tipe'] == 'Vellfire') echo 'selected' ?>>Vellfire</option>;
										<option value="Toyota Etios" <?php if(isset($data_edit['tipe']) && $data_edit['tipe'] == 'Toyota Etios') echo 'selected' ?>>Toyota Etios</option>;
										<option value="Alphard X 2,4 AT" <?php if(isset($data_edit['tipe']) && $data_edit['tipe'] == 'Alphard X 2,4 AT') echo 'selected' ?>>Alphard X 2,4 AT</option>;
								  </select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tahun <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<input required type="number"  name="tahun" value="<?php if(isset($data_edit['tahun'])){ echo $data_edit['tahun']; } ?>" 
									class="form-control col-md-7 col-xs-12 text-uppercase"/>
								</div>                   
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Rangka <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<input required type="text"  name="no_rangka" value="<?php if(isset($data_edit['no_rangka'])){ echo $data_edit['no_rangka']; } ?>" 
									class="form-control col-md-7 col-xs-12 text-uppercase"/>
								</div>                   
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Mesin <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<input required type="text"  name="no_mesin" value="<?php if(isset($data_edit['no_mesin'])){ echo $data_edit['no_mesin']; } ?>" 
									class="form-control col-md-7 col-xs-12 text-uppercase"/>
								</div>                   
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lokasi <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<input required type="text"  name="lokasi" value="<?php if(isset($data_edit['lokasi'])){ echo $data_edit['lokasi']; } ?>" 
									class="form-control col-md-7 col-xs-12 text-uppercase"/>
								</div>                   
							</div>
							
						

							<div class="form-group" id="pool_div">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Pool <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <select name="pool_id" class="form-control">
									<option value="">-- Select One --</option>
									<?php
										foreach ((Array) $arrPool as $key => $val){
											echo '<option value="'.$val['id'].'" '.((isset($data_edit['pool_id']) && $data_edit['pool_id'] == $val['id']) ? 'selected' : '').' >'.$val['name'].'</option>';
										}
									?>
								  </select>
								</div>
							</div>
						
						 
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <select name="status" class="form-control">
									<option value="">-- Select One --</option>
										<option value="Active" <?php if(isset($data_edit['status']) && $data_edit['status'] == 'Active') echo 'selected' ?> >Active </option>;
										<option value="Sold" <?php if(isset($data_edit['status']) && $data_edit['status'] == 'Sold') echo 'selected' ?> >Sold </option>;
										
								  </select>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-9">
									<input type="text" name="keterangan" value="<?php if(isset($data_edit['keterangan'])){ echo $data_edit['keterangan']; } ?>" 
									class="form-control col-md-7 col-xs-12" />
								</div>                      
							</div>
							
							
						 
						  <div class="ln_solid"></div>
						  
						  <div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<?php
									if(isset($data_edit['id'])) {
										echo '<button type="submit" class="btn btn-success" id="update" name="update">Update</button>';
									}else{
										echo '<button type="submit" class="btn btn-success" id="save" name="save">Save</button>';
									}
								?>
							
							
								
							</div>
						</div>
						 
					
                </div>
              </div>
            </div>
        </div>    
			 
    </form>        
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
		<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js');?>"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
		
		
		<!-- Date Picker -->
		
		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

      $(document).ready(function() {
				
		
			$( "#datepicker" ).datepicker();
			$( "#datepicker2" ).datepicker();

				
		

		//$("#update").hide(); 
       } );
    </script>
    <!-- /Datatables -->