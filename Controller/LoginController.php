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
    $this->userStorage->loadUsersFrom('users.json');
  }

  public function authorizeUser()
  {
    $enteredUsername = $this->view->getRequestUserName();
    $enteredPassword = $this->view->getRequestPassword();

    $foundUser = $this->userStorage->findUserByUserName($enteredUsername);
    $this->userStorage->hasValidPassword($foundUser, $enteredPassword);
  }

  public function isLoggedInBySession()
  {
    return isset($_SESSION["loggedIn"]);
  }

  public function logoutUser()
  {
    unset($_SESSION["loggedIn"]);
  }
}
