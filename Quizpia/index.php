<?PHP

session_start();

include'db_conn.php';
include'banner.php';

?>



<!DOCTYPE html>

<head>
<meta charset="utf-8">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

<link type = "text/css" rel="stylesheet" href="sytle.css">
<title>Document</title>
</head>
<body>
<?php


$query="select * from  groupinfo";

$data=mysqli_query($mysqli,$query);
?>

<center>
<div id="Group">
<details>
  <summary style= "color:gray; font-size:11px">그룹전체보기</summary>
	<table  style="border:0px">
	<tr >
	<?PHP
	$i=4;
	while($result=mysqli_fetch_array($data)){
?>

		<td align="center" ><?php echo "<a class='btn btn-outline-success m-1' href=choose_quiz_type.php?_group=".$result['id'].">".$result['subject_name']."</a>"?></td>

		<?PHP
		$i--;
		if($i==0){

		echo "</tr><tr>";
		$i=4;
		}
		?>

<?PHP } ?>
	</tr>
	</table>
</details>
</div>

<br><br>
</center>
</body>
</html>
