<html>
<head>
<style>
*{ margin:0px auto; padding:0px}
#bg{
	position:relative;

}



.a2{
	position:absolute;
	top:200px;
	font-size:70px;
	font-weight:bold;
	box-shadow: 10px 10px 5px #888888;
	left:1050px;
	border-radius: 25px;
    text-decoration:none;
}
.a3{
	position:absolute;
	top:400px;
	font-size:70px;
	font-weight:bold;
	box-shadow: 10px 10px 5px #888888;
	left:1050px;
	border-radius: 25px;
    text-decoration:none;
}
</style>
</head>
<?php

   if (isset($_COOKIE["username"])) {
   	  // echo "Welcome back！ "; 
  }    
   else{
   		echo "出错啦！";
   		header("refresh:3;url=login3.php");
   }
   ?>
<body>
<div id="bg"><img src="try.jpg" width="100%;" height=100%"></div>

<a href="show message.php" class="a2">留言板</a>
<a href="login.php" class="a3">退出登录</a>


</body>
</html>