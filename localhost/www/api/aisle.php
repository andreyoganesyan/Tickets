<?php

require_once "../../source/scripts/db.php";
checkAccessToEvent();

function get_aisles($idEvent){
  dbConnect("tickets");
  $sql = "select * from aisle where idEvent = '$idEvent'";
  $result = mysql_query($sql);
  if ($result){
    while($aisle = mysql_fetch_assoc($result)){
      $aisles[] = $aisle;
    }
  } else {return NULL;}
  return $aisles;
}

if(isset($_GET['idEvent'])){
  exit(json_encode(get_aisles($_GET['idEvent'])));
}
?>
