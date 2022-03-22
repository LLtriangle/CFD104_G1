<?php 
session_start();
try {
	// require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
	// $sql = " SELECT * FROM sao WHERE EMP_NO='$_SESSION["EMP_NO"]' ";
	$sql = "select s.* , c.CUS_NAME , p.PLAN_NAME FROM sao as s
	JOIN cus as c 
	ON s.CUS_NO = c.CUS_NO
	JOIN plan as p
	ON s.PLAN_NO = p.PLAN_NO
	WHERE s.EMP_NO = :EMP_NO
	ORDER BY s.SAO_DATE";

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