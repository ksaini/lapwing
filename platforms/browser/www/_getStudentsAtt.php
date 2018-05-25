<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
include_once("./mvariables.php");
verifyuser("admin","Sunny123");
include_once("./variables.php");

$cid = $_GET['cid'];
$now = date('Y/m/d', time());
$now = date("Y-m-d", strtotime($now));

$students = runQuery("SELECT fname,admn,roll,fathername from s_student_tbl where cid=$cid order by fname;");
$attend = runQuery("SELECT sid,status from s_attend_tbl where day = '$now' ;");

$result = array();
$result['students'] = $students;
$result['attend'] = $attend;
echo json_encode($result);

?>