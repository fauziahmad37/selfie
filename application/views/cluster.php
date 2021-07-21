		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Cluster</h2><h3><?php  
          		if(Count($temp) > 0){
					echo '(';          		
          			$found = false;
					foreach((Array) $cluster AS $key => $val){
						if($val['id'] == $temp['cluster']){
							echo $val['name'].', ';
							$found = true;
							break;
						}
					}
					if(!$found) echo 'All Clusters ';
					echo $temp['date'].' to '.$temp['date2'].' at '.$temp['hour'].' - '.$temp['hour2'].' ';
					if($temp['day'] == 0){
						echo 'All Days';
					} else if($temp['day'] == 1){
						echo 'Every Monday';
					} else if($temp['day'] == 2){
						echo 'Every Tuesday';
					} else if($temp['day'] == 3){
						echo 'Every Wednesday';
					} else if($temp['day'] == 4){
						echo 'Every Thursday';
					} else if($temp['day'] == 5){
						echo 'Every Friday';
					} else if($temp['day'] == 6){
						echo 'Every Saturday';
					} else if($temp['day'] == 7){
						echo 'Every Sunday';
					} else if($temp['day'] == 8){
						echo 'Every Weekdays';
					} else if($temp['day'] == 9){
						echo 'Every Weekends';
					}
					echo ')';
          		}?></h3>
				</div>
          	</div>
          </div>
		  <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content2">
                  	<form id="cluster-form" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Cluster'); ?>" method="post">
                      <div class="col-md-4 col-xs-12">
                        <label for="cluster">Cluster</label>
                          <select name="cluster" id="cluster" class="form-control">
                          <?php 
							echo '<option value="0">All Clusters</option>';                          
                          	foreach((Array) $cluster AS $key => $val){
                          		echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
                          	}
                          ?>
                          </select>
                      </div>  
                      <div class="col-md-4 col-xs-12">
                        <label for="day">Day</label>
                          <select name="day" id="day" class="form-control">
							<option value="0">All Days</option>
                          	<option value="1">Monday</option>
                          	<option value="2">Tuesday</option>
                          	<option value="3">Wednesday</option>
                          	<option value="4">Thursday</option>
                          	<option value="5">Friday</option>
                          	<option value="6">Saturday</option>
                          	<option value="7">Sunday</option>
                          	<option value="8">Weekdays</option>
                          	<option value="9">Weekends</option>                          	                          	
                          </select>
                      </div>   
                      <div class="col-md-4 col-xs-12">
						<label for="date">Date From</label>
                          <input id="date" name="date"/>
                        <label for="date2"> To </label>
                          <input id="date2" name="date2"/>  
                        <label for="hour">Hour From</label>
                          <input id="hour" name="hour"/>
                        <label for="hour2"> To </label>
                          <input id="hour2" name="hour2"/>                          
                      </div>                 
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <button type="submit" name="search" value="1" class="btn btn-success">Submit</button>
                        </div>
                    </form>
          		  </div>          
          		</div>          
          	  </div>        
          </div>                                          
		  <div class="row">  
		  <div class="x_panel">
                  <div class="x_content2">                  
                     <div id="map" style="height:500px;border: 2px solid #fff;"></div>
                     <div id="legend" style="font-family: Arial, sans-serif;background: #fff;padding: 10px;margin: 10px;border: 3px solid #000;"><h4>Trips</h4></div>
                  </div>
                </div>
              </div>
          </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		
		<!-- jQuery -->
		<link href="<?php echo base_url('/assets/css/jquery.timepicker.css');?>" rel="stylesheet">	
		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>		
		<script src="<?php echo base_url('/assets/js/jquery.timepicker.min.js');?>"></script>			
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
			var options = {
			  legend: false,
			  responsive: false
			};
		  });
		  $('#date').datetimepicker({todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				format: 'yyyy-m-d'});
		  $('#date2').datetimepicker({todayBtn:  1,
				autoclose: 1,
				startView: 2,
				minView: 2,
				format: 'yyyy-m-d'});				  
		  $('#hour').timepicker();
		  $('#hour2').timepicker();		  
      	  var map;
      	  var data = <?php echo json_encode($data); ?>;
      	  var hexagons = [];
      	  var cluster = [];
      	  <?php
      	  $count = 0;
      	  foreach((Array) $cluster AS $key => $val){
      	  	if($search > 0 && $val['id'] != $search) continue;
      	  	echo "cluster[".$count."] = [];";
      	  	echo "cluster[".$count."].name = '".$val['name']."';";
      	  	echo "cluster[".$count."].ritase = 0;";
      	  	$count++;      	  	      	  	
      	  }
      	  ?>
      	  function initMap() {
			  map = new google.maps.Map(document.getElementById('map'), {
				zoom: 14,
				center: {lat:-6.220254, lng: 106.819844},
				disableDefaultUI: true,
				styles: [
					{
					  featureType: 'poi',
					  stylers: [
					  {color: ''},
					  {visibility: 'off'}]
					},
					{
						"featureType": "transit.station.airport",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"invert_lightness": true
							},
							{
								"gamma": 9
							},
							{
								"hue": "#007700"
							}
						]
					}
				  ]
			  });
			  var radius = 50; //radius in meters
			  
			  <?php 
			  	$i = 0;
			  	foreach((Array) $cluster AS $key => $val){
			  		if($search > 0 && $val['id'] != $search) continue;
			  		echo "var cluster".$i." = new google.maps.LatLng(".$val['lat'].",".$val['lng'].");";
					echo "var countX".$i." = ".$val['countx'].";";			  		
					echo "var countY".$i." = ".$val['county'].";";
					echo "var used".$i." = new Array(".str_replace('}','',str_replace('{','',$val['used'])).");";
					echo "var name".$i." = '".$val['name']."';";
					echo "createHexagonGrid(map, cluster".$i.", used".$i.", name".$i.", radius, countX".$i.", countY".$i.");";					
					$i++;
			  	}
			  ?>
				calculateData();
				drawHexagonGrid();
				drawMapInfo();				
		  }
		  
		  function createHexagonGrid(map,startPosition, arr, name, radius,countX, countY){
				var curPos = startPosition;
				var lastPos = startPosition;
				var width = radius * 2 * Math.sqrt(3)/2 ; 
				var odd = true;
				var ct = 1;
				for(var i = 0;i < countY; i++){		
					for(var j = 0;j< countX; j++){
						for(var x = 0;x < arr.length;x++)
						{
							if(arr[x] == ct)
							{
								createHexagon(map,curPos,radius,name);
								break;
							}
						}
						curPos = google.maps.geometry.spherical.computeOffset(curPos, width,90);   
						ct++;						
					}
					lastPos = google.maps.geometry.spherical.computeOffset(lastPos,width,180);
					if(odd)
						lastPos = google.maps.geometry.spherical.computeOffset(lastPos,0.5*width,90);					 
					else
						lastPos = google.maps.geometry.spherical.computeOffset(lastPos,-0.5*width,90);					 						
					curPos = lastPos;  
					odd = !odd;
				}
			}

			function createHexagon(map,position,radius,name){
				var coordinates = [];
				for(var angle= 0;angle < 360; angle+=60) {
				   coordinates.push(google.maps.geometry.spherical.computeOffset(position, radius, angle));    
				}
  
				// Construct the polygon.
				var polygon = new google.maps.Polygon({
					paths: coordinates,
					strokeColor: '#FF0000',
					strokeOpacity: 1,
					strokeWeight: 1,
					fillColor: '#FF0000',
					fillOpacity: 0.35,
					count: 0,
					name: name
				});
				hexagons.push(polygon);
			}
			
			function calculateData(){
				for(var i = 0;i<data.length;i++){
					for(var j = 0;j< hexagons.length;j++){
						var a = new google.maps.LatLng(data[i].lat, data[i].lng);
						if(google.maps.geometry.poly.containsLocation(a, hexagons[j])){
							hexagons[j].count++;
							for(var b = 0;b<cluster.length;b++){
								if(hexagons[j].name === cluster[b].name){
									cluster[b].ritase++;	
									break;
								}	
							}
							break;
						}
					}
				}
			}
			
			function drawHexagonGrid(){
				var infowindow = new google.maps.InfoWindow({

				});
				for(var i = 0;i<hexagons.length;i++){
					if(hexagons[i].count > 8){
						hexagons[i].fillColor = '#FF0000';
						hexagons[i].strokeColor = '#FF0000';						
					} else if(hexagons[i].count > 6){
						hexagons[i].fillColor = '#FFA000';					
						hexagons[i].strokeColor = '#FFA000';
					} else if(hexagons[i].count > 4){
						hexagons[i].fillColor = '#FFFF00';					
						hexagons[i].strokeColor = '#FFFF00';
					} else if(hexagons[i].count > 2){
						hexagons[i].fillColor = '#A0FF00';					
						hexagons[i].strokeColor = '#A0FF00';
					} else if(hexagons[i].count > 0){
						hexagons[i].fillColor = '#00FF00';					
						hexagons[i].strokeColor = '#00FF00';
					}
					if(hexagons[i].count > 0){
						hexagons[i].setMap(map);
						hexagons[i].addListener('click', function(event) {
							infowindow.setContent('' + this.count);
							infowindow.setPosition(event.latLng);
							infowindow.open(map);
						});
					}	
				}
			}
			
			function drawMapInfo(){
				var legend = document.getElementById('legend');
				  for (var key in cluster) {
					var type = cluster[key];
					var name = type.name;
					var ritase = type.ritase;
					var div = document.createElement('div');
					div.innerHTML = name + ' : ' + ritase;
					legend.appendChild(div);
				  }

			  map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);
			}
		</script>
		<?php
		if(Count($temp) > 0){
			echo '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhkTdtvrmyGJv1JNznhFvVOLPv1DYwhv4&callback=initMap&libraries=geometry"></script>';
		}
		?>