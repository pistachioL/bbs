<?php
   session_start();
   $image=imagecreatetruecolor(100, 30);//宽度 高度
   $bgcolor=imagecolorallocate($image,255,255,255);//背景颜色
   imagefill($image,0,0,$bgcolor);
   $captch_code = '';
   //数字验证码
   for ($i=0;$i<4;$i++)
   {
   	$fontsize=100;
   	$fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
    $date='asdfghjklzxcvbnmqwertyuiop1234567890';
    $fontcontent=substr($date,rand(0,strlen($date)),1);
    $captch_code.="$fontcontent";
   	$x=($i * 100/4)+rand(5,10);//数字间的距离
   	$y=rand(5,10);
   	imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
   }
   $_SESSION['code']=$captch_code;
   //点的干扰元素
   for($i=0;$i<200;$i++)
   {
   	$pointcolor=imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));//颜色区域
   	imagesetpixel($image,rand(1,99),rand(1,29),$pointcolor);//长和宽
   }

   //线的干扰元素
   for($i=0;$i<5;$i++)
   {
   	$linecolor=imagecolorallocate($image,rand(60,200),rand(60,200),rand(60,200));//颜色区域
   	imageline($image,rand(1,99),rand(1,29),rand(1,99),rand(1,29),$linecolor);

   }

  
   header('content-type:image/png');
   imagepng($image);
   //销毁否则占内存
   imagedestroy($image);

