
<?php
   header('Content-Type:text/html;charset=utf-8');
 //连接数据库
  $mysqli=new mysqli('127.0.0.1','root','root','bbs');
  if($mysqli->connect_errno){
    echo "连接失败".$mysqli->connect_error;
  }
 

   $id=$_POST['id'];
   $user=$_POST['user'];
   $content=$_POST['content'];
   $time = time();
   
   
 

 	//空值处理 
     if(empty($_POST['user'])){

     	
     		
     	echo "<script>alert('留言失败，用户名不能为空')</script>";
     	header("refresh:0;url=show_message.php");
    }

    if(empty($_POST['content'])){

     	
     		
     	echo "<script>alert('留言内容不能为空')</script>";
     	header("refresh:0;url=show_message.php");
    }
    

     else{
     	  echo "<script>alert('留言成功!')</script>";
    		header("refresh:0;url=show_message.php");//查看留言 记得把更新的留言放在list
 	 
     }

     $sql="INSERT INTO message(id,user,content,lastdate)VALUES('$id','$user','$content','$time')";
     $result=mysqli_query($mysqli,$sql);