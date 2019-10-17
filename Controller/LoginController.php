<?php

namespace controller;

class LoginController
{

  private $view;
  private $userStorage;

  public function __construct($loginView)
  {
    $this->view = $loginView;
    $this->userStorage = new \Model\UserStorage('users.json');
  }

  public function doTryLoginUser()
  {
    $username = $this->view->getRequestUserName();
    $password = $this->view->getRequestPassword();
  }

  public function isLoggedInBySession(){
    return isset($_SESSION["loggedIn"]);
  }
}
