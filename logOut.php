<?php
session_start();
if ($_SESSION['nick']) {
  unset($_SESSION['nick']);
  unset($_SESSION['roleId']);
  unset($_SESSION['userId']);
  unset($_SESSION['email']);
  session_destroy();
  header('Location:index.php');
} else {
  header('Location:index.php');
}