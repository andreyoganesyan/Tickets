<!doctype html>
<html>
	<head>
		<title>Регистрация</title>
		 <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	</head>
	<body>
		<h1>Регистрация</h1>
		<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
			<p>Логин</p>
			<p><input name="username" type="text"></p>
			<p>Пароль</p>
			<p><input name="password" type="password"></p>
			<p><input type="submit" name="submitok" value="OK"></p>
		</form>
	</body>
</html>