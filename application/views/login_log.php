		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Login Log</h2>                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="datatable" class="table table-striped" style="width:100%">
                    <thead>
                    	<tr>
                    		<th>Username</th>
                    		<th>IP</th>                     		
                    		<th>User Agent</th>
                    		<th>Browser</th>
                    		<th>Datetime</th>
                    	</tr>
                    </thead>
                    <tbody>
                    <?php              	
                    	foreach ((Array) $data AS $key => $val) { 
                    		echo '<tr><td>'.$val['username'].'</td>'.
                    		'<td>'.$val['ip'].'</td>'.                 		
                    		'<td>'.$val['user_agent'].'</td>'.          
                    		'<td>'.$val['browser'].'</td>'.
                    		'<td>'.$val['dt'].'</td></tr>';
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
        "order": [[ 4, "desc" ]],
        "pageLength": 25
    } );
        });
    </script>
    <!-- /Datatables -->
