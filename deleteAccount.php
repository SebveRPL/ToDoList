<?php
if (!isset($_POST['submit'])) {
  header("Location: panel.php");
  exit();
}
require_once("connect.php");

$id = $_POST['id'];
$deleteQuery = "DELETE FROM users WHERE ID = {$id}";

if ($conn->query($deleteQuery)) {
  $conn->close();
  header("Location:logOut.php");
  exit();
} else {
  $conn->close();
  header("Location:settings.php");
  exit();
}