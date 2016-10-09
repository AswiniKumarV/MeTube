<?php
session_start();
setcookie("userid",NULL,time()-3600,"/");
//$_SESSION["userid"]=0;
unset($_SESSION["userid"]);
unset($_SESSION["useName"]);
unset($_SESSION["eml"]);

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
<style>
header {
    width:100%;
    background-color:indigo;
    color:white;
    text-align:center;
    padding:5px;
}


nav {
    line-height:80px;
    width:140px;
    background-color:#DF5500;
    float:left;
    padding:5px;
    text-align: center;
}

aside {
    text-align:center;
    background-color:#DF5500;
    height:500px;
    width:250px;
    float:right;
    padding:5px;	      
}
section {
    width:750px;
    float:left;
    padding:10px;	 	 
}

a{
    color:white;
    text-decoration:none;
    text-transform: capitalize;
}
</style>
</head>

<body>
    <header><h1 style="font-family:verdana">Welcome to Metube!</h1></header> 

    
    <nav>

<h3 style="font-family:verdana;"><a href="index.php" class="_self" >Home</a><br>
<a href="mostviewed.php" target="center" >Most Viewed<br></a>
<a href="mostrecent.php"target="center">Most Recent<br></a>
<a href="music.php"target="center">Music<br></a>
<a href="movies.php" target="center">Movies<br></a>
<a href="sport.php" target="center">Sport<br></a>
<a href="news.php"target="center">News<br></a>
<a href="image.php" target="center">Images<br></a>
<a href="education.php"target="center">Education<br></a>
<a href="tv.php"target="center">TV<br></a>
<a href="original.php"target="center">Entertain<br></a>
</h3>
<div class="clearfloat"></div>

</nav>

    <!--<nav><h4 style="font-family:verdana">My&nbspChannel <br>Media<br> Movies<br> TV<br> Sports<br></nav>-->
    <aside>
        
        <iframe frameborder="0"  src="login and register.php" width="600" height="500" target="iframelogin"></iframe>
    
    </aside>
<section>
     
    <iframe frameborder="0" src="mainpage.php" width="130%" height="1015" name='center'></iframe>
      
    </section>
    
       
    </body>
</html>

<!--width="1240"
