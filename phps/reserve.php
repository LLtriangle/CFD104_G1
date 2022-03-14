<?php 
try {
	require_once("connect.php"); // 開發用
	$sql = " SELECT EMP_NO,DAY_OFF,SCH_TIME FROM sch WHERE EMP_NO='{$_GET['data']}'
    UNION
    SELECT EMP_NO,SAO_DATE,SAO_TIME FROM sao WHERE EMP_NO='{$_GET['data']}' ";
	$info = $pdo->query($sql);
	$infos = $info->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($infos);
} catch (PDOException $e) {
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	// echo "系統錯誤, 請通知系統維護人員<br>";
};
?>