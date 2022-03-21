<?php 
try {
	require_once("connect.php"); // 開發用

    if ($_GET['tableName'] == "emp") {
		$sql = "select EMP_NO, EMP_NAME, EMP_EMAIL, EMP_TEL, EMP_STATE STATUS, JOB, EMP_ADD, HIREDATE, INTRO from {$_GET['tableName']} where EMP_NO = {$_GET['editNo']} ";
		
	}elseif ($_GET['tableName'] == "cus"){
		$sql = "select CUS_NO, JOIN_DATE, EMAIL, STATE STATUS, CUS_NAME, CUS_TEL, CUS_ADD, SEX from {$_GET['tableName']} where CUS_NO = {$_GET['editNo']} ";
		
	}elseif ($_GET['tableName'] == "result"){
		$sql = "select * from {$_GET['tableName']} where RESULT_NO = {$_GET['editNo']} ";

		// $sql = "select R.RESULT_NO no, R.RESULT_NAME, P.PLAN_NAME,  Pr1.PRD_NAME prd1, Pr2.PRD_NAME prd2, Pr3.PRD_NAME prd3
		// from result R join plan P on R.PLAN_NO = P.PLAN_NO
        //              join prd Pr1 on R.PRD_NO1 = Pr1.PRD_NO
        //              join prd Pr2 on R.PRD_NO2 = Pr2.PRD_NO
        //              join prd Pr3 on R.PRD_NO3 = Pr3.PRD_NO";

	}elseif ($_GET['tableName'] == "prd"){
		$sql = "select PRD_NO, CATEGORY, PRD_NAME, PRICE, IMG1, IMG2, IMG3, IMG4, INFO_IMG1, INFO_TITLE_1, INFO_1, INFO_IMG2, INFO_TITLE_2, INFO_2, STATE STATUS, SPEC_IMG  from {$_GET['tableName']} where PRD_NO = '{$_GET['editNo']}' ";
		
	}elseif ($_GET['tableName'] == "ord"){
		$sql = "select O.ORD_NO, O.CUS_NO, O.CUS_NAME, O.CUS_TEL, O.CUS_ADD, O.TIME, O.SHIPPING, O.TOTAL, O.STATE STATUS, O.COUPON, OI.PRD_NO, OI.PRICE, OI.AMOUNT, P.PRD_NAME
		from ord O join ordinfo OI on O.ORD_NO = OI.ORD_NO 
		join prd P on P.PRD_NO = OI.PRD_NO where O.ORD_NO = '{$_GET['editNo']}' ";
		
	}elseif ($_GET['tableName'] == "plan"){
		$sql = "select * from {$_GET['tableName']} where PLAN_NO = '{$_GET['editNo']}' ";

	}elseif ($_GET['tableName'] == "sao"){
		// $sql = "select * from {$_GET['tableName']} where PLAN_NO = '{$_GET['editNo']}' ";
		$sql = "select S.SAO_NO, S.EMP_NO, S.CUS_NO, S.PLAN_NO, S.PLAN_NO, S.SAO_NAME, S.SAO_TEL, S.SAO_DATE, S.SAO_TIME, S.SAO_ADD, S.UPLOAD_PIC1, S.UPLOAD_PIC2, S.UPLOAD_PIC3, S.NEEDS, S.STATE STATUS, S.INFO, S.BEFORE_IMG, S.AFTER_IMG, C.CUS_NAME, P.PRICE
		from sao S join cus C on S.CUS_NO = C.CUS_NO 
		join plan P on P.PLAN_NO = S.PLAN_NO where S.SAO_NO = '{$_GET['editNo']}' ";

	}elseif ($_GET['tableName'] == "casetable"){
		$sql = "select * from {$_GET['tableName']} where CASE_NO = '{$_GET['editNo']}' ";
		
	}elseif ($_GET['tableName'] == "event"){
		$sql = "select COUPON, EVENT_IMG, TITLE, CONTENT, PARM, START, END, STATE STATUS from {$_GET['tableName']} where COUPON = '{$_GET['editNo']}' ";
		
	}elseif ($_GET['tableName'] == "columntable"){
		$sql = "select * from {$_GET['tableName']} where COLUMN_NO = '{$_GET['editNo']}' ";

	}elseif ($_GET['tableName'] == "sch"){
		$sql = "select * from {$_GET['tableName']} where SCH_NO = '{$_GET['editNo']}' ";
		
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