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

         //登陸section 圖片隨滾輪放大
         const landing_tl = gsap.timeline({
            scrollTrigger: {
                width: 100,
                trigger: ".index_landing", 
                start: "center center", 
                pin: true,
                scrub: true, 
                markers: false,
            }
         });

         landing_tl.to(".web_title", {scale: 1.2, duration: 2,})

        //登陸section slogan 文字由模糊轉清晰
        const slogan_tl = gsap.timeline({
            scrollTrigger: {
                trigger: ".index_slogan", 
                start: "center center", 
                pin: true,
                scrub: true, 
                markers: false,
            }
         });
         slogan_tl.from(".slogan", {opacity: 0,scale: 1.2, blur: 2})
         slogan_tl.to(".slogan", {opacity: 1, scale: 1, blur: 0})

        //服務section 圖片隨滾輪出現
        gsap.to(".index_plans .plans_img", {
            duration: 3,
            scrollTrigger: {
                trigger: ".index_plans",
                start: "top center", 
                pin: false, 
                scrub: false,
                toggleClass: {targets: ".plans_img", className: "active"},
            }
        });

        // 活動消息section 圖片隨滾輪出現
        gsap.to(".index_news .news_img", {
            duration: 3,
            scrollTrigger: {
                trigger: ".index_news",
                start: "top center", 
                pin: false, 
                scrub: false,
                toggleClass: {targets: ".news_img", className: "active"}, 
            }
        });

        
        //煩惱section bubble
        const bubbles_tl = gsap.timeline({
            scrollTrigger: {
                trigger: ".index_needs", 
                start: "top center", 
                pin: false,
                scrub: true, 
                markers: false,
            }
         });
         
         bubbles_tl.from("#bubble_1", {x: -10000})
         bubbles_tl.from("#bubble_2", {x: 10000})
         bubbles_tl.from("#bubble_3", {x: -10000})
         bubbles_tl.from("#bubble_4", {x: 10000})

         bubbles_tl.to("#bubble_1", {x: 100, duration: .5,})
         
         bubbles_tl.to("#bubble_2", {x: -100, duration: .5,})
         
         bubbles_tl.to("#bubble_3", {x: 100, duration: .5,})
         
         bubbles_tl.to("#bubble_4", {x: -100, duration: .5,})


         const needs_btns_tl = gsap.timeline({
            scrollTrigger: {
                trigger: "#bubble_4", 
                start: "top center",
                end: "center",
                pin: false,
                scrub: true, 
                markers: false,
            }
         });

         needs_btns_tl.to(".needs_btns", {scale: 1.5})
})