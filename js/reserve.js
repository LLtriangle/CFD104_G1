

// 載入照片
function uploadFile(){

    let div_upload = document.getElementById("div_upload");
    let upFile = document.getElementById("upFile");
    let your_pics = document.getElementById("your_pics");
    let div_myimgs = document.getElementById("div_myimgs");
    
    upFile.onchange=function(e){ //選檔案:change事件
        let file = e.target.files[0]; //找物件
        let reader = new FileReader(); //reader讀物件
        reader.onload = function(){  //讀完發生onload事件 結果在result裡
    
            // 生成div
            let div = document.createElement('div');
            div_myimgs.appendChild(div);
            // 生成img
            let img = document.createElement('img');
            // 上傳的照片class=myimg
            img.className = "myimg";
            div.appendChild(img);
            
            // 生button
            let delete_btn = document.createElement('button');
            delete_btn.type = "button";
            delete_btn.className = "delete_btn";
            delete_btn.innerText = 'X';
            div.appendChild(delete_btn);
            delete_btn.onclick = delete_mypic;
            // 刪除照片
            function delete_mypic(e){
                let div_img = e.target.parentNode; 
                div_img.remove();
                if(myimgs.length == 2){
                    your_pics.appendChild(div_upload);
                }
            };

            img.src = reader.result;
    
            let myimgs = document.getElementsByClassName("myimg");

            
            // console.log(myimgs.length);
            if(myimgs.length == 3){
                div_upload.remove()
            }
    
        }
        reader.readAsDataURL(file);
    }

}


function init(){
    uploadFile();
}

window.addEventListener('load',init);