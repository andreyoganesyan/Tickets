<?php

require_once "../domain/scheme_domain.php";
function get_scheme($id){
		switch($id){
			case 1:
				return new Scheme("hehe",array('he','he'));
			default:
				return 0;
		}
}
	
if(isset($_GET["id"])){
	$value = get_scheme($_GET["id"]);
}
exit(json_encode($value));
?>