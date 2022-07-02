<?php
session_start();


if (isset($_POST['submit'])) {
  require_once("connect.php");
  try {
    if ($conn->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $username = $_POST['username'];
      $password = $_POST['password'];


      $username = htmlentities($username, ENT_QUOTES, "UTF-8");

      if ($result = $conn->query(sprintf("SELECT * FROM users WHERE username='%s'", mysqli_real_escape_string($conn, $username)))) {
        $num = $result->num_rows;
        if ($num) {
          $row = $result->fetch_assoc();

          $passTrue = password_verify($password, $row['password']);


          if ($passTrue === true) {
            $_SESSION['nick'] = $row['username'];
            header("Location: panel.php");
            exit();
          } else {
            echo "Niepoprawne hasło";
            $_SESSION['error'] = "Niepoprawny login lub hasło!";
            header('Location:log-in.php');
          }
        } else {
          echo "Niepoprawny login";
          $_SESSION['error'] = "Niepoprawny login lub hasło!";
          header('Location:log-in.php');
        }
      }
    }
    $conn->close();
  } catch (Exception $e) {
    echo "Server error!";
  }
} else {
  header("Location:index.php");
}