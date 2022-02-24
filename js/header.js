$(document).ready(function(){
    // menu 顯示
    $('.menu_btns').click(function(){
        console.log("menu_btns click");
        $('.logo').toggleClass('on');
        $('.header_function').toggleClass('on');
        $('.menu_link').toggleClass('on');
    });
});
