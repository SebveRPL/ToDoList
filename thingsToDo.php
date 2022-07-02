<?php
require_once("session.php");
?>

<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="CoMamZrobić.pl jest innowacyjną aplikacją webową,która ma za zadanie ułatwienia życia przy zapamiętywaniu rzeczy,które trzeba zrobić" />
  <link
    href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="src/css/styles.css">
  <title>CoMamZrobić.pl - Panel Użytkownika</title>
</head>

<body>
  <div class="container">
    <?php
    include_once("panelHeader.php");
    ?>
    <main class="main-section">
      <?php
      include_once("panelNavigation.php");
      ?>
      <section class="panel-section">

        <h2 class="panel-heading2">Rzeczy do wykonania</h2>

        <h3 class="panel-heading3">
          Filtruj
        </h3>

        <aside class="filters">
          <label for="name" class="labels">Fraza: </label>
          <form action="thingsToDo.php" method="get">
            <input class="inputs" type="text" class="text" name="name" required>
            <input class="buttons" type="submit" value="Filtruj">
          </form>
          <form action="thingsToDo.php" method="get">
            <label for="category" class="labels">Kategorie:</label>
            <select class="select" name="category" required>
              <option value="">Wszystkie</option>
              <?php
              require_once('connect.php');
              $categoryQuery = "SELECT categoryName, ID FROM categories";

              $catResult = $conn->query($categoryQuery);

              while ($row = $catResult->fetch_object()) {
                echo <<<END
                  <option value="{$row->ID}">$row->categoryName</option>
                END;
              }
              ?>
            </select>
            <input class="buttons" type="submit" value="Filtruj">
          </form>
          <form action="thingsToDo.php" method="get">
            <label for="status" class="labels">Status:</label>
            <select class="select" name="status" required>
              <option value="">Wszystkie</option>
              <?php

              $statusQuery = "SELECT statusName,ID FROM  status";

              $statusResult = $conn->query($statusQuery);

              while ($row = $statusResult->fetch_object()) {
                echo <<<END
                  <option value="{$row->ID}">$row->statusName</option>
                END;
              }
              ?>
            </select>
            <input class="buttons" type="submit" value="Filtruj">
          </form>
          <div class="buttons-div">
            <a href="thingsToDo.php" class="buttons">Reset</a>
          </div>

        </aside>

        <aside class="things-div">
          <?php


          function t1($val, $min, $max)
          {
            return ($val >= $min && $val <= $max);
          }


          $thingsCountQuery = "SELECT COUNT(ID) as cnt FROM thingstodo";

          if (isset($_GET['name'])) {
            $thingsCountQuery .= " WHERE text LIKE '%{$_GET['name']}%'";
          } else if (isset($_GET['category'])) {
            $thingsCountQuery .= " WHERE catID  = {$_GET['category']}";
          } else if (isset($_GET['status'])) {
            $thingsCountQuery .= " WHERE statusID  = {$_GET['status']}";
          }
          $thingsCountResult = $conn->query($thingsCountQuery);

          $thingsCount = $thingsCountResult->fetch_object()->cnt;
          $limit = 6;
          $currentPage = isset($_GET['page']) ? intval($_GET['page'] - 1) : 0;
          $from = $currentPage * $limit;

          $allPages = ceil($thingsCount / $limit);
          $thingsQuery = "SELECT t.ID, c.categoryName, t.text, s.statusName, t.deadLineDate, t.catID, t.statusID FROM thingstodo t, categories c ,status s WHERE t.catID = c.ID AND s.ID = t.statusID AND t.userID = {$_SESSION['userId']}";

          if (isset($_GET['name'])) {
            $thingsQuery .= " AND t.text LIKE '%{$_GET['name']}%'";
          } else if (isset($_GET['category'])) {
            $thingsQuery .= " AND t.catID = {$_GET['category']}";
          } else if (isset($_GET['status'])) {
            $thingsQuery .= " AND t.statusID = {$_GET['status']}";
          }

          $thingsQuery .= " ORDER BY deadLineDate LIMIT {$from}, {$limit}";

          $result = $conn->query($thingsQuery);



          if ($result->num_rows > 0) {

            while ($row = $result->fetch_object()) {

              echo <<<END
              <div class="thing-to-do">
				          <span class="info"><strong>Treść:</strong> $row->text</span>

				          <span class="info"> <strong> Kategoria: </strong> $row->categoryName</span>

				          <span class="info"><strong>Data końcowa: </strong> $row->deadLineDate</span>

				          <span class="info"> <strong> Status: </strong>$row->statusName</span>

				          <div class="edit-elements">

                    <a title="Edytuj" class="edit-links" href="editElementForm.php?id={$row->ID}"><i class="fa-solid fa-pen-to-square"></i></a>

                    <a title="Usuń" class="edit-links" href="deleteElement.php?id={$row->ID}"><i class="fa-solid fa-x"></i></a>
					            
					              
				              </div>
              </div>
END;
            }
          ?>

        </aside>

        <?php
            echo '<section class="pages-section">';
            for ($i = 1; $i <= $allPages; $i++) {

              if ($currentPage > 4) {
                if (isset($_GET['name'])) {
                  echo <<<END
                <a class="pages-links {$active}" href="thingsToDo.php?page=1&name={$_GET['name']}">Strona pierwsza</a><i class="space">|</i>
              END;
                } else if (isset($_GET['category'])) {
                  echo <<<END
                <a class="pages-links {$active}" href="thingsToDo.php?page=1&category={$_GET['category']}">Strona pierwsza</a><i class="space">|</i>
              END;
                } else if (isset($_GET['status'])) {
                  echo <<<END
                <a class="pages-links {$active}" href="thingsToDo.php?page=1&status = {$_GET['status']}">Strona pierwsza</a><i class="space">|</i>
              END;
                } else {
                  echo <<<END
                <a class="pages-links {$active}" href="thingsToDo.php?page=1">Strona pierwsza</a><i class="space">|</i>
              END;
                }
              }

              $active = ($i == ($currentPage + 1)) ? 'active' : '';

              if (t1($i, ($currentPage - 3), ($currentPage + 5))) {
                if (isset($_GET['name'])) {
                  echo <<<END
                <a class="pages-links {$active}" href="thingsToDo.php?page={$i}&name={$_GET['name']}">{$i}</a><i class="space">|</i>
              END;
                } else if (isset($_GET['category'])) {
                  echo <<<END
                <a class="pages-links {$active}" href="thingsToDo.php?page={$i}&category={$_GET['category']}">{$i}</a><i class="space">|</i>
              END;
                } else if (isset($_GET['status'])) {
                  echo <<<END
                <a class="pages-links {$active}" href="thingsToDo.php?page={$i}&status={$_GET['status']}">{$i}</a><i class="space">|</i>
              END;
                } else {
                  echo <<<END
                <a class="pages-links {$active}" href="thingsToDo.php?page={$i}">{$i}</a><i class="space">|</i>
              END;
                }
              }
            }
            echo '</section>';
          } else {
            echo <<<ERROR
              <p class="paragraph error">Brak rzeczy do zrobienia!</p>
            ERROR;
          }
      ?>
        <?php
      if (isset($_SESSION['success'])) {
        echo <<<END
                  <p class="paragraph success">{$_SESSION['success']}</p>
                END;
        unset($_SESSION['success']);
      } else if (isset($_SESSION['error'])) {
        echo <<<END
                  <p class="paragraph error">{$_SESSION['error']}</p>
                END;
        unset($_SESSION['error']);
      }
      ?>
        <section class="addElement">

          <a href="addElementForm.php" class="buttons ">Dodaj rzecz</a>
        </section>

      </section>
    </main>
  </div>
</body>

</html>