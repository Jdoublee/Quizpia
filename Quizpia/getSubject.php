<?php
$url1="";
$url2="";

$url1.=$_POST['url1'];
$url2.=$_POST['url2'];
/*
$farr=array($url1,$url2);
*/

$xml1=new SimpleXMLElement($url1,0,true);
$xml2=new SimpleXMLElement($url2,0,true);
$data_arr1=$xml1->mainlist->list;
$data_arr2=$xml2->mainlist->list;
$farr=array();
foreach($data_arr1 as $row1)
{
  if(!in_array($row1->subject_nm,$farr))
  {
    $farr[]=$row1->subject_nm."";
  }
}
foreach($data_arr2 as $row2)
{
  if(!in_array($row2->subject_nm,$farr))
  {
    $farr[]=$row2->subject_nm."";
  }
}

echo json_encode($farr);
?>
