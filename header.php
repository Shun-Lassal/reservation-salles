<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<header>
  <?php if(!empty($_SESSION)){
    echo ('<section class="profile"><a class="lien" href="reservation-form.php">Réserver</a><a class="lien" href="profil.php">Profil</a><a class="lien" href="deconnexion.php">Deconnexion</a></section>');
  } ?>
  <?php if(empty($_SESSION)){
    echo ('<a class="lien" href="connexion.php">Connexion</a> <a class="lien" href="inscription.php">Inscription</a>');
  } ?>
  <a class="lien" href="planning.php">Planning</a>
  <a class="lien" href="index.php">Accueil</a>
</header>
