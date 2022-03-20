<?php 
session_start();

if(isset($_SESSION["EMP_EMAIL"]) == true){
    $result = [
        "EMP_NO" => $_SESSION["EMP_NO"],
        "EMP_NAME" => $_SESSION["EMP_NAME"],
        "EMP_EMAIL" => $_SESSION["EMP_EMAIL"],
        "EMP_TEL" => $_SESSION["EMP_TEL"],
        "EMP_ADD" => $_SESSION["EMP_ADD"],
        "JOB" => $_SESSION["JOB"],
        "EMP_PIC" => $_SESSION["EMP_PIC"],
        ];
	echo json_encode($result);
}else{ //尚未登入
	echo "{}";
}
?>