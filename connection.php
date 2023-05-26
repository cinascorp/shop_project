<?php
$host="localhost";
$username="root";
$password="";
$db="shop_project";
$mysql=new mysqli($host,$username,$password,$db);
if ($mysql->connect_error)
    die("error while connecting to database!");
?>
