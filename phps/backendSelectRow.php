<?php 
try {
	require_once("connect.php"); // 開發用

    if ($_GET['tableName'] == "emp") {
		$sql = "select EMP_NO, EMP_NAME, EMP_EMAIL, EMP_TEL, EMP_STATE, JOB, EMP_ADD, HIREDATE, INTRO from {$_GET['tableName']} where EMP_NO = {$_GET['editNo']} ";
		
	}elseif ($_GET['tableName'] == "cus"){
		$sql = "select CUS_NO, JOIN_DATE, EMAIL, STATE, CUS_NAME, CUS_TEL, CUS_ADD, SEX from {$_GET['tableName']} where CUS_NO = {$_GET['editNo']} ";
		
	}elseif ($_GET['tableName'] == "result"){
		$sql = "select * from {$_GET['tableName']} where RESULT_NO = {$_GET['editNo']} ";

		// $sql = "select R.RESULT_NO no, R.RESULT_NAME, P.PLAN_NAME,  Pr1.PRD_NAME prd1, Pr2.PRD_NAME prd2, Pr3.PRD_NAME prd3
		// from result R join plan P on R.PLAN_NO = P.PLAN_NO
        //              join prd Pr1 on R.PRD_NO1 = Pr1.PRD_NO
        //              join prd Pr2 on R.PRD_NO2 = Pr2.PRD_NO
        //              join prd Pr3 on R.PRD_NO3 = Pr3.PRD_NO";

	}elseif ($_GET['tableName'] == "prd"){
		$sql = "select * from {$_GET['tableName']} where PRD_NO = '{$_GET['editNo']}' ";
		
	}elseif ($_GET['tableName'] == "ord"){
		$sql = "select * from {$_GET['tableName']} where ORD_NO = '{$_GET['editNo']}' ";
		
	}elseif ($_GET['tableName'] == "plan"){
		$sql = "select * from {$_GET['tableName']} where PLAN_NO = '{$_GET['editNo']}' ";

	}elseif ($_GET['tableName'] == "sao"){
		$sql = "select * from {$_GET['tableName']} where PLAN_NO = '{$_GET['editNo']}' ";
			
	}elseif ($_GET['tableName'] == "casetable"){
		$sql = "select * from {$_GET['tableName']} where CASE_NO = '{$_GET['editNo']}' ";
		
	}elseif ($_GET['tableName'] == "event"){
		$sql = "select * from {$_GET['tableName']} where COUPON = '{$_GET['editNo']}' ";
		
	}elseif ($_GET['tableName'] == "columntable"){
		$sql = "select * from {$_GET['tableName']} where COLUMN_NO = '{$_GET['editNo']}' ";
		
	};

	$cases = $pdo->query($sql);	
	$caseRows = $cases->fetch(PDO::FETCH_ASSOC);
	echo json_encode($caseRows);
} catch (PDOException $e) {
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	// echo "系統錯誤, 請通知系統維護人員<br>";
};
?>