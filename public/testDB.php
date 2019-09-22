<?php
$testConnection = mysqli_connect('127.0.0.1:3306', 'admin', 'password');
if (!$testConnection) {
die('Error: ' . mysqli_connect_error());
}
echo 'Database connection working!';
mysqli_close($testConnection);
?>