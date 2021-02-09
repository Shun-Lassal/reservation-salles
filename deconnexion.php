<?php
include("classes.php");
include("utils.php");
if(isset($_SESSION)){
  header("location: connexion.php");
  session_destroy();
} ?>
