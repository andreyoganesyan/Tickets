<?php
include_once '../../source/scripts/requires_login.php';

if(isset($_GET['idEvent'])){
  $idEvent = $_GET['idEvent'];
?>
<!doctype html>
<html>
<head>
  <title>Распределение билетов</title>
  <script>
  var idEvent = <?php echo $idEvent?>;
  </script>
  <script type="text/JavaScript" src = "../resources/js/jquery-3.2.1.js"></script>
  <script type="text/JavaScript" src = "../resources/js/common.js"></script>
  <script type="text/JavaScript" src = "../resources/js/event/load.js"></script>
  <script type="text/JavaScript" src = "../resources/js/event/draw.js"></script>
  <script type="text/JavaScript" src = "../resources/js/event/scale.js"></script>
  <script type="text/JavaScript" src = "../resources/js/event/event.js"></script>
  <script>
  $(document).ready(function(){
    bind_scale_events();
    load_seats();
    load_event_info();
    $(document).click(function(event) {
    if(!$(event.target).closest('.seat, .reservation_div').length) {
        console.log("Deselecting");
        flush_selection();
    }
  });
  });
  function adding_reservation(){
    $("body").toggleClass("adding_reservation");
  }
  function toggle_menu(){
    console.log("Toggled menu");
    $("#side_menu").toggleClass("hidden");
  }
  var numOfColors = 9;
  var lastColor = Math.floor(Math.random() * numOfColors);
  console.log(Math.floor(Math.random() * numOfColors));
  var toBeReserved = new Array();
  var selectingResId = null;

  </script>
  <link rel="stylesheet" type="text/css" href="../resources/css/common.css">
  <link rel="stylesheet" type="text/css" href="../resources/css/event.css">
</head>
<body>
  <div id="dark_background" onclick="adding_reservation()"></div>
  <div id="add_reservation_form_div">
    <div class="input_container">
      <label>Имя: </label>
        <input type="text" id="reservation_name_in_form">
    </div>
    <div class="input_container">
      <label>Количество: </label>
        <input type="text" id="reservation_quantity_in_form">
    </div>
    <div class="input_container">
    <button onclick="add_reservation()">Записать</button>
    </div>
  </div>
  <div id="side_menu">
    <div id="menu_opener" onclick="toggle_menu()"><</div>
    <h1 id="event_name_header"></h1>
    <a class="action_link" onclick="adding_reservation()">Добавить бронь</a>
    <div id="reservations_container"></div>
  </div>
  <div id="event_view">

  </div>

</body>
</html>

<?php
}
?>
