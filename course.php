<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="de">
	<head>
		<title>FH-Portal</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<!-- structure of the page -->
		<div class="container-fluid">
			<!-- Upper part of the page -->
			<div class="row">
				<!-- for the left free space -->
				<div class = "col-md-1"></div>
				<!-- middle -->
				<div class="jumbotron col-md-10">
					<h1>Willkommen zum FH-Portal</h1>
					<!-- space for the logo -->
				</div>
				<!-- for the right free space -->
				<div class = "col-md-1"></div>
			</div>
			<!-- navigation part of the page -->
			<div class="row">
				<!-- for the right free space -->
				<div class = "col-md-1"></div>
				<!-- navigationbar -->
				<div class ="col-md-10">
					<nav class="navbar navbar-inverse">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>                        
								</button>
								<!-- Logo-->
							</div>
							<div class="collapse navbar-collapse" id="myNavbar">
								<ul class="nav navbar-nav">
									<li class="active"><a href="#">Home</a></li>
									<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="#">Page 1-1</a></li>
										<li><a href="#">Page 1-2</a></li>
										<li><a href="#">Page 1-3</a></li>
									</ul>
									</li>
									<li><a href="#">Kurse</a></li>
									<li><a href="#">FH</a></li>
                                                                        <li><a href="#">User-page</a></li>
                                                                        <li><a href="#">Impressum</a></li>
								</ul>
								<!-- search function in the navbar -->
								<div class="nav navbar-nav navbar-right">
									<form class="navbar-form" role="search">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Suche" name="q">
											<div class="input-group-btn">
												<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</nav>
				</div>
				<!-- for the right free space -->
				<div class = "col-md-1"></div>
			</div>
			<!-- main part of the page -->
			<div class ="row">
				<!-- for the left free space -->
				<div class = "col-md-1"></div>
				<!-- Main content -->
				<div class = "col-md-7">
					<h2>Kurs 100: Web-Engineering</h2>
					<p>Inhalt</p>
				</div>
				<!-- Sidebar -->
				<div class = "col-md-3">
					<!-- Login panel -->
					<div class ="panel-group">
						<div class ="panel panel-default">
							<div class="panel-heading">Login</div>
							<div class="panel-body">
								<form role="form">
									<div class="form-group">
										<label for="email">Emailaddresse:</label>
										<input type="email" class="form-control" id="email">
									</div>
									<div class="form-group">
										<label for="pwd">Passwort:</label>
										<input type="password" class="form-control" id="pwd">
									</div>
									<button type="submit" class="btn btn-default">Login</button>
								</form>
							</div>
						</div>
					</div>
                                        <!-- Werbeflaeche panel -->
                                        <div class ="panel-group">
						<div class ="panel panel-default">
							<div class="panel-heading">Werbung</div>
							<img src="pictures/werbung_fhnw.jpg" class="img-responsive img-rounded center-block" alt="FHNW">
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
