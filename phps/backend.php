<?php 
try {
	require_once("connect.php"); // 開發用
	if ($_GET['data'] == "emp") {
		$sql = "select EMP_NO no, EMP_NAME, EMP_TEL, JOB, EMP_ADD, HIREDATE, EMP_STATE from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "cus"){
		$sql = "select CUS_NO no, CUS_NAME, EMAIL, CUS_TEL, CUS_ADD, SEX, STATE from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "result"){
		// $sql = "select * from {$_GET['data']}";

		$sql = "select R.RESULT_NO no, R.RESULT_NAME, P.PLAN_NAME,  Pr1.PRD_NAME prd1, Pr2.PRD_NAME prd2, Pr3.PRD_NAME prd3
		from result R join plan P on R.PLAN_NO = P.PLAN_NO
                     join prd Pr1 on R.PRD_NO1 = Pr1.PRD_NO
                     join prd Pr2 on R.PRD_NO2 = Pr2.PRD_NO
                     join prd Pr3 on R.PRD_NO3 = Pr3.PRD_NO";

	}elseif ($_GET['data'] == "prd"){
		$sql = "select PRD_NO no, CATEGORY, PRD_NAME,PRICE, STATE from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "ord"){
		$sql = "select ORD_NO no, CUS_NO, TIME, PAY_STATE, STATE from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "plan"){
		$sql = "select PLAN_NO no, PLAN_NAME, PRICE from {$_GET['data']}";

	}elseif ($_GET['data'] == "sao"){
		// $sql = "select SAO_NO no, EMP_NO, CUS_NO, PLAN_NO, SAO_DATE, SAO_TIME, PAY_STATE, STATE from {$_GET['data']}";
		$sql = "select S.SAO_NO no, EMP_NO, CUS_NO, PLAN_NO, SAO_DATE, SAO_TIME, PAY_STATE, STATE 
		from result R join plan P on R.PLAN_NO = P.PLAN_NO";
			
	}elseif ($_GET['data'] == "casetable"){
		$sql = "select CASE_NO no, INFO_BEFORE, INFO_AFTER from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "event"){
		$sql = "select COUPON no, TITLE, START, END, STATE from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "columntable"){
		$sql = "select COLUMN_NO no, TOPIC, AUTHOR, DATE from {$_GET['data']}";
		
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