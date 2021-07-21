<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<h2 class="modal-title text-center">
				List Customer
			</h2>
		</div>
		<div class="modal-body text-center table-responsive">
			<table class="table table-striped" id="datatable">
				<thead>
					<tr>
						<td>ID</td>
						<td>Kode Customer</td>
						<td>Nama Customer</td>
						<td>Alamat</td>
						<td>Kota</td>									
						<td>#</td>
					</tr>
				</thead>
				<tbody>
				<?php
					function nl2br2($string) {
						$string = str_replace(array("\r\n", "\r", "\n"), "\\n", $string);
						return $string;
					}
					$i = 0;
					foreach((Array) $data AS $key => $val){
						echo '<tr>
							<td>'.$val['customer_id'].'</td>
							<td>'.$val['customer_shortname'].'</input></td>
							<td>'.$val['customer_name'].'</td>
							<td>'.$val['address_invoice'].'</td>
							<td>'.$val['city_invoice'].'</td>
							<td>'.'<button id="car_btn_'.$i.'" class="btn btn-success btn-xs" data-dismiss="modal">Select'.
						'<script>'.
						"$('#car_btn_".$i."').click(function() {
							$('#customer_id').val('".$val['customer_id']."');
							$('#customer_name').val('".$val['customer_name']."');
							$('#customer_shortname').val('".$val['customer_shortname']."');
						  });".
						'</script>'.
						'</button></td></tr>';
						$i++;
					}
				?>
				</tbody>
			</table>
		</div>
		<div class="modal-footer">		
			<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
		</div>
		</form>
	</div>
</div>
<script>
 $(document).ready(function() {
$('#datatable').dataTable( {} );
        } );
</script>