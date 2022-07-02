<?php
if (!isset($_POST['submit'])) {
  header("Location:settings.php");
  exit();
}


require_once("session.php");
require_once("connect.php");

$nick = $_POST['nick'];
$id = $_SESSION['userId'];

$checkQuery = "SELECT * FROM users WHERE username = {$nick}";

$loginQuery = "UPDATE users SET username='{$nick}' WHERE ID = {$id}";

$checkerResult = $conn->query($checkQuery);

if ($checkerResult->num_rows > 0) {
  if ($conn->query($loginQuery)) {
    $_SESSION['nick'] = $nick;
    $_SESSION['success'] = "Pomyślnie zmodyfikowano nick!!";
    $conn->close();
    header("Location:settings.php");
  } else {
    $_SESSION['error'] = "Nie udało się zmodyfikować nicku!!";
    $conn->close();
    header("Location:settings.php");
  }
} else {
  $_SESSION['error'] = "Nie udało się zmodyfikować nicku, ponieważ istnieje konto o wprowadzonym nicku!!!";
  $conn->close();
  header("Location:settings.php");
}