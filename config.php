<?php

$DBservername = "localhost";
$DBusername = "root";
$DBpass = "root";
$DBname = "teacher";
$conn = new mysqli($DBservername, $DBusername, $DBpass, $DBname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
} 


?>