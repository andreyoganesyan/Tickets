<?php

require_once "../../source/scripts/db.php";
checkAccessToEvent();

function get_event($idEvent){
	dbConnect("tickets");
	$sql = "select * from event where idEvent = '$idEvent'";
	$result = mysql_query($sql);
	if (!$result){
		exit(NULL);
	}
	return mysql_fetch_assoc($result);
}

function get_events_by_user_id($idUser){
	dbConnect("tickets");
	$sql = "select e.*
	  from event e, event_user eu, user u
	  where e.idEvent = eu.idEvent
	    and eu.idUser = u.idUser
	    and u.idUser = '$idUser'";
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

function create_event($name, $idUser){
	$sql = "insert into event (event.Name) values ('$name')";
	$link = dbConnect("tickets");
	$result = mysql_query($sql, $link);
	$idEvent = mysql_insert_id($link);
	add_access_to_event($idEvent,$idUser);
}
function update_event($idEvent,$name){
	dbConnect("tickets");
	$sql = "update event
	  set Name = '$name'
	  where idEvent = '$idEvent'";
	$result = mysql_query($sql, $link);
}
function add_access_to_event($idEvent,$idUser){
	dbConnect("tickets");
	$sql = "insert into event_user (event_user.idEvent,event_user.idUser) values ('$idEvent', '$idUser')";
	$result = mysql_query($sql, $link);
}


if (isset($_POST['name'])) {
	if (isset($_POST['idEvent'])) {
		update_event($_POST['idEvent'], $_POST['name']);
	} else {
		create_event($_POST['name'], $_SESSION['idUser']);
	}
}
elseif (isset($_POST["idUser"]) and isset($_POST["idEvent"])) {
	add_access_to_event($_POST["idEvent"],$_POST["idUser"]);
}
elseif (isset($_GET["idEvent"])){
	$value = get_event($_GET["idEvent"]);
	exit(json_encode($value));
}
elseif (isset($_SESSION["idUser"])) {
		$value = get_events_by_user_id($_SESSION["idUser"]);
		exit(json_encode($value));
}
else {
	header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
	exit();
}



exit();
?>
