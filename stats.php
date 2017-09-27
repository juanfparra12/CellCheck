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
			.count
			{
			  line-height: 100px;
			  color:#333;
			  margin-left:30px;
			  font-size:25px;
			}
		a{color:#333;}

	</style>
	<link rel="stylesheet" type="text/css" href="https://ahanuschak.com/cis4301/kekmon.css">
</head>

<body style = "background:#26272B;">

	<nav class="navbar navbar-default"style="margin-top:-20px;background:#49B24E;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="https://www.cise.ufl.edu/~abh/index.html">CellCheck</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="https://www.cise.ufl.edu/~abh/providers.php ">Providers</a></li>
				<li><a href="https://www.cise.ufl.edu/~abh/contracts.html">Contracts</a></li>
				<li><a href="https://www.cise.ufl.edu/~abh/coverage.html">Coverage</a></li>
				<li class="active" style="position:absolute;right:100px;">
					<a class="nav-link" href="https://www.cise.ufl.edu/~abh/stats.php">Stats</a>
				</li>
				<li style="position:absolute;right:10px;">
					<a class="nav-link" href="https://www.cise.ufl.edu/~abh/index.html">Logout</a>
				</li>
			</ul>
		</div>
	</nav>

<div class="container">
		<div style="text-align:center;">
			<h3 style="color:white;margin-top:-3px;margin-bottom:-3pxmargin-bottom:20px;margin-left:10px;">Website Statistics</h3>
		</div>

	<div class="row">
		<div id="rowOne">
			<div class="col-md-1">
			</div>
			<div class="col-md-5" style="height:365px;margin-bottom:15px;background: rgba(255, 255, 255, 0.5);border-radius:8px;margin-left:10px;margin-right:10px;text-align:left;">
				<h3 style="color:white;margin-bottom:15px;">Tuples Per Table<br></h3>
				<p></p>
				<table style="width:100%">
				  <tr>
				    <th>Table Name</th>
				    <th>Tuple Count</th>
				  </tr>
				<?php $connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
					if (!$connection) {
						 $m = oci_error();
						 echo $m['message'], "\n";
						 exit;
					}
					else {
						 //print "Sucessfully connected to Oracle!\n";
					}
					$sqlstatement = "SELECT COUNT(*) AS COUNT FROM CONTRACT";
					$test = oci_parse($connection, $sqlstatement);
					oci_execute($test);
					oci_fetch($test);
					echo "<tr><td>";
					echo "<a href='http://cise.ufl.edu/~abh/tables/contracts.php'>Contract</a>";
					echo "</td><td>";
					echo oci_result($test, 'COUNT');
					echo "</td></tr>";
					$sqlstatement = "SELECT COUNT(*) AS COUNT FROM CUSTOMER";
					$test2 = oci_parse($connection, $sqlstatement);
					oci_execute($test2);
					oci_fetch($test2);
					echo "<tr><td>";
					echo "<a href='http://cise.ufl.edu/~abh/tables/customer.php'>Customer</a>";
					echo "</td><td>";
					echo oci_result($test2, 'COUNT');
					echo "</td></tr>";
					$sqlstatement = "SELECT COUNT(*) AS COUNT FROM FL_CELL_SITES";
					$test3 = oci_parse($connection, $sqlstatement);
					oci_execute($test3);
					oci_fetch($test3);
					echo "<tr><td>";
					echo "<a href='http://cise.ufl.edu/~abh/tables/cellsites.php'>Florida cell sites</a>";
					echo "</td><td>";
					echo oci_result($test3, 'COUNT');
					echo "</td></tr>";
					$sqlstatement = "SELECT COUNT(*) AS COUNT FROM FL_CELL_TOWERS";
					$test4 = oci_parse($connection, $sqlstatement);
					oci_execute($test4);
					oci_fetch($test4);
					echo "<tr><td>";
					echo "<a href='http://cise.ufl.edu/~abh/tables/cellsites.php'>Florida cell towers</a>";
					echo "</td><td>";
					echo oci_result($test4, 'COUNT');
					echo "</td></tr>";
					$sqlstatement = "SELECT COUNT(*) AS COUNT FROM NETWORK";
					$test5 = oci_parse($connection, $sqlstatement);
					oci_execute($test5);
					oci_fetch($test5);
					echo "<tr><td>";
					echo "<a href='http://cise.ufl.edu/~abh/tables/network.php'>Network</a>";
					echo "</td><td>";
					echo oci_result($test5, 'COUNT');
					echo "</td></tr>";
					$sqlstatement = "SELECT COUNT(*) AS COUNT FROM PROVIDER";
					$test6 = oci_parse($connection, $sqlstatement);
					oci_execute($test6);
					oci_fetch($test6);
					echo "<tr><td>";
					echo "<a href='http://cise.ufl.edu/~abh/tables/provider.php'>Provider</a>";
					echo "</td><td>";
					echo oci_result($test6, 'COUNT');
					echo "</td></tr>";
					$sqlstatement = "SELECT COUNT(*) AS COUNT FROM ZIP_2_GPS";
					$test7 = oci_parse($connection, $sqlstatement);
					oci_execute($test7);
					oci_fetch($test7);
					echo "<tr><td>";
					echo "<a href='http://cise.ufl.edu/~abh/tables/zipgps.php'>Zip Code to GPS</a>";
					echo "</td><td>";
					echo oci_result($test7, 'COUNT');
					echo "</td></tr>";

					oci_free_statement($test);
					oci_free_statement($test2);
					oci_free_statement($test3);
					oci_free_statement($test4);
					oci_free_statement($test5);
					oci_free_statement($test6);
					oci_free_statement($test7);

					oci_close($connection);
				?>
			</table>
			</div>
			<div class="col-md-5" style="height:365px;margin-bottom:15px;background: rgba(255, 255, 255, 0.5);border-radius:8px;margin-left:10px;margin-right:10px;text-align:left;">
				<h3 style="color:white;">Provider Coverage in Florida<br></h3>
				<p></p>
				<div id="chartContainer" style="height: 295px; width: 100%;"></div>
				<script type="text/javascript" src="js/canvasjs.min.js"></script>
				<script type="text/javascript">
			  window.onload = function () {
			        var chart = new CanvasJS.Chart("chartContainer", {
						backgroundColor: "#929395",
			            animationEnabled: true,
			            axisY: {
			                tickThickness: 0,
			                lineThickness: 1,
			                valueFormatString: " ",
			                gridThickness: 0
			            },
			            axisX: {
			                tickThickness: 0,
			                lineThickness: 1,
			                labelFontSize: 18,
			                labelFontColor: "#333"

			            },
			            data: [
			            {
			                indexLabelFontSize: 14,
			                toolTipContent: "<span style='\"'color: {color};'\"'><strong>{indexLabel}</strong></span><span style='\"'font-size: 20px; color:peru '\"'><strong>{y}</strong></span>",

			                indexLabelPlacement: "auto",
			                indexLabelFontColor: "white",
			                indexLabelFontWeight: 100,
			                //indexLabelFontFamily: "Verdana",
			                color: "#49B24E",
			                type: "bar",
							dataPointWidth: 16,
			                dataPoints: [
			                    { y: 39, label: "39%", indexLabel: "AT&T" },
			                    { y: 14, label: "14%", indexLabel: "Sprint" },
			                    { y: 38, label: "38%", indexLabel: "T-Mobile" },
			                    { y: 8, label: "8%", indexLabel: "Verizon" },
			                ]
			            }
			            ]
			        });

			        chart.render();
			    }
			  </script>
			</div>
		</div>

		<div id="rowTwo">
			<div class="col-md-1">
			</div>
			<div class="col-md-5" style="height:365px;background: rgba(255, 255, 255, 0.5);border-radius:8px;margin-left:10px;margin-right:10px;text-align:left;">
				<h3 style="color:white;margin-bottom:15px;">Total Tuples<br></h3>
				<p>Total tuples in all of our tables is: </p>
				<span class="count">573897</span></div>
				<script>
									$('.count').each(function () {
							$(this).prop('Counter',0).animate({
									Counter: $(this).text()
							}, {
									duration: 4000,
									easing: 'swing',
									step: function (now) {
											$(this).text(Math.ceil(now));
									}
							});
					});
				</script>

			<div class="col-md-5" style="height:365px;background: rgba(255, 255, 255, 0.5);border-radius:8px;margin-left:10px;margin-right:10px;text-align:left;">
				<h3 style="color:white;margin-bottom:15px;">Most Complex Query<br></h3>
				<div style="overflow:scroll;height:300px;">
				<script src="https://pastebin.com/embed_js/p4r1BRCu"></script>

				</div>
			</div>

			<div class="col-md-1">
			</div>
		</div>
	</div>
</div>
</body>

</html>
