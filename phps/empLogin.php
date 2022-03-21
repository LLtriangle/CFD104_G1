<?php
session_start();
$datas = json_decode($_POST["json"], true); //第二個參數指出要轉成關聯性陣列

try{
	// require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用

    $sql = "select * from emp where EMP_EMAIL=:EMP_EMAIL and EMP_PSW=:EMP_PSW and EMP_STATE = 1"; 
    $emp = $pdo->prepare($sql);
    $emp->bindValue(":EMP_EMAIL", $datas["emp_email"]);
    $emp->bindValue(":EMP_PSW", $datas["emp_psw"]);
    $emp->execute();

    if( $emp->rowCount()==0){ // 非員工
        echo "{}"; 
    }else{ //登入成功
        //自資料庫中取回資料放入SESSION
        $empRow = $emp->fetch(PDO::FETCH_ASSOC);
        $_SESSION["EMP_NO"] = $empRow["EMP_NO"];
        $_SESSION["EMP_NAME"] = $empRow["EMP_NAME"];
        $_SESSION["EMP_EMAIL"] = $empRow["EMP_EMAIL"];
        $_SESSION["EMP_TEL"] = $empRow["EMP_TEL"];
        $_SESSION["JOB"] = $empRow["JOB"];
        $_SESSION["EMP_ADD"] = $empRow["EMP_ADD"];
        $_SESSION["EMP_PIC"] = $empRow["EMP_PIC"];

        $result = [
        "EMP_NO" => $_SESSION["EMP_NO"],
        "EMP_NAME" => $_SESSION["EMP_NAME"], 
        "EMP_EMAIL" => $_SESSION["EMP_EMAIL"],
        "EMP_TEL" => $_SESSION["EMP_TEL"],
        "JOB" => $_SESSION["JOB"],
        "EMP_ADD" => $_SESSION["EMP_ADD"],
        "EMP_PIC" => $_SESSION["EMP_PIC"],
        ];

        echo json_encode($result); 
    }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

