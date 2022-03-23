<?php 
try {
	require_once("connect.php"); // 開發用
	if ($_GET['data'] == "emp") {
		$sql = "select EMP_NO ta, EMP_NAME, EMP_TEL, JOB, EMP_ADD, HIREDATE, EMP_STATE from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "cus"){
		$sql = "select CUS_NO ta, CUS_NAME, EMAIL, CUS_TEL, CUS_ADD, SEX, STATE from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "result"){
		// $sql = "select * from {$_GET['data']}";

		$sql = "select R.RESULT_NO ta, R.RESULT_NAME, P.PLAN_NAME,  Pr1.PRD_NAME prd1, Pr2.PRD_NAME prd2, Pr3.PRD_NAME prd3
		from result R join plan P on R.PLAN_NO = P.PLAN_NO
                     join prd Pr1 on R.PRD_NO1 = Pr1.PRD_NO
                     join prd Pr2 on R.PRD_NO2 = Pr2.PRD_NO
                     join prd Pr3 on R.PRD_NO3 = Pr3.PRD_NO";

	}elseif ($_GET['data'] == "prd"){
		$sql = "select PRD_NO ta, CATEGORY, PRD_NAME,PRICE, STATE from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "ord"){
		$sql = "select ORD_NO ta, CUS_NO, TIME, STATE from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "plan"){
		$sql = "select PLAN_NO ta, PLAN_NAME, PRICE from {$_GET['data']}";

	}elseif ($_GET['data'] == "sao"){
		// saoTableHead:['服務訂單編號','員工編號','會員編號','方案編號','服務日期','服務時間','付款狀態','服務訂單狀態'],
		$sql = "select SAO_NO ta, EMP_NO, CUS_NO, PLAN_NO, SAO_DATE, SAO_TIME, STATE from {$_GET['data']}";
		// $sql = "select S.SAO_NO ta, EMP_NO, CUS_NO, PLAN_NO, SAO_DATE, SAO_TIME, PAY_STATE, STATE 
		// from result R join plan P on R.PLAN_NO = P.PLAN_NO";
			
	}elseif ($_GET['data'] == "casetable"){
		$sql = "select CASE_NO ta, INFO_BEFORE, INFO_AFTER from {$_GET['data']}";
		
	}elseif ($_GET['data'] == "event"){
		$sql = "select COUPON ta, TITLE, START, END, STATE from {$_GET['data']} order by END";
		
	}elseif ($_GET['data'] == "columntable"){
		$sql = "select COLUMN_NO ta, TOPIC, AUTHOR, DATE from {$_GET['data']}";
	
	}elseif ($_GET['data'] == "sch"){
		$sql = "select * from {$_GET['data']}";

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