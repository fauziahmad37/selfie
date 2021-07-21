		<!-- PNotify -->
    <link href="<?php echo base_url('/assets/css/pnotify.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/pnotify.buttons.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/pnotify.nonblock.css');?>" rel="stylesheet">
		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  <div class="row">
		  	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Data</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form action="<?php echo site_url('/Uberdata/upload_sampledata');?>" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
						<table class="table" style="width:100%">
						<tr>
						<td>File </td>
						<td><input type="file" class="form-control" name="userfile" id="userfile"/>
						</td>
						</tr>
						<tr>
						<td>Upload Tipe</td>
						<td>
                          <select name="type_upload" id="type_upload" class="form-control">
                          	<option value="1">Driver</option>
                          	<option value="2">Performance</option>
                          	<option value="3">KS</option>         
                          </select>
                        </td>
						</tr>
						<tr>
						<td>Pool</td>
						<td>
                          <select name="id_pool" id="id_pool" class="form-control">
							<option value="1">Bekasi A</option> 
							<option value="2">Bekasi B</option>
							<option value="3">Bekasi C</option>
							<option value="4">Bekasi D</option>
							<option value="5">Cipendawa</option>
							<option value="6">Pondok Bambu</option>
	 						<option value="7">Cipayung</option>
							<option value="8">Depok</option>
							<option value="9">Mustika Sari</option>
							<option value="10">Pekapuran</option>
							<option value="15">Bintaro (EA)</option>
							<option value="16">Ciganjur (EB)</option>
							<option value="17">Jagakarsa (EC)</option>
							<option value="18">Joglo Baru (ED)</option> 
							<option value="19">Star</option>
							<option value="20">Joglo Lama</option>
							<option value="21">Cipondoh A (MA)</option>
							<option value="22">Cipondoh B (MB)</option>
							<option value="23">Cipondoh C (MC)</option>
							<option value="24">Tangerang Selatan</option>
							<option value="33">Megapool</option>							
                          </select>
                        </td>
						</tr>
						<tr>
						<td>Date<br/>Current Date for Performance<br/>First Monday for KS</td>
						<td>
                          <div class="input-group date form_date" data-date-format="D, dd M yyyy" data-link-field="dtp_input1">
<!--                    <input class="form-control inputdate" size="auto" type="text" value="<?php echo isset($success) ? $success : '';?>" name="tgl" readonly>-->
                    <input class="form-control inputdate" size="auto" type="text" name="tgl" id="tgl" readonly>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>			
					<input type="hidden" id="dtp_input1" value="" /><br/>					
                </div>
                        </td>
						</tr>
						<tr>
							<td><button type="submit" name="submit" class="btn btn-info">Submit</button></td>
						<td></td>
						</tr>
						</table> 
                    </form>
                </div>  
                </div>                                  
            </div>
          </div>
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Updated List</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="datatable" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Pool</th>              		
                    		<th>Last Update Driver</th>
                    		<th>Last Update Performance</th>
                    		<th>Last Update KS</th>                    		
                    	</tr>
                    </thead>
                    <tbody>
                    <?php         
                    	foreach ((Array) $data AS $key => $val) { 
                    		echo '<tr><td>'.$val['name'].'</td>'.                 		              		                    		
                    		'<td>'.date('Y-m-d H:i:s', strtotime($val['dt'])).'</td>'.
                    		'<td>'.date('Y-m-d H:i:s', strtotime($val['dt2'])).'</td>'.                    		
                    		'<td>'.date('Y-m-d H:i:s', strtotime($val['dt3'])).'</td></tr>';
                    	}
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
             <div id="custom_notifications" class="custom-notifications dsp_none">
      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
      </ul>
      <div class="clearfix"></div>
      <div id="notif-group" class="tabbed_notifications"></div>
    </div>
 
		</div>
	  </div>
	</div>
        <!-- /page content -->
			<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
		<!-- jQuery -->
  <script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('/assets/js/pnotify.js');?>"></script>
    <script src="<?php echo base_url('/assets/js/pnotify.buttons.js');?>"></script>
    <script src="<?php echo base_url('/assets/js/pnotify.nonblock.js');?>"></script>

		<!-- Bootstrap -->
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js');?>"></script>
		<!-- NProgress -->
		<script src="<?php echo base_url('/assets/js/nprogress.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
    	<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
		<!-- Datatables -->
    <script>
      $(document).ready(function() {
        $('#datatable').dataTable( {
        "order": [[ 1, "asc" ]],
bFilter: false, paging: false, bInfo: false
    } );
        } );
        $('#userfile').bind('change', function() {

				var fileName = $('#userfile').val().toLowerCase().replace(/.*(\/|\\)/, '').replace(/\.[^/.]+$/, "");
				fileName = fileName.split(" ");
				var pool = fileName[0];
				var tipe = fileName[1];
				var year_dt = fileName[2];
				var month_dt = fileName[3];
				var day_dt = fileName[4];
				
				if(fileName.length == 6) //Name is long
				{
					pool = fileName[0] + ' ' +fileName[1];
					tipe = fileName[2];
					year_dt = fileName[3];
					month_dt = fileName[4];
					day_dt = fileName[5];										
				}   
				
				if(fileName.length == 3){
					pool = fileName[0] + ' ' +fileName[1];
					tipe = fileName[2];
				}
				
				if(tipe === 'driver')
					$("#type_upload").val(1).change();				
				else if(tipe === 'performance')
					$("#type_upload").val(2).change();					
				else if(tipe === 'ks')
					$("#type_upload").val(3).change();					
				else 
					alert('TIPE NOT FOUND!');
				
				switch(pool){
					case 'bekasi a':
						$("#id_pool").val(1).change();					
					break;
					case 'bekasi b':
						$("#id_pool").val(2).change();					
					break;					
					case 'bekasi c':
						$("#id_pool").val(3).change();					
					break;					
					case 'bekasi d':
						$("#id_pool").val(4).change();					
					break;					
					case 'cipendawa':
						$("#id_pool").val(5).change();					
					break;					
					case 'pondok bambu':
						$("#id_pool").val(6).change();					
					break;					
					case 'cipayung':
						$("#id_pool").val(7).change();					
					break;					
					case 'depok':
						$("#id_pool").val(8).change();					
					break;					
					case 'mustika sari':
						$("#id_pool").val(9).change();					
					break;					
					case 'pekapuran':
						$("#id_pool").val(10).change();					
					break;					
					case 'bintaro':
						$("#id_pool").val(15).change();					
					break;					
					case 'ciganjur':
						$("#id_pool").val(16).change();					
					break;					
					case 'jagakarsa':
						$("#id_pool").val(17).change();					
					break;					
					case 'joglo baru':
						$("#id_pool").val(18).change();					
					break;					
					case 'star':
						$("#id_pool").val(19).change();					
					break;					
					case 'joglo lama':
						$("#id_pool").val(20).change();					
					break;					
					case 'ma':
						$("#id_pool").val(21).change();					
					break;					
					case 'mb':
						$("#id_pool").val(22).change();					
					break;					
					case 'mc':
						$("#id_pool").val(23).change();					
					break;					
					case 'tangerang selatan':
						$("#id_pool").val(24).change();					
					break;
					case 'megapool':
						$("#id_pool").val(33).change();					
					break;	
					default:
						alert('POOL NOT FOUND!');
					break;				
				}
				
				if(fileName.length > 3){
					var datetime_upload = year_dt + '-' + month_dt + '-' + day_dt;
					$("#tgl").val(datetime_upload).change();					
				}
				
				console.log(tipe);	

		});
    <!-- PNotify -->
      $(document).ready(function() {
      $('.form_date').datetimepicker({
				todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2
			});
      <?php 
      if(isset($success) && $success === 'false'){
      echo '
        new PNotify({
          title: "Error",
          type: "error",
          text: "Failed!",
          nonblock: {
              nonblock: true
          },
          addclass: "red",
          styling: "bootstrap3"
        });
		';
		}
		if(isset($success) && $success === '1'){
      echo '
        new PNotify({
          title: "Success",
          type: "success",
          text: "",
          nonblock: {
              nonblock: true
          },
          addclass: "green",
          styling: "bootstrap3"
        });
		';
		}
		?>
      });
    </script>
    <!-- /PNotify -->
    <!-- /Datatables -->
