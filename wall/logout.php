<?php
//Start a session
session_start();

//Destroy all sessions
if (session_destroy()) {
    //Redirect the user to the login page
    header("Location: ../index.php");
}
?>