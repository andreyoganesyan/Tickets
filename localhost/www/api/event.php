<?php

require_once "../../source/scripts/db.php";
function get_event($idEvent){
	dbConnect("mydb");
	$sql = "select * from event where idEvent = '$idEvent'";
	$result = mysql_query($sql);
	if (!$result){
		exit(NULL);
	}
	return mysql_fetch_assoc($result);
}

function get_events_by_user_id($idUser){
	dbConnect("mydb");
	$sql = "select * from event";
	$result = mysql_query($sql);
	if (!$result){
		exit(NULL);
	}
	$events = array();
	while ($row = mysql_fetch_assoc($result)) {
		$events[] = $row;
	}
	return $events;
}

if(isset($_GET["idEvent"])){
	$value = get_event($_GET["idEvent"]);
	exit(json_encode($value));
}
if (isset($_GET["idUser"])){
	$value = get_events_by_user_id($_GET["idUser"]);
	exit(json_encode($value));
}

exit();
?>
