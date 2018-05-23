<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
include_once("./variables.php");

$cid = $_GET['cid'];

$result = runQuery("SELECT fname,admn,roll,fathername from s_student_tbl where cid=$cid order by fname;");
echo json_encode($result);


?>