<!--그룹 선택후 객관식 주관식 선택-->
<!doctype html>
<html class="h-100">
<head>
<title>choose type</title>
<meta charset="utf-8">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

<style>
#sbutton{
  width: 300px;
  height: 500px;
  font-size: 50px !important;
  font-weight: bold !important;
}
</style>
</head>
<body class=" h-100 d-flex flex-column justify-content-center align-items-center">
    <?php

	session_start();
	$_SESSION['group']=$_GET['_group'];
    ?>
    <form name="choose_type" class="d-flex flex-column justify-content-center align-items-center" action="type_check.php" method="post" >
      <div class="btn-group-toggle d-flex justify-content-center align-items-center" data-toggle="buttons">
        <label id="sbutton" class="btn btn-outline-success d-flex justify-content-center align-items-center">
          <input type="radio" name="type" value="a"> 객관식
        </label>
        <label id="sbutton"  class="btn btn-outline-success d-flex justify-content-center align-items-center">
          <input type="radio" name="type" value="b"> 주관식<br>
        </label>
      </div>
      <input class="btn btn-outline-success" type="submit" value="선택">
    </form>
</body>
</html>
