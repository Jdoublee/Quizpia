<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Bangers" rel="stylesheet">
<meta charset="UTF-8">
<link type = "text/css" rel="stylesheet" href="sytle.css">
<title>Document</title>
</head>
<body>
<header style="width:100%;" >
<div id="bar" style="height:100px;">
<div class="wrapper">
<a href = index.php><h1 style="padding-top:10px; font-size:70px; font-family: 'Bangers', cursive;" class="mt-2">Quizpia</h1></a>

<ul class="menu">

<li><a href="create.php">Create Quiz</a></li>
<li><a href="createG.php">Create Group</a></li>

<?PHP
if(isset($_SESSION['name'])){
echo "<li>";
echo  "<a href=userinfo.php> 	Welcome ".$_SESSION['name']."!</a></li>";
echo "<li><a href=logout.php>Logout</a></li>";
}
else
echo"<li><a href=login.php>Login</a></li>";
?>
</ul>
</div>
</div>
</header>
<br><br><br><br><br>

</body>
</html>
