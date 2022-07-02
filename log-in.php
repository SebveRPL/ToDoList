<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="CoMamZrobić.pl jest innowacyjną aplikacją webową,która ma za zadanie ułatwienia życia przy zapamiętywaniu rzeczy,które trzeba zrobić" />
  <script src="src/scripts/navigation.js" defer></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="src/css/styles.css">
  <title>CoMamZrobić.pl - Panel Logowania</title>
</head>

<body>
  <div class="container">
    <header class="header">
      <section class="left-header">
        <h1 class="heading1">CoMamZrobić.pl</h1>
        <span class="sub-text">Innowacyjna aplikacja webowa</span>
      </section>
      <section class="right-header">
        <h2 class="heading2">Zaloguj się!</h2>
        <div class="form">
          <form id="logInForm" action="log-in-form.php" method="post">
            <div class="place-holder">
              <label class="labels">LOGIN:</label>
              <input type="text" placeholder="LOGIN..." class="inputs" name="username" maxlength="100" required>
            </div>
            <div class="place-holder">
              <label class="labels">HASŁO:</label>
              <input type="password" placeholder="HASŁO..." name="password" class="inputs" required>
            </div>
            <div class="place-holder">
              <button type="submit" name="submit" class="buttons" value="ZALOGUJ">ZALOGUJ</button>
            </div>
          </form>
          <?php
          if (isset($_SESSION['error'])) {
            echo '<span class="labels error">' . $_SESSION['error'] . '</span>';
            unset($_SESSION['error']);
          }
          ?>

        </div>
      </section>
    </header>
  </div>

  <div id="menu-icon" class="menu-icon">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
  </div>
  <nav id="navigation" class="navigation">
    <ul class="menu">
      <li class="menu-element"><a href="index.php" class="links">Strona główna</a></li>
      <li class="menu-element"><a href="sing-up.php" class="links">dołącz!</a></li>
    </ul>
  </nav>
</body>


</html>