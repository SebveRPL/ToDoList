<?php
if (!isset($_POST['submit'])) {
  header("Location:settings.php");
  exit();
}


require_once("session.php");
require_once("connect.php");


$password = $_POST['password'];
$password = password_hash($password, PASSWORD_BCRYPT);
$id = $_SESSION['userId'];

$loginQuery = "UPDATE users SET password='{$password}' WHERE ID = {$id}";

if ($conn->query($loginQuery)) {
  $_SESSION['success'] = "Pomyślnie zmodyfikowano hasło!!";
  $conn->close();
  header("Location:settings.php");
} else {
  $_SESSION['error'] = "Nie udało się zmodyfikować hasła!!";
  $conn->close();
  header("Location:settings.php");
}