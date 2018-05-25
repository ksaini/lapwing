<?php
include_once("./mvariables.php");
verifyuser("admin","Sunny123");
include_once("variables.php");

$sessionid = 1;
$now     = date('Y/m/d', time());
$results = json_decode($_POST['secret']);
$isql     = "";

foreach ($results as $result) {
    if(strlen(trim($result)) >0){
		
	$now     = date('Y/m/d', time());
    $isql .= "INSERT INTO s_attend_tbl (sid, status, day,session)
VALUES ('$result','A' ,STR_TO_DATE('$now', '%Y/%m/%d'), $sessionid) 
ON DUPLICATE KEY UPDATE status = 'A', day = STR_TO_DATE('$now', '%Y/%m/%d') ;";
    }
}

//echo $isql;
insertdata($isql);

?>