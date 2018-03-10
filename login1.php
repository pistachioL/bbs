<?php
  session_start();
  header("content-type:text/html;charset=utf-8");
  error_reporting (E_ALL & ~E_NOTICE);//屏蔽错误信息

   $mysqli=new mysqli("127.0.0.1","root","root","bbs");
   if($mysqli->connect_error){
    echo ('连接失败'.$mysqli->connect_error);
   }
  
   //字符码
  $mysqli->set_charset('utf8');
  $q=$_GET["q"];
  $myname=trim(($_POST['username']));
  $passwd=md5($_POST['password']);

  // $v=$_GET["v"];
     //查询用户名是否存在
   $sql="SELECT * FROM register WHERE username='$_GET[q]' ";
    $result=mysqli_query($mysqli,$sql);
  if(is_array(mysqli_fetch_assoc($result))){
    echo "<font color=green>OK</font>";
  }
  else{
    echo "<font color=red>*用户名不存在</font>";
  }

  // //查询密码是否正确
  // $sql="SELECT * FROM register WHERE password='$_GET[v]' ";
  // $result=mysqli_query($mysqli,$sql);
  // if(is_array(mysqli_fetch_assoc($result))){
  //   echo "<font color=green>OK</font>";
  // }
  // else{
  //   echo "<font color=red>No suggestion</font>";
  // }

   //（用预处理）查询用户名和密码 
  if(isset($_REQUEST['code'])){
        if(strtolower(trim($_REQUEST['code']))==$_SESSION['code']){
   $query="SELECT * FROM register WHERE username=? AND password=? ";
   //预处理
   $mysqli_stmt=$mysqli->prepare($query);
   $mysqli_stmt->bind_param("si",$username,$password);//$password post赋值给参数
   //赋值
   $username=$myname;
   $password=$passwd;
   //执行数据
   $mysqli_stmt->execute();
   //数据储存
   $mysqli_stmt->store_result();
   //绑定结果
   $mysqli_stmt->bind_result($name,$password);


   //取出数据
   if($mysqli_stmt->fetch()){
            echo "登录成功,2秒后跳转到主页";
            header("refresh:1;url=zhuye.php");
            setcookie('username','Liao',time()+60*60*24*30);
   }
  }
}
   else{
    // echo "登录失败,1秒后跳转到登录页面";
    header("refresh:1;url=login.php");
   }


  




   
?>







  