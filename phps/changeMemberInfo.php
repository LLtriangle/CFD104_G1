<?php
session_start();
// echo $_FILES['upFile']['name'];
try{
  // require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
  // 檔案名稱：$_FILES['input的name']['name']
  // 檔案格式：$_FILES['input的name']['type']
  // 檔案的暫存位置：$_FILES['input的name']['tmp_name']
  
  if($_FILES['upFile']['error']==0){
      // $file = uniqid();
      $file = $_SESSION["CUS_NO"]."_pic";
      $fileInfo = pathinfo($_FILES['upFile']['name']); 
      $ext = $fileInfo["extension"]; // 副檔名
      $fileName = "$file.$ext";
      $from = $_FILES['upFile']['tmp_name']; //暫存區含路徑
      $to = "../img/cus/$fileName";
      copy($from, $to);
  
      // 修改
      $sql = "update cus set CUS_NAME=:CUS_NAME, SEX=:SEX ,CUS_TEL=:CUS_TEL,CUS_ADD=:CUS_ADD, CUS_PIC=:CUS_PIC where CUS_NO=:CUS_NO "; 
      $cus = $pdo->prepare($sql);

      $cus->bindValue(":CUS_NO",$_SESSION["CUS_NO"]); // 帳號
      $cus->bindValue(":CUS_NAME",$_POST["cus_name"]); // 姓名
      $cus->bindValue(":SEX", $_POST["gender"]); // 性別
      $cus->bindValue(":CUS_TEL", $_POST["cus_tel"]); // 電話
      $cus->bindValue(":CUS_ADD", $_POST["cus_add"]); // 地址
      $cus->bindValue(":CUS_PIC", $fileName); // 照片

      // $emp->bindValue(":EMP_TEL", $POST["tel"]); 

      $_SESSION["CUS_NAME"] = $_POST["cus_name"];
      $_SESSION["CUS_TEL"] = $_POST["cus_tel"];
      $_SESSION["SEX"] = $_POST["gender"];
      $_SESSION["CUS_ADD"] = $_POST["cus_add"];
      $_SESSION["CUS_PIC"] = $fileName;
       
    }else{
      // 修改
      $sql = "update cus set CUS_NAME=:CUS_NAME, SEX=:SEX ,CUS_TEL=:CUS_TEL,CUS_ADD=:CUS_ADD where CUS_NO=:CUS_NO "; 
      $cus = $pdo->prepare($sql);
  
      $cus->bindValue(":CUS_NO",$_SESSION["CUS_NO"]); // 帳號
      $cus->bindValue(":CUS_NAME",$_POST["cus_name"]); // 姓名
      $cus->bindValue(":SEX", $_POST["gender"]); // 性別
      $cus->bindValue(":CUS_TEL", $_POST["cus_tel"]); // 電話
      $cus->bindValue(":CUS_ADD", $_POST["cus_add"]); // 地址
  
      $_SESSION["CUS_NAME"] = $_POST["cus_name"];
      $_SESSION["CUS_TEL"] = $_POST["cus_tel"];
      $_SESSION["SEX"] = $_POST["gender"];
      $_SESSION["CUS_ADD"] = $_POST["cus_add"];
    }

    $affect = $cus->execute();
    echo `修改${affect}筆資料`; 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

