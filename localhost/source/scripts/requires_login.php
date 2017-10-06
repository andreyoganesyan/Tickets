<?php
include_once 'common.php';
include_once 'db.php';

session_start()

$username = isset($_POST['username']) ? $_POST['username'] : $_SESSION['username'];
$password = isset($_POST['password']) ? $_POST['password'] : $_SESSION['password'];


if(!isset($uid)) {
?>
<!doctype html>
<html>
<head>
<title>Логин</title>
</head>
<body>
<h1>Залогинься!</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
</body>
</html>

