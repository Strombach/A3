<?php

namespace controller;

class LoginController
{

  private $view;
  private $userStorage;

  public function __construct(\View\LoginView $loginView)
  {
    $this->view = $loginView;

    $this->userStorage = new \Model\UserStorage();
    $this->userStorage->loadUsers('users.json');
  }

  public function doTryLoginUser()
  {
    $username = $this->view->getRequestUserName();
    $password = $this->view->getRequestPassword();

    if ($this->userStorage->authUser($username, $password)) {
      var_dump("Logged In");
    }
  }

  public function isLoggedInBySession()
  {
    return isset($_SESSION["loggedIn"]);
  }
}
