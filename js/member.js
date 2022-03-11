function $id(id){
	return document.getElementById(id);
}	

let member={};

// 取得會員資料
function getMemberInfo(){
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
    member = JSON.parse(xhr.responseText);
    }
    xhr.open("get", "phps/getMemberInfo.php", true);
    xhr.send(null);
};

// 顯示btn 且 可以修改欄位
function showBtn(){
    $("#btnCancel").show();
    $("#btnSave").show();
    $("#btnUpload").show();
    $("#btnChange").hide();
    $('#cus_name').attr("disabled",false);
    // $('#email').attr("disabled",false);
    $('#cus_tel').attr("disabled",false);
    $('#cus_add').attr("disabled",false);
    $('.radio-input').attr("disabled",false);
}
// 隱藏btn 且 不可修改欄位
function hideBtn(){
    $("#btnCancel").hide();
    $("#btnSave").hide();
    $("#btnUpload").hide();
    $("#btnChange").show();
    $('#cus_name').attr("disabled",true);
    $('#cus_tel').attr("disabled",true);
    $('#cus_add').attr("disabled",true);
    $('.radio-input').attr("disabled",true);
}

// 取消修改資料
function cancelMemberInfo(){
    history.go(0);
};
// 更改會員資料
function changeMemberInfo(){
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
      alert("修改成功!"); 
    }
    xhr.open("post", "phps/changeMemberInfo.php", true);  
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
         
    // 抓格子裡的資料
    let datas = {};

    datas.memId = $("#email").val(); // 會員帳號
    datas.memName = $("#cus_name").val(); // 修改後姓名
    datas.memSex = $('input:radio:checked[name="gender"]').val(); // 修改後性別
    datas.memTel = $("#cus_tel").val(); // 修改後電話
    datas.memAdd = $("#cus_add").val(); // 修改後地址
    
    let data_info = "json=" + JSON.stringify(datas);
    xhr.send(data_info);
    console.log(data_info);
};

// 登出
function logout(){        
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
        // 跳轉畫面
        window.location.assign("home.html");       
    }
    xhr.open("get", "phps/logout.php", true); // 清空session
    xhr.send(null);
};


function init(){
    getMemberInfo();
    $id('btnLogout').addEventListener("click",logout);
    // $id('btnLogout').onclick = logout;
    // $id('btnCancel').onclick = cancelMemberInfo;
    // $id('btnSave').onclick = changeMemberInfo;
    // $id('btnChange').onclick = showBtn;
    // $id('btnSave').onclick = hideBtn;
    $id('btnCancel').addEventListener("click",cancelMemberInfo);
    $id('btnCancel').addEventListener("click",hideBtn);
    $id('btnSave').addEventListener("click",changeMemberInfo);
    $id('btnSave').addEventListener("click",hideBtn);
    $id('btnChange').addEventListener("click",showBtn);
}; 

window.addEventListener("load",init);
