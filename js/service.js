$(window).on('load',function(){
  
	const serveCase = gsap.timeline({
		scrollTrigger:{
			trigger: '.serve_case',
			start: 'center center',
			pin: true,
			scrub: true,
			// markers:true,
		}
	});
	
	serveCase.fromTo('.case01',{
		y:100,
	},{
		y:100,
		ease: "elastic.out(1, 0.3)",
	}).to('.case01 .pic .afterPic',{
		// x:-700,
		width:500,
	}).fromTo('.case02',{
		y:1000
	},{
		y:100,
	}).to('.case02 .pic .afterPic',{
		// x:1700,
		width:500,
	}).fromTo('.case03',{
		y:1000
	},{
		y:100,
	}).to('.case03 .pic .afterPic',{
		// x:-700,
		width:500,
	});

});