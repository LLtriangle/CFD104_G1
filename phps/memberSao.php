<?php 
try {
	require_once("connect.php"); // 開發用
	$sql = "select SAO_NO,e.EMP_NO,e.EMP_NAME empname,c.CUS_NO,c.CUS_NAME cusname,p.PLAN_NAME planname,SAO_NAME,SAO_TEL,SAO_DATE,SAO_TIME,SAO_ADD,UPLOAD_PIC1,UPLOAD_PIC2,UPLOAD_PIC3,NEEDS,s.STATE,INFO,BEFORE_IMG,AFTER_IMG,p.PRICE 
    from sao s join emp e on s.EMP_NO = e.EMP_NO
               join cus c on s.CUS_NO = c.CUS_NO
               join plan p on s.PLAN_NO = p.PLAN_NO";

	$allTable = $pdo->query($sql);
	$Rows = $allTable->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($Rows);
} catch (PDOException $e) {
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	// echo "系統錯誤, 請通知系統維護人員<br>";
};
?>