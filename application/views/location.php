<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<h2 class="modal-title text-center">
			<?php echo $reg_no." Trips (".$tipe.")";?>
			</h2>
		</div>
		<div class="modal-body text-center">
			<table id="datatable" class="table table-striped" style="width:100%">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Type Order</th>
						<th class="text-center">Start Time</th>
						<th class="text-center">End Time</th>
						<th class="text-center">Trip Time</th>						
						<th class="text-center">Argo</th>
						<th class="text-center">Distance</th>						      
					</tr>
				</thead>
				<tbody>
				<?php            
					$i = 1;  
					$total_argo = 0;	
					foreach ((Array) $data AS $key => $val) { 
						$start = strtotime($val['start']);
						$end = strtotime($val['end']);
						echo '<tr><td>'.$i.'</td>'.
						'<td>'.$val['tipe'].'</td>'.
						'<td>'.date('H:i:s, d M Y', $start).'</td>'.
						'<td>'.date('H:i:s, d M Y', $end).'</td>'.
						'<td>'.number_format(round(abs($end - $start) / 60, 2)).' minutes</td>'.
						'<td>'.number_format($val['argo']).'</td>'.
						'<td>'.number_format($val['distance']).' KM</td></tr>';
						$i++;
						$total_argo += $val['argo'];
					}
				?>
				</tbody>
			</table>
		</div>
		<div class="modal-footer">	
			<div class="pull-left"><?php echo 'Total Trips : '.number_format($i - 1);?></div><br/>
			<div class="pull-left"><?php echo 'Total Argo  : '.number_format($total_argo);?></div>		
			<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
		</div>
		</form>
	</div>
</div>
<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>
<script>
  $(document).ready(function() {
	$('#gif').css('visibility', 'hidden');
	$('#datatable').dataTable( {
	"pageLength": 10
} );
	});
</script>