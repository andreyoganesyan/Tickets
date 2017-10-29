<?php
include_once 'common.php';
include_once 'db.php';

session_start();

$username = isset($_POST['username']) ? $_POST['username'] : $_SESSION['username'];
$password = isset($_POST['password']) ? $_POST['password'] : $_SESSION['password'];


if(!isset($username)) {
?>
<!doctype html>
<html>
<head>
<title>Логин</title>
</head>
<body>
<h1>Залогинься!</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
<p>Логин</p>
<p><input type="text" name="username"></p>
<p>Пароль</p>
<p><input type="password" name="password"></p>
<input type="submit" value="DAVAY!">
</form>
</body>
</html>
<?php
exit;
}
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
dbConnect("mydb");
$sql = "SELECT * FROM user WHERE
username = '$username' AND password = PASSWORD('$password')";
$result = mysql_query($sql);
if (!$result) {
error(mysql_error());
}
if (mysql_num_rows($result) != 0) {
	$user = mysql_fetch_assoc($result);
	$_SESSION['idUser'] = $user['idUser'];
}
else {
unset($_SESSION['username']);
unset($_SESSION['password']);
?>
	<!doctype html>
	<html>
	<head>
	<title>Не логин</title>
	</head>
	<body>
	<h1>Упс, не получилось!</h1>
	<p>Либо пароль неправильный, либо логин, либо и то, и другое. Может, стоит <a href="/../signup/">зарегистрироваться?</a></p>
	</body>
	</html>
<?php
}
?>
