<?php

$db_config=array(
    "host"=>"localhost",
    "user"=>"root",
    "pass"=>"jame1412",
    "dbname"=>"tot2",
    "charset"=>"utf8"
);

$mysqli = @new mysqli($db_config["host"], $db_config["user"], $db_config["pass"], $db_config["dbname"]);
if(mysqli_connect_error()) {
    //die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    die("can't connect database");
	exit;
}
if(!$mysqli->set_charset($db_config["charset"])) { // เปลี่ยน charset เป้น utf8 พร้อมตรวจสอบการเปลี่ยน
    //printf("Error loading character set utf8: %s \n", $mysqli->error);  // ถ้าเปลี่ยนไม่ได้
}else{
   // printf("Current character set: %s \n", $mysqli->character_set_name()); // ถ้าเปลี่ยนได้
}
?>