<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<h2 class="modal-title text-center">
			<?php echo 'Performance '.$username.' Terhadap KS Mitra';?>
			</h2>
		</div>
		<div class="modal-body text-center">
			<table id="datatable" class="table table-striped" style="width:100%">
				<thead>
					<tr>
						<th class="text-center">Tgl SPJ</th>
						<th class="text-center">No SPJ</th>						
						<th class="text-center">Argo</th>
						<th class="text-center">Rit</th>
						<th class="text-center">Setor</th>
						<th class="text-center">KS</th>						      						
						<th class="text-center">Jenis KS</th>
						<th class="text-center">Komentar</th>						
					</tr>
				</thead>
				<tbody>
				<?php            
					$i = 0;  
					$jumlah_ks = 0;					
					foreach ((Array) $data AS $key => $val) { 
						echo '<tr><td>'.date('D M Y', strtotime($val['tgl_spj'])).'</td>'.
						'<td>'.$val['spj_code'].'</td>'.
						'<td>'.number_format($val['argo']).'</td>'.
						'<td>'.number_format($val['rit']).'</td>'.
						'<td>'.number_format($val['setor']).'</td>'.
						'<td>'.number_format(-$val['ks']).'</td>'.
						'<td>'.$val['alasan_ks'].'</td>'.
						'<td>'.nl2br($val['komentar']).'</td>'.												
						'</tr>';
						$i++;
						$jumlah_ks += $val['ks'];
					}
				?>
				</tbody>
			</table>
		</div>
		<div class="modal-footer">	
			<div class="pull-left"><?php echo 'Total Armada KS : '.number_format($i);?></div><br/>
			<div class="pull-left"><?php echo 'Total Kumulasi KS  : '.number_format(-$jumlah_ks);?></div>		
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