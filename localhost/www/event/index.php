<?php
include_once '../../source/scripts/requires_login.php';

if(isset($_GET['idEvent'])){
  $idEvent = $_GET['idEvent'];
?>
<!doctype html>
<html>
<head>
  <title>Смотр ивента, хех</title>
  <script type="text/JavaScript" src = "../resources/js/jquery-3.2.1.js"></script>
  <script type="text/JavaScript" src = "../resources/js/common.js"></script>
  <script>
    var apilink = "../api/"
    function load_seats(){
      $.ajax({
  			method: "GET",
  			url: apilink + "seat.php?idEvent=<?php echo $idEvent;?>",
  			dataType: "json",
  			cache: false
  		})
  		.done(function (seats) {
  			console.log("Места успешно получены");
        draw_seats(seats);
  		})
  		.fail(function (err) {
  			console.log("Ошибка во время получения мест");
  		});
    }
    function load_aisles(){
      $.ajax({
  			method: "GET",
  			url: apilink + "aisle.php?idEvent=<?php echo $idEvent;?>",
  			dataType: "json",
  			cache: false
  		})
  		.done(function (aisles) {
  			console.log("Проходы успешно получены");
  			draw_aisles(aisles);
  		})
  		.fail(function (err) {
  			console.log("Ошибка во время получения проходов");
  		});
    }
  </script>
  <script>
  var seatMap;
  function draw_seats(seats){
    seatMap = new Array();
    for(var i = 0; i<seats.length;i++){
      var seat = seats[i];
      var row = seat["Row"];
      var seat_n = seat["Seat"];
      if(seatMap[row-1]==null){
        seatMap[row-1] = new Array();
      }
      seatMap[row-1][seat_n-1] = seat;
    }
    for(var row_n = 1; row_n <= seatMap.length; row_n++){

      new_row = $("<div class=\"row\"></div>");
      $("#event_view").prepend(new_row);
      for (var seat_n = 1; seat_n <=seatMap[row_n-1].length; seat_n++){
        new_seat = $("<div class=\"seat\"></div>");
        new_row.append(new_seat);
        seatMap[row_n-1][seat_n-1]["div"]=new_seat;
        new_seat.append("<span>"+seatMap[row_n-1][seat_n-1]["Seat"]+"</span>");
      }
    }
    load_aisles();
  }
  function draw_aisles(aisles){
    for(var i = 0; i<aisles.length;i++){
      var aisle = aisles[i];
      var row_n = aisle["Row"];
      var seat_n = aisle["Left_Seat"]
      if(seatMap[row_n-1][seat_n-1]!=0){
        for(var j =0; j<aisle["Width"];j++){
          seatMap[row_n-1][seat_n-1]["div"].after($("<div class=\"aisletile\"></div>"));
        }
      }
    }
  }
  function center_rows(){
    var width = $("#event_view").width();
    $(".row").each(function(){
      row = $(this);
      row.css("margin-left",(width-row.width())/2+"px");
    });
  }
  $(document).ready(function(){
    load_seats();
  });

  </script>
  <link rel="stylesheet" type="text/css" href="../resources/css/event.css">
</head>
<body>
  <div id="event_view">

  </div>
</body>
</html>

<?php
}
?>
