<?php //signup

include_once '../../source/scripts/db.php';
include_once '../../source/scripts/common.php';

if (!isset($_POST['submitok'])):
// Display the user signup form
?>
<!doctype html>
<html>
	<head>
		<title>Регистрация</title>
		 <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	</head>
	<body>
		<h1>Регистрация</h1>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>Логин</p>
			<p><input name="username" type="text"></p>
			<p>Пароль</p>
			<p><input name="password" type="password"></p>
			<p><input type="submit" name="submitok" value="OK"></p>
		</form>
	</body>
</html>
<?php
else:
	dbConnect("mydb");
	if ($_POST['username']=='' or $_POST['password']=='') {
		error('One or more required fields were left blank.\n'.
			  'Please fill them in and try again.');
	}
	$sql = "SELECT COUNT(*) FROM user WHERE username = '$_POST[username]'";
	$result = mysql_query($sql);
	if (!$result) {
		error('A database error occurred in processing your '.
			  'submission.\nIf this error persists, please '.
			  'contact you@example.com.');
	}
	if (@mysql_result($result,0,0)>0) {
		error('A user already exists with your chosen userid.\n'.
		'Please try another.');
	}
	
	 $sql = "INSERT INTO user SET
		Username = '$_POST[username]',
		Password = PASSWORD('$_POST[password]')";
	$query_result = mysql_query($sql);
	if (!$query_result) {
		error('A database error occurred in processing your '.
		  'submission.\nIf this error persists, please '.
		  'contact you@example.com.');
	}
?>
<!doctype html>
<html>
	<head>
		<title>Регистрация успешна!</title>
		 <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	</head>
	<body>
		<h1>Регистрация прошла успешно</h1>
		<p>Перейдите на страницу <a href="../index.php">логина</a> для дальнейшей работы</p>
	</body>
</html>
<?php
endif;
?>