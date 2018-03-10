<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>注册页面</title>
<link href="./css/register.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="bg"><img src="jerry2.jpg" width="770px;" height="435px;"></div>
<div class="title">注册页面</div>
<div class="biaodan_bg"></div>
<div class="biaodan">


   
  <center>

    <form action="register1.php" method="post" onSubmit="return checkForm()" name="myform">
    <div id="form">
    <label for="username"><b style="color:black">用户名:</b></label>
<input type="text" name="username" id="username" class="userName" onkeyup="showHint(this.value)"; style="width:200px;height:30px;border-radius:10px;" placeholder="请输入用户名" ><br/>
<!-- <span class="default" id="nameErr">输入3~10个字符,可用数字.字母.下划线</span> -->
<div id="name_null" class="name_null">*用户名不能为空</div>
<span id="nameHint"></span>
</div>






  <div id="form">
  <label for="password"><b style="color:black">密码：&nbsp;</b></label>
  <input type="password" name="password" id="password" class="username" onblur="checkPassword()" oninput="checkPassword()" style="width:200px;height:30px;border-radius:10px;" placeholder="请输入密码" ;><br/>
  <!-- <span class="default" id="passwordErr">输入4~16位密码</span> -->
  <div id="password_null" class="password_null">*密码不能为空</div>
  </div>

     <div><button type="submit" name="Submit" id="submit" class="submit" >同意用户协议并注册</button></div>
   
 </form></center></div></div>

 </body>
 <script language="javascript">
 window.onload = function(){
  var name = document.getElementById('username');
  var pw = document.getElementById('password');
  var name_null = document.getElementById('name_null');
  var password_null = document.getElementById('password_null');
  var submit = document.getElementById('submit');

  name.onblur = function(){
    if(name.value==""){
      name_null.style.visibility="visible";
      pw.disabled="disabled";
      submit.setAttribute('disabled',true);
    }
    else{
      name_null.style.visibility="hidden";
      var username = name.value;
      createXHR();
      XHR.open("GET","zhuce1.php",true);
      XHR.onreadystatechange = name_check; //每个状态改变会触发该事件，通常调用一个JS函数
      XHR.send(null);
    }
  }
  function name_check(){
    if(XHR.readyState == 4){
      if(XHR.status == 200){
        var textHTML = XHR.responseText;
        if(textHTML == 0){
          name_null.style.visibility = "visible";
          pw.disabled="disabled";
          submit.setAttribute('disabled',true);
        }
      }
    }
  }
  pw.onblur = function(){
    if(pw.value==""){
      password_null.style.visibility = "visible";
      submit.setAttribute('disabled',true);
    }
    else{
      password_null.style.visibility = "hidden";
      createXHR();
      var data = "name="+name.value + "&pw="+pw.value;
      XHR.open("POST","register1.php",true);
      XHR.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      XHR.onreadystatechange = pw_check;
      XHR.send(data);
    }
  }
  function pw_check(){
    if(XHR.readyState == 4){
      if(XHR.status == 200){
        var textHTML = XHR.responseText;
        if(textHTML == 0){
          password_error.style.visibility="visible";
          submit.setAttribute('disabled',true);
        }
      }
    }
  }
   name_null.onclick=function(){
    pw.removeAttribute("disabled");
    name_null.style.visibility="hidden";
    submit.removeAttribute("disabled",true);
  }
  password_null.onclick=function(){
    password_null.style.visibility="hidden";
    submit.removeAttribute("disabled",true);
  }


   name_null.onclick=function(){
    pw.removeAttribute("disabled");
    name_null.style.visibility="hidden";
    submit.removeAttribute("disabled",true);
  }
  password_null.onclick=function(){
    password_null.style.visibility="hidden";
    submit.removeAttribute("disabled",true);
  }
}
function showHint(str)
{
    if (str.length==0)
    { 
        document.getElementById("nameHint").innerHTML="";
        return;
    }
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {    
        //IE6, IE5 浏览器执行的代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("nameHint").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","zhuce1.php?q="+str,true);
    xmlhttp.send(null);
}
 </script>



 <!-- <script language="javascript">

//正则表达式
 function checkForm(){
 	var nametip = checkUsername();
 	var pwdtip = checkPassword();
 	return nametip && pwdtip;
 }
 //验证用户名
 function checkUsername(){
 	var username= document.getElementById('username');
 	var errname = document.getElementById('nameErr');
 	var pattern=/^[a-zA-Z0-9_\u4e00-\u9fa5]{3,10}$/;
 
 if(username.value.length == 0){
 	errname.innerHTML="用户名不能为空！";
 	errname.className="error";
 	return false;
 }
 if(!pattern.test(username.value)){
 	errname.innerHtml="用户名不规范！";
 	errname.className="error";
 	return false;
 }
 else{
 	errname.innerHTML="OK";
 	errname.className="success";
 	return true;
 }
}
//验证密码
function checkPassword(){
   var userpsw = document.getElementById('password');
   var errPsw = document.getElementById('passwordErr');
   var pattern = /^\w{4,16}$/;
   if(!pattern.test(password.value)){
   	errPsw.innerHTML="密码不规范!";
   	errPsw.className="error";
   	return false;
   }
   else{
   	errPsw.innerHTML="OK";
   	errPsw.className="success";
   	return true;
   }
}

 </script> -->

 </html>
 