		<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
          	<div class="col-md-12 col-sm-12 col-xs-12 tile">
          		<div class="col-md-8 col-sm-8 col-xs-12">
          		<h2>Map - <?php $datetime = new DateTime($date); echo $datetime->format('l, j F Y @ H:i:s'); ?></h2>
				</div>
          	</div>
          </div>
		  <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content2">
                     <div id="map" style="height:600px;border: 2px solid #fff;"></div>
                     <div id="legend" style="font-family: Arial, sans-serif;background: #fff;padding: 10px;margin: 10px;border: 3px solid #000;"><h4>Pool & Shelter</h4></div>
                     <div id="legend2" style="font-family: Arial, sans-serif;background: #fff;padding: 10px;margin: 10px;border: 3px solid #000;"><h4>Taxi</h4></div>
                  </div>
                </div>
                <div class="x_panel">
                  <div class="x_content2">
                     <div id="leftControl" style="border: 2px solid #fff;"></div>
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
			var options = {
			  legend: false,
			  responsive: false
			};
		  });
      	  var map;
      	  var icons, icons2;
      	  var markers = [];
      	  var markersShelter = [];
      	  var markersTaxi = [];
      	  var dataPoolTaxi = [];
		  var markersShelterPremium =[];
      	  
      	  for(var i = 0;i<=58;i++){
      	  	markersTaxi[i] = [];
      	  	dataPoolTaxi[i] = [];
      	  }
      	  
      	  function setMapOnAll(map, tipe = 1) {
      	  	if(tipe == 1){
				for (var i = 0; i < markers.length; i++) {
				  markers[i].setMap(map);
				}
			} else if(tipe == 2){
				for (var i = 0; i < markersShelter.length; i++) {
				  markersShelter[i].setMap(map);
				}
			} else if(tipe == 3){
				for (var i = 0; i < markersTaxi.length; i++) {
					for (var j = 0; j < markersTaxi[i].length; j++) {	
					  markersTaxi[i][j].setMap(map);
					}
				}
			}else if(tipe == 4){
				for (var i = 0; i < markersShelterPremium.length; i++) {
				  markersShelterPremium[i].setMap(map);
				}
			}
		  }
		  
		  function showTaxi(id){
			  if(id == 400) { //EAGLE
			  	dataPoolTaxi[400] = [];
			  	dataPoolTaxi[400]['assignment'] = 0;
			  	dataPoolTaxi[400]['count'] = 0;
			  	dataPoolTaxi[400]['vacant'] = 0;
			  	dataPoolTaxi[400]['hired'] = 0;
			  	dataPoolTaxi[400]['shelter'] = 0;
			  	dataPoolTaxi[400]['inactive'] = 0;
			  	dataPoolTaxi[400]['board'] = 0;
			  	dataPoolTaxi[400]['na'] = 0;			  				  				  				  				  				  				  	
				for (var i = 20;i<=26;i++){
					if(!dataPoolTaxi[i]['count']) continue;
					for (var j = 0; j < markersTaxi[i].length; j++) {	
					  markersTaxi[i][j].setMap(map);
					}
				  	dataPoolTaxi[400]['assignment'] += dataPoolTaxi[i]['assignment'];
				  	dataPoolTaxi[400]['count'] += dataPoolTaxi[i]['count'];
				  	dataPoolTaxi[400]['vacant'] += dataPoolTaxi[i]['vacant'];
				  	dataPoolTaxi[400]['hired'] += dataPoolTaxi[i]['hired'];
				  	dataPoolTaxi[400]['shelter'] += dataPoolTaxi[i]['shelter'];
				  	dataPoolTaxi[400]['inactive'] += dataPoolTaxi[i]['inactive'];
				  	dataPoolTaxi[400]['board'] += dataPoolTaxi[i]['board'];
				  	dataPoolTaxi[400]['na'] += dataPoolTaxi[i]['na'];		  					  					  					  					  					  					  					  							
				}
				for (var i = 28;i<=47;i++){
					if(!dataPoolTaxi[i]['count']) continue;				
					for (var j = 0; j < markersTaxi[i].length; j++) {	
					  markersTaxi[i][j].setMap(map);
					}
				  	dataPoolTaxi[400]['assignment'] += dataPoolTaxi[i]['assignment'];
				  	dataPoolTaxi[400]['count'] += dataPoolTaxi[i]['count'];
				  	dataPoolTaxi[400]['vacant'] += dataPoolTaxi[i]['vacant'];
				  	dataPoolTaxi[400]['hired'] += dataPoolTaxi[i]['hired'];
				  	dataPoolTaxi[400]['shelter'] += dataPoolTaxi[i]['shelter'];
				  	dataPoolTaxi[400]['inactive'] += dataPoolTaxi[i]['inactive'];
				  	dataPoolTaxi[400]['board'] += dataPoolTaxi[i]['board'];
				  	dataPoolTaxi[400]['na'] += dataPoolTaxi[i]['na'];		  					  					  					  					  					  					  					  							
				}
			  } else if(id == 401) { //EAGLE
			  	dataPoolTaxi[401] = [];
			  	dataPoolTaxi[401]['assignment'] = 0;
			  	dataPoolTaxi[401]['count'] = 0;
			  	dataPoolTaxi[401]['vacant'] = 0;
			  	dataPoolTaxi[401]['hired'] = 0;
			  	dataPoolTaxi[401]['shelter'] = 0;
			  	dataPoolTaxi[401]['inactive'] = 0;
			  	dataPoolTaxi[401]['board'] = 0;
			  	dataPoolTaxi[401]['na'] = 0;			  				  				  				  				  				  				  	
				for (var i = 31;i<=32;i++){
					if(!dataPoolTaxi[i]['count']) continue;
					for (var j = 0; j < markersTaxi[i].length; j++) {	
					  markersTaxi[i][j].setMap(map);
					}
				  	dataPoolTaxi[401]['assignment'] += dataPoolTaxi[i]['assignment'];
				  	dataPoolTaxi[401]['count'] += dataPoolTaxi[i]['count'];
				  	dataPoolTaxi[401]['vacant'] += dataPoolTaxi[i]['vacant'];
				  	dataPoolTaxi[401]['hired'] += dataPoolTaxi[i]['hired'];
				  	dataPoolTaxi[401]['shelter'] += dataPoolTaxi[i]['shelter'];
				  	dataPoolTaxi[401]['inactive'] += dataPoolTaxi[i]['inactive'];
				  	dataPoolTaxi[401]['board'] += dataPoolTaxi[i]['board'];
				  	dataPoolTaxi[401]['na'] += dataPoolTaxi[i]['na'];		  					  					  					  					  					  					  					  							
				}
			  } 
			  else {
				for (var j = 0; j < markersTaxi[id].length; j++) {	
								  markersTaxi[id][j].setMap(map);
				    		
				}
			  }
			var legend2 = document.getElementById('legend2');
			while (legend2.firstChild) {
				legend2.removeChild(legend2.firstChild);
			}
			var div = document.createElement('div');
			div.innerHTML = '<h4>Taxi</h4>';
			legend2.appendChild(div);
			  for (var key in icons2) {
				var type = icons2[key];
				var name;
				if(key === 'installed')
				 continue;
				if(key === 'auto_login')
				  name = "Auto Login : " + dataPoolTaxi[id]['assignment'];
				if(key === 'manual_login')
				  name = "Manual Login : " + (dataPoolTaxi[id]['count'] - dataPoolTaxi[id]['assignment']);
				if(key === 'total_login')
				  name = 'Total Login : ' + dataPoolTaxi[id]['count'];
				if(key === 'vacant')
				  name = 'Vacant : ' + dataPoolTaxi[id]['vacant'];
				if(key === 'reserved')
				  name =  'Reserved : ' + dataPoolTaxi[id]['hired'];
				if(key === 'sheltered')
				  name = 'Sheltered : ' + dataPoolTaxi[id]['shelter'];
				if(key === 'inactive')
				  name = 'Inactive : ' + dataPoolTaxi[id]['inactive'];
				if(key === 'hired')
				  name = 'Hired : ' + dataPoolTaxi[id]['board'];
				if(key === 'na')
				  name =  'N/A : ' + dataPoolTaxi[id]['na'];
				var icon = type.icon;
				var div = document.createElement('div');
				div.innerHTML = '<img src="' + icon + '"> ' + name;
				legend2.appendChild(div);
			  }
		  }
      	  
      	  function addMarker(location, icon, title) {
			var marker = new google.maps.Marker({
			  position: location,
			  map: map,
			  icon: icon,
			  title: title
			});
			var infowindow = new google.maps.InfoWindow({
			content: title
		  });
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			  });
			markers.push(marker);
		  }
		  
		  function addMarkerShelter(location, icon, title) {
			var marker = new google.maps.Marker({
			  position: location,
			  map: map,
			  icon: icon,
			  title: title
			});
			var infowindow = new google.maps.InfoWindow({
			content: title
		  });
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			  });
			markersShelter.push(marker);
		  }
		  
		  function addMarkerShelterPremium(location, icon, title) {
			var marker = new google.maps.Marker({
			  position: location,
			  map: map,
			  icon: icon,
			  title: title
			});
			var infowindow = new google.maps.InfoWindow({
			content: title
		  });
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			  });
			markersShelterPremium.push(marker);
		  }
		  
		  function addMarkerTaxi(location, icon, title, id) {
			var marker = new google.maps.Marker({
			  position: location,
			  map: null,
			  icon: icon,
			  title: title
			});
			var infowindow = new google.maps.InfoWindow({
			content: title
		  });
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			  });
			markersTaxi[id].push(marker);
		  }

		  // Removes the markers from the map, but keeps them in the array.
		  function clearMarkers(tipe = 1) {
			setMapOnAll(null, tipe);
		  }

		  // Shows any markers currently in the array.
		  function showMarkers(tipe = 1) {
			setMapOnAll(map, tipe);
		  }

      	  
		  function initMap() {
			  map = new google.maps.Map(document.getElementById('map'), {
				zoom: 12,
				center: {lat: -6.1934621, lng: 106.8153368},
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
			  // Create the DIV to hold the control and call the CenterControl()
			// constructor passing in this DIV.
			var centerControlDiv = document.createElement('div');
			var leftControlDiv = $("#leftControl");
// 			var leftControlDiv2 = document.createElement('div');						
			
			// Set CSS for the control border.
			var controlUI = document.createElement('div');
			controlUI.style.backgroundColor = '#fff';
			controlUI.style.border = '2px solid #fff';
			controlUI.style.borderRadius = '3px';
			controlUI.style.cursor = 'pointer';
			controlUI.style.textAlign = 'center';
			controlUI.style.float = 'left';			
			centerControlDiv.appendChild(controlUI);
			
			var controlText = document.createElement('div');
			controlText.style.color = 'rgb(25,25,25)';
			controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
			controlText.style.fontSize = '16px';
			controlText.style.lineHeight = '38px';
			controlText.style.paddingLeft = '5px';
			controlText.style.paddingRight = '5px';
			controlText.innerHTML = 'Show Traffic';
			controlUI.appendChild(controlText);
			
			var controlUI2 = document.createElement('div');
			controlUI2.style.backgroundColor = '#fff';
			controlUI2.style.border = '2px solid #fff';
			controlUI2.style.borderRadius = '3px';
			controlUI2.style.cursor = 'pointer';
			controlUI2.style.textAlign = 'center';
			controlUI2.style.marginLeft = '5px';
			controlUI2.style.float = 'left';			
			centerControlDiv.appendChild(controlUI2);
			
			var controlText2 = document.createElement('div');
			controlText2.style.color = 'rgb(25,25,25)';
			controlText2.style.fontFamily = 'Roboto,Arial,sans-serif';
			controlText2.style.fontSize = '16px';
			controlText2.style.lineHeight = '38px';
			controlText2.style.paddingLeft = '5px';
			controlText2.style.paddingRight = '5px';
			controlText2.innerHTML = 'Hide Pools';
			controlUI2.appendChild(controlText2);
			
			var controlUI3 = document.createElement('div');
			controlUI3.style.backgroundColor = '#fff';
			controlUI3.style.border = '2px solid #fff';
			controlUI3.style.borderRadius = '3px';
			controlUI3.style.cursor = 'pointer';
			controlUI3.style.textAlign = 'center';
			controlUI3.style.marginLeft = '5px';
			controlUI3.style.float = 'left';			
			centerControlDiv.appendChild(controlUI3);
			
			var controlText3 = document.createElement('div');
			controlText3.style.color = 'rgb(25,25,25)';
			controlText3.style.fontFamily = 'Roboto,Arial,sans-serif';
			controlText3.style.fontSize = '16px';
			controlText3.style.lineHeight = '38px';
			controlText3.style.paddingLeft = '5px';
			controlText3.style.paddingRight = '5px';
			controlText3.innerHTML = 'Hide Shelters';
			controlUI3.appendChild(controlText3);
			
			var controlUI4 = document.createElement('div');
			controlUI4.style.backgroundColor = '#fff';
			controlUI4.style.border = '2px solid #fff';
			controlUI4.style.borderRadius = '3px';
			controlUI4.style.cursor = 'pointer';
			controlUI4.style.textAlign = 'center';
			controlUI4.style.marginLeft = '5px';
			controlUI4.style.float = 'left';			
			centerControlDiv.appendChild(controlUI4);
			
			var controlText4 = document.createElement('div');
			controlText4.style.color = 'rgb(25,25,25)';
			controlText4.style.fontFamily = 'Roboto,Arial,sans-serif';
			controlText4.style.fontSize = '16px';
			controlText4.style.lineHeight = '38px';
			controlText4.style.paddingLeft = '5px';
			controlText4.style.paddingRight = '5px';
			controlText4.innerHTML = 'Show Taxis';
			controlUI4.appendChild(controlText4);
			
			var controlUI5 = document.createElement('div');
			controlUI5.style.backgroundColor = '#fff';
			controlUI5.style.border = '2px solid #fff';
			controlUI5.style.borderRadius = '3px';
			controlUI5.style.cursor = 'pointer';
			controlUI5.style.textAlign = 'center';
			controlUI5.style.marginLeft = '5px';
			controlUI5.style.float = 'left';			
			centerControlDiv.appendChild(controlUI5);
			
			var controlText5 = document.createElement('div');
			controlText5.style.color = 'rgb(25,25,25)';
			controlText5.style.fontFamily = 'Roboto,Arial,sans-serif';
			controlText5.style.fontSize = '16px';
			controlText5.style.lineHeight = '38px';
			controlText5.style.paddingLeft = '5px';
			controlText5.style.paddingRight = '5px';
			controlText5.innerHTML = 'Hide Premium Shelters';
			controlUI5.appendChild(controlText5);
			
			centerControlDiv.index = 1;
			leftControlDiv.index = 1;
			map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
			
			var trafficLayer = new google.maps.TrafficLayer();
			  trafficLayer.setMap(null);
			  
			var isTrafficOn = false;
			var isPoolsOn = true;	
			var isSheltersOn = true;	
			var isTaxisOn = false;	
			var isSheltersPremiumOn = true;			
			controlUI.addEventListener('click', function() {
				if(isTrafficOn) {
					trafficLayer.setMap(null);
					controlText.innerHTML = 'Show Traffic';
				}
				else  {
					trafficLayer.setMap(map);
					controlText.innerHTML = 'Hide Traffic';
				}
				isTrafficOn = !isTrafficOn;
			});
			
			controlUI2.addEventListener('click', function() {
				if(isPoolsOn) {
					clearMarkers();
					controlText2.innerHTML = 'Show Pools';
				}
				else  {
					showMarkers();
					controlText2.innerHTML = 'Hide Pools';
				}
				isPoolsOn = !isPoolsOn;
			});
			
			controlUI3.addEventListener('click', function() {
				if(isSheltersOn) {
					clearMarkers(2);
					controlText3.innerHTML = 'Show Shelters';
				}
				else  {
					showMarkers(2);
					controlText3.innerHTML = 'Hide Shelters';
				}
				isSheltersOn = !isSheltersOn;
			});
			
			controlUI4.addEventListener('click', function() {
				if(isTaxisOn) {
					clearMarkers(3);
					controlText4.innerHTML = 'Show Taxis';
					
					var legend2 = document.getElementById('legend2');
					while (legend2.firstChild) {
						legend2.removeChild(legend2.firstChild);
					}
					var div = document.createElement('div');
					div.innerHTML = '<h4>Taxi</h4>';
					legend2.appendChild(div);
					for (var key in icons2) {
						var type = icons2[key];
						var name = type.name;
						var icon = type.icon;
						var div = document.createElement('div');
						div.innerHTML = '<img src="' + icon + '"> ' + name;
						legend2.appendChild(div);
					  }
				}
				else  {
					showMarkers(3);
					controlText4.innerHTML = 'Hide Taxis';					
				}
				isTaxisOn = !isTaxisOn;
			});
			
			controlUI5.addEventListener('click', function() {
				if(isSheltersPremiumOn) {
					clearMarkers(4);
					controlText5.innerHTML = 'Show Premium Shelters';
				}
				else  {
					showMarkers(4);
					controlText5.innerHTML = 'Hide Premium Shelters';
				}
				isSheltersPremiumOn = !isSheltersPremiumOn;
			});
			
			<?php
			$arrMaps = array(
				"'".base_url('/assets/images/shelter.png')."'",
				"'".base_url('/assets/images/reguler.png')."'",
				"'".base_url('/assets/images/reguler2.png')."'",
				"'".base_url('/assets/images/reguler.png')."'",
				"'".base_url('/assets/images/eagle.png')."'",				
				"'".base_url('/assets/images/tiara.png')."'",
				"'".base_url('/assets/images/cab_inactive.png')."'",
				"'".base_url('/assets/images/cab_vacant.png')."'",
				"'".base_url('/assets/images/cab_hired.png')."'",
				"'".base_url('/assets/images/cab_shelter.png')."'",
				"'".base_url('/assets/images/cab_board.png')."'",
				"'".base_url('/assets/images/shelter_premium.png')."'"				
			);
			$reguler1 = 0;
			$reguler2 = 0;
			$reguler3 = 0;
			$reguler4 = 0;									
			$eagle = 0;			
			$tiara = 0;			
			foreach((Array) $data['pool'] as $key => $val){
				echo "var loc = {lat : ".$val['lat'].", lng : ".$val['lng']."};";
				echo "var icon = ".$arrMaps[($val['pool_area'] <= 5 ? $val['pool_area'] : ($val['pool_area'] - 5))].";";
				echo "var title = '".$val['name']."';";
				echo "addMarker(loc, icon, title);";
				if($val['pool_area'] == 1)
					$reguler1++;
				else if($val['pool_area'] == 2)
					$reguler2++;
				else if($val['pool_area'] == 4)
					$eagle++;
				else if($val['pool_area'] == 5)
					$tiara++;
				else if($val['pool_area'] == 6)
					$reguler3++;
				else if($val['pool_area'] == 7)
					$reguler4++;															
			}
			
			foreach((Array) $data['shelter'] as $key => $val){
				echo "var loc = {lat : ".$val['lat'].", lng : ".$val['lng']."};";
				echo "var icon = ".$arrMaps[0].";";
				echo "var title = '".$val['name']."';";
				echo "addMarkerShelter(loc, icon, title);";
			}
			
			foreach((Array) $data['shelter_premium'] as $key => $val){
				echo "var loc = {lat : ".$val['lat'].", lng : ".$val['lng']."};";
				echo "var icon = ".$arrMaps[11].";";
				echo "var title = '".$val['name']."';";
				echo "addMarkerShelterPremium(loc, icon, title);";
			}
			
			
			
			$count = 0;
			$na = 0;
			$inactive = 0;
			$vacant = 0;
			$hired = 0;		
			$shelter = 0;
			$board = 0;	
			echo "var image;";
			$id = 0;
			$assignment = 0;
			for($ct = 1;$ct <= 65;$ct++){	
				$pool_assignment = 0;
				$pool_na = 0;
				$pool_inactive = 0;
				$pool_vacant = 0;
				$pool_shelter = 0;
				$pool_hired = 0;																									
				$pool_board = 0;
				$pool_count = 0;				
				foreach((Array) $data[$ct] as $key => $val){
					$count++;
					$pool_count++;
					$str = $val['assignment_code'];
					if (!$str || 0 === strlen($str)) {
			
					} else {
						$assignment++;
						$pool_assignment++;
					}
					if ($val['last_location_time'] < $val['access_time']) {
						$na++;
						$pool_na++;
					} else {
						if (isset($val['lat']) && isset($val['lng'])) {
							//Marker has not yet been made (and there's enough data to create one).
							echo "var loc = {lat : ".$val['lat'].", lng : ".$val['lng']."};";
							//Create marker
							$d = $val['last_location_time'] + 300;
							$now = strtotime(date('Y-m-d H:i:s'));
							echo "\nvar title = '<b>".$val['reg_no']."</b><br/>".(isset($val['name']) ? str_replace("'","",$val['name']) : "")."".(isset($val['mobile_no']) ? " (".str_replace("'","",$val['mobile_no']).")" : '')."<br/>device phone : ".(isset($val['msisdn']) ? $val['msisdn'] : "")."<br/>".
							($val['hired_status'] == 1 ? "Vacant" : ($val['hired_status'] == 2 ? "Hired" : ($val['hired_status'] == 3 ? "Shelter" : "Board")))."<br/>".(date('Y-m-d H:i:s', strtotime($val['last_location_update'])))."';";
							if($d < $now) {
								echo "image = ".$arrMaps[6].";";
								$inactive++;
								$pool_inactive++;
							} else {
								if ($val['hired_status']==1) {
									echo "image = ".$arrMaps[7].";";
									$vacant++;
									$pool_vacant++;
								} else if ($val['hired_status']==2) {
									echo "image = ".$arrMaps[8].";";
									$hired++;
									$pool_hired++;
								} else if ($val['hired_status']==3) {
									echo "image = ".$arrMaps[9].";";
									$shelter++;
									$pool_shelter++;									
								} else if ($val['hired_status']==4) {
									echo "image = ".$arrMaps[10].";";
									$board++;
									$pool_board++;
								} else if ($val['hired_status']==5) {
									echo "image = ".$arrMaps[10].";";
									$board++;
									$pool_board++;
								}
							}
							echo "addMarkerTaxi(loc, image, title, ".($id).");";
						}
					}
				}
				if(Count($data[$ct])){
					echo "dataPoolTaxi[".$id."]['count'] = ".$pool_count.";";
					echo "dataPoolTaxi[".$id."]['assignment'] = ".$pool_assignment.";";
					echo "dataPoolTaxi[".$id."]['na'] = ".$pool_na.";";
					echo "dataPoolTaxi[".$id."]['vacant'] = ".$pool_vacant.";";
					echo "dataPoolTaxi[".$id."]['inactive'] = ".$pool_inactive.";";
					echo "dataPoolTaxi[".$id."]['hired'] = ".$pool_hired.";";
					echo "dataPoolTaxi[".$id."]['shelter'] = ".$pool_shelter.";";
					echo "dataPoolTaxi[".$id."]['board'] = ".$pool_board.";";
				
					$id++;
				}	
			}	
			
			//POOLS TAXIS
			$counter = 0;
			for($i = 0;$i<Count($data['pool']);$i++){
				
				if ($counter != 28 and $counter != 27 ) {
				echo "var ui = document.createElement('div');".
				"ui.className += 'col-md-2 col-sm-3 col-xs-4';".				
				($data['pool'][$i]['pool_area'] == Admin::AREA_REGULER_1 ? "ui.style.backgroundColor = '#FF0000';" : 
				($data['pool'][$i]['pool_area'] == Admin::AREA_REGULER_2 ? "ui.style.backgroundColor = '#3498DB';" : 
				($data['pool'][$i]['pool_area'] == Admin::AREA_EAGLE ? "ui.style.backgroundColor = '#FFA500';" :
				($data['pool'][$i]['pool_area'] == Admin::AREA_REGULER_3 ? "ui.style.backgroundColor = '#0000FF';" :
				($data['pool'][$i]['pool_area'] == Admin::AREA_REGULER_4 ? "ui.style.backgroundColor = '#00FF00';" :								 
				"ui.style.backgroundColor = '#000';"
				))))).
				"ui.style.border = '1px solid #fff';".
				"ui.style.borderRadius = '2px';".
				"ui.style.cursor = 'pointer';".
				"ui.style.textAlign = 'center';".
				"ui.style.marginTop = '2px';".
				"leftControlDiv.append(ui);".
				
				"var text = document.createElement('div');".
				(($data['pool'][$i]['pool_area'] == Admin::AREA_EAGLE || $data['pool'][$i]['pool_area'] == Admin::AREA_REGULER_4) ? "text.style.color = '#000';" : "ui.style.color = '#FFF';").
				"text.style.fontFamily = 'Roboto,Arial,sans-serif';".
				"text.style.fontSize = '12px';".
				"text.style.lineHeight = '12px';".
				"text.style.paddingLeft = '5px';".
				"text.style.paddingRight = '5px';".
				"text.innerHTML = '".$data['pool'][$counter]['name']."';".
				"ui.appendChild(text);";
				
				echo "ui.addEventListener('click', function() {".
					"clearMarkers(3);".
					"controlText4.innerHTML = 'Hide Taxis';".
					"isTaxisOn = true;".
					"showTaxi(".($counter+1).")".
					//"showTaxi(29)".
					"});";
				}
					
				$counter++;					
			}
			
			echo "var ui = document.createElement('div');".
				"ui.className += 'col-md-2 col-sm-3 col-xs-4';".
				"ui.style.backgroundColor = '#000';".
				"ui.style.border = '1px solid #fff';".
				"ui.style.borderRadius = '2px';".
				"ui.style.cursor = 'pointer';".
				"ui.style.textAlign = 'center';".
				"ui.style.marginTop = '2px';".			
				"leftControlDiv.append(ui);".
				
				"var text = document.createElement('div');".
				"text.style.color = '#FFF';".
				"text.style.fontFamily = 'Roboto,Arial,sans-serif';".
				"text.style.fontSize = '12px';".
				"text.style.lineHeight = '12px';".
				"text.style.paddingLeft = '5px';".
				"text.style.paddingRight = '5px';".
				"text.innerHTML = 'ATR Tiara Sejahtera';".
				"ui.appendChild(text);";
				
			echo "ui.addEventListener('click', function() {".
				"clearMarkers(3);".
				"controlText4.innerHTML = 'Hide Taxis';".
				"isTaxisOn = true;".
				"showTaxi(401)". //Eagle = 400
				"});";
			
			
			echo "var ui = document.createElement('div');".
				"ui.className += 'col-md-2 col-sm-3 col-xs-4';".
				"ui.style.backgroundColor = '#FFA500';".
				"ui.style.border = '1px solid #fff';".
				"ui.style.borderRadius = '2px';".
				"ui.style.cursor = 'pointer';".
				"ui.style.textAlign = 'center';".
				"ui.style.marginTop = '2px';".			
				"leftControlDiv.append(ui);".
				
				"var text = document.createElement('div');".
				"text.style.color = '#000';".
				"text.style.fontFamily = 'Roboto,Arial,sans-serif';".
				"text.style.fontSize = '12px';".
				"text.style.lineHeight = '12px';".
				"text.style.paddingLeft = '5px';".
				"text.style.paddingRight = '5px';".
				"text.innerHTML = 'All Eagle';".
				"ui.appendChild(text);";
				
			echo "ui.addEventListener('click', function() {".
				"clearMarkers(3);".
				"controlText4.innerHTML = 'Hide Taxis';".
				"isTaxisOn = true;".
				"showTaxi(400)". //Eagle = 400
				"});";
				
			

				
				$counter++;
			?>
			icons = {
				reguler: {
				  name: 'Reguler 1 : <?php echo $reguler1;?>',
				  icon: <?php echo $arrMaps[1];?>
				},
				reguler2: {
				  name: 'Reguler 2 : <?php echo $reguler2;?>',
				  icon: <?php echo $arrMaps[2];?>
				},
				reguler3: {
				  name: 'Reguler 3 : <?php echo $reguler3;?>',
				  icon: <?php echo $arrMaps[1];?>
				},
				reguler4: {
				  name: 'Reguler 4 : <?php echo $reguler4;?>',
				  icon: <?php echo $arrMaps[2];?>
				},
				eagle: {
				  name: 'Eagle : <?php echo $eagle;?>',
				  icon: <?php echo $arrMaps[4];?>
				},
				tiara: {
				  name: 'Tiara : <?php echo $tiara;?>',
				  icon: <?php echo $arrMaps[5];?>
				},
				shelter: {
				  name: 'Shelter : ' + markersShelter.length,
				  icon: <?php echo $arrMaps[0];?>
				},
				shelterpremium: {
				  name: 'Shelter Premium : ' + markersShelterPremium.length,
				  icon: <?php echo $arrMaps[11];?>
				}
			  };
			icons2 = {
				installed:{
				  name: "Installed : <?php echo $data['installed'];?>",
				  icon: ''
				},
				auto_login:{
				  name: "Auto Login : <?php echo $assignment;?>",
				  icon: ''
				},
				manual_login:{
				  name: "Manual Login : <?php echo ($count - $assignment);?>",
				  icon: ''
				},
				total_login:{
				  name: 'Total Login : <?php echo $count;?>',
				  icon: ''
				},
				vacant: {
				  name: 'Vacant : <?php echo $vacant;?>',
				  icon: <?php echo $arrMaps[7];?>
				},
				reserved: {
				  name: 'Reserved : <?php echo $hired;?>',
				  icon: <?php echo $arrMaps[8];?>
				},
				sheltered: {
				  name: 'Sheltered : <?php echo $shelter;?>',
				  icon: <?php echo $arrMaps[9];?>
				},
				inactive: {
				  name: 'Inactive : <?php echo $inactive;?>',
				  icon: <?php echo $arrMaps[6];?>
				},
				hired: {
				  name: 'Hired : <?php echo $board;?>',
				  icon: <?php echo $arrMaps[10];?>
				},
				na:{
				  name: 'N/A : <?php echo $na;?>',
				  icon: ''
				}
			};
			var legend = document.getElementById('legend');
			  for (var key in icons) {
				var type = icons[key];
				var name = type.name;
				var icon = type.icon;
				var div = document.createElement('div');
				div.innerHTML = '<img src="' + icon + '"> ' + name;
				legend.appendChild(div);
			  }

		  map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);
		  
		  var legend2 = document.getElementById('legend2');
			  for (var key in icons2) {
				var type = icons2[key];
				var name = type.name;
				var icon = type.icon;
				var div = document.createElement('div');
				div.innerHTML = '<img src="' + icon + '"> ' + name;
				legend2.appendChild(div);
			  }

		  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend2);
		  }
		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhkTdtvrmyGJv1JNznhFvVOLPv1DYwhv4&callback=initMap"></script>