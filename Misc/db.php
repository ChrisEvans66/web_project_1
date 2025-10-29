<?php
// Database configuration//
$hostname = "db";
$username = "chris";
$password = "bj02";
$dbname = "chrisdb";

// Create connection to databse//
$con = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection to database//
if (!$con) 
{
    die("Connection failed: " . mysqli_connect_error());
}
?>