#!/usr/local/bin/php
<?php
// Create connection to Oracle
$connection = oci_connect($username = 'anrivera', $password = '$MarkusS4301!', $connection_string = '//oracle.cise.ufl.edu/orcl');
if (!$connection) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   print "Sucessfully connected to Oracle!\n";
}
// Test functions
// $test = oci_parse($connection, 'SELECT name FROM customer');
// oci_execute($test);
// while(oci_fetch($test)){
//   echo oci_result($test, 'NAME');
//   echo "\n";
// }
// print "<table border='1'>\n";
// while ($row = oci_fetch_array($test, OCI_ASSOC+OCI_RETURN_NULLS)) {
//     print "<tr>\n";
//     foreach ($row as $item) {
//         print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
//     }
//     print "</tr>\n";
// }
// print "</table>\n";
// Close the Oracle connection
oci_free_statement($test);
oci_close($connection);
?>
