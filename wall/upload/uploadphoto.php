<?php
require_once "db_connect.php";

$error = "";

if (isset($_POST['title'])) {
    //Start a seesion and get the username of the user
    session_start();
    $username = $_SESSION['username'];
    
    //Get the entered title and text description of the photo
    $title = sanitizeString($_POST['title']);
    $textdescription = sanitizeString($_POST['text']);
    
    //Get the time the photo was uploaded
    $timestamp = $_SERVER['REQUEST_TIME'];
    
    //Create a file name for the file
    $filename = $timestamp . '.jpg';
    
    //Get the filter that the user selected for the photo
    $imagefilter = $_POST['filter'];
    
    //Check if a file was uploaded
    if (!is_uploaded_file($_FILES['upload']['tmp_name'])) {
        $error = "You need to upload a DopePhoto in order to share!";
    }
    else {
        //Get the file uploaded to the client
        //$tmp_name = $_FILES['upload']['name'];
        $destinationfolder = '../userphotos';
        
        //Move the file to the userphotos directory
        move_uploaded_file($_FILES['upload']['tmp_name'], $destinationfolder . DIRECTORY_SEPARATOR . $filename);
        
        print_r($_FILES);
        
        //Save the the post to the database
        savePostToDB($username, $textdescription, $title, $filename, $timestamp, $imagefilter);
        
        //Redirect the user back to the wall page
        header("Location: ../wall.php");
    }
}
?>