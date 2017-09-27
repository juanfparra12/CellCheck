#!/usr/local/bin/php
<div class "table-container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>TID</th>
        <th>HEIGHT</th>
        <th>LON</th>
        <th>LAT</th>
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
$sqlstatement = "SELECT TID, HEIGHT, LON, LAT FROM FL_CELL_TOWERS";
$test = oci_parse($connection, $sqlstatement);
oci_execute($test);
while(oci_fetch($test)){
  echo "<tr><td>";
  echo oci_result($test, 'TID');
  echo "</td><td>";
  echo oci_result($test, 'HEIGHT');
  echo "</td><td>";
  echo oci_result($test, 'LON');
  echo "</td><td>";
  echo oci_result($test, 'LAT');
  echo "</td></tr>";
}
oci_free_statement($test);
oci_close($connection);
?>
</tbody>
</table>
