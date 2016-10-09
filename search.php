<!doctype html>
<html>
<head>
</head>

<body>
    <form action="searchpro.php" method="get">
	<input type="text" name="searchterms" placeholder="your text goes here..." required>
	<input type="submit" value="Search"> <br /><br />
</form>
    
    <?php include "featurebasedsearch.php";
		  include "wordcloud.php";?>
</body>

</html>
