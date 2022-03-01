let btnminus, btnplus, qtyboxes;

function changeqty(i, qty){
    let newqty = parseInt(qtyboxes[i].value) + qty;
    if(newqty < 0){
        newqty = 0;
    }
    qtyboxes[i].value = newqty;
}

window.addEventListener("load", function(){
    btnminus = document.getElementsByClassName("btnminus");
    btnplus = document.getElementsByClassName("btnplus");
    qtyboxes = document.getElementsByClassName("qtybox");

    for(let i=0; i<btnminus.length; i++){
        btnminus[i].onclick = function(){
            changeqty(i, -1);
        };
        btnplus[i].onclick = function(){
            changeqty(i, +1);
        };
    }
})