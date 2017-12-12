var apilink = "/api/";
function load_events(){
  $.ajax({
    method: "GET",
    url: apilink + "event.php",
    dataType: "json",
    cache: false
  })
  .done(function (events) {
    console.log("События успешно получены");
    draw_events(events);
  })
  .fail(function (err) {
    console.log("Ошибка во время получения событий");
  });
}

function draw_events(events){
  $("#events_container").empty();
  for(var i =0; i<events.length; i++){
    var new_event = events[i];
    var event_div = $("<div class = \"event_div\"></div>");
    event_div.append($("<a class = \"event_name\" href=\"/event?idEvent="+new_event["idEvent"]+"\">"+new_event["Name"]+"</a>"));
    event_div.append($("<div class=\"event_info\">" + new_event["Reserved"] + "/" + new_event["Promised"] + "/" + new_event["Total"] +"</div>"));
    $("#events_container").append(event_div);
  }
}

function add_event(){
  $.post(apilink + "event.php", {name : $("#event_name_input").val()})
  .done(function(){
    console.log("Событие отправлено на " + apilink + "event.php");
    load_events();
  })
  .fail(function(error) {
    console.log("Не удалось отправить событие на "+ apilink + "event.php");
  });
  $("#event_name_input").val("");
  $("body").toggleClass("adding_event");
}
