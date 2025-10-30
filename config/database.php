<?php
$host = "localhost";
$database = "campus_jaya";
$username = "root";
$password = "5432";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

echo "Connection Succesfully";
mysqli_close($conn);
?>
