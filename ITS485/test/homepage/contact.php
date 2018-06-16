<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<meta charset="utf-8">
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
					<li><a href="suggest.php">Suggest Restaurant</a></li>
					<li><a class="active" href="contact.php">Contact</a></li>
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
					<table>
						<col width="50%">
						<col width="50%">
					  <tr>
						<th style="text-align: right">E-Mail: </th>
						<th style="padding: 0.5em"><a class="link1" href="mailto:jamesthegod@godmail.com">jamesthegod@godmail.com</a></th>
					  </tr>
					  <tr>
						<th style="text-align: right">Facebook: </th>
						<th style="padding: 0.5em"><a class="link1" href="https://www.fb.com/jamesthegod">fb.com/jamesthegod</a></th>
					  </tr>
					  <tr>
						<th style="text-align: right">Phone Number: </th>
						<th style="padding: 0.5em">(+66) 99 999 9999</th>
					  </tr>
					</table>
				</center>
			</div>
			<div id="content" class="col-xs-2"></div>
		</div>
	</div>

  </body>


</html>
