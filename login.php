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

	<!-- Bootstrap Material Design -->
	<link rel="stylesheet" type="text/css" href="https://ahanuschak.com/cis4301/css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="https://ahanuschak.com/cis4301/css/ripples.min.css">
	<title>CellCheck - Home</title>
	<style type="text/css">

	   * { margin: 0; padding: 0; }
	   p { margin-top: 5%;padding: 0px; }
	   .left { position: absolute; left: 0; top: 0; width: 70%; height: 100%; background-image:url("images/index.jpg"); background-size:100% 100%; vertical-align: middle;}
     .left-inner{width: 70%; margin: 0 auto;}
		 .center{position:absolute; top:33%; width: 70%}
	   .right { position: absolute; right: 0; top: 0; width: 30%; height: 100%; background: #49B24E}

	</style>
	<link rel="stylesheet" type="text/css" href="https://ahanuschak.com/cis4301/kekmon.css">
</head>

<body>
    <div class = "left">
      <div class = "left-inner">
		<div class = "center" style="border-radius:10px;">
	        <h1 style="color:white">Welcome to CellCheck</h1>
	        <h3 style="color:#d3d3d3">Register for an account to start</h3>
	        <p style="color:#aaa"; >CellCheck aims to provide users with quick
					access to data plans offered by AT&T, Verizon, Sprint and T-Mobile. In
					addition to this, users will be able to compare prices and services
				  between the four major providers. Users benifit from quick access time
				  thanks to our optimised use of an SQL database. Once a user selects a
				  plan, they will be able to view the specific coverage from the area
				  closet to them.</p>
					<a href="register.html" class="btn btn-raised btn-success">REGISTER HERE</a>
		</div>
      </div>
    </div>
    <div class = "right">
      	<div class = "left-inner">
			<div class = "center" style="float:left;">
	        	<h3 style="color: white">Or log in to you account</h3>
				<form action="login.php" method="post">
					<div class="form-group label-floating">
						<input style="color:white" type="text" class="form-control" placeholder="Username" name="username">
					</div>
					<div class="form-group label-floating">
<!--						<label class="control-label" for="focusedInput1">Password</label>	-->
						<input type="password" class="form-control" placeholder="Password" name="password">
					</div>
					<div class="form-group label-floating">
						<input type="submit"  class="btn btn-raised btn-default">
					</div>
          <?php $connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
            if (!$connection) {
               $m = oci_error();
               echo $m['message'], "\n";
               exit;
            }
            else {
               //print "Sucessfully connected to Oracle!\n";
            }
            //echo $_POST[username];
            //echo $_POST[password];
            $username = $_POST[username];
            $sqlstatement = "SELECT password FROM customer WHERE email = '$username'";
            $test = oci_parse($connection, $sqlstatement);
            oci_execute($test);
            oci_fetch($test);
            if (oci_result($test, 'PASSWORD') == $_POST[password] && $_POST[password] != ""){
              //Correct Passowrd
              header("Location: /~abh/providers.php"); /* Redirect browser */
            }
            else{
              //Incorrect Passowrd
              echo "Incorrect username/password"; /* Redirect browser */
            }

            oci_free_statement($test);
            oci_close($connection);
          ?>
					<p><a href="forgotPassword.html" style="color:#d3d3d3">Forgot Password?</a></p>
					<p><a href="providers.php" style="color:#d3d3d3">Or use a temporary guest account</a></p>
				</form>
	  		</div>
    	</div>
  	</div>
</body>

</html>
