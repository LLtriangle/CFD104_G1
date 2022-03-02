

// 載入照片
function uploadFile(){

    let div_upload = document.getElementById("div_upload");
    let upFile = document.getElementById("upFile");
    let your_pics = document.getElementById("your_pics");
    let div_myimgs = document.getElementById("div_myimgs");
    let file_label_rwd = document.getElementById("file_label_rwd"); 
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
            delete_btn.innerText = '×';
            div.appendChild(delete_btn);
            delete_btn.onclick = delete_mypic;
            // 刪除照片
            function delete_mypic(e){
                let div_img = e.target.parentNode; 
                // console.log(e.target);
                div_img.remove();

                if(myimgs.length == 2){
                    your_pics.appendChild(div_upload);
                };
                if(myimgs.length == 2 && $(window).width()<830){
                    your_pics.insertBefore(file_label_rwd,div_myimgs);
                };
                document.getElementById("d_pic_img").src = "";

            };

            img.src = reader.result;
            
            // 上傳的照片
            let myimgs = document.getElementsByClassName("myimg");

            if(myimgs.length == 3){
                div_upload.remove()
                file_label_rwd.remove()
            }
            if(myimgs.length != 0){

                // 第二頁 顯示照片第一張在明細
                // console.log(document.getElementById("d_pic_img").src);
                document.getElementById("d_pic_img").src = myimgs[0].src;
            }
        }
        reader.readAsDataURL(file);
    }

};

// function showMyImg(){
//         let myimgs = document.getElementsByClassName("myimg"); //陣列
//         console.log(myimgs.length);
//         if(myimgs.length != 0){
//         };
        // 上傳的照片
        // 第二頁 顯示照片第一張在明細
        // console.log(myimgs[0].src);
        // let dp_img = document.createElement('img');
        // dp_img.src = myimgs[0].src;
        // document.getElementsByClassName("d_pic")[0].appendChild(dp_img);
// }
function submitForm(){
    // console.log(document.getElementById("submit"))
    alert("付款成功");
};

function init(){
    uploadFile();
    document.getElementById("submit").addEventListener('click',submitForm);
};


window.addEventListener('load',init);




// ----------

