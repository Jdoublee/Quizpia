<?php
include('db_conn.php');

$subject_name=$_POST['sel_Subject']."";
$description=$_POST['description'];
$search="SELECT * FROM groupinfo WHERE subject_name LIKE '$subject_name'";
$result=mysqli_query($mysqli,$search);
$c=0;
while($row = mysqli_fetch_array($result)) {
  $c++;
}
if($subject_name==""||$description=="")
{
  echo "
  <script>
    alert('교과를 선택하고 설명을 입력해주세요!');
    window.location=document.referrer;
  </script>";
}
else if($c!=0)
{
  echo "
  <script>
    alert('해당그룹이 이미 존재합니다!');
    window.location.href='./index.php';
  </script>";
}
else
{
  $insert="
  INSERT INTO groupinfo (
    subject_name,
    description
  ) VALUES (
    '$subject_name',
    '$description'
    )
  ";
  $result=mysqli_query($mysqli,$insert);
  if($result==false){
    echo mysqli_error($mysqli);
  }
  echo "
  <script>
    alert('그룹을 생성했습니다!');
    window.location.href='./index.php';
  </script>";
}
?>
