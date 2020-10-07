<!--
    모의고사 채점
    답안 최대 2개로 설정
    2개까지만 정답 비교
-->
<!doctype html>
<html>
<head>
    <title>result</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        body{margin:auto;width:1000px;}
        .correct_answer{color:blue;}
        .wrong_answer{color:red;}
        .num{font-size:25px;font-weight:lighter;}
        p{font-weight:bold;}
    </style>
    <script type="text/javascript">
      var bDisplay = true;
      function doDisplay(i){
        var con = document.getElementById("checkdetail"+i);
        if(con.style.display=='none'){
            con.style.display = 'block';
        }else{
            con.style.display = 'none';
        }
      }
  </script>
</head>
<body>
<fieldset>
    <?php

        $con=mysqli_connect("localhost","root","sinstop216","modular10")or die("Could not connect to mysql");#데이터베이스 연결
        $i=1;

        $n=array();
        $n[]="①";
        $n[]="②";
        $n[]="③";
        $n[]="④";
        $n[]="⑤";

        //$tmp=$_POST['qid'.$i];
        //echo $tmp;
        while($i<$_POST['questionN']){
            $tmp=$_POST['qid'.$i];
            $query="SELECT * FROM quiz_a WHERE id=$tmp";#quiz_ma테이블 불러오기
            $input=array();
            $result=mysqli_query($con,$query);
            $row=mysqli_fetch_array($result);
            $canswer1=$row['canswer1']."";
            $canswer2=$row['canswer2']."";

            $answer=array();
            $answer[]=$row['answer1'];
            $answer[]=$row['answer2'];
            $answer[]=$row['answer3'];
            $answer[]=$row['answer4'];
            $answer[]=$row['answer5'];

            for($j=1;$j<6;$j++)
            {
              if(isset($_POST["q$i"."a$j"])){
                $input[]=$_POST["q$i"."a$j"];//user 입력 답안
              }
              else {
                $input[]="";
              }
            }
            //입력 답안 개수 / 해당 문제
            //보기 두개까지 선택 가능
            if(!in_array($canswer1,$input))
            {
              echo "<p><i class='material-icons' style='color:red;'>check </i>";
              echo "<span class='num'>".$i."</span>. ".$row['question']."</p>";
              echo "<i class='material-icons'> subdirectory_arrow_right </i>";
              echo "<span class='wrong_answer'>  오답입니다.</span><br>";
            }
            else if(!in_array($canswer2,$input))
            {
              echo "<p><i class='material-icons' style='color:red;'>check </i>";
              echo "<span class='num'>".$i."</span>. ".$row['question']."</p>";
              echo "<i class='material-icons'> subdirectory_arrow_right </i>";
              echo "<span class='wrong_answer'>  오답입니다.</span><br>";

            }
            else{
              echo "<p><i class='material-icons' style='color:green;'>check </i>";
              echo  "<span class='num'>".$i."</span>. ".$row['question']."</p>";
              echo "<i class='material-icons'> subdirectory_arrow_right </i>";
              echo "<span class='correct_answer'>  정답입니다.</span><br>";
            }
            $i++;

            echo '<a href="javascript:doDisplay('.$i.');">> 정답 확인 </a><br>
            <div id="checkdetail'.$i.'" style="display:none;">';

            for($j=1;$j<=5;$j++){
              if($input[$j-1]==$answer[$j-1]){//사용자가 선택한 답안을 check answer
                echo "<span>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span> ->입력 <br>";
              }
              else{
                echo "<span>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
              }
            }
            echo "정답<br>";
            for($j=1;$j<=5;$j++){
              if($canswer1==$answer[$j-1]){//사용자가 선택한 답안을 check answer
                  echo "<span class='correct_answer'>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
              }
              else if($canswer2==$answer[$j-1]){//사용자가 선택한 답안을 check answer
                  echo "<span class='correct_answer'>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
              }
          }
            echo '</div>';
        }
    ?>
    </fieldset>
        <button onclick="location.href='index.php'" value="ch" type="button">메인으로</button><br>


</body>
</html>
