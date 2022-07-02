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
          $row = $result->fetch_object();

          $passTrue = password_verify($password, $row->password);


          if ($passTrue === true) {
            $_SESSION['nick'] = $row->username;
            $_SESSION['userId'] = $row->ID;
            $_SESSION['roleId'] = $row->roleID;
            $_SESSION['email'] = $row->email;

            if ($_SESSION['roleId'] == 6) {
              echo "Bana ma";
              $_SESSION['error'] = "Zostałeś zbanowany! W celu wyjaśnień skontaktuj się z administacją serwisu!";
              $conn->close();
              header('Location:logInForm.php');
            } else {
              $conn->close();
              header("Location: panel.php");
            }
          } else {
            echo "Niepoprawne hasło";
            $_SESSION['error'] = "Niepoprawny login lub hasło!";
            $conn->close();
            header('Location:logInForm.php');
          }
        } else {
          echo "Niepoprawny login";
          $_SESSION['error'] = "Niepoprawny login lub hasło!";
          $conn->close();
          header('Location:logInForm.php');
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