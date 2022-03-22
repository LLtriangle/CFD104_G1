<?php
// session_start();
// echo $_FILES['upFile']['name'];
try{
  // require_once("../connect_cfd104g1.php"); // 上線用
	require_once("connect.php"); // 開發用
  // 檔案名稱：$_FILES['input的name']['name']
  // 檔案格式：$_FILES['input的name']['type']
  // 檔案的暫存位置：$_FILES['input的name']['tmp_name']
    if ($_POST["table_title"] == "new_emp") {

        if($_FILES["new_emp_img"]['error']==0){
            // 圖檔名
            // $file = `prd_._.$i`;
            $new_empno= $_POST["new_emp_tel"]; // ok
            $file = "emp".$new_empno;
            $fileInfo = pathinfo($_FILES["new_emp_img"]['name']);  // 路徑
            $ext = $fileInfo["extension"];
            $fileNameEmp = "$file.$ext";
          
            $from = $_FILES["new_emp_img"]['tmp_name']; //暫存區含路徑
            $to = "../img/$fileNameEmp";
      
            if(file_exists($to)){
              unlink($to);
            };
      
            copy($from, $to);
        };

		// 修改emp資料
        // $sql_new_emp= "insert into emp 
        // values (EMP_NO=null, EMP_NAME=:EMP_NAME, EMP_EMAIL=:EMP_EMAIL, EMP_PSW=:EMP_PSW, EMP_TEL=:EMP_TEL, EMP_STATE=:EMP_STATE, JOB=:JOB, EMP_ADD=:EMP_ADD, HIREDATE=:HIREDATE, INTRO=:INTRO";
        $sql_new_emp= "INSERT INTO `emp`(`EMP_NAME`, `EMP_EMAIL`, `EMP_PSW`, `EMP_TEL`, `EMP_STATE`, `JOB`, `EMP_ADD`, `HIREDATE`, `INTRO`, `EMP_PIC`) VALUES (:EMP_NAME,:EMP_EMAIL, :EMP_PSW, :EMP_TEL, :EMP_STATE,:JOB,:EMP_ADD,:HIREDATE,:INTRO, '$fileNameEmp')";

        // if(isset($fileNameEmp)){$sql_new_emp = $sql_new_emp.", EMP_PIC='$fileNameEmp'";};

        // $sql_new_emp = $sql_new_emp."  )";

        $new_emp = $pdo->prepare($sql_new_emp);

        // $new_emp->bindValue(":EMP_NO", $_POST["new_emp_no"]); //員工編號
        $new_emp->bindValue(":EMP_NAME", $_POST["new_emp_name"]); //員工姓名
        $new_emp->bindValue(":EMP_EMAIL", $_POST["new_emp_email"]); //員工email
        $new_emp->bindValue(":EMP_PSW", $_POST["new_emp_psw"]); //員工密碼
        $new_emp->bindValue(":EMP_TEL", $_POST["new_emp_tel"]); //員工電話
        $new_emp->bindValue(":EMP_STATE", $_POST["new_emp_status"]); //員工權限(正常 or 停權)
        $new_emp->bindValue(":JOB", $_POST["new_emp_job"]); //員工職稱
        $new_emp->bindValue(":EMP_ADD", $_POST["new_emp_add"]); //員工地址
        $new_emp->bindValue(":HIREDATE", $_POST["new_emp_hiredate"]); //員工入值日
        $new_emp->bindValue(":INTRO", $_POST["new_emp_intro"]); //員工介紹

        echo $_POST["new_emp_add"];

        $sql_exe = $new_emp;
		
	
	}elseif ($_POST["table_title"] == "new_prd"){
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

        for($j=1; $j < 3; $j++){
            if($_FILES["prd_img_$i"]['error']==0){
                // 圖檔名
                // $file = `prd_._.$i`;
                $prdno = $_POST["data_index"]; // ok
                $file = "prd/prd_".$prdno."_info_".$j;
                $fileInfo = pathinfo($_FILES["prd_img_$j"]['name']);  // 路徑
                $ext = $fileInfo["extension"];
                $fileName = "$file.$ext";
            
                $from = $_FILES["prd_img_$j"]['tmp_name']; //暫存區含路徑
                $to = "../img/$fileName";
                copy($from, $to);
                
                $road1[$j-1] = $fileName;
            };
        };

    
        // 修改prd資料
        // $sql_prd= "update prd set PRD_NAME=:PRD_NAME, CATEGORY=:CATEGORY, PRICE=:PRICE, STATE=:STATE, INFO_TITLE_1=:INFO_TITLE_1, INFO_1=:INFO_1, INFO_TITLE_2=:INFO_TITLE_2, INFO_2=:INFO_2 where PRD_NO =:DATA_INDEX";
        $sql_prd= "update prd set PRD_NAME=:PRD_NAME, CATEGORY=:CATEGORY, PRICE=:PRICE, STATE=:STATE, INFO_TITLE_1=:INFO_TITLE_1, INFO_1=:INFO_1, INFO_TITLE_2=:INFO_TITLE_2, INFO_2=:INFO_2, IMG1=:IMG1 , IMG2=:IMG2, IMG3=:IMG3, IMG4=:IMG4, INFO_IMG1=:INFO_IMG1, INFO_IMG2=:INFO_IMG2, SPEC_IMG=:SPEC_IMG where PRD_NO =:DATA_INDEX";

        $prd = $pdo->prepare($sql_prd);

        $prd->bindValue(":PRD_NAME",$_POST["prd_name"]); // 商品名稱
        $prd->bindValue(":CATEGORY",$_POST["prd_cate"]); // 商品類別
        $prd->bindValue(":PRICE",$_POST["prd_price"]); // 商品價格
        $prd->bindValue(":STATE",$_POST["prd_status"]); // 商品上下架
        $prd->bindValue(":INFO_TITLE_1",$_POST["prd_info_title_1"]); // 商品介紹標題1
        $prd->bindValue(":INFO_1",$_POST["prd_info_1"]); // 商品介紹內文1
        $prd->bindValue(":INFO_TITLE_2",$_POST["prd_info_title_2"]); // 商品介紹標題2
        $prd->bindValue(":INFO_2",$_POST["prd_info_2"]); // 商品介紹內文2

        // $prd->bindValue(":IMG1",$_POST["$road[1]"]); // 商品圖片1
        // $prd->bindValue(":IMG2",$_POST["prd_img_2"]); // 商品圖片2
        // $prd->bindValue(":IMG3",$_POST["prd_img_3"]); // 商品圖片3
        // $prd->bindValue(":IMG4",$_POST["prd_img_4"]); // 商品圖片4
        $prd->bindValue(":IMG1",  $road[0]); // 商品圖片1
        $prd->bindValue(":IMG2",  $road[1]); // 商品圖片2
        $prd->bindValue(":IMG3",  $road[2]); // 商品圖片3
        $prd->bindValue(":IMG4",  $road[3]); // 商品圖片4
        $prd->bindValue(":INFO_IMG1", $road1[1]); // 商品資訊圖1
        $prd->bindValue(":INFO_IMG2", $road1[2]); // 商品資訊圖2
        $prd->bindValue(":SPEC_IMG", $road[1]); // 商品規格圖

        $prd->bindValue(":DATA_INDEX", json_decode($_POST["data_index"])); //table 裡第幾筆資料

        $sql_exe = $prd;

	
	}elseif ($_POST["table_title"] == "new_casetable"){
		
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
		
	}elseif ($_POST["table_title"] == "new_event"){

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
		
	}elseif ($_POST["table_title"] == "new_columntable"){
		
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

}catch(PDOException $e){
  echo $e->getMessage();
}
?>

