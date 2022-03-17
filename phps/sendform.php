<?php
session_start();
try{
  // require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
  // 檔案名稱：$_FILES['input的name']['name']
  // 檔案格式：$_FILES['input的name']['type']
  // 檔案的暫存位置：$_FILES['input的name']['tmp_name']
  
  // if($_FILES['upFile']['error']==0){
    //     $file = uniqid();
    //     $fileInfo = pathinfo($_FILES['upFile']['name']); 
    //     $ext = $fileInfo["extension"]; // 副檔名
    //     $fileName = "$file.$ext";
    //     $from = $_FILES['upFile']['tmp_name']; //暫存區含路徑
    //     $to = "../img/cus/$fileName";
    //     copy($from, $to);
    
    // 修改
    $sql = "INSERT INTO sao (SAO_NO, EMP_NO, CUS_NO, PLAN_NO, SAO_NAME, SAO_TEL, SAO_DATE, SAO_TIME, SAO_ADD, NEEDS) VALUES (null, :EMP_NO, :CUS_NO, :PLAN_NO, :SAO_NAME, :SAO_TEL, :SAO_DATE, :SAO_TIME, :SAO_ADD, :NEEDS)"; 
    $cus = $pdo->prepare($sql);
    
    $cus->bindValue(":EMP_NO",$_POST["emp_no"]);
    $cus->bindValue(":CUS_NO",$_POST["cus_no"]);
    $cus->bindValue(":PLAN_NO",$_POST["plan_no"]);
    $cus->bindValue(":SAO_NAME", $_POST["sao_name"]);
    $cus->bindValue(":SAO_TEL", $_POST["sao_tel"]); 
    $cus->bindValue(":SAO_DATE", $_POST["sao_date"]); 
    $cus->bindValue(":SAO_TIME", $_POST["sao_time"]);
    $cus->bindValue(":SAO_ADD", $_POST["sao_add"]);
    $cus->bindValue(":NEEDS", $_POST["needs"]);
    
    
    echo $_POST["sao_date"];
    // }else{
      //   // 修改
      //   $sql = "update cus set CUS_NAME=:CUS_NAME, SEX=:SEX ,CUS_TEL=:CUS_TEL,CUS_ADD=:CUS_ADD where CUS_NO=:CUS_NO "; 
      //   $cus = $pdo->prepare($sql);
      
      //   $cus->bindValue(":CUS_NO",$_SESSION["CUS_NO"]); // 帳號
      //   $cus->bindValue(":CUS_NAME",$_POST["cus_name"]); // 姓名
      //   $cus->bindValue(":SEX", $_POST["gender"]); // 性別
    //   $cus->bindValue(":CUS_TEL", $_POST["cus_tel"]); // 電話
    //   $cus->bindValue(":CUS_ADD", $_POST["cus_add"]); // 地址
    // }

    $affect = $cus->execute();
    echo `新增${affect}筆資料`; 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

