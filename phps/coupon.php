<?php
try{
	// require_once("../connect_cfd104g1.php"); // 上線用
    require_once("connect.php"); // 開發用

  $sql = "select * FROM coupon WHERE CUS_NO = :CUS_NO;";
  $cp = $pdo->prepare($sql);
  $cp -> bindValue(":CUS_NO",$_GET["data"]);
  $cp -> execute(); //執行
  $cps = $cp->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($cps);

}catch(PDOException $e){
  echo "error";
}
?>