<?php 
session_start();
try{
	require_once("connect.php"); // 開發用
	// require_once("../connect_cfd104g1.php"); // 上線用
	$sql = "select * from emp";
	$emps = $pdo->query($sql);
	$empRows = $emps->fetchAll(PDO::FETCH_ASSOC); // 取得多筆資料 為陣列
    $empRows->execute(); // 執行
    // 轉為json字串
	echo json_encode($empRows);
}catch(PDOException $e){
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	// echo "系統暫時不能正常運行，請稍後再試<br>";	
}
 ?>