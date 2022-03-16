$(window).on('load',function(){
  
// 前後對比 gsap scrollTrigger
	const serveCase = gsap.timeline({
		scrollTrigger:{
			trigger: '.serve_case',
			start: 'center center',
			end:'+=5000px',
			pin: true,
			scrub: true,
			// markers:true,
		}
	});
	
	serveCase
	.fromTo('.case01',{
		y:150,
		x:20,},{
		y:150,
		x:20,})
	.to('.case01 .pic .afterPic',{
		width:700,},">")
	.to('.case01 .pic .handle',{
		left:700,},"<")
	.to('.case01 .txt .afterTxt',{
		height:300,},">")
	.fromTo('.case01 .bookmark',{
		y:1000,},{
		y:-30,})
	.fromTo('.case02',{
		y:1000,},{
		y:150,})
	.to('.case01',{
		y:120,},"<")
	.to('.case02 .pic .afterPic',{
		width:700,},">")
	.to('.case02 .pic .handle',{
		left:700,},"<")
	.to('.case02 .txt .afterTxt',{
		height:300,},">")
	.fromTo('.case02 .bookmark',{
		y:1000,},{
		y:-30,})
	.fromTo('.case03',{
		y:1000,},{
		y:150,
		x:-20,})
	.to('.case01',{
		y:90,},"<")
	.to('.case02',{
		y:120,},"<")
	.to('.case03 .pic .afterPic',{
		width:700,},">")
	.to('.case03 .pic .handle',{
		left:700,},"<")
	.to('.case03 .txt .afterTxt',{
		height:300,},">")
	.fromTo('.case03 .bookmark',{
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
// 	let case2 = $('.serve_case .case02').offset().top;
// 	let case3 = $('.serve_case .case03').offset().top;
// 	// $(window).on(resize,function(){
// 	// 	case0 = $('.serve_case').offset().top;
// 	// 	case1 = $('.serve_case .case01').offset().top;
// 	// 	case2 = $('.serve_case .case02').offset().top;
// 	// 	case3 = $('.serve_case .case03').offset().top;
// 	// });
	
// 	$('.bookmark').on('click',function () {
// 		$('html, body').animate({
// 			scrollTop: case0,
// 		}, 500);
// 		return false;
// });
});