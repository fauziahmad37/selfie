<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<h2 class="modal-title text-center">
				<?php echo $data[0]['name']; ?>
			</h2>
		</div>
		<div class="modal-body text-center">
			<div id="map" style="height:300px;border: 2px solid #fff;"></div>
		</div>
		<div class="modal-footer">		
			<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
		</div>
		</form>
	</div>
</div>
<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>
<script>
  $(document).ready(function(){
	var options = {
	  legend: false,
	  responsive: false
	};
  });
  var map;
  function initMap() {
  <?php
		 echo "map = new google.maps.Map(document.getElementById('map'), {".
			"zoom: 16,".
			"center: {lat: ".$data[0]['mst_lat'].", lng: ".$data[0]['mst_lng']."},".
			"disableDefaultUI: true,".
			"scrollwheel: false,".
			"navigationControl: false,".
			"mapTypeControl: false,".
			"scaleControl: false,".
			"draggable: false,".
			"styles: [".
				"{".
				  "featureType: 'poi',".
				  "stylers: [".
				  "{color: ''},".
				  "{visibility: 'off'}]".
				"},".
				"{".
					'"featureType": "transit.station.airport",'.
					'"elementType": "geometry.fill",'.
					'"stylers": ['.
						"{".
							'"invert_lightness": true'.
						"},".
						"{".
							'"gamma": 9'.
						"},".
						"{".
							'"hue": "#007700"'.
						"}".
					"]".
				"}".
			  "]".
		  "});".
		  "var marker = new google.maps.Marker({".
			  "position: {lat : ".$data[0]['mst_lat'].", lng : ".$data[0]['mst_lng']."},".
			  "map: map,".
			  "icon: '".base_url('/assets/images/shelter.png')."',".
			  'title: "'.$data[0]['name'].'"'.
			"});";
		foreach((Array) $data AS $key => $val){
		  echo "var cityCircle = new google.maps.Circle({".
			  "strokeColor: '#00FF00',".
			  "strokeOpacity: 0.6,".
			  "strokeWeight: 1,".
			  "fillColor: '#00EE00',".
			  "fillOpacity: 0.35,".
			  "map: map,".
			  "center: {lat : ".$val['lat'].", lng : ".$val['lng']."},".
			  "radius: ".$val['radius'].
			"});";
		}
	?>
	}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhkTdtvrmyGJv1JNznhFvVOLPv1DYwhv4&callback=initMap"></script>	        	  