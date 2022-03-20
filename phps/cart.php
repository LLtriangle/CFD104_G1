<?php 
try{
	// require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
	$data = json_decode($_POST['datas']);
	echo $data;
	// $sql = "select * from prd where PRD_NO='$_GET['PRD_NO']' ";
	// $prds = $pdo->query($sql);
	// // 將取得的資料轉成陣列形式
	// // 取一筆資料用fetch, 取多筆資料用fetchAll(結果為二維陣列)
	// $prdRows = $prds->fetchAll(PDO::FETCH_ASSOC); 
    // // 將陣列轉成json格式後傳出去
	// echo json_encode($prdRows);
}catch(PDOException $e){
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
 ?>