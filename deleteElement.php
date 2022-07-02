<?php

require_once("connect.php");
require_once("session.php");

$id = $_GET['id'];

$deleteQuery = "DELETE FROM thingstodo WHERE ID = {$id}";

if ($conn->query($deleteQuery)) {
  $_SESSION['success'] = "Pomyślnie usunięto zadanie!!";
  $conn->close();
  header("Location:thingsToDo.php?page=1");
} else {
  $_SESSION['error'] = "Nie udało się dodać zadania!!";
  $conn->close();
  header("Location:thingsToDo.php?page=1");
}