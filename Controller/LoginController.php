<?php

namespace controller;

class LoginController
{

  private $view;
  private $userStorage;

  private $session;

  public function __construct(\View\LoginView $view)
  {
    $this->view = $view;

    $this->session = new \Model\SessionHandler();

    $this->userStorage = new \Model\UserStorage();
    $this->userStorage->loadUsersFrom('users.json');
  }

  public function setUserLoginState()
  {
    $isLoggedIn = false;
    if ($this->view->wantsToLogin()) {
      try {
        $this->authorizeUser();
      } catch (\UsernameMissing $e) {
        $this->view->setMessage("Username is missing");
      } catch (\PasswordMissing $e) {
        $this->view->setMessage("Password is missing");
      } catch (\WrongCredentials $e) {
        $this->view->setMessage("Wrong name or password");
      }
    } else if ($this->view->wantsToLogout()) {
      $this->logoutUser();
    }
    $isLoggedIn = $this->isLoggedInBySession();
    return $isLoggedIn;
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
