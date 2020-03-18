<?php
include '../connect.php';

$tel=$_POST['tel'];

$sql=$mysqli->query("SELECT tel
                    FROM emp_tel
                    WHERE tel='$tel'
                    ");
$result=$sql->num_rows;
if($result>0){
    echo 'true';
}else{
    $sql=$mysqli->query("SELECT tel
                    FROM private_tel
                    WHERE tel='$tel'
                    ");
    $result=$sql->num_rows;
    if($result>0){
        echo 'true';
    }
    else{
        echo 'false';
    }
}
?>