<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'seolaseolu14';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sql = 'INSERT INTO projekte '.
       '(name, ordner, erlaubte_firma) '.
       'VALUES ( "guest", "XYZ", "test" )';

mysql_select_db('pda');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
mysql_close($conn);
?>