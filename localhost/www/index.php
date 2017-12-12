<?php
include '../source/scripts/requires_login.php';
?>
<!doctype html>
<html>
<head>
  <title>Распределение билетов</title>
  <link rel="stylesheet" type="text/css" href="/resources/css/common.css">
  <link rel="stylesheet" type="text/css" href="/resources/css/main.css">

  <script type="text/JavaScript" src = "../resources/js/jquery-3.2.1.js"></script>
  <script type="text/JavaScript" src = "/resources/js/main/main.js"></script>
  <script>
  $(document).ready(function(){
    load_events();
  });
  function adding_event(){
    $("body").toggleClass("adding_event");
  }
  </script>
</head>
<body>
  <div id="wrap">
    <h1>Ваши мероприятия</h1>
    <a class="action_link" onclick="adding_event()">Добавить мероприятие</a>
    <div id="events_container"></div>
  </div>
  <div id="dark_background" onclick="adding_event()"></div>
  <div id="add_event_form_div">
    <div><label>Название мероприятия:</label></div>
    <div><input type="Text" id="event_name_input"></input><div>
    <div><button onclick="add_event()">Создать</button></div>
  </div>

</body>
</html>
