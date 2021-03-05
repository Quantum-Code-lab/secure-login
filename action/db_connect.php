<?php
ob_start();
session_start();
//$host="localhost";
$host="127.0.0.1";
$user="root";
$password="";
$database="slrs";
$con = new Mysqli($host,$user,$password,$database);
if ($con) 
{
	//echo'connection ok';
} else {
	echo'connection fail';
}

?>