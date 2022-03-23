window.addEventListener('load',function(){
  
// 前後對比 gsap scrollTrigger
	const serveCase = gsap.timeline({
		scrollTrigger:{
			trigger: '.serve_case',
			start: 'center center',
			end:'+=3000px',
			pin: true,
			scrub: true,
			// markers:true,
		}
	});
	
	serveCase
	.fromTo('.serve_case > div:nth-of-type(1)',{
		y:120,},{
		y:120,
		})
		// x:0,})
	.to('.serve_case > div:nth-of-type(1) .pic .afterPic',{
		width:700,},">")
	.to('.serve_case > div:nth-of-type(1) .pic .handle',{
		left:700,},"<")
	.to('.serve_case > div:nth-of-type(1) .txt .afterTxt',{
		height:300,},">")
	.fromTo('.serve_case > div:nth-of-type(1) .bookmark',{
		y:1000,},{
		y:-30,})
	.fromTo('.serve_case > div:nth-of-type(2)',{
		y:1000,},{
		y:150,})
	.to('.serve_case > div:nth-of-type(1)',{
		y:120,
		},"<")
		// x:20,},"<")
	.to('.serve_case > div:nth-of-type(2) .pic .afterPic',{
		width:700,},">")
	.to('.serve_case > div:nth-of-type(2) .pic .handle',{
		left:700,},"<")
	.to('.serve_case > div:nth-of-type(2) .txt .afterTxt',{
		height:300,},">")
	.fromTo('.serve_case > div:nth-of-type(2) .bookmark',{
		y:1000,},{
		y:-30,})
	.fromTo('.serve_case > div:nth-of-type(3)',{
		y:1000,},{
		y:150,
		})
		// x:-20,})
	.to('.serve_case > div:nth-of-type(1)',{
		y:90,},"<")
	.to('.serve_case > div:nth-of-type(2)',{
		y:120,},"<")
	.to('.serve_case > div:nth-of-type(3) .pic .afterPic',{
		width:700,},">")
	.to('.serve_case > div:nth-of-type(3) .pic .handle',{
		left:700,},"<")
	.to('.serve_case > div:nth-of-type(3) .txt .afterTxt',{
		height:300,},">")
	.fromTo('.serve_case > div:nth-of-type(3) .bookmark',{
		y:1000,},{
		y:-30,});

// 前後對比與滑鼠位置
    $('.case .pic').on('mousemove', function(e) {
		$(this).children('.afterPic').removeClass('slowMove');
		$(this).children('.handle').removeClass('slowMove');
        $(this).children('.handle').css('left',`${Math.max(0,e.offsetX)}px`);
        $(this).children('.afterPic').css('width',`${e.offsetX}px`);
		$(this).children('.afterPic').addClass('slowMove');
		$(this).children('.handle').addClass('slowMove');
    });
	
// // 點擊 bookmark(便利貼) 跳轉
// 	let case0 = $('.serve_case').offset().top;
// 	let case1 = $('.serve_case .case01').offset().top;
// 	let case2 = $('.serve_case .case:nth-child(2)').offset().top;
// 	let case3 = $('.serve_case .case:nth-child(3)').offset().top;
// 	// $(window).on(resize,function(){
// 	// 	case0 = $('.serve_case').offset().top;
// 	// 	case1 = $('.serve_case .case01').offset().top;
// 	// 	case2 = $('.serve_case .case:nth-child(2)').offset().top;
// 	// 	case3 = $('.serve_case .case:nth-child(3)').offset().top;
// 	// });
	
// 	$('.bookmark').on('click',function () {
// 		$('html, body').animate({
// 			scrollTop: case0,
// 		}, 500);
// 		return false;
// });
});