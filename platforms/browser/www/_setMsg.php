<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
include_once("./mvariables.php");
verifyuser("admin","Sunny123");
include_once("./variables.php");

$scope = $_GET["scope"];
$sid = $_GET["sid"];
$cid = $_GET['cid'];
$msg = $_GET['msg'];

$sql = "INSERT into m_msg_tbl (msg,scope,scopeid,cid) VALUES('$msg','$scope',$sid,$cid)";
insertdata($sql);


?>