<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="./js/respoint.js" type="text/javascript"></script>
		<title>Halal Restaurant</title>
		<?php
			error_reporting(1);
			$id = $_GET['id'];
		?>
	</head>

  <body>
  	<script>
		var idn = '<?php echo($id); ?>';
	</script>
	<div class="container-fluid">
		<div class="row">
			<div id="header" class="col-xs-12">
				<center>
					<h1 class="head">Halal Restaurant</h1>
				</center>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div id="menu" class="col-xs-2"></div>
			<div id="menu" class="col-xs-8">
				<ul>
					<li><a href="home.php">Home</a></li>
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
			</div>
			<div id="menu" class="col-xs-2"></div>
		</div>
	</div>
	
	<div class="container-fluid">
		<div class="row">
			<div id="content" class="col-xs-2"></div>
			<div id="content" class="col-xs-8">
				<center>
					<h1>Restaurant Name</h1>
					<script>
						document.write('<h3>' + halalres.features[idn].name + '</h3>'); 
						document.write('<br>');
						document.write('<img src=" ' + halalres.features[idn].pic + ' "><br><br> ');
					</script>
					
					<br>
					<table>
						<col width="50%">
						<col width="50%">
					  <tr>
						<th style="text-align: right">Service Hour: </th>
						<th style="padding: 0.5em"><script>document.write(halalres.features[idn].servicehour);</script></th>
					  </tr>
					  <tr>
						<th style="text-align: right">Parking Space: </th>
						<th style="padding: 0.5em"><script>document.write(halalres.features[idn].parking);</script></th>
					  </tr>
					  <tr>
						<th style="text-align: right">Comment: </th>
						<th style="padding: 0.5em"><script>document.write(halalres.features[idn].comment);</script></th>
					  </tr>
					  <tr>
						<th style="text-align: right">Contact: </th>
						<th style="padding: 0.5em"><script>document.write(halalres.features[idn].contact);</script></th>
					  </tr>				  
					</table>
					<br>
					<h2>Signature Dishes</h2>
					<script>
						for(var i=0; i < halalres.features[idn].sigdish.length; i++){
							document.write('<img src=" ' + halalres.features[idn].sigdish[i] + ' " style="width:250px; height:250px";> ');
						}
					</script>
					<br>
					<button class="button1" onclick="gotohome()">Go!</button>

					<script> 
						function gotohome() {
							window.open("home.php?id=" + halalres.features[idn].id ,"_self");
						}
					</script>
				</center>
			</div>
		</div>
	</div>
	
  </body>


</html>
