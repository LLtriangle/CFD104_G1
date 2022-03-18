function showLarge(e){
    // let small = e.target;
    // document.getElementById("large").src = small.src;
    // console.log($(this).parent().children('.card_img').children().attr('src'));
    $("#large").attr('src',$(this).parent().children('.card_img').children().attr('src'));
}

function init(){
    let smalls = document.querySelectorAll(".small .introduce_card .black_hov");//要有小數點
    for(let i=0;i<smalls.length;i++){
        smalls[i].onclick = showLarge;
    }
}
window.addEventListener("load", init, false);