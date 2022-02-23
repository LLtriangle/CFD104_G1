// 未完成:拖曳物件、撿垃圾、結果判斷

$(function () {
    // 開關門
    function openDoor(){
        $('#door').toggleClass('open');
        $('#pull_arrow').css('display','none');
    };
    $('#door').on('click',openDoor);
    $('#pull_arrow').on('click',openDoor);

    // 點擊放置
    $('.pullbox_group .pullbox').on('click',function(){
        if(!($(this).html()) && $('.item_group input:checked').length) {
            // 條件:位置為空，且有選擇物品
            $(this).append($('.item_group input:checked').parent());
        }else if($(this).html()){
            // 條件:位置上已有物品
            $(this).children().prependTo($('.item_group'));
        };
        
        // 送出按鈕disabled切換
        if($('.item_group label').length==0) {
            $('#finish').attr('disabled',false);
        }else if($('.item_group label').length>0){
            $('#finish').attr('disabled',true);
        };
    });

    // 點擊垃圾桶
    $('#trashcan').on('click',function(){
        if($('.item_group input:checked').length > 0) {
            // 條件:有選擇物品，丟進垃圾桶
            $('#trashcan ul').append(
                $('<li/>').append($('.item_group input:checked').parent())
            );
        }else{
            $('#open_trashcan').attr('disabled',false);
        };
        // 送出按鈕disabled切換
        if($('.item_group label').length==0) {
            $('#finish').attr('disabled',false);
        }else if($('.item_group label').length>0){
            $('#finish').attr('disabled',true);
        };
        $('.item_group label input:checked').prop('checked',false);
    });

    // 點擊垃圾
    $(document).on('click','.garbage li',function(e){
        $(this).children().prependTo($('.item_group'));
        $(this).remove();
        $('.item_group label input:checked').prop('checked',false);
        e.stopPropagation();    //阻斷蔓延
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
        $('.pullbox_group .pullbox').children().appendTo($('.item_group'));
        $('.garbage li').children().appendTo($('.item_group'));
        $('.garbage li').remove();
    };
    $('#again').on('click',open_ill);

});

// 拖曳失敗
// function init(){
//     // 先跟HTML產生關聯，再建事件聆聽功能
//     leftbox = document.getElementById('leftbox');
//     image = document.getElementById('image');
//     rightbox = document.getElementById('rightbox');
  
//     $('label').on('dragstart',startDrag);
//     $('label').on('dragend',endDrag);
    
//     $('.trashcan').on('dragenter',function(e){e.preventDefault();});
//     $('.pullbox_group .pullbox').on('dragenter',function(e){e.preventDefault();});
//     $('.trashcan').on('dragover',function(e){e.preventDefault();});
//     $('.pullbox_group .pullbox').on('dragover',function(e){e.preventDefault();});
//     $('.trashcan').on('drop',droppedtrash);
//     $('.pullbox_group .pullbox').on('drop',dropped);
//   };
  
//   function startDrag(e){
//     let data = `${e}`;
//     e.dataTransfer.setData('label',data);
//   };
  
//   function endDrag(e){
//     // image.style.visibility = 'hidden';
//     // e.target.style.visibility = 'hidden';
//     // e.target.style.display = 'none';
//   };
  
//   function droppedtrash(e){
//     e.preventDefault();
//     $(this).children('.garbage').append(`<li>${e.dataTransfer.getData('label')}</li>`);
//   };
//   function dropped(e){
//     e.preventDefault();
//     $(this).append(e.dataTransfer.getData('label'));
//   };
  
//   window.addEventListener("load",init,false);
  
  