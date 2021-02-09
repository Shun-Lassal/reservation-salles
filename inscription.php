<?php
include("classes.php");
include("utils.php");

if (isset($_POST['inscription'])) {
  $login = trim(htmlspecialchars($_POST['login']));
  $pdo = new PDO('mysql:host=localhost;dbname=reservationsalles', 'root', '');
  $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE login = '$login'");
  $stmt->execute();
  $count = $stmt->fetch(PDO::FETCH_ASSOC);
  if($count == 0){
    if (strlen(trim($_POST['login'])) >= 3) {
      if (strlen($_POST['password']) >= 6 && strlen($_POST['cpassword']) >= 6) {
        if ($_POST['password'] === $_POST['cpassword']) {
          $login = trim(htmlspecialchars($_POST['login']));
          $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
          $stmt = $pdo->prepare("INSERT INTO utilisateurs (login, password) VALUES ('$login', '$password')");
          $stmt->execute();
          //header("location: connexion.php");
        }
        else {
          $msg = "Password / Confirm Password Incorrect";
        }
      }
      else {
        $msg = "Password trop court";
      }
    }
    else {
      $msg = "Login trop court";
    }
  }
  else {
    $msg = "Login déjà existant";
  }
}














?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
  </head>
  <body>
    <?php include('header.php'); ?>
    <section class="profil">
      <section class="profil2">
        <h1>Inscription</h1>
        <section>
          <form class="form-signin" action="inscription.php" method="post">
            <label for="login">Identifiant:</label><br/>
            <input type="text" name="login" minlenght='3' required><br/>
            <label for="password">Mot de Passe:</label><br/>
            <input type="password" name="password" minlenght='6' required><br/>
            <label for="cpassword">Confirmer Mot de Passe:</label><br/>
            <input type="password" name="cpassword" minlenght='6' required><br/>
            <?php if(isset($msg)){
              echo ($msg);
            } ?>
            <input class="btn btn-danger" type="submit" name="inscription" value="S'inscrire">
          </form>
        </section>
      </section>
    </section>
  </body>
</html>
