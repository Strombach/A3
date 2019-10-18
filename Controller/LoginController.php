<?php

namespace controller;

class LoginController
{

  private $view;
  private $userStorage;

  private $session;

  public function __construct(\View\LoginView $loginView)
  {
    $this->view = $loginView;

    $this->session = new \Model\SessionHandler();

    $this->userStorage = new \Model\UserStorage();
    $this->userStorage->loadUsersFrom('users.json');
  }

  public function authorizeUser()
  {
    $enteredUsername = $this->view->getRequestUserName();
    $enteredPassword = $this->view->getRequestPassword();

    $foundUser = $this->userStorage->findUserByUserName($enteredUsername);
    if ($this->userStorage->hasValidPassword($foundUser, $enteredPassword)) {
      $this->session->setLoggedInSession();
    }
  }

  public function isLoggedInBySession()
  {
    return $this->session->isSessionSet("loggedIn");
  }

  public function logoutUser()
  {
    $this->session->unsetLoggedInSession();
  }
}
