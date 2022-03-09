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
      //=====使用Ajax 回server端,取回登入者大頭貼, 放到header 
      let xhr = new XMLHttpRequest();
      xhr.onload = function(){
        member = JSON.parse(xhr.responseText);
        console.log(member);
        // document.getElementById("memName").innerText = member.memName;
        // $id('spanLogin').innerHTML = '登出';     
      }
      xhr.open("post", "php/login.php", true);  
      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
      
      let datas = {};
      datas.memId = $id("memId").value; // 收到輸入框的會員帳號
      datas.memPsw = $id("memPsw").value; // 收到輸入框的會員密碼
      
      let data_info = "json=" + JSON.stringify(datas);
      xhr.send(data_info);
    //   console.log(data_info);
      
    };
    // 登出
    function logout(){
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
            console.log(123);         
        }
        xhr.open("get", "php/logout.php", true);
        xhr.send(null);
    };

    // 取得會員資料
    function getMemberInfo(){
      let xhr = new XMLHttpRequest();
      xhr.onload = function(){
          console.log(xhr.responseText);
        member = JSON.parse(xhr.responseText);
        console.log(member);
        // if(member.memId){
        //   document.getElementById("memName").innerText = member.memName;
        //   document.getElementById("spanLogin").innerText = "登出";          
        // }

      }
      xhr.open("get", "php/getMemberInfo.php", true);
      xhr.send(null);
    }

    function init(){
      //=========================取得會員資訊
      $id('btnLogin').addEventListener("click",getMemberInfo);

      //===設定btnLogin.onclick 事件處理程序是 sendForm
      $id('btnLogin').addEventListener("click",sendForm);

      //===設定btnLoginCancel.onclick 事件處理程序是 cancelLogin
      $id('btnLogout').onclick = logout;

    }; //window.onload

    window.addEventListener("load",init);
