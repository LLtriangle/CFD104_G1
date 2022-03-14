<?php 
try {
	require_once("connect.php"); // 開發用
	if ($_GET['data'] == "emp") {
		$sql = "select EMP_NO,EMP_NAME,EMP_TEL,JOB,EMP_ADD,HIREDATE,EMP_STATE from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "cus"){
		$sql = "select * from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "result"){
		$sql = "select * from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "prd"){
		$sql = "select * from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "ord"){
		$sql = "select * from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "plan"){
		$sql = "select * from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "casetable"){
		$sql = "select CASE_NO,INFO_BEFORE,INFO_AFTER from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "event"){
		$sql = "select * from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "columntable"){
		$sql = "select COLUMN_NO,AUTHOR,DATE,TOPIC from {$_GET['data']}";
		
	};
	$cases = $pdo->query($sql);	
	$caseRows = $cases->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($caseRows);

} catch (PDOException $e) {
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	// echo "系統錯誤, 請通知系統維護人員<br>";
};
?>