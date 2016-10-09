<?php 
session_start();
$_SESSION["upch"] = $_POST['upch'];
?>
<!DOCTYPE html>
<html>
<head>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 71%;
    height: 0%
}

#customers td, #customers th {
    font-size: 1em;
    border: 1px solid #FF9900;
    padding: 3px 7px 2px 7px;
}

#customers th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #DF5500;
    color: #ffffff;
}

#customers tr.alt th {
    color: #fffff;
    background-color: indigo;
}

#customers tr.alt1 th {
    color: #fffff;
    background-color: #DF5500;
}

</style>
</head>

<body>	<br> <br>
<form action="imageupload.php" method="post" enctype="multipart/form-data">

<table id="customers">
  <tr>
    <th>Select image to upload: </th>
    <th><input type="file" name="fileToUpload" id="fileToUpload"> </th>
    <th><input type="submit" value="Upload Image" name="submit"> </th>
  </tr>
  <tr> 
  <td> Category
  <select name="category" required>
 	<option value="image">image</option>
  </select> **
  </td>
  <td>Keywords: <input type="text" name="keywords" required> **</td>
    <td> Allow Comments
  <select name="allow_comments" required>
 	<option value="1">Yes</option>
 	<option value="0">No</option>
  </select> **
   </td>
  </tr>
</table>

</form>
   <br> <br>	
   
<form action="videoupload.php" method="post" enctype="multipart/form-data">
<table id="customers">
  <tr class="alt">
	<th>Select video to upload:</th>
	<th><input type="file" name="fileToUpload" id="fileToUpload"></th>
	<th><input type="submit" value="Upload Video" name="submit"></th>
  </tr>
  <tr> 
  <td> Category
  <select name="category" required>
  	<option ></option>
  	<option value="movie">movie</option>
 	<option value="news">news</option>
 	<option value="entertainment">entertainment</option>
 	<option value="education">education</option>
 	<option value="tv">tv</option>
 	<option value="music">music</option>
  </select> **
  </td>
  <td>Keywords: <input type="text" name="keywords" required> **</td>
  <td> Allow Comments
  <select name="allow_comments" required>
 	<option value="1">Yes</option>
 	<option value="0">No</option>
  </select> **
   </td>
  </tr>
</table>
</form> 

   <br> <br>	
<form action="audioupload.php" method="post" enctype="multipart/form-data">
<table id="customers">
  <tr class="alt1">
	<th>Select audio to upload:</th>
	<th><input type="file" name="fileToUpload" id="fileToUpload"></th>
	<th><input type="submit" value="Upload Video" name="submit"></th>
  </tr>
  <tr> 
  <td> Category
  <select name="category" required>
  	<option ></option>
  	<option value="movie">movie</option>
 	<option value="news">news</option>
 	<option value="entertainment">entertainment</option>
 	<option value="education">education</option>
 	<option value="tv">tv</option>
 	<option value="music">music</option>
  </select> **
  </td>
  <td>Keywords: <input type="text" name="keywords" required> **</td>
   <td> Allow Comments
  <select name="allow_comments" required>
 	<option value="1">Yes</option>
 	<option value="0">No</option>
  </select> **
   </td>
  </tr>
</table>
</form>
 
</body>
</html>