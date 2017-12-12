<?php

require_once "../../source/scripts/db.php";
checkAccessToEvent();

function get_seats($idEvent){
  dbConnect("tickets");
  $sql = "select s.*,r.Color from seat s
          left join reservation r
          on s.idReservation = r.idReservation
          where s.idEvent = '$idEvent'";
  $result = mysql_query($sql);
  if ($result){
    while($seat = mysql_fetch_assoc($result)){
      $seats[] = $seat;
    }
  } else {return NULL;}
  return $seats;
}

if(isset($_GET['idEvent'])){
  exit(json_encode(get_seats($_GET['idEvent'])));
}
?>
