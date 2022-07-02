<?php
if ($_SESSION['roleId'] == 3) {
  header("Location: panel.php");
  exit();
}