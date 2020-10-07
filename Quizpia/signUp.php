<?php

include 'db_conn.php';

$id=$_POST['userid'];
$pw=$_POST['userpw'];
$pwc=$_POST['pwc'];
$name=$_POST['name'];

if($pw!=$pwc)
{
		echo "
		<script>
			alert(\"비밀번호 확인이 일치하지 않습니다.\");
		window.location.href='./signUpform.php';</script>";
		
		exit();
}

if($id==NULL||$pw==NULL||$name==NULL)
{
		echo "
		<script>
			alert(\"빈 영역이 존재합니다.\");
		window.location.href='./signUpform.php';</script>";
		
		exit();
}

$query="select * from userinfo WHERE id='$id' ";
$result=mysqli_query($mysqli,$query);


if(mysqli_num_rows($result))
{
		echo "
		<script>
			alert(\"중복된 아이디가 존재합니다.\");
		window.location.href='./signUpform.php';</script>";
		
		exit();
}


$signup=mysqli_query($mysqli,"INSERT INTO userinfo(id,pw,name,point,count,countC) VALUES('$id','$pw','$name',0,0,0)");
		echo "
		<script>
			alert(\"가입이 완료되었습니다!\");
		window.location.href='./login.php';</script>";

?>
