<?php


$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'sinstop216';
$mysql_database = 'modular10';

$mysqli = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);



if(!$mysqli)
echo "connect error";


?>