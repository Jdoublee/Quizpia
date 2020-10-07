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

$answer=array();
$canswer=array();
$count=0;
$i=1;
while($i<=5)
{
  $key1="ans".$i;
  $key2="ans".$i."text";
  if(isset($_POST[$key1]))
  {
    $canswer[]=$_POST[$key2];
    $count++;
  }
  $answer[]=$_POST[$key2];
  $i++;
}
if($count==1)
{
  $canswer[]="";
}




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
    window.location.href='./TP-A.php';
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
else if(empty($canswer)||$answer==array("","","","",""))
{
  echo "
  <script>
    alert('선택지를 모두 입력하고 선택해주세요!');
    window.location=document.referrer;
  </script>
  ";
}
else if(count($canswer)>2)
{
  echo "
  <script>
    alert('선택지는 최대 2개까지 허용됩니다!');
    window.location=document.referrer;
  </script>
  ";
}
else
{
  $insert="
  INSERT INTO quiz_a (
    uid,
    gid,
    title,
    question,
    answer1,
    answer2,
    answer3,
    answer4,
    answer5,
    canswer1,
    canswer2
  ) VALUES (
    '$uid',
    '$gid',
    '$title',
    '$question',
    '$answer[0]',
    '$answer[1]',
    '$answer[2]',
    '$answer[3]',
    '$answer[4]',
    '$canswer[0]',
    '$canswer[1]'
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
