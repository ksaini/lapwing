<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
include_once("./mvariables.php");
verifyuser("admin","Sunny123");
include_once("./variables.php");

$cid = $_GET['cid'];
$now = date('Y/m/d', time());

$udates = runQuery("SELECT * from m_hw_tbl where cid=$cid AND hwdate='$now'");

echo json_encode($udates);

?>