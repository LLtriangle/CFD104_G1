window.addEventListener('load',function(){
    gsap.from('#left_bottom_box',{
        x: 20,
        y: -150,
        delay: 0,
        rotation: 90,
        duration: 3,
        ease: "bounce.out",
        opacity:0,
        // repeat: -1,
    });
    gsap.from('#left_up_box',{
        x: -10,
        y: -190,
        delay: .6,
        rotation: -50,
        duration: 3,
        ease: "bounce.out",
        opacity:0,
        // repeat: -1,
    });
    gsap.from('#right_bottom_box',{
        x: -30,
        y: -220,
        delay: .3,
        rotation: -50,
        duration: 3,
        ease: "bounce.out",
        opacity:0,
        // repeat: -1,
    });
    gsap.from('#right_up_box',{
        x: 10,
        y: -250,
        delay: 1,
        rotation: -90,
        duration: 3,
        ease: "bounce.out",
        opacity:0,
        // repeat: -1,
    });
    $('#loading_box').delay(4000).slideUp(1000);
},false);