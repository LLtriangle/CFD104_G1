function init() {

    // 點選物件
    function itemClick(){
        $(this).toggleClass('selected');
    };
    $('#item_group img').on('click',itemClick);

    // 送出按鈕disabled切換
    function finishButton(){
        // console.log(0);
        if($('#item_group img').length == 0) {
            $('#finish').attr('disabled',false);
        }else if($('#item_group img').length > 0){
            $('#finish').attr('disabled',true);
        };
    };

    // 點擊放置
    function pullItem(e){
        if(!($(this).html()) && $('#item_group img.selected').length) {
            // 條件:位置為空，且有選擇物品
            $(this).append($('#item_group img.selected'));
        }else if($(this).html()){
            // 條件:位置上已有物品
            $(this).children().removeClass('selected');
            $(this).children().prependTo($('#item_group'));
        };
        finishButton();   // 送出按鈕disabled切換
    };
    $('.pullbox_group .pullbox').on('click',pullItem)

    // 點擊衣櫃
    function openWardrobe(){
        if($('#item_group img.selected').length > 0) {
            // 條件:有選擇物品，收進衣櫃
            $('#wardrobe #hiding').append($('#item_group img.selected'));
            $('#wardrobe #inside').removeClass('empty');
        }else{
            // 條件:未選擇物品，打開衣櫃
            $('#wardrobe').toggleClass('open');
            $('#pull_arrow').css('display','none');
            if($('#wardrobe #hiding img').length == 0){
                // 條件:衣櫃是空的，顯示為空
                $('#wardrobe #inside').addClass('empty');
            };
        };
        finishButton();   // 送出按鈕disabled切換
    };
    // $('#wardrobe').on('click',openWardrobe);
    $('#wardrobe > img').on('click',openWardrobe);
    $('#wardrobe #inside').on('click',openWardrobe);
    $('#pull_arrow').on('click',openWardrobe);

    // 點擊垃圾桶
    $('#trashcan .pic').on('click',function(){
        if($('#item_group img.selected').length > 0) {
            // 條件:有選擇物品，丟進垃圾桶
            $('#trashcan #garbage').append($('#item_group img.selected'));
            $('#trashcan').removeClass('empty');
        }else{
            // 條件:未選擇物品，打開垃圾桶
            $('#trashcan').toggleClass('open');
            if($('#trashcan #garbage img').length == 0){
                // 條件:垃圾桶是空的，顯示為空
                $('#trashcan').addClass('empty');
            };
        };
        finishButton();   // 送出按鈕disabled切換
    });

    // 點擊衣櫃內收納物
    $(document).on('click','#hiding img',function(e){
        $(this).removeClass('selected');
        $(this).prependTo($('#item_group'));
        finishButton();   // 送出按鈕disabled切換
        if($('#wardrobe #hiding img').length == 0){
            // 條件:衣櫃是空的，顯示為空
            $('#wardrobe #inside').addClass('empty');
        };
    });

    // 點擊垃圾
    $(document).on('click','#garbage img',function(e){
        $(this).removeClass('selected');
        $(this).prependTo($('#item_group'));
        finishButton();   // 送出按鈕disabled切換
        if($('#trashcan #garbage img').length == 0){
            // 條件:垃圾桶是空的，顯示為空
            $('#trashcan').addClass('empty');
        };
    });
    
    // 開始測驗，關閉說明視窗
    function switchLight(e){
        $(this).parent().slideToggle(500,'easeInCirc');
    };
    $('.text_ill button').on('click',switchLight);

    // 完成放置，做判斷(vue)，跳出測驗結果
    function openResult(){
        $(".text_result").css('display','block');
        $(".text_result .typewriter").css('bottom','0');
        $(".text_result .paper h2").animate({
            marginTop: '10%',
        },2000,'easeOutBack');
    };
    $('#finish').on('click',openResult);

    // 再來一次，跳出說明視窗(遊玩方法)，物品歸位
    function openIll(){
        $(".text_ill .intr").slideToggle(1000,'easeOutBounce'); // 跳出說明視窗
        $('#pull_arrow').css('display','block');    // 回復衣櫃上提示手指
        $('#wardrobe').removeClass('open');         // 關上衣櫃
        $('#trashcan').removeClass('open');         // 關上垃圾桶
        $('.text_result .paper').scrollTop(0);                  // 回復紙張捲動高度
        $(".text_result .paper h2").css('margin-top','100%');   // 回復紙張高度(animate可再次啟動)
        $(".text_result").css('display','none');    // 藏起測驗結果
        $('#finish').attr('disabled',true);         // 藏起完成擺放按鈕
        $('.pullbox_group .pullbox img').appendTo($('#item_group'));    // 清空擺放物品
        $('#garbage img').appendTo($('#item_group'));   // 清空垃圾桶
        $('#hiding img').appendTo($('#item_group'));    // 清空衣櫃
        $('#item_group img').removeClass('selected');   // 回復物品未選取狀態
    };
    $('#again').on('click',openIll);
    
    // $('#control_txt').on('checked',closeTxt);


    function selectAll() {
        $('#item_group img').toggleClass('selected');
    };

    $('#select_all').on('change',selectAll);
    
};
window.addEventListener("load",init,false);

