<?php
//Connect to the database
require_once 'db_connect.php';

if (isset($_POST['username'])) {
    //Get the entered username from the form
    $username = sanitizeString($_POST['username']);

    //Salt and hash the username
    $salt1 = "qs@h!";
    $salt2 = "t%ce#";
    $token1 = hash('ripemd128', "$salt1$username$salt2");

    //Query the database to see if the username entered already exists
    $query = "SELECT * FROM USERS WHERE username = '$token1'";
    $result = queryMysql($query);

    //Check if the query returned any rows
    if ($result->num_rows != 0) {
        //Send 0 to the ajax request
        echo 0;
    }
    else {
        //Send 1 to the ajax request to let the user know the username is avaliable
        echo 1;
    }
}
?>