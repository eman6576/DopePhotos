<?php
//Connect to the database
require_once 'db_connect.php';

//Get the query string from the a element href URL
$imagename = $_GET['imagename'];

 //Delete the post record from the database
$query = "DELETE FROM WALL WHERE imagename = '$imagename'";
queryMysql($query);

//Reload the wall for the admin
//$error = "Post deleted!";
echo $error;
header("Location: adminwall.php");
?>