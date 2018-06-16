<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
				<ul>
					<li><a href="home.php">Home</a></li>
					<li><a class="active" href="suggest.php">Suggest Restaurant</a></li>
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
			<div  id="content" class="col-xs-8">
				<center>
					<table width="75%">
						<col width="50%">
						<col width="50%">
					  <tr>
						<th style="text-align: right">Restaurant Name: </th>
						<th><input style="margin: 0.5em" type="text" name="" value=""></th>
					  </tr>
					  <tr>
						<th style="text-align: right">Hourse of Service: </th>
						<th><input style="margin: 0.5em" type="text" name="" value=""></th>
					  </tr>
					  <tr>
						<th style="text-align: right">Parking Space: </th>
						<th><input style="margin: 0.5em" type="checkbox" name="vehicle" value="Bike"> Have a Parking Space</th>
					  </tr>
					  <tr>
						<th style="text-align: right">Contact: </th>
						<th><input style="margin: 0.5em" type="text" placeholder="Phone Number"></th>
					  </tr>
					  <tr>
						<th style="text-align: right"></th>
						<th><input style="margin: 0.5em" type="text" placeholder="E-Mail"></th>
					  </tr>
					</table>
					<br>
					<button type="button" class="button1">Send</button>
					&nbsp;
					<button type="button" class="button2">Clear</button>
				</center>
			</div>
			<div id="content" class="col-xs-2"></div>
		</div>
	</div>

  </body>


</html>
