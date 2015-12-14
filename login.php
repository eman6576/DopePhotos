<?php
//Connect to database
require_once 'db_connect.php';
$error = $username = $password = "";

if (isset($_POST['username'])) {
    //Get the username and the password the user entered
    $username = sanitizeString($_POST['username']);
    $password = sanitizeString($_POST['password']);

    //Checks if the user left any of the fields blank
    if ($username == "" || $password == "") {
        $error = "Sorry, not all fields were entered!";
    }
    else {
        //Salt and hash the username
        $salt1 = "qs@h!";
        $salt2 = "t%ce#";
        $token1 = hash('ripemd128', "$salt1$username$salt2");

        //Salt and hash the password
        $salt3 = "rd&w#";
        $salt4 = "ua*f@";
        $token2 = hash('ripemd128', "$salt3$password$salt4");

        //Queries the database to see if the user exists
        $result = queryMysql("SELECT * FROM USERS
                    WHERE username = '$token1' AND password = '$token2'");
        //Checks if zero rows were returned meaning wrong login
        if ($result->num_rows == 0) {
            $error = "Sorry, invalid login!";
        }
        else {
            //Check if the user is an admin
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if ($row['admin'] == 1) {
                //Start a session and redirect the user to the admin wall page
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['savedUsername'] = $token1;
                $_SESSION['password'] = $token2;
                $_SESSION['userrole'] = $row['admin'];
                header("Location: wall/adminwall.php");
            }
            else {
                //Start a session and redirect user to wall page
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['savedUsername'] = $token1;
                $_SESSION['password'] = $token2;
                header("Location: wall/wall.php");  
            }
        }
    }
}
?>