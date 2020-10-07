<?php

session_start();

include 'banner.php';
include 'db_conn.php';

?>
<!DOCTYPE html>
<html>
<body>
<center>
<div id="line">
<div id="line_child">
<?PHP
$uname=$_SESSION['name'];
$con=mysqli_connect("localhost","root","sinstop216","modular10")or die("Could not connect to mysql");#데이터베이스 연결
$query="SELECT * FROM userinfo WHERE name='$uname'";#quiz_ma테이블 불러오기 'id' 랑 'gid' 필요    -> 어떻게 받아올지 필요
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$countC=$row['countC'];
$count=$row['count'];
$point=$row['point'];
echo "NAME&nbsp:&nbsp".$_SESSION['name']."<br>";
echo "ID&nbsp : &nbsp".$_SESSION['id']."<br>";
echo "Point&nbsp:&nbsp".$point."<br>";
echo "정답률&nbsp:&nbsp";


if($countC==0)
	echo "0%";
else{
	echo (int)($countC/$count*100)."%";
}

?>

</div>
</div>
</center>
</body>
</html>
