		<!-- page content -->
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Checklist Header </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                  <form id="demo-form" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Bus/checklist_header/'); ?>" method="post">
					  
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
					  
					   <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						  <select name="id_status_invoice" id="id_status_invoice" class="form-control" required="required">
							<option value="draft','active">Semua</option>
							<option <?php if($status == 'draft') echo 'selected'; ?> value="draft">Draft</option>
							<option <?php if($status == 'active') echo 'selected'; ?> value="active">Active</option>
							<option <?php if($status == 'closed') echo 'selected'; ?> value="closed">Closed</option>
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
								<th>No Polisi</th>
								<th>No Pintu</th>
								<th>Nama Pengemudi</th>   
								<th>Tanggal</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$ct = 1;
							foreach ((Array) $data AS $key => $val) {
							?>	<tr>
								<td><?php echo $ct; ?></td>
								<td>
									<a href="<?php echo site_url('/Bus/input_checklist_detail/'.$val['id']); ?>" class="blue"><?php echo $val['police_number']; ?></a>
								</td>          
								<td><?php echo $val['body_number']; ?></td>
								<td><?php echo $val['driver_name']; ?></td>
								<td><?php echo $val['created_dt']; ?></td>
								<td><?php echo $val['status']; ?></td>
								<td>
									<?php 
										if($val['status']=='active'){
									?>
										<a href="<?php echo site_url('/Bus/input_checklist/'.$val['id'].'?proses=in'); ?>" class="btn btn-info" role="button">Input In</a>
									<?php	
										}
									?>
									
								</td>
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
		
		// $("#send").click(function(){ 
			// alert(1);
		// });
		
		
		// $("#send").click(function(){ 
			// var id = $("#id").val();
			// var a = "in";
			// $.ajax({
				// type: "POST",
				// url: '<?php echo site_url('Bus/input_checklist') ?>',
				// data: {id: $("#id").val()},
				// dataType: "text",  
				// cache:false,
				// success: 
					// function(data){
						//alert(data);  //as a debugging message.
						// location.replace('<?php echo site_url('/Bus/input_checklist/');?>'+id+'?proses='+a);
					// }
			// });// you have missed this bracket
			// return false;
		// });
		
	});
    </script>
    <!-- /Datatables -->
