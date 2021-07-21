		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div class="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Adjustment Tidak Ada Di Pusat</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-savings" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
                  <div class="x_content">
		  			<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Kasir/adjustmentTidakAdaDiPusat'); ?>" method="post">
                      <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_adj">Masukan No Adj <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						  <input type="text" id="no_adj" name="no_adj" required="required" class="form-control col-md-7 col-xs-12" />
						</div>                      
					  </div>
					  
					  <div class="ln_solid"></div>
					  <div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button type="submit" class="btn btn-success" id="cek" name="cek">Check</button>
						</div>
					  </div>
					</form>
                      
                      <form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Kasir/adjustmentTidakAdaDiPusat'); ?>" method="post">
                      <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_ct">Keterangan <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
                            <input type="hidden" id="noAdjProses" name="noAdjProses" value="<?php echo $noAdjProses;?>"/>
						  	<input type="text" id="pesan" name="pesan" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $pesan;?>"/>
						</div>                      
					  </div>
					  
					  <div class="ln_solid"></div>
                                          <?php if ($flagProses > 0) { 
                                            echo '<div class="form-group">';
                                            echo '<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">';
                                            echo '<button type="submit" class="btn btn-success" id="proses" name="proses">Proses</button>';
                                            echo '</div>';
                                            echo '</div>';
                                          } ?>
                                          
					</form>
                </div>  
                </div>                                  
            </div>
          </div>
		</div>
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
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
		<!-- Datatables -->
   
    <!-- /Datatables -->
