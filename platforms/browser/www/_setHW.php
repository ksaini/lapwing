<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
include_once("./mvariables.php");
verifyuser("admin","Sunny123");
include_once("./variables.php");

$sub = $_GET['sub'];
//$hwdesc = nl2br($_GET['hwdesc']);
$hwdesc =  nl2br(htmlentities($_GET['hwdesc'], ENT_QUOTES, 'UTF-8'));
$cid = $_GET['cid'];
$img = $_GET['img'];
if(strlen($img) > 0)
	$img = "http://greyboxerp.com/studentapp/".$img.".jpg";

$now = date('Y/m/d', time());
$now = toDate(trim($now,'"'));

$sql = "INSERT into m_hw_tbl (cid,subject,descr,imgs,hwdate) VALUES($cid,'$sub','$hwdesc','$img','$now')";
insertdata($sql);


?>