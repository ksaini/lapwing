<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
include_once("./mvariables.php");
verifyuser("admin","Sunny123");
include_once("./variables.php");

$cid = $_GET['cid'];
$mid = $_GET['mid'];
$read = $_GET['markread'];

if($read!=null && strlen($read) > 0){
	ob_start();
	insertdata("UPDATE m_msg_tbl set status =1 where mid in ($read)");
	ob_end_clean();
}

$msgs =	runQuery("SELECT m.mid,m.msg,m.scope,m.scopeid,m.ts,m.status,s.fname, m.ts from m_msg_tbl m, s_student_tbl s where  m.scope=$cid and m.scopeid= s.admn and m.status =0;");	
echo json_encode($msgs);


?>