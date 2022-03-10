$(window).on('load',function(){
    gsap.registerPlugin(ScrollTrigger);
        // ScrollTrigger.matchMedia({
        //     // 跟設定css 一樣  如果畫面不小於 992px 執行
        //     "(min-width: 992px)": () => { 執行內容 },
        //     // 畫面不小於 768px 執行
        //     "(min-width: 768px)": () => { 執行內容 },
        //     // 不管畫面大小，我都執行
        //     "all": () => { 執行內容 },
        // });

        //讓scroll trigger 可以使用blur

        //this is just an example plugin that allows us to animate a "blur" property like gsap.to(target, {blur:10}) and it'll feed that value to this plugin which will do all the necessary calculations to add/update a blur() value in the CSS "filter" property (in browsers that support it). We wrap it in an iife just so that we can declare some local variables in a private scope at the top.

        (function() {
            const blurProperty = gsap.utils.checkPrefix("filter"),
                    blurExp = /blur\((.+)?px\)/,
                    getBlurMatch = target => (gsap.getProperty(target, blurProperty) || "").match(blurExp) || [];

            gsap.registerPlugin({
                name: "blur",
                get(target) {
                    return +(getBlurMatch(target)[1]) || 0;
                },
                init(target, endValue) {
                    let data = this,
                filter = gsap.getProperty(target, blurProperty),
                endBlur = "blur(" + endValue + "px)",
                match = getBlurMatch(target)[0],
                index;
            if (filter === "none") {
                filter = "";
            }
            if (match) {
                index = filter.indexOf(match);
                endValue = filter.substr(0, index) + endBlur + filter.substr(index + match.length);
            } else {
                endValue = filter + endBlur;
                filter += filter ? " blur(0px)" : "blur(0px)";
            }
            data.target = target; 
            data.interp = gsap.utils.interpolate(filter, endValue); 
                },
                render(progress, data) {
                    data.target.style[blurProperty] = data.interp(progress);
                }
            });
        })();

        //landing section 最底下的圖片隨滾輪放大到全屏，先判斷位置(必須在房子形狀後)
        let ig = $('.img_grow');
        let lg = $('.logo_shape_img_box');
        ig[0].style.position = 'absolute';
        ig[0].style.left = `${lg.offset().left}px`;
        ig[0].style.top = `${lg.offset().top}px`;
        // ig[0].style.height = `320px`;
        // ig[0].style.width = `320px`;

        let lg_w = $('.logo_shape_img_box').width();
        let lg_h = $('.logo_shape_img_box').height();

        console.log(lg_w);
        console.log(lg_h);

        let ig_w = $('.img_grow').width(lg_w);
        let ig_h = $('.img_grow').height(lg_h);

        console.log(ig_w);

        $(window).on('resize', function() {
            let ig_l = `${lg.offset().left}px`;
            ig[0].style.left = ig_l;

            let ig_t = `${lg.offset().top}px`;
            ig[0].style.top = ig_t;

            let ig_wh = lg_w / 2;
            let ig_h = lg_h / 2;

            // console.log(houseWidth);
            // console.log(houseHeight);

            // console.log("bgimg:", img_grow_width, img_grow_height);
            // console.log();

            // console.log(img_growLeft, img_growTop)
        });

        // ig[0].style.width =  houseWidth;
        // ig[0].style.height = houseHeight;
        
        // ig[0].style.backgroundImage = 'url(../img/about.jpg)';
        // ig[0].style.backgroundSize = 'cover';

        
        // 登陸section 圖片隨滾輪放大
        
        // 時間軸
        const landing_tl = gsap.timeline({
            scrollTrigger: {
                trigger: ".home_landing", 
                start: "center center", 
                // end: "+=400",
                pin: true,
                scrub: true, 
                markers: true,
            }
        });

        // 壓在房子底下的圖片放大到全屏，並用zindex蓋住landing所有部分
        landing_tl.to(".img_grow", {
            width:"100vw", 
            height:"100vh", 
            left: "0",
            top: "0",
            zIndex: 50,
            duration: 2,
        })


        // landing換圖進度條，但目前不準，因為vue設定的關係，圖片載入有時間差
        gsap.to(".img_progress_bar", 6, {width: "100%", repeat: -1, repeatDelay: 1.2}); 

        //服務section h2和圖片隨滾輪出現
        gsap.to(".home_plans .plans_links", {
            duration: .2,
            scrollTrigger: {
                trigger: ".home_plans",
                start: "top center", 
                pin: false, 
                scrub: false,
                // markers: true,
                toggleClass: {targets: [".home_plans h2", ".plans_links li"], className: "enter"},
                once: "true",
            }
        });

        //案例section h2和p隨滾輪出現
        gsap.to(".home_case .content", {
            duration: .2,
            scrollTrigger: {
                trigger: ".home_case",
                start: "top center", 
                pin: false, 
                scrub: false,
                // markers: true,
                toggleClass: {targets: [".home_case h2", ".content_txt p", ".needs_btns"],className: "enter"},
                once: "true",
            }
        });

        //流程section h2和p隨滾輪出現 虛線出現 敘述呈現打字效果
        gsap.to(".home_progress", {
            duration: .2,
            scrollTrigger: {
                trigger: ".home_progress",
                start: "top center", 
                pin: false, 
                scrub: false,
                markers: true,
                toggleClass: {targets: [".home_progress h2", ".home_progress li"],className: "enter"},
                once: "true",
            }
        });

        
        // var txt_count = 0;
        // var txt = "依照您的需求，";
        // var speed = 1000;

        // function typeWriter() {
        //     console.log("here");

        //     if (txt_count < txt.length) {
        //         console.log("here2");
        //         $("#choose_p1").text(txt.charAt(txt_count));
        //         txt_count++;
        //         setTimeout(typeWriter, speed);
        //     }
        // }

        //活動消息section h2和deco img 出現
        gsap.to(".home_acti", {
            duration: .2,
            scrollTrigger: {
                trigger: ".home_acti",
                start: "top center", 
                pin: false, 
                scrub: false,
                markers: true,
                toggleClass: {targets: [".home_acti h2", ".home_acti .deco_img_box"],className: "enter"},
                once: "true",
            }
        });

        //專欄文章section h2出現
        gsap.to(".home_columns", {
            duration: .2,
            scrollTrigger: {
                trigger: ".home_columns",
                start: "top center", 
                pin: false, 
                scrub: false,
                markers: true,
                toggleClass: {targets: [".home_columns h2"],className: "enter"},
                once: "true",
            }
        });

        //Q&A section h2 出現
        gsap.to(".home_qa", {
            duration: .2,
            scrollTrigger: {
                trigger: ".home_qa",
                start: "top center", 
                pin: false, 
                scrub: false,
                markers: true,
                toggleClass: {targets: [".home_qa h2"],className: "enter"},
                once: "true",
            }
        });

        //熱門商品section h2和deco img 出現
        gsap.to(".home_hot_sales", {
            duration: .2,
            scrollTrigger: {
                trigger: ".home_hot_sales",
                start: "top center", 
                pin: false, 
                scrub: false,
                markers: true,
                toggleClass: {targets: [".home_hot_sales h2"],className: "enter"},
                once: "true",
            }
        });

        let hs_items = gsap.utils.toArray(".home_hot_sales");

        // gsap.to(hs_items, {
        // xPercent: -100 * (hs_items.length - 1),
        // ease: "none",
        // scrollTrigger: {
        //     trigger: ".home_hot_sales ul",
        //     pin: true,
        //     scrub: 1,
        //     snap: 1 / (hs_items.length - 1),
        //     marker: true,
        //     // base vertical scrolling on how wide the container is so it feels more natural.
        //     end: "+=3500",
        // }
        // });



        //  希望抓的到

        // const plans_tl =  gsap.timeline({
        //     duration: .3,
        //     scrollTrigger: {
        //         trigger: ".home_plans",
        //         start: "top center", 
        //         pin: false, 
        //         scrub: false,
        //         markers: true,
        //         toggleClass: {targets: ".plans_links li", className: "active"},
        //     }
        // });

    })


     

    // //登陸section slogan 文字由模糊轉清晰
    // const slogan_tl = gsap.timeline({
    //     scrollTrigger: {
    //         trigger: ".index_slogan", 
    //         start: "center center", 
    //         pin: true,
    //         scrub: true, 
    //         markers: true,
    //     }
    //  });
    //  slogan_tl.from(".slogan", {opacity: 0,scale: 1.2, blur: 5})
    //  slogan_tl.to(".slogan", {opacity: 1, scale: 1, blur: 0})

    // //服務section 圖片隨滾輪出現
    // gsap.to(".index_plans .plans_img_box", {
    //     duration: 3,
    //     scrollTrigger: {
    //         trigger: ".index_plans",
    //         start: "top center", 
    //         pin: false, 
    //         scrub: false,
    //         toggleClass: {targets: ".plans_img_box", className: "active"},
    //     }
    // });

    // // 活動消息section 圖片隨滾輪出現
    // gsap.to(".index_news .news_img_box", {
    //     duration: 3,
    //     scrollTrigger: {
    //         trigger: ".index_news",
    //         start: "top center", 
    //         pin: false, 
    //         scrub: false,
    //         toggleClass: {targets: ".news_img_box", className: "active"}, 
    //     }
    // });

    
    // //煩惱section bubble
    // const bubbles_tl = gsap.timeline({
    //     scrollTrigger: {
    //         trigger: ".index_needs", 
    //         start: "top center", 
    //         pin: false,
    //         scrub: true, 
    //         markers: true,
    //     }
    //  });
     
    //  bubbles_tl.from("#bubble_1", {x: -10000})
    //  bubbles_tl.from("#bubble_2", {x: 10000})
    //  bubbles_tl.from("#bubble_3", {x: -10000})
    //  bubbles_tl.from("#bubble_4", {x: 10000})

    //  bubbles_tl.to("#bubble_1", {x: 100, duration: .5,})
     
    //  bubbles_tl.to("#bubble_2", {x: -100, duration: .5,})
     
    //  bubbles_tl.to("#bubble_3", {x: 100, duration: .5,})
     
    //  bubbles_tl.to("#bubble_4", {x: -100, duration: .5,})


    //  const needs_btns_tl = gsap.timeline({
    //     scrollTrigger: {
    //         trigger: "#bubble_4", 
    //         start: "top center",
    //         end: "center",
    //         pin: false,
    //         scrub: true, 
    //         markers: true,
    //     }
    //  });

    //  needs_btns_tl.to(".needs_btns", {scale: 1.5})