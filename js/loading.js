$(document).ready(function(){
    gsap.from('#left_bottom_box',{
        x: 20,
        y: -150,
        delay: 0,
        rotation: 90,
        duration: 2,
        ease: "bounce.out",
        opacity:0,
        // repeat: -1,
    });
    gsap.from('#left_up_box',{
        x: -10,
        y: -190,
        delay: .4,
        rotation: -50,
        duration: 2,
        ease: "bounce.out",
        opacity:0,
        // repeat: -1,
    });
    gsap.from('#right_bottom_box',{
        x: -30,
        y: -220,
        delay: .2,
        rotation: -50,
        duration: 2,
        ease: "bounce.out",
        opacity:0,
        // repeat: -1,
    });
    gsap.from('#right_up_box',{
        x: 10,
        y: -250,
        delay: .8,
        rotation: -90,
        duration: 2,
        ease: "bounce.out",
        opacity:0,
        // repeat: -1,
    });
});

window.addEventListener('load',function(){
    $('#loading_box').delay(500).slideUp(700);
});