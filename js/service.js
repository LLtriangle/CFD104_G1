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
		width:500,
	},">").to('.case01 .pic .handle',{
		left:500,
	},"<").to('.case01 .txt .afterTxt',{
		height:500,
	},"<").fromTo('.case02',{
		y:1000
	},{
		y:100,
	}).to('.case02 .pic .afterPic',{
		width:500,
	},">").to('.case02 .pic .handle',{
		left:500,
	},"<").to('.case02 .txt .afterTxt',{
		height:500,
	},"<").fromTo('.case03',{
		y:1000
	},{
		y:100,
	}).to('.case03 .pic .afterPic',{
		width:500,
	},">").to('.case03 .pic .handle',{
		left:500,
	},"<").to('.case03 .txt .afterTxt',{
		height:500,
	},"<");


// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	delta = 0;

    $('.case .pic').on('mousemove', function(e) {
		$(this).children('.afterPic').removeClass('slowMove');
		$(this).children('.handle').removeClass('slowMove');
        $(this).children('.handle').css('left',`${Math.max(0,e.offsetX)}px`);
        $(this).children('.afterPic').css('width',`${e.offsetX}px`);
		$(this).children('.afterPic').addClass('slowMove');
		$(this).children('.handle').addClass('slowMove');
    });

});