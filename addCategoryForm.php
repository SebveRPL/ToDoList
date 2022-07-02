<?php
require_once("session.php");
require_once("roleChecker.php");
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

        <h2 class="panel-heading2">Dodaj kategorię</h2>
        <form action="addCategory.php" class="forms" id="add-category-form" method="post">
          <div class="place-holder">
            <label for="categoryName" class="labels">Nazwa kategorii: </label>
            <input type="text" name="categoryName" class="inputs" required="required">
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