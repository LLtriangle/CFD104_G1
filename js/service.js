$(window).on('load',function(){
  
	const case01 = gsap.timeline({
		scrollTrigger:{
			trigger: '.case01',
			start: 'center center',
			pin: true,
			// markers:true,
			scrub: true,
		}
	});
	const case02 = gsap.timeline({
		scrollTrigger:{
			trigger: '.case02',
			start: 'center center',
			pin: true,
			// markers:true,
			scrub: true,
		}
	});
	const case03 = gsap.timeline({
		scrollTrigger:{
			trigger: '.case03',
			start: 'center center',
			pin: true,
			// markers:true,
			scrub: true,
		}
	});
	
	case01.from('.case01 .pic img:last-child',{y:600});
	case02.from('.case02 .pic img:last-child',{y:600});
	case03.from('.case03 .pic img:last-child',{y:600});
});