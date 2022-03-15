<?php 
try{
	require_once("connect.php");
	$sql = "select * from prd where CATEGORY = '{$_GET['prdClass']}'";
	$prodRowTable = $pdo->query($sql);
	$prodRow = $prodRowTable->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($prodRow);
}catch(PDOException $e){
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	// echo "系統暫時不能正常運行，請稍後再試<br>";	
};
?>