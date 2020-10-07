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
<link type = "text/css" rel="stylesheet" href="sytle.css">
<script type="text/javascript">
  $(function() {
    $('#summernote').summernote({
      height: 200,
      width: 600,         // 기본 높이값
      minHeight: 200,      // 최소 높이값(null은 제한 없음)
      maxHeight: 200,      // 최대 높이값(null은 제한 없음)
      focus: true,          // 페이지가 열릴때 포커스를 지정함
      lang: 'ko-KR'    // 한국어 지정(기본값은 en-US)
    });
  });

  function mySubmit(){
    $("textarea[name='question']").val($('#summernote').summernote('code'));
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
        url_term1+="http://wise.uos.ac.kr/uosdoc/api.ApiUcrCultTimeInq.oapi?apiKey=201811527MPB40163&year=2018&term=A10&subjectDiv="+subjectDiv;
        url_term2+="http://wise.uos.ac.kr/uosdoc/api.ApiUcrCultTimeInq.oapi?apiKey=201811527MPB40163&year=2018&term=A20&subjectDiv="+subjectDiv;
        if(subjectNm!="")
        {
          url_term1+="&subjectNm="+subjectNm;
          url_term2+="&subjectNm="+subjectNm;
        }
        break;
      case "A02":
        url_term1+="http://wise.uos.ac.kr/uosdoc/api.ApiUcrCultTimeInq.oapi?apiKey=201811527MPB40163&year=2018&term=A10&subjectDiv="+subjectDiv;
        url_term2+="http://wise.uos.ac.kr/uosdoc/api.ApiUcrCultTimeInq.oapi?apiKey=201811527MPB40163&year=2018&term=A20&subjectDiv="+subjectDiv;
        if(subjectNm!="")
        {
          url_term1+="&subjectNm="+subjectNm;
          url_term2+="&subjectNm="+subjectNm;
        }
        break;
      case "A03":
        url_term1+="http://wise.uos.ac.kr/uosdoc/api.ApiUcrMjTimeInq.oapi?apiKey=201811527MPB40163&year=2018&term=A10&deptDiv=20000&dept="+dept+"&subDept="+subDept+"&subjectDiv="+subjectDiv;
        url_term2+="http://wise.uos.ac.kr/uosdoc/api.ApiUcrMjTimeInq.oapi?apiKey=201811527MPB40163&year=2018&term=A20&deptDiv=20000&dept="+dept+"&subDept="+subDept+"&subjectDiv="+subjectDiv;
        if(subjectNm!="")
        {
          url_term1+="&subjectNm="+subjectNm;
          url_term2+="&subjectNm="+subjectNm;
        }
        break;
      case "A04":
        url_term1+="http://wise.uos.ac.kr/uosdoc/api.ApiUcrMjTimeInq.oapi?apiKey=201811527MPB40163&year=2018&term=A10&deptDiv=20000&dept="+dept+"&subDept="+subDept+"&subjectDiv="+subjectDiv;
        url_term2+="http://wise.uos.ac.kr/uosdoc/api.ApiUcrMjTimeInq.oapi?apiKey=201811527MPB40163&year=2018&term=A20&deptDiv=20000&dept="+dept+"&subDept="+subDept+"&subjectDiv="+subjectDiv;
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
  function toCreate()
  {
    window.location.href="./create.php";
  }
</script>
<style>
  .sbutton{
    color: white;
    width:120px;
  }
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
<body class="h-100 d-flex flex-column align-items-center">
  <form name="myform" action="create_process_A.php" method="post">
    <div>
      <p style="margin-top:30px;">저장그룹을 검색하여 선택하세요.</p>
      <div>
        <select id="deptSel" class="btn btn-outline-success mysel mb-2" onchange="showSubDept()" name="selDeptv">
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
      <div>
        <div id="subjectList" class="btn-group-toggle" data-toggle="buttons"></div>
      </div>
    </div>
    <p></p>
    <div>
      <p>문제를 제출하세요.</p>
      <input type="text" class="btn btn-outline-success mytext mb-2" placeholder="문제 제목 혹은 요약(50자 이내)" style="width:600px;" name="title">
      <textarea name="question"  style="display:none;"></textarea>
      <div id="summernote"></div>
    </div>
    <p></p>
    <div>
      <p>문제의 정답을 입력하고 선택하세요.(복수정답 2개까지 허용)</p>
      <div>
        <div class="input-group btn-group-toggle" data-toggle="buttons">
          <label class="sbutton btn btn-outline-success mb-1">
            <input type="checkbox" aria-label="Checkbox for following text input" name="ans1">◆
          </label>
          <input type="text" class="form-control mb-1" autocomplete="off" placeholder="선택지 1" name="ans1text">
        </div>
        <div class="btn-group-toggle input-group" data-toggle="buttons">
          <label class="sbutton btn btn-outline-success mb-1">
            <input type="checkbox"  aria-label="Checkbox for following text input" name="ans2">◆
          </label>
          <input type="text" class="form-control mb-1" aria-label="Text input with checkbox" autocomplete="off" placeholder="선택지 2" name="ans2text">
        </div>
        <div class="btn-group-toggle input-group" data-toggle="buttons">
          <label class="sbutton btn btn-outline-success mb-1">
            <input type="checkbox"  aria-label="Checkbox for following text input" name="ans3">◆
          </label>
          <input type="text" class="form-control mb-1" aria-label="Text input with checkbox" autocomplete="off" placeholder="선택지 3" name="ans3text">
        </div>
        <div class="btn-group-toggle input-group" data-toggle="buttons">
          <label class="sbutton btn btn-outline-success mb-1">
            <input type="checkbox"  aria-label="Checkbox for following text input" name="ans4">◆
          </label>
          <input type="text" class="form-control mb-1" aria-label="Text input with checkbox" autocomplete="off" placeholder="선택지 4" name="ans4text">
        </div>
        <div class="btn-group-toggle input-group" data-toggle="buttons">
          <label class="sbutton btn btn-outline-success mb-1">
            <input type="checkbox"  aria-label="Checkbox for following text input" name="ans5">◆
          </label>
          <input type="text" class="form-control mb-1" aria-label="Text input with checkbox" autocomplete="off" placeholder="선택지 5" name="ans5text">
        </div>
      </div>
    </div>
    <p></p>
    <div class="d-flex justify-content-center align-items-center">
      <input class="btn btn-outline-success ml-1 mr-1" type="button" onclick="toMain()" value="홈으로">
      <input class="btn btn-outline-success ml-1 mr-1" type="button" onclick="toCreate()" value="이전페이지로">
      <input class="btn btn-outline-success ml-1 mr-1" type="button" onclick="mySubmit()" value="문제생성">
    </div>
  </form>
</body>
</html>
