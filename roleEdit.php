<?php
if (!isset($_POST['submit'])) {
  header("Location: panel.php");
  exit();
}
require_once("connect.php");
require_once("session.php");

$id = $_POST['id'];
$roleId = $_POST['role'];

$editRoleQuery = "UPDATE users SET roleID = {$roleId} WHERE ID = {$id}";

if ($conn->query($editRoleQuery)) {
  $_SESSION['success'] = "Pomyślnie zmieniono rolę użytkownika!";
  $conn->close();
  header("Location: users.php?page=1");
} else {
  $_SESSION['error'] = "Nie zmieniono roli użytkownika!";
  $conn->close();
  header("Location: users.php?page=1");
}