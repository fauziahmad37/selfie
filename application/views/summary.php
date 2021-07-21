		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2 id="text_title">Summary Quarter to Date</h2>
          	    </div>
            </div>
          <div class="text-center" id="loading" style="margin-top:150px;">
          	<img src="<?php echo base_url('/assets/images/loading.gif');?>" />
          </div>
          </div>
          <div class="" role="tabpanel" data-example-id="togglable-tabs" id="tab-result">
			  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
				<li role="presentation" class="active"><a href="#tab_content_standings" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Standings</a>
				</li>
				<li role="presentation" class=""><a href="#tab_performance" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Performances</a>
				</li>
			  </ul>
			  <div id="myTabContent" class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="tab_content_standings" aria-labelledby="home-tab">
		 		  <div class="row" id="data_standings"></div>
		 		</div>  
		 		<div role="tabpanel" class="tab-pane fade in" id="tab_performance" aria-labelledby="home-tab">  
        		  <div class="row" id="data_pool">
					  <script>
						var pools = <?php echo json_encode($pools); ?>;
					  </script>
					  <?php 
					  foreach((Array) $pools AS $key => $val){
							echo '<div class="col-md-6 col-sm-12 col-xs-12" style="color:white">'.
								'<div class="x_panel">'.
									'<div class="x_title" style="background-color:'.($val['pool_area'] === '1' ? '#ff3300' : 
									($val['pool_area'] === '2' ? '#3366ff' : 
									($val['pool_area'] === '4' ? '#ff9966' : 'black'))).'">'.
										'<h2>'.$val['name'].'</h2>'.                 
										'<div class="clearfix"></div>'.
									'</div>'.
									'<div class="x_content" style="background-color:"0xffffff">'.
										'<div class="col-md-6 col-sm-12 col-xs-12" style="color:white">'.
											'<canvas id="canvas_'.$val['id'].'"></canvas>'.
										'</div>'.
										'<div class="col-md-6 col-sm-12 col-xs-12" style="color:white">'.
											'<div id="table_'.$val['id'].'"></div>'.
										'</div>'.
									'</div>'.
								'</div>'.
							'</div>';               
						}
						?>
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
		<!-- Chart.js -->
		<script src="<?php echo base_url('/assets/js/Chart.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js');?>"></script>
		<!-- morris.js -->
		<script src="<?php echo base_url('/assets/js/raphael.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/morris.min.js');?>"></script>
		
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>

		<!-- Doughnut Chart -->
		<script>
		$(document).ready(function(){
			$("#tab-result").hide();								
		});
		  $(function() {
		  function update() {
			  $.getJSON(<?php echo "'".site_url('/Summary/get_data/')."'";?>, 
			  function(json){
				$("#tab-result").show();			  
			  	fill_data(json);
				$("#loading").hide();								
			});
		  }
			update();
		});
		
		function numberWithCommas(x) {
			if(x === null) x = 0;
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}
		
		function fill_data(json){
			$('#data_standings').empty();					
			var reguler = [];
			var reguler2 = [];
			var eagle = [];
			var tiara = [];			
			$.each(json, function (i, pool) {
				$('#table_'+pool.id_pool).empty();
// 				console.info(pool);
				if(pool.target_ops === null) return;
				if(pool.pool_area == 1) reguler.push(pool);
				if(pool.pool_area == 2) reguler2.push(pool);
				if(pool.pool_area == 4) eagle.push(pool);
				if(pool.pool_area == 5) tiara.push(pool);												
				var ctx = document.getElementById("canvas_"+pool.id_pool);
				var div = '<table class="table table-striped text-center" style="color:#73879C;width:100%"><thead><tr><td>KPI</td><td>Target</td><td>Actual</td><td>Achieved</td></thead></tr><tbody>';
				if(pool.pool_area < 3){
					var data = {
						labels: ["Utilization", "HK", "ARPU", "Trips"],
						fontSize : 20,
						datasets: [{
							backgroundColor: "rgba(3, 88, 106, 0.2)",
							borderColor: "rgba(3, 88, 106, 0.80)",
							pointBorderColor: "rgba(3, 88, 106, 0.80)",
							pointBackgroundColor: "rgba(3, 88, 106, 0.80)",
							pointHoverBackgroundColor: "#fff",
							pointHoverBorderColor: "rgba(220,220,220,1)",
							data: [(pool.graph_ops).toFixed(2), (pool.graph_hk_car).toFixed(2), (pool.graph_arpu).toFixed(2), (pool.graph_rit).toFixed(2)]
						}]
					};
					div = div + '<tr><td>Utilization<br/>('+pool.ops_pct+'%)</td><td>'+numberWithCommas(pool.cal_target_ops)+'<br/>('+pool.target_ops_pct+'%)</td><td>'+numberWithCommas(pool.act_ops)+' (' +pool.act_ops_pct+'%)</td><td>'+(pool.ops).toFixed(2)+'%</td></tr>';
					div = div + '<tr><td>HK<br/>('+pool.hk_pct+'%)</td><td>'+numberWithCommas(pool.target_car)+'</td><td>'+numberWithCommas(pool.act_car)+'</td><td>'+(pool.hk_car).toFixed(2)+'%</td></tr>';					
					div = div + '<tr><td>ARPU<br/>('+pool.arpu_pct+'%)</td><td>'+numberWithCommas(pool.target_arpu)+'</td><td>'+numberWithCommas(pool.act_arpu)+'</td><td>'+(pool.arpu).toFixed(2)+'%</td></tr>';
					div = div + '<tr><td>Trips<br/>('+pool.rit_pct+'%)</td><td>'+numberWithCommas(pool.target_rit)+'<br/>(min '+pool.target_min_rit+')</td><td>'+numberWithCommas(pool.act_rit)+'</td><td>'+(pool.rit).toFixed(2)+'%</td></tr>';
					div = div + '<tr><td colspan="2">Overall</td><td colspan="2">'+(pool.overall).toFixed(2)+'%</td></tr>';
				} else {
					var data = {
						labels: ["Utilization", "HK", "ARPU", "Trips"/*, "HK Car"*/],
						fontSize : 20,
						datasets: [{
							backgroundColor: "rgba(3, 88, 106, 0.2)",
							borderColor: "rgba(3, 88, 106, 0.80)",
							pointBorderColor: "rgba(3, 88, 106, 0.80)",
							pointBackgroundColor: "rgba(3, 88, 106, 0.80)",
							pointHoverBackgroundColor: "#fff",
							pointHoverBorderColor: "rgba(220,220,220,1)",
							data: [(pool.graph_ops).toFixed(2), (pool.graph_hk_driver).toFixed(2), (pool.graph_rev).toFixed(2), (pool.graph_rit).toFixed(2)/*, (pool.graph_hk_car).toFixed(2)*/]
						}]
					};
					div = div + '<tr><td>Utilization<br/>('+pool.ops_pct+'%)</td><td>'+numberWithCommas(pool.cal_target_ops)+'<br/>('+pool.target_ops_pct+'%)</td><td>'+numberWithCommas(pool.act_ops)+' (' +pool.act_ops_pct+'%)</td><td>'+(pool.ops).toFixed(2)+'%</td></tr>';
					div = div + '<tr><td>HK<br/>('+pool.hk_pct+'%)</td><td>'+numberWithCommas(pool.target_driver)+'</td><td>'+numberWithCommas(pool.act_driver)+'</td><td>'+(pool.hk_driver).toFixed(2)+'%</td></tr>';
					div = div + '<tr><td>ARPU<br/>('+pool.arpu_pct+'%)</td><td>'+numberWithCommas(pool.target_rev)+'</td><td>'+numberWithCommas(pool.act_rev)+'</td><td>'+(pool.rev).toFixed(2)+'%</td></tr>';
					div = div + '<tr><td>Trips<br/>('+pool.rit_pct+'%)</td><td>'+numberWithCommas(pool.target_rit)+'<br/>(min '+pool.target_min_rit+')</td><td>'+numberWithCommas(pool.act_rit)+'</td><td>'+(pool.rit).toFixed(2)+'%</td></tr>';
					div = div + '<tr><td colspan="2">Overall</td><td colspan="2">'+(pool.overall).toFixed(2)+'%</td></tr>';
				}
				div = div + '</tbody></table>';									
				$('#table_'+pool.id_pool).append(div);				
				var canvasRadar = new Chart(ctx, {
					type: 'radar',
					data: data,
					options: {
						scale: {
							ticks: {
								min: 0,
								max: 100,
								fontSize : 10,
							},
							pointLabels:{
								fontSize: 15,
							},
						},
						legend : {
							display : false
						},
					}
				});
			});	
			
			function compare(a,b) {
			  if (a.overall < b.overall)
				return 1;
			  if (a.overall > b.overall)
				return -1;
			  return 0;
			}
			
			reguler = reguler.sort(compare);
			reguler2 = reguler2.sort(compare);
			eagle = eagle.sort(compare);
			tiara = tiara.sort(compare);
			
			var tab = '<div class="col-md-3 col-sm-6 col-xs-12"><div class="x_panel"><div class="x_title"><h2>Reguler</h2><div class="clearfix"></div></div><div class="x_content">'+
				'<table class="table table-striped text-center" style="color:#73879C;width:100%">'+
				'<thead><tr><td>No</td><td>Pool</td><td>Overall</td></thead></tr><tbody>';
			
			var count = 1;
			$.each(reguler, function (i, pool) {
				tab = tab + '<tr '+(count <= 3 ? ' style="color:#52ed00"' : (count > reguler.length - 3 ? ' style="color:red"' : ''))+'><td>'+count+'</td><td>'+pool.name+'</td><td>'+(pool.overall).toFixed(2)+'%</td></tr>';
				count++;
			});
			
			tab = tab + '</tbody></table></div></div></div>';
			
			var tab = tab + '<div class="col-md-3 col-sm-6 col-xs-12"><div class="x_panel"><div class="x_title"><h2>Reguler 2</h2><div class="clearfix"></div></div><div class="x_content">'+
				'<table class="table table-striped text-center" style="color:#73879C;width:100%">'+
				'<thead><tr><td>No</td><td>Pool</td><td>Overall</td></thead></tr><tbody>';
			
			var count = 1;
			$.each(reguler2, function (i, pool) {
				tab = tab + '<tr '+(count <= 3 ? ' style="color:#52ed00"' : (count > reguler2.length - 3 ? ' style="color:red"' : ''))+'><td>'+count+'</td><td>'+pool.name+'</td><td>'+(pool.overall).toFixed(2)+'%</td></tr>';
				count++;
			});
			
			tab = tab + '</tbody></table></div></div></div>';
			
			var tab = tab + '<div class="col-md-3 col-sm-6 col-xs-12"><div class="x_panel"><div class="x_title"><h2>Eagle</h2><div class="clearfix"></div></div><div class="x_content">'+
				'<table class="table table-striped text-center" style="color:#73879C;width:100%">'+
				'<thead><tr><td>No</td><td>Pool</td><td>Overall</td></thead></tr><tbody>';
			
			var count = 1;
			$.each(eagle, function (i, pool) {
				tab = tab + '<tr '+(count <= 3 ? ' style="color:#52ed00"' : (count > eagle.length - 3 ? ' style="color:red"' : ''))+'><td>'+count+'</td><td>'+pool.name+'</td><td>'+(pool.overall).toFixed(2)+'%</td></tr>';
				count++;
			});
			
			tab = tab + '</tbody></table></div></div></div>';
			
			var tab = tab + '<div class="col-md-3 col-sm-6 col-xs-12"><div class="x_panel"><div class="x_title"><h2>Tiara</h2><div class="clearfix"></div></div><div class="x_content">'+
				'<table class="table table-striped text-center" style="color:#73879C;width:100%">'+
				'<thead><tr><td>No</td><td>Pool</td><td>Overall</td></thead></tr><tbody>';
			
			var count = 1;
			$.each(tiara, function (i, pool) {
				tab = tab + '<tr><td>'+count+'</td><td>'+pool.name+'</td><td>'+(pool.overall).toFixed(2)+'%</td></tr>';
				count++;
			});
			
			tab = tab + '</tbody></table></div></div></div>';
			
			$('#data_standings').append(tab);		
		}
		</script>