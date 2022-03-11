<?php 
session_start();
try{
	// require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
	$sql = "select * from emp where EMP_STATE=1 and JOB='整理師'";
	$emps = $pdo->query($sql);

	// 將取得的資料轉成陣列形式
	// 取一筆資料用fetch, 取多筆資料用fetchAll(結果為二維陣列)
	$empRows = $emps->fetchAll(PDO::FETCH_ASSOC); 
    // $empRows->execute();  // 用prepare再執行此行

    // 將陣列轉成json格式後傳出去
	echo json_encode($empRows);
}catch(PDOException $e){
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
 ?>