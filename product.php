<?php 
try{
	require_once("phps/connect.php");
	$sql = "select * from prd where PRD_NO = {$_GET['prdno']}";
	$prodRowTable = $pdo->query($sql);
	$prodRow = $prodRowTable->fetch(PDO::FETCH_ASSOC);

    // 推薦商品
	$sql = "select * from prd where CATEGORY = '{$prodRow["CATEGORY"]}' and PRD_NO != {$_GET['prdno']}";
	$recommendPrds = $pdo->query($sql);
	$recommendPrdsRows = $recommendPrds->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	// echo "系統暫時不能正常運行，請稍後再試<br>";	
};
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- 初始設定，請自行修改title，及添加js連結 -->

    <!-- <head></head> -->
    <!-- @@include('layout/head.html') -->
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Google Text 連結 -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<!-- 網頁標題左側顯示logo -->
	<link rel="icon" href="img/soeasylogo.ico" type="image/x-icon">
	<!-- 收藏夾顯示圖示 -->
	<link rel="shortcut icon" href="img/soeasylogo.ico" type="image/x-icon">
	<!-- .css連結 -->
	<link rel="stylesheet" href="css/style.css">
	<!-- .js連結-->
	<script src="js/jquery.js"></script>
  	<script src="js/jquery-ui.js"></script>
  	<script src="js/vue.js"></script>
	<script src="js/header.js"></script>
	<script src="js/loading.js"></script>
    <title>商品內頁</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script> -->
</head>

<body>
    <!-- <header></header> -->
    <header>
        <div class="header_elements">
            <div class="logo">
                <a class="logo_link" href="home.html">
                    <img class="logo_img" src="img/SoEazy_logo.png" alt="">
                    <img class="logo_img none" src="img/logo_type.png" alt="">
                </a>
            </div>
            <div class="header_function"> <!-- 點按時 加上class: on icon 顏色改變-->
                <a class="user" href="login.html">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>
                </a>
                <a class="cart" href="cart.html">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z"/></svg>
                </a>
                <nav class="menu">
                    <div class="menu_btns">
                        <span class="menu_btn top"></span>
                        <span class="menu_btn mid"></span>
                        <span class="menu_btn bottom"></span>
                    </div>
                    <div class="menu_link"> <!-- 點按時 加上class: on menu出現-->
                        <div class="menu_link_option">
                            <ul class="menu_link_option_up">
                                <li>
                                    <a class="home_link" href="home.html">首頁</a>
                                </li>
                                <li>
                                    <a class="service_link" href="service.html">服務介紹</a>
                                </li>
                                <li>
                                    <a class="mall_link" href="mall.html">商城</a>
                                </li>
                            </ul>
                            <ul class="menu_link_option_down">
                                <li>
                                    <a class="activity_link" href="activity.html">活動與專欄</a>
                                </li>
                                <li>
                                    <a class="about_link" href="about.html">關於我們</a>
                                </li>
                                <li>
                                    <a class="game_link" href="game.html">整理人格測驗</a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu_slogan_info">
                            <p class="menu_slogan">收納整理不再是煩惱，收Easy 幫你找回理想生活</p>
                            <div class="menu_infos">
                                <ul class="menu_info_list">
                                    <li class="menu_info fb">
                                        <a href="link_ig">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
                                            <p>收Easy FB</p>
                                        </a>
                                    </li>
                                    <li class="menu_info ig">
                                        <a href="link_ig">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                                            <p>soeasy_foryou</p>
                                        </a>
                                    </li>
                                    <li class="menu_info phone">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z"/></svg>
                                        <p>(02) 8847-6565</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- loading畫面 -->
        <!-- <div id='loading_box'>
            <svg id="loading_svg" viewbox="-300,-1000,600,2000" preserveAspectRatio="xMidYMid slice">
                <polyline points="-50,-38 -50,30 50,30 50,-38"/>
                <line x1="-89" y1="3" x2="-50" y2="-37">
                    <animateTransform attributeName="transform"
                        type="rotate"
                        values="0;200"
                        dur="1s" begin="1.5s" fill="freeze"
                        repeatCount="1"/>
                </line>
                <line x1="89" y1="3" x2="50" y2="-37">
                    <animateTransform attributeName="transform"
                        type="rotate"
                        values="0;-200"
                        dur="1s" begin="1.5s" fill="freeze"
                        repeatCount="1"/>
                </line>
                <rect x="-25" y="-10" width="20" height="20" id="left_bottom_box"/>
                <rect x="-25" y="-27" width="17" height="17" id="left_up_box"/>
                <polyline points="26,-27  3, 10 26,10" id="right_bottom_box"/>
                <polyline points=" 3,-27 26,-27  3,10" id="right_up_box"/>
            </svg>
            <div class="pic"><img src="img/SoEazy.png" alt=""></div>
        </div> -->
    </header>

<!-- <script>
    //header 下滑消失，上滑出現
    gsap.registerPlugin(ScrollTrigger);

    let showAnim = gsap.from("header", { 
        yPercent: -100,
        paused: true,
        duration: 0.2
        }).progress(1);

        ScrollTrigger.create({
        start: "top top",
        end: 99999,
        onUpdate: (self) => {
            self.direction === -1 ? showAnim.play() : showAnim.reverse()
        }
    });
    
</script> -->



    <!-- 橫幅 -->
    <main>
    
        <!-- 商品明細 -->
        <section class="prod_info">
            <div class="prod_con">
                <div class="prod_row">
                    <!-- 商品 1-1 -->
                    <div class="prod_img largeimg">
                        <img src="img/<?=$prodRow["IMG1"]?>" id="large">
                    </div>
                    <div class="prod_item">
                        <!-- 商品 1-2 -->
                        <div class="prod_img smallimg pointer">
                            <img src="img/<?=$prodRow["IMG2"]?>" class="small"/>
                        </div>           
                        <!-- 商品 1-3 -->
                        <div class="prod_img smallimg pointer">
                            <img src="img/<?=$prodRow["IMG3"]?>" class="small"/>
                        </div>
                        <!-- 商品 1-4 -->
                        <div class="prod_img smallimg pointer">
                            <img src="img/<?=$prodRow["IMG1"]?>" class="small"/>
                        </div>
                    </div>           
                </div>
                <!-- 商品文字 -->  
                <div class="prod_row">          
                    <div class="prod_txt">
                        <h3>
                            <?=$prodRow["PRD_NAME"]?>
                        </h3>
                        <p>
                            <?=$prodRow["PRD_DE"]?>
                        </p>
                        <p class="prod_price">
                            NT $<?=$prodRow["PRICE"]?>
                        </p>
                        <div class="prod_amount">
                            <p>
                                數量
                            </p>
                            <div class="prod_minbtn">
                                <input type="button" class="btnminus" value="-">
                                <input type="text" id="num" class="qtybox" name="qty" value="1">
                                <input type="button" class="btnplus" value="+">
                            </div>
                        </div>
                        <div class="btn_btn_box">
                            <button class="btn_btn bl pointer" id="cart">
                                加入購物車
                            </button>
                            <a href="cart.html" id="buy">
                                <button class="btn_btn bl pointer">
                                    立即購買
                                </button>
                            </a>
                        </div> 
                    </div>
                </div> 
            </div> 
        </section>
        
        <!-- 商品介紹 -->
        <section class="prod_detail">
            <h3 class="htop1">
                商品介紹
            </h3>
            <div class="prod_con">
                <div class="prod_derow">
                    <div class="prod_warpper">
                        <div class="prod_img">
                            <img src="img/<?=$prodRow["INFO_IMG1"]?>">
                        </div>
                    </div>
                    <div class="prod_warpper">
                        <div class="prod_txt">
                            <h3>
                                <?=$prodRow["INFO_TITLE_1"]?>
                            </h3>
                            <p>
                                <?=$prodRow["INFO_1"]?>
                            </p>
                        </div>
                    </div>
                </div>   
                <div id="derow_change" class="prod_derow">       
                    <div class="prod_warpper">
                        <div class="prod_img">
                            <img src="img/<?=$prodRow["INFO_IMG2"]?>">
                        </div>
                    </div>
                    <div class="prod_warpper">
                        <div class="prod_txt">
                            <h3>
                                <?=$prodRow["INFO_TITLE_2"]?>
                            </h3>
                            <p>
                                <?=$prodRow["INFO_2"]?>
                            </p>
                        </div>
                    </div>               
                </div>
            </div>
        </section>
        
        <!-- 商品規格 -->
        <section class="prod_spec">
            <h3 class="htop1">
                商品規格
            </h3>
            <div class="prod_con">
                <div class="prod_sprow">
                    <div class="prod_img">
                        <img src="img/<?=$prodRow["SPEC_IMG"]?>" class="img_com">
                        <img src="img/<?=$prodRow["SPEC_IMG"]?>" class="img_cell">
                    </div>
                </div>
            </div>
        </section>

        <!-- 推薦商品 -->
        <section class="prod_recom">
            <h3 class="htop2">
                推薦商品
            </h3>
            <div class="prod_con">             
                <div class="prod_rerow">
                    <!-- button left -->
                    <!-- <div class="reitem_btn">
                        <div class="left_btn">
                            <button class="btn_btn bl pointer"><</button>
                        </div>-->
                    <!-- </div> --> 
                    <?php 
                        // shuffle($recommendPrdsRows);
                        // $arrPrd = array_slice($recommendPrdsRows,0, 5)
                        // foreach($recommendPrdsRows as $i => $recommendPrdRow){
                        for($i=0;$i<5;$i++){
                    ?>	
                    <!-- 推薦商品 -->
                    <div class="prod_reitem reitem_goods">
                        <div class="prod_img">
                            <a href="product.php?prdno=<?=$recommendPrdsRows[$i]['PRD_NO']?>">
                                <img src="img/<?=$recommendPrdsRows[$i]["IMG1"]?>">
                            </a>
                        </div>
                        <div class="prod_txt">
                            <h3>
                                <a href="product.php?prdno=<?=$recommendPrdsRows[$i]['PRD_NO']?>">
                                    <?=$recommendPrdsRows[$i]["PRD_NAME"]?>
                                </a>
                            </h3>
                            <p>
                                NT $<?=$recommendPrdsRows[$i]["PRICE"]?>
                            </p>
                            <div class="btn_btn_box prod_btn">
                                <a href="cart.html">
                                    <button class="btn_btn bl pointer">
                                        購買
                                    </button>
                                </a>
                            </div> 
                        </div>
                    </div>
                    <?php 
                    }
                    ?>

                    <!-- button right -->
                    <!-- <div class="reitem_btn">
                        <div class="right_btn">
                            <button class="btn_btn bl pointer">></button>         
                        </div>
                    </div> -->
                </div>
            </div> 
        </section>
    </main>


    <!-- <footer></footer> -->
    <footer>
        <div class="footer_elements">
            <div class="go_top">
                <span class="link_ro bl">Top</span>
            </div>

            <div class="col-12 footer_info">
                <div class="col-4 logo_slogan">
                    <div class="logo">
                        <a class="logo_link" href="home.html">
                            <img class="logo_img" src="img/SoEazy.png" alt="">
                        </a>
                    </div>
                    <p>收納整理不再是煩惱</p>
                    <p>收Easy 幫你找回理想生活</p>
                </div>
                <div class="col-4 reserve">
                    <a class="go_reserve" href="reserve.html">
                        <!-- <img class="logo_shaped" src="../../img/SoEazy_house.png" alt=""> -->
                        <p>立即預約!</p>
                    </a>
                </div>
                <div class="col-4 footer_infos">
                    <ul class="footer_info_list">
                        <li class="footer_info_link fb">
                            <a href="link_fb">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
                                <p>收Easy</p>
                            </a>
                        </li>
                        <li class="footer_info_link ig">
                            <a href="link_ig">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                                <p>soeasy_foryou</p>
                            </a>
                        </li>
                        <li class="footer_info_link phone">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z"/></svg>
                            <p>(02) 8847-6565</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                    <p>&copy;copyright 2022 SoEasy CFD104-G1</p>
                    <p>本網站為緯育TibaMe_前端設計工程師班第73期學員專題成果作品，本平台僅供學習、展示之用。若有抵觸有關著作權，或有第三人主張侵害智慧財產權等情事，均由學員負法律上責任，緯育公司概不負責。若有侵權疑慮，您可以私訊<a href="https://www.facebook.com/TibaMe">[緯育TibaMe]</a>，後續會由專人協助處理。</p>
            </div>
        </div>
    </footer>



    <script type="text/javascript" src="js/product.js"></script>

    <script>    
        function showLarge(e){
            let small = e.target.src; 
            let big = document.getElementById("large").src;
            document.getElementById("large").src = small;
            e.target.src = big;
        }

        let prd_name = <?php echo json_encode($prodRow) ?>;
        // cartArr[0].prdNo = prd_name.PRD_NO;
        // cartArr[0].prdNum = num;
        
        function setItemCart(){
            var num = parseInt($("#num").val());
            // console.log(JSON.parse(localStorage.getItem("cart")));
            var cartArr = JSON.parse(localStorage.getItem("cart"));
            if(cartArr == null){
                cartArr = [];
                // cartArr.push({prdNo : prd_name.PRD_NO, prdName : prd_name.PRD_NAME, prdPrice : prd_name.PRICE, prdImg : prd_name.IMG1, prdNum : num});
            };
            // console.log(cartArr.filter(obj=>obj.prdNo == prd_name.PRD_NO));
            arrObj = cartArr.filter(obj=>obj.prdNo == prd_name.PRD_NO)
            if(arrObj.length==0){
                cartArr.push({prdNo : prd_name.PRD_NO, prdName : prd_name.PRD_NAME, prdPrice : prd_name.PRICE, prdImg : prd_name.IMG1, prdNum : num});
            }else{
                index = cartArr.indexOf(arrObj[0]);
                cartArr[index].prdNum = cartArr[index].prdNum + num;
            };
            // localStorage.setItem(prd_name.PRD_NO,num);
            localStorage.setItem("cart",JSON.stringify(cartArr));
            // localStorage.setItem("cart",`${cartArr.toString()}`);
            
        }
        function init(){
            let smalls = document.getElementsByClassName("small");
            for(let i=0; i<smalls.length; i++){
                smalls[i].onclick = showLarge;
            }
            let cart = document.getElementById("cart");
            let buy = document.getElementById("buy");
            cart.addEventListener('click',setItemCart);
            buy.addEventListener('click',setItemCart);
        };
        window.addEventListener('load',init, false);
    </script>
</body>

</html>