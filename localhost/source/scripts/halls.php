<?php
function fill_kholzy($idEvent){
  dbConnect("tickets");

  //Создаем места
  $rows = array(33,33,34,34,35,35,36,36,37,37,32,32,37,37,38,36,37,37);
  for ($row = 1; $row<=count($rows);$row++){
    for($seat = 1; $seat<=$rows[$row-1];$seat++){
      mysql_query("insert into seat (Row,Seat,idEvent) values ('$row','$seat','$idEvent')");
    }
  }
  //Левый проход
  $AISLE_WIDTH = 3;
  $l_aisle_left_seats = array(8,8,8,8,8,8,8,8,8,8,8,8,7,7,7,6,6,6);
  for ($row = 1; $row<=count($rows);$row++){
    $left_seat = $l_aisle_left_seats[$row-1];
    mysql_query("insert into aisle (idEvent, Row, Left_Seat, Width) values ('$idEvent','$row','$left_seat','$AISLE_WIDTH')");
  }
  //Правый проход
  $r_aisle_left_seats = array(25,25,26,26,27,27,28,28,29,29,24,24,30,30,31,30,31,31);
  for ($row = 1; $row<=count($rows);$row++){
    $left_seat = $r_aisle_left_seats[$row-1];
    mysql_query("insert into aisle (idEvent, Row, Left_Seat, Width) values ('$idEvent','$row','$left_seat','$AISLE_WIDTH')");
  }
  //Пульт
  mysql_query("insert into aisle (idEvent, Row, Left_Seat, Width) values ('$idEvent',12,16,6)");
  mysql_query("insert into aisle (idEvent, Row, Left_Seat, Width) values ('$idEvent',11,16,6)");
}
?>
