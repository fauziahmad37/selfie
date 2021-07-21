<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<div class="modal-dialog modal-lg"  style="z-index:1050">
	<div class="modal-content">
		<div class="modal-header">
			<h2 class="modal-title text-center">
				Komentar
			</h2>
		</div>
		<div class="modal-body text-center table-responsive">
			<form id="form_comment_ks" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Detail/index'); ?>" method="post">
			  <div class="form-group">
				<input type="hidden" id="spj_code" name="spj_code" value="<?php echo $spj_code;?>"/>
				<input type="hidden" id="id" name="id" value="<?php echo $id_pool;?>"/>
				<input type="hidden" id="id_pool" name="id_pool" value="<?php echo $id_pool;?>"/>				
				<input type="hidden" id="date" name="date" value="<?php echo $date;?>"/>
				<input type="hidden" id="username" name="username" value="<?php echo $this->user['username'];?>"/>
				<input type="hidden" id="rit" name="rit" value="<?php echo $rit;?>"/>
				<input type="hidden" id="argo" name="argo" value="<?php echo $argo;?>"/>								
				<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Komentar <span class="required">*</span>
				</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select name="tipe_alasan" id="tipe_alasan" class="form-control" required="required">
					<option value="">-- Select One --</option>
					<?php
						foreach ((Array) $tipe_alasan as $key => $val){
							echo '<option value="'.$val['id'].'">'.$val['alasan_ks'].'</option>';
						}
					?>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="model">Komentar <span class="required">*</span>
				</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <textarea id="komentar" name="komentar" class="form-control col-md-7 col-xs-12" rows="5" required="required"/>
				</div>            
			  </div>
			  <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <button type="submit" class="btn btn-success" id="save" name="save">Simpan</button>
				  <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
				</div>
			  </div>
			</form>
		</div>
		</form>
	</div>
</div>
<script>
  $(document).ready(function() {
	$('#gif').css('visibility', 'hidden');
});
$('#form_comment_ks').submit(function(e) {
	$('#ajax-modal-approval').modal('hide');
	$('<div class="modal-backdrop" style="opacity:0.8"></div>').appendTo(document.body);
	$('#gif').css('visibility', 'visible');
	return true;
});
			

</script>