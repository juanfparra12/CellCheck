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
	<link rel="stylesheet" type="text/css" href="https://www.cise.ufl.edu/~abh/css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="https://www.cise.ufl.edu/~abh/css/ripples.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CellCheck - Providers</title>
	<style type="text/css">

	   * { margin: 0; padding: 0; }
	   p { margin-top: 5%;padding: 0px; }
		 .cproviders{position: absolute; left: 0; top: 0; width: 100%; height: 100%; background: #49B24E;}
		 #map {
			 height: 35%;
			 width: 47%;
			 margin-right:10px;
			}
	</style>
	<link rel="stylesheet" type="text/css" href="https://www.cise.ufl.edu/~abh/kekmon.css">
</head>

<body style = "background:#26272B;">

	<nav class="navbar navbar-default"style="margin-top:-20px;background:#49B24E;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="https://www.cise.ufl.edu/~abh/index.html">CellCheck</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="https://www.cise.ufl.edu/~abh/providers.php">Providers</a></li>
				<li><a href="https://www.cise.ufl.edu/~abh/contracts.html">Contracts</a></li>
				<li class="active"><a href="https://www.cise.ufl.edu/~abh/coverage.html">Coverage</a></li>
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

		<form action="coverage.php" method="post">
			<div class="form-group">
			    <label for="sel1" style="color:#ddd;">Search Coverage<br></label>
					<div style=margin-bottom:-5px;>
					</div>
						<label class="control-label" for="provider"><br>Provider</label>
			    <select class="form-control" name="provider" style="color:#ddd;background:#49B24E; border-bottom:1px solid #ddd;">
			      <option>AT&T</option>
			      <option>Sprint</option>
			      <option>T-Mobile</option>
			      <option>Verizon</option>
			    </select>
    		</div>
			<div class="form-group label-floating" style="color:#ddd;">
					<label class="control-label" for="zip">Zip Code</label>
					<input class="form-control" name="zip" type="text" >
			</div>
			<div class="form-group label-floating" style="color:#ddd;">
				<label class="control-label" for="range">Range (miles)</label>
				<input class="form-control" name="range" type="text" >
			</div>
			<div class="form-group label-floating">
				<input type="submit"  class="btn btn-raised btn-default">
			</div>
		</form>
	</div>




	<div class="col-md-8" style="text-align:left;background: rgba(255, 255, 255, 0.5);border-radius:8px;margin-left:20px;padding-bottom:20px;" id="contractWrapper">
		<h2 style="text-align:center;">Coverage</h2>
		<div class="row">
			<div class="col-md-6">
				<?php $connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
				if (!$connection) {
					 $m = oci_error();
					 echo $m['message'], "\n";
					 exit;
				}
				else {
					 //print "Sucessfully connected to Oracle!\n";
				}
				//YOUR GPS CORDS
				$sqlstatement = "SELECT LON, LAT FROM ZIP_2_GPS WHERE zip = '$_POST[zip]'";
				$test = oci_parse($connection, $sqlstatement);
				oci_execute($test);
				oci_fetch($test);
				echo "Your selected location is: ";
				echo "<br>";
				$loc = oci_result($test, 'LAT').", ".oci_result($test, 'LON');
				$centerloc = "{lat: ".oci_result($test, 'LAT').", lng: ".oci_result($test, 'LON')."}";
				echo "$loc";
				echo "<br>";
				echo "<br>";
				//NUMBER OF TOWERS
				$sqlstatement2 = "SELECT COUNT(*) AS COUNT
					FROM
					(
					SELECT tid, lat, lon,
					  (3959 * ACOS(
					               COS(lat/57.29577951)
					             * COS(ziplat/57.29577951)
					             * COS((lon/57.29577951) - (ziplon/57.29577951))
					             + SIN(lat/57.29577951)
					             * SIN(ziplat/57.29577951)
					               )) AS distance
					FROM FL_CELL_TOWERS
					  JOIN
					    (
					        SELECT lat AS ziplat, lon AS ziplon
					        FROM ZIP_2_GPS
					        WHERE ZIP = '$_POST[zip]'
					    )b ON (1 = 1)
					        WHERE lat >=  ziplat - ($_POST[range]/69)
					        AND lat <=  ziplat + ($_POST[range]/69)
					        AND lon >= ziplon - ($_POST[range]/(69 * COS(ziplat/57.29577951)))
					        AND lon <= ziplon + ($_POST[range]/(69 * COS(ziplat/57.29577951)))
					  )a
					WHERE distance <= $_POST[range]
					AND tid IN(SELECT tid FROM FL_CELL_SITES WHERE mnc IN(SELECT mnc FROM NETWORK WHERE provider = '$_POST[provider]'))";
					$test = oci_parse($connection, $sqlstatement2);
					oci_execute($test);
					oci_fetch($test);
					echo "The number of cell sites with your provider is: ";
					echo oci_result($test, 'COUNT');


					//Height
					$sqlstament3 = "SELECT height FROM(SELECT height, tid, lat, lon
						FROM
						(
						  SELECT height, tid, lat, lon,
						    (3959 * ACOS(
						              COS(lat/57.29577951)
						             * COS(ziplat/57.29577951)
						             * COS((lon/57.29577951) - (ziplon/57.29577951))
						             + SIN(lat/57.29577951)
						             * SIN(ziplat/57.29577951)
						               )) AS distance
						  FROM FL_CELL_TOWERS
						    JOIN
						    (
						        SELECT lat AS ziplat, lon AS ziplon
						        FROM ZIP_2_GPS
						        WHERE ZIP = '$_POST[zip]'
						    )b ON (1 = 1)
						        WHERE lat >=  ziplat - ($_POST[range]/69)
						        AND lat <=  ziplat + ($_POST[range]/69)
						        AND lon >= ziplon - ($_POST[range]/(69 * COS(ziplat/57.29577951)))
						        AND lon <= ziplon + ($_POST[range]/(69 * COS(ziplat/57.29577951)))
						)a
						WHERE distance <= $_POST[range]
						AND tid IN(SELECT tid FROM FL_CELL_SITES WHERE mnc IN(SELECT mnc FROM NETWORK WHERE provider = '$_POST[provider]'))
						ORDER BY height DESC
						) WHERE ROWNUM = 1";
						$test2 = oci_parse($connection, $sqlstament3);
						oci_execute($test2);
						oci_fetch($test2);
						echo "<br>";
						echo "The maximum height of the tower in your area with your provider is: ";
						echo oci_result($test2, 'HEIGHT');
						echo "ft";
				oci_free_statement($test);
				oci_free_statement($test2);
				oci_close($connection);
			?>
			<?php

			//ATT
							echo "<br>";
							echo "<br>";
							$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
							 if (!$connection) {
									$m = oci_error();
									echo $m['message'], "\n";
									exit;
							 }
							 else {
							 }
							 $sqlstatement2 = "SELECT COUNT(*) AS COUNT
								 FROM
								 (
								 SELECT tid, lat, lon,
									 (3959 * ACOS(
											COS(lat/57.29577951)
											* COS(ziplat/57.29577951)
											* COS((lon/57.29577951) - (ziplon/57.29577951))
											+ SIN(lat/57.29577951)
											* SIN(ziplat/57.29577951)
												)) AS distance
				 FROM FL_CELL_TOWERS
					 JOIN
						 (
								 SELECT lat AS ziplat, lon AS ziplon
								 FROM ZIP_2_GPS
								 WHERE ZIP = '$_POST[zip]'
						 )b ON (1 = 1)
								 WHERE lat >=  ziplat - ($_POST[range]/69)
								 AND lat <=  ziplat + ($_POST[range]/69)
								 AND lon >= ziplon - ($_POST[range]/(69 * COS(ziplat/57.29577951)))
								 AND lon <= ziplon + ($_POST[range]/(69 * COS(ziplat/57.29577951)))
					 )a
				 WHERE distance <= $_POST[range]
				 AND tid IN(SELECT tid FROM FL_CELL_SITES WHERE mnc IN(SELECT mnc FROM NETWORK WHERE provider = 'AT&T'))";
				 $test = oci_parse($connection, $sqlstatement2);
				 oci_execute($test);
				 oci_fetch($test);
				 echo "The number of AT&T cell sites is: ";
				 echo oci_result($test, 'COUNT');
				 oci_free_statement($test);
				 oci_close($connection);

				 //Verizon
				 echo "<br>";
				 $connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
		 		 if (!$connection) {
		 				$m = oci_error();
		 				echo $m['message'], "\n";
		 				exit;
		 		 }
		 		 else {
		 				//print "Sucessfully connected to Oracle!\n";
		 		 }
		 		 $sqlstatement2 = "SELECT COUNT(*) AS COUNT
		 			 FROM
		 			 (
		 			 SELECT tid, lat, lon,
		 				 (3959 * ACOS(
		 											COS(lat/57.29577951)
		 										* COS(ziplat/57.29577951)
		 										* COS((lon/57.29577951) - (ziplon/57.29577951))
		 										+ SIN(lat/57.29577951)
		 										* SIN(ziplat/57.29577951)
		 											)) AS distance
		 			 FROM FL_CELL_TOWERS
		 				 JOIN
		 					 (
		 							 SELECT lat AS ziplat, lon AS ziplon
		 							 FROM ZIP_2_GPS
		 							 WHERE ZIP = '$_POST[zip]'
		 					 )b ON (1 = 1)
		 							 WHERE lat >=  ziplat - ($_POST[range]/69)
		 							 AND lat <=  ziplat + ($_POST[range]/69)
		 							 AND lon >= ziplon - ($_POST[range]/(69 * COS(ziplat/57.29577951)))
		 							 AND lon <= ziplon + ($_POST[range]/(69 * COS(ziplat/57.29577951)))
		 				 )a
		 			 WHERE distance <= $_POST[range]
		 			 AND tid IN(SELECT tid FROM FL_CELL_SITES WHERE mnc IN(SELECT mnc FROM NETWORK WHERE provider = 'Verizon'))";
		 			 $test = oci_parse($connection, $sqlstatement2);
		 			 oci_execute($test);
		 			 oci_fetch($test);
		 			 echo "The number of Verizon cell sites is: ";
		 			 echo oci_result($test, 'COUNT');
		 			 oci_free_statement($test);
					 oci_close($connection);

					 //sprint
					 echo "<br>";
					 $connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
			 		 if (!$connection) {
			 				$m = oci_error();
			 				echo $m['message'], "\n";
			 				exit;
			 		 }
			 		 else {
			 				//print "Sucessfully connected to Oracle!\n";
			 		 }
			 		 $sqlstatement2 = "SELECT COUNT(*) AS COUNT
			 			 FROM
			 			 (
			 			 SELECT tid, lat, lon,
			 				 (3959 * ACOS(
			 											COS(lat/57.29577951)
			 										* COS(ziplat/57.29577951)
			 										* COS((lon/57.29577951) - (ziplon/57.29577951))
			 										+ SIN(lat/57.29577951)
			 										* SIN(ziplat/57.29577951)
			 											)) AS distance
			 			 FROM FL_CELL_TOWERS
			 				 JOIN
			 					 (
			 							 SELECT lat AS ziplat, lon AS ziplon
			 							 FROM ZIP_2_GPS
			 							 WHERE ZIP = '$_POST[zip]'
			 					 )b ON (1 = 1)
			 							 WHERE lat >=  ziplat - ($_POST[range]/69)
			 							 AND lat <=  ziplat + ($_POST[range]/69)
			 							 AND lon >= ziplon - ($_POST[range]/(69 * COS(ziplat/57.29577951)))
			 							 AND lon <= ziplon + ($_POST[range]/(69 * COS(ziplat/57.29577951)))
			 				 )a
			 			 WHERE distance <= $_POST[range]
			 			 AND tid IN(SELECT tid FROM FL_CELL_SITES WHERE mnc IN(SELECT mnc FROM NETWORK WHERE provider = 'Sprint'))";
			 			 $test = oci_parse($connection, $sqlstatement2);
			 			 oci_execute($test);
			 			 oci_fetch($test);
			 			 echo "The number of Sprint cell sites is: ";
			 			 echo oci_result($test, 'COUNT');
			 			 oci_free_statement($test);
						 oci_close($connection);

						 //T-Mobile
						 echo "<br>";
						 $connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
						if (!$connection) {
							 $m = oci_error();
							 echo $m['message'], "\n";
							 exit;
						}
						else {
							 //print "Sucessfully connected to Oracle!\n";
						}
						$sqlstatement2 = "SELECT COUNT(*) AS COUNT
							FROM
							(
							SELECT tid, lat, lon,
								(3959 * ACOS(
														 COS(lat/57.29577951)
													 * COS(ziplat/57.29577951)
													 * COS((lon/57.29577951) - (ziplon/57.29577951))
													 + SIN(lat/57.29577951)
													 * SIN(ziplat/57.29577951)
														 )) AS distance
							FROM FL_CELL_TOWERS
								JOIN
									(
											SELECT lat AS ziplat, lon AS ziplon
											FROM ZIP_2_GPS
											WHERE ZIP = '$_POST[zip]'
									)b ON (1 = 1)
											WHERE lat >=  ziplat - ($_POST[range]/69)
											AND lat <=  ziplat + ($_POST[range]/69)
											AND lon >= ziplon - ($_POST[range]/(69 * COS(ziplat/57.29577951)))
											AND lon <= ziplon + ($_POST[range]/(69 * COS(ziplat/57.29577951)))
								)a
							WHERE distance <= $_POST[range]
							AND tid IN(SELECT tid FROM FL_CELL_SITES WHERE mnc IN(SELECT mnc FROM NETWORK WHERE provider = 'T-Mobile'))";
							$test = oci_parse($connection, $sqlstatement2);
							oci_execute($test);
							oci_fetch($test);
							echo "The number of T-mobile cell sites is: ";
							echo oci_result($test, 'COUNT');
							oci_free_statement($test);
							$floatrange = floatval($_POST[range]);
			?>
		</div>
		<div id="map" class="col-md-6">
		    <script>
		      function initMap() {
		        var uluru = <?php echo "$centerloc" ?>;
		        var map = new google.maps.Map(document.getElementById('map'), {
		          zoom: 12,
		          center: uluru
		        });
						var circle = new google.maps.Circle({
							strokeColor: '#FF0000',
							strokeOpacity: 0.8,
							strokeWeight: 2,
							fillColor: '#FF0000',
							fillOpacity: 0.35,
							map: map,
							center: uluru,
							radius: <?php echo $floatrange; ?> * 1069.34
						});
		      }
		    </script>
		</div>
	    <script async defer
	    	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAepDgr8Fu0nuNm8DTLyqDgg6zFSaeueHQ&callback=initMap">
	    </script>
			<?php

			$finalsql = "SELECT *
				FROM
				(
				SELECT tid, height, lat, lon,
					(3959 * ACOS(
											 COS(lat/57.29577951)
										 * COS(ziplat/57.29577951)
										 * COS((lon/57.29577951) - (ziplon/57.29577951))
										 + SIN(lat/57.29577951)
										 * SIN(ziplat/57.29577951)
											 )) AS distance
				FROM FL_CELL_TOWERS
					JOIN
						(
								SELECT lat AS ziplat, lon AS ziplon
								FROM ZIP_2_GPS
								WHERE ZIP = '$_POST[zip]'
						)b ON (1 = 1)
								WHERE lat >=  ziplat - ($_POST[range]/69)
								AND lat <=  ziplat + ($_POST[range]/69)
								AND lon >= ziplon - ($_POST[range]/(69 * COS(ziplat/57.29577951)))
								AND lon <= ziplon + ($_POST[range]/(69 * COS(ziplat/57.29577951)))
					)a
				WHERE distance <= $_POST[range]
				AND tid IN(SELECT tid FROM FL_CELL_SITES WHERE mnc IN(SELECT mnc FROM NETWORK WHERE provider = '$_POST[provider]'))";
				$tes = oci_parse($connection, $finalsql);
				oci_execute($tes);

			 ?>
			<div class "table-container">
				<div style="clear:both;overflow:scroll;height:390px;padding-left:5px;padding-right:5px;">

					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Tower ID</th>
								<th>Height</th>
								<th>Longitude</th>
								<th>Latitude</th>
								<th>Distance</th>
							</tr>
						</thead>
						<tbody>
							<p>
							<?php
							while(oci_fetch($tes)){
								//List Contract Name
								echo "<tr><td>";
								echo oci_result($tes, 'TID');
								echo "</td><td>";
								echo oci_result($tes, 'HEIGHT');
								echo "</td><td>";
								echo oci_result($tes, 'LON');
								echo "</td><td>";
								echo oci_result($tes, 'LAT');
								echo "</td><td>";
								echo oci_result($tes, 'DISTANCE');
								echo "</td></tr>";
							}
							oci_free_statement($tes);
							oci_close($connection);
							 ?>
						 </p>
					</tbody>
					</table>
				</div>
			</div>

	</div>

</div>
</div>
</body>

</html>
