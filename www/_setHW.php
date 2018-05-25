<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
include_once("./mvariables.php");
verifyuser("admin","Sunny123");
include_once("./variables.php");

$sub = $_GET['sub'];
$hwdesc = $_GET['hwdesc'];
$cid = $_GET['cid'];

$now = date('Y/m/d', time());
$now = toDate(trim($now,'"'));

$sql = "INSERT into m_hw_tbl (cid,subject,descr,imgs,hwdate) VALUES($cid,'$sub','$hwdesc','','$now')";
insertdata($sql);


?>