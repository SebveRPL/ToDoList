<?php
session_start();
if ($_SESSION['nick']) {
  unset($_SESSION['nick']);
  header('Location:index.php');
  session_destroy();
} else {
  header('Location:index.php');
}