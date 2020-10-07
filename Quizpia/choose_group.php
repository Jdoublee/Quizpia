<!--그룹 선택-->
<!doctype html>
<html>
<head>
    <title>choose group</title>
    <meta charset="utf-8">   
    <!--<script>
        function tochoosetype(){
            window.location.href="ch.php";
        }
    
    </script>-->
</head>
<body>
    <!--
    <button name="group" value="1" onclick="tochoosetype();">그룹 1</button>
    <button name="group" value="2" onclick="tochoosetype();">그룹 2</button>
    <button name="group" value="3" onclick="tochoosetype();">그룹 3</button>

    -->

    <form name="choose_group" action="choose_quiz_type.php" method="post" >
 
    <div id="opt1">
    <input type="radio" value="1" name="group" > 그룹 1
    </div>

    <div id="opt2">
    <input type="radio" value="2" name="group"> 그룹 2
    </div>

    <div id="opt3">
    <input type="radio" value="3" name="group"> 그룹 3
    </div>

    <input type="submit" value="그룹 선택">

    </form>

<!--만들어진 그룹 수만큼 버튼 존재-->
</body>
</html>