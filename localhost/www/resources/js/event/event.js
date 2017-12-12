function add_reservation(){
  $.post(apilink+"reservation.php", {idEvent: idEvent,
                                    name: $("#reservation_name_in_form").val(),
                                quantity: $("#reservation_quantity_in_form").val()})
    .done(function(){
      console.log("Бронь отправлена на " + apilink + "reservation.php");
      load_reservations();
    })
    .fail(function(err){
      console.log("Ошибка при отправлении брони");
    });
  $("#add_reservation_form_div input").val("");
  adding_reservation();
}

function rainbow(numOfSteps, step) {
    // This function generates vibrant, "evenly spaced" colours (i.e. no clustering). This is ideal for creating easily distinguishable vibrant markers in Google Maps and other apps.
    // Adam Cole, 2011-Sept-14
    // HSV to RBG adapted from: http://mjijackson.com/2008/02/rgb-to-hsl-and-rgb-to-hsv-color-model-conversion-algorithms-in-javascript
    var r, g, b;
    var h = step / numOfSteps;
    var i = ~~(h * 6);
    var f = h * 6 - i;
    var q = 1 - f;
    switch(i % 6){
        case 0: r = 1; g = f; b = 0; break;
        case 1: r = q; g = 1; b = 0; break;
        case 2: r = 0; g = 1; b = f; break;
        case 3: r = 0; g = q; b = 1; break;
        case 4: r = f; g = 0; b = 1; break;
        case 5: r = 1; g = 0; b = q; break;
    }
    var c = "#" + ("00" + (~ ~(r * 255)).toString(16)).slice(-2) + ("00" + (~ ~(g * 255)).toString(16)).slice(-2) + ("00" + (~ ~(b * 255)).toString(16)).slice(-2);
    return (c);
}

function flush_selection(){
  if(selectingResId==null || toBeReserved.length==0){
    deselect_all();
    return;
  }
  var reservation = reservation_dict[selectingResId];
  if (reservation.Color==null){
    lastColor=(lastColor + 1) % numOfColors;
    console.log("last color",lastColor);
    reservation.Color = rainbow(numOfColors,lastColor);
    $.post(apilink+"reservation.php", {idEvent:idEvent, idReservation:selectingResId,name: reservation.Name, quantity: reservation.Quantity,color:reservation.Color})
    .done(function(){
      console.log("Установка цвета брони\n",reservation);
    })
    .fail(function(){
      console.log("Ошибка при установке цвета брони\n",reservation);
    });
  }
  for(var i=0;i<toBeReserved.length;i++){
    $.ajax({
        method: "POST",
        url: apilink + apilink+"reservation.php",
        dataType: "json",
        data: {idEvent:idEvent, idReservation:selectingResId, row:toBeReserved[i].row, seat:toBeReserved[i].seat},
        async:false,
        cache: false
      })
      .fail(function(){
        console.log("Ошибка при бронировании места");
      });
  }
  deselect_all();
  paint_all_seats();
  load_reservations();
}

function deselect_all(){
  $(".selected").removeClass("selected");
  toBeReserved = new Array();
  selectingResId = null;
}
