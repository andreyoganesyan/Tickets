<?php // db.php
 
$dbhost = "127.0.0.1:3306";
$dbuser = "root"; //Это надо будет поменять
$dbpass = "root";
 
function dbConnect($db="") {
global $dbhost, $dbuser, $dbpass;

$dbcnx = mysql_connect($dbhost, $dbuser, $dbpass)
or die("The site database appears to be down.");

if ($db!="" and !mysql_select_db($db))
die("The site database is unavailable.");
 
return $dbcnx;
}
?>