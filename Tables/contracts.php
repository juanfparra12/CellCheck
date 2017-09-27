#!/usr/local/bin/php
<div class "table-container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>CONTRACT_NAME</th>
        <th>PROVIDER</th>
        <th>DATA_TYPE</th>
        <th>DATA_CAP</th>
        <th>PRICE</th>
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
$sqlstatement = "SELECT CONTRACT_NAME, PROVIDER, DATA_TYPE, DATA_CAP, PRICE FROM CONTRACT";
$test = oci_parse($connection, $sqlstatement);
oci_execute($test);
while(oci_fetch($test)){
  echo "<tr><td>";
  echo oci_result($test, 'CONTRACT_NAME');
  echo "</td><td>";
  echo oci_result($test, 'PROVIDER');
  echo "</td><td>";
  echo oci_result($test, 'DATA_TYPE');
  echo "</td><td>";
  echo oci_result($test, 'DATA_CAP');
  echo "</td><td>";
  echo oci_result($test, 'PRICE');
  echo "</td></tr>";
}
oci_free_statement($test);
oci_close($connection);
?>
</tbody>
</table>
