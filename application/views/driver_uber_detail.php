<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<h2 class="modal-title text-center">
			</h2>
		</div>
		<div class="modal-body">
			<table id="datatable_inventories" class="table table-striped" style="width:100%">
				<thead>
					<tr>
						<th>Tgl</th>
						<th>No Pintu</th>						
						<th>Trips</th>
						<th>Fares</th>
						<th>Hours Online</th>
						<th>Setoran</th>
						<th>KS</th>																														  
					</tr>
				</thead>
				<tbody>
				<?php            	
					foreach ((Array) $data AS $key => $val) { 
						echo '<tr><td>'.$val['tgl'].'</td>'.
						'<td>'.$val['no_pintu'].'</td>'.
						'<td>'.number_format($val['trip']).'</td>'.
						'<td>'.number_format($val['fare']).'</td>'.
						'<td>'.number_format($val['hours_online'] / 60, 2).'</td>'.
						'<td>'.number_format($val['setoran']).'</td>'.																								
						'<td>'.number_format($val['ks']).'</td></tr>';
					}
				?>
				</tbody>
			</table>
		</div>
		<div class="modal-footer">		
			<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
		</div>
		</form>
	</div>
</div>

<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>
<script>
  $(document).ready(function(){
	var options = {
	  legend: false,
	  responsive: false
	};
  });
  $('#datatable_inventories').dataTable({bFilter: false, paging: false});  
</script>