<?php

namespace controller;

class LoginController
{
  private static $loginSession = 'LoginController::isLoggedIn';
  private static $welcomeSession = 'LoginController::welcome';
  private static $byeSession = 'LoginController::bye';

  private $view;
  private $userStorage;
  private $authenticator;

  private $session;

  public function __construct(\View\LoginView $view, \Model\SessionHandler $session, \Model\UserStorage $storage)
  {
    $this->view = $view;
    $this->userStorage = $storage;

    $this->session = $session;
    $this->authenticator = new \Model\Authenticator();
  }

  public function setUserLoginState(): bool
  {
    if ($this->view->wantsToLogin()) {
      try {
        $this->authenticateUser();
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

  private function authenticateUser(): void
  {
    $enteredUsername = $this->view->getPostUserName();
    $enteredPassword = $this->view->getPostPassword();

    $foundUser = $this->userStorage->findUserByUserName($enteredUsername);

    if ($this->authenticator->hasValidPassword($foundUser, $enteredPassword)) {
      $this->session->setLoginSession(self::$loginSession, $enteredUsername);
    }
  }

  private function isLoggedInBySession(): bool
  {
    return $this->session->isSessionSet(self::$loginSession);
  }

  private function logoutUser(): void
  {
    $this->session->unsetSession(self::$loginSession);
    $this->session->unsetSession(self::$welcomeSession);
    $this->showBye();
  }

  private function showWelcome(): void
  {
    if (!$this->session->isSessionSet(self::$welcomeSession)) {
      $this->view->setMessage('Welcome');
      $this->session->setSession(self::$welcomeSession);
    }
  }

  private function showBye(): void
  {
    if (!$this->session->isSessionSet(self::$byeSession)) {
      $this->view->setMessage('Bye bye!');
      $this->session->setSession(self::$byeSession);
    }
  }
}
