
<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn === false) {
    die("Connection failed: " . $conn->connect_error);
}

?>