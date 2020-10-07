<?php
$xml=new SimpleXMLElement("",0,true); // api 부분 삭제
$data_arr=$xml->deptList->list;
$dnmarr=array();
$dcdarr=array();
$updept=$_POST['updept'];
foreach($data_arr as $row)
{
  $up_dept=$row->up_dept."";
  $dept_nm=$row->dept_nm."";
  $dept_cd=$row->dept."";
  if($updept==$up_dept)
  {
    if(!in_array($dept_nm,$dnmarr))
    {
      $dnmarr[]=$dept_nm;
      $dcdarr[]=$dept_cd;
    }
  }
}
$list=array("dept_nm"=>$dnmarr,"dept_cd"=>$dcdarr);
echo json_encode($list);
?>
