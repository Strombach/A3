<?php

namespace controller;

class LoginController
{
  private static $loginSession = 'LoginController::isLoggedIn';
  private static $welcomeSession = 'LoginController::welcome';
  private static $byeSession = 'LoginController::bye';


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

  public function setUserLoginState(): bool
  {
    $isLoggedIn = false;
    if ($this->view->wantsToLogin()) {
      try {
        $this->authorizeUser();
        $this->showWelcome();
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

  private function authorizeUser()
  {
    $enteredUsername = $this->view->getRequestUserName();
    $enteredPassword = $this->view->getRequestPassword();

    $foundUser = $this->userStorage->findUserByUserName($enteredUsername);

    if ($this->userStorage->hasValidPassword($foundUser, $enteredPassword)) {
      $this->session->setSession(self::$loginSession);
    }
  }

  private function isLoggedInBySession(): bool
  {
    return $this->session->isSessionSet(self::$loginSession);
  }

  private function logoutUser()
  {
    $this->session->unsetSession(self::$loginSession);
    $this->session->unsetSession(self::$welcomeSession);
    $this->showBye();
  }

  private function showWelcome()
  {
    if (!$this->session->isSessionSet(self::$welcomeSession)) {
      $this->view->setMessage('Welcome');
      $this->session->setSession(self::$welcomeSession);
    }
  }

  private function showBye()
  {
    if (!$this->session->isSessionSet(self::$byeSession)) {
      $this->view->setMessage('Bye bye!');
      $this->session->setSession(self::$byeSession);
    }
  }
}
