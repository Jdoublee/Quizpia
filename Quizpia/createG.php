<?PHP

session_start();

include'db_conn.php';
include'banner.php';

?>

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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link type = "text/css" rel="stylesheet" href="sytle.css">
<script type="text/javascript">
  function mySubmit(){
    alert("The form was submitted");
    document.myform.submit();
  }

  function showSubDept()
  {
    var arr, arrD, arrC, i;
    $.post('deptChange.php',{updept: $("#deptSel").val()}).done(function(data) {
      arr=JSON.parse(data);
      arrD=arr["dept_nm"];
      arrC=arr["dept_cd"];
      var page="<option default hidden value=''>학과</option>";
      for(i=0;i<arrD.length;i++){
        page+="<option value="+arrC[i]+">"+arrD[i]+"</option>";
      }
      var subSel=document.getElementById("subSel");
      subSel.innerHTML=page;

    }).fail(function(data) {
      alert("에러에여");
      return;
    });
  }

  function getSubject()
  {
    var url_term1="";
    var url_term2="";
    var dept,subDept,subjectDiv,subjectNm;
    dept=$("#deptSel").val();
    subDept=$("#subSel").val();
    subjectDiv=$("#sbjdSel").val();
    subjectNm=$("#sbjNm").val();
    if(dept==""||subDept==""||subjectDiv=="")
    {
      alert("단과대학, 학과, 교과구분을 선택하세요.")
      return ;
    }
    switch(subjectDiv)
    {
      case "A01":
        url_term1+=""+subjectDiv; // api 부분 삭제
        url_term2+=""+subjectDiv;
        if(subjectNm!="")
        {
          url_term1+="&subjectNm="+subjectNm;
          url_term2+="&subjectNm="+subjectNm;
        }
        break;
      case "A02":
        url_term1+=""+subjectDiv;
        url_term2+=""+subjectDiv;
        if(subjectNm!="")
        {
          url_term1+="&subjectNm="+subjectNm;
          url_term2+="&subjectNm="+subjectNm;
        }
        break;
      case "A03":
        url_term1+=""+dept+"&subDept="+subDept+"&subjectDiv="+subjectDiv;
        url_term2+=""+dept+"&subDept="+subDept+"&subjectDiv="+subjectDiv;
        if(subjectNm!="")
        {
          url_term1+="&subjectNm="+subjectNm;
          url_term2+="&subjectNm="+subjectNm;
        }
        break;
      case "A04":
        url_term1+=""+dept+"&subDept="+subDept+"&subjectDiv="+subjectDiv;
        url_term2+=""+dept+"&subDept="+subDept+"&subjectDiv="+subjectDiv;
        if(subjectNm!="")
        {
          url_term1+="&subjectNm="+subjectNm;
          url_term2+="&subjectNm="+subjectNm;
        }
        break;
    }
    $.post('getSubject.php',{url1: url_term1,url2: url_term2}).done(function(data) {
      arr=JSON.parse(data);
      var subjectlist="";
      arr.forEach(function(item,index){
        subjectlist+="<label class='btn btn-outline-success m-2'><input type='radio' name='sel_Subject' value="+item+">"+item+"</label>";
      });
      var sbjListDiv=document.getElementById("subjectList");
      sbjListDiv.innerHTML=subjectlist;
    }).fail(function(data) {
      alert("에러에여");
      return;
    });
  }
  function toMain()
  {
    window.location.href="./index.php";
  }
</script>
<style>
  .mysel{
    width:120px;
  }
  .mytext{
    text-align:left;
  }
  .mytext:hover{
    background-color: white;
    color: #29a745;
  }
  #subjectList{
    width: 600px;
    height: 100px;
    border: 1px solid #28a745;
    border-radius: 10px;
    overflow-y:scroll;
    padding: 2px;
  }
  #subjectList::-webkit-scrollbar{
    display: none;
  }
</style>
</head>
<body class="h-100 d-flex flex-column justify-content-center align-items-center">
  <form action="create_group.php" name="myform" method="post">
    <div>
      <p>그룹의 정보를 선택해주세요.</p>
    </div>
    <div>
      <select id="deptSel" class="btn btn-outline-success mysel mb-2" onchange="showSubDept()" name="selDept">
        <option default hidden value="">단과대학</option>
        <option value="A201120212">정경대학</option>
        <option value="A201130213">경영대학</option>
        <option value="A200110111">공과대학</option>
        <option value="A200220122">인문대학</option>
        <option value="A200280128">자연과학대학</option>
        <option value="A200370137">도시과학대학</option>
        <option value="A200590159">예술체육대학</option>
        <option value="A204000500">자유융합대학</option>
      </select>
      <select id="subSel" class="btn btn-outline-success mysel mb-2" name="selSubDept">
        <option default hidden value="">학과</option>
      </select>
      <select id="sbjdSel" class="btn btn-outline-success mysel mb-2" name="selSubjDiv">
        <option default hidden value="">교과구분</option>
        <option value="A01">교양선택</option>
        <option value="A02">교양필수</option>
        <option value="A03">전공필수</option>
        <option value="A04">전공선택</option>
      </select>
      <input id="sbjNm" class="btn btn-outline-success mytext mb-2" type="text" placeholder="검색어" style="width:140px;">
      <input type="button" class="btn btn-outline-success mb-2" onclick="getSubject()" value="검색" style="width:83px;"><br>
    </div>
    <div id="subjectList" class="btn-group-toggle mb-2" data-toggle="buttons"></div>
    <div>
      <textarea class="btn btn-outline-success mytext mb-2" placeholder="그룹에 대한 간단한 설명" style="width:600px;" name="description"></textarea>
    </div>
    <div class="d-flex justify-content-center align-items-center">
      <input class="btn btn-outline-success mr-1" type="button" onclick="toMain()" value="홈으로">
      <input class="btn btn-outline-success ml-1" type="button" onclick="mySubmit()" value="생성">
    </div>
  </form>
</body>
</html>
