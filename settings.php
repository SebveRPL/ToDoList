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
  <script src="src/scripts/activation.js" defer></script>
  <script src="src/scripts/deleteAccount.js" defer></script>
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

        <h2 class="panel-heading2">Ustawienia Konta </h2>

        <aside class="user">
          <div class="place-holder" id="nick-holder">
            <p class="paragraph"><strong>Nick: </strong><span class="white"><?= $_SESSION['nick'] ?></span></p>
            <button class="buttons" id="activate-login">Zmień login</button>
          </div>

          <div class="place-holder" id="pass-holder">
            <p class="paragraph"><strong>Hasło: </strong><span class="white"><i class="fa-solid fa-lock"></i></span></p>
            <button class="buttons" id="activate-password">Zmień hasło</button>
          </div>

          <div class="place-holder" id="email-holder">
            <p class="paragraph"><strong>E-mail:</strong><span class="white"><?= $_SESSION['email'] ?></span></p>
            <button class="buttons" id="activate-email">Zmień email</button>
          </div>

          <div class="place-holder">
            <button class="buttons red" id="delete-account">Usuń Konto</button>
          </div>

        </aside>
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
      </section>
    </main>
    <section id="delete-section" class="delete-account">
      <article class="delete-information">
        <h2 class="heading2 red">Czy na pewno chcesz usunąć konto? Zmiana ta jest nieodwracalna!</h2>

        <article class="buttons-section">
          <form action="deleteAccount.php" method="post">
            <input type="hidden" name="id" value="<?= $_SESSION['userId'] ?>">
            <button name="submit" type="submit" id="delete" class="buttons red">Usuń Konto</button>
          </form>

          <button id="cancel-button" class="buttons">Anuluj</button>
        </article>
      </article>
    </section>
  </div>


</body>

</html>