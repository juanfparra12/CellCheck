<?php
	$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
		if (!$connection) {
			 $m = oci_error();
			 echo $m['message'], "\n";
			 exit;
		}
		else {
		}
		$quer = "SELECT *  FROM Contract";
		$test = oci_parse($connection, $quer);
		oci_execute($test);
		while(oci_fetch($test)){
                    print 'wew lad';
                print '<tr><td>'.$test['Provider'].'</td></tr>';
    // In a loop, freeing the large variable before the 2nd fetch reduces PHP's peak memory usage
                unset($row);
                }
	/*	while(oci_fetch($test)){
			//List Contract Name
			echo "<br>";
			//echo "$_POST[provider]";
			echo oci_result($test, 'CONTRACT_NAME');
			echo oci_result($test, 'DATA_TYPE');
			echo oci_result($test, 'PRICE');
		}
		oci_free_statement($test);
		oci_close($connection);*/

	?>
