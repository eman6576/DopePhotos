<?php
//Connect to the database
require_once 'db_connect.php';

$error = $username = $password = $firstname = $lastname = "";
if (isset($_SESSION['username'])) {
    destroySession();
}

if (isset($_POST['firstname'])) {
    //Sanitize the input from the user.
    $firstname = sanitizeString($_POST['firstname']);
    $lastname = sanitizeString($_POST['lastname']);
    $username = sanitizeString($_POST['username']);
    $password = sanitizeString($_POST['password']);

    //Check if the user missed any of the fields in the form
    if ($firstname == "" || $lastname == "" || $username == "" || $password == "") {
        $error = "Sorry, not all of the fields have been entered!";
    }
    else {
        //Salt and hash the username
        $salt1 = "qs@h!";
        $salt2 = "t%ce#";
        $token1 = hash('ripemd128', "$salt1$username$salt2");
        
        //Check if the username alreay exists in the database
        $result = queryMysql("SELECT * FROM USERS WHERE username = '$token1'");
        if ($result->num_rows) {
            $error = "Sorry, the username entered already exists!";
        }
        else {
            //Salt and hash the password
            $salt3 = "rd&w#";
            $salt4 = "ua*f@";
            $token2 = hash('ripemd128', "$salt3$password$salt4");

            //Query the database to add the user
            queryMysql("INSERT INTO USERS(firstname, lastname, username, password) VALUES('$firstname', '$lastname', '$token1',
                                                '$token2')");
            //Redirect the user to the login page
            $error = "Account Created! Please login in.";
            header("Location: ../index.php");
        }
    }
}
?>