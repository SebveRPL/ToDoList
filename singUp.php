<?php
session_start();
if (!isset($_POST['submit'])) {
  header("Location: singUpForm.php");
  exit();
}
require_once("connect.php");

try {

  if ($conn->connect_errno != 0) {
    throw new Exception((mysqli_connect_errno()));
  } else {
    $success;
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $repeatPass = $_POST['password-repeat'];
    $email = filter_var($_POST['e-mail'], FILTER_SANITIZE_EMAIL);

    $userName = htmlentities($userName, ENT_QUOTES, "UTF-8");

    $emailQuery = "SELECT * FROM users where email = '{$email}'";

    $emailResult = $conn->query($emailQuery);

    if ($emailResult->num_rows > 0) {
      $_SESSION['error'] = "Istnieje użytkownik o podanym emailu!";
      $conn->close();
      header("Location: singUpForm.php?failed");
      exit();
    } else {
      $userNameQuery = "SELECT * FROM users WHERE username = '{$userName}'";
      $userNameResult = $conn->query($userNameQuery);

      if ($userNameResult->num_rows > 0) {
        $_SESSION['error'] = "Istnieje użytkownik o podanym nicku!";
        $conn->close();
        header("Location: singUpForm.php?failed");
        exit();
      } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          if ($password === $repeatPass) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $addingQuery = "INSERT INTO users (username, password,email) VALUES ('{$userName}','{$password}','{$email}')";

            if ($conn->query($addingQuery)) {
              $_SESSION['success'] = "Pomyślnie zarejestrowano! Można już się zalogować!";
              $conn->close();
              header("Location: logInForm.php");
              exit();
            } else {
              $_SESSION['error'] = "Nie udało się zarejestrować! Spróbuj ponownie później!";
              $conn->close();
              header("Location: singUpForm.php?failed");
              exit();
            }
          } else {
            $_SESSION['error'] = "Podane hasła nie pasują do siebie!";
            $conn->close();
            header("Location: singUpForm.php?failed");
            exit();
          }
        } else {
          $_SESSION['error'] = "Podany email nie jest poprawny!";
        }
      }
    }
  }
} catch (Exception $ex) {
  echo "Błąd połączenia!";

  header("Location: singUpForm.php");
} finally {
  $conn->close();
  exit();
}