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
});