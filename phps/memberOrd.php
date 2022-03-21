<?php
session_start(); 
try {
	require_once("connect.php"); // 開發用
    $cus_NO=$_SESSION['CUS_NO'];
	$sql = "select * from ord where CUS_NO = {$cus_NO}";
	$allTable = $pdo->query($sql);
	$Rows = $allTable->fetchAll(PDO::FETCH_ASSOC);

    
    echo json_encode($Rows).'|';
    // $sql = "select o.ORD_NO,o.CUS_NO,o.CUS_NAME,o.CUS_TEL,o.CUS_ADD,o.TIME,o.SHIPPING,o.TOTAL,o.PAY_STATE,o.STATE,o.COUPON,i.PRD_NO,p.PRD_NAME,i.PRICE prd_price,i.AMOUNT,p.IMG1
        // from ordinfo i join ord o on o.ORD_NO = i.ORD_NO
        //                join prd p on p.PRD_NO = i.PRD_NO";

    $sql = "select  p.IMG1,p.PRD_NAME,AMOUNT,i.ORD_NO,i.PRICE,i.PRD_NO
    from ordinfo i join ord o on i.ORD_NO = o.ORD_NO
                   join prd p on i.PRD_NO = p.PRD_NO";
	
	$allInfo = $pdo->query($sql);
	$OrdInfo = $allInfo->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($OrdInfo);
} catch (PDOException $e) {
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	// echo "系統錯誤, 請通知系統維護人員<br>";
};
?>