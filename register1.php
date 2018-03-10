<?php

 error_reporting (E_ALL & ~E_NOTICE);
    $mysqli=new mysqli("localhost","root","root","bbs");
     if($mysqli->connect_errno){
 	        echo ('连接失败'.$mysqli->connect_error);
       }

   $mysqli->set_charset('utf8');
   // $act=$_REQUEST['act'];
   $username=$_POST['username'];
   $password=md5($_POST['password']);
   $q=$_GET["q"];

$sql="SELECT * FROM register WHERE username='$_GET[q]' ";
    $result=mysqli_query($mysqli,$sql);
  if(is_array(mysqli_fetch_assoc($result))){
    echo "<font color=red>*该用户名已被注册</font>";

  }
  else{
    echo "<font color=green>OK</font>";
     $mysqli_stmt=$mysqli->prepare("INSERT INTO register(username,password) VALUES(?,?)");
    $mysqli_stmt->bind_param("si",$name,$psw);
    $name=$username;
    $psw=$password;
    $mysqli_stmt->execute();
    if($mysqli_stmt==true){
   // echo "注册成功,1秒后跳转到登录页面";
   header("refresh:1;url=login.php");
     
   }
     else{
      echo "注册失败";
     }
  }





 //查询数据库的名字是否存在
//   $query="SELECT * FROM register WHERE username=?";
  
//   $mysqli_stmt=$mysqli->prepare($query);
//   $mysqli_stmt->bind_param("s",$name);
//   //赋值
//   $name=$username;
//   $mysqli_stmt->execute();
//   $mysqli_stmt->store_result();     
//   $mysqli_stmt->bind_result($conn,$name);


//   if($mysqli_stmt->fetch()){
//   echo "<script>alert('用户名已存在！请重新注册');history.go(-1);</script>";
  
//   header("refresh:1;url=zhuce.php");
//   }
// //再用预处理来插入用户数据
//   else{
 	 
  

 






// $mysqli_stmt->free_result();
// $mysqli_stmt->close();
// $mysqli->close();
// 
 ?> 