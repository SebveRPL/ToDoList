<?php
require_once("session.php");
require_once("roleChecker.php");

if ($_GET['id'] == $_SESSION['userId']) {
  header("Location: settings.php");
  exit();
}
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
        <?php
        require_once("connect.php");
        $id = $_GET['id'];
        $selectQuery = "SELECT roleID,username FROM users WHERE ID = {$id}";

        $selectResult = $conn->query($selectQuery);
        $row = $selectResult->fetch_object();

        $roleID = $row->roleID;

        $username = $row->username;
        ?>


        <h2 class="panel-heading2">Edytuj rolę użytkownika <?= $username ?> </h2>

        <aside class="user">

          <form action="roleEdit.php" class="form" id="role-edit-form" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="place-holder">
              <label for="role" class="labels">Rola użytkownika: </label>
              <select name="role" class="select">
                <?php
                $rolesQuery = "SELECT ID, roleName FROM roles";

                $rolesResult = $conn->query($rolesQuery);

                if ($rolesResult->num_rows > 0) {
                  while ($row = $rolesResult->fetch_object()) {

                    if ($row->ID != $_SESSION['roleId']) {
                      if ($row->ID != 4) {
                        if (($row->ID == 1) && ($_SESSION['roleId'] == 2)) {
                        } else {
                          if ($roleID == $row->ID) {
                            echo <<<OPTION
                            <option selected value="{$row->ID}">{$row->roleName}</option>
                          OPTION;
                          } else {
                            echo <<<OPTION
                            <option value="{$row->ID}">{$row->roleName}</option>
                          OPTION;
                          }
                        }
                      }
                    }
                  }
                }
                $conn->close();
                ?>
              </select>
            </div>
            <div class="place-holder">
              <button class="buttons" type="submit" name="submit">Zmień Rolę</button>
            </div>

          </form>
        </aside>

      </section>
    </main>
  </div>
</body>

</html>