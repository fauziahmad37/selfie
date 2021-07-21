		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
		  
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>List Activity</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="datatable" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>ID</th>              		
                    		<th>User Name</th>
                    		<th>Pool</th>
                    		<th>Case</th>                    		
                    		<th>Key</th>   
                    		<th>Tanggal Proses</th>
                    	</tr>
                    </thead>
                    <tbody>
                    <?php              	
                    	foreach ((Array) $data AS $key => $val) { 
                    		echo 
							'<tr><td>'.$val['id'].'</td>'. 
							'<td>'.$val['name_user'].'</td>'.                 		
                    		'<td>'.$val['id_pool_simtax'].'</td>'.
                    		'<td>'.$val['name_case'].'</td>'.
                    		'<td>'.$val['key_case'].'</td>'.                    		                    		
                    		'<td>'.date('Y-m-d H:i:s', strtotime($val['tanggal_proses'])).'</td>'.        		
                    		'</tr>';
                    	}
                    ?>
                    </tbody>
                  </table>
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
    <script>
      $(document).ready(function() {
        $('#datatable').dataTable( {
        "order": [[ 0, "DESC" ]],
bFilter: false, paging: false, bInfo: false
    } );
        } );
    </script>
    <!-- /Datatables -->
