<?php
session_start();
try{
$datas = json_decode($_POST["json"], true);
	// require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
    $sql = "update cus set CUS_NAME=:CUS_NAME, SEX=:SEX ,CUS_TEL=:CUS_TEL,CUS_ADD=:CUS_ADD where EMAIL=:EMAIL "; 
    $cus = $pdo->prepare($sql);

    $cus->bindValue(":EMAIL", $datas["memId"]); // 帳號
    $cus->bindValue(":CUS_NAME", $datas["memName"]); // 姓名
    $cus->bindValue(":SEX", $datas["memSex"]); // 性別
    $cus->bindValue(":CUS_TEL", $datas["memTel"]); // 電話
    $cus->bindValue(":CUS_ADD", $datas["memAdd"]); // 地址

    $affect = $cus->execute();
    $_SESSION["EMAIL"] = $datas["memId"];
    $_SESSION["CUS_NAME"] = $datas["memName"];
    $_SESSION["CUS_TEL"] = $datas["memTel"];
    $_SESSION["SEX"] = $datas["memSex"];
    $_SESSION["CUS_ADD"] = $datas["memAdd"];
    // $_SESSION["CUS_PIC"] = $cusNew["CUS_PIC"];

    echo $affect; 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

