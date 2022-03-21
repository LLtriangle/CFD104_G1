<?php 
session_start();
try {
	// require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
	// $sql = " SELECT * FROM sao WHERE EMP_NO='$_SESSION["EMP_NO"]' ";
	$sql = "select * FROM sch where EMP_NO = :EMP_NO";

	$info = $pdo->prepare($sql);
	$info->bindValue(":EMP_NO",$_SESSION["EMP_NO"]);
	$info->execute();
	$infos = $info->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($infos);
} catch (PDOException $e) {
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	// echo "系統錯誤, 請通知系統維護人員<br>";
};
?>