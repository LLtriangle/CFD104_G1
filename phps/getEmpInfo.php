<?php 
session_start();

if(isset($_SESSION["EMAIL"]) == true){
    $result = [
        // "EMP_NO" => $_SESSION["EMP_NO"],
        // "EMP_NAME" => $_SESSION["EMP_NAME"],
        // "EMP_PSW" => $_SESSION["EMP_PSW"],
        // "EMP_TEL" => $_SESSION["EMP_TEL"],
        // "EMP_STATE" => $_SESSION["EMP_STATE"],
        // "JOB" => $_SESSION["JOB"],
        // "CUS_PIC" => $_SESSION["CUS_PIC"],
        ];
	echo json_encode($result);
}else{ //尚未登入
	echo "{}";
}
?>