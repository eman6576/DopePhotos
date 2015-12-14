<?php
// Do not change the following two lines.
$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER['PHP_SELF']);

// You will need to require this file on EVERY php file that uses the database.
// Be sure to use $db->close(); at the end of each php file that includes this!

$dbhost = 'localhost';  // Most likely will not need to be changed
$dbname = 'eguerre4';   // Needs to be changed to your designated table database name
$dbuser = 'eguerre4';   // Needs to be changed to reflect your LAMP server credentials
$dbpass = 'pizza6576'; // Needs to be changed to reflect your LAMP server credentials

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

function queryMysql($query) {
    global $db;
    
    $result = $db->query($query);
    if (!$result) {
        die($db->error);
    }
    
    return $result;
}

function destroySession() {
    $_SESSION = array();
    
    if (session_id != "" || isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 2592000, '/');
    }
    
    session_destroy();
}

function sanitizeString($var) {
    global $db;
    
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    
    return $db->real_escape_string($var);
}

function savePostToDB($username, $textdescription, $title, $imagename, $timestamp, $imagefilter){
    $query = "INSERT INTO WALL VALUES('$username', '$textdescription', '$title', '$imagename', '$timestamp', '$imagefilter')";
    
    queryMysql($query);
}

function getUploadedImages() {
    $error = "";
    $result;
    $query = "SELECT username, textdescription, title, imagename, time_stamp, imagefilter FROM WALL ORDER BY time_stamp DESC";
    
    if (!$result = queryMysql($query)) {
        $error = "An unknown error occured. Please try again later.";
        header("Location: ../index.php");
    }
    else {
        $output = "";
        $filter;
        while ($row = $result->fetch_assoc()) {
            $output = $output . '<div class="container" width="800px" height="700px"><div>"' .$row['title'] . '"posted by ' . $row['username'] . '</div><div class="thumb"><img class="' . $row['imagefilter'] . ' thumbnail" src="userphotos/' . $row['imagename'] . '" width="1000px" height="700px">' . $row['textdescription'] . '</div></div>'; 
        }
    }
    
    return $output;
}

function adminGetUploadedImages() {
    $error = "";
    $result;
    $query = "SELECT username, textdescription, title, imagename, time_stamp, imagefilter FROM WALL ORDER BY time_stamp DESC";
    
    if (!$result = queryMysql($query)) {
        $error = "An unknown error occured. Please try again later.";
        header("Location: ../index.php");
    }
    else {
        $output = "";
        $filter;
        while ($row = $result->fetch_assoc()) {
            $output = $output . '<div class="container" width="800px" height="700px"><div>"' .$row['title'] . '"posted by ' . $row['username'] . '</div><div class="thumb"><img class="' . $row['imagefilter'] . ' thumbnail" src="userphotos/' . $row['imagename'] . '" width="1000px" height="700px"><a id="deletelink" class="deletelink" href="deletepost.php?imagename=' . $row['imagename'] . '"><button id="deletebutton" class="deletebutton">Delete</button></a>' . $row['textdescription'] . '</div></div>'; 
        }
    }
    
    return $output;  
}
?>