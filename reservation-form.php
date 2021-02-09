<?php include("utils.php");

if(isset($_POST['reserver'])){
  if (strlen(htmlspecialchars($_POST['titre'])) >= 3) {
    if (strlen(htmlspecialchars($_POST['desc'])) >= 10) {
      if (isset($_POST['date-debut']) && isset($_POST['date-debut-heure']) && isset($_POST['date-fin']) && isset($_POST['date-debut-heure'])) {
        $userid = $_SESSION['id'];
        $titre = htmlspecialchars($_POST['titre']);
        $desc = htmlspecialchars($_POST['desc']);
        $array = array($_POST['date-debut'],$_POST['date-debut-heure']);
        $datedebut = implode(" ",$array);
        $array = array($_POST['date-fin'],$_POST['date-fin-heure']);
        $datefin = implode(" ",$array);
        $pdo = new PDO('mysql:host=localhost;dbname=reservationsalles', 'root', '');
        $stmt = $pdo->prepare("INSERT INTO reservations (titre,description,debut,fin,id_utilisateur) VALUES ('$titre','$desc','$datedebut','$datefin','$userid')");
        $stmt->execute();
        //header("location: planning.php");
      }
    }
  }
}






?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <?php include("header.php") ?>
  <body>
    <section class="profil">
      <section class="profil2">
        <h1>Réserver une salle</h1>
        <form class="form" action="reservation-form.php" method="post">
          <label for="titre">Titre:</label><br/>
          <input type="text" name="titre"><br/>
          <label for="desc">Description:</label><br/>
          <textarea name="desc" rows="4" cols="40" minlenght="10"></textarea><br/>
          <label for="date-debut">Date de début:</label><br/>
          <input class="date" type="date" name="date-debut">
          <input class="date" type="time" name="date-debut-heure" step="3600"><br/>
          <label for="date-fin">Date de fin:</label><br/>
          <input class="date" type="date" name="date-fin">
          <input class="date" type="time" name="date-fin-heure" step="3600"><br/>
          <input class="btn btn-danger" type="submit" name="reserver" value="Réserver">
        </form>
      </section>
    </section>
  </body>
</html>
