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

		// 修改emp資料
        // $sql_new_emp= "insert into emp 
        // values (EMP_NO=null, EMP_NAME=:EMP_NAME, EMP_EMAIL=:EMP_EMAIL, EMP_PSW=:EMP_PSW, EMP_TEL=:EMP_TEL, EMP_STATE=:EMP_STATE, JOB=:JOB, EMP_ADD=:EMP_ADD, HIREDATE=:HIREDATE, INTRO=:INTRO";
        $sql_new_emp= "INSERT INTO `emp`(`EMP_NAME`, `EMP_EMAIL`, `EMP_PSW`, `EMP_TEL`, `EMP_STATE`, `JOB`, `EMP_ADD`, `HIREDATE`, `INTRO`) VALUES (:EMP_NAME,:EMP_EMAIL, :EMP_PSW, :EMP_TEL, :EMP_STATE,:JOB,:EMP_ADD,:HIREDATE,:INTRO)";

        // if(isset($fileNameEmp)){$sql_new_emp = $sql_new_emp.", EMP_PIC='$fileNameEmp'";};

        // $sql_new_emp = $sql_new_emp."  )";

        $new_emp = $pdo->prepare($sql_new_emp);

        $new_emp->bindValue(":EMP_NAME", $_POST["new_emp_name"]); //員工姓名
        $new_emp->bindValue(":EMP_EMAIL", $_POST["new_emp_email"]); //員工email
        $new_emp->bindValue(":EMP_PSW", $_POST["new_emp_psw"]); //員工密碼
        $new_emp->bindValue(":EMP_TEL", $_POST["new_emp_tel"]); //員工電話
        $new_emp->bindValue(":EMP_STATE", $_POST["new_emp_status"]); //員工權限(正常 or 停權)
        $new_emp->bindValue(":JOB", $_POST["new_emp_job"]); //員工職稱
        $new_emp->bindValue(":EMP_ADD", $_POST["new_emp_add"]); //員工地址
        $new_emp->bindValue(":HIREDATE", $_POST["new_emp_hiredate"]); //員工入值日
        $new_emp->bindValue(":INTRO", $_POST["new_emp_intro"]); //員工介紹

        $new_emp_exe = $new_emp->execute();

        $lastNo = $pdo->lastInsertId();

        if($_FILES["new_emp_img"]['error']==0){
            // 圖檔名
            // $file = `prd_._.$i`;
            // $new_empno= $_POST["new_emp_tel"]; // ok
            $file = "emp_".$lastNo;
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

        $sql_new_emp_img="UPDATE `emp` SET `EMP_PIC`='$fileNameEmp' WHERE `EMP_NO`= '$lastNo'";

        $new_emp_img = $pdo->prepare($sql_new_emp_img);

        $sql_exe = $new_emp_img;
		
	
	}elseif ($_POST["table_title"] == "new_prd"){
        
        // 修改prd資料
        // $sql_prd= "update prd set PRD_NAME=:PRD_NAME, CATEGORY=:CATEGORY, PRICE=:PRICE, STATE=:STATE, INFO_TITLE_1=:INFO_TITLE_1, INFO_1=:INFO_1, INFO_TITLE_2=:INFO_TITLE_2, INFO_2=:INFO_2 where PRD_NO =:DATA_INDEX";

        // $sql_new_prd= "INSERT INTO `prd`(`CATEGORY`, `PRD_NAME`, `PRD_DE`, `PRICE`, `IMG1`, `IMG2`, `IMG3`, `IMG4`, `INFO_IMG1`, `INFO_TITLE_1`, `INFO_1`, `INFO_IMG2`, `INFO_TITLE_2`, `INFO_2`, `STATE`, `SPEC_IMG`) VALUES ( :CATEGORY, :PRD_NAME, :PRD_DE, :PRICE,'$road[0]','$road[1]','$road[2]','$road[3]','$fileNameInfo1', :INFO_TITLE_1, :INFO_1,'$fileNameInfo2', :INFO_TITLE_2, :INFO_2, :PRDSTATE,'$fileNameSpec')";

        $sql_new_prd= "INSERT INTO `prd`(`CATEGORY`, `PRD_NAME`, `PRD_DE`, `PRICE`, `INFO_TITLE_1`, `INFO_1`, `INFO_TITLE_2`, `INFO_2`, `STATE`) VALUES ( :CATEGORY, :PRD_NAME, :PRD_DE, :PRICE, :INFO_TITLE_1, :INFO_1, :INFO_TITLE_2, :INFO_2, :PRDSTATE)";

        $new_prd = $pdo->prepare($sql_new_prd);

        $new_prd->bindValue(":PRD_NAME",$_POST["new_prd_name"]); // 商品名稱
        $new_prd->bindValue(":CATEGORY",$_POST["new_prd_cate"]); // 商品類別
        $new_prd->bindValue(":PRICE",$_POST["new_prd_price"]); // 商品價格
        $new_prd->bindValue(":PRD_DE",$_POST["new_prd_des"]); // 商品價格
        $new_prd->bindValue(":PRDSTATE",$_POST["new_prd_status"]); // 商品上下架
        $new_prd->bindValue(":INFO_TITLE_1",$_POST["new_prd_info_title_1"]); // 商品介紹標題1
        $new_prd->bindValue(":INFO_1",$_POST["new_prd_info_1"]); // 商品介紹內文1
        $new_prd->bindValue(":INFO_TITLE_2",$_POST["new_prd_info_title_2"]); // 商品介紹標題2
        $new_prd->bindValue(":INFO_2",$_POST["new_prd_info_2"]); // 商品介紹內文2

        // $prd->bindValue(":IMG1",  $road[0]); // 商品圖片1
        // $prd->bindValue(":IMG2",  $road[1]); // 商品圖片2
        // $prd->bindValue(":IMG3",  $road[2]); // 商品圖片3
        // $prd->bindValue(":IMG4",  $road[3]); // 商品圖片4
        // $prd->bindValue(":INFO_IMG1", $road1[1]); // 商品資訊圖1
        // $prd->bindValue(":INFO_IMG2", $road1[2]); // 商品資訊圖2
        // $prd->bindValue(":SPEC_IMG", $road[1]); // 商品規格圖

        $new_prd_exe = $new_prd->execute();

        $lastNo = $pdo->lastInsertId();

        $road = [];
        for($i=1; $i < 5; $i++){
            if($_FILES["new_prd_img_$i"]['error']==0){
                // 圖檔名
                // $file = `prd_._.$i`;
                // $prdno = $_POST["data_index"]; // ok
                $file = "prd/prd_".$lastNo."_".$i;
                $fileInfo = pathinfo($_FILES["new_prd_img_$i"]['name']);  // 路徑
                $ext = $fileInfo["extension"];
                $fileName = "$file.$ext";
            
                $from = $_FILES["new_prd_img_$i"]['tmp_name']; //暫存區含路徑
                $to = "../img/$fileName";
                
                if(file_exists($to)){
                unlink($to);
                };

                copy($from, $to);
                
                $road[$i-1] = $fileName;
            };
        };

        
        if($_FILES["new_prd_info_img_1"]['error']==0){
            // 圖檔名
            // $file = `prd_._.$i`;
            //   $prdno = $_POST["data_index"]; // ok
            $file = "prd/prd_".$lastNo."_info_1";
            $fileInfo = pathinfo($_FILES["new_prd_info_img_1"]['name']);  // 路徑
            $ext = $fileInfo["extension"];
            $fileNameInfo1 = "$file.$ext";
            
            $from = $_FILES["new_prd_info_img_1"]['tmp_name']; //暫存區含路徑
            $to = "../img/$fileNameInfo1";

            if(file_exists($to)){
                unlink($to);
            };
        
            copy($from, $to);
        };

        if($_FILES["new_prd_info_img_2"]['error']==0){
            // 圖檔名
            // $file = `prd_._.$i`;
            //   $prdno = $_POST["data_index"]; // ok
            $file = "prd/prd_".$lastNo."_info_2";
            $fileInfo = pathinfo($_FILES["new_prd_info_img_2"]['name']);  // 路徑
            $ext = $fileInfo["extension"];
            $fileNameInfo2 = "$file.$ext";
            
            $from = $_FILES["new_prd_info_img_2"]['tmp_name']; //暫存區含路徑
            $to = "../img/$fileNameInfo2";

            if(file_exists($to)){
                unlink($to);
            };

            copy($from, $to);
        };
        
        if($_FILES["new_prd_spec_img"]['error']==0){
            // 圖檔名
            // $file = `prd_._.$i`;
            //   $prdno = $_POST["data_index"]; // ok
            $file = "prd/prd_".$lastNo."_spec";
            $fileInfo = pathinfo($_FILES["new_prd_spec_img"]['name']);  // 路徑
            $ext = $fileInfo["extension"];
            $fileNameSpec = "$file.$ext";
            
            $from = $_FILES["new_prd_spec_img"]['tmp_name']; //暫存區含路徑
            $to = "../img/$fileNameSpec";

            if(file_exists($to)){
                unlink($to);
            };

            copy($from, $to);
        };

        $sql_new_prd_img="UPDATE `prd` SET `IMG1`='$road[0]',`IMG2`='$road[1]',`IMG3`='$road[2]',`IMG4`='$road[3]',`INFO_IMG1`='$fileNameInfo1',`INFO_IMG2`='$fileNameInfo2',`SPEC_IMG`='$fileNameSpec' WHERE `PRD_NO`= '$lastNo'";

        
        $new_prd_img = $pdo->prepare($sql_new_prd_img);

        $sql_exe = $new_prd_img;

	}elseif ($_POST["table_title"] == "new_casetable"){


        // 修改casetable資料
        // $sql_new_emp= "insert into emp 
        // values (EMP_NO=null, EMP_NAME=:EMP_NAME, EMP_EMAIL=:EMP_EMAIL, EMP_PSW=:EMP_PSW, EMP_TEL=:EMP_TEL, EMP_STATE=:EMP_STATE, JOB=:JOB, EMP_ADD=:EMP_ADD, HIREDATE=:HIREDATE, INTRO=:INTRO";
        $sql_new_casetable= "INSERT INTO `casetable`(`INFO_BEFORE`, `INFO_AFTER`) VALUES (:INFO_BEFORE, :INFO_AFTER)";

        // if(isset($fileNameEmp)){$sql_new_emp = $sql_new_emp.", EMP_PIC='$fileNameEmp'";};

        // $sql_new_emp = $sql_new_emp."  )";

        $new_casetable = $pdo->prepare($sql_new_casetable);

        $new_casetable->bindValue(":INFO_BEFORE", $_POST["new_case_before"]); //整理前文案
        $new_casetable->bindValue(":INFO_AFTER", $_POST["new_case_after"]); //整理後文案

        $new_casetable_exe = $new_casetable->execute();

        $lastNo = $pdo->lastInsertId();

        if($_FILES["new_before_img"]['error']==0){
            // 圖檔名
            // $caseno = $_POST["data_index"]; // ok
            $file = "case_".$lastNo."_0";
            $fileInfo = pathinfo($_FILES["new_before_img"]['name']);  // 路徑
            $ext = $fileInfo["extension"];
            $fileNameBefore = "$file.$ext";
          
            $from = $_FILES["new_before_img"]['tmp_name']; //暫存區含路徑
            $to = "../img/case/$fileNameBefore";
      
            if(file_exists($to)){
              unlink($to);
            };
            
            copy($from, $to);
          };
      
          if($_FILES["new_after_img"]['error']==0){
            // 圖檔名
            // $caseno = $_POST["data_index"]; // ok
            $file = "case_".$lastNo."_1";
            $fileInfo = pathinfo($_FILES["new_after_img"]['name']);  // 路徑
            $ext = $fileInfo["extension"];
            $fileNameAfter = "$file.$ext";
          
            $from = $_FILES["new_after_img"]['tmp_name']; //暫存區含路徑
            $to = "../img/case/$fileNameAfter";
      
            if(file_exists($to)){
              unlink($to);
            };
      
            copy($from, $to);
          };

        $sql_new_emp_img="UPDATE `casetable` SET `BEFORE_IMG`='$fileNameBefore',`AFTER_IMG`='$fileNameAfter' WHERE `CASE_NO` ='$lastNo'";

        $new_emp_img = $pdo->prepare($sql_new_emp_img);

        $sql_exe = $new_emp_img;
		
        
		
	}elseif ($_POST["table_title"] == "new_event"){


        if($_FILES["new_event_img"]['error']==0){
            $eventno =$_POST["new_event_coupon"]; // ok
            $file = $eventno;
            $fileInfo = pathinfo($_FILES["new_event_img"]['name']);  // 路徑
            $ext = $fileInfo["extension"];
            $fileNameEvent = "$file.$ext";
          
            $from = $_FILES["new_event_img"]['tmp_name']; //暫存區含路徑
            $to = "../img/activity/$fileNameEvent";
      
            if(file_exists($to)){
              unlink($to);
            };
      
            copy($from, $to);
        };

        // 修改emp資料
        // $sql_new_emp= "insert into emp 
        // values (EMP_NO=null, EMP_NAME=:EMP_NAME, EMP_EMAIL=:EMP_EMAIL, EMP_PSW=:EMP_PSW, EMP_TEL=:EMP_TEL, EMP_STATE=:EMP_STATE, JOB=:JOB, EMP_ADD=:EMP_ADD, HIREDATE=:HIREDATE, INTRO=:INTRO";
        $sql_new_event= "INSERT INTO `event`(`COUPON`, `TITLE`, `CONTENT`, `PARM`, `START`, `END`, `STATE`, `EVENT_IMG`) VALUES (:COUPON, :TITLE, :CONTENT, :PARM, :EVENTSTART, :EVENTEND, :EVENTSTATE, '$fileNameEvent')";

        // if(isset($fileNameEmp)){$sql_new_event = $sql_new_event.", EMP_PIC='$fileNameEmp'";};

        // $sql_new_event = $sql_new_event."  )";

        $new_event = $pdo->prepare($sql_new_event);

        $new_event->bindValue(":COUPON", $_POST["new_event_coupon"]); //折扣碼
        $new_event->bindValue(":TITLE", $_POST["new_event_title"]); //活動標題
        $new_event->bindValue(":EVENTSTART", $_POST["new_event_start"]); //開始日期
        $new_event->bindValue(":EVENTEND", $_POST["new_event_end"]); //截止日期
        $new_event->bindValue(":PARM", $_POST["new_event_parm"]); //優惠折數
        $new_event->bindValue(":EVENTSTATE", $_POST["new_event_status"]); //上下架
        $new_event->bindValue(":CONTENT", $_POST["new_event_content"]); //活動介紹內文

        $sql_exe = $new_event;

        
	}elseif ($_POST["table_title"] == "new_columntable"){

        if($_FILES["new_col_main_img"]['error']==0){
            $colno =$_POST["new_col_no"]; // ok
            $file = "col_".$colno."_main";
            $fileInfo = pathinfo($_FILES["new_col_main_img"]['name']);  // 路徑
            $ext = $fileInfo["extension"];
            $fileNameColMain = "$file.$ext";
          
            $from = $_FILES["new_col_main_img"]['tmp_name']; //暫存區含路徑
            $to = "../img/activity/$fileNameColMain";
      
            if(file_exists($to)){
              unlink($to);
            };
      
            copy($from, $to);
        };

        if($_FILES["new_col_author_img"]['error']==0){
            $colno =$_POST["new_col_no"]; // ok
            $file = "col_".$colno."_author";
            $fileInfo = pathinfo($_FILES["new_col_author_img"]['name']);  // 路徑
            $ext = $fileInfo["extension"];
            $fileNameAuthor = "$file.$ext";
          
            $from = $_FILES["new_col_author_img"]['tmp_name']; //暫存區含路徑
            $to = "../img/activity/$fileNameAuthor";
      
            if(file_exists($to)){
              unlink($to);
            };
      
            copy($from, $to);
        };

        if($_FILES["new_col_sub_img_1"]['error']==0){
            $colno =$_POST["new_col_no"]; // ok
            $file = "col_".$colno."_1";
            $fileInfo = pathinfo($_FILES["new_col_sub_img_1"]['name']);  // 路徑
            $ext = $fileInfo["extension"];
            $fileNameImg1 = "$file.$ext";
          
            $from = $_FILES["new_col_sub_img_1"]['tmp_name']; //暫存區含路徑
            $to = "../img/activity/$fileNameImg1";
      
            if(file_exists($to)){
              unlink($to);
            };
      
            copy($from, $to);
        };


        // 修改columntable資料
        // $sql_new_emp= "insert into emp 
        // values (EMP_NO=null, EMP_NAME=:EMP_NAME, EMP_EMAIL=:EMP_EMAIL, EMP_PSW=:EMP_PSW, EMP_TEL=:EMP_TEL, EMP_STATE=:EMP_STATE, JOB=:JOB, EMP_ADD=:EMP_ADD, HIREDATE=:HIREDATE, INTRO=:INTRO";
        $sql_new_columntable= "INSERT INTO `columntable`(`COLUMN_NO`, `AUTHOR`, `AUTHOR_PIC`, `DATE`, `TOPIC`, `CONTENT1`, `CONTENT2`, `MAIN_PIC`, `IMG1`, `SUBTITLE_01`, `SUBTITLE_02`) VALUES (:COLUMN_NO, :AUTHOR, '$fileNameAuthor', :COLDATE, :TOPIC, :CONTENT1, :CONTENT2,'$fileNameColMain','$fileNameImg1', :SUBTITLE_01, :SUBTITLE_02)";

        $new_columntable = $pdo->prepare($sql_new_columntable);

        $new_columntable->bindValue(":COLUMN_NO", $_POST["new_col_no"]); //專欄編號
        $new_columntable->bindValue(":TOPIC", $_POST["new_col_topic"]); //專欄標題
        $new_columntable->bindValue(":AUTHOR", $_POST["new_col_author"]); //專欄作者
        // $new_columntable->bindValue(":AUTHOR_PIC", $_POST["new_col_author_img"]); //專欄作者圖片
        $new_columntable->bindValue(":COLDATE", $_POST["new_col_start"]); //發表時間
        $new_columntable->bindValue(":SUBTITLE_01", $_POST["new_col_sub_title_1"]); //專欄副標題1
        $new_columntable->bindValue(":SUBTITLE_02", $_POST["new_col_sub_title_2"]); //專欄副標題2
        $new_columntable->bindValue(":CONTENT1", $_POST["new_col_content_1"]); //專欄內文1
        $new_columntable->bindValue(":CONTENT2", $_POST["new_col_content_2"]); //專欄內文2

        

        $sql_exe = $new_columntable;
        // $new_columntable->execute();;
		
	};

    $affect = $sql_exe->execute();
    // echo `修改${affect}筆資料`;

}catch(PDOException $e){
  // echo $e->getMessage();
}
?>

