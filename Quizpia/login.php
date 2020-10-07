<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>
	<meta charset="utf-8">
	<link type = "text/css" rel="stylesheet" href="sytle.css">
</head>
<body>

<?PHP
	session_start();
	include 'banner.php';
?>
<center>
<div id="line">
<div id="line_child">
	<form method="post" action="login_check.php">
		<div>
			<label for="userid">ID&nbsp</label>
			<input type="text" name="userid"/>
		</div>
		<div>
			<label for="userpw">PW</label>
			<input type="password" name="userpw" />
		</div>

		<div class="button">
			<button type="submut">login</button>
		</div>
	</form>
	<button onclick="location.href='signUpform.php'"> sign up</button>
	</div>
	</div>
</center>
</body>
</html>
