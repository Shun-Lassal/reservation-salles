<?php
include("utils.php");

if (isset($_POST)) {
  foreach ($_POST as $key => $value) {
    $idPlan = $key;
  }
  $pdo = new PDO('mysql:host=localhost;dbname=reservationsalles', 'root', '');
  $stmt = $pdo->prepare("SELECT id_utilisateur FROM reservations WHERE id = '$idPlan'");
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $var = $_SESSION['id'];
  var_dump($idPlan);
  var_dump($result);
  var_dump($var);
  if ($var == $result['id_utilisateur']) {
    $stmt = $pdo->prepare("DELETE FROM `reservations` WHERE `reservations`.`id` = '$idPlan'");
    $stmt->execute();
    header("location: planning.php");
  }
}
else {
  echo "Il n'y a rien a afficher ici..";
}

?>
