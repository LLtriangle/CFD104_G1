$(function () {
    // menu 顯示
    $('.menu_btns').on('click',function(){
        console.log("menu_btns click");
        $('.logo').toggleClass('on');
        $('.header_function').toggleClass('on');
        $('.menu_link').toggleClass('on');
    });

    $('.go_top span').on('click',function () {
        $('html, body').animate({
        scrollTop: 0,
        }, 500);
        return false;
    });
});