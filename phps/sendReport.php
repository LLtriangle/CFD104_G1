<?php
session_start();
try{
  // require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
  // 檔案名稱：$_FILES['input的name']['name']
  // 檔案格式：$_FILES['input的name']['type']
  // 檔案的暫存位置：$_FILES['input的name']['tmp_name']

  // -------------
  if($_FILES['before_img']['error']==0 && $_FILES['after_img']['error']==0){
      // $file = uniqid();
      $fileB = $_FILES['before_img'] ?? null;
      $fileA = $_FILES['after_img'] ?? null;

      $fileB = $_POST["sao_no"]."_before_pic";
      $fileInfoB = pathinfo($_FILES['before_img']['name']); 
      $extB = $fileInfoB["extension"]; // 副檔名
      $fileNameB = "$fileB.$extB";
      $fromB = $_FILES['before_img']['tmp_name']; //暫存區含路徑
      $toB = "../img/report/$fileNameB";
      copy($fromB, $toB);

      $fileA = $_POST["sao_no"]."_after_pic";
      $fileInfoA = pathinfo($_FILES['after_img']['name']); 
      $extA = $fileInfoA["extension"]; // 副檔名
      $fileNameA = "$fileA.$extA";
      $fromA = $_FILES['after_img']['tmp_name']; //暫存區含路徑
      $toA = "../img/report/$fileNameA";
      copy($fromA, $toA);

      $pathB = $fileB ? $fileNameB : null;
      $pathA = $fileA ? $fileNameA : null;
  
      // 修改
      $sql = "update sao set INFO=:INFO, BEFORE_IMG=:BEFORE_IMG,AFTER_IMG=:AFTER_IMG, STATE=1 where SAO_NO=:SAO_NO "; 
      $sao = $pdo->prepare($sql);

      $sao->bindValue(":INFO",$_POST["info"]); 
      $sao->bindValue(":BEFORE_IMG", $pathB); 
      $sao->bindValue(":AFTER_IMG", $pathA);
      $sao->bindValue(":SAO_NO",$_POST["sao_no"]); 
    }

    $affect = $sao->execute();
    echo `修改${affect}筆資料`; 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

