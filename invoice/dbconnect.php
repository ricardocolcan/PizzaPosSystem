<?php
//session_start();
$host="localhost:3306";
$username="root";
$pass="";
$db="pizza_sales";
 
$conn=mysqli_connect($host,$username,$pass,$db);
if(!$conn){
	die("Database connection error");
}
?>