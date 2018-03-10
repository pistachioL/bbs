<!DOCTYPE HTML>
<html>
<head>
   <meta charset="utf-8">
   <title>留言板</title>
 <link href="show_message.css" rel="stylesheet" type="text/css">
 <style>
 .body{
  
  background:url('./image/try everything.jpg');
  
  margin-right:100px;
  height:1000px;

  background-repeat:no-repeat;
 /* background-attachment:fixed;*/
  background-position:right top;
  
}
 </style>
</head>


<body>
 <div class="body">
 <div class="title" style="color:grey; font-size:50px; top:20px;">留言板</div>
 
    <a href="zhuye.php" class="back">返回主页</a> 
    <a href="login.php" class="out"> 退出登录</a>


<div class="bbs">


<?php

 $page= isset($_GET['p']) ? trim($_GET['p']) :1;
 $host="127.0.0.1";
 $name="root";
 $password="root";
 $db="bbs";
 $showPage=5;
 $pagesize=5;
 
   $conn = mysqli_connect($host,$name,$password,$db);
  if($conn->connect_errno){
    echo "error".$conn_connect->error;
  }
   mysqli_select_db($conn,"bbs");
   mysqli_query($conn,"SET NAMES 'utf8' ");

   date_default_timezone_set('Asia/Shanghai');
   echo date ('Y-m-d H:i:s');
    
   $lastdate=date ('Y-m-d H:i:s');
   


    
    $sql= "SELECT * FROM message LIMIT " .($page-1)*5 .",5";
    $result = mysqli_query($conn,$sql);//传输sql语句到数据库中二维数组(关联数组) 获取留言内容 
 
    
    while($row=mysqli_fetch_array($result)){
   
      echo '<div class="border">';
      echo  "ID:".$row['ID']."<br/>";
      echo "名字:".$row['user']. "<br/>";
      echo "留言内容:" .$row['content']. " <br/>";
      echo "留言时间：".date("Y-m-d H:i:s",$row['lastdate']) ." <br/>";

    echo '</div>';
       };
       
       ?>
   </div>

    <div class="page">
    <?php
   //计算总页数
     $to_sql="SELECT COUNT(*)FROM message ORDER BY id DESC";
     $to_result=mysqli_fetch_array(mysqli_query($conn,$to_sql));
     $to=$to_result[0];
     //计算页数
      $to_pages=ceil($to/$pagesize);
     
     
       

     //计算偏移量
     $showPage=5;
     $pageoffset=($showPage-1)/2;
     
     
       // $page_banner.=" ";//方便我们拼接.定义这个，存放分页条
      if($page>1){
        $page_banner= "<a href='".$_SERVER['PHP_SELF']." ?p=1'>首页</a>";
       $page_banner.= "<a href='".$_SERVER['PHP_SELF']." ?p=".($page-1)."'>前一页</a>";
       
       }else{
         $page_banner="<span class='disable'>首页</a>";
         $page_banner.="<span class='disable'>上一页</a>";
       }
       //初始化数据
        $start=1;
        $end=$to_pages;
        if($to_pages>$showPage){
            if($page>$pageoffset+1){
                $page_banner.="...";
            }
            if($page>$pageoffset){
                $start=$page-$pageoffset;
                $end=$to_pages>$page+$pageoffset?$page+$pageoffset:$to_pages;
            }else{
                $start=1;
                $end=$to_pages>$showPage?$showPage:$to_pages;
            }
            if($page+$pageoffset>$to_pages){
                $start=$start-($page+$pageoffset-$end);
            }
        }
       

         for($i=$start;$i<=$end;$i++){
              if($page==$i){
                $page_banner.="<span class='current'>{$i}</span>";
               }
             else{
             $page_banner.="<a href='".$_SERVER['PHP_SELF']." ?p=".$i."'>{$i}</a>";
          }
    }
         
        //尾部省略
         if($to_pages>$showPage && $to_pages>$page+$pageoffset){
          $page_banner.="...";
         }


        if($page<$to_pages){
        
        $page_banner.="<a href='".$_SERVER['PHP_SELF']." ?p=".($page+1)."'>下一页</a>";
        $page_banner.="<a href='".$_SERVER['PHP_SELF']." ?p=".($to_pages)."'> 尾页 </a>";
       }
 
        //显示页数
        //页数跳转
         
           $page_banner.="<form action='show_message.php' method='get'>";
           $page_banner.="<input type='text' class='jump' name='p'>";
           $page_banner.="<input type='submit' class='btn_jump' value='跳转'>";
           $page_banner.="</form> </div>";

           echo $page_banner;
       
           

           
   
 
 ?>
 </div>
 
 <div class="biaodan"><form action="show_message1.php" method="post">

  <b>用户名：</b>&nbsp; <input type="text" name="user" style="border-radius: 5px;" ><br/>
  <b>发布内容: </b> <textarea  class="content" name="content"></textarea>

 <input type="submit" name="Submit" class="btn" value="发布">
 
 </form> 
</div>

</div>  
  </body>
  </html>


 



  






