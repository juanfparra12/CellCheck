#!/usr/local/bin/php
<div class "table-container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>RADIO</th>
        <th>MCC</th>
        <th>MNC</th>
        <th>CID</th>
        <th>TID</th>
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
$sqlstatement = "SELECT RADIO, MCC, MNC, CID, TID FROM FL_CELL_SITES";
$test = oci_parse($connection, $sqlstatement);
oci_execute($test);
while(oci_fetch($test)){
  echo "<tr><td>";
  echo oci_result($test, 'RADIO');
  echo "</td><td>";
  echo oci_result($test, 'MCC');
  echo "</td><td>";
  echo oci_result($test, 'MNC');
  echo "</td><td>";
  echo oci_result($test, 'CID');
  echo "</td><td>";
  echo oci_result($test, 'TID');
  echo "</td></tr>";
}
oci_free_statement($test);
oci_close($connection);
?>
</tbody>
</table>
