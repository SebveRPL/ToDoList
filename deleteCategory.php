<?php
require_once("connect.php");
require_once("session.php");

$id = $_GET['id'];

$deleteQuery = "DELETE FROM categories WHERE ID = {$id}";

if ($conn->query($deleteQuery)) {
  $_SESSION['success'] = "Pomyślnie usunięto kategorię!!";
  $conn->close();
  header("Location:categories.php?page=1");
} else {
  $_SESSION['error'] = "Nie udało się usunąć kategorii!!";
  $conn->close();
  header("Location:categories.php?page=1");
}