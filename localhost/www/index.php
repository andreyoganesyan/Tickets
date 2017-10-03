<?php
header('Content-Type: text/html; charset=utf-8');

if (!ini_get('date.timezone')) {
	date_default_timezone_set('Europe/Moscow');
}

echo file_get_contents("http://localhost:7777/api/scheme.php?id=1")
?>
