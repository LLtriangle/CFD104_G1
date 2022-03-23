<?php
session_start();
$nodos = json_decode($_GET["json"], true);


try{
	// require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
    
    foreach($nodos as $i => $nodo){
        $sql = "INSERT INTO sch (SCH_NO, EMP_NO, DAY_OFF, SCH_TIME) VALUES (null, :EMP_NO, :DAY_OFF, :SCH_TIME)";
        $sch = $pdo->prepare($sql); 
        // $nodo["date"]
        // $nodo["time"]
        $sch->bindValue(":DAY_OFF",$nodo["date"]);
        $sch->bindValue(":SCH_TIME",$nodo["time"]);
        $sch->bindValue(":EMP_NO",$_SESSION["EMP_NO"]);
        $affect = $sch->execute();
        echo $affect; 
    };

    
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

