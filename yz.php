<?php
 session_start();
 
 //生成验证码图
 Header("Content-type: image/PNG");
 //长与宽
 $im = imagecreate(44,18);
 // 设置背景色:
 $back = ImageColorAllocate($im, 245,245,245);
 // 填充背景色:
 imagefill($im,0,0,$back);
 
 srand((double)microtime()*1000000);
 $vcodes;
 //生成4位数字
 for($i=0;$i<4;$i++){
  $font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
  $authnum=rand(1,9);
  $vcodes.=$authnum;
  imagestring($im, 5, 2+$i*10, 1, $authnum, $font);
 }
 
 //加入干扰象素
 for($i=0;$i<100;$i++){
  $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
  imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
 }
   
 ImagePNG($im);
 ImageDestroy($im);
 
 // 将四位的验证码保存在 SESSION 里，登录时调用对比
 $_SESSION["VCODE"]=$vcodes;
?>