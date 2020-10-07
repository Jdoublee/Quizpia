<?PHP

session_start();

include'db_conn.php';
include'banner.php';

?>
<!--객관식 문제 정답 체크 페이지-->
<!doctype html>
<html class="h-100">
<head>

<meta charset="utf-8">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

<link type = "text/css" rel="stylesheet" href="sytle.css">

    <title>result</title>
    <meta charset="utf-8">
    <style>
        .correct_answer{color:blue;font-weight:bolder;}
        .check_answer{background-color:yellow;}
        .wrong_answer{color:red;}
        .mydiv:hover{
          background-color: white;
          color: #29a745;
        }
    </style>
    <script>
      function myPrev(){
        $("textarea[name='btype']").val("prev");
        document.myform.submit();
      }
      function myForw(){
        $("textarea[name='btype']").val("forw");
        document.myform.submit();
      }
      function toMain()
      {
        window.location.href="index.php";
      }
    </script>
</head>
<body class="h-100">
  <form class="h-100 w-100 d-flex flex-column justify-content-center align-items-center" name="myform" action="quiz_a.php" method="post">

      <?php
        session_start();
        $qid=$_SESSION['qid'];
        $gid=$_SESSION['gid'];
        $con=mysqli_connect("localhost","root","sinstop216","modular10")or die("Could not connect to mysql");#데이터베이스 연결
        $query="SELECT * FROM quiz_a WHERE id='$qid'";#quiz_ma테이블 불러오기 'id' 랑 'gid' 필요    -> 어떻게 받아올지 필요

        $result=mysqli_query($con,$query);
        $row=mysqli_fetch_array($result);
        $input=array();
        $uanswer=array();

        $canswer1=$row['canswer1']."";
        $canswer2=$row['canswer2']."";
        $uanswer=5;
        $ansN=2;
        if($canswer2=="")
        {
          $ansN--;
        }

        echo "<div class='btn btn-outline-success mydiv' style='width: 600px;'><p>".$row['question']."</p></div>";
        for($i=1;$i<6;$i++)
        {
            if(isset($_POST["answer$i"]))
            {
              $input[]=$_POST["answer$i"];//사용자 답안 저장
            }
            else
            {
              $input[]="";
            }
        }

        for($i=0;$i<5;$i++)
        {
          if($input[$i]=="")
          {
            $uanswer--;
          }
        }
        $answer=array();
        $answer[]=$row['answer1'];
        $answer[]=$row['answer2'];
        $answer[]=$row['answer3'];
        $answer[]=$row['answer4'];
        $answer[]=$row['answer5'];

        $n=array();
        $n[]="①";
        $n[]="②";
        $n[]="③";
        $n[]="④";
        $n[]="⑤";
        $uname=$_SESSION['name'];
        echo "<div class='mb-2'><div class='btn btn-outline-success mydiv' style='width: 300px; height:138px; text-align:left;'>";
        if(!in_array($canswer1,$input)||!in_array($canswer2,$input))//오답일경우1
        {
          echo "<span class='wrong_answer'>오답입니다.</span><br>";
          $query="UPDATE userinfo SET count=count+1 WHERE name='$uname'";#quiz_ma테이블 불러오기 'id' 랑 'gid' 필요    -> 어떻게 받아올지 필요
          $result=mysqli_query($con,$query);
          if($scoreup==false){
            echo mysqli_error($mysqli);
          }
        }
        else if($uanswer==$ansN)//정답일경우
        {
          echo "<span class='correct_answer'>정답입니다.</span><br>";
          $query="UPDATE userinfo SET count=count+1, countC=countC+1 WHERE name='$uname'";#quiz_ma테이블 불러오기 'id' 랑 'gid' 필요    -> 어떻게 받아올지 필요
          $result=mysqli_query($con,$query);
          if($scoreup==false){
            echo mysqli_error($mysqli);
          }
        }
        else{
          echo "<span class='wrong_answer'>오답입니다.</span><br>";
          $query="UPDATE userinfo SET count=count+1 WHERE name='$uname'";#quiz_ma테이블 불러오기 'id' 랑 'gid' 필요    -> 어떻게 받아올지 필요
          $result=mysqli_query($con,$query);
          if($scoreup==false){
            echo mysqli_error($mysqli);
          }
        }
        for($j=1;$j<=5;$j++){
          if($input[$j-1]==$answer[$j-1]){//사용자가 선택한 답안을 check answer
            echo "<span>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span> ->입력 <br>";
          }
          else{
            echo "<span>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
          }
        }
        echo "</div><div class='btn btn-outline-success mydiv' style='width: 300px; height:138px; text-align:left;'>정답<br>";
        for($j=1;$j<=5;$j++){
          if($canswer1==$answer[$j-1]){//사용자가 선택한 답안을 check answer
              echo "<span class='correct_answer'>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
          }
          if($canswer2==$answer[$j-1]){//사용자가 선택한 답안을 check answer
              echo "<span class='correct_answer'>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
          }
        }
        echo "</div></div>";
      ?>
    <div>
    <input type='hidden'>
      <textarea name='btype' style="display:none;"></textarea>
      <button class='btn btn-outline-success' onclick="myPrev()" type="button">이전 문제</button>&nbsp;
      <button class='btn btn-outline-success' onclick="myForw()" type="button">다음 문제</button>&nbsp;
      <button class='btn btn-outline-success' onclick="toMain()" type="button">메인으로</button>
    </div>
  </form>
</body>
</html>
