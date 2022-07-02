<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "comamzrobicdb";

$conn = new mysqli($serverName, $userName, $password, $dbName);

if ($conn->connect_error) {
  die("Nieudane połączenie: " .
    mysqli_connect_error());
}
