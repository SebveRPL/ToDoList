<?php
session_start();
if (!isset($_POST['submit'])) {
  header("Location: sing-up.php");
  exit();
}
require_once("connect.php");

try {
  if ($conn->connect_errno != 0) {
    throw new Exception((mysqli_connect_errno()));
  } else {
    $success;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPass = $_POST['password-repeat'];
    $email = $_POST['e-mail'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $username = htmlentities($username, ENT_QUOTES, "UTF-8");

    if ($password === $repeatPass) {
      $password = password_hash($password, PASSWORD_BCRYPT);
    } else {
      $_SESSION['error'] = "Hasła nie pasują do siebie!";
      header("Location: sing-up.php?failed");
      exit();
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $add = "INSERT INTO users (username, password,email,roleID) VALUES ('{$username}','{$password}','{$email}','3')";

      if ($conn->query($add)) {
        echo "Uzytkownik dodany!";
        $success = true;
      } else {
        echo "Error: " . $add . "<br>" . $conn->error;
        $success = false;
      }
      $conn->close();

      if ($success === true) {
        header("Location: sing-up.php?success");
      } else {
        header('Location:sing-up.php?failed');
      }
    } else {
      echo ("Email jest nie prawidłowy!");
      header('Location:sing-up.php?failed');
    }
  }
} catch (Exception $exc) {
  echo "Błąd!";
}