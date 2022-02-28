var topices_left = document.getElementsByClassName("scroll-left_in");
var topices_right = document.getElementsByClassName("scroll-right_in");

window.addEventListener("scroll",function(){
  for (let i=0; i<topices_right.length; i++){
    if( topices_right[i].offsetTop > window.scrollY){
      topices_right[i].style.opacity = '0';
      topices_right[i].style.right = '-100vw';
    }else{
      topices_right[i].style.opacity = '1';
      topices_right[i].style.right = '0';
    }
    if( topices_left[i].offsetTop > window.scrollY){
      topices_left[i].style.opacity = '0';
      topices_left[i].style.left = '-100vw';
    }else{
      topices_left[i].style.opacity = '1';
      topices_left[i].style.left = '0';
    };
  };
  
  if(document.documentElement.scrollTop > document.getElementsByClassName("warning")[0].offsetTop){
    document.getElementById("more_topic").classList.add('stop_moving');
    document.querySelector('#more_topic').style.bottom = document.getElementsByClassName("warning")[0].offsetHeight - 5 + 'px';
  }else if(document.documentElement.scrollTop > 1000){
    document.getElementById("more_topic").classList.remove('stop_moving');
    document.querySelector('#more_topic').style.bottom = "0px";
    document.getElementById("more_topic").style.display = "block";
  }else{
    document.getElementById("more_topic").style.display = "none";
  };
},false);