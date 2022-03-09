<?php 
session_start();

if(isset($_SESSION["EMAIL"]) == true){
	$result = ["CUS_NO" => $_SESSION["CUS_NO"] ,"EMAIL" => $_SESSION["EMAIL"], "CUS_NAME" => $_SESSION["CUS_NAME"], "CUS_TEL" => $_SESSION["CUS_TEL"]];
	echo json_encode($result);
}else{ //尚未登入
	echo "{}";
}
?>