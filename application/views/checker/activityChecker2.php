<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Download SPJ dan Setoran <?php $datetime = new DateTime($date); ?></h2>
          		</div>
          						
				<div class="input-group  col-md-4" data-date-format="D, dd M yyyy" data-link-field="dtp_input1">
                    <input class="form-control inputdate" size="auto" type="text" placeholder="Masukan No Pintu" ></span>
					</span>			
				
					<input type="hidden" id="dtp_input1" value="" /><br/>					
                </div>
				
          	</div>
			<div class="col-md-12 col-sm-12 col-xs-12 tile">
				<div class="col-md-8 col-sm-8 col-xs-12">
						
				</div>
				<div class="input-group col-md-4" data-date-format="D, dd M yyyy" data-link-field="dtp_input2">
					<select name="id_pool" id="id_pool"  required="required" class="form-control col-md-7 col-xs-12 inputdate2">
						<option value="0">Pilih Pool</option>
						<option value="2">Jagakarsa</option>
						<option value="3">Bintaro</option>
						<option value="4">Ciganjur</option>
						<option value="6">Cipondoh B</option>
						<option value="7">Cipondoh C</option>
						<option value="10">Bekasi B</option>
						<option value="11">Star</option>
						<option value="12">Joglo</option>
						<option value="19">Bekasi C</option>
						<option value="32">Tangsel</option>
						<option value="33">Depok</option>
						<option value="34">Joglo Baru</option>
						<option value="35">Cipayung</option>	
						<option value="36">Pekapuran</option>
						<option value="37">Pondok Bambu</option>
						<option value="38">Cipendawa</option>
						<option value="50">Mustika Sari</option>
						<option value="61">Semarang</option>
						<option value="62">Padang</option>
						</select>
					</span>
					</span>			
				
					<input type="hidden" id="dtp_input2" value="" /><br/>					
                </div>
			
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		</div>
          		<div class="col-md-4" >
				<span class="input-group-btn"><button type="submit" class="btn btn-primary btnSubmit1" id="btnSubmit1" name="btnSubmit1">Download</button></span>
                </div>
          	</div>
          
		  
          <div class="row">
			
			
         
          </div>
		  <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
                                  
            
          </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		
		<!-- jQuery -->
		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>
		<!-- NProgress -->
		<script src="<?php echo base_url('/assets/js/nprogress.js');?>"></script>
		<!-- Chart.js -->
		<script src="<?php echo base_url('/assets/js/Chart.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js');?>"></script>
		<!-- morris.js -->
		<script src="<?php echo base_url('/assets/js/raphael.min.js');?>"></script>
		<!-- jQuery Sparklines -->
    	<script src="<?php echo base_url('/assets/js/jquery.sparkline.min.js');?>"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>

		<!-- Doughnut Chart -->
		<script>
		  $(document).ready(function(){
			var options = {
			  legend: false,
			  responsive: false
			};
			
			$('.btnSubmit').on('click', function (e) {
				var date = new Date($('.inputdate').val());
				var mm = date.getMonth() + 1;
				var dd = date.getDate();
				var yy = date.getFullYear();
				var date1 = new Date($('.inputdate2').val());
				var mm1 = date1.getMonth() + 1;
				var dd1 = date1.getDate();
				var yy1 = date1.getFullYear();
				if(yy > 0 && mm > 0 && dd > 0 && yy1 > 0 && mm1 > 0 && dd1 > 0){
					window.location = "<?php echo site_url('Checker/CheckerActivity/');?>"+yy+'-'+mm+'-'+dd+'/'+yy1+'-'+mm1+'-'+dd1;
					$('<div class="modal-backdrop" style="opacity:0.8"></div>').appendTo(document.body);
					$('#gif').css('visibility', 'visible');	
				}
				else 
					alert('Please input date');
			});
			
			$('.btnSubmit1').on('click', function (e) {
				var date = $('.inputdate').val();
				var date1 = $('.inputdate2').val();
				
					window.location.href  = "<?php echo site_url('/Checker/download2/');?>"+date+'/'+date1;
				
			});
			$('.btnUpdate').on('click', function (e) {
				window.location = "<?php echo site_url('/Checker/update_revenue_now?start='.$date);?>";
			});
			$('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				startDate: '<?php echo $datetime->format('d-m-y');?>'
			});
			
			
			
			
			
		
		  });
		</script>
		

		
		<!-- /Doughnut Chart -->