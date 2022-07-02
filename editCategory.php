<?php

if (!isset($_POST['submit'])) {
  header("Location:categories.php?page=1");
  exit();
}

require_once("connect.php");
require_once("session.php");


$categoryName = $_POST['categoryName'];
$id = $_POST['id'];

$addingQuery = "UPDATE categories SET categoryName = '{$categoryName}' WHERE ID = {$id}";

if ($conn->query($addingQuery)) {
  $_SESSION['success'] = "Pomyślnie zmodyfikowano kategorię!!";
  $conn->close();
  header("Location:categories.php?page=1");
} else {
  $_SESSION['error'] = "Nie udało się zmodyfikować kategorii!!";
  $conn->close();
  header("Location:editCategoryForm.php?id={$id}");
}