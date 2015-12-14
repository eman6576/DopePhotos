<?php
//Connect to the database
require_once 'db_connect.php';

//Start a session
session_start();

//Store the session
$username = $_SESSION['savedUsername'];

//Query the database for the user
$result = queryMysql("SELECT username FROM USERS WHERE username = '$username'");
$row = mysql_fetch_assoc($result);
$usersession = $row['username'];

//Check if the user has a session
if ($result->num_rows == 0) {
    //Destroy the session
    destroySession();
    
    //Redirect the user back to the login page
    header("Location: ../index.php");
}
?>