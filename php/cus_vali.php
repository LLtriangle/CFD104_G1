<?php
try{
	// require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用

  $sql = "select * from cus where EMAIL = ?";
  $member = $pdo->prepare($sql);
  $member->bindValue(1,$_GET["cusId"]);
  $member->execute(); //執行


  if( $member->rowCount() != 0){ //有找到 => 此帳號已存在, 不可用
    echo "此帳號已存在, 不可用";  //xhr.responseText : 伺服器的回應資料,回應的內容為一個字串
  }else{ //此帳號可使用
    echo "此帳號可使用";
  } 
}catch(PDOException $e){
  echo "error";
}
?>