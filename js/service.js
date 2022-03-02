// 未完成 : 方案拖拉、案例分享動畫
var box=$(".item_group");
var body=$('body');
var index=0;
var x1;
box.mousedown(function(){
	index=1;       //滑鼠按下才能觸發onmousemove方法
	var x=event.clientX;   //滑鼠點選的座標值，x
	var left= this.style.left;
	left=left.substr(0,left.length-2);  //去掉px
	x1=parseInt(x-left);
});
box.mousemove(function(){
	if(index===1){
		this.style.left=event.clientX-x1+'px';
		if(this.style.left.substr(0,this.style.left.length-2)<0){
			this.style.left=0;
		};
		if(this.style.left.substr(0,this.style.left.length-2)>150){
			this.style.left='150px';
		};
	}
});
box.mouseup(function(){
	index=0;
});
body.mouseup(function(){
	index=0;
});
