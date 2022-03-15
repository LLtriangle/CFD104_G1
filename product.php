<?php 
try{
	require_once("phps/connect.php");
	$sql = "select * from prd where PRD_NO = {$_GET['prdno']}";
	$prodRowTable = $pdo->query($sql);
	$prodRow = $prodRowTable->fetch(PDO::FETCH_ASSOC);

    // 推薦商品
	$sql = "select * from prd where CATEGORY = '{$prodRow["CATEGORY"]}'";
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

    <!-- 初始設定，請自行修改title，及添加js連結 -->

    <!-- <head></head> -->
    <!-- @@include('layout/head.html') -->
    <title>商品內頁</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script> -->
</head>

<body>
    <!-- <header></header> -->
    <!-- @@include('layout/header.html') -->

    <!-- 橫幅 -->
    <!-- <main>
        <section class="uni_banner">
			<div>
				<div class="pic">
					<img src="img/banner_roof.png" alt="屋頂">
				</div>
				<div class="txt">
					<h4>PRODUCT</h4>
					<h1>商品內頁</h1>
				</div>
			</div>
			<div>
				<div class="pic">
					<img src="https://picsum.photos/750/400/?random=10" alt="banner圖">
				</div>
				<div class="txt">
					<p>收easy - 收納東西好easy</p>
					<p>有了收easy 從此生活 So easy</p>
				</div>
			</div>
		</section>
    </main> -->
    
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
                        可堆疊式整理箱，充分利用零散角落<br>
                        彈性收納各式物品，擴充儲存空間<br>
                        簡約外型，適用多種環境<br>
                        輕輕鬆鬆打造居家美感生活<br>
                        靈活運用空間，從此和雜亂無章說再見！
                    </p>
                    <p class="prod_price">
                        NT $<?=$prodRow["PRICE"]?>
                    </p>
                    <div class="prod_amount">
                        <p>
                            數量
                        </p>
                        <div class="prod_minbtn">
                            <input type="button" class="btnminus" value="-" id="minus">
                            <input type="text" class="qtybox" name="qty" value="1" id="num">
                            <input type="button" class="btnplus" value="+" id="add">
                        </div>
                    </div>
                    <div class="btn_btn_box">
                        <button class="btn_btn bl pointer" id="cart">
                            加入購物車
                        </button>
                        <a href="cart.html">
                            <button class="btn_btn bl pointer" id="buy">
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
                <div class="reitem_btn">
                    <div class="left_btn">
                        <button class="btn_btn bl pointer"><</button>
                    </div>
                </div>
            <?php 
                foreach($recommendPrdsRows as $i => $recommendPrdRow){
            ?>	
                <!-- 推薦商品 -->
                <div class="prod_reitem reitem_goods">
                    <div class="prod_img">
                        <a href="product.html">
                            <img src="img/<?=$recommendPrdRow["IMG1"]?>">
                        </a>
                    </div>
                    <div class="prod_txt">
                        <h3>
                            <a href="product.html">
                                <?=$recommendPrdRow["PRD_NAME"]?>
                            </a>
                        </h3>
                        <p>
                            NT $<?=$recommendPrdRow["PRICE"]?>
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
                <div class="reitem_btn">
                    <div class="right_btn">
                        <button class="btn_btn bl pointer">></button>         
                    </div>
                </div>
            </div>
        </div> 
    </section>
                    
    <script>            
    function showLarge(e){
        let small = e.target.src; 
        let big = document.getElementById("large").src;
        document.getElementById("large").src = small;
        e.target.src = big;
    }
    function init(){
        let smalls = document.getElementsByClassName("small");
        for(let i=0; i<smalls.length; i++){
            smalls[i].onclick = showLarge;
        }
    }
    window.addEventListener("load", init, false);
    </script>

    <!-- <footer></footer> -->
    <!-- @@include('layout/footer.html') -->

    <script type="text/javascript" src="js/product.js"></script>
    <script>
        
        let prd_name = <?php echo json_encode($prodRow) ?>;
        // cartArr[0].prdNo = prd_name.PRD_NO;
        // cartArr[0].prdNum = num;
        
        function setItemCart(){
            
            var num = parseInt($("#num").val());
            // console.log(JSON.parse(localStorage.getItem("cart")));
            var cartArr = JSON.parse(localStorage.getItem("cart"));
            if(cartArr == null){
                // console.log('cartnull');
                cartArr = [];
            }
            // console.log(cartArr.filter(obj=>obj.prdNo == prd_name.PRD_NO));
            arrObj = cartArr.filter(obj=>obj.prdNo == prd_name.PRD_NO)
            if(arrObj.length==0){
                cartArr.push({"prdNo" : prd_name.PRD_NO,"prdNum" : num});
            }else{
                index = cartArr.indexOf(arrObj[0]);
                cartArr[index].prdNum = cartArr[index].prdNum + num;
            };
            // localStorage.setItem(prd_name.PRD_NO,num);
            localStorage.setItem("cart",JSON.stringify(cartArr));
            // localStorage.setItem("cart",`${cartArr.toString()}`);
            
        }
        function init(){
            let cart = document.getElementById("cart");
            let buy = document.getElementById("buy");
            cart.addEventListener('click',setItemCart);
            buy.addEventListener('click',setItemCart);
        };
        window.addEventListener('load',init, false);
    </script>
</body>

</html>