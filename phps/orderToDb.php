<?php
session_start();
//customer data already in session, 
$_SESSION["CUS_NO"];
$cart = json_decode($_GET["cart"]);
try {
	require_once("connect.php"); // 開發用
    // insert 1 records into ord
    $sql = "";
    // insert many records into ord    
	
	$allTable = $pdo->query($sql);
	$Rows = $allTable->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($Rows);
} catch (PDOException $e) {
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	// echo "系統錯誤, 請通知系統維護人員<br>";
};

?>