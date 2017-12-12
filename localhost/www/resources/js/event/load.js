var apilink = "../api/"
function load_seats(){
  $.ajax({
    method: "GET",
    url: apilink + "seat.php?idEvent="+idEvent,
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
function load_event_info(){
  $.ajax({
    method: "GET",
    url: apilink + "event.php?idEvent="+idEvent,
    dataType: "json",
    cache: false
  })
  .done(function (res_event){
      console.log("Информация о событии успешно получена");
      $("#event_name_header").append(res_event["Name"]);
  });
}
function load_aisles(){
  $.ajax({
    method: "GET",
    url: apilink + "aisle.php?idEvent="+idEvent,
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


function load_reservations(){
  $.ajax({
    method: "GET",
    url: apilink + "reservation.php?idEvent="+idEvent,
    dataType: "json",
    cache: false
  })
  .done(function (reservations) {
    console.log("Брони успешно получены");
    draw_reservations(reservations);
  })
  .fail(function (err) {
    console.log("Ошибка во время получения броней\n"+err);
  });
}
