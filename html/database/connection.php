<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "MyWebsite";

//establish connection.
$conn = new mysqli($servername, $username, $password, $database);

//check the connection.
if($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}
?>