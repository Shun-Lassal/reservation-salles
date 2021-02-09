<?php

class user{
  private $id;
  private $login;

  function getId(){
    return $this->id;
  }

  function setId($id){
    $this->id = $id;
  }

  function getLogin(){
    return $this->login;
  }

  function setLogin($login){
    $this->login = $login;
  }
}

  

?>
