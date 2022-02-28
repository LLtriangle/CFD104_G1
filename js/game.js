// 未完成:拖曳物件、結果判斷
function init() {
    // 拖放物件
    // $('.item_group img').draggable({
    //     // cursor: 'grabbing',
    //     // opacity: .5,
    //     // revert: true,
    //     // start(event){
    //     //     event.addClass('selected');
    //     // },
        
    // });
    // $('#garbage').droppable({
    //     activate: function( event, ui ) {
    //         console.log(event.currentSrc());
    //         // console.log(ui.draggable);
    //     },
    // });

    // 點選物件
    function itemClick(){
        $(this).toggleClass('selected');
    };
    $('.item_group img').on('click',itemClick);

    // 送出按鈕disabled切換
    function finishButton(){
        console.log(0);
        if($('.item_group img').length == 0) {
            $('#finish').attr('disabled',false);
        }else if($('.item_group img').length > 0){
            $('#finish').attr('disabled',true);
        };
    };

    // 點擊放置
    $('.pullbox_group .pullbox').on('click',function(){
        if(!($(this).html()) && $('.item_group img.selected').length) {
            // 條件:位置為空，且有選擇物品
            $(this).append($('.item_group img.selected'));
        }else if($(this).html()){
            // 條件:位置上已有物品
            $(this).children().prependTo($('.item_group'));
        };
        finishButton();   // 送出按鈕disabled切換
    });

    // 點擊衣櫃
    function openWardrobe(){
        if($('.item_group img.selected').length > 0) {
            // 條件:有選擇物品，收進衣櫃
            $('#wardrobe #hiding').append($('.item_group img.selected'));
        }else{
            $('#wardrobe').toggleClass('open');
            $('#pull_arrow').css('display','none');
        };
        finishButton();   // 送出按鈕disabled切換
    };
    $('#wardrobe > img').on('click',openWardrobe);
    $('#pull_arrow').on('click',openWardrobe);

    // 點擊垃圾桶
    $('#trashcan .pic').on('click',function(){
        if($('.item_group img.selected').length > 0) {
            // 條件:有選擇物品，丟進垃圾桶
            $('#trashcan #garbage').append($('.item_group img.selected'));
        }else{
            $('#trashcan').toggleClass('open');
        };
        finishButton();   // 送出按鈕disabled切換
    });

    // 點擊收納物
    $(document).on('click','#hiding img',function(e){
        $(this).prependTo($('.item_group'));
        // $('.item_group label img.selected').prop('checked',false);
    });

    // 點擊垃圾
    $(document).on('click','#garbage img',function(e){
        $(this).prependTo($('.item_group'));
        // $('.item_group label img.selected').prop('checked',false);
    });
    
    // 開始測驗，關閉說明視窗
    function switch_light(e){ //燈箱開關
        $(this).parent().css('display','none');
    };
    $('.text_ill button').on('click',switch_light);
    // 完成放置，跳出測驗結果
    function open_result(){ //燈箱開關
        $(".text_result").css('display','block');
    };
    $('#finish').on('click',open_result);
    // 再來一次，跳出說明視窗(遊玩方法)
    function open_ill(){ //燈箱開關
        $(".text_ill .intr").css('display','block');
        $(".text_result").css('display','none');
        $('#finish').attr('disabled',true);
        $('.pullbox_group .pullbox img').appendTo($('.item_group'));
        $('#garbage img').appendTo($('.item_group'));
        $('#hiding img').appendTo($('.item_group'));
    };
    $('#again').on('click',open_ill);

    // 拖放物件

    // leftbox = document.querySelector('.item_group');
    // image = document.querySelector('.item_group img');
    // pullboxs = document.querySelectorAll('.pullbox_group .pullbox');
    // console.log(pullboxs);
    // console.log(pullboxs[1]);

    // image.addEventListener('dragstart',startDrag);
    // image.addEventListener('dragend',endDrag);
    
    // pullboxs[0].addEventListener('dragenter',function(e){e.preventDefault();});
    // pullboxs[0].addEventListener('dragover',function(e){e.preventDefault();});
    // pullboxs[0].addEventListener('drop',dropped);

    // function startDrag(e){
    //     // let data = '<img src="https://picsum.photos/225/225/?random=10">';
    //     e.dataTransfer.setData('picsum',e.target.id);
    //     console.log(e.target.src);
    // };

    // function endDrag(e){
    //     // image.style.visibility = 'hidden';
    //     // e.target.style.visibility = 'hidden';
    //     // e.target.style.display = 'none';
    // };

    // function dropped(e){
    //     e.preventDefault();
    //     console.log(this);
    //     $(this).append($(`#${e.dataTransfer.getData('picsum')}`));
    // };

};
window.addEventListener("load",init,false);