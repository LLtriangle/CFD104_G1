<?php
session_start();
$datas = json_decode($_POST["json"], true); //第二個參數指出要轉成關聯性陣列

try{
	// require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
    $sql = "select * from `cus` where EMAIL=:EMAIL and CUS_PSW=:CUS_PSW"; 
    $cus = $pdo->prepare($sql);
    $cus->bindValue(":EMAIL", $datas["memId"]);
    $cus->bindValue(":CUS_PSW", $datas["memPsw"]);
    $cus->execute();

    if( $cus->rowCount()==0){ //查無此人
        echo "exist";
    }else{ //登入成功
        //自資料庫中取回資料
        $cusRow = $cus->fetch(PDO::FETCH_ASSOC);
        $_SESSION["CUS_NO"] = $cusRow["CUS_NO"];
        $_SESSION["EMAIL"] = $cusRow["EMAIL"];
        $_SESSION["CUS_NAME"] = $cusRow["CUS_NAME"];
        $_SESSION["CUS_TEL"] = $cusRow["CUS_TEL"];

        //送出登入者的姓名資料
        //echo json_encode($cusRow);
        //$result = ["memNo" => $cusRow["no"] ,"memId" => $cusRow["memId"], "memName" => $cusRow["memName"], "tel" => $cusRow["tel"]];

        $result = ["CUS_NO" => $_SESSION["CUS_NO"] ,"EMAIL" => $_SESSION["EMAIL"], "CUS_NAME" => $_SESSION["CUS_NAME"], "CUS_TEL" => $_SESSION["CUS_TEL"]];

        echo json_encode($result); 
    }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

