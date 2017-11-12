<?php
require_once "../../source/scripts/db.php";
checkAccessToEvent();

function get_category($idEvent,$idCategory){
  dbConnect('tickets');
  $sql = "select * from category where idCategory='$idCategory' and idEvent = '$idEvent'";
  $result = mysql_query($sql);
  return mysql_fetch_assoc($result);
}
function get_all_categories($idEvent){
  dbConnect('tickets');
  $sql = "select * from category where idEvent = '$idEvent'";
  $result = mysql_query($sql);
  if($result){
    while($category = mysql_fetch_assoc($result)){
      $categories[] = $category;
    }
    return $categories;
  }
  return NULL;
}
function create_category($idEvent, $name){
  dbConnect('tickets');
  $sql = "insert into category (idEvent,name) values ('$idEvent','$name')";
  $result = mysql_query($sql);
}
function update_category($idEvent,$idCategory,$name){
  dbConnect('tickets');
  $sql = "update category
          set name = '$name'
          where idCategory='$idCategory' and idEvent = '$idEvent'";
  $result = mysql_query($sql);
}
function delete_category($idEvent,$idCategory){
  dbConnect('tickets');
  $sql = "delete from category where idEvent = '$idEvent' and idCategory = '$idCategory'";
  $result = mysql_query($sql);
}


if(isset($_POST['idEvent'],$_POST['idCategory'],$_POST['name'])) {
  update_category($_POST['idEvent'],$_POST['idCategory'],$_POST['name']);
}
elseif(isset($_POST['idEvent'],$_POST['idCategory'])){
  delete_category($_POST['idEvent'],$_POST['idCategory']);
}
elseif(isset($_POST['idEvent'],$_POST['name'])){
  create_category($_POST['idEvent'],$_POST['name']);
}
elseif(isset($_GET['idEvent'],$_GET['idCategory'])){
  exit(json_encode(get_category($_GET['idEvent'],$_GET['idCategory'])));
}
elseif(isset($_GET['idEvent'])){
  exit(json_encode(get_all_categories($_GET['idEvent'])));
}
else {
  header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
	exit();
}



?>
