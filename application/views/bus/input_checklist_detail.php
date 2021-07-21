		<!-- page content -->
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                
                
				<div class="x_panel tile">
					<div class="x_title">
					  <h2>DATA CHECKLIST BUS </h2>
					  <div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="col-md-6 col-sm-6 col-xs-12"> 
							<table>
								<tr>
									<td>Nama Pengemudi </td>
									<td>: </td>
									<td><?php echo $data[0]['driver_name']; ?></td>
								</tr>
								<tr>
									<td>No Body </td>
									<td>: </td>
									<td><?php echo $data[0]['body_number']; ?></td>
								</tr>
								<tr>
									<td>No Polisi </td>
									<td>: </td>
									<td><?php echo $data[0]['police_number']; ?></td>
								</tr>
								<tr>
									<td>Tanggal </td>
									<td>: </td>
									<td><?php echo $data[0]['date']; ?></td>
								</tr>
								<tr>
									<td>Pembuat </td>
									<td>: </td>
									<td><?php echo $data[0]['created_by']; ?></td>
								</tr>
								<tr>
									<td>Tanggal Keluar </td>
									<td>: </td>
									<td><?php echo $data[0]['out_dt']; ?></td>
								</tr>
								<tr>
									<td>Tanggal Masuk </td>
									<td>: </td>
									<td><?php echo $data[0]['in_dt']; ?></td>
								</tr>
								<tr>
									<td>KM Keluar </td>
									<td>: </td>
									<td><?php echo $data[0]['km_out']; ?></td>
								</tr>
								<tr>
									<td>KM Masuk </td>
									<td>: </td>
									<td><?php echo $data[0]['km_in']; ?></td>
								</tr>
								<tr>
									<td>BBM Keluar </td>
									<td>: </td>
									<td><?php echo $data[0]['bbm_out']; ?></td>
								</tr>
								<tr>
									<td>BBM Masuk </td>
									<td>: </td>
									<td><?php echo $data[0]['bbm_in']; ?></td>
								</tr>
								<tr>
									<td>Status </td>
									<td>: </td>
									<td><?php echo $data[0]['status']; ?></td>
								</tr>
							</table>
						
						</div>
					</div>
				</div>
				
				
                <div class="x_content table-responsive">
                	<table id="datatable" class="table table-striped" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama </th>
								<th>Keluar</th>
								<th>Catatan Keluar</th>
								<th>Masuk</th>
								<th>Catatan Masuk</th>								
								<th>Kategori</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$ct = 1;
							foreach ((Array) $data AS $key => $val) {
							?>	<tr>
									<td><?php echo $ct; ?></td>
									<td>
										<a href="<?php echo site_url('/Bus/input_checklist/'.$val['id']); ?>" class="blue"><?php echo $val['name']; ?></a>
									</td>          
									<td><?php echo $val['out']; ?></td>
									<td><?php echo $val['notes_out']; ?></td>
									<td><?php echo $val['in']; ?></td>
									<td><?php echo $val['notes_in']; ?></td>
									<td><?php echo $val['category']; ?></td>
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
			"pageLength": 100,
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
		
	});
    </script>
    <!-- /Datatables -->
