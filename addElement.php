<?php

if (!isset($_POST['submit'])) {
  header("Location:thingsToDo.php?page=1");
  exit();
}

require_once("session.php");
require_once("connect.php");


$userId = $_SESSION['userId'];
$text = $_POST['text'];
$deadLineDate = $_POST['deadLine'];
$category = $_POST['category'];

$addingQuery = "INSERT INTO thingstodo (userID,catID,text,deadLineDate) VALUES ('{$userId}','{$category}','{$text}','{$deadLineDate}')";

if ($conn->query($addingQuery)) {
  $_SESSION['success'] = "Pomyślnie dodano zadanie!!";
  $conn->close();
  header("Location:thingsToDo.php?page=1");
} else {
  $_SESSION['error'] = "Nie udało się dodać zadania!!";
  $conn->close();
  header("Location:addElementForm.php");
}