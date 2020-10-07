<?PHP

session_start();

include'db_conn.php';
include'banner.php';

?>
<!--객관식 문제 풀이 페이지 (1문제)-->
<!doctype html>
<html class="h-100 w-100">
<head>
    <title>quiz A</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link type = "text/css" rel="stylesheet" href="sytle.css">
    <style>
        body{margin:auto;width:1000px;}
        .mydiv:hover{
          background-color: white;
          color: #29a745;
        }
    </style>
    <script>
        //하나 이상 선택 검사
        function check(){
            var isChk=false;
            var arr_answer;
            for(var i=1;i<6;i++){
              arr_answer = document.getElementsByName('answer'+i);
              if(arr_answer[0].checked == true) {
                  isChk = true;
                  break;
              }
            }
            if(!isChk){
                alert("답안을 선택해주세요.");
                return false;
            }
        }
    </script>
</head>
<body class="h-100 w-100">
  <form class="h-100 w-100 d-flex flex-column justify-content-center align-items-center" name="quiz_a_part" action="answer_check_a.php" method="post" onsubmit="return check();"  >
    <div class="d-flex flex-column justify-content-center align-items-center">
      <?php
        session_start();
  		 	if(isset($_GET['_id']))
        {
          $qid=$_GET['_id'];
          $_SESSION['qid']= $qid;
        }

  			if(isset($_GET['_gid']))
        {
          $gid=$_GET['_gid'];
          $_SESSION['gid']= $gid;
  			}

        $con=mysqli_connect("localhost","root","sinstop216","modular10")or die("Could not connect to mysql");#데이터베이스 연결
        if(!isset($_POST['btype']))
        {
          $query="SELECT * FROM quiz_a WHERE id='$qid'";
        }
        else
        {
          $qid=$_SESSION['qid'];
          $gid=$_SESSION['gid'];
          $type=$_POST['btype'];
          $qtype="a";
          if($type=="prev")
          {
            $query="SELECT * FROM quiz_a WHERE id=(SELECT max(id) FROM quiz_a WHERE id<$qid)";
          }
          else if($type=="forw")
          {
            $query="SELECT * FROM quiz_a WHERE id=(SELECT min(id) FROM quiz_a WHERE id>$qid)";
          }
        }#quiz_m테이블 불러오기  'id' 랑 'gid' 필요    -> 어떻게 받아올지 필요
        $result=mysqli_query($con,$query);

        if(!$result){//db에서 못받아오는 에러 발생
            echo "문제 불러오기 실패";
            exit();
        }
        $row=mysqli_fetch_array($result);
        if($row==NULL){
            echo "<script type='text/javascript'>
                var message= alert('해당 문제가 없습니다.'); // or confirm
                document.location.href ='list2.php?_group=$gid&_type=$qtype';
                </script>";//->어느 페이지로 돌아갈지 결정 필요
        }
        //문제와 보기
        echo "<div class='btn btn-outline-success mydiv' style='width: 600px;'><p>".$row['question']."</p></div>";
        echo "<div class='btn btn-outline-success mydiv' style='width: 600px; text-align:left;'>
            &nbsp;<input type='checkbox' name='answer1' value='{$row['answer1']}' >{$row['answer1']}<br>
            &nbsp;<input type='checkbox' name='answer2' value='{$row['answer2']}' >{$row['answer2']}<br>
            &nbsp;<input type='checkbox' name='answer3' value='{$row['answer3']}' >{$row['answer3']}<br>
            &nbsp;<input type='checkbox' name='answer4' value='{$row['answer4']}' >{$row['answer4']}<br>
            &nbsp;<input type='checkbox' name='answer5' value='{$row['answer5']}' >{$row['answer5']}<br>
            </div>";
        $_SESSION['qid']=$row['id'];
      ?>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <input class="btn btn-outline-success" type="submit" value="SUBMIT">
        <input class="btn btn-outline-success" type="reset" value="RESET">
    </div>
  </form>
</body>
</html>
