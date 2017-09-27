#!/usr/local/bin/php
#version 1
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
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Bootstrap Material Design -->
	<link rel="stylesheet" type="text/css" href="https://www.cise.ufl.edu/~abh/css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="https://www.cise.ufl.edu/~abh/css/ripples.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CellCheck - Providers</title>
	<style type="text/css">

	   * { margin: 0; padding: 0; }
	   p { margin-top: 5%;padding: 0px; }
		 .cproviders{position: absolute; left: 0; top: 0; width: 100%; height: 100%; background: #49B24E;}
	</style>
	<link rel="stylesheet" type="text/css" href="https://www.cise.ufl.edu/~abh/kekmon.css">
	<link rel="stylesheet" type="text/css" href="https://www.cise.ufl.edu/~abh/css/nouislider.min.css" >

	<script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
  <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-pink.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script langauage="javascript">
	 function showMessage(value){
		document.getElementById("message").innerHTML = value;
	 }
  </script>
</head>

<body style = "background:#26272B;">
	<nav class="navbar navbar-default"style="margin-top:-20px;background:#49B24E;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="https://www.cise.ufl.edu/~abh/index.html">CellCheck</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="https://www.cise.ufl.edu/~abh/providers.php">Providers</a></li>
				<li class="active"><a href="https://www.cise.ufl.edu/~abh/contracts.html">Contracts</a></li>
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
	<div class="col-md-3" style="background:#49B24E; color:white;border-radius:8px;" id="wew">
		<h4>Search Contracts</h4>
		<form action="contracts.php" method="post">
			<div class="form-group" style="margin-bottom:-20px;">
				<label class="control-label" for="focusedInput1">Provider</label>
			    <select class="form-control" name="provider" style="color:#ddd;background:#49B24E; border-bottom:1px solid #ddd;">
			      <option>AT&T</option>
			      <option>Sprint</option>
			      <option>T-Mobile</option>
			      <option>Verizon</option>
			    </select>
    		</div>
			<div class="form-group">
				<label class="control-label" for="datacap">Data Cap (GigaBytes)</label>
			    <select class="form-control" name="datacap" style="color:#ddd;background:#49B24E; border-bottom:1px solid #ddd;">
			      <option>1</option>
			      <option>2</option>
			      <option>3</option>
			      <option>4</option>
			      <option>5</option>
			      <option>6</option>
			      <option>7</option>
			      <option>8</option>
			      <option>9</option>
			      <option>10</option>
			    </select>
    		</div>





			<div>
			<label class="control-label" for="datacap">Price (USD)<br></label>
				<div style="margin-top:10px;">$<text id="message" style="padding-top:30px;">25</text></div>
				<div style="margin-top:-20px;padding-left:10px; ">
					<input id="slider2" name="price" class="mdl-slider mdl-js-slider" type="range" style="background-color:#ddd;"
					min="0" max="100" value="25" tabindex="0" oninput="showMessage(this.value)" onchange="showMessage(this.value)"style="background-color:#ddd;">
				</div>
			</div>



			<div class="form-group label-floating">
				<input type="submit"  class="btn btn-raised btn-default">
			</div>
		</form>
	</div>

	<div class="col-md-6" style="text-align:center;background: rgba(255, 255, 255, 0.5);border-radius:8px;margin-left:20px;text-align:left;" id="contractWrapper">
		<p>
			<?php
			//	figure out why the fucking website is not showing from here

				if($_POST[provider]=='AT&T'){
					echo "<img src='https://www.cise.ufl.edu/~abh/images/att-logo.png' class='img-responsive' alt='AT&T'style = 'border-radius:8px;display:block; margin:0 auto;'>";
				}
				if($_POST[provider]=='Sprint'){
					echo "<img src='https://www.cise.ufl.edu/~abh/images/sprint-logo.png' class='img-responsive' alt='AT&T'style = 'border-radius:8px;display:block; margin:0 auto;'>";
				}
				if($_POST[provider]=='T-Mobile'){
					echo "<img src='https://www.cise.ufl.edu/~abh/images/tmobile-logo.png' class='img-responsive' alt='AT&T'style = 'border-radius:8px;display:block; margin:0 auto;'>";
				}
				if($_POST[provider]=='Verizon'){
					echo "<img src='https://www.cise.ufl.edu/~abh/images/verizon-logo.png' class='img-responsive' alt='AT&T'style = 'border-radius:8px;display:block; margin:0 auto;'>";
				}

				$sqlstatement2 = "SELECT WEBSITE from Provider where name = '$_POST[provider]'";
			 	$test2 = oci_parse($connection, $sqlstatement2);
			 	oci_execute($test2);
				oci_fetch($test2);
				echo oci_result($test2, 'WEBSITE');
			?>
		</p>
		<div class "table-container">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Contract Name</th>
						<th>Data Type</th>
						<th>Price</th>
						<th>     </th>
					</tr>
				</thead>
				<tbody>
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

				$sqlstatement = "SELECT CONTRACT_NAME, DATA_TYPE, PRICE  FROM Contract where Provider = '$_POST[provider]' AND DATA_CAP >= $_POST[datacap] AND PRICE <= $_POST[price]";
				$test = oci_parse($connection, $sqlstatement);
				oci_execute($test);
				while(oci_fetch($test)){
					//List Contract Name
					echo "<tr><td>";
					echo oci_result($test, 'CONTRACT_NAME');
					echo "</td><td>";
					echo oci_result($test, 'DATA_TYPE');
					echo "</td><td>";
					echo "$";
					echo oci_result($test, 'PRICE');
					echo "/Month";
					echo "</td><td>";
					//select buttons goes straight to coverage.html
					echo "<a class='btn '  href='https://www.cise.ufl.edu/~abh/coverage.html'>Select</a>";
					echo "</tr>";
				}
				oci_free_statement($test2);
				oci_free_statement($test);
				oci_close($connection);

			?></p>
		</tbody>
	</table>
</div>
	</div>

	<div class="col-md-9">
	</div>
</div>
</div>
</body>

</html>
