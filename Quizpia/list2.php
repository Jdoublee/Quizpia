<?PHP
session_start();
include 'db_conn.php';
include 'banner.php';

if (isset($_GET['_page']))
{
	$_page=$_GET['_page'];
}
else{
	$_page=1;		 //페이지 번호가 지정이 안되었을 경우

}

$_group=$_GET['_group'];
$_SESSION['gid']=$_group;
$_type=$_GET['_type'];
$view_total = 7; //한 페이지에 7개 게시글이 보인다.

$page= ($_page-1)*$view_total;


if($_type=='a')
{
	$qtype="quiz_a";
}
else if($_type=='b')
{
	$qtype="quiz_b";
}



$query2="SELECT * FROM $qtype WHERE gid='$_group' ORDER BY id DESC";
$data2=mysqli_query($mysqli,$query2);
$totals=mysqli_num_rows($data2); //data nums

$query="SELECT * FROM $qtype WHERE gid='$_group' ORDER BY id DESC limit $page,$view_total";
$data=mysqli_query($mysqli,$query);


$rr=ceil($totals/$view_total);

?>

<!Doctype html>
<html>

<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<link type = "text/css" rel="stylesheet" href="sytle.css">
<style>
.button{
	background: white;
}
a{
		color:white;
}
</style>
</head>

<body>
<center>
<br>

<div id="group_table">
<div id="group1">
<div id="group_table_child">
<?php
$query3="SELECT * FROM  groupinfo 	WHERE id='$_group'";
$data3=mysqli_query($mysqli,$query3);
$row=mysqli_fetch_array($data3);
echo $row['subject_name'];
?>
</div>
</div>

<div id="group2">
<div id="group_table_child">
<?php
echo $row['description'];
?>
</div>
</div>
</div>



<br>
<table class="bg-success" width="60%" style="color: white; border-collapse:collapse; border:3px white solid" align="center">
	<tr>
		<td class="td">Title</td>
		<td class="td">name</td>
	</tr>

<?PHP
	while($result=mysqli_fetch_array($data)){
?>
	<tr>
		<td class="td"><?php echo "<a href='".$qtype.".php?_id=".$result['id']."&_gid=".$result['gid']."'>".$result['title']."</a>";/*"<a href=$qtype.php?_id=$result['id']>".$result['title']."</a>";*/ ?></td>
		<td class="td"><?php echo $result['uid']; ?></td>
	</tr>


<?PHP } ?>

<tr>
<td colspan="3" align="center">

<?PHP

//이전 페이지 구하기
 $before= $_page-1;
 if($before<1)
 		$before=1;

//다음 페이지 구하기
$next= $_page + 1;
if($next>$rr)
		$next=$rr;


//그룹페이지 구성//
//(처음)
if($_page%10)
		$goto=$_page-$_page%10+1; //한 그룹당 10개 페이지를 지정 '10'을 넘기면 1을 증가.
elseif($goto=$_page -9); // '10'배수가 아니면 -'9'


//그룹페이지 구성 (끝)//
$last= $goto + 10; //예) $goto='1'이라면 $last='11'이 되어야 합니다.

//이전페이지 그룹 출력
$before_group= $goto -1;
if($before_group<1)
		$before_group=1;
if($_page !=1)
		echo ("<a href='./list2.php?_page=".$before_group."&_group=".$_group."&_type=".$_type."'>[◀]</a>&nbsp;"); //이전 페이지 그룹출력


 //페이지 번호 출력
for($e=$goto; $e<$last; $e++){ //현재페이지가 전체페이지 보다 작으면 페이지를 증가
	if($e>$rr) break; //총 나타날 페이지 번호 보다 크면 멈추고 다음을 실행.

	if($e==$_page)
		echo ("<strong>".$e."</strong>");  //$e 와 $_page번호가 서로 같으면....
	else
		echo ("&nbsp; <a href='./list2.php?_page=".$e."&_group=".$_group."&_type=".$_type."'>[".$e."]</a>&nbsp;");  //$e와 $_page번호가 서로 같지 않으면...
}


//다음페이지 그룹 출력
$next_group= $last;
if($next_group > $rr)($next_group=$rr); //$next_group는 $rr보다 크면 $rr은 $next_group가 된다.
if($_page !=$rr) echo ("&nbsp; <a href='./list2.php?_page=".$next_group."&_group=".$_group."&_type=".$_type."'>[▶]</a>");

?>

</td>
</tr>
	<tr>
		<td colspan="3" align="center">

		</td>

  <script>
    function myfunction2(){window.location.replace("./createB.php");}
		function myfunction3(){
		<?php
		$uname=$_SESSION['name'];
		$query="SELECT * FROM  userinfo	WHERE name='$uname'";
		$data=mysqli_query($mysqli,$query);
		$row=mysqli_fetch_array($data);
		$point=$row['point'];
		if($point<100){
			echo"
				alert('point가 충분하지 않습니다. 현재나의 point : $point');
			";
		}
		else{
			$query="UPDATE userinfo SET point=point-100 WHERE name='$uname'";
			$data=mysqli_query($mysqli,$query);
		  if($data==false){
		    echo mysqli_error($mysqli);
		  }
			echo"
				window.location.replace('./mogo.php');
			";

		}
		?>
		document.getElementById("myBtn").disabled = true;
	}
  </script>
</tr>
</tbody>
</table>
<div>
<button class="btn btn-outline-success button" onclick="myfunction2()">MakeQuiz</button>
<button id="myBtn" class="btn btn-outline-success button" onclick="myfunction3()">모의고사풀러가기!</button>
</div>
</center>
</body>

</html>
