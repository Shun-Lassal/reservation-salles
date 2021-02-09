<?php
include("classes.php");
include("utils.php");

if(!empty($_SESSION['login'])){
    $login = $_SESSION['login'];
}
else {
  header("location: index.php");
}

if (isset($_POST['submit'])) {
  if (isset($_POST['login'])) {
    $newLogin = trim(htmlspecialchars($_POST['login']));
    $pdo = new PDO('mysql:host=localhost;dbname=reservationsalles', 'root', '');
    $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE login = '$newLogin'");
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    if($count == 1){
      $msg = "Login existant";
    }
    elseif (strlen(trim($_POST['login'])) >= 3) {
      $req = $pdo->prepare("UPDATE utilisateurs SET login='$newLogin' WHERE login='$login'");
      $req->execute();
      $user = new user();
      $user->setLogin($_POST['login']);
      $_SESSION['login'] = $_POST['login'];
      $msg = "Modification Login réussie";
      header("location: profil.php");
    }
  }
  if (isset($_POST['password']) && isset($_POST['cpassword'])) {
    if (strlen($_POST['password']) >= 6 && strlen($_POST['cpassword']) >= 6) {
      if ($_POST['password'] === $_POST['cpassword']) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE utilisateurs SET password='$password' WHERE login = '$login'");
        $stmt->execute();
        $msg = "Modification MDP réussie";
      }
      else {
        $msg = "Password / Confirmer Password Inexact";
      }
    }
  }
  else {
    $msg = "Remplissez Mot de passe & Confirmer Mot de passe";
  }
}









?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profil</title>
  </head>
  <body>
    <?php include('header.php'); ?>
    <main>
      <section class="profil">
        <section class="profil2">
          <h1 class="title">Profil</h1>
          <section class="profil3">
            <section class="profil4">
              <span id="nick">Identifiant actuel:<?php echo (' '.$login); ?></span>
            </section>
            <form class="" action="profil.php" method="post">
              <label for="login">Nouvel Identifiant:</label><br/>
              <input type='text' name='login' minlenght='3'><br/>
              <label for="password">Nouveau Mot de Passe:</label><br/>
              <input type="password" name="password"><br/>
              <label for="cpassword">Confirmer nouveau Mot de Passe:</label><br/>
              <input type="password" name="cpassword"><br/>
              <input class="btn btn-danger" type="submit" name="submit" value="Modifier mes informations"><br/>
              <?php if (isset($msg)) {
                echo ($msg ."<br/>");
              }?>
            </form>
          </section>
        </section>
      </section>
    </main>
  </body>
</html>
