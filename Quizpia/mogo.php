<!--모의고사 10문제 불러오기 & 풀기-->
<!doctype html>
<html style="height:100%">
<head>
    <title>example</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

    <style>
        body{margin:auto;}
        h1{text-align:center;}
        .content{display:block; vertical-align: middle;position:relative;margin:0 auto;padding:0 10px;width:1000px; border:1px solid black;}
        .left{width:50%;}
        .right{width:50%;}
        .footer{}
        .mybutton{
          background-color: white
        }
        img{
          width:100%!important;
        }
    </style>
    <script type="text/javascript">
        //하나 이상 선택 검사
        function check(){
          for(var j=1;j<11;j++){
              var isChk = false;
              var arr_answer;
              for(var i=1;i<6;i++){
                arr_answer = document.getElementsByName('q'+j+'a'+i);
                if(arr_answer[0].checked == true) {
                    isChk = true;

                    break;
                }
              }
              if(!isChk){
                  alert("모든 문제의 답안을 선택해주세요.");
                  return false;
              }
          }
          if(confirm("답안을 제출합니다.")){
              return true;
          }else{
              return false;
          }
        }
        //새로고침시 경고창
        window.onbeforeunload = function() {
	        return "이 페이지를 떠나면 문제와 답이 저장되지 않습니다.";
        };
        window.onunload = function() {
	        return "이 페이지를 떠나면 문제와 답이 저장되지 않습니다.";
        };
        function none(){
            window.onbeforeunload = null;
            return true;
        }
    </script>
</head>
<body style="height:100%">
  <h1>모의고사</h1>
  <form class="d-flex flex-column justify-content-center align-items-center" name="quiz_part" action="mr.php" method="post" onsubmit="return check();">
          <?php
          session_start();
          $gid=$_SESSION['gid'];
          $con=mysqli_connect("localhost","root","sinstop216","modular10")or die("Could not connect to mysql");#데이터베이스 연결

          $query="SELECT distinct * FROM quiz_a WHERE gid='$gid' ORDER BY rand() limit 10";#quiz_a테이블 불러오기, 랜덤으로 10개 추출  그룹아이디 추가하기..
          $result=mysqli_query($con,$query);

          if(!$result){
              echo "문제 불러오기 실패";
              exit();
          }

          $count=0;
          while($check=mysqli_fetch_array($result))
          {
            $count++;
          }
          if($count<10)
          {
            echo "
            <script>
            alert('아...아직 문제가 10개가 되지 않았어요....문제를 더 만들어주시면 감사하겠습니다.');
            window.location.href='./index.php';
            </script>
            ";
          }
          $con=mysqli_connect("localhost","root","sinstop216","modular10")or die("Could not connect to mysql");#데이터베이스 연결

          $query="SELECT distinct * FROM quiz_a WHERE gid='$gid' ORDER BY rand() limit 10";#quiz_a테이블 불러오기, 랜덤으로 10개 추출  그룹아이디 추가하기..
          $result=mysqli_query($con,$query);

          $number=1;//문제 번호
          //$arr=array();//문제 id 저장할 배열
          echo "<div class='content d-flex mb-2' style='height:100%;'>";
          while($row=mysqli_fetch_array($result)){
              //array_push($arr,$row[0]);
              if($number<6){
                  if($number==1){
                      echo "<div class='left p-3'>";
                  }
                  echo "<p>  ".$number.". ".$row['question']."</p>";
                  echo "<input type='hidden' name='qid{$number}' value=$row[0]>
                  <input type='checkbox' name='q{$number}a1' value='{$row['answer1']}' >{$row['answer1']}<br>
                  <input type='checkbox' name='q{$number}a2' value='{$row['answer2']}' >{$row['answer2']}<br>
                  <input type='checkbox' name='q{$number}a3' value='{$row['answer3']}' >{$row['answer3']}<br>
                  <input type='checkbox' name='q{$number}a4' value='{$row['answer4']}' >{$row['answer4']}<br>
                  <input type='checkbox' name='q{$number}a5' value='{$row['answer5']}' >{$row['answer5']}<br><br>";

                  $number++;
                  if($number==6){
                      echo "</div><div class='right p-3'>";
                  }
              }else{
                  echo "<p>  ".$number.". ".$row['question']."</p>";
                  echo "<input type='hidden' name='qid{$number}' value=$row[0]>
                  <input type='checkbox' name='q{$number}a1' value='{$row['answer1']}' >{$row['answer1']}<br>
                  <input type='checkbox' name='q{$number}a2' value='{$row['answer2']}' >{$row['answer2']}<br>
                  <input type='checkbox' name='q{$number}a3' value='{$row['answer3']}' >{$row['answer3']}<br>
                  <input type='checkbox' name='q{$number}a4' value='{$row['answer4']}' >{$row['answer4']}<br>
                  <input type='checkbox' name='q{$number}a5' value='{$row['answer5']}' >{$row['answer5']}<br><br>";

                  $number++;
                  if($number==11){
                      echo "</div>";
                  }
              }
          }
          echo "</div>";

              ?>
          <div>
            <input type="hidden" name="questionN" value=<?=$number?>>
            <input class="btn btn-outline-success" type="submit" value="SUBMIT" onclick="return none();">
            <input class="btn btn-outline-success" type="reset" value="RESET">
          </div>
      </form>
</body>
</html>
