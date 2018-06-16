<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />
		<link rel="stylesheet" href="./dist/leaflet-routing-machine.css" />
		<link rel="stylesheet" href="./css/index.css" />
		<link rel="stylesheet" href="./css/Control.Geocoder.css" />
		<script src="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>
		<script src="./dist/leaflet-routing-machine.js"></script>
		<script src="./js/Control.Geocoder.js"></script>
		<script src="./js/config.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="./js/respoint.js" type="text/javascript"></script>
  	<title>Halal Restaurant</title>
  	<?php
		error_reporting(1);
		$id = $_GET['id'];
		/*if(isset($id)){
	   		echo("kuy");
  		}
		else{
			echo("kuy2");
		}*/
	?>
	<script>
		var idj = '<?php echo($id); ?>'
		 var restDest = [];
		 restDest.push(halalres.features[idj].geometry.coordinates[1]);
		 restDest.push(halalres.features[idj].geometry.coordinates[0])
	</script>
	</head>

  <body>
	<div class="container-fluid">
		<div class="row">
			<div id="header" class="col-xs-12">
				<center><h1 class="head">Halal Restaurant</h1></center>
			</div>
		</div>
	</div>
	
	<div class="container-fluid">
		<div class="row">
			<div id="menu" class="col-xs-2"></div>
			<div id="menu" class="col-xs-8">
			<center>
				<ul>
					<li><a class="active" href="home.php">Home</a></li>
					<li><a href="suggest.php">Suggest Restaurant</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li style="float:right">
						<form class="navbar-form navbar-left" action="searchresult.php" method="POST">
						  <div class="form-group">
								<input type="text" class="form-control" placeholder="Search" name="resname">
						  </div>
						  <button type="submit" class="button3">Submit</button>
						</form>
					</li>
				</ul>
			</center>
			</div>
			<div id="menu" class="col-xs-2"></div>
		</div>
	</div>

	
	<div class="container">
		<div class="row">
			<div id="content" class="col-xs-12">
			  		<div id="map" style="width: 100%; height: 80vh; margin: auto;"></div>
							<script> //Map JS Started here
								var map = L.map('map');

								L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
									attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
								}).addTo(map);

								map.locate({setView: true, maxZoom: 15});

								var current_position, current_accuracy;

								function onLocationFound(e) {
									if (current_position) {
										map.removeLayer(current_position);
										map.removeLayer(current_accuracy);
									}

									var radius = e.accuracy / 2;

									current_position = L.marker(e.latlng).addTo(map);

									current_accuracy = L.circle(e.latlng, {color: 'red', radius}).addTo(map);
									control.spliceWaypoints(0, 1, e.latlng);
									
									restaurantPromoRange.eachLayer(function(layer){
										if(layer.getBounds().contains(current_position.getLatLng())){
											alert(layer.name+" has 10 percent discount, if you get here within 1 hr.");
										}
									});
									filter.addTo(map);
									filterScroll();
									
									 if(restDest!=null){
									  	control.spliceWaypoints(1,1,restDest);
									 	map.fitBounds(L.latLngBounds(current_position.getLatLng(),restDest),{maxZoom:14});
									 }
								}

								function onLocationError(e) {
									var container = L.DomUtil.create('div');
									container.innerHTML = "Locating error: "+e+"<br>";
									var retryBtn = createButton('Retry Locating Your Location',container);
									L.popup().setContent(container).setLatLng(map.getCenter()).openOn(map);
									L.DomEvent.on(retryBtn,'click',function(){
										map.locate({setView: true, maxZoom: 16});
									});
								}

								map.on('locationfound', onLocationFound);
								map.on('locationerror', onLocationError);

								var control = L.Routing.control(L.extend(window.lrmConfig, {
									waypoints: [

									],
									geocoder: L.Control.Geocoder.nominatim(),
									routeWhileDragging: true,
									reverseWaypoints: true,
									showAlternatives: true,
									altLineOptions: {
										styles: [
											{color: 'black', opacity: 0.15, weight: 9},
											{color: 'white', opacity: 0.8, weight: 6},
											{color: 'green', opacity: 0.5, weight: 5}
										]
									}
								})).addTo(map);

								control.on('routesfound',function(e){
									var distance = e.routes[0].summary.totalDistance;
									var time = e.routes[0].summary.totalTime;
									 console.log(distance/1000 + ' Kilometers  ' + time/60 + ' minutes ');
								});

								L.Routing.errorControl(control).addTo(map);

								var allah = L.icon({
									iconUrl: './image/allah.png',
									iconSize: [30, 30]
								});

								function createButton(label, container) {
									var btn = L.DomUtil.create('button', '', container);
									btn.setAttribute('type', 'button');
									btn.innerHTML = label;
									return btn;
								}
								
								function starRating(rating,container) {
									var star = L.DomUtil.create('div','',container);
									var i,j;
									star.innerHTML ="<b>Rating: </b>";
									for(i =0;i<rating;i++){
								
										star.innerHTML += "<img style='width:20px;height:20px;vertical-align:middle;' src='./image/star.png'>"
									};
									for(i =0; i<(5-rating);i++){
										
										star.innerHTML += "<img style='width:20px;height:20px;vertical-align:middle;' src='./image/empty-star.png'>"
									};
									
							
									return star
								}

								var restaurant = L.layerGroup([]);
								var restaurantPromoRange = L.layerGroup([]);

								function onEachFeature (feature, layer) {
									var container = L.DomUtil.create('div');
									container.innerHTML = "<b>ชื่อร้าน: </b>" + feature.name + "<br>" + "<b>รายละเอียด: </b>" + feature.comment + "<br>";
									rating = starRating(feature.rating,container);
									//container.innerHTML += "<br>";
									
									destBtn = createButton('Route here', container);
									
									getInfo = createButton('More Details', container);

									layer.bindPopup(container);

									L.DomEvent.on(destBtn, 'click', function() {
										control.spliceWaypoints(1,1, layer.getLatLng());
										map.closePopup();
										map.fitBounds(L.latLngBounds(current_position.getLatLng(),layer.getLatLng()),{maxZoom:15});
									});

									L.DomEvent.on(getInfo, 'click', function() {
										window.open("restaurant.php?id=" + feature.id ,"_self");
										map.closePopup();
									});
									
									restaurant.addLayer(layer);
									var newLayer = L.circle(layer.getLatLng(),300);
									newLayer.name = layer.feature.name;
									restaurantPromoRange.addLayer(newLayer).addTo(map);
									
									layer.on({
										mouseover: hoverOpenPopup
									});

								}
								
								function hoverOpenPopup(e){
									e.target.openPopup();
							   	}
								
								L.geoJson(halalres, {
									pointToLayer: function(feature, latlng) {
										return L.marker(latlng, {icon:allah})
									},
									onEachFeature: onEachFeature
								}).addTo(map); 
								
								//new UI
								function createFilterDiv(layer,container){
									var div = L.DomUtil.create('div','filter-item',container);
									var img = layer.feature.pic;
									if(img.length <2){
										img = './image/doge.png';
									}
									console.log(img);
									div.innerHTML = "<img style='width:70px;height:60px;align:center;' src='"+img+"'><br>";
									div.innerHTML += "<b>Name: </b>"+layer.feature.name+"<br>";
									var rating = starRating(layer.feature.rating,div);
									var distance;
									if(current_position!=null){
										distance = Math.round((current_position.getLatLng().distanceTo(layer.getLatLng())/1000)*100)/100 + " Km.";
									}else{
										distance ="<span style='color:grey;'> waiting for user location</span>"
									}
									div.innerHTML += "<b>Distance: </b>"+distance;
									//div.innerHTML += "<br><b>Distance: </b>";
									L.DomEvent.on(div,'click',function() {
										try{
										map.flyTo(layer.getLatLng(),17);
										}catch(err){
											alert(err);
										}
									});
									return div;
								};
								
								
								
								var filter = L.control({position: 'bottomleft'});
								var showfilter = L.control({position: 'bottomleft'});
								showfilter.onAdd = function(map){
									var div = L.DomUtil.create('div','filter'),
										btn = L.DomUtil.create('a','',div);
										btn.innerHTML = "<span style='cursor:pointer;'>Show Filter List</span>";
									L.DomEvent.on(btn,'click',function(){
										showfilter.remove();
										filter.addTo(map);					
									});
									return div;
								};
								filter.onAdd = function (map) {
									var div = L.DomUtil.create('div','filter');
									var nav = L.DomUtil.create('div','filter-navbar',div);
									nav.innerHTML ="List by: ";
									var select = L.DomUtil.create('select','',nav);
									select.innerHTML = "<option label='rating' selected>Rating</option><option label='distance'>Distance</option>";
									var closebtn = L.DomUtil.create('a','',nav);
									closebtn.innerHTML = "<span style='cursor:pointer;float:right;'> x </span>";
									var list = L.DomUtil.create('div','list',div);
									L.DomEvent.on(closebtn,'click',function(){
										filter.remove();
										showfilter.addTo(map);
									});
									var sort=[],sorted =[];
									L.DomEvent.on(select,'change',function(){
										list.innerHTML ='';
										if(select.options[select.selectedIndex].getAttribute("label")=='rating'){
											sort=[];
											restaurant.eachLayer(function(layer){
											//apply if filter for candidate here ex. distance < 1000 
												sort.push(layer.feature.rating);
											});
											sorted = quick_Sort(sort);
											//later will limit to top 5;
											//sorted = quick_Sort(sort.slice(0,4));
											//weird order of layer index, need more sample for pattern
											while(sorted.length>0){
												restaurant.eachLayer(function(layer){			
													if( layer.feature.rating == sorted[sorted.length-1]){
														createFilterDiv(layer,list);
														sorted.pop();
													}
												});
											}
																
										}else{
											sort=[];
											restaurant.eachLayer(function(layer){
												sort.push(parseInt(current_position.getLatLng().distanceTo(layer.getLatLng())));
											});
											sorted = quick_Sort(sort);
											while(sorted.length>0){
												restaurant.eachLayer(function(layer){			
													if( parseInt(current_position.getLatLng().distanceTo(layer.getLatLng())) == sorted[0]){
														createFilterDiv(layer,list);
														sorted.shift();
													}
												});
											}
										}
										
									});
									
									//first time rating sort
									restaurant.eachLayer(function(layer){
										sort.push(layer.feature.rating);
									});
									sorted = quick_Sort(sort);
									//weird order of layer index, need more sample for pattern
									while(sorted.length>0){
										restaurant.eachLayer(function(layer){			
											if( layer.feature.rating == sorted[sorted.length-1]){
												createFilterDiv(layer,list);
												sorted.pop();
											}
										});
									}
											
									return div;
								};
								filter.addTo(map);
								
								filterScroll();
								//sorting algo
								function quick_Sort(origArray) {
									if (origArray.length <= 1) { 
										return origArray;
									} else {

										var left = [];
										var right = [];
										var newArray = [];
										var pivot = origArray.pop();
										var length = origArray.length;

										for (var i = 0; i < length; i++) {
											if (origArray[i] <= pivot) {
												left.push(origArray[i]);
											} else {
												right.push(origArray[i]);
											}
										}

										return newArray.concat(quick_Sort(left), pivot, quick_Sort(right));
									}
								}
								
								
								function filterScroll(){	
									$(document).ready(function(){
										  $('.filter').scroll(function() {
											if ($('.filter').scrollTop() > 0) {
											  $('.filter-navbar').css({
												'position': 'absolute',
												'top': $('.filter').scrollTop(),
												'padding-top':'8px',
												'height':'33px'
											  });
											}
										  });
									});
								}
						</script> 
						<style>
							.filter {
								padding: 10px;
								background-color:white;
								box-shadow: 0 0 15px rgba(0,0,0,0.2);
								border-radius: 5px;
								max-height: 300px;
								overflow:auto;
								width: 180px;
							} 
							.filter-item {
								cursor: pointer;
								font-size:10px;
								
							}
							.filter-navbar {
								width:150px;
								position:absolute;
								background-color:white;	
								height:30px;
								
								padding-right:3px;
							}
							.list{
								padding-top:20px;
											
							}
							/* Let's get this party started */ ::-webkit-scrollbar { width: 10px; } /* Track */ ::-webkit-scrollbar-track { -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); -webkit-border-radius: 10px; border-radius: 10px; } /* Handle */ ::-webkit-scrollbar-thumb { -webkit-border-radius: 10px; border-radius: 10px; background: rgba(211,211,211,0.8); -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); } ::-webkit-scrollbar-thumb:window-inactive { background: white; }
						</style>
			  <center>
			  	<br>
				<b>Map surround your area</b>
			  	<br>
			  	<br>

			  </center>
			</div>
		</div>
	</div>

  </body>


</html>
