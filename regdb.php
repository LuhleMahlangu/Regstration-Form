<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registrationdb";
// Establish a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!$conn){
        die('Could not connect: ' .mysql_error());
    }





?>