#!/usr/local/bin/php
<div class "table-container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>NAME</th>
        <th>HEADQUARTERS</th>
        <th>CONTACT</th>
        <th>DESCRIPTION</th>
        <th>WEBSITE</th>
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
$sqlstatement = "SELECT NAME, HEADQUARTERS, CONTACT, DESCRIPTION, WEBSITE FROM PROVIDER";
$test = oci_parse($connection, $sqlstatement);
oci_execute($test);
while(oci_fetch($test)){
  echo "<tr><td>";
  echo oci_result($test, 'NAME');
  echo "</td><td>";
  echo oci_result($test, 'HEADQUARTERS');
  echo "</td><td>";
  echo oci_result($test, 'CONTACT');
  echo "</td><td>";
  echo oci_result($test, 'DESCRIPTION');
  echo "</td><td>";
  echo oci_result($test, 'WEBSITE');
  echo "</td></tr>";
}
oci_free_statement($test);
oci_close($connection);
?>
</tbody>
</table>
