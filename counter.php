<?php
$fp=fopen("zzm.txt","r");
$str1=fgets($fp,10);//read 9 characters
$str1++;//count
fclose($fp);
$fp=fopen("zzm.txt","w");
fputs($fp,$str1);
fclose($fp);
//output
$len1=strlen($str1);
$str2="000000000";
$len2=strlen($str);
$dif=$len2-$len1;
$rest=substr($str2,0,$dif);
$string=$rest.$str1;//
echo "You are the $string visitor.";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

