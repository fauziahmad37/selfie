		<!-- page content -->
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>List Registration Driver </h2>
                  <div class="clearfix"></div>
                </div>
				
				
				
                <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                  <form id="demo-form" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Penjualan/'); ?>" method="post">
					  
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_stnk">Tanggal Awal<span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						 <div class="input-group date form_date col-md-4" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
							<input class="form-control inputdate" size="auto" type="text" name="bulan" id="bulan" value="<?php echo date('d M Y', strtotime($date));?>" readonly>
							<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
						</div>
						</div>
						</div>
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_stnk">Tanggal Akhir<span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						 <div class="input-group date form_date col-md-4" data-date-format="dd MM yyyy" data-link-field="dtp_input2">
							<input class="form-control inputdate" size="auto" type="text" name="bulanakhir" id="bulanakhir" value="<?php echo date('d M Y', strtotime($dateakhir));?>" readonly>
							<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
						</div>
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
										echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
									}
								?>
							  </select>
							</div>
						</div>
					  
					   <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						  <select name="id_status_invoice" id="id_status_invoice" class="form-control" required="required">
							<option value="On Process','Rejected','Active">Semua</option>
							<option <?php if($id_status_invoice == 'On Process') echo 'selected'; ?> value="On Process">On Process</option>
							<option <?php if($id_status_invoice == 'Active') echo 'selected'; ?> value="Active">Active</option>
							<option <?php if($id_status_invoice == 'Rejected') echo 'selected'; ?> value="Rejected">Rejected</option>
						  </select>
						</div>
					  </div>
					  
					  <div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button type="submit" class="btn btn-success" id="search" name="search">Search</button>
						</div>
					  </div>
					  <div class="ln_solid"></div>
				  </form>
				  </div>
				</div>
                <div class="x_content table-responsive">
                	<table id="datatable" class="table table-striped" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Created</th>
								<th>Kode</th>
								<th>No Pintu Lama</th>
								<th>No Pintu</th>   
								<th>No Polisi</th>
								<th>Tipe</th>
								<th>Tahun</th>
								<th>No Rangka</th>
								<th>No Mesin</th>
								<th>Lokasi</th>
								<th>Pool</th>
								<th>Status</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$ct = 1;
							foreach ((Array) $data AS $key => $val) {
							?>	<tr>
								<td><?php echo $ct; ?></td>
								<td><?php echo $val['created_dt']; ?></td>
								<td>
									<a href="<?php echo site_url('/Penjualan/edit/'.$val['id']); ?>" class="blue"><?php echo $val['number_code']; ?></a>
								</td>
								<td><?php echo $val['no_pintu_lama']; ?></td>
								<td><?php echo $val['no_pintu']; ?></td>
								<td><?php echo $val['no_polisi']; ?></td>
								<td><?php echo $val['tipe']; ?></td>								
								<td><?php echo $val['tahun']; ?></td>								
								<td><?php echo $val['no_rangka']; ?></td>								
								<td><?php echo $val['no_mesin']; ?></td>								
								<td><?php echo 'Lajur - '.$val['lokasi']; ?></td>								
								<td><?php echo $val['pool_name']; ?></td>								
								<td><?php echo $val['status']; ?></td>								
								<td><?php echo $val['keterangan']; ?></td>								
								</tr>
						<?php $ct++; 
							}
							?>
						</tbody>
					</table>
                </div>
              </div>
            </div>
        </div>
		</div>
        <!-- /page content -->
			<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
			<link href="<?php echo base_url('/assets/css/buttons.dataTables.min.css');?>" rel="stylesheet">		
		<!-- jQuery -->
		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>
		<!-- NProgress -->
		<script src="<?php echo base_url('/assets/js/nprogress.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
    	<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/dataTables.buttons.min.js');?>"></script>    	
		<script src="<?php echo base_url('/assets/js/buttons.flash.min.js');?>"></script>		
		<script src="<?php echo base_url('/assets/js/buttons.html5.min.js');?>"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
		<!-- Datatables -->
    <script>
    $(document).ready(function() {
       $('.form_date').datetimepicker({
			autoclose: 1,
			startView: 3,
			minView: 2,
			maxView: 4
		});
       
		$('#datatable').dataTable( {
			dom: 'Bfrtip',
			"pageLength": 50,
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
		
	});
    </script>
    <!-- /Datatables -->
