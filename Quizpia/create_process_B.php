<?php
session_start();
include('db_conn.php');
$uid=$_SESSION['name'];

$subjectNm=$_POST['sel_Subject'];
$search="SELECT * FROM groupinfo WHERE subject_name LIKE '$subjectNm'";
$result=mysqli_query($mysqli,$search);
$c=0;
while($row = mysqli_fetch_array($result)) {
  $gid=$row['id'];
  $c++;
}

$title=$_POST['title'];

$question=$_POST['question'];

$answer=$_POST['answer'];

if($subjectNm==NULL)
{
  echo "
  <script>
    alert('문제를 출제할 그룹을 선택해주세요!');
    window.location=document.referrer;
  </script>
  ";
}
else if($c==0)
{
  echo "
  <script>
    window.location.href='./TP-B.php';
  </script>";
}
else if($title==""||$question=="<p><br></p>")
{
  echo "
  <script>
    alert('문제제목과 문제를 작성해주세요!');
    window.location=document.referrer;
  </script>
  ";
}
else if($answer=="")
{
  echo "
  <script>
    alert('정답을 입력해주세요!');
    window.location=document.referrer;
  </script>
  ";
}
else
{
  $insert="
  INSERT INTO quiz_b (
    uid,
    gid,
    title,
    question,
    answer
  ) VALUES (
    '$uid',
    '$gid',
    '$title',
    '$question',
    '$answer'
    )
  ";
  $result=mysqli_query($mysqli,$insert);
  if($result==false){
    echo mysqli_error($mysqli);
  }
  $uname=$_SESSION['name'];
  $score="UPDATE userinfo SET point=point+10 WHERE name='$uname'";
  $scoreup=mysqli_query($mysqli,$score);
  if($scoreup==false){
    echo mysqli_error($mysqli);
  }
  echo "
  <script>
    alert('문제를 생성했습니다!');
    window.location.href='./index.php';
  </script>";
}
?>
