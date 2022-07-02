<?php
if (!isset($_POST['submit'])) {
  header("Location:settings.php");
  exit();
}


require_once("session.php");
require_once("connect.php");


$email = $_POST['email'];
$id = $_SESSION['userId'];

$checkEmail = "SELECT * FROM users WHERE email = {$email}";

$emailQuery = "UPDATE users SET email='{$email}' WHERE ID = {$id}";

$checkerResult = $conn->query($checkEmail);

if ($checkerResult->num_rows > 0) {
  if ($conn->query($emailQuery)) {
    $_SESSION['email'] = $email;
    $_SESSION['success'] = "Pomyślnie zmodyfikowano maila!!";
    $conn->close();
    header("Location:settings.php");
  } else {
    $_SESSION['error'] = "Nie udało się zmodyfikować maila!!";
    $conn->close();
    header("Location:settings.php");
  }
} else {
  $_SESSION['error'] = "Nie udało się zmodyfikować maila, ponieważ istnieje konto o podanym mailu!!";
  $conn->close();
  header("Location:settings.php");
}