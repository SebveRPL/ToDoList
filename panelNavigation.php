<nav class="panel-navigation">
  <?php
  $roleId = $_SESSION['roleId'];
  echo <<<LINK
    <a href="panel.php" alt="Strona główna" title="Strona Główna" class="nav-links"><i class="fa-solid fa-house"></i></a>

    <a href="thingsToDo.php?page=1" alt="Rzeczy do zrobienia" title="Rzeczy do zrobienia" class="nav-links"><i class="fa-solid fa-calendar"></i></a>


  LINK;

  switch ($roleId) {
    case 1:
    case 2:
    case 4:
      echo <<<LINK
        <a href="users.php?page=1" alt="Użytkownicy" title="Użytkownicy" class="nav-links"><i class="fa-solid fa-users"></i></a>
        <a href="categories.php?page=1" alt="Kategorie" title="Kategorie" class="nav-links"><i class="fa-solid fa-book"></i></a>
      LINK;
      break;
  }

  echo <<<LINK
    <a href="settings.php" alt="Ustawienia Konta" title="Ustawienia Konta" class="nav-links"><i class="fa-solid fa-gear"></i></a>

    <a href="logOut.php" alt="Wyloguj się" title="Wyloguj się" class="nav-links"><i class="fa-solid fa-power-off"></i></a>
  LINK;

  ?>

</nav>