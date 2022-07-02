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

        <h2 class="panel-heading2">Dodaj rzecz do wykonania</h2>
        <form action="addElement.php" class="forms" id="add-element-form" method="post">
          <div class="place-holder">
            <label class="labels" for="text">Treść:</label>
            <textarea name="text" class="textarea" cols="30" rows="10" required></textarea>
          </div>

          <div class="place-holder">
            <label for="date" class="labels">Data Końcowa: </label>
            <input min="<?= date("Y-m-d") ?>" type="date" class="date" name="deadLine" required>
          </div>

          <div class="place-holder">
            <label for="category" class="labels">Kategoria: </label>
            <select name="category" class="select" required>
              <?php
              require_once("connect.php");
              $categoryQuery = "SELECT ID, categoryName FROM categories";

              $result = $conn->query($categoryQuery);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                  echo <<<OPTION
                    <option value ="{$row->ID}">$row->categoryName</option>
                  OPTION;
                }
              }
              $conn->close();

              ?>
            </select>
          </div>

          <div class="place-holder">
            <button name="submit" type="submit" class="buttons">Dodaj</button>
          </div>
        </form>
        <?php
        if (isset($_SESSION['error'])) {
          echo <<<END
              <p class="paragraph error">{$_SESSION['error']}</p>
            END;
          unset($_SESSION['error']);
        }
        ?>
      </section>
    </main>
  </div>
</body>

</html>