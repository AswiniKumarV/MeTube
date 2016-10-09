<?php session_start();
//$cookie_name="user";
setcookie("userid",$_SESSION["userid"],time()+(60*60*24*30), "/");
setcookie("username",$_SESSION["useName"],time()+(60*60*24*30),"/");
//echo $_COOKIE["userid"];
?>
<html>
    <head>
<style>
header {
    background-color:indigo;
    color:white;
    text-align:center;
    height:120px;
    //padding:3px;
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
    height:300px;
    width:250px;
    float:right;
    padding:5px;	      
}
section {
    width:350px;
    float:left;
    padding:10px;	 	 
}
footer {
    background-color:orangered;
    color:white;
    clear:both;
    text-align:center;
    padding:5px;	 	 
}
a{
    color:white;
    text-decoration:none;
    text-transform: capitalize;
}
</style>
</head>

<body>
    <header><h1 style="font-family:verdana" align="center"><br>Welcome to Metube!</h1>
        <?php
        
        echo "<h5 style='font-family:verdana' align='right'>Welcome  ";
        ?>
        <a style="text-decoration:underline" href="myprofile.php" target="center" ><?php echo $_SESSION["useName"]?></a>
        !
        
        <a style="text-decoration:underline" href="index.php" > Log Out</a>
        </h5>

        </header>

    
    <nav>

<h3 style="font-family:verdana;"><a href="loginindex.php" class="_self" >Home</a><br>
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
<a href="mycontact.php" target="center">My Contacts<br></a>
<a href="Messages.php" target="center">Messages<br></a>
<a href="gd.php" target="center">G_Discussion<br></a>
<a href="channel.php" target="center">My Page<br></a>
</h3>
<div class="clearfloat"></div>

</nav>
<section>
    
    <iframe frameborder="0" src="mainpage.php" width="1010" height="1015" name='center'></iframe>
        
    </section>
    
</body>
</html>