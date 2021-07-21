<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<h2 class="modal-title text-center">
				<?php echo $data['name']['name']; ?>
			</h2>
		</div>
		<div class="modal-body">
			<table id="datatable_inventories" class="table table-striped" style="width:100%">
				<thead>
					<tr>
						<th>Pool</th>
						<th>Qty</th>  
					</tr>
				</thead>
				<tbody>
				<?php            	
					foreach ((Array) $data['pool'] AS $key => $val) { 
						echo '<tr><td>'.$val['name'].'</td>'.
						'<td class="'.($val['qty'] < 10 ? "red" : ($val['qty'] < 50 ? "orange" : "green")).'">'.number_format($val['qty']).'</td></tr>';
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