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

    if( $cus->rowCount()==0){ // 非會員
        echo "{}"; // 傳回字串 xhr.responseText="exist"
    }else{ //登入成功
        //自資料庫中取回資料
        // $cusRow = $cus->fetch();
        $cusRow = $cus->fetch(PDO::FETCH_ASSOC);
        $_SESSION["CUS_NO"] = $cusRow["CUS_NO"];
        $_SESSION["EMAIL"] = $cusRow["EMAIL"];
        $_SESSION["CUS_NAME"] = $cusRow["CUS_NAME"];
        $_SESSION["CUS_TEL"] = $cusRow["CUS_TEL"];
        $_SESSION["SEX"] = $cusRow["SEX"];
        $_SESSION["CUS_ADD"] = $cusRow["CUS_ADD"];
        $_SESSION["CUS_PIC"] = $cusRow["CUS_PIC"];

        //送出會員資料
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
    }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

