		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div cla  ss="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>AR Armada Murni Tidak Ada</h2>
                    <div class="clearfix"></div>
                  </div>
				  <div id="ajax-modal-savings" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>                  
                  <div class="x_content">
		  			<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Operasi/syncArArmadaMurni'); ?>" method="post">
                      <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_pintu">Masukan No Pintu <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						  <input type="text" id="no_pintu" name="no_pintu" required="required" class="form-control col-md-7 col-xs-12" />
						</div>   
                   	  </div>
					  
					 				  
					  
					  <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="period_month">Masukan Periode <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
						 <select name="period_month" id="period_month"  required="required" class="form-control col-md-7 col-xs-12">
						<option value="107">Jan 2018 </option>
						<option value="108">Feb 2018</option>
						<option value="109">Mar 2018</option>
						<option value="110">Apr 2018</option>
						</select>
						</div>   
                   	  </div>
					  
					   
    

					  
					  <div class="ln_solid"></div>
					  <div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button type="submit" class="btn btn-success" id="cek" name="cek">Check</button>
						</div>
					  </div>
					</form>
                      
                      <form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Operasi/arArmadaMurniTidakAda'); ?>" method="post">
                      <div class="form-group">                   	
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_ct">Keterangan <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-9">
                          <input type="hidden" id="noPintuProses" name="noPintuProses" value="<?php echo $noPintuProses;?>"/>
						  <input type="hidden" id="periodMonthProses" name="periodMonthProses" value="<?php echo $periodMonthProses;?>"/>
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
