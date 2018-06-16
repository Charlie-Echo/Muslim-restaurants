<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />
		<link rel="stylesheet" href="../dist/leaflet-routing-machine.css" />
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
									//console.log(restaurant);
									//console.log(current_position.getLatLng());
									restaurant.eachLayer(function(layer){
										 //console.log(layer.getBounds());
									});
									restaurant.eachLayer(function(layer){
										if(layer.getBounds().contains(current_position.getLatLng())){
											alert("kuy");
										}
									});
								}

								function onLocationError(e) {
									alert(e.message);
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
									 //console.log(distance/1000 + ' Kilometers  ' + time/60 + ' minutes ');
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
									star.innerHTML ="rating : ";
									for(i =0;i<rating;i++){
										 //console.log("looping");
										star.innerHTML += "<img style='width:25px;height:25px;vertical-align:middle;' src='./image/star.png'>"
									};
									for(i =0; i<(5-rating);i++){
										 //console.log("looping-empty");
										star.innerHTML += "<img style='width:25px;height:25px;vertical-align:middle;' src='./image/empty-star.png'>"
									};
									//star.innerHTML +=" ,"+ rating;
									 //console.log(star);
									return star
								}

								var restaurant = L.layerGroup([]);

								function onEachFeature (feature, layer) {
									var container = L.DomUtil.create('div');
									container.innerHTML = "<b>ชื่อร้าน: </b>" + feature.name + "<br>" + "<b>รายละเอียด: </b>" + feature.comment + "<br>";
									rating = starRating(feature.rating,container);
									 //console.log(feature.rating);
									destBtn = createButton('Route to this restaurant', container);
									//getLatlng = createButton('Get latlng of this location', container);
									getInfo = createButton('Detail Informations', container);

									layer.bindPopup(container);

									L.DomEvent.on(destBtn, 'click', function() {
										control.spliceWaypoints(1,1, layer.getLatLng());
										map.closePopup();
									});

									/*L.DomEvent.on(getLatlng, 'click', function() {
										alert(layer.getLatLng().toString());
										map.closePopup();
									});*/

									L.DomEvent.on(getInfo, 'click', function() {
										window.open("restaurant.php?id=" + feature.id);
										map.closePopup();
									});
									
									layer.on({
										mouseover: hoverOpenPopup
									});

									restaurant.addLayer(L.circle(layer.getLatLng(), 300).addTo(map));

								}
								
								function hoverOpenPopup(e){
									e.target.openPopup();
							   	}
								
								L.geoJson(halalres, {
									pointToLayer: function(feature, latlng) {
										return L.marker(latlng, {icon:allah})
									},
									onEachFeature: onEachFeature
								}).addTo(map); //Map JS Stoped here
								
						</script> 
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
