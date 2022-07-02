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

        <h2 class="panel-heading2">Użytkownicy</h2>

        <aside class="table">
          <?php
          function t1($val, $min, $max)
          {
            return ($val >= $min && $val <= $max);
          }

          require_once('connect.php');
          $usersCountQuery = $conn->query("SELECT COUNT(ID) as cnt FROM users");
          $userCount = $usersCountQuery->fetch_object()->cnt;
          $limit = 10;
          $currentPage = isset($_GET['page']) ? intval($_GET['page'] - 1) : 1;
          $from = $currentPage * $limit;

          $allPages = ceil($userCount / $limit);
          $usersQuery = "SELECT u.ID, u.username, u.email, r.roleName, u.roleId FROM users u, roles r WHERE u.roleId = r.id ORDER BY u.ID LIMIT {$from}, {$limit}";
          $result = $conn->query($usersQuery);

          if ($result->num_rows > 0) {
            echo '<table class="tables">';
            echo <<<HEAD
              <tr>
                <th>Nick</th>
                <th>E-Mail</th>
                <th>Rola</th>
                <th>Edycja</th>
              </tr>
            HEAD;
            while ($row = $result->fetch_object()) {

              echo <<<TABLE
              <tr>
                <td>$row->username</td>
                <td>$row->email</td>
              TABLE;
              $roleId = $row->roleId;
              switch ($roleId) {
                case 1:
                  echo <<<TABLE
                      <td>Head Administrator</td>
                    TABLE;
                  break;

                case 2:
                  echo <<<TABLE
                      <td>Administrator</td>
                    TABLE;
                  break;

                case 3:
                  echo <<<TABLE
                      <td>Użytkownik</td>
                    TABLE;
                  break;

                case 4:
                  echo <<<TABLE
                      <td>Właściciel</td>
                    TABLE;
                  break;

                case 6:
                  echo <<<TABLE
                      <td>Zbanowany</td>
                    TABLE;
                  break;
              }

              $userRole = $_SESSION['roleId'];
              $userId = $_SESSION['userId'];

              switch ($userRole) {
                case 1:
                  if ($row->roleId == 1 || $row->roleId == 2 || $row->roleId == 3) {
                    if ($row->ID == $userId) {
                      echo <<<TABLE
                      <td><a class="edit-links" href="settings.php?id={$row->ID}">Edytuj</a></td>
                    TABLE;
                    } else {
                      echo <<<TABLE
                      <td><a class="edit-links" href="editUser.php?id={$row->ID}">Edytuj</a></td>
                    TABLE;
                    }
                  } else {
                    echo <<<TABLE
                      <td>Brak edycji</td>
                    TABLE;
                  }
                  break;

                case 2:
                  if ($row->roleId == 3 || $row->roleId == 2) {
                    if ($row->ID == $userId) {
                      echo <<<TABLE
                      <td><a class="edit-links" href="settings.php?id={$row->ID}">Edytuj</a></td>
                    TABLE;
                    } else {
                      echo <<<TABLE
                      <td><a class="edit-links" href="editUser.php?id={$row->ID}">Edytuj</a></td>
                    TABLE;
                    }
                  } else {
                    echo <<<TABLE
                      <td>Brak edycji</td>
                    TABLE;
                  }
                  break;


                case 4:
                  if ($row->ID == $userId) {
                    echo <<<TABLE
                      <td><a class="edit-links" href="settings.php">Edytuj</a></td>
                    TABLE;
                  } else {
                    echo <<<TABLE
                      <td><a class="edit-links" href="editUser.php?id={$row->ID}">Edytuj</a></td>
                    TABLE;
                  }
                  break;
              }




              echo '</tr>';
            }
            echo '</table>';
            echo '<section class="pages-section">';
            for ($i = 1; $i <= $allPages; $i++) {

              if ($currentPage > 4) {
                echo <<<END
                <a class="pages-links {$active}" href="users.php?page=1">Strona pierwsza</a><i class="space">|</i>
              END;
              }

              $active = ($i == ($currentPage + 1)) ? 'active' : '';

              if (t1($i, ($currentPage - 3), ($currentPage + 5))) {
                echo <<<END
                <a class="pages-links {$active}" href="users.php?page={$i}">{$i}</a><i class="space">|</i>
              END;
              }

              if ($currentPage < ($allPages - 1)) {
                echo <<<END
                <a class="pages-links {$active}" href="users.php?page={$allPages}">Strona ostatnia</a><i class="space">|</i>
              END;
              }
            }
            echo '</section>';
          } else {
            echo <<<ERROR
              <p class="paragraph error">Brak użytkowników!</p>
            ERROR;
          }
          ?>
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
  </div>
</body>

</html>