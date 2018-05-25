<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
include_once("./mvariables.php");
verifyuser("admin","Sunny123");
include_once("./variables.php");

$cid = $_GET['cid'];
$mid = $_GET['mid'];


$msgs =	runQuery("SELECT * from m_msg_tbl where mid > $mid AND (scope='cid' AND scopeid=$cid)  ORDER BY mid;");
echo json_encode($msgs);


?>