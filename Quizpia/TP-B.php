<!doctype html>
<html class="h-100">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

<script>

  function toMain()
  {
    window.location.href="./index.php";
  }
  function toCreate()
  {
    window.location.href="./createB.php";
  }
  function tocreateG()
  {
    window.location.href="./createG.php";
  }
</script>
<style>
#mydiv{
  width: 550px;
  height: 150px;
  border: 1px solid #28a745;
  border-radius: 10px;
  overflow-y:scroll;
  padding: 2px;
}
#mydiv:hover{
  background-color: white;
  color:#28a745;
}
#mydiv::-webkit-scrollbar{
  display: none;
}
</style>
</head>
<body class="h-100 d-flex flex-column align-items-center justify-content-center">
  <div class="d-flex flex-column align-items-center justify-content-center btn btn-outline-success mb-2" id="mydiv">
    <h2>해당 그룹이 존재하지 않습니다.</h2>
    <h2>그룹생성으로 이동하시겠습니까?</h2>
  </div>
  <div class="d-flex justify-content-center align-items-center">
    <input class="btn btn-outline-success ml-1 mr-1" type="button" onclick="toMain()" value="홈으로" />
    <input class="btn btn-outline-success ml-1 mr-1" type="button" onclick="toCreate()" value="이전페이지로" />
    <input class="btn btn-outline-success ml-1 mr-1" type="button" onclick="tocreateG()" value="그룹생성으로" />
  </div>
</body>
<html>
