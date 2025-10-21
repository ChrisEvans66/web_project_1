<?php
$hostname = "db";
$username = "chris";
$password = "bj02";
$dbname = "chrisdb";

// Create connection
$con = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$con) 
{
    die("Connection failed: " . mysqli_connect_error());
}
?>