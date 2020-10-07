<?php
  echo "<p>입력한정답</p>";
  echo "<div class='btn-outline-success' id='mydiv'>";
  for($j=1;$j<=5;$j++){

      if($input[$j-1]==$answer[$j-1]){//사용자가 선택한 답안을 check answer
          echo "<span class='check_answer'>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
      }
      else{
        echo "<span>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
      }
  }
  echo "</div>";
  echo "<p>정답</p>";
  echo "<div class='btn-outline-success' id='mydiv'>";
  for($j=1;$j<=5;$j++){

      if($canswer1==$answer[$j-1]){//사용자가 선택한 답안을 check answer
          echo "<span class='correct_answer'>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
      }
      else if($canswer2==$answer[$j-1]){//사용자가 선택한 답안을 check answer
          echo "<span class='correct_answer>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
      }
      else{
        echo "<span>".$n[$j-1]."&nbsp;&nbsp;".$answer[$j-1]."</span><br>";
      }
  }
  echo "</div>";
?>
