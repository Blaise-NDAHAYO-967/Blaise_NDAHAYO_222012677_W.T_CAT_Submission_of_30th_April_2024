<?php
// Database credentials
$hostname = "localhost";
$username = "ndahayo";
$password = "12345";
$database = "cas_lms";

// Create connection
$connection = new mysqli($hostname, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>