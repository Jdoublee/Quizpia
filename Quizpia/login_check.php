<?php

include 'db_conn.php';

session_start();
$id=$_POST['userid'];
$pw=$_POST['userpw'];

$query="select * from userinfo WHERE id='$id' ";
$result=mysqli_query($mysqli,$query);


if(mysqli_num_rows($result)){
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	if($row['pw']==$pw){
		$_SESSION['id']=$id;
		
		if(isset($_SESSION['id']))
		{
			$_SESSION['name']=$row['name'];
			$_SESSION['point']=$row['point'];
			$_SESSION['count']=$row['count'];
			$_SESSION['countC']=$row['countC'];
			header('Location:./index.php');
		}
		else{
			$_SESSION['id']=NULL;
			echo "<script>alert(\"존재하지 않는 아이디입니다!\");
						window.location.href='./login.php';</script>";
		}
	}
	else{
			echo "
		<script>
			alert(\"아이디 또는 비밀번호가 잘못되었습니다!\");
		window.location.href='./login.php';</script>";
		}
	}
else{
	echo "
		<script>
			alert(\"아이디 또는 비밀번호가 잘못되었습니다!\");
		window.location.href='./login.php';</script>";
}


?>