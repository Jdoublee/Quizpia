<?PHP

session_start();

include'db_conn.php';
include'banner.php';

?>
<!--주관식 문제 풀이 페이지 (1문제)-->
<!doctype html>
<html class="h-100">
<head>
    <title>quiz B</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link type = "text/css" rel="stylesheet" href="sytle.css">
    <style>
        .mydiv:hover{
          background-color: white;
          color: #29a745;
        }
    </style>
</head>
<body class="h-100">
    <form class="h-100 w-100 d-flex flex-column justify-content-center align-items-center" name="quiz_b_part" action="answer_check_b.php" method="post" >
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
              $query="SELECT * FROM quiz_b WHERE id='$qid'";
            }
            else
            {
              $qid=$_SESSION['qid'];
              $gid=$_SESSION['gid'];
              $type=$_POST['btype'];
              $qtype="b";
              if($type=="prev")
              {
                $query="SELECT * FROM quiz_b WHERE id=(SELECT max(id) FROM quiz_a WHERE id<$qid)";
              }
              else if($type=="forw")
              {
                $query="SELECT * FROM quiz_b WHERE id=(SELECT min(id) FROM quiz_a WHERE id>$qid)";
              }
            }#quiz_m테이블 불러오기  'id' 랑 'gid' 필요    -> 어떻게 받아올지 필요#quiz_n테이블 불러오기 'id' 랑 'gid' 필요    -> 어떻게 받아올지 필요
            $result=mysqli_query($con,$query);

            if(!$result){
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

            echo "<div class='btn btn-outline-success mydiv'><p>".$row['question']."</p><div>";
            echo "<textarea class='btn btn-outline-success mydiv mb-2'style='text-align:left' name='answer' rows='5' cols='60' required ></textarea>";
            $_SESSION['qid']=$row['id'];
            ?>
        <div>
            <input class='btn btn-outline-success' type="submit" value="SUBMIT">
            <input class='btn btn-outline-success' type="reset" value="RESET">
        </div>
    </form>
</body>
</html>
