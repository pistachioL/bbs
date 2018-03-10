
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>登录页面</title>
  <link href="./css/login.css" rel="stylesheet" type="text/css">

<script>
 window.onload = function(){
  var name = document.getElementById('username');
  var pw = document.getElementById('password');
  var name_null = document.getElementById('name_null');
  var password_null = document.getElementById('password_null');
  var password_error = document.getElementById('password_error');
  var code = document.getElementById('code');
  var code_null = document.getElementById('code_null');
  var submit = document.getElementById('submit');


 //用户名是否存在
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
      XHR.open("GET","login1.php",true);
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
  pw.onblur = function(str){
    if(pw.value==""){
      password_null.style.visibility = "visible";
      submit.setAttribute('disabled',true);
    }
    else{
      password_null.style.visibility = "hidden";
      createXHR();
      var data = "name="+name.value + "&pw="+pw.value;
      XHR.open("POST","login1.php?p="+str,true);
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
  code.onkeyup = function(){
    if(code.value==""){
      code_null.style.visibility="visible";
      submit.setAttribute('disabled',true);
    }
    else{
      code_null.style.visibility = "hidden";
      createXHR();
      XHR.open("GET","login1.php",true);
      XHR.onreadystatechange = code_check;
      XHR.send(null);
    }
  }
  function code_check(){
    if(XHR.readyState == 4 ){
      if(XHR.status == 200){
        var textHTML = XHR.responseText;
        if(textHTML == 0){
          code_null.style.visibility = "visible";
          submit.setAttribute('disabled',true);
        }
      }
    }
  }
  name_null.onclick=function(){
    pw.removeAttribute("disabled");
    name_null.style.visibility="hidden";
    submit.removeAttribute("disabled");
  }
  password_null.onclick=function(){
    password_null.style.visibility="hidden";
    submit.removeAttribute("disabled");
  }
  code_null.onclick=function(){
    code_null.style.visibility="hidden";
    submit.removeAttribute("disabled");
  }
   
}
//用户名
 function showHint(str)
{
    if (str.length==0)
    { 
        document.getElementById("txtHint").innerHTML="";
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
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","login1.php?q="+str,true);
    xmlhttp.send(null);
}

//密码
// function psw_hint(p){
//   if(p.length==0){
//     document.getElementById("pswHint").innerHTML="";
//     return;  
//   }
//   if(window.XMLHttpRequest){
//     xmlhttp=new XMLHttpRequest();
//   }
//   else{
//     xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
//   }
//   xmlhttp.onreadystatechange=function(){
//     if(xmlhttp.readyState==4 && xmlhttp.status==200){
//       document.getElementById("pswHint").innerHTML=xmlhttp.responseText;
//     }
//   }
//   var data=
//   xmlhttp.open("POST","login1.php?v="+p,true);
//   xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//   xmlhttp.send($data);

// }
</script>

</head>


<body>
    <div class="bg"><img src="jerry.jpg" width="1350px;" height="650px;"></div>
    <div class="word">登录页面</div>
    <div class="biaodan1">
      <form action="login1.php" method="post" autocomplete="off" >
       
  <b style="font-size:30px"> 用户名: </b> <input type="text" name="username" id="username"  onkeyup="showHint(this.value)"; autocomplete="off" style="width:200px;height:30px; placeholder="请输入用户名" ><br/> <div id="name_null" class="name_null">*用户名不能为空</div>
  <p><span id="txtHint"></span></p>
    
 

  <b style="font-size:30px">密码:&nbsp;&nbsp;&nbsp;&nbsp;</b> <input type="password" name="password" id="password" AUTOCOMPLETE="off" style="width:200px;height:30px" placeholder="请输入密码" ;><br/>
 <div id="password_null" class="password_null">*密码不能为空</div>
<!--  <span id="pswHint"></span> -->

<b style="font-size:30px">验证码:&nbsp;</b>
  <input type="text" name="code"  id="code" placeholder="输入验证码" style="width:110px;height:25px" >
   <div class="yz"><img src="captcha.php" alt="验证码，看不清，换一张" onclick="this.src=this.src+'?'+new Date().getTime();" ></div>
   <div id="code_null" class="code_null">*验证码不能为空</div>
  
<!-- 
  <input type="checkbox" name="remenber">一周内自动登录 -->



   <div class="submit">
       <button type="submit" id="submit" class="submit" style="font-size:17px;color:white;">登录</button></div>


   
 <div class="reg"><a href="register.php" style="text-decoration: none;font-size:17px;color:white;">点击注册</a></div>
  
  
  
</form>

   




   
  </body>

  </html>
 

