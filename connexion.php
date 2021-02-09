<?php
include("classes.php");
include("utils.php");

if (!empty($_SESSION)) {
  header("location: index.php");
}


if (isset($_POST['connexion'])) {
  if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = trim(htmlspecialchars($_POST['login']));
    $password = $_POST['password'];
    $pdo = new PDO('mysql:host=localhost;dbname=reservationsalles', 'root', '');
    $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE login = '$login'");
    $stmt->execute();
    $stmtP = $pdo->prepare("SELECT password FROM utilisateurs WHERE login = '$login'");
    $stmtP->execute();
    $countP = $stmtP->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    if (count($count)) {
      if (password_verify($password,$countP['password'])) {
        $user = new user();
        $user->setId($count['id']);
        $user->setLogin($login);
        $_SESSION['id'] = $user->getId();
        $_SESSION['login'] = $user->getLogin();
        header("location: profil.php");
      }
      else {
        $msg = "Mot de passe incorrect";
      }
    }
    else {
      $msg = "Compte non trouvé";
    }
  }
  else {
    $msg = "Complétez le formulaire";
  }
}











?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
  </head>
  <body>
    <?php include('header.php'); ?>
    <section class="profil">
      <section class="profil2">
        <h1>Connexion</h1>
        <section>
          <form class="" action="connexion.php" method="post">
            <label for="login">Identifiant:</label><br/>
            <input type="text" name="login" minlenght='3' required><br/>
            <label for="password">Mot de Passe:</label><br/>
            <input type="password" name="password" minlenght='6' required><br/>
            <?php if(isset($msg)){
              echo ("<span>".$msg."</span>");
            } ?>
            <input class="btn btn-danger" type="submit" name="connexion" value="Se connecter">
          </form>
        </section>
      </section>
    </section>
  </body>
</html>
