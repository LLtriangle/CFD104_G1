function $id(id){
	return document.getElementById(id);
}	

let member={};

    // function showLoginForm(){
    //   //檢查登入bar面版上 spanLogin 的字是登入或登出
    //   //如果是登入，就顯示登入用的燈箱(lightBox)
    //   //如果是登出
    //   //將登入bar面版上，登入者資料清空 
    //   //spanLogin的字改成登入
    //   //將頁面上的使用者資料清掉
    //   if($id('spanLogin').innerHTML == "登入"){ //如果要登入
    //     $id('lightBox').style.display = 'block';
    //   }else{//如果要登出

    //     let xhr = new XMLHttpRequest();
    //     xhr.onload = function(){
    //       $id('memName').innerHTML = '&nbsp';
    //       $id('spanLogin').innerHTML = '登入';          
    //     }
    //     xhr.open("get", "logout.php", true);
    //     xhr.send(null);
    //   }

    // }//showLoginForm

    function sendForm(){
    // 先做條件判斷 有會員帳號才跳轉 沒有顯示帳密錯誤
      //=====使用Ajax 回server端,取回登入者大頭貼, 放到header 
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){ 
            // let ans = xhr.responseText;
            member = JSON.parse(xhr.responseText);
            if(member.CUS_NO == undefined){
              alert("帳密錯誤");
            }else{
              // 成功
                  
              location.href="member.html";
              console.log("======",member);  
            }
        };
        xhr.open("post", "php/login.php", true);  
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        
        let datas = {};
        datas.memId = $id("memId").value; // 收到輸入框的會員帳號
        datas.memPsw = $id("memPsw").value; // 收到輸入框的會員密碼
        
        let data_info = "json=" + JSON.stringify(datas);
        xhr.send(data_info);
        
    };

    // 取得會員資料
    function getMemberInfo(){
      let xhr = new XMLHttpRequest();
      xhr.onload = function(){
        member = JSON.parse(xhr.responseText);
      }
      xhr.open("get", "php/getMemberInfo.php", true);
      xhr.send(null);
    };
// -------------註冊

    // 檢查會員帳號是否存在
    function checkId(){
      var xhr = new XMLHttpRequest();
      xhr.onload = function(){ 
        if(xhr.status == 200){ //正確的執行完畢
          // console.log(xhr.responseText);
          $id("idMsg").innerText = xhr.responseText;
        }else{
          alert(xhr.status);
          alert(xhr.statusText);
        }
      }
      if($id("cusId").value != ""){
        // 信箱驗證
        var emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
        if(emailRule.test($id("cusId").value)){
          let url = "php/cus_vali.php?cusId=" + $id("cusId").value;
          xhr.open("get", url, true);
          xhr.send(null);
        }else{
          $id("idMsg").innerText = "信箱格式錯誤";
        }
      }else{
        $id("idMsg").innerText = "";
      }
    }

    // 註冊會員
    function addMem(){
      let xhr = new XMLHttpRequest();
      xhr.onload = function(){
        console.log(xhr.response); // 註冊成功
        //跳轉

      }
      xhr.open("post", "php/register.php", true);  
      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
           
      let datas = {};
      datas.memId = $id("cusId").value; // 收到輸入框的會員帳號
      datas.memPsw = $id("cusPsw").value; // 收到輸入框的會員密碼
      datas.memName = $id("cusName").value; // 收到輸入框的會員姓名
      
      let data_info = "json=" + JSON.stringify(datas);
      xhr.send(data_info);
      console.log(data_info);
    }

    function init(){
      //=========================取得會員資訊
      $id('btnLogin').addEventListener("click",getMemberInfo);

      //===設定btnLogin.onclick 事件處理程序是 sendForm
      $id('btnLogin').addEventListener("click",sendForm);  

      // 檢查會員帳號是否存在
      $id('cusId').addEventListener("keyup", checkId, false);
      
      //===設定btnRegister.onclick 事件處理程序是 addMem
      $id('btnRegister').addEventListener("click",addMem);  
    }; //window.onload

    window.addEventListener("load",init);
