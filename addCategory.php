<?php

if (!isset($_POST['submit'])) {
  header("Location:categories.php?page=1");
  exit();
}

require_once("connect.php");
require_once("session.php");


$categoryName = $_POST['categoryName'];

$addingQuery = "INSERT INTO categories (categoryName) VALUES ('{$categoryName}')";

if ($conn->query($addingQuery)) {
  $_SESSION['success'] = "Pomyślnie dodano kategorię!!";
  $conn->close();
  header("Location:categories.php?page=1");
} else {
  $_SESSION['error'] = "Nie udało się dodać kategorii!!";
  $conn->close();
  header("Location:addCategoryForm.php");
}