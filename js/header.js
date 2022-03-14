// $(function () {
//     // menu 顯示
//     $('.menu_btns').on('click',function(){
//         console.log("menu_btns click");
//         $('.logo').toggleClass('on');
//         $('.header_function').toggleClass('on');
//         $('.menu_link').toggleClass('on');
//         $('header').addClass('open');
        
//     });

//     $('.go_top span').on('click',function () {
//         $('html, body').animate({
//         scrollTop: 0,
//         }, 500);
//         return false;
//     });
// });

$(window).on('load',function(){

    // menu 顯示
    $('.menu_btns').on('click',function(){
        console.log("menu_btns click");
        $('.logo').toggleClass('on');
        $('.header_function').toggleClass('on');
        $('.menu_link').toggleClass('on');
        $('header').addClass('open');
        
    });

    // go_top
    $('.go_top span').on('click',function () {
        $('html, body').animate({
            scrollTop: 0,
        }, 500);
        return false;
    });

    // 當下滑menu消失，上滑出現，打開時尚下滑不會有改變

    let prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    
        if($('.menu_link.on')[0]){
            console.log("menu_btns open, no slide disapper");
        }else{
            if (prevScrollpos > currentScrollPos) {
                $("header").removeClass("hide");
            } else {
                $("header").addClass("hide");
            }
        }
        
        prevScrollpos = currentScrollPos;
    }
});