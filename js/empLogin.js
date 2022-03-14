function $id(id){
	return document.getElementById(id);
}	

let member={};
// =========登入
    function sendForm(){
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){ 
            // let ans = xhr.responseText;
            member = JSON.parse(xhr.responseText);
            if(member.CUS_NO == undefined){
              alert("帳密錯誤");
            }else{
              // 成功             
              location.href="emp.html";
            }
        };
        xhr.open("post", "phps/empLogin.php", true);  
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        
        let datas = {};
        datas.memId = $id("memId").value; // 收到輸入框的會員帳號
        datas.memPsw = $id("memPsw").value; // 收到輸入框的會員密碼
        
        let data_info = "json=" + JSON.stringify(datas);
        xhr.send(data_info);
        
    };

    function init(){

      //===設定btnLogin.onclick 事件處理程序是 sendForm
      $id('btnLogin').addEventListener("click",sendForm);  
 
    };

    window.addEventListener("load",init);
