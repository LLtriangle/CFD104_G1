<?php
session_start();
try{
$datas = json_decode($_POST["json"], true);
	// require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用 
    //=========儲存照片
    // 取得主檔名
    // $file = uniqid();
    // 取得副檔名
    // 檔案名稱：$_FILES['input的name']['name']
    // 檔案格式：$_FILES['input的name']['type']
    // 檔案的暫存位置：$_FILES['input的name']['tmp_name']
    
    // $fileInfo = pathinfo($_FILES['upFile']['name']); 

    // $ext = $fileInfo["extension"]; // 副檔名
    // $fileName = "$file.$ext";
    
    // $from = $_FILES['upFile']['tmp_name']; //暫存區含路徑
    // $to = "img/$fileName";
    // copy($from, $to);

    // 新增
    $sql = "update cus set CUS_NAME=:CUS_NAME, SEX=:SEX ,CUS_TEL=:CUS_TEL,CUS_ADD=:CUS_ADD, CUS_PIC=:CUS_PIC where EMAIL=:EMAIL "; 
    $cus = $pdo->prepare($sql);

    $cus->bindValue(":EMAIL", $datas["memId"]); // 帳號
    $cus->bindValue(":CUS_NAME", $datas["memName"]); // 姓名
    $cus->bindValue(":SEX", $datas["memSex"]); // 性別
    $cus->bindValue(":CUS_TEL", $datas["memTel"]); // 電話
    $cus->bindValue(":CUS_ADD", $datas["memAdd"]); // 地址
    // $cus->bindValue(":CUS_PIC", $datas["memImg"]); // 照片

    $affect = $cus->execute(); // 異動1筆資料
    $_SESSION["EMAIL"] = $datas["memId"];
    $_SESSION["CUS_NAME"] = $datas["memName"];
    $_SESSION["CUS_TEL"] = $datas["memTel"];
    $_SESSION["SEX"] = $datas["memSex"];
    $_SESSION["CUS_ADD"] = $datas["memAdd"];
    // $_SESSION["CUS_PIC"] = base64url_decode($data);

    echo `修改${affect}筆資料`; 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

