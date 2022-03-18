var next_btns = document.getElementsByClassName("next_btn");

// function removeFileFromFileList(index) {
//     const dt = new DataTransfer()
//     const input = document.getElementById('upFile')
//     const { files } = input
    
//     for (let i = 0; i < files.length; i++) {
//       const file = files[i]
//       if (index !== i)
//         dt.items.add(file) // here you exclude the file. thus removing it.
//     }

    
//     input.files = dt.files // Assign the updates list
//     console.log(input.files)
// }
// 載入照片
function uploadFile(){
    // let div_upload = document.getElementById("div_upload");
    let upFile1 = document.getElementById("upFile1");
    let upFile2 = document.getElementById("upFile2");
    let upFile3 = document.getElementById("upFile3");
    let your_pics = document.getElementById("your_pics");
    let div_myimgs = document.getElementById("div_myimgs");
    let file_label_rwd = document.getElementById("file_label_rwd"); 
    // 上傳的照片
    let myimgs = document.getElementsByClassName("myimg");
    $("#upFile1_l").show()
    $("#upFile2_l").hide()
    $("#upFile3_l").hide()
    
    function upFileChange(e){ //選檔案:change事件
        // ================ 3/17
        for(let i = 0; i < 1; i ++){
            let file = e.target.files[0]; //找物件
            let reader = new FileReader(); //reader讀物件
            reader.readAsDataURL(file); 
            
            
            reader.onload = function(){
                // 生成div
                let div = document.createElement('div');
                div_myimgs.appendChild(div);
                // 生成img
                let img = document.createElement('img');
                // 上傳的照片class=myimg
                img.className = "myimg";
                div.appendChild(img);
                
                if(myimgs.length == 1){
                    // $("#upFile1_l")
                    $("#upFile1_l").hide()
                    $("#upFile2_l").show()
                }else if(myimgs.length == 2){
                    $("#upFile2_l").hide()
                    $("#upFile3_l").show()
                }else if(myimgs.length == 3){
                    $("#upFile3_l").hide()
                }
                // else{
                //     $("#upFile1_l").show()
                //     $("#upFile2_l").hide()
                //     $("#upFile3_l").hide()
                // }
                // 生button
                let delete_btn = document.createElement('button');
                delete_btn.type = "button";
                delete_btn.className = "delete_btn";
                // delete_btn.dataset.index = i;
                delete_btn.innerText = '×';
                div.appendChild(delete_btn);
                delete_btn.onclick = delete_mypic;
                // 刪除照片
                function delete_mypic(e){
                    let div_img = e.target.parentNode; 
                    let parent = div_img.parentNode;
                    // let index = Array.prototype.indexOf.call(parent.children, div_img);
                    // removeFileFromFileList(index);
                    
                    // console.log(e.target);
                    div_img.remove();
                    // if(myimgs.length == 1){
                        //     alert($("#upFile1 + label"))
                        //     $("#upFile1 + label").hide()
                        //     $("#upFile2").show()
                        // }else if(myimgs.length == 2){
                            //     $("#upFile2").hide()
                    //     $("#upFile3").show()
                    // }else if(myimgs.length == 3){
                        //     $("#upFile3").hide()
                        // }else{
                            //     $("#upFile1").show()
                    //     $("#upFile2").hide()
                    //     $("#upFile3").hide()
                    // }
                    // if(myimgs.length == 2){
                        //     // your_pics.appendChild(div_upload);
                        //     $("#div_upload").css('visibility', 'visible');
                        // };
                        // if(myimgs.length == 2 && $(window).width()<830){
                            //     your_pics.insertBefore(file_label_rwd,div_myimgs);
                            // };
                    document.getElementById("d_pic_img").src = "";
                    document.getElementById("info_pic").src = "";

                    if(myimgs.length == 1){
                        $("#upFile1_l").hide()
                        $("#upFile2_l").show()
                        $("#upFile3_l").hide()
                    }else if(myimgs.length == 2){
                        $("#upFile2_l").hide()
                        $("#upFile3_l").show()
                    }else if(myimgs.length == 3){
                        $("#upFile3_l").hide()
                    }else if(myimgs.length == 0){
                        $("#upFile1_l").show()
                        $("#upFile2_l").hide()
                        $("#upFile3_l").hide()
                    }

                };

                img.src = reader.result;

                // if(myimgs.length == 3){
                //     // div_upload.remove();
                //     $("#div_upload").css('visibility', 'hidden');
                //     file_label_rwd.remove();
                //     // $("#file_label_rwd").css('visibility', 'hidden');
                // }
                // 顯示照片在第二頁明細
                // if(myimgs.length != 0){
                //     // console.log(document.getElementById("d_pic_img").src);
                //     document.getElementById("d_pic_img").src = myimgs[0].src;
                //     document.getElementById("info_pic").src = myimgs[0].src;
                // }
            }
        };


    }

    upFile1.onchange= upFileChange;
    upFile2.onchange= upFileChange;
    upFile3.onchange= upFileChange;
    //     let file = e.target.files[0]; //找物件
    //     let reader = new FileReader(); //reader讀物件
    //     reader.onload = function(){  //讀完發生onload事件 結果在result裡
    //         // 生成div
    //         let div = document.createElement('div');
    //         div_myimgs.appendChild(div);
    //         // 生成img
    //         let img = document.createElement('img');
    //         // 上傳的照片class=myimg
    //         img.className = "myimg";
    //         div.appendChild(img);
            
    //         // 生button
    //         let delete_btn = document.createElement('button');
    //         delete_btn.type = "button";
    //         delete_btn.className = "delete_btn";
    //         delete_btn.innerText = '×';
    //         div.appendChild(delete_btn);
    //         delete_btn.onclick = delete_mypic;
    //         // 刪除照片
    //         function delete_mypic(e){
    //             let div_img = e.target.parentNode; 
    //             // console.log(e.target);
    //             div_img.remove();

    //             if(myimgs.length == 2){
    //                 your_pics.appendChild(div_upload);
    //             };
    //             if(myimgs.length == 2 && $(window).width()<830){
    //                 your_pics.insertBefore(file_label_rwd,div_myimgs);
    //             };
    //             document.getElementById("d_pic_img").src = "";
    //             document.getElementById("info_pic").src = "";

    //         };

    //         img.src = reader.result;
            
    //         // 上傳的照片
    //         let myimgs = document.getElementsByClassName("myimg");

    //         if(myimgs.length == 3){
    //             div_upload.remove();
    //             // $("#div_upload").css('visibility', 'hidden');
    //             file_label_rwd.remove();
    //             // $("#file_label_rwd").css('visibility', 'hidden');
    //         }
    //         if(myimgs.length != 0){
    //             // 第二頁 顯示照片在明細
    //             // console.log(document.getElementById("d_pic_img").src);
    //             document.getElementById("d_pic_img").src = myimgs[0].src;
    //             document.getElementById("info_pic").src = myimgs[0].src;
    //         }
    //     }
    //     reader.readAsDataURL(file);
    // }

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
    // alert("付款成功");
};

function init(){
    uploadFile();

    document.getElementById("submit").addEventListener('click',submitForm);
    for(let i = 0; i<next_btns.length ; i++){
        next_btns[i].onclick=function(){
            $('html').animate({
                scrollTop: 0,
            }, 500);
        }
    }
};


window.addEventListener('load',init);




// ----------

