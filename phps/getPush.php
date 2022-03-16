<?php 
try {
	require_once("connect.php"); // 開發用
	$sql = "select P.PLAN_NAME,P.PLAN_TA,P.PLAN_FEATURE,
                Pr1.PRD_NAME prd1,Pr1.IMG1 prd1_img,Pr1.PRICE prd1_price,
                Pr2.PRD_NAME prd2,Pr2.IMG1 prd2_img,Pr2.PRICE prd2_price,
                Pr3.PRD_NAME prd3,Pr3.IMG1 prd3_img,Pr3.PRICE prd3_price from 
            result R join plan P on R.PLAN_NO = P.PLAN_NO
                     join prd Pr1 on R.PRD_NO1 = Pr1.PRD_NO
                     join prd Pr2 on R.PRD_NO2 = Pr2.PRD_NO
                     join prd Pr3 on R.PRD_NO3 = Pr3.PRD_NO
            where RESULT_NAME='{$_GET['personality']}' ";
	$allTable = $pdo->query($sql);
	$Rows = $allTable->fetch(PDO::FETCH_ASSOC);
	echo json_encode($Rows);
} catch (PDOException $e) {
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	// echo "系統錯誤, 請通知系統維護人員<br>";
};
?>