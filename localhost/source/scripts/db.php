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


function checkAccessToEvent() {
  $idEvent = array();
  if(isset($_POST['idEvent'])){
  	$idEvent[] = $_POST['idEvent'];
  }
  if(isset($_GET['idEvent'])){
    $idEvent[] = $_GET['idEvent'];
  }
  session_start();
  if(isset($_SESSION['idUser'])) {
    foreach ($idEvent as $event){
  	   $idUser = $_SESSION['idUser'];
  	   $sql = "select * from event_user where idEvent = '$event' and idUser = '$idUser'";
  	   dbConnect('tickets');
  	   if (mysql_num_rows(mysql_query($sql))==0) {
         header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
         exit();
       }
    }
    return;
  }
  header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
  exit();
}
?>
