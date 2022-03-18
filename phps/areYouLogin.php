<?php 
session_start();
try{
    // if(session_status() == PHP_SESSION_ACTIVE){  // 會員
    if(isset($_SESSION["CUS_NO"])){  // 會員
	    // echo '已登入';
	    echo $_SESSION["CUS_PIC"];
    }else{
	    echo '未登入';
    };

}catch(PDOException $e){
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
 ?>