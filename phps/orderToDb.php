<?php
session_start();
$cart = json_decode($_GET["cart"]);
$person = json_decode($_GET["person"]);
try {
	require_once("connect.php"); // 開發用
	if(isset($_SESSION["EMAIL"]) == true){
		$result = [
			"CUS_NO" => $_SESSION["CUS_NO"],
			"EMAIL" => $_SESSION["EMAIL"], 
			"CUS_NAME" => $_SESSION["CUS_NAME"],
			"CUS_TEL" => $_SESSION["CUS_TEL"],
			"SEX" => $_SESSION["SEX"],
			"CUS_ADD" => $_SESSION["CUS_ADD"],
			"CUS_PIC" => $_SESSION["CUS_PIC"],
			];
			echo json_encode($result);
			$cusNo = $_SESSION["CUS_NO"];
			$CUS_NAME = $_SESSION["CUS_NAME"];
			$CUS_TEL = $_SESSION["CUS_TEL"];
			$coupon = $person->coupon;
			$address = $person->address;
			$phone = $person->phone;
			$name = $person->name;
			$delivery = $person->delivery;
			if($delivery == '宅配'){
				$delivery = 1;
			}elseif($delivery == '7-11超商取貨'){
				$delivery = 2;
			}else $delivery = 3;
			$total = $person->total;
			$Date = date("Y-m-d h:i:s");
			if ($coupon=='') {
				$sql = "INSERT INTO `ord`(`CUS_NO`, `CUS_NAME`, `CUS_TEL`, `CUS_ADD`, `TIME`, `SHIPPING`, `TOTAL`, `STATE`, `COUPON`) VALUES ({$cusNo},'{$CUS_NAME}','{$CUS_TEL}','{$address}','$Date','$delivery',{$total},0,null)";
			}else{
				$sql = "INSERT INTO `ord`(`CUS_NO`, `CUS_NAME`, `CUS_TEL`, `CUS_ADD`, `TIME`, `SHIPPING`, `TOTAL`, `STATE`, `COUPON`) VALUES ({$cusNo},'{$CUS_NAME}','{$CUS_TEL}','{$address}','$Date','$delivery',{$total},0,'{$coupon}')";
			};
			$ORDINFO = $pdo->exec($sql);
			// $sql = "select LAST(ORD_NO) form ord";
			// $ORD_NO = $pdo->query($sql);
			// $Rows = $ORD_NO->fetchAll(PDO::FETCH_ASSOC);
			$ORD_NO = $pdo->lastInsertId();
			foreach($cart as $key => $val) {
				$prdNo = $val -> prdNo;
				$prdName = $val -> prdName;
				$prdPrice = $val -> prdPrice;
				$prdNum = $val -> prdNum;
				$sql = "INSERT INTO `ordinfo`(`ORD_NO`,`PRD_NO`, `CUS_NO`, `PRICE`, `AMOUNT`) VALUES ($ORD_NO,$prdNo,{$cusNo},$prdPrice,$prdNum)";
				$ORDTABLE = $pdo->prepare($sql);
				$ORDTABLE->execute();
			};
			// if ($coupon!=''){
			// 	$sql = "INSERT INTO `coupon`(`CUS_NO`, `COUPON`) VALUES ({$cusNo},'{$coupon}')"
			// 	$COUPON = $pdo->exec($sql);
			// }
		}else{ //尚未登入
			echo "{}";
	}
} catch (PDOException $e) {
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	// echo "系統錯誤, 請通知系統維護人員<br>";
};

?>