<?php

require_once "../../source/scripts/db.php";
checkAccessToEvent();

function add_reservation($idEvent,$name, $quantity, $idGroup=NULL, $comment = NULL,$color = NULL) {
  $idGroup = !is_null($idGroup)? "'$idGroup'" : "NULL";
  $comment = !is_null($comment)? "'$comment'" : "NULL";
  $color = !is_null($color)? "'color'" : "NULL";

  $sql = "insert into reservation (idEvent, idGroup, Name, Comment, Quantity,Color)
    values ('$idEvent', $idGroup, '$name', $comment, '$Quantity',$color)";
  dbConnect("tickets");
  $result = mysql_query($sql);
}

function update_reservation($idReservation, $idEvent,$name, $quantity, $idGroup=NULL, $comment = NULL, $color = NULL){
  $idGroup = !is_null($idGroup)? "'$idGroup'" : "NULL";
  $comment = !is_null($comment)? "'$comment'" : "NULL";
  $color = !is_null($color)? "'color'" : "NULL";

  $sql = "update reservation
    set idGroup = $idGroup, Name = '$name', Comment = $comment, Quantity = '$quantity', color = $color
    where idReservation = '$idReservation' and idEvent = '$idEvent'";
  dbConnect("tickets");
  $result = mysql_query($sql);
}
function reserve_seat($idReservation, $idEvent, $row, $seat){
  $idReservation = !is_null($idReservation)? "'$idReservation'" : "NULL";
  $sql = "update seat
    set idReservation = $idReservation
    where seat.idEvent = '$idEvent'
    and seat.Row = '$row'
    and seat.Seat = '$seat'";
  dbConnect("tickets");
  $result = mysql_query($sql);
}
function get_reservations($idEvent){
  $sql = "select * from reservation where idEvent = '$idEvent'";
  dbConnect("tickets");
  $result = mysql_query($sql);
  while ($row = mysql_fetch_assoc($result)) {
		$reservations[] = $row;
	}
  return $reservations;
}
function get_reservation($idEvent,$idReservation){
  $sql = "select * from reservation where idEvent = '$idEvent' and idReservation = '$idReservation'";
  dbConnect("tickets");
  $result = mysql_query($sql);
  return mysql_fetch_assoc($result);
}

if(isset($_POST["idReservation"],$_POST["idEvent"],$_POST["name"],$_POST["quantity"])) {
  update_reservation($_POST["idReservation"],$_POST["idEvent"],$_POST["name"],$_POST["quantity"],
                  isset($_POST["idGroup"])? $_POST["idGroup"] : NULL,
                  isset($_POST["comment"])? $_POST["comment"] : NULL,
                  isset($_POST["color"])? $_POST["color"] : NULL);
}
elseif(isset($_POST["idEvent"],$_POST["name"],$_POST["quantity"])){
  add_reservation($_POST["idEvent"],$_POST["name"],$_POST["quantity"],
                  isset($_POST["idGroup"])? $_POST["idGroup"] : NULL,
                  isset($_POST["comment"])? $_POST["comment"] : NULL,
                  isset($_POST["color"])? $_POST["color"] : NULL);
}
elseif(isset($_POST["idEvent"],$_POST["row"],$_POST["seat"])){
  reserve_seat(isset($_POST["idReservation"])? $_POST["idReservation"] : NULL, $_POST["idEvent"],$_POST["row"],$_POST["seat"]);
}
elseif (isset($_GET["idEvent"],$_GET["idReservation"])) {
  exit(json_encode(get_reservation($_GET["idEvent"],$_GET["idReservation"])));
}
elseif(isset($_GET["idEvent"])){
  exit(json_encode(get_reservations($_POST["idEvent"])));
}
else {
  header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
	exit();
}

?>
