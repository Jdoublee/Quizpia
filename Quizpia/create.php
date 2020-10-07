<?PHP

session_start();

include'db_conn.php';
include'banner.php';

?>

<!doctype html>
<html class="h-100">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <link type = "text/css" rel="stylesheet" href="sytle.css">

  <style>
    body{
      text-align: center;
    }
    #sbutton{
      width: 300px;
      height: 500px;
      background-color: #FFFFFF;
      font-size: 50px !important;
      font-weight: bold !important;
    }
    #sbutton:hover{
      background-color: #28a745;
      color: #FFFFFF;
    }
  </style>
  <script>
    function toMain()
    {
      window.location.href="./index.php";
    }
    function myfunction1()
    {
      window.location.href="./createA.php";
    }
    function myfunction2()
    {
      window.location.href="./createB.php";
    }
  </script>
</head>
<body class="h-100">
  <div class="h-100 d-flex flex-column justify-content-center align-items-center">
    <div class="d-flex align-items-center">
      <button id="sbutton" type="button" class="btn btn-outline-success" onclick="myfunction1()">객관식</button>
      <button id="sbutton" type="button" class="btn btn-outline-success" onclick="myfunction2()">주관식</button>
    </div>
  </div>
</body>
</html>
