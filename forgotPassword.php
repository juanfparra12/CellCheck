#!/usr/local/bin/php

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

<head>
	<!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
	<!-- Material Design fonts -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- Bootstrap Material Design -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="css/ripples.min.css">
	<title>CellCheck - Forgot Password</title>

	<style type="text/css">

	   * { margin: 0; padding: 0; }
	   p { margin-top: 5%;padding: 0px; }
	   .left { position: absolute; left: 0; top: 0; width: 70%; height: 100%; background-image:url("images/index.jpg"); background-size:100% 100%; vertical-align: middle;}
     .left-inner{width: 70%; margin: 0 auto;}
		 .center{position:absolute; top:33%; width: 70%}
	   .right { position: absolute; right: 0; top: 0; width: 30%; height: 100%; background: #49B24E}
     .center2{position:absolute; top:30%; width: 70%}

	</style>
</head>

<body>
    <div class = "left">
      <div class = "left-inner">
				<div class = "center">
	        <h1 style="color:white">Forgot your password?</h1>
	        <h3 style="color:#d3d3d3">No problem.</h3>
	        <p style="color:#d3d3d3"; >To reset your password, please enter your Cellcheck username. Cellcheck will send the password reset instructions to the email address for this account. If you don't know the username or your email address is no longer valid, please Contact Us for further assistance.</p>
					<a href="register.html" class="btn btn-raised btn-success">I need an account</a>
				</div>
      </div>
    </div>
    <div class = "right">
      <div class = "left-inner">
				<div class = "center2">
	        <h3 style="color:	white">Account Info</h3>
					<form action="forgotPassword.php" method="post">
						<div class="form-group label-floating">
							<label class="control-label" for="fname">First Name</label>
							<input class="form-control" name="fname" type="text">
						</div>
						<div class="form-group label-floating">
							<label class="control-label" for="lname">Last Name</label>
							<input class="form-control" name="lname" type="text">
						</div>
	          <div class="form-group label-floating">
							<label class="control-label" for="email">Email</label>
							<input class="form-control" name="email" type="text">
						</div>
						<input type="submit" class="btn btn-raised btn-default">
            <?php
              $connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
              if (!$connection) {
                 $m = oci_error();
                 echo $m['message'], "\n";
                 exit;
              }
              else {
                 //print "Sucessfully connected to Oracle!\n";
              }
              $newname = "$_POST[fname] $_POST[lname]";
              $sqlstatement = "SELECT Password From Customer Where name = '$newname' AND email = '$_POST[email]'";
              $test = oci_parse($connection, $sqlstatement);
              oci_execute($test);
              oci_fetch($test);
              // make nice, display on the password page
              echo "Your password is: ";
              echo (oci_result($test, 'PASSWORD'));
              oci_free_statement($test);
              oci_close($connection);
              ?>
            <p><a href="index.html" style="color:#333">Click HERE to login.</a></p>
					</form>
				</div>
      </div>
    </div?
</body>

</html>
