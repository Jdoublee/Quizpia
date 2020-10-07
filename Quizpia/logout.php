<?php

session_start();
$res=session_destroy();
if($res){
	header('Location:./index.php');
}

?>