<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<meta charset="UTF-8">
</head>

<body>

<?PHP
	session_start();
	include 'banner.php';
?>
<center>
<div id="line">
<div id="line_child">
	<form action = "./signUp.php" method="post">
		<div>
			<label for="id">&nbsp&nbspID&nbsp&nbsp</label>
			<input type="text" name="userid"/>
		</div>
		<div>
			<label for="pw">&nbspPW&nbsp&nbsp</label>
			<input type="password" name="userpw"/>
		</div>
		<div>
			<label for="pwc">&nbspPWC&nbsp</label>
			<input type="password" name="pwc"/>
		</div>
		<div>
			<label for="name">Name</label>
			<input type="text" name="name"/>
		</div>
		<div class="button">
				<input type="submit" value="submit">
		</div>
	</form>
	</div>
	</div>
</center>
</body>
</html>
