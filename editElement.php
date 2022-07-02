<?php

if (!isset($_POST['submit'])) {
  header("Location:thingsToDo.php?page=1");
  exit();
}

require_once("connect.php");
require_once("session.php");

$id = $_POST['id'];
$text = $_POST['text'];
$deadLineDate = $_POST['deadLine'];
$category = $_POST['category'];
$status = $_POST['status'];

$modifyQuery = "UPDATE thingstodo SET statusID={$status},catID = {$category}, text='{$text}',deadLineDate = '{$deadLineDate}' WHERE ID ={$id}";

echo $modifyQuery;

if ($conn->query($modifyQuery)) {
  $_SESSION['success'] = "Pomyślnie zmodyfikowano zadanie!!";
  $conn->close();
  header("Location:thingsToDo.php?page=1");
} else {
  $_SESSION['error'] = "Nie udało się dodać zadania!!";
  $conn->close();
  header("Location:editElementForm.php?id={$id}");
}