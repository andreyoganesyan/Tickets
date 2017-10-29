<?php

require_once "../../source/scripts/db.php";
checkAccessToEvent();

function add_reservation($idEvent,$name, $quantity, $idGroup=NULL, $comment = NULL) {
  $idGroup = !is_null($idGroup)? "'$idGroup'" : "NULL";
  $comment = !is_null($comment)? "'$comment'" : "NULL";

  $sql = "insert into reservation (idEvent, idGroup, Name, Comment, Quantity)
    values ('$idEvent', $idGroup, '$name', $comment, '$Quantity')";
  dbConnect("mydb");
  $result = mysql_query($sql);
}

function update_reservation($idReservation, $idEvent,$name, $quantity, $idGroup=NULL, $comment = NULL){
  $idGroup = !is_null($idGroup)? "'$idGroup'" : "NULL";
  $comment = !is_null($comment)? "'$comment'" : "NULL";

  $sql = "update reservation
    set idEvent = '$idEvent', idGroup = $idGroup, Name = '$name', Comment = $comment, Quantity = '$quantity'
    where idReservation = '$idReservation'";
  dbConnect("mydb");
  $result = mysql_query($sql);
}
function reserve_seat($idReservation, $idEvent, $row, $seat){
  $idReservation = !is_null($idReservation)? "'$idReservation'" : "NULL";
  $sql = "update seat
    set idReservation = $idReservation
    where seat.idEvent = '$idEvent'
    and seat.Row = '$row'
    and seat.Seat = '$seat'";
  dbConnect("mydb");
  $result = mysql_query($sql);
}
function get_reservations($idEvent){
  $sql = "select * from reservation where idEvent = '$idEvent'";
  dbConnect("mydb");
  $result = mysql_query($sql);
}

if(isset($_POST["idReservation"],$_POST["idEvent"],$_POST["name"],$_POST["quantity"])) {
  update_reservation($_POST["idReservation"],$_POST["idEvent"],$_POST["name"],$_POST["quantity"],
                  isset($_POST["idGroup"])? $_POST["idGroup"] : NULL,
                  isset($_POST["comment"])? $_POST["comment"] : NULL);
}
elseif(isset($_POST["idEvent"],$_POST["name"],$_POST["quantity"])){
  add_reservation($_POST["idEvent"],$_POST["name"],$_POST["quantity"],
                  isset($_POST["idGroup"])? $_POST["idGroup"] : NULL,
                  isset($_POST["comment"])? $_POST["comment"] : NULL);
}
elseif(isset($_POST["idEvent"],$_POST["row"],$_POST["seat"])){
  reserve_seat(isset($_POST["idReservation"])? $_POST["idReservation"] : NULL, $_POST["idEvent"],$_POST["row"],$_POST["seat"]);
}
elseif(isset($_POST["idEvent"])){

}
else {
  header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
	exit();
}

?>
