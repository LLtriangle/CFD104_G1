<?php
try{
  // require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
  // 檔案名稱：$_FILES['input的name']['name']
  // 檔案格式：$_FILES['input的name']['type']
  // 檔案的暫存位置：$_FILES['input的name']['tmp_name']
  if ($_POST["table_title"] == "emp") {

		// 修改emp資料
    $sql_emp= "update emp set EMP_TEL=:EMP_TEL, EMP_STATE=:EMP_STATE, EMP_ADD=:EMP_ADD, INTRO=:INTRO where EMP_NO =:DATA_INDEX"; 
    $emp = $pdo->prepare($sql_emp);

    $emp->bindValue(":EMP_TEL", $_POST["emp_tel"]); //員工電話
    $emp->bindValue(":EMP_STATE", $_POST["emp_status"]); //員工權限(正常 or 停權)
    $emp->bindValue(":EMP_ADD", $_POST["emp_add"]); //員工地址
    $emp->bindValue(":INTRO", $_POST["emp_intro"]); //員工介紹

    $emp->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料

    $sql_exe = $emp;
		
	}elseif ($_POST["table_title"] == "cus"){

		// 修改cus資料
    $sql_cus = "update cus set STATE=:STATE where CUS_NO=:DATA_INDEX "; 
    $cus = $pdo->prepare($sql_cus);
    
    $cus->bindValue(":STATE", $_POST["cus_status"]); //會員權限(正常 or 停權)

    $cus->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料 

    $sql_exe = $cus;

	}elseif ($_POST["table_title"] == "result"){

    // 修改result資料
    $sql_result= "update result set PLAN_NO=:PLAN_NO, PRD_NO1=:PRD_NO1, PRD_NO2=:PRD_NO2, PRD_NO3=:PRD_NO3 where RESULT_NO =:DATA_INDEX";
    $result = $pdo->prepare($sql_result);

		$result->bindValue(":PLAN_NO",$_POST["result_plan1"]); // 推薦方案
    $result->bindValue(":PRD_NO1",$_POST["result_prd1"]); // 推薦商品1
    $result->bindValue(":PRD_NO2",$_POST["result_prd2"]); // 推薦商品2
    $result->bindValue(":PRD_NO3",$_POST["result_prd3"]); // 推薦商品3

    $result->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料

    $sql_exe = $result;

	}elseif ($_POST["table_title"] == "prd"){
    $road = [];
    for($i=1; $i < 5; $i++){
      if($_FILES["prd_img_$i"]['error']==0){
        // 圖檔名
        // $file = `prd_._.$i`;
        $prdno = $_POST["data_index"]; // ok
        $file = "prd/prd_".$prdno."_".$i;
        $fileInfo = pathinfo($_FILES["prd_img_$i"]['name']);  // 路徑
        $ext = $fileInfo["extension"];
        $fileName = "$file.$ext";
      
        $from = $_FILES["prd_img_$i"]['tmp_name']; //暫存區含路徑
        $to = "../img/$fileName";
        copy($from, $to);
        
        $road[$i-1] = $fileName;
      };
    };

    
    if($_FILES["prd_info_img_1"]['error']==0){
      // 圖檔名
      // $file = `prd_._.$i`;
      $prdno = $_POST["data_index"]; // ok
      $file = "prd/prd_".$prdno."_info_1";
      $fileInfo = pathinfo($_FILES["prd_info_img_1"]['name']);  // 路徑
      $ext = $fileInfo["extension"];
      $fileNameInfo1 = "$file.$ext";
    
      $from = $_FILES["prd_info_img_1"]['tmp_name']; //暫存區含路徑
      $to = "../img/$fileNameInfo1";
      copy($from, $to);
    };

    if($_FILES["prd_info_img_2"]['error']==0){
      // 圖檔名
      // $file = `prd_._.$i`;
      $prdno = $_POST["data_index"]; // ok
      $file = "prd/prd_".$prdno."_info_2";
      $fileInfo = pathinfo($_FILES["prd_info_img_2"]['name']);  // 路徑
      $ext = $fileInfo["extension"];
      $fileNameInfo2 = "$file.$ext";
    
      $from = $_FILES["prd_info_img_2"]['tmp_name']; //暫存區含路徑
      $to = "../img/$fileNameInfo2";
      copy($from, $to);
    };
    
    if($_FILES["prd_spec_img"]['error']==0){
      // 圖檔名
      // $file = `prd_._.$i`;
      $prdno = $_POST["data_index"]; // ok
      $file = "prd/prd_".$prdno."_info_2";
      $fileInfo = pathinfo($_FILES["prd_spec_img"]['name']);  // 路徑
      $ext = $fileInfo["extension"];
      $fileNameSpec = "$file.$ext";
    
      $from = $_FILES["prd_spec_img"]['tmp_name']; //暫存區含路徑
      $to = "../img/$fileNameSpec";
      copy($from, $to);
    };

    // 修改prd資料
    // $sql_prd= "update prd set PRD_NAME=:PRD_NAME, CATEGORY=:CATEGORY, PRICE=:PRICE, STATE=:STATE, INFO_TITLE_1=:INFO_TITLE_1, INFO_1=:INFO_1, INFO_TITLE_2=:INFO_TITLE_2, INFO_2=:INFO_2, IMG1=:IMG1, IMG2=:IMG2, IMG3=:IMG3, IMG4=:IMG4, INFO_IMG1=:INFO_IMG1, INFO_IMG2=:INFO_IMG2, SPEC_IMG=:SPEC_IMG where PRD_NO =:DATA_INDEX";
    $sql_prd= "update prd set PRD_NAME=:PRD_NAME, CATEGORY=:CATEGORY, PRICE=:PRICE, STATE=:STATE, INFO_TITLE_1=:INFO_TITLE_1, INFO_1=:INFO_1, INFO_TITLE_2=:INFO_TITLE_2, INFO_2=:INFO_2";

    // , IMG1=:IMG1 
    if(isset($road[0])){$sql_prd = $sql_prd.", IMG1=$road[0]";};
    if(isset($road[1])){$sql_prd = $sql_prd.", IMG2=$road[1]";};
    if(isset($road[2])){$sql_prd = $sql_prd.", IMG3=$road[2]";};
    if(isset($road[3])){$sql_prd = $sql_prd.", IMG4=$road[3]";};
    if(isset($fileNameInfo1)){$sql_prd = $sql_prd.", INFO_IMG1=$fileNameInfo1";};
    if(isset($fileNameInfo2)){$sql_prd = $sql_prd.", INFO_IMG2=$fileNameInfo2";};
    if(isset($fileNameSpec)){$sql_prd = $sql_prd.", SPEC_IMG=$fileNameSpec";};
    $sql_prd = $sql_prd." where PRD_NO =:DATA_INDEX";

    $prd = $pdo->prepare($sql_prd);

    $prd->bindValue(":PRD_NAME",$_POST["prd_name"]); // 商品名稱
    $prd->bindValue(":CATEGORY",$_POST["prd_cate"]); // 商品類別
    $prd->bindValue(":PRICE",$_POST["prd_price"]); // 商品價格
    $prd->bindValue(":STATE",$_POST["prd_status"]); // 商品上下架
    $prd->bindValue(":INFO_TITLE_1",$_POST["prd_info_title_1"]); // 商品介紹標題1
    $prd->bindValue(":INFO_1",$_POST["prd_info_1"]); // 商品介紹內文1
    $prd->bindValue(":INFO_TITLE_2",$_POST["prd_info_title_2"]); // 商品介紹標題2
    $prd->bindValue(":INFO_2",$_POST["prd_info_2"]); // 商品介紹內文2

    $prd->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料

    $sql_exe = $prd;

	}elseif ($_POST["table_title"] == "ord"){

    // 修改prd資料
    $sql_ord= "update ord set STATE=:STATE, SHIPPING=:SHIPPING where ORD_NO =:DATA_INDEX";
    $ord = $pdo->prepare($sql_ord);

		$ord->bindValue(":STATE",$_POST["ord_status"]); // 訂單狀態
    $ord->bindValue(":SHIPPING",$_POST["ord_shipping"]); // 運送方式

    $ord->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料

    $sql_exe = $ord;
		
	}elseif ($_POST["table_title"] == "plan"){

    // 修改plan資料
    $sql_plan= "update plan set PLAN_NAME=:PLAN_NAME, PRICE=:PRICE, PLAN_TA=:PLAN_TA, PLAN_FEATURE=:PLAN_FEATURE where PLAN_NO =:DATA_INDEX";
    $plan = $pdo->prepare($sql_plan);

		$plan->bindValue(":PLAN_NAME",$_POST["plan_name"]); // 方案名稱
    $plan->bindValue(":PRICE",$_POST["plan_price"]); // 方案價格
    $plan->bindValue(":PLAN_TA",$_POST["plan_ta"]); // 適合對象
    $plan->bindValue(":PLAN_FEATURE",$_POST["plan_feature"]); // 方案特色

    $plan->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料

    $sql_exe = $plan;

	}elseif ($_POST["table_title"] == "sao"){

    $road = [];
    for($i=0; $i < 2; $i++){
      if($_FILES["prd_img_$i"]['error']==0){
        // 圖檔名
        // $file = `prd_._.$i`;
        $prdno = $_POST["data_index"]; // ok
        $file = "prd/prd_".$prdno."_".$i;
        $fileInfo = pathinfo($_FILES["prd_img_$i"]['name']);  // 路徑
        $ext = $fileInfo["extension"];
        $fileName = "$file.$ext";
      
        $from = $_FILES["prd_img_$i"]['tmp_name']; //暫存區含路徑
        $to = "../img/$fileName";
        copy($from, $to);
        
        $road[$i] = $fileName;
      };
    };

    // 修改sao資料
    $sql_sao= "update sao set STATE=:STATE, INFO=:INFO, BEFORE_IMG=:BEFORE_IMG, AFTER_IMG=:AFTER_IMG where SAO_NO =:DATA_INDEX";
    $sao = $pdo->prepare($sql_sao);

		$sao->bindValue(":STATE",$_POST["sao_status"]); // 服務訂單狀態
    $sao->bindValue(":INFO",$_POST["sao_report"]); // 結案回報內容
    $sao->bindValue(":BEFORE_IMG", $road[0]); // 服務前紀錄
    $sao->bindValue(":AFTER_IMG", $road[1]); // 服務後紀錄

    $sao->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料

    $sql_exe = $sao;
		
			
	}elseif ($_POST["table_title"] == "casetable"){
		
    // 修改casetable資料
    $sql_casetable= "update casetable set INFO_BEFORE=:INFO_BEFORE, INFO_AFTER=:INFO_AFTER where CASE_NO =:DATA_INDEX";
    // $sql_casetable= "update casetable set INFO_BEFORE=:INFO_BEFORE, INFO_AFTER=:INFO_AFTER, BEFORE_IMG=:BEFORE_IMG, AFTER_IMG=:AFTER_IMG where CASE_NO =:DATA_INDEX";
    $casetable = $pdo->prepare($sql_casetable);

		$casetable->bindValue(":INFO_BEFORE",$_POST["case_before"]); // 整理前文案
    $casetable->bindValue(":INFO_AFTER",$_POST["case_after"]); // 整理後文案
    // $casetable->bindValue(":BEFORE_IMG",$_POST["before_img"]); // 整理前圖片
    // $casetable->bindValue(":AFTER_IMG",$_POST["after_img"]); // 整理後圖片

    $casetable->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料

    $sql_exe = $casetable;
		
	}elseif ($_POST["table_title"] == "event"){

    // 修改event資料
    $sql_event= "update event set TITLE=:TITLE, START=:START, END=:END, PARM=:PARM, STATE=:STATE, CONTENT=:CONTENT where COUPON =:DATA_INDEX";
    // $sql_event= "update event set COUPON=:COUPON, TITLE=:TITLE, START=:START, END=:END, PARM=:PARM, STATE=:STATE, EVENT_IMG=:EVENT_IMG, CONTENT=:CONTENT where COUPON =:DATA_INDEX";
    $event = $pdo->prepare($sql_event);

		// $event->bindValue(":COUPON",$_POST["event_coupon"]); // 折扣碼
    $event->bindValue(":TITLE",$_POST["event_title"]); // 活動標題
    $event->bindValue(":START",$_POST["event_start"]); // 開始日期
    $event->bindValue(":END",$_POST["event_end"]); // 截止日期
    $event->bindValue(":PARM",$_POST["event_parm"]); // 優惠折數
    $event->bindValue(":STATE",$_POST["event_status"]); // 活動上下架
    $event->bindValue(":CONTENT",$_POST["event_content"]); // 活動內文
    // $event->bindValue(":EVENT_IMG",$_POST["event_img"]); // 活動圖片

    $event->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料

    $sql_exe = $event;
		
	}elseif ($_POST["table_title"] == "columntable"){
		
    // 修改event資料
    $sql_columntable= "update columntable set TOPIC=:TOPIC, AUTHOR=:AUTHOR, SUBTITLE_01=:SUBTITLE_01, CONTENT1=:CONTENT1, SUBTITLE_02=:SUBTITLE_02, CONTENT2=:CONTENT2 where COLUMN_NO =:DATA_INDEX";
    // $sql_columntable= "update columntable set TOPIC=:TOPIC, AUTHOR=:AUTHOR, SUBTITLE_01=:SUBTITLE_01, CONTENT1=:CONTENT1, SUBTITLE_02=:SUBTITLE_02, CONTENT2=:CONTENT2, MAIN_PIC=:MAIN_PIC, MAIN_PIC=:MAIN_PIC, IMG1=:IMG1, IMG2=:IMG2 where COLUMN_NO =:DATA_INDEX";
    $columntable = $pdo->prepare($sql_columntable);

		// $columntable->bindValue(":COUPON",$_POST["columntable_coupon"]); // 折扣碼
    $columntable->bindValue(":TOPIC",$_POST["col_topic"]); // 專欄標題
    $columntable->bindValue(":AUTHOR",$_POST["col_author"]); // 專欄作者
    $columntable->bindValue(":SUBTITLE_01",$_POST["col_sub_title_1"]); // 專欄副標題1
    $columntable->bindValue(":CONTENT1",$_POST["col_content_1"]); // 專欄內文1
    $columntable->bindValue(":SUBTITLE_02",$_POST["col_sub_title_2"]); // 專欄副標題2
    $columntable->bindValue(":CONTENT2",$_POST["col_content_2"]); // 專欄內文2
    // $columntable->bindValue(":MAIN_PIC",$_POST["col_main_img"]); // 專欄主圖
    // $columntable->bindValue(":IMG1",$_POST["col_sub_img_1"]); // 專欄附圖1
    // $columntable->bindValue(":IMG2",$_POST["col_sub_img_2"]); // 專欄附圖2
    

    $columntable->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料

    $sql_exe = $columntable;
		
	};

$affect = $sql_exe->execute();
echo `修改${affect}筆資料`;

  
  // if($_FILES['upFile']['error']==0){
  //     $file = uniqid();
  //     $fileInfo = pathinfo($_FILES['upFile']['name']); 
  //     $ext = $fileInfo["extension"]; // 副檔名
  //     $fileName = "$file.$ext";
  //     $from = $_FILES['upFile']['tmp_name']; //暫存區含路徑
  //     $to = "../img/cus/$fileName";
  //     copy($from, $to);

      
      
      

  //     $_SESSION["CUS_NAME"] = $_POST["cus_name"];
  //     $_SESSION["CUS_TEL"] = $_POST["cus_tel"];
  //     $_SESSION["SEX"] = $_POST["gender"];
  //     $_SESSION["CUS_ADD"] = $_POST["cus_add"];
  //     $_SESSION["CUS_PIC"] = $fileName;
  
       
  //   }else{
  //     // 修改
  //     $sql = "update cus set CUS_NAME=:CUS_NAME, SEX=:SEX ,CUS_TEL=:CUS_TEL,CUS_ADD=:CUS_ADD where CUS_NO=:CUS_NO "; 
  //     $cus = $pdo->prepare($sql);
  
  //     $cus->bindValue(":CUS_NO",$_SESSION["CUS_NO"]); // 帳號
  //     $cus->bindValue(":CUS_NAME",$_POST["cus_name"]); // 姓名
  //     $cus->bindValue(":SEX", $_POST["gender"]); // 性別
  //     $cus->bindValue(":CUS_TEL", $_POST["cus_tel"]); // 電話
  //     $cus->bindValue(":CUS_ADD", $_POST["cus_add"]); // 地址
  
  //     $_SESSION["CUS_NAME"] = $_POST["cus_name"];
  //     $_SESSION["CUS_TEL"] = $_POST["cus_tel"];
  //     $_SESSION["SEX"] = $_POST["gender"];
  //     $_SESSION["CUS_ADD"] = $_POST["cus_add"];
  //   }

  
     
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

