#!/usr/local/bin/php
<div class "table-container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ZIP</th>
        <th>LAT</th>
        <th>LON</th>
      </tr>
    </thead>
    <tbody>
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
$sqlstatement = "SELECT ZIP, LAT, LON FROM ZIP_2_GPS";
$test = oci_parse($connection, $sqlstatement);
oci_execute($test);
while(oci_fetch($test)){
  echo "<tr><td>";
  echo oci_result($test, 'ZIP');
  echo "</td><td>";
  echo oci_result($test, 'LAT');
  echo "</td><td>";
  echo oci_result($test, 'LON');
  echo "</td></tr>";
}
oci_free_statement($test);
oci_close($connection);
?>
</tbody>
</table>
