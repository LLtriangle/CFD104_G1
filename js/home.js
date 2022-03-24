$(window).on('load',function(){

    gsap.registerPlugin(ScrollTrigger);
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

    // landing section------------------------------

    // landing section 最底下的圖片隨滾輪放大到全屏，先判斷位置(必須在房子形狀後)
    let ig = $('.img_grow');
    let lg = $('.logo_shape_img_box');
    ig[0].style.position = 'absolute';
    ig[0].style.left = `${lg.offset().left}px`;
    ig[0].style.top = `${lg.offset().top}px`;
    // ig[0].style.height = `320px`;
    // ig[0].style.width = `320px`;

    let lg_w = $('.logo_shape_img_box').width();
    let lg_h = $('.logo_shape_img_box').height();

    // console.log(lg_w);
    // console.log(lg_h);

    let ig_w = $('.img_grow').width(lg_w);
    let ig_h = $('.img_grow').height(lg_h);

    // console.log(ig_w);

    $(window).on('resize', function() {
        let ig_l = `${lg.offset().left}px`;
        ig[0].style.left = ig_l;

        let ig_t = `${lg.offset().top}px`;
        ig[0].style.top = ig_t;
    });

    // ig[0].style.width =  houseWidth;
    // ig[0].style.height = houseHeight;
    
    // ig[0].style.backgroundImage = 'url(../img/about.jpg)';
    // ig[0].style.backgroundSize = 'cover';

    
    // landing section 圖片隨滾輪放大，時間軸
    const landing_tl = gsap.timeline({
        scrollTrigger: {
            trigger: ".home_landing", 
            start: "center center", 
            // end: "+=400",
            pin: true,
            scrub: true, 
            // markers: true,
            // toggleActions: "restart none none reverse"
        }
    });

    // 壓在房子底下的圖片放大到全屏，並用zindex蓋住landing所有部分
    ScrollTrigger.matchMedia({
        // 跟設定css 一樣  如果畫面小於 767px 執行
        "(max-width: 767px)": () => {
            landing_tl.to(".img_grow",{
                opacity: 0,
            },">").to(".img_grow", 
                {
                "clip-path": "polygon(100% 0%, 100% 100%, 0% 100%, 0% 0%)",
            },">").to(".img_grow", 
                {
                opacity: 1,
            },">").to(".img_grow",{
                width:"100vw", 
                height:"100vh", 
                left: "0",
                top: "0",
                zIndex: 50,
                duration: 5,
            },">").to(".blur_txt", {
                display: "block",
            }).fromTo(".blur_txt h2, .blur_txt p", {
                scale: 1.2, 
                blur: 5,
                duration: 5,
            },{
                opacity: 1,
                scale: 1, 
                blur: 0,
                duration: 5,
            });
        },
        // 畫面不小於 768px 執行
        "(min-width: 768px)": () => {
            landing_tl.to(".img_grow",{
                opacity: 0,
            },">").to(".img_grow", 
                {
                "clip-path": "polygon(100% 0%, 100% 100%, 0% 100%, 0% 0%)",
            },">").to(".img_grow", 
                {
                opacity: 1,
            },">").to(".img_grow",{
                width:"100vw", 
                height:"100vh", 
                left: "0",
                top: "0",
                zIndex: 50,
                duration: 5,
            },">").to(".blur_txt", {
                display: "flex",
            }).fromTo(".blur_txt h2, .blur_txt p", {
                scale: 1.2, 
                blur: 5,
                duration: 5,
            },{
                opacity: 1,
                scale: 1, 
                blur: 0,
                duration: 5,
            });
        },
        // 不管畫面大小，我都執行
        // "all": () => { 執行內容 },
    });
    
    // landing換圖進度條，但目前不準，因為vue設定的關係，圖片載入有時間差
    gsap.to(".img_progress_bar", 6, {width: "100%", repeat: -1, repeatDelay: 1.2}); 


    // plans section------------------------------

    //plans section h2和圖片隨滾輪出現
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

    // plans section------------------------------

    // case section h2和p隨滾輪出現
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

    // progress section------------------------------

    // progress section h2和p隨滾輪出現 虛線出現 敘述呈現打字效果
    gsap.to(".home_progress", {
        duration: .2,
        scrollTrigger: {
            trigger: ".home_progress",
            start: "top center", 
            pin: false, 
            scrub: false,
            // markers: true,
            toggleClass: {targets: [".home_progress h2", ".home_progress li"],className: "enter"},
            once: "true",
        }
    });

    // acti section------------------------------

    // acti section h2和deco img 出現
    gsap.to(".home_acti", {
        duration: .2,
        scrollTrigger: {
            trigger: ".home_acti",
            start: "top center", 
            pin: false, 
            scrub: false,
            // markers: true,
            toggleClass: {targets: [".home_acti h2", ".home_acti .deco_img_box"],className: "enter"},
            once: "true",
        }
    });

    // columns section------------------------------

    // columns section h2出現
    gsap.to(".home_columns", {
        duration: .2,
        scrollTrigger: {
            trigger: ".home_columns",
            start: "top center", 
            pin: false, 
            scrub: false,
            // markers: true,
            toggleClass: {targets: [".home_columns h2"],className: "enter"},
            once: "true",
        }
    });

    // qa section------------------------------

    // qa section h2 出現
    gsap.to(".home_qa", {
        duration: .2,
        scrollTrigger: {
            trigger: ".home_qa",
            start: "top center", 
            pin: false, 
            scrub: false,
            // markers: true,
            toggleClass: {targets: [".home_qa h2"],className: "enter"},
            once: "true",
        }
    });

    // hot_sales section------------------------------

    // hot_sales section h2和deco img 出現
    gsap.to(".home_hot_sales", {
        duration: .2,
        scrollTrigger: {
            trigger: ".home_hot_sales",
            start: "top center", 
            pin: false, 
            scrub: false,
            // markers: true,
            toggleClass: {targets: [".home_hot_sales h2"],className: "enter"},
            once: "true",
        }
    });


    // hot_sales section 商品橫向卷軸先抓要滑動顯示的內容物件，轉成陣列，以利後面用index數字處理寬度
    let hs_items = gsap.utils.toArray(".home_hot_sales .hs_item");

    // hot_sales section 商品橫向卷軸 避免不同media大小css互相引響
    ScrollTrigger.saveStyles(hs_items);
    
    ScrollTrigger.matchMedia({
        // 跟設定css 一樣  如果畫面小於 767px 執行
        "(max-width: 767px)": () => {
            gsap.to(hs_items, {
                //一次滑動涵蓋多少東西(寬度)，因為是絕對定位所以獨是整數orz
                xPercent: -100 * (hs_items.length - 0.45),
                ease: "slow",
                scrollTrigger: {
                    trigger: ".home_hot_sales .content .row",
                    pin: true,
                    scrub: 1,
                    //每次滑動的進度
                    snap: 1 / (hs_items.length - 0.45),
                    marker: true,
                    // base vertical scrolling on how wide the container is so it feels more natural.
                    start: "center center",
                    // end: "top bottom",
                    end:"+=1500px",
                }
            });
        },
        // 畫面不小於 768px 執行
        "(min-width: 768px)": () => {
            gsap.to(hs_items, {
                //一次滑動涵蓋多少東西(寬度)，因為是絕對定位所以獨是整數orz
                xPercent: -100 * (hs_items.length - 3),
                ease: "slow",
                scrollTrigger: {
                    trigger: ".home_hot_sales .content .row",
                    pin: true,
                    scrub: 1,
                    //每次滑動的進度
                    snap: 1 / (hs_items.length - 1),
                    marker: true,
                    // base vertical scrolling on how wide the container is so it feels more natural.
                    start: "center center",
                    // end: "top bottom",
                    end:"+=1500px",
                }
            });
        },
        // 不管畫面大小，我都執行
        // "all": () => { 執行內容 },
    });

});