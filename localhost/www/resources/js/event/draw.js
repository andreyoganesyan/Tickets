var seatMap;
var reservation_dict = {};

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
  $("#event_view").empty();
  for(var row_n = 1; row_n <= seatMap.length; row_n++){
    new_row = $("<div class=\"row\"></div>");
    $("#event_view").prepend(new_row);
    for (var seat_n = 1; seat_n <=seatMap[row_n-1].length; seat_n++){
      new_seat = $("<div class=\"seat\"></div>");
      if (seatMap[row_n-1][seat_n-1].Color!=null) {
        new_seat.css("background", seatMap[row_n-1][seat_n-1].Color);
      }
      new_row.append(new_seat);
      seatMap[row_n-1][seat_n-1]["div"]=new_seat;
      new_seat.append("<span>"+seatMap[row_n-1][seat_n-1]["Seat"]+"</span>");
      new_seat.on("click", {row: row_n, seat:seat_n, seat_div:new_seat},function(ev){
          var index = toBeReserved.findIndex(function(obj) {return obj.row == ev.data.row && obj.seat==ev.data.seat});
          if(index==-1){
            toBeReserved.push({row: ev.data.row, seat:ev.data.seat});
            ev.data.seat_div.addClass("selected");
          }
          else {
            toBeReserved.splice(index,1);
            ev.data.seat_div.removeClass("selected");

          }
      });
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
  $(window).scrollTop(500);
  $(window).scrollLeft(400);
  load_reservations();
}

function draw_reservations(reservations){
  $("#reservations_container").empty();
  for(var i=0; i<reservations.length;i++){
    var reservation = reservations[i];
    reservation_dict[reservation["idReservation"]] = reservation;
    var new_reservation = $("<div class=\"reservation_div\"></div>");
    reservation["div"] = new_reservation;
    new_reservation.append($("<span class=\"reservation_name\">"+reservation["Name"]+"</span>"));
    new_reservation.append($("<span class=\"reservation_quantity\">"+reservation["Already_Reserved"]+"/"+reservation["Quantity"]+"</span>"));
    new_reservation.on("click", {idReservation: reservation["idReservation"], res_div: new_reservation},function(ev){
      if(selectingResId!=null){
      flush_selection();
      }
      selectingResId=ev.data.idReservation;
      paint_selected();
      ev.data.res_div.addClass("selected");
    });
    $("#reservations_container").append(new_reservation);
  }
}

function paint_all_seats() {
  $.ajax({
    method: "GET",
    url: apilink + "seat.php?idEvent="+idEvent,
    dataType: "json",
    cache: false
  })
  .done(function (seats) {
    console.log("Места успешно получены");
    for(var i =0; i<seats.length; i++){
      var seat = seats[i];
      if (seat.Color!=null) {
        seatMap[seat.Row-1][seat.Seat-1].div.css("background", seat.Color);
        seatMap[seat.Row-1][seat.Seat-1].Color = seat.Color;
      }
    }
  })
  .fail(function (err) {
    console.log("Ошибка во время получения мест");
  });
}
function paint_selected() {
  for (var i=0; i<seatMap.length; i++){
    for (var j = 0; j < seatMap[i].length;j++) {
      var seat = seatMap[i][j];
      if(seat.idReservation!=null){
        if(seat.idReservation==selectingResId){
          seat.div.addClass("selected");
        } else {
          seat.div.css("background","#aaa");
        }
      }
    }
  }
}
