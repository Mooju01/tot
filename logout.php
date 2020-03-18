<?php
    session_start();
	include_once ("../connect.php");

    //*** Update Status
    $sql=$mysqli->query("UPDATE login SET login_status = '0',
                         last_update = '0000-00-00 00:00:00'
                         WHERE username = '".$_SESSION["username"]."' ");

    session_destroy();
    header("location:../index.php"); 

?>