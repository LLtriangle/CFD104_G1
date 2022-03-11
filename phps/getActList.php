<?php 
try {
	require_once("connect.php"); // 開發用
	$sql = "select * from event";
	$act = $pdo->query($sql);
	$actRows = $act->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($actRows);
} catch (PDOException $e) {
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	// echo "系統錯誤, 請通知系統維護人員<br>";
};
?>