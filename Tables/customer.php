#!/usr/local/bin/php
<div class "table-container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>EMAIL</th>
        <th>ADDRESS</th>
        <th>NAME</th>
        <th>PASSWORD</th>
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
$sqlstatement = "SELECT EMAIL, ADDRESS, NAME, PASSWORD FROM CUSTOMER";
$test = oci_parse($connection, $sqlstatement);
oci_execute($test);
while(oci_fetch($test)){
  echo "<tr><td>";
  echo oci_result($test, 'EMAIL');
  echo "</td><td>";
  echo oci_result($test, 'ADDRESS');
  echo "</td><td>";
  echo oci_result($test, 'NAME');
  echo "</td><td>";
  echo oci_result($test, 'PASSWORD');
  echo "</td></tr>";
}
oci_free_statement($test);
oci_close($connection);
?>
</tbody>
</table>
