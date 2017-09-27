#!/usr/local/bin/php

-<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
	<!-- Material Design fonts -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- Bootstrap Material Design -->
	<link rel="stylesheet" type="text/css" href="https://ahanuschak.com/cis4301/css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="https://ahanuschak.com/cis4301/css/ripples.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CellCheck - Providers</title>
	<style type="text/css">

	   * { margin: 0; padding: 0; }
	   p { margin-top: 5%;padding: 0px; }
		 .cproviders{position: absolute; left: 0; top: 0; width: 100%; height: 100%; background: #49B24E;}
	</style>
	<link rel="stylesheet" type="text/css" href="https://ahanuschak.com/cis4301/kekmon.css">
</head>

<body style = "background:#26272B;">

	<nav class="navbar navbar-default"style="margin-top:-20px;background:#49B24E;clear:both;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="https://www.cise.ufl.edu/~abh/index.html">CellCheck</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="https://www.cise.ufl.edu/~abh/providers.php">Providers</a></li>
				<li><a href="https://www.cise.ufl.edu/~abh/contracts.html">Contracts</a></li>
				<li><a href="https://www.cise.ufl.edu/~abh/coverage.html">Coverage</a></li>
	    	<li style="position:absolute;right:100px;">
	      		<a class="nav-link" href="https://www.cise.ufl.edu/~abh/stats.php">Stats</a>
	    	</li>
	    	<li style="position:absolute;right:10px;">
	      		<a class="nav-link" href="https://www.cise.ufl.edu/~abh/index.html">Logout</a>
	    	</li>
			</ul>
		</div>
	</nav>

<div class="container" >
<div class="row">
	<div class="col-md-3">
	</div>

	<div class="col-md-6" style="text-align:center;">
		<h2 style="color:white;margin-bottom:20px;"><br>Choose a Provider<br></h2>
		<ul class="nav nav-pills green">
			<li class="active"><a data-toggle="pill" href="#ATnT">AT&T</a></li>
			<li><a data-toggle="pill" href="#Sprint">Sprint</a></li>
			<li><a data-toggle="pill" href="#TMobile">T-Mobile</a></li>
			<li><a data-toggle="pill" href="#Verizon">Verizon</a></li>
		</ul>

		<div class="tab-content" style="color:#26272B;text-align:left;background: rgba(255, 255, 255, 0.5);border-radius:8px;height:400px;margin-bottom:20px; padding-left:30px; padding-right:30px;">
			<div id="ATnT" class="tab-pane fade in active">
				<p style="margin-bottom:-20px;"><br></p>
				<img src="https://ahanuschak.com/cis4301/att-logo.png" class="img-responsive" alt="AT&T"style = "border-radius:8px;display:block; margin:0 auto;">
				<p>

					<?php
						$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
							if (!$connection) {
								 $m = oci_error();
								 echo $m['message'], "\n";
								 exit;
							}
							else {
								 //print "Sucessfully connected to Oracle!";
							}


						//List Name
						echo "AT&T";
						//List Headquarters address
						//List Contact Number
						//Total Number of Towers

						oci_free_statement($test);
						oci_close($connection);

					?></p>
					<p>
							<?php
								$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
									if (!$connection) {
										 $m = oci_error();
										 echo $m['message'], "\n";
										 exit;
									}
									else {
										 //print "Sucessfully connected to Oracle!";
									}

									$sqlstatement = "SELECT HEADQUARTERS FROM Provider where name = 'AT&T'";
									$test = oci_parse($connection, $sqlstatement);
									oci_execute($test);
									oci_fetch($test);
									echo "HQ Location: ";
									echo oci_result($test, 'HEADQUARTERS');
									$sqlstatement = "SELECT CONTACT, WEBSITE FROM Provider where name = 'AT&T'";
									$test = oci_parse($connection, $sqlstatement);
									oci_execute($test);
									oci_fetch($test);


					?><br>
							<?php
								$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
									if (!$connection) {
										 $m = oci_error();
										 echo $m['message'], "\n";
										 exit;
									}
									else {
										 //print "Sucessfully connected to Oracle!";
									}
									echo "Phone: ";
									echo oci_result($test, 'CONTACT');
									echo "<br>";
									echo " Website: ";
									echo oci_result($test, 'WEBSITE');
									$sqlstatement = "SELECT COUNT(*) FROM FL_CELL_SITES WHERE MNC IN (SELECT MNC FROM Network WHERE Provider = 'AT&T')";
									$test = oci_parse($connection, $sqlstatement);
									oci_execute($test);
									oci_fetch($test);

					?><br><br>
							<?php
								$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
									if (!$connection) {
										 $m = oci_error();
										 echo $m['message'], "\n";
										 exit;
									}
									else {
										 //print "Sucessfully connected to Oracle!";
									}

									echo "Cell towers in Florida: ";
									echo oci_result($test, 'COUNT(*)');

					?></p>
					<a href="contracts.html" class="btn btn-raised btn-success">Select</a>
			</div>
			<div id="Sprint" class="tab-pane fade">
				<p style="margin-bottom:-15px;"><br></p>
				<img src="https://ahanuschak.com/cis4301/sprint-logo.png" class="img-responsive" alt="Sprint"style = "border-radius:8px;display:block; margin:0 auto;margin-bottom:-10px;">
				<p>


						<?php
							$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
								if (!$connection) {
									 $m = oci_error();
									 echo $m['message'], "\n";
									 exit;
								}
								else {
									 //print "Sucessfully connected to Oracle!";
								}



							echo "Sprint";

							oci_free_statement($test);
							oci_close($connection);
						?></p>
						<p>
								<?php
									$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
										if (!$connection) {
											 $m = oci_error();
											 echo $m['message'], "\n";
											 exit;
										}
										else {
											 //print "Sucessfully connected to Oracle!";
										}
										$sqlstatement = "SELECT HEADQUARTERS FROM Provider where name = 'Sprint'";
										$test = oci_parse($connection, $sqlstatement);
										oci_execute($test);
										oci_fetch($test);

										echo "HQ Location: ";
										echo oci_result($test, 'HEADQUARTERS');
										$sqlstatement = "SELECT CONTACT, WEBSITE FROM Provider where name = 'Sprint'";
										$test = oci_parse($connection, $sqlstatement);
										oci_execute($test);
										oci_fetch($test);

						?><br>
								<?php
									$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
										if (!$connection) {
											 $m = oci_error();
											 echo $m['message'], "\n";
											 exit;
										}
											else {
												 //print "Sucessfully connected to Oracle!";
										}

										echo "Phone: ";
										echo oci_result($test, 'CONTACT');
										echo "<br>";
										echo " Website: ";
										echo oci_result($test, 'WEBSITE');
										$sqlstatement = "SELECT COUNT(*) FROM FL_CELL_SITES WHERE MNC IN (SELECT MNC FROM Network WHERE Provider = 'Sprint')";
										$test = oci_parse($connection, $sqlstatement);
										oci_execute($test);
										oci_fetch($test);

						?><br><br>
								<?php
									$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
										if (!$connection) {
											 $m = oci_error();
											 echo $m['message'], "\n";
											 exit;
										}
										else {
											 //print "Sucessfully connected to Oracle!";
										}


							echo "Cell towers in Florida: ";
							echo oci_result($test, 'COUNT(*)');

						?></p>
						<a href="contracts.html" class="btn btn-raised btn-success">Select</a>
				</div>
			<div id="TMobile" class="tab-pane fade">
				<p style="margin-bottom:-0px;"><br></p>
				<img src="https://ahanuschak.com/cis4301/tmobile-logo.png" class="img-responsive" alt="T-Mobile"style = "border-radius:8px;display:block; margin:0 auto;padding:10px;">


					<?php
						$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
							if (!$connection) {
								 $m = oci_error();
								 echo $m['message'], "\n";
								 exit;
							}
							else {
								 //print "Sucessfully connected to Oracle!";
							}


						//List Name
						echo "T-Mobile";
						//List Headquarters address
						//List Contact Number
						//Total Number of Towers

						oci_free_statement($test);
						oci_close($connection);

					?></p>
					<p>
							<?php
								$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
									if (!$connection) {
										 $m = oci_error();
										 echo $m['message'], "\n";
										 exit;
									}
									else {
										 //print "Sucessfully connected to Oracle!";
									}

									$sqlstatement = "SELECT HEADQUARTERS FROM Provider where name = 'T-Mobile'";
									$test = oci_parse($connection, $sqlstatement);
									oci_execute($test);
									oci_fetch($test);
									echo "HQ Location: ";
									echo oci_result($test, 'HEADQUARTERS');
									$sqlstatement = "SELECT CONTACT, WEBSITE FROM Provider where name = 'T-Mobile'";
									$test = oci_parse($connection, $sqlstatement);
									oci_execute($test);
									oci_fetch($test);

					?><br>
							<?php
								$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
									if (!$connection) {
										 $m = oci_error();
										 echo $m['message'], "\n";
										 exit;
									}
									else {
										 //print "Sucessfully connected to Oracle!";
									}

									echo "Phone: ";
									echo oci_result($test, 'CONTACT');
									echo "<br>";
									echo " Website: ";
									echo oci_result($test, 'WEBSITE');
									$sqlstatement = "SELECT COUNT(*) FROM FL_CELL_SITES WHERE MNC IN (SELECT MNC FROM Network WHERE Provider = 'T-Mobile')";
									$test = oci_parse($connection, $sqlstatement);
									oci_execute($test);
									oci_fetch($test);

					?><br><br>
							<?php
								$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
									if (!$connection) {
										 $m = oci_error();
										 echo $m['message'], "\n";
										 exit;
									}
									else {
										 //print "Sucessfully connected to Oracle!";
									}

									echo "Cell towers in Florida: ";
									echo oci_result($test, 'COUNT(*)');

					?></p>
					<a href="contracts.html" class="btn btn-raised btn-success">Select</a>

			</div>
			<div id="Verizon" class="tab-pane fade">
				<p style="margin-bottom:-15px;"><br></p>
				<img src="https://ahanuschak.com/cis4301/verizon-logo.png" class="img-responsive" alt="Verizon"style = "border-radius:8px;display:block; margin:0 auto;margin-bottom:10px;">


					<?php
						$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
							if (!$connection) {
								 $m = oci_error();
								 echo $m['message'], "\n";
								 exit;
							}
							else {
								 //print "Sucessfully connected to Oracle!";
							}


						//List Name
						echo "<br>";
						echo "<br>";
						echo "Verizon";

						oci_free_statement($test);
						oci_close($connection);

					?></p>
					<p>
							<?php
								$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
									if (!$connection) {
										 $m = oci_error();
										 echo $m['message'], "\n";
										 exit;
									}
									else {
										 //print "Sucessfully connected to Oracle!";
									}
									$sqlstatement = "SELECT HEADQUARTERS FROM Provider where name = 'Verizon'";
									$test = oci_parse($connection, $sqlstatement);
									oci_execute($test);
									oci_fetch($test);

									echo "HQ Location: ";
									echo oci_result($test, 'HEADQUARTERS');
									$sqlstatement = "SELECT CONTACT, WEBSITE FROM Provider where name = 'Verizon'";
									$test = oci_parse($connection, $sqlstatement);
									oci_execute($test);
									oci_fetch($test);

					?><br>
							<?php
								$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
									if (!$connection) {
										 $m = oci_error();
										 echo $m['message'], "\n";
										 exit;
									}
									else {
										 //print "Sucessfully connected to Oracle!";
									}

									echo "Phone: ";
									echo oci_result($test, 'CONTACT');
									echo "<br>";
									echo " Website: ";
									echo oci_result($test, 'WEBSITE');
									$sqlstatement = "SELECT COUNT(*) FROM FL_CELL_SITES WHERE MNC IN (SELECT MNC FROM Network WHERE Provider = 'Verizon')";
									$test = oci_parse($connection, $sqlstatement);
									oci_execute($test);
									oci_fetch($test);

					?><br><br>
							<?php
								$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
									if (!$connection) {
										 $m = oci_error();
										 echo $m['message'], "\n";
										 exit;
									}
									else {
										 //print "Sucessfully connected to Oracle!";
									}

									echo "Cell towers in Florida: ";
									echo oci_result($test, 'COUNT(*)');

					?></p>
					<a href="contracts.html" class="btn btn-raised btn-success">Select</a>
			</div>
		</div>
	</div>

	<div class="col-md-9">
	</div>
</div>
</div>
</body>

</html>
