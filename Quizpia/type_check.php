<?php

	session_start();
    $type=$_POST['type'];

     if($type){
	    header("Location:list2.php?_group=".$_SESSION['group']."&_type=$type") ;//문제 리스트로 이동 (페이지 필요)
    }else{
        echo "<script type='text/javascript'>
        alert('Error occured!');
        window.location = 'ch.php';</script>";//알 수 없는 에러로 타입명 잘못 받아올 경우 에러창 alert
    }

?>
