<?php include("utils.php") ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php include("header.php"); ?>
    <section class="tab">
      <h1>Planning des réservations</h1>
      <table class="planning">
        <tr>
          <th>Utilisateur</th>
          <th>Titre</th>
          <th>Date Début</th>
          <th>Date Fin</th>
          <th>Lien</th>
        </tr>
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=reservationsalles', 'root', '');
        $stmt = $pdo->prepare("SELECT reservations.id,utilisateurs.login,titre,debut,fin FROM reservations INNER JOIN utilisateurs ON utilisateurs.id = reservations.id_utilisateur ORDER BY debut DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $key => $value) {
          $date_debut = strtotime($value[3]);
          $date_debut = date('Y-m-d H:i', $date_debut);
          $date_fin = strtotime($value[4]);
          $date_fin = date('Y-m-d H:i', $date_fin);
            echo '<tr>
            <td>'.$value[1].'</td>
          <td class="user">'.$value[2].'</td>
          <td class="date">'.$date_debut.'</td>
          <td class="date">'.$date_fin.'</td>
          <td><form class="action" action="plan.php" method="post">
            <button class="btn btn-danger" type="submit" name="'.$value[0].'">Accéder aux détails</button>
          </form>';
          if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == $value[1]) {
            echo '<form class="action" action="delplan.php" method="post">
              <button class="btn btn-warning" type="submit" name="'.$value[0].'">Supprimer</button>
            </form></td></tr>';
            }
          }
          else {
            echo "</td></tr>";
          }
          }
          echo "</table>";

          echo "<h2>Planning de la semaine</h2></br>";
          echo "<table class='planning'>";
          $date = new DateTime();
          echo ('<tr>');
          $d1 = $date->format('d');
          echo "<th>Heure</th> ";
          for ($i=0; $i <= 4; $i++) {
            $d = $date->format('d-m');
            echo ('<th>'.$d.'</th>');
            $date->add(new DateInterval('P1D'));
            if ($i == 4) {
              echo ('</tr>');
            }
          }


          for ($u=9; $u <= 18; $u++) {
            echo "<tr><th>".$u."H</<th>";
            for ($y=0; $y <= 4; $y++) {
              $date2 = new DateTime();
              $d2 = $date2->setTime($u,00,00);
              $d2 = $date2->setDate(2021,2,$d1 + $y);
              $d2 = $date2->format('Y-m-d H:i');
              $stmt = $pdo->prepare("SELECT id,titre,fin FROM reservations WHERE '$d2' BETWEEN debut and fin");
              $stmt->execute();
              $result = $stmt->fetchAll();
              if (count($result) == 1) {
                echo '<td class="btn btn-danger">'.$result[0]['titre']."</td>";
              }
              else {
                echo '<td class="secondary"></td>';
              }
            }
            echo "</tr>";

          }
          echo "</table>";
        ?>
      </table>
    </section>
  </body>
</html>
