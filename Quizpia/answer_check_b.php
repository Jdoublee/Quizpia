<?PHP

session_start();

include'db_conn.php';
include'banner.php';

?>
<!--주관식 문제 정답 체크 페이지-->
<!doctype html>
<html class="h-100">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
  <link type = "text/css" rel="stylesheet" href="sytle.css">

  <title>result</title>

  <meta charset="utf-8">
  <style>
      .correct_answer{color:blue;}
      .wrong_answer{color:red;}
      .mydiv:hover{
        background-color: white;
        color: #29a745;
      }

      #mydiv{
        width: 600px;
        height: 200px;
        color: #28a745;
        border: 1px solid #28a745;
        border-radius: 10px;
        overflow-y:scroll;
        padding: 2px;
        margin-bottom: 5px;
      }
      #mydiv::-webkit-scrollbar{
        display: none;
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
  <form class="h-100 d-flex flex-column justify-content-center align-items-center" name="myform" action="quiz_b.php" method="post">
    <?php
      session_start();
      $qid=$_SESSION['qid'];
      $gid=$_SESSION['gid'];
      $con=mysqli_connect("localhost","root","sinstop216","modular10")or die("Could not connect to mysql");#데이터베이스 연결
      $query="SELECT * FROM quiz_b WHERE id='$qid'";#quiz_n테이블 불러오기  'id' 랑 'gid' 필요    -> 어떻게 받아올지 필요

      $result=mysqli_query($con,$query);
      $row=mysqli_fetch_array($result);

      echo "<div class='btn btn-outline-success mydiv' style='width:600px;'><p>".$row['question']."</p></div>";

      $input=trim($_POST["answer"]);//문자열 앞 뒤 공백 제거 후
      echo "<div id='mydiv' style='width:600px; text-align:left;'><span>입력한 답과 정답을 확인해주세요.</span><br>";
      echo "입력 :".$input."<br>";
      echo "정답 :".$row['answer']."</div>";
    ?>
    <div>
      <input type='hidden'>
      <textarea name='btype' style="display:none;"></textarea>
      <button class="btn btn-outline-success " onclick="myPrev()" type="button">이전 문제</button>&nbsp;
      <button class="btn btn-outline-success " onclick="myForw()" type="button">다음 문제</button>&nbsp;
      <button class="btn btn-outline-success " onclick="toMain()" type="button">메인으로</button>
    </div>
  </form>
</body>
</html>
